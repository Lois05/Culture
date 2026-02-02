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

class FrontController extends Controller
{
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

    // ============ PAGE ACCUEIL ============
    public function index()
    {
        $stats = [
            'total_regions' => Region::count(),
            'total_contenus' => Contenu::where('statut', 'validé')->count(),
            'total_utilisateurs' => User::where('statut', 'actif')->count(),
            'total_types' => TypeContenu::count(),
        ];

        $contenusPopulaires = Contenu::with(['typeContenu', 'region', 'auteur', 'medias'])
            ->where('statut', 'validé')
            ->orderBy('date_creation', 'desc')
            ->limit(6)
            ->get()
            ->map(function($contenu) {
                $contenu->main_image = $this->getContenuMainImage($contenu);
                $contenu->reading_time = ceil(str_word_count(strip_tags($contenu->texte)) / 200);
                $typeConfig = $this->getTypeConfig($contenu->typeContenu->id_type_contenu ?? 1);
                $contenu->type_icon = $typeConfig['icon'];
                $contenu->type_color = $typeConfig['color'];
                return $contenu;
            });

        return view('front.home', compact('stats', 'contenusPopulaires'));
    }

    // ============ PAGE EXPLORER ============
    public function explorer(Request $request)
    {
        $typesContenus = TypeContenu::all();
        $regions = Region::all();

        $query = Contenu::with(['typeContenu', 'region', 'auteur', 'medias'])
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
                  ->orWhere('texte', 'like', '%' . $searchTerm . '%');
            });
        }

        $contenus = $query->orderBy('date_creation', 'desc')->paginate(12);

        $contenus->getCollection()->transform(function($contenu) {
            $contenu->main_image = $this->getContenuMainImage($contenu);
            $contenu->reading_time = ceil(str_word_count(strip_tags($contenu->texte)) / 200);
            $typeConfig = $this->getTypeConfig($contenu->typeContenu->id_type_contenu ?? 1);
            $contenu->icon = $typeConfig['icon'];
            $contenu->color = $typeConfig['color'];
            return $contenu;
        });

        return view('front.explorer', compact('contenus', 'typesContenus', 'regions'));
    }

    // ============ PAGE CONTENU AVEC UPSELL ============
    public function contenu($id)
    {
        $contenu = Contenu::with(['typeContenu', 'region', 'auteur', 'medias'])
            ->findOrFail($id);

        // Vérifier publication
        if ($contenu->statut !== 'validé' && !(Auth::check() && Auth::user()->isAdmin())) {
            abort(404);
        }
        $user = Auth::user();

        // Vérifier l'accès
        $hasAccess = true;
        $previewContent = null;

        if ($contenu->is_premium) {
            if ($user) {
                $hasAccess = $user->canAccessContent($contenu);
            } else {
                $hasAccess = false;
            }

            if (!$hasAccess) {
                $previewContent = $this->generateTeaser($contenu->texte, 40);
            }
        }

        // Statistiques fictives
        $stats = $this->generateFakeStats($contenu);

        // Contenus similaires
        $similar = Contenu::where('id_type_contenu', $contenu->id_type_contenu)
            ->where('id_contenu', '!=', $id)
            ->where('statut', 'publié')
            ->take(3)
            ->get();

        // Offres d'abonnement pour l'upsell
        $abonnements = [];
        if (!$hasAccess && $contenu->is_premium) {
            $abonnements = $this->getUpsellPlans($contenu);
        }

        // Social proof
        $socialProof = [
            'current_readers' => rand(5, 25),
            'unlocked_today' => rand(20, 100),
            'total_readers' => $stats['views'] + rand(1000, 5000),
        ];

        return view('front.contenu', compact(
            'contenu',
            'hasAccess',
            'previewContent',
            'stats',
            'similar',
            'abonnements',
            'user',
            'socialProof'
        ));
    }

    // ============ DÉBLOQUER UN ARTICLE ============
    public function unlockArticle(Request $request, $id)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('front.connexion')
                ->with('message', 'Connectez-vous pour débloquer cet article');
        }

        $plan = $request->input('plan', 'single');

        // Stocker en session pour la redirection
        session([
            'unlock_article_id' => $id,
            'plan_type' => $plan,
            'redirect_to' => route('front.contenu', $id)
        ]);

        // Rediriger vers le paiement
        if ($plan === 'single') {
            return redirect()->route('boutique.paiement.article', $id);
        } else {
            return redirect()->route('boutique.choisir', ['plan' => $plan]);
        }
    }

    // ============ MÉTHODES UTILITAIRES ============
    private function getContenuMainImage($contenu)
    {
        if (!$contenu->medias->isEmpty()) {
            $firstMedia = $contenu->medias->first();
            return asset($firstMedia->chemin);
        }
        return asset('adminlte/img/collage.png');
    }

    private function getTypeConfig($typeId)
    {
        return $this->typeIcons[$typeId] ?? [
            'icon' => 'bi-grid',
            'color' => '#6C757D',
            'nom' => 'Général'
        ];
    }

    private function generateTeaser($text, $percentage = 40)
    {
        $words = str_word_count(strip_tags($text), 2);
        $totalWords = count($words);
        $previewWords = ceil(($percentage / 100) * $totalWords);

        $preview = array_slice($words, 0, $previewWords);
        return implode(' ', $preview) . '...';
    }

    private function generateFakeStats($contenu)
    {
        $wordCount = str_word_count(strip_tags($contenu->texte));
        $readingTime = ceil($wordCount / 200);

        return [
            'views' => rand(1000, 50000),
            'likes' => rand(100, 5000),
            'favorites' => rand(50, 1000),
            'comments' => rand(10, 500),
            'current_readers' => rand(5, 50),
            'reading_time' => $readingTime,
        ];
    }

    private function getUpsellPlans($contenu)
    {
        return [
            [
                'id' => 1,
                'name' => 'Découverte',
                'price' => 2900,
                'period' => 'mois',
                'features' => ['10 articles/mois', 'Cet article inclus'],
                'cta' => 'Commencer avec Découverte',
                'color' => 'primary',
                'icon' => 'rocket',
                'slug' => 'decouverte'
            ],
            [
                'id' => 2,
                'name' => 'Passionné',
                'price' => 7900,
                'period' => 'mois',
                'features' => ['Articles illimités', 'Téléchargements HD', 'Support prioritaire'],
                'cta' => 'Choisir Passionné',
                'color' => 'warning',
                'icon' => 'fire',
                'popular' => true,
                'slug' => 'passionne'
            ],
            [
                'id' => 'single',
                'name' => 'Cet article seul',
                'price' => 990,
                'period' => 'une fois',
                'features' => ['Accès permanent', 'Téléchargement PDF'],
                'cta' => 'Acheter cet article',
                'color' => 'secondary',
                'icon' => 'book',
                'slug' => 'single'
            ]
        ];
    }

    // ============ AUTHENTIFICATION ============
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

