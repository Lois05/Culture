<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;    // ✅ AJOUTEZ CETTE LIGNE
use Illuminate\Support\Facades\Log;   // ✅ AJOUTEZ CETTE LIGNE
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
   public function store(LoginRequest $request): RedirectResponse
{
    $request->authenticate();
    $request->session()->regenerate();

    // ⚠️ IGNOREZ l'objet Auth::user() et allez DIRECTEMENT à la base
    $userFromDB = DB::table('users')
        ->where('email', $request->email)
        ->first();

    if (!$userFromDB) {
        Auth::logout();
        throw ValidationException::withMessages([
            'email' => 'Utilisateur non trouvé.',
        ]);
    }

    // Récupérez le rôle
    $roleName = DB::table('roles')
        ->where('id', $userFromDB->id_role)
        ->value('nom_role');

    // Log clair
    Log::info('🔐 Connexion - Données brutes:', [
        'user_id' => $userFromDB->id,
        'email' => $userFromDB->email,
        'id_role_db' => $userFromDB->id_role,
        'role_name' => $roleName,
        'statut' => $userFromDB->statut
    ]);

    if ($userFromDB->statut !== 'actif') {
        Auth::logout();
        throw ValidationException::withMessages([
            'email' => 'Votre compte est désactivé.',
        ]);
    }

    if (!$roleName) {
        Log::error('🚨 ERREUR CRITIQUE: Rôle manquant', [
            'user_data' => $userFromDB,
            'all_roles' => DB::table('roles')->get()
        ]);
        Auth::logout();
        throw ValidationException::withMessages([
            'email' => 'Votre compte n\'a pas de rôle défini. Contactez l\'administrateur.',
        ]);
    }

    // Redirection SIMPLE
    Log::info('🎯 Redirection pour rôle: ' . $roleName);

    if ($roleName === 'Administrateur' || $roleName === 'Modérateur') {
        return redirect()->route('admin.tableaudebord');
    }

    return redirect()->route('dashboard.index');
}

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
