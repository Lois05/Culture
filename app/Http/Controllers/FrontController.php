<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Contenu;
use App\Models\TypeContenu;
use App\Models\User;
use App\Models\Media;
use App\Models\Langue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    private $fictiveStats = [
        'min_views' => 300,
        'max_views' => 50000,
        'like_rate_min' => 0.05,
        'like_rate_max' => 0.15,
        'comment_rate_min' => 0.01,
        'comment_rate_max' => 0.05,
        'favorite_rate_min' => 0.03,
        'favorite_rate_max' => 0.08,
        'share_rate_min' => 0.001,
        'share_rate_max' => 0.003,
    ];

    private $typeIcons = [
        1 => ['icon' => 'bi-magic', 'color' => '#E8112D', 'nom' => 'Vodoun'],
        2 => ['icon' => 'bi-brush', 'color' => '#0D6EFD', 'nom' => 'Art'],
        3 => ['icon' => 'bi-egg-fried', 'color' => '#198754', 'nom' => 'Gastronomie'],
        4 => ['icon' => 'bi-book', 'color' => '#6F42C1', 'nom' => 'Histoire'],
        5 => ['icon' => 'bi-music-note-beamed', 'color' => '#FD7E14', 'nom' => 'Musique'],
        6 => ['icon' => 'bi-person-arms-up', 'color' => '#20C997', 'nom' => 'Danse'],
        7 => ['icon' => 'bi-building', 'color' => '#0DCAF0', 'nom' => 'Architecture'],
        8 => ['icon' => 'bi-calendar3', 'color' => '#6610F2', 'nom' => 'Traditions'],
        9 => ['icon' => 'bi-translate', 'color' => '#D63384', 'nom' => 'Langues'],
        10 => ['icon' => 'bi-people', 'color' => '#6C757D', 'nom' => 'Coutumes'],
    ];

    /**
     * Récupérer l'URL correcte pour une image
     */
    private function getImageUrl($path)
    {
        if (!$path) {
            return asset('adminlte/img/collage.png');
        }

        // Si le chemin commence par "storage/", on utilise asset()
        if (strpos($path, 'storage/') === 0) {
            return asset($path);
        }

        // Si c'est un chemin absolu (commence par http)
        if (strpos($path, 'http') === 0) {
            return $path;
        }

        // Sinon, on suppose que c'est dans le storage
        if (strpos($path, 'public/') === 0) {
            return asset(str_replace('public/', 'storage/', $path));
        }

        // Par défaut, dans storage
        return asset('storage/' . ltrim($path, '/'));
    }

    /**
     * Récupérer l'URL de la photo de profil
     */
    private function getUserPhotoUrl($user)
    {
        if (!$user || !$user->photo) {
            return null;
        }

        return $this->getImageUrl($user->photo);
    }

    /**
     * Récupérer l'image principale d'un contenu
     */
    private function getContenuCoverImage($contenu)
    {
        if ($contenu->medias && $contenu->medias->isNotEmpty()) {
            $firstMedia = $contenu->medias->first();
            return $this->getImageUrl($firstMedia->chemin);
        }

        return asset('adminlte/img/collage.png');
    }

    public function index()
    {
        $stats = [
            'total_regions' => Region::count(),
            'total_contenus' => Contenu::where('statut', 'validé')->count(),
            'total_utilisateurs' => User::where('statut', 'actif')->count(),
            'total_types' => TypeContenu::count(),
        ];

        $contenusPopulaires = Contenu::with([
                'typeContenu',
                'region',
                'auteur',
                'medias'
            ])
            ->where('statut', 'validé')
            ->orderBy('date_creation', 'desc')
            ->limit(6)
            ->get()
            ->map(function($contenu) {
                $this->addFictiveStats($contenu);
                // Ajouter les URLs des images
                $contenu->cover_image = $this->getContenuCoverImage($contenu);
                $contenu->author_photo_url = $this->getUserPhotoUrl($contenu->auteur);
                return $contenu;
            });

        $derniersContenus = Contenu::with([
                'typeContenu',
                'auteur',
                'region',
                'medias'
            ])
            ->where('statut', 'validé')
            ->orderBy('date_creation', 'desc')
            ->limit(3)
            ->get()
            ->map(function($contenu) {
                $this->addFictiveStats($contenu);
                $contenu->cover_image = $this->getContenuCoverImage($contenu);
                $contenu->author_photo_url = $this->getUserPhotoUrl($contenu->auteur);
                return $contenu;
            });

        $regionsPopulaires = Region::withCount(['contenus' => function($query) {
                $query->where('statut', 'validé');
            }])
            ->orderBy('contenus_count', 'desc')
            ->limit(6)
            ->get();

        return view('front.home', compact(
            'stats',
            'contenusPopulaires',
            'derniersContenus',
            'regionsPopulaires'
        ));
    }

    public function explorer(Request $request)
    {
        $typesContenus = TypeContenu::all();
        $regions = Region::all();

        $query = Contenu::with([
                'typeContenu',
                'region',
                'auteur',
                'medias'
            ])
            ->where('statut', 'validé');

        if ($request->filled('type') && $request->type != 'all') {
            $query->where('id_type_contenu', $request->type);
        }

        if ($request->filled('region') && $request->region != 'all') {
            $query->where('id_region', $request->region);
        }

        if ($request->filled('q')) {
            $searchTerm = $request->q;
            $query->where(function($q) use ($searchTerm) {
                $q->where('titre', 'like', '%' . $searchTerm . '%')
                  ->orWhere('texte', 'like', '%' . $searchTerm . '%')
                  ->orWhereHas('auteur', function($authorQuery) use ($searchTerm) {
                      $authorQuery->where('name', 'like', '%' . $searchTerm . '%')
                                 ->orWhere('prenom', 'like', '%' . $searchTerm . '%');
                  });
            });
        }

        $sort = $request->get('sort', 'recent');
        switch ($sort) {
            case 'popular': $query->orderBy('date_creation', 'desc'); break;
            case 'title': $query->orderBy('titre', 'asc'); break;
            default: $query->orderBy('date_creation', 'desc'); break;
        }

        $totalContenus = (clone $query)->count();
        $contenus = $query->paginate(12);

        $contenus->getCollection()->transform(function($contenu) {
            $this->addFictiveStats($contenu);
            $typeConfig = $this->getTypeConfig($contenu->typeContenu->id_type_contenu ?? 1);
            $contenu->icon = $typeConfig['icon'];
            $contenu->color = $typeConfig['color'];
            $wordCount = str_word_count(strip_tags($contenu->texte ?? ''));
            $contenu->reading_time = max(1, ceil($wordCount / 200));

            // Ajouter les URLs des images
            $contenu->cover_image = $this->getContenuCoverImage($contenu);
            $contenu->author_photo_url = $this->getUserPhotoUrl($contenu->auteur);
            $contenu->media_urls = $contenu->medias->map(function($media) {
                return $this->getImageUrl($media->chemin);
            })->toArray();

            return $contenu;
        });

        $typeCounts = [];
        foreach ($typesContenus as $type) {
            $typeCounts[$type->id_type_contenu] = Contenu::where('id_type_contenu', $type->id_type_contenu)
                ->where('statut', 'validé')
                ->count();
        }

        $typeIconsSimple = collect($this->typeIcons)->mapWithKeys(function ($item, $key) {
            return [$key => $item['icon']];
        })->toArray();

        return view('front.explorer', compact(
            'contenus',
            'typesContenus',
            'regions',
            'typeCounts',
            'totalContenus',
            'typeIconsSimple'
        ));
    }


    public function regions()
{
    $regions = Region::withCount(['contenus' => function($query) {
            $query->where('statut', 'validé');
        }])
        ->with(['contenus' => function($query) {
            $query->where('statut', 'validé')
                  ->with(['typeContenu', 'auteur', 'medias'])
                  ->orderBy('date_creation', 'desc')
                  ->limit(3);
        }])
        ->orderBy('nom_region', 'asc')
        ->get()
        ->map(function($region) {
            // Préparer les contenus de chaque région
            if ($region->contenus) {
                $region->contenus->transform(function($contenu) {
                    $this->addFictiveStats($contenu);
                    $contenu->cover_image = $this->getContenuCoverImage($contenu);
                    $contenu->author_photo_url = $this->getUserPhotoUrl($contenu->auteur);
                    return $contenu;
                });
            }
            return $region;
        });

    $typesContenus = TypeContenu::all();

    $stats = [
        'total_regions' => $regions->count(),
        'total_contenus' => $regions->sum('contenus_count'),
        'total_types' => TypeContenu::count(),
        'total_utilisateurs' => User::where('statut', 'actif')->count(),
    ];

    $regionLangues = [];
    $commonLanguages = ['Fon', 'Yoruba', 'Français', 'Bariba', 'Dendi'];

    foreach ($regions as $region) {
        $numLanguages = rand(2, 4);
        shuffle($commonLanguages);
        $regionLangues[$region->id_region] = array_slice($commonLanguages, 0, $numLanguages);
    }

    return view('front.regions', compact(
        'regions',
        'typesContenus',
        'stats',
        'regionLangues'
    ));
}

