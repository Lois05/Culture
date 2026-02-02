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

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Vérifier que l'utilisateur est authentifié et a un rôle
        if (!$user || !$user->role) {
            return redirect()->route('front.connexion')
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

        // Fonction helper pour récupérer l'image
        $getImageUrl = function($path) {
            if (!$path || trim($path) === '') {
                return asset('adminlte/img/collage.png');
            }

            // Si c'est déjà une URL complète
            if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
                return $path;
            }

            // Extraire juste le nom du fichier
            $filename = basename($path);

            // Vérifier si le fichier existe dans public/adminlte/img/
            $imagePath = 'adminlte/img/' . $filename;

            if (file_exists(public_path($imagePath))) {
                return asset($imagePath);
            }

            // Si non trouvé, essayer d'autres chemins
            $possiblePaths = [
                'adminlte/img/' . $filename,
                $filename,
                'uploads/' . $filename,
                'storage/' . $filename,
            ];

            foreach ($possiblePaths as $possiblePath) {
                if (file_exists(public_path($possiblePath))) {
                    return asset($possiblePath);
                }
            }

            // Fallback
            return asset('adminlte/img/collage.png');
        };

        // ADMINISTRATEUR → accès global
        if ($role === 'Administrateur') {
            $totalUsers        = User::count();
            $totalRoles        = Role::count();
            $totalLangues      = Langue::count();
            $totalRegions      = Region::count();
            $totalContenus     = Contenu::count();
            $totalCommentaires = Commentaire::count();

            // Récupérer les derniers contenus AVEC images
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

            // Récupérer les derniers contenus
            $dernierContenus = Contenu::with(['medias' => function($query) {
                $query->take(1);
            }])
            ->orderBy('id_contenu', 'desc')
            ->limit(5)
            ->get();
        }

        // === CORRECTION : Ajouter l'URL d'image à chaque contenu SANS Cloudinary ===
        foreach ($dernierContenus as $contenu) {
            // Récupérer la première image du média s'il existe
            if ($contenu->medias && $contenu->medias->count() > 0) {
                $firstMedia = $contenu->medias->first();
                $contenu->image_url = $getImageUrl($firstMedia->chemin);
            } else {
                $contenu->image_url = asset('adminlte/img/collage.png');
            }
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
