<?php

namespace App\Http\Controllers; // <-- Important: Pas de "Dashboard\"

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
use App\Models\Langue; // Assurez-vous que ce modèle existe

class SettingsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $langues = Langue::all(); // Vérifiez que cette table existe

        return view('front.dashboard.settings', compact('user', 'langues'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'sexe' => 'required|in:M,F',
            'date_naissance' => 'required|date',
            'id_langue' => 'nullable|exists:langues,id_langue',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('photo');

        // Gestion de la photo
        if ($request->hasFile('photo')) {
            // Supprimer l'ancienne photo si elle existe
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }

            // Stocker la nouvelle photo
            $path = $request->file('photo')->store('profile-photos', 'public');
            $data['photo'] = $path;
        }

        $user->update($data);

        return back()->with('success', 'Vos informations ont été mises à jour avec succès.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = Auth::user();
        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('success', 'Votre mot de passe a été modifié avec succès.');
    }

    public function deleteAccount(Request $request)
    {
        $user = Auth::user();

        // Déconnecter l'utilisateur
        Auth::logout();

        // Supprimer le compte
        $user->delete();

        // Rediriger vers la page d'accueil
        return redirect('/')->with('success', 'Votre compte a été supprimé avec succès.');
    }
}
