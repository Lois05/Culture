<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Role;
use App\Models\Langue;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role', 'langue')->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        $langues = Langue::all();
        return view('users.create', compact('roles', 'langues'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'prenom' => 'nullable|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed', // ← 'confirmed' important
        'statut' => 'required|in:actif,inactif',
        'sexe' => 'nullable|in:M,F',
        'date_naissance' => 'nullable|date',
        'id_role' => 'nullable|exists:roles,id',
        'id_langue' => 'nullable|exists:langues,id_langue',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Créer l'utilisateur
    $user = User::create([
        'name' => $validated['name'],
        'prenom' => $validated['prenom'] ?? null,
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']), // Hachage du mot de passe
        'statut' => $validated['statut'],
        'sexe' => $validated['sexe'] ?? null,
        'date_naissance' => $validated['date_naissance'] ?? null,
        'id_role' => $validated['id_role'] ?? null,
        'id_langue' => $validated['id_langue'] ?? null,
        'date_inscription' => now(),
    ]);

    // Gérer l'upload de la photo
    if ($request->hasFile('photo')) {
        $path = $request->file('photo')->store('avatars', 'public');
        $user->photo = $path;
        $user->save();
    }

    return redirect()->route('users.index')
                     ->with('success', 'Utilisateur créé avec succès !');
}

    public function show(User $user)
    {
        $user->load('role', 'langue');
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $langues = Langue::all();
        return view('users.edit', compact('user', 'roles', 'langues'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'prenom'   => 'nullable|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'role_id'  => 'required|exists:roles,id',
            'langue_id' => 'nullable|exists:langues,id',
            'statut'   => 'required|in:actif,inactif',
            'photo'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $userData = [
            'name'     => $request->name,
            'prenom'   => $request->prenom,
            'email'    => $request->email,
            'role_id'  => $request->role_id,
            'langue_id' => $request->langue_id,
            'statut'   => $request->statut,
        ];

        // Gestion de la photo
        if ($request->hasFile('photo')) {
            // Supprimer l'ancienne photo si elle existe
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }
            $path = $request->file('photo')->store('avatars', 'public');
            $userData['photo'] = $path;
        }

        $user->update($userData);

        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour.');
    }

    public function destroy(User $user)
    {
        if ($user->photo) {
            Storage::disk('public')->delete($user->photo);
        }
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé.');
    }

    public function updatePhoto(Request $request, $id)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $user = User::findOrFail($id);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('avatars', 'public');
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }
            $user->update(['photo' => $path]);
        }

        return redirect()->route('users.show', $user)->with('success', 'Photo mise à jour.');
    }

    public function removePhoto(User $user)
    {
        if ($user->photo) {
            Storage::disk('public')->delete($user->photo);
            $user->update(['photo' => null]);
        }

        return redirect()->route('users.show', $user)->with('success', 'Photo supprimée.');
    }


}