public function region($slug)
{
    // Trouver la région par son nom (slug)
    $region = Region::where('nom_region', 'like', '%' . str_replace('-', ' ', $slug) . '%')
                    ->firstOrFail();

    // Récupérer les contenus de cette région
    $contenus = Contenu::with([
            'typeContenu',
            'auteur',
            'medias'
        ])
        ->where('id_region', $region->id_region)
        ->where('statut', 'validé')
        ->orderBy('date_creation', 'desc')
        ->paginate(12);

    // Ajouter les stats fictives et URLs d'images
    $contenus->getCollection()->transform(function($contenu) {
        $this->addFictiveStats($contenu);
        $contenu->cover_image = $this->getContenuCoverImage($contenu);
        $contenu->author_photo_url = $this->getUserPhotoUrl($contenu->auteur);
        return $contenu;
    });

    // Statistiques de la région
    $stats = [
        'contenus_count' => $contenus->total(),
        'contributeurs_count' => $region->contenus()
            ->where('statut', 'validé')
            ->distinct('id_auteur')
            ->count('id_auteur'),
        'types_count' => $region->contenus()
            ->where('statut', 'validé')
            ->distinct('id_type_contenu')
            ->count('id_type_contenu'),
        'langues_count' => rand(2, 5),
        'groupes_count' => rand(3, 8),
    ];

    // Types de contenus dans cette région
    $types = TypeContenu::withCount(['contenus' => function($query) use ($region) {
            $query->where('id_region', $region->id_region)
                  ->where('statut', 'validé');
        }])
        ->orderBy('contenus_count', 'desc')
        ->get();

    // Contributeurs de la région
    $contributeurs = User::whereIn('id', function($query) use ($region) {
            $query->select('id_auteur')
                  ->from('contenus')
                  ->where('id_region', $region->id_region)
                  ->where('statut', 'validé');
        })
        ->withCount(['contenus' => function($query) use ($region) {
            $query->where('id_region', $region->id_region)
                  ->where('statut', 'validé');
        }])
        ->orderBy('contenus_count', 'desc')
        ->limit(6)
        ->get()
        ->map(function($user) {
            $user->followers_count = rand(50, 5000);
            $user->total_contributions = rand(5, 50);
            $user->photo_url = $this->getUserPhotoUrl($user);
            return $user;
        });

    // Traditions de la région (données simulées)
    $traditions = [
        ['title' => 'Le Vodoun', 'description' => 'Religion traditionnelle...', 'tags' => ['Spiritualité', 'Cérémonies']],
        ['title' => 'Bas-reliefs d\'Abomey', 'description' => 'Art unique au monde...', 'tags' => ['Artisanat', 'Patrimoine']],
        ['title' => 'Guelédé & Zangbeto', 'description' => 'Masques cérémoniels...', 'tags' => ['Danses', 'Masques']],
    ];

      // Préparer les contenus avec les images
    $contenus->getCollection()->transform(function($contenu) {
        // Ajouter la méthode addFictiveStats si elle n'existe pas
        $this->addFictiveStats($contenu);

        // Préparer l'URL de l'image
        $contenu->image_url = $this->getContenuCoverImage($contenu);
        $contenu->author_photo_url = $this->getUserPhotoUrl($contenu->auteur);

        return $contenu;
    });

    // Langues parlées dans la région (données simulées)
    $langues = $this->getRegionLanguages($region);

    return view('front.region-content', compact(
        'region',
        'contenus',
        'stats',
        'types',
        'contributeurs',
        'traditions',
        'langues'
    ));
}

