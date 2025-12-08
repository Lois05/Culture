<?php
// app/Http/Controllers/Auth/FrontAuthController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Langue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class FrontAuthController extends Controller
{
    /**
     * Traiter la connexion FRONT
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Vérifier si le compte est actif
            if ($user->statut !== 'actif') {
                Auth::logout();
                return redirect()->route('front.connexion')
                    ->with('error', 'Votre compte est désactivé.');
            }

            // Vérifier le rôle
            $role = $user->role->nom_role ?? null;

            // Si c'est un rôle admin, rediriger vers l'admin
            if (in_array($role, ['Administrateur', 'Modérateur'])) {
                return redirect()->intended(route('admin.tableaudebord'))
                    ->with('success', 'Bienvenue dans l\'administration !');
            }

            // Si c'est un contributeur, rediriger vers le dashboard
            if ($role === 'Contributeur') {
                return redirect()->intended(route('dashboard.index'))
                    ->with('success', 'Bienvenue sur votre espace contributeur !');
            }

            // Utilisateur normal
            return redirect()->intended(route('front.home'))
                ->with('success', 'Connexion réussie !');
        }

        return back()->withErrors([
            'email' => 'Identifiants incorrects.',
        ]);
    }

    /**
     * Traiter l'inscription FRONT
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'sexe' => ['required', 'in:M,F'],
            'date_naissance' => ['required', 'date', 'before:today'],
            'id_langue' => ['required', 'exists:langues,id_langue'],
            'photo' => ['nullable', 'image', 'max:2048'],
        ]);

        // Trouver le rôle "Contributeur"
        $contributeurRole = Role::where('nom_role', 'Contributeur')->first();

        if (!$contributeurRole) {
            $contributeurRole = Role::create([
                'nom_role' => 'Contributeur',
                'description' => 'Utilisateur qui peut contribuer des contenus'
            ]);
        }

        // Créer l'utilisateur (toujours Contributeur)
        $user = User::create([
            'name' => $request->name,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'sexe' => $request->sexe,
            'date_naissance' => $request->date_naissance,
            'id_role' => $contributeurRole->id,
            'id_langue' => $request->id_langue,
            'statut' => 'actif',
            'date_inscription' => now(),
        ]);

        // Gérer la photo
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('users', 'public');
            $user->photo = $photoPath;
            $user->save();
        }

        // Connecter automatiquement
        Auth::login($user);

        return redirect()->route('dashboard.index')
            ->with('success', 'Inscription réussie ! Bienvenue sur votre espace contributeur.');
    }

    /**
     * Déconnexion FRONT
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('front.home')
            ->with('success', 'Vous avez été déconnecté.');
    }
}
