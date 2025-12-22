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
     * Récupérer l'URL correcte pour une image (Version simplifiée pour public/adminlte/img/)
     */
    private function getImageUrl($path)
    {
        if (!$path || trim($path) === '') {
            return asset('adminlte/img/collage.png');
        }

        // Si c'est déjà une URL complète
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        // Extraire juste le nom du fichier (gère tous les formats)
        $filename = basename($path);

        // Vérifier si le fichier existe dans public/adminlte/img/
        $imagePath = 'adminlte/img/' . $filename;

        if (file_exists(public_path($imagePath))) {
            return asset($imagePath);
        }

        // Si non trouvé, essayer d'autres chemins
        $possiblePaths = [
            'adminlte/img/' . $filename,
            $filename, // juste le nom
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
    }

    /**
     * Récupérer l'URL de la photo de profil
     */
  /**
 * Récupérer l'URL de la photo de profil
 */
private function getUserPhotoUrl($user)
{
    if (!$user || !$user->photo || trim($user->photo) === '') {
        return null;
    }

    // Extraire juste le nom du fichier
    $filename = basename($user->photo);

    // Chercher dans public/adminlte/img/
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

    return null; // Pas de photo
}

    /**
     * Récupérer la première image d'un contenu
     */
    private function getContenuMainImage($contenu)
    {
        if (!$contenu || !$contenu->medias || $contenu->medias->isEmpty()) {
            return asset('adminlte/img/collage.png');
        }

        $firstMedia = $contenu->medias->first();
        if (!$firstMedia || !$firstMedia->chemin) {
            return asset('adminlte/img/collage.png');
        }

        return $this->getImageUrl($firstMedia->chemin);
    }

    /**
     * Récupérer toutes les images d'un contenu
     */
    private function getContenuAllImages($contenu)
    {
        if (!$contenu || !$contenu->medias || $contenu->medias->isEmpty()) {
            return [asset('adminlte/img/collage.png')];
        }

        return $contenu->medias->map(function($media) {
            return $this->getImageUrl($media->chemin);
        })->toArray();
    }

    public function index()
    {
        $stats = [
            'total_regions' => Region::count(),
            'total_contenus' => Contenu::where('statut', 'validé')->count(),
            'total_utilisateurs' => User::where('statut', 'actif')->count(),
            'total_types' => TypeContenu::count(),
        ];

        // Contenus populaires
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

                // Images réelles depuis la base
                $contenu->main_image = $this->getContenuMainImage($contenu);
                $contenu->all_images = $this->getContenuAllImages($contenu);
                $contenu->author_photo_url = $this->getUserPhotoUrl($contenu->auteur);

                // Calcul du temps de lecture
                $wordCount = str_word_count(strip_tags($contenu->texte ?? ''));
                $contenu->reading_time = max(1, ceil($wordCount / 200));

                // Type config
                $typeConfig = $this->getTypeConfig($contenu->typeContenu->id_type_contenu ?? 1);
                $contenu->type_icon = $typeConfig['icon'];
                $contenu->type_color = $typeConfig['color'];

                return $contenu;
            });

        // Derniers contenus
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
                $contenu->main_image = $this->getContenuMainImage($contenu);
                 // Photo de l'auteur
        if ($contenu->auteur) {
            $contenu->author_photo = $this->getUserPhotoUrl($contenu->auteur);
            $contenu->author_name = $contenu->auteur->prenom . ' ' . $contenu->auteur->name;
            $contenu->author_initials = strtoupper(
                substr($contenu->auteur->prenom ?? '', 0, 1) .
                substr($contenu->auteur->name ?? '', 0, 1)
            );
        } else {
            $contenu->author_photo = null;
            $contenu->author_name = 'Anonyme';
            $contenu->author_initials = 'A';
        }
                return $contenu;
            });

        // Régions populaires
      $regionsPopulaires = Region::withCount(['contenus' => function($query) {
            $query->where('statut', 'validé');
        }])
        ->orderBy('contenus_count', 'desc')
        ->limit(6)
        ->get();

    // Ajoutez cette variable pour la timeline
    $periods = [
        [
            'icon' => 'bi-castle',
            'title' => 'Royaumes pré-coloniaux',
            'period' => 'Avant 1894',
            'color' => 'primary',
            'image' => 'royaumeabo.webp',
            'content' => 'Les grands royaumes de Danxomè, Porto-Novo et divers royaumes Yoruba établissent les fondements de la culture béninoise moderne avec leurs systèmes politiques, artistiques et spirituels complexes.',
        ],
        [
            'icon' => 'bi-flag',
            'title' => 'Période coloniale',
            'period' => '1894-1960',
            'color' => 'secondary',
            'image' => 'ancientemps.jpg',
            'content' => 'Le Dahomey français marque une période de transformation culturelle, avec l\'introduction de nouvelles langues, systèmes éducatifs et structures administratives qui influenceront durablement la société.',
        ],
        [
            'icon' => 'bi-star',
            'title' => 'Indépendance',
            'period' => '1960-1972',
            'color' => 'accent',
            'image' => 'independancegraph.jpg',
            'content' => 'Le 1er août 1960, le Dahomey accède à l\'indépendance. Une période de construction nationale et de redéfinition identitaire s\'ensuit, avec la recherche d\'un équilibre entre tradition et modernité.',
        ],
        [
            'icon' => 'bi-arrow-repeat',
            'title' => 'Renaissance culturelle',
            'period' => '1972-1990',
            'color' => 'warning',
            'image' => 'renaissance.webp',
            'content' => 'La période révolutionnaire met l\'accent sur la valorisation des cultures locales, avec des réformes éducatives et culturelles visant à promouvoir les langues et traditions nationales.',
        ],
        [
            'icon' => 'bi-globe',
            'title' => 'Bénin contemporain',
            'period' => '1990 à aujourd\'hui',
            'color' => 'success',
            'image' => 'contemporain.webp',
            'content' => 'Le renouveau démocratique ouvre une ère de revitalisation culturelle, avec une reconnaissance internationale croissante du patrimoine béninois et un dynamisme artistique et intellectuel remarquable.',
        ],
    ];

    return view('front.home', compact(
        'stats',
        'contenusPopulaires',
        'derniersContenus',
        'regionsPopulaires',
        'periods' // N'oubliez pas d'ajouter cette variable
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
                'medias',
                'langue'
            ])
            ->where('statut', 'validé');

        // Filtres
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

        // Tri
        $sort = $request->get('sort', 'recent');
        switch ($sort) {
            case 'popular':
                $query->orderBy('date_creation', 'desc');
                break;
            case 'title':
                $query->orderBy('titre', 'asc');
                break;
            default:
                $query->orderBy('date_creation', 'desc');
                break;
        }

        $totalContenus = (clone $query)->count();
        $contenus = $query->paginate(12);

        // Transformer les résultats
        $contenus->getCollection()->transform(function($contenu) {
            $this->addFictiveStats($contenu);

            // Configuration du type
            $typeConfig = $this->getTypeConfig($contenu->typeContenu->id_type_contenu ?? 1);
            $contenu->icon = $typeConfig['icon'];
            $contenu->color = $typeConfig['color'];

            // Calculs
            $wordCount = str_word_count(strip_tags($contenu->texte ?? ''));
            $contenu->reading_time = max(1, ceil($wordCount / 200));

            // Images réelles depuis la base
            $contenu->main_image = $this->getContenuMainImage($contenu);
            $contenu->all_images = $this->getContenuAllImages($contenu);
             // Photo de l'auteur
        if ($contenu->auteur) {
            $contenu->author_photo = $this->getUserPhotoUrl($contenu->auteur);
            $contenu->author_name = $contenu->auteur->prenom . ' ' . $contenu->auteur->name;
            $contenu->author_initials = strtoupper(
                substr($contenu->auteur->prenom ?? '', 0, 1) .
                substr($contenu->auteur->name ?? '', 0, 1)
            );
        } else {
            $contenu->author_photo = null;
            $contenu->author_name = 'Anonyme';
            $contenu->author_initials = 'A';
        }
            return $contenu;
        });

        // Compter les contenus par type
        $typeCounts = [];
        foreach ($typesContenus as $type) {
            $typeCounts[$type->id_type_contenu] = Contenu::where('id_type_contenu', $type->id_type_contenu)
                ->where('statut', 'validé')
                ->count();
        }

        // Icônes simplifiées pour la vue
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
    // Récupérer toutes les régions avec statistiques
    $regions = Region::withCount(['contenus' => function($query) {
            $query->where('statut', 'validé');
        }])
        ->with(['contenus' => function($query) {
            $query->where('statut', 'validé')
                  ->with('typeContenu')
                  ->orderBy('date_creation', 'desc')
                  ->limit(5);
        }])
        ->orderBy('nom_region', 'asc')
        ->get()
        ->map(function($region) {
            // Calculer le nombre de contributeurs uniques
            $contributeurs = $region->contenus()
                ->where('statut', 'validé')
                ->distinct('id_auteur')
                ->count('id_auteur');

            $region->contributeurs_count = $contributeurs;

            // Types de contenus par région
            $types = $region->contenus()
                ->where('statut', 'validé')
                ->with('typeContenu')
                ->get()
                ->groupBy('id_type_contenu')
                ->map(function ($group) {
                    return [
                        'type_id' => $group->first()->id_type_contenu,
                        'nom' => $group->first()->typeContenu->nom_contenu ?? 'Inconnu',
                        'count' => $group->count()
                    ];
                })
                ->values()
                ->toArray();

            $region->types_contenus = $types;

            return $region;
        });

    // Statistiques globales
    $stats = [
        'total_regions' => $regions->count(),
        'total_contenus' => $regions->sum('contenus_count'),
        'total_utilisateurs' => User::where('statut', 'actif')->count(),
        'total_types' => TypeContenu::count(),
    ];

    // Types de contenus
    $typesContenus = TypeContenu::all();

    // Toutes les langues
    $allLangues = Langue::orderBy('nom_langue')->get();

    // Langues par région (simulées)
    $regionLangues = [];
    $commonLanguages = ['Fon', 'Yoruba', 'Français', 'Bariba', 'Dendi', 'Gun', 'Adja'];

    foreach ($regions as $region) {
        $numLanguages = rand(2, 4);
        shuffle($commonLanguages);
        $regionLangues[$region->id_region] = array_slice($commonLanguages, 0, $numLanguages);
    }

    // Types par région
    $typesCountByRegion = [];
    foreach ($regions as $region) {
        $typesCountByRegion[$region->id_region] = $region->types_contenus;
    }

    // Utiliser un tableau associatif au lieu de compact()
    return view('front.regions', [
        'regions' => $regions,
        'stats' => $stats,
        'typesContenus' => $typesContenus,
        'allLangues' => $allLangues,
        'regionLangues' => $regionLangues,
        'typesCountByRegion' => $typesCountByRegion,
        'typeIcons' => $this->typeIcons
    ]);
}

    public function region($slug)
    {
        // Trouver la région par son slug ou nom
        $region = Region::where('nom_region', 'like', '%' . str_replace('-', ' ', $slug) . '%')
                        ->firstOrFail();

        // Récupérer les contenus de cette région
        $contenus = Contenu::with([
                'typeContenu',
                'auteur',
                'medias',
                'langue'
            ])
            ->where('id_region', $region->id_region)
            ->where('statut', 'validé')
            ->orderBy('date_creation', 'desc')
            ->paginate(12);

        // Transformer les résultats avec les vraies images
        $contenus->getCollection()->transform(function($contenu) {
            $this->addFictiveStats($contenu);

            // Configuration du type
            $typeConfig = $this->getTypeConfig($contenu->typeContenu->id_type_contenu ?? 1);
            $contenu->icon = $typeConfig['icon'];
            $contenu->color = $typeConfig['color'];
            $contenu->type_name = $typeConfig['nom'];

            // Images réelles depuis la base
            $contenu->main_image = $this->getContenuMainImage($contenu);
            $contenu->all_images = $this->getContenuAllImages($contenu);
            $contenu->author_photo_url = $this->getUserPhotoUrl($contenu->auteur);

            // Calculs
            $wordCount = str_word_count(strip_tags($contenu->texte ?? ''));
            $contenu->reading_time = max(1, ceil($wordCount / 200));

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
            'langues_count' => count($this->getRegionLanguages($region)),
            'groupes_count' => rand(3, 8),
            'festivals_count' => rand(2, 10),
            'sites_count' => rand(1, 5),
        ];

        // Types de contenus dans cette région
        $types = TypeContenu::withCount(['contenus' => function($query) use ($region) {
                $query->where('id_region', $region->id_region)
                      ->where('statut', 'validé');
            }])
            ->orderBy('contenus_count', 'desc')
            ->get()
            ->map(function($type) {
                $typeConfig = $this->getTypeConfig($type->id_type_contenu);
                $type->icon = $typeConfig['icon'];
                $type->color = $typeConfig['color'];
                return $type;
            });

        // Contributeurs actifs
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
            ->limit(8)
            ->get()
            ->map(function($user) {
                $user->followers_count = rand(50, 5000);
                $user->total_contributions = $user->contenus_count;
                $user->rating = rand(40, 50) / 10;
                $user->photo_url = $this->getUserPhotoUrl($user);
                return $user;
            });

        // Traditions de la région
        $traditions = [
            [
                'title' => 'Le Vodoun',
                'description' => 'Religion traditionnelle animiste pratiquée depuis des siècles, classée au patrimoine mondial de l\'UNESCO.',
                'tags' => ['Spiritualité', 'Cérémonies', 'Patrimoine UNESCO'],
                'icon' => 'bi-magic',
                'color' => '#E8112D'
            ],
            [
                'title' => 'Bas-reliefs d\'Abomey',
                'description' => 'Art unique au monde racontant l\'histoire du royaume du Danhomè à travers des sculptures murales.',
                'tags' => ['Artisanat', 'Patrimoine', 'Sculpture'],
                'icon' => 'bi-brush',
                'color' => '#0D6EFD'
            ],
            [
                'title' => 'Guelédé & Zangbeto',
                'description' => 'Masques cérémoniels représentant des figures mythologiques et sociales importantes.',
                'tags' => ['Danses', 'Masques', 'Cérémonies'],
                'icon' => 'bi-person-arms-up',
                'color' => '#20C997'
            ],
            [
                'title' => 'Festivals Traditionnels',
                'description' => 'Célébrations annuelles marquant les récoltes, les événements historiques et les rites de passage.',
                'tags' => ['Festivals', 'Célébrations', 'Communauté'],
                'icon' => 'bi-calendar3',
                'color' => '#6610F2'
            ]
        ];

        // Langues parlées
        $langues = $this->getRegionLanguages($region);

        // Données pour la carte
        $regionCoordinates = [
            'lat' => 9.3077 + (($region->id_region - 6) * 0.8),
            'lng' => 2.3158 + (($region->id_region - 6) * 0.5),
        ];

        return view('front.region-content', compact(
            'region',
            'contenus',
            'stats',
            'types',
            'contributeurs',
            'traditions',
            'langues',
            'regionCoordinates'
        ));
    }

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

        // Stats fictives
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

        // Temps de lecture
        $wordCount = str_word_count(strip_tags($contenu->texte ?? ''));
        $readingTime = max(3, ceil($wordCount / 200));

        // Contenus similaires
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
                $simContenu->main_image = $this->getContenuMainImage($simContenu);
                $simContenu->author_photo_url = $this->getUserPhotoUrl($simContenu->auteur);
                return $simContenu;
            });

        // Stats auteur
        $auteurStats = [
            'contenus' => $contenu->auteur ? Contenu::where('id_auteur', $contenu->auteur->id)->where('statut', 'validé')->count() : 0,
            'followers' => rand(1000, 15000),
            'total_likes' => rand(5000, 30000),
            'inscrit_depuis' => $contenu->auteur && $contenu->auteur->date_inscription ? \Carbon\Carbon::parse($contenu->auteur->date_inscription)->diffForHumans() : 'plus d\'un an',
        ];

        // Images réelles du contenu
        $contenu->main_image = $this->getContenuMainImage($contenu);
        $contenu->author_photo_url = $this->getUserPhotoUrl($contenu->auteur);
        $contenu->all_images = $this->getContenuAllImages($contenu);

        // Format des médias
        $contenu->media_urls = $contenu->medias->map(function($media) {
            return [
                'url' => $this->getImageUrl($media->chemin),
                'description' => $media->description,
                'type' => $media->id_type_media
            ];
        })->toArray();

        // Interactions utilisateur
        $userInteractions = [
            'has_liked' => false,
            'has_favorited' => false,
            'is_following' => false
        ];

        return view('front.contenu', [
            'contenu' => $contenu,
            'stats' => $stats,
            'readingTime' => $readingTime,
            'contenusSimilaires' => $contenusSimilaires,
            'auteurStats' => $auteurStats,
            'typeIcons' => $this->typeIcons,
            'userInteractions' => $userInteractions
        ]);
    }

    /**
     * ============ MÉTHODES PRIVÉES ============
     */

    /**
     * Get type configuration
     */
    private function getTypeConfig($typeId)
    {
        return $this->typeIcons[$typeId] ?? [
            'icon' => 'bi-grid',
            'color' => '#6C757D',
            'nom' => 'Général'
        ];
    }

    /**
     * Méthode auxiliaire pour les langues de la région
     */
    private function getRegionLanguages($region)
    {
        $defaultLangues = [
            1 => ['Fon', 'Yoruba', 'Français'],
            2 => ['Fon', 'Yoruba', 'Français'],
            3 => ['Fon', 'Yoruba'],
            4 => ['Ifè', 'Yoruba', 'Mahi'],
            5 => ['Yoruba', 'Gun'],
            6 => ['Yoruba', 'Ifè'],
            7 => ['Bariba', 'Dendi', 'Fulfulde'],
            8 => ['Bariba', 'Dendi', 'Fulfulde'],
            9 => ['Xwla', 'Houéda', 'Fon'],
            10 => ['Fon', 'Adja'],
            11 => ['Ditammari', 'Berba', 'Waama'],
            12 => ['Ditammari', 'Berba', 'Waama'],
        ];
        return $defaultLangues[$region->id_region] ?? ['Fon', 'Français'];
    }

    /**
     * Ajouter des statistiques fictives
     */
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

    /**
     * Facteur selon le type de contenu
     */
    private function getContentTypeFactor($typeName)
    {
        $factors = [
            'Vodoun' => 1.8, 'Histoire' => 1.5, 'Gastronomie' => 1.7, 'Musique' => 2.0,
            'Danse' => 1.9, 'Art' => 1.4, 'Architecture' => 1.3, 'Traditions' => 1.6,
            'Langues' => 1.2, 'Coutumes' => 1.5
        ];
        return $factors[$typeName] ?? 1.4;
    }

    /**
     * Arrondir les nombres pour qu'ils paraissent réels
     */
    private function roundToRealisticNumber($number)
    {
        if ($number < 1000) return round($number / 10) * 10;
        elseif ($number < 10000) return round($number / 100) * 100;
        elseif ($number < 100000) return round($number / 1000) * 1000;
        else return round($number / 10000) * 10000;
    }

    /**
     * ============ MÉTHODES D'AUTHENTIFICATION ============
     */

    public function connexion()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard.index');
        }

        return view('front.connexion');
    }

    public function inscription()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard.index')->with('info', 'Vous êtes déjà connecté.');
        }

        $langues = Langue::orderBy('nom_langue')->get();
        return view('front.inscription', compact('langues'));
    }

    public function connexionPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->remember)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->id_role == 1 || $user->id_role == 2) {
                return redirect()->route('admin.tableaudebord');
            }

            return redirect()->route('dashboard.index')
                ->with('success', 'Connexion réussie ! Bienvenue sur Bénin Culture.');
        }

        return back()->withErrors([
            'email' => 'Les identifiants fournis ne correspondent pas à nos enregistrements.',
        ])->onlyInput('email');
    }

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

        $userData = [
            'name' => $request->name,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'sexe' => $request->sexe,
            'date_naissance' => $request->date_naissance,
            'id_langue' => $request->id_langue,
            'id_role' => 3,
            'statut' => 'actif',
            'date_inscription' => now(),
        ];

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('public/users');
            $userData['photo'] = str_replace('public/', '', $photoPath);
        }

        $user = User::create($userData);
        Auth::login($user);

        return redirect()->route('dashboard.index')
            ->with('success', 'Inscription réussie ! Bienvenue sur Bénin Culture.');
    }

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

    public function deconnexion(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Vous avez été déconnecté avec succès.');
    }
}