/**
 * Méthode auxiliaire pour les langues de la région
 */
private function getRegionLanguages($region)
{
    $defaultLangues = [
        1 => ['Fon', 'Yoruba', 'Français'], 2 => ['Fon', 'Yoruba', 'Français'],
        3 => ['Fon', 'Yoruba'], 4 => ['Ifè', 'Yoruba', 'Mahi'],
        5 => ['Yoruba', 'Gun'], 6 => ['Yoruba', 'Ifè'],
        7 => ['Bariba', 'Dendi', 'Fulfulde'], 8 => ['Bariba', 'Dendi', 'Fulfulde'],
        9 => ['Xwla', 'Houéda', 'Fon'], 10 => ['Fon', 'Adja'],
        11 => ['Ditammari', 'Berba', 'Waama'], 12 => ['Ditammari', 'Berba', 'Waama'],
    ];
    return $defaultLangues[$region->id_region] ?? ['Fon', 'Français'];
}

    // Dans votre FrontController.php, ajoutez ces méthodes

public function contenu($id)
{
    $contenu = Contenu::with([
            'typeContenu',
            'region',
            'auteur',
            'auteur.role',
            'medias',
            'commentaires' => function($query) {
                $query->with('utilisateur')
                      ->orderBy('date', 'desc')
                      ->limit(10);
            },
            'langue'
        ])
        ->where('statut', 'validé')
        ->where('id_contenu', $id)
        ->firstOrFail();

    // Stats FICTIVES uniquement
    $baseViews = rand($this->fictiveStats['min_views'], $this->fictiveStats['max_views']);
    $typeFactor = $this->getContentTypeFactor($contenu->typeContenu->nom_contenu ?? 'Histoire');
    $views = $baseViews * $typeFactor;

    $stats = [
        'vues' => $this->roundToRealisticNumber($views),
        'likes' => (int) ($views * rand($this->fictiveStats['like_rate_min'] * 100, $this->fictiveStats['like_rate_max'] * 100) / 100),
        'commentaires' => $contenu->commentaires->count() ?: (int) ($views * rand($this->fictiveStats['comment_rate_min'] * 100, $this->fictiveStats['comment_rate_max'] * 100) / 100),
        'favoris' => (int) ($views * rand($this->fictiveStats['favorite_rate_min'] * 100, $this->fictiveStats['favorite_rate_max'] * 100) / 100),
        'partages' => (int) ($views * rand($this->fictiveStats['share_rate_min'] * 100, $this->fictiveStats['share_rate_max'] * 100) / 100),
    ];

    $wordCount = str_word_count(strip_tags($contenu->texte ?? ''));
    $readingTime = max(3, ceil($wordCount / 200));

    $contenusSimilaires = Contenu::with(['typeContenu', 'auteur', 'medias'])
        ->where('statut', 'validé')
        ->where('id_contenu', '!=', $id)
        ->where(function($query) use ($contenu) {
            $query->where('id_region', $contenu->id_region)
                  ->orWhere('id_type_contenu', $contenu->id_type_contenu);
        })
        ->orderBy('date_creation', 'desc')
        ->limit(3)
        ->get()
        ->map(function($simContenu) {
            $this->addFictiveStats($simContenu);
            $simContenu->cover_image = $this->getContenuCoverImage($simContenu);
            $simContenu->author_photo_url = $this->getUserPhotoUrl($simContenu->auteur);
            return $simContenu;
        });

    $auteurStats = [
        'contenus' => $contenu->auteur ? Contenu::where('id_auteur', $contenu->auteur->id)->where('statut', 'validé')->count() : 0,
        'followers' => rand(1000, 15000),
        'total_likes' => rand(5000, 30000),
        'inscrit_depuis' => $contenu->auteur && $contenu->auteur->date_inscription ? \Carbon\Carbon::parse($contenu->auteur->date_inscription)->diffForHumans() : 'plus d\'un an',
    ];

    // SIMPLIFICATION : Pas d'interactions réelles, juste pour l'affichage
    $userInteractions = [
        'has_liked' => false,
        'has_favorited' => false,
        'is_following' => false
    ];

    // Ajouter les URLs aux images du contenu
    $contenu->cover_image = $this->getContenuCoverImage($contenu);
    $contenu->author_photo_url = $this->getUserPhotoUrl($contenu->auteur);
    $contenu->media_urls = $contenu->medias->map(function($media) {
        return [
            'url' => $this->getImageUrl($media->chemin),
            'description' => $media->description,
            'type' => $media->id_type_media
        ];
    })->toArray();

    // Ajoutez un prix fictif pour le contenu
    $contenu->prix_fictif = rand(5, 20); // Prix entre 5€ et 20€

    // Types de contenus qui sont "premium" (exemples)
    $premiumTypes = [1, 2, 4, 5]; // Vodoun, Art, Histoire, Musique

    $isPremium = in_array($contenu->id_type_contenu, $premiumTypes);
    $hasAccess = true; // Pour l'instant, tout le monde a accès


     return view('front.contenu', [
        'contenu' => $contenu,
        'stats' => $stats,
        'readingTime' => $readingTime,
        'contenusSimilaires' => $contenusSimilaires,
        'auteurStats' => $auteurStats,
        'typeIcons' => $this->typeIcons,
        'isPremium' => $isPremium,
        'hasAccess' => $hasAccess,
        'userInteractions' => $userInteractions
    ]);
}
// Nouvelle méthode pour vérifier si c'est un contenu premium
private function isPremiumContent($contenu)
{
    // Logique pour déterminer si c'est premium
    // Vous pouvez ajouter un champ 'is_premium' dans la table contenus
    return isset($contenu->is_premium) ? $contenu->is_premium : false;

    // Ou basé sur le type de contenu
    // $premiumTypes = [1, 2, 3]; // IDs des types premium
    // return in_array($contenu->id_type_contenu, $premiumTypes);
}

