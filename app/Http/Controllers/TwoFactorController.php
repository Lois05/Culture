<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FA\Google2FA;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd; // CHANGER EN SVG (plus simple)
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Support\Facades\Crypt;

class TwoFactorController extends Controller
{
    protected $google2fa;

    public function __construct(Google2FA $google2fa)
    {
        $this->google2fa = $google2fa;
    }

    // Afficher le formulaire d'activation
    public function showEnableForm()
    {
        return view('auth.enable-2fa');
    }

    // Générer le secret et QR code
    public function generateSecret(Request $request)
    {
        $user = Auth::user();

        // Générer un nouveau secret
        $secret = $this->google2fa->generateSecretKey();

        // Sauvegarder temporairement en session
        session(['2fa_secret' => $secret]);

        // Générer le QR code URL
        $qrCodeUrl = $this->google2fa->getQRCodeUrl(
            config('app.name'),
            $user->email,
            $secret
        );

        // Option 1: Simple - retourner l'URL du QR code
        return view('auth.enable-2fa', [
            'qrCodeUrl' => $qrCodeUrl, // À utiliser avec une librairie JS côté frontend
            'secret' => $secret
        ]);

        // OU Option 2: Générer SVG (moins de dépendances)
        // $renderer = new ImageRenderer(
        //     new RendererStyle(400),
        //     new SvgImageBackEnd()
        // );
        // $writer = new Writer($renderer);
        // $qrCodeSvg = $writer->writeString($qrCodeUrl);

        // return view('auth.enable-2fa', [
        //     'qrCodeSvg' => $qrCodeSvg,
        //     'secret' => $secret
        // ]);
    }

    // Activer le 2FA
    public function enable(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:6',
        ]);

        $user = Auth::user();
        $secret = session('2fa_secret');

        // Vérifier le code
        $valid = $this->google2fa->verifyKey($secret, $request->code);

        if (!$valid) {
            return back()->withErrors(['code' => 'Code invalide']);
        }

        // Activer le 2FA pour l'utilisateur
        $user->google2fa_secret = $secret;
        $user->google2fa_enabled = true;

        // Générer des codes de secours
        $backupCodes = $this->generateBackupCodes();
        $user->backup_codes = $backupCodes;

        $user->save();

        // Nettoyer la session
        session()->forget('2fa_secret');

        return redirect()->route('2fa.backup-codes')
            ->with('success', '2FA activé avec succès!')
            ->with('backupCodes', $backupCodes);
    }

    // Afficher le formulaire de vérification après login
    public function showVerifyForm()
{
    return view('auth.verify-2fa', [
        'layout' => 'layouts_front'
    ]);
}

    // Vérifier le code après login
    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $user = Auth::user();

        // Vérifier si c'est un code de secours
        $backupCodes = $user->backup_codes ?? [];

        if (is_array($backupCodes) && in_array($request->code, $backupCodes)) {
            // Retirer le code de secours utilisé
            $newBackupCodes = array_values(array_diff($backupCodes, [$request->code]));
            $user->backup_codes = $newBackupCodes;
            $user->save();

            // Marquer la session comme vérifiée
            session(['2fa_verified' => true]);

            return redirect()->intended('/');
        }

        // Vérifier le code TOTP normal
        try {
            $secret = $user->google2fa_secret;
            if (!$secret) {
                return back()->withErrors(['code' => '2FA non configuré']);
            }

            $valid = $this->google2fa->verifyKey($secret, $request->code);

            if (!$valid) {
                return back()->withErrors(['code' => 'Code invalide']);
            }

            // Marquer la session comme vérifiée
            session(['2fa_verified' => true]);

            return redirect()->intended('/');
        } catch (\Exception $e) {
            return back()->withErrors(['code' => 'Erreur de vérification: ' . $e->getMessage()]);
        }
    }

    // Désactiver le 2FA
    public function disable(Request $request)
    {
        $request->validate([
            'password' => 'required|current_password',
        ]);

        $user = Auth::user();

        $user->google2fa_enabled = false;
        $user->google2fa_secret = null;
        $user->backup_codes = null;
        $user->save();

        session()->forget('2fa_verified');

        return redirect('/profile')->with('success', '2FA désactivé avec succès!');
    }

    // Afficher les codes de secours
    public function showBackupCodes()
    {
        $user = Auth::user();
        $backupCodes = $user->backup_codes ?? [];

        return view('auth.backup-codes', compact('backupCodes'));
    }

    // Régénérer les codes de secours
    public function regenerateBackupCodes(Request $request)
    {
        $request->validate([
            'password' => 'required|current_password',
        ]);

        $user = Auth::user();
        $backupCodes = $this->generateBackupCodes();

        $user->backup_codes = $backupCodes;
        $user->save();

        return back()->with('success', 'Nouveaux codes générés!')
                     ->with('backupCodes', $backupCodes);
    }

    // Générer des codes de secours
    private function generateBackupCodes($count = 8)
    {
        $codes = [];
        for ($i = 0; $i < $count; $i++) {
            // Générer 10 caractères alphanumériques
            $codes[] = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 10));
        }
        return $codes;
    }
}