// Dans FrontController.php - méthode connexionPost
public function connexionPost(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($request->only('email', 'password'), $request->remember)) {
        $request->session()->regenerate();
        $user = Auth::user();

        $roleName = $user->role->nom_role ?? null;

        if (in_array($roleName, ['Administrateur', 'Modérateur'])) {
            // ⚠️ CORRECTION : Utilisez 'admin.tableaudebord' (pas 'admin.admin.tableaudebord')
            return redirect()->route('admin.tableaudebord')
                ->with('success', 'Connexion admin réussie !');
        }

        return redirect()->route('dashboard.index')
            ->with('success', 'Connexion réussie !');
    }

    return back()->withErrors([
        'email' => 'Identifiants incorrects.',
    ])->onlyInput('email');
}

    public function inscriptionPost(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'terms' => 'required',
        ]);

        $userData = [
            'name' => $request->name,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_role' => 3,
            'statut' => 'actif',
            'date_inscription' => now(),
        ];

        $user = User::create($userData);
        Auth::login($user);

        return redirect()->route('dashboard.index')
            ->with('success', 'Inscription réussie !');
    }

    public function apropos()
    {
        return view('front.apropos');
    }

    public function deconnexion(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Déconnexion réussie.');
    }

    // ============ RÉGIONS ============
    public function regions()
    {
        $regions = Region::withCount(['contenus' => function($query) {
                $query->where('statut', 'validé');
            }])
            ->orderBy('nom_region', 'asc')
            ->get();

        $stats = [
            'total_regions' => $regions->count(),
            'total_contenus' => $regions->sum('contenus_count'),
            'total_utilisateurs' => User::where('statut', 'actif')->count(),
            'total_types' => TypeContenu::count(),
        ];

        return view('front.regions', [
            'regions' => $regions,
            'stats' => $stats,
            'typeIcons' => $this->typeIcons
        ]);
    }

    public function region($slug)
    {
        $region = Region::where('nom_region', 'like', '%' . str_replace('-', ' ', $slug) . '%')
                        ->firstOrFail();

        $contenus = Contenu::with(['typeContenu', 'auteur', 'medias'])
            ->where('id_region', $region->id_region)
            ->where('statut', 'validé')
            ->orderBy('date_creation', 'desc')
            ->paginate(12);

        $contenus->getCollection()->transform(function($contenu) {
            $contenu->main_image = $this->getContenuMainImage($contenu);
            $contenu->reading_time = ceil(str_word_count(strip_tags($contenu->texte)) / 200);
            $typeConfig = $this->getTypeConfig($contenu->typeContenu->id_type_contenu ?? 1);
            $contenu->icon = $typeConfig['icon'];
            $contenu->color = $typeConfig['color'];
            return $contenu;
        });

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
    // Clés supplémentaires avec valeurs par défaut
    'langues_count' => $region->contenus()
        ->where('statut', 'validé')
        ->distinct('id_langue')
        ->count('id_langue'),
    'festivals_count' => 0, // Ou votre logique de calcul
    'sites_count' => 0, // Ou votre logique de calcul
];

        return view('front.region-content', compact(
            'region',
            'contenus',
            'stats'
        ));
    }
}