// Nouvelle méthode pour vérifier l'accès utilisateur
private function userHasAccess($user, $contenu)
{
    if (!$this->isPremiumContent($contenu)) {
        return true; // Contenu gratuit
    }

    // Vérifier si l'utilisateur a acheté ce contenu
    $purchase = DB::table('achats')
        ->where('utilisateur_id', $user->id)
        ->where('contenu_id', $contenu->id_contenu)
        ->where('statut', 'completed')
        ->first();

    return $purchase !== null;
}

// Nouvelle méthode pour récupérer les stats de l'auteur
private function getAuthorStats($auteur)
{
    if (!$auteur) {
        return [
            'contenus' => 0,
            'followers' => 0,
            'total_likes' => 0,
            'inscrit_depuis' => 'Date inconnue',
            'rating' => 0,
            'is_premium_author' => false
        ];
    }

    $followersCount = DB::table('followers')
        ->where('following_id', $auteur->id)
        ->count();

    // Calculer la note moyenne
    $rating = DB::table('contenus')
        ->where('id_auteur', $auteur->id)
        ->avg('rating') ?? 0;

    return [
        'contenus' => Contenu::where('id_auteur', $auteur->id)
            ->where('statut', 'validé')
            ->count(),
        'followers' => $followersCount,
        'total_likes' => DB::table('likes')
            ->join('contenus', 'likes.contenu_id', '=', 'contenus.id_contenu')
            ->where('contenus.id_auteur', $auteur->id)
            ->count(),
        'inscrit_depuis' => $auteur->date_inscription
            ? \Carbon\Carbon::parse($auteur->date_inscription)->diffForHumans()
            : 'plus d\'un an',
        'rating' => round($rating, 1),
        'is_premium_author' => $auteur->is_premium_author ?? false
    ];
}

