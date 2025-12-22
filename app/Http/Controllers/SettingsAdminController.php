<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

class SettingsAdminController extends Controller
{
    public function index()
    {
        // Récupérer les paramètres actuels
        $settings = [
            'app_name' => config('app.name'),
            'app_url' => config('app.url'),
            'app_timezone' => config('app.timezone'),
            'app_locale' => config('app.locale'),

            // Paramètres email
            'mail_mailer' => config('mail.default'),
            'mail_host' => config('mail.mailers.smtp.host'),
            'mail_port' => config('mail.mailers.smtp.port'),
            'mail_username' => config('mail.mailers.smtp.username'),
            'mail_encryption' => config('mail.mailers.smtp.encryption'),

            // Paramètres de sécurité
            'session_lifetime' => config('session.lifetime'),
            'password_min_length' => config('auth.password_min_length', 8),
            'password_requires_special' => config('auth.password_requires_special', false),
            'password_requires_numbers' => config('auth.password_requires_numbers', false),
            'password_requires_uppercase' => config('auth.password_requires_uppercase', false),

            // Paramètres avancés
            'debug_mode' => config('app.debug'),
            'maintenance_mode' => app()->isDownForMaintenance(),
        ];

        // Liste des timezones
        $timezones = \DateTimeZone::listIdentifiers();

        // Liste des langues
        $languages = [
            'fr' => 'Français',
            'en' => 'English',
            'es' => 'Español',
            'de' => 'Deutsch',
            'ar' => 'العربية',
        ];

        return view('settings.index', compact('settings', 'timezones', 'languages'));
    }

    public function updateGeneral(Request $request)
    {
        $validated = $request->validate([
            'app_name' => 'required|string|max:255',
            'app_url' => 'required|url',
            'app_timezone' => 'required|string|timezone',
            'app_locale' => 'required|string|in:fr,en,es,de,ar',
        ]);

        // Mettre à jour le fichier .env
        $this->updateEnv([
            'APP_NAME' => '"' . $validated['app_name'] . '"',
            'APP_URL' => $validated['app_url'],
            'APP_TIMEZONE' => $validated['app_timezone'],
            'APP_LOCALE' => $validated['app_locale'],
        ]);

        // Effacer le cache de configuration
        Artisan::call('config:clear');

        return redirect()->route('settings')
            ->with('success', 'Paramètres généraux mis à jour avec succès.');
    }

    public function updateEmail(Request $request)
    {
        $validated = $request->validate([
            'mail_mailer' => 'required|string|in:smtp,sendmail,mailgun,ses,postmark,log,array',
            'mail_host' => 'required|string',
            'mail_port' => 'required|integer',
            'mail_username' => 'nullable|string',
            'mail_password' => 'nullable|string',
            'mail_encryption' => 'nullable|string|in:tls,ssl',
            'mail_from_address' => 'required|email',
            'mail_from_name' => 'required|string',
        ]);

        $envUpdates = [
            'MAIL_MAILER' => $validated['mail_mailer'],
            'MAIL_HOST' => $validated['mail_host'],
            'MAIL_PORT' => $validated['mail_port'],
            'MAIL_USERNAME' => $validated['mail_username'],
            'MAIL_ENCRYPTION' => $validated['mail_encryption'],
            'MAIL_FROM_ADDRESS' => $validated['mail_from_address'],
            'MAIL_FROM_NAME' => '"' . $validated['mail_from_name'] . '"',
        ];

        // Ne mettre à jour le mot de passe que s'il est fourni
        if (!empty($validated['mail_password'])) {
            $envUpdates['MAIL_PASSWORD'] = $validated['mail_password'];
        }

        $this->updateEnv($envUpdates);
        Artisan::call('config:clear');

        return redirect()->route('settings')
            ->with('success', 'Paramètres email mis à jour avec succès.');
    }

    public function updateSecurity(Request $request)
    {
        $validated = $request->validate([
            'session_lifetime' => 'required|integer|min:1|max:525600',
            'password_min_length' => 'required|integer|min:6|max:32',
            'password_requires_special' => 'boolean',
            'password_requires_numbers' => 'boolean',
            'password_requires_uppercase' => 'boolean',
            'enable_2fa' => 'boolean',
            'enable_registration' => 'boolean',
            'debug_mode' => 'boolean',
        ]);

        $this->updateEnv([
            'SESSION_LIFETIME' => $validated['session_lifetime'],
            'AUTH_PASSWORD_MIN_LENGTH' => $validated['password_min_length'],
            'AUTH_PASSWORD_REQUIRES_SPECIAL' => $validated['password_requires_special'] ? 'true' : 'false',
            'AUTH_PASSWORD_REQUIRES_NUMBERS' => $validated['password_requires_numbers'] ? 'true' : 'false',
            'AUTH_PASSWORD_REQUIRES_UPPERCASE' => $validated['password_requires_uppercase'] ? 'true' : 'false',
            'APP_DEBUG' => $validated['debug_mode'] ? 'true' : 'false',
            'ENABLE_REGISTRATION' => $validated['enable_registration'] ? 'true' : 'false',
        ]);

        Artisan::call('config:clear');

        return redirect()->route('settings')
            ->with('success', 'Paramètres de sécurité mis à jour avec succès.');
    }

    /**
     * Mettre à jour les variables d'environnement
     */
    private function updateEnv(array $data)
    {
        $envFile = base_path('.env');

        if (File::exists($envFile)) {
            $envContent = File::get($envFile);

            foreach ($data as $key => $value) {
                // Échapper les caractères spéciaux pour la regex
                $escapedKey = preg_quote($key, '/');

                // Pattern pour trouver la clé
                $pattern = "/^{$escapedKey}=.*/m";

                if (preg_match($pattern, $envContent)) {
                    // Remplacer la valeur existante
                    $envContent = preg_replace($pattern, "{$key}={$value}", $envContent);
                } else {
                    // Ajouter une nouvelle clé
                    $envContent .= "\n{$key}={$value}";
                }
            }

            File::put($envFile, $envContent);
        }
    }
}
