<?php
// app/Http\Controllers/HomeController.php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use App\Models\Langue;
use App\Models\Region;
use App\Models\Contenu;
use App\Models\Commentaire;
use App\Helpers\CloudinaryHelper; // IMPORTANT : Ajoute cette ligne

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Vérifier que l'utilisateur est authentifié et a un rôle
        if (!$user || !$user->role) {
            return redirect()->route('login')
                ->with('error', 'Veuillez vous connecter pour accéder à l\'administration.');
        }

        $role = $user->role->nom_role;

        if (!in_array($role, ['Administrateur', 'Modérateur'])) {
            return redirect()->route('dashboard.index')
                ->with('error', 'Accès réservé aux administrateurs et modérateurs.');
        }

        // Variables par défaut
        $totalUsers = $totalRoles = $totalLangues = $totalRegions = $totalContenus = $totalCommentaires = 0;
        $dernierContenus = collect();
        $dernierUsers = collect();

        // Variables pour les graphiques
        $contenusValides = $contenusEnAttente = $contenusRejects = 0;
        $nbAdmins = $nbModerateurs = $nbContributeurs = $nbLecteurs = 0;

        // ADMINISTRATEUR → accès global
        if ($role === 'Administrateur') {
            $totalUsers        = User::count();
            $totalRoles        = Role::count();
            $totalLangues      = Langue::count();
            $totalRegions      = Region::count();
            $totalContenus     = Contenu::count();
            $totalCommentaires = Commentaire::count();

            // CORRECTION : Charger les médias avec les contenus
            $dernierContenus = Contenu::with(['medias' => function($query) {
                $query->take(1); // Prendre seulement le premier média
            }])
            ->orderBy('id_contenu', 'desc')
            ->limit(5)
            ->get();

            $dernierUsers = User::orderBy('id', 'desc')->limit(5)->get();

            // Contenus par statut
            $contenusValides    = Contenu::where('statut', 'validé')->count();
            $contenusEnAttente  = Contenu::where('statut', 'en_attente')->count();
            $contenusRejects    = Contenu::where('statut', 'rejeté')->count();

            // Utilisateurs par rôle
            $nbAdmins       = User::whereHas('role', fn($q) => $q->where('nom_role', 'Administrateur'))->count();
            $nbModerateurs  = User::whereHas('role', fn($q) => $q->where('nom_role', 'Modérateur'))->count();
            $nbContributeurs= User::whereHas('role', fn($q) => $q->where('nom_role', 'Contributeur'))->count();
            $nbLecteurs     = User::whereHas('role', fn($q) => $q->where('nom_role', 'Lecteur'))->count();
        }

        // MODÉRATEUR → contenus + commentaires
        elseif ($role === 'Modérateur') {
            $totalContenus     = Contenu::count();
            $totalCommentaires = Commentaire::count();

            // CORRECTION ICI aussi
            $dernierContenus = Contenu::with(['medias' => function($query) {
                $query->take(1);
            }])
            ->orderBy('id_contenu', 'desc')
            ->limit(5)
            ->get();
        }

        // === CORRECTION AJOUTÉE ICI ===
        // Ajouter l'URL d'image à chaque contenu
        foreach ($dernierContenus as $contenu) {
            $contenu->image_url = CloudinaryHelper::getContentImage($contenu);

            // DEBUG: Vérifier ce qui se passe
            // \Log::info("Contenu {$contenu->id_contenu} - Titre: {$contenu->titre}", [
            //     'medias_count' => $contenu->medias->count(),
            //     'image_url' => $contenu->image_url,
            //     'first_media' => $contenu->medias->first()
            // ]);
        }

        return view('tableaudebord', compact(
            'role',
            'totalUsers',
            'totalRoles',
            'totalLangues',
            'totalRegions',
            'totalContenus',
            'totalCommentaires',
            'dernierContenus',
            'dernierUsers',
            'contenusValides',
            'contenusEnAttente',
            'contenusRejects',
            'nbAdmins',
            'nbModerateurs',
            'nbContributeurs',
            'nbLecteurs'
        ));
    }
}