// Nouvelle méthode pour obtenir le prix
private function getContentPrice($contenu)
{
    // Logique de prix
    // Vous pouvez stocker le prix dans la table contenus
    return $contenu->prix ?? 5; // 5€ par défaut
}

    // ... (gardez les autres méthodes existantes)

    // ============ MÉTHODES PRIVÉES ============

    private function addFictiveStats($contenu)
    {
        $typeName = $contenu->typeContenu->nom_contenu ?? 'Histoire';
        $typeFactor = $this->getContentTypeFactor($typeName);

        $baseViews = rand($this->fictiveStats['min_views'], $this->fictiveStats['max_views']);
        $views = $baseViews * $typeFactor;
        $views = $this->roundToRealisticNumber($views);

        $likeRate = rand($this->fictiveStats['like_rate_min'] * 100, $this->fictiveStats['like_rate_max'] * 100) / 100;
        $commentRate = rand($this->fictiveStats['comment_rate_min'] * 100, $this->fictiveStats['comment_rate_max'] * 100) / 100;
        $favoriteRate = rand($this->fictiveStats['favorite_rate_min'] * 100, $this->fictiveStats['favorite_rate_max'] * 100) / 100;
        $shareRate = rand($this->fictiveStats['share_rate_min'] * 100, $this->fictiveStats['share_rate_max'] * 100) / 100;

        $contenu->vues_count = $views;
        $contenu->likes_count = (int) ($views * $likeRate);
        $contenu->commentaires_count = (int) ($views * $commentRate);
        $contenu->favorites_count = (int) ($views * $favoriteRate);
        $contenu->shares_count = (int) ($views * $shareRate);

        $contenu->engagement_rate = round(($contenu->likes_count + $contenu->commentaires_count) / max(1, $views) * 100, 1);

        return $contenu;
    }

    private function getContentTypeFactor($typeName)
    {
        $factors = [
            'Vodoun' => 1.8, 'Histoire' => 1.5, 'Gastronomie' => 1.7, 'Musique' => 2.0,
            'Danse' => 1.9, 'Art' => 1.4, 'Architecture' => 1.3, 'Traditions' => 1.6,
            'Langues' => 1.2, 'Coutumes' => 1.5
        ];
        return $factors[$typeName] ?? 1.4;
    }

    private function roundToRealisticNumber($number)
    {
        if ($number < 1000) return round($number / 10) * 10;
        elseif ($number < 10000) return round($number / 100) * 100;
        elseif ($number < 100000) return round($number / 1000) * 1000;
        else return round($number / 10000) * 10000;
    }

    private function getTypeConfig($typeId)
    {
        return $this->typeIcons[$typeId] ?? ['icon' => 'bi-grid', 'color' => '#6C757D', 'nom' => 'Général'];
    }

    /**
 * Afficher la page de connexion
 */
