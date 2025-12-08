<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Langue;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view pour l'ADMIN uniquement
     * (Pour créer des comptes admin)
     */
    public function create(): View
    {
        // Seulement pour créer des comptes admin
        $roles = Role::all(); // Tous les rôles
        $langues = Langue::orderBy('nom_langue')->get();

        return view('auth.register', compact('roles', 'langues'));
    }

    /**
     * Handle an incoming registration request pour l'ADMIN uniquement
     * (Création de comptes par un admin)
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'sexe' => ['required', 'in:M,F'],
            'date_naissance' => ['required', 'date'],
            'id_role' => ['required', 'exists:roles,id'],
            'id_langue' => ['required', 'exists:langues,id_langue'],
            'photo' => ['nullable', 'image', 'max:2048'],
        ]);

        // Créer l'utilisateur (pour admin)
        $user = User::create([
            'name' => $request->name,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'sexe' => $request->sexe,
            'date_naissance' => $request->date_naissance,
            'id_role' => $request->id_role,
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

        event(new Registered($user));

        // NE PAS connecter automatiquement (admin crée le compte)
        return redirect()->route('admin.users.index')
            ->with('success', 'Utilisateur créé avec succès.');
    }
}