public function connexion()
{
    if (Auth::check()) {
        return redirect()->route('dashboard.index');
    }

    return view('front.connexion');
}

/**
 * Afficher la page d'inscription
 */
public function inscription()
{
    if (Auth::check()) {
        return redirect()->route('dashboard.index')->with('info', 'Vous êtes déjà connecté.');
    }

    $langues = Langue::orderBy('nom_langue')->get();
    return view('front.inscription', compact('langues'));
}

/**
 * Traiter la connexion
 */
public function connexionPost(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($request->only('email', 'password'), $request->remember)) {
        $request->session()->regenerate();
        $user = Auth::user();

        // Redirection selon le rôle
        if ($user->id_role == 1 || $user->id_role == 2) { // Admin/Modérateur
            return redirect()->route('admin.tableaudebord');
        }

        return redirect()->route('dashboard.index')
            ->with('success', 'Connexion réussie ! Bienvenue sur Bénin Culture.');
    }

    return back()->withErrors([
        'email' => 'Les identifiants fournis ne correspondent pas à nos enregistrements.',
    ])->onlyInput('email');
}

/**
 * Traiter l'inscription
 */
public function inscriptionPost(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'prenom' => 'nullable|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'date_naissance' => 'nullable|date',
        'sexe' => 'required|in:M,F',
        'id_langue' => 'nullable|exists:langues,id_langue',
        'terms' => 'required',
        'photo' => 'nullable|image|max:2048',
    ]);

    // Créer l'utilisateur
    $userData = [
        'name' => $request->name,
        'prenom' => $request->prenom,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'sexe' => $request->sexe,
        'date_naissance' => $request->date_naissance,
        'id_langue' => $request->id_langue,
        'id_role' => 3, // Contributeur
        'statut' => 'actif',
        'date_inscription' => now(),
    ];

    // Gérer la photo
    if ($request->hasFile('photo')) {
        $photoPath = $request->file('photo')->store('public/users');
        $userData['photo'] = str_replace('public/', '', $photoPath);
    }

    $user = User::create($userData);

    // Connecter automatiquement l'utilisateur
    Auth::login($user);

    return redirect()->route('dashboard.index')
        ->with('success', 'Inscription réussie ! Bienvenue sur Bénin Culture.');
}

/**
 * Afficher la page À propos
 */
public function apropos()
{
    $stats = [
        'total_contenus' => Contenu::where('statut', 'validé')->count(),
        'total_utilisateurs' => User::where('statut', 'actif')->count(),
        'total_regions' => Region::count(),
        'total_types' => TypeContenu::count(),
    ];

    $equipe = [
        [
            'name' => 'Admin Principal',
            'role' => 'Administrateur',
            'description' => 'Gestion générale de la plateforme',
            'icon' => 'bi-person-badge'
        ],
        [
            'name' => 'Modérateur Culturel',
            'role' => 'Modérateur',
            'description' => 'Validation des contenus culturels',
            'icon' => 'bi-shield-check'
        ],
        [
            'name' => 'Expert Régional',
            'role' => 'Contributeur Expert',
            'description' => 'Spécialiste des traditions locales',
            'icon' => 'bi-geo-alt'
        ],
        [
            'name' => 'Historien',
            'role' => 'Contributeur',
            'description' => 'Documentation historique',
            'icon' => 'bi-book'
        ]
    ];

    $objectifs = [
        [
            'title' => 'Préservation',
            'description' => 'Sauvegarder le patrimoine culturel béninois',
            'icon' => 'bi-archive'
        ],
        [
            'title' => 'Accessibilité',
            'description' => 'Rendre la culture accessible à tous',
            'icon' => 'bi-globe'
        ],
        [
            'title' => 'Éducation',
            'description' => 'Éduquer les générations futures',
            'icon' => 'bi-mortarboard'
        ],
        [
            'title' => 'Innovation',
            'description' => 'Combiner tradition et technologie',
            'icon' => 'bi-lightbulb'
        ]
    ];

    return view('front.apropos', compact('stats', 'equipe', 'objectifs'));
}

/**
 * Déconnexion
 */
public function deconnexion(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/')->with('success', 'Vous avez été déconnecté avec succès.');
}


// Dans votre PaiementController ou FrontController
public function boutiqueIndex(Request $request)
{
    // Offres flash (si vous en voulez)
    $flashOffers = [
        [
            'id' => 'flash1',
            'name' => 'Offre Spéciale Noël',
            'price' => '9.99',
            'old_price' => '19.99',
            'savings' => 50,
            'features' => [
                'Accès à tous les contenus',
                'Certificat numérique',
                'Guide exclusif',
                'Support prioritaire'
            ],
            'remaining' => 15,
            'progress' => 60
        ]
    ];

    // Contenu à l'unité (si passé en paramètre)
    $singleContent = null;
    if ($request->has('contenu_id')) {
        $singleContent = Contenu::where('id_contenu', $request->contenu_id)
            ->where('statut', 'validé')
            ->first();
    }

    return view('front.boutique.index', [
        'flashOffers' => $flashOffers,
        'singleContent' => $singleContent
    ]);
}
}
