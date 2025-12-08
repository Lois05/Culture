<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contenu;
use App\Models\User;
use App\Models\Region;
use App\Models\TypeContenu;
use App\Models\Langue;
use App\Models\Media;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    /**
     * Afficher le tableau de bord principal
     */
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter.');
        }

        // Récupérer l'utilisateur avec ses relations
        $userWithRelations = User::with(['role', 'langue'])->find($user->id);

        if (!$userWithRelations) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Utilisateur non trouvé.');
        }

        // AJOUTEZ CETTE LIGNE
        $typesContenu = TypeContenu::all();

        // Statistiques
        $stats = [
            'total_contributions' => Contenu::where('id_auteur', $user->id)->count(),
            'total_likes_received' => $this->generateFictiveLikeCount(
                Contenu::where('id_auteur', $user->id)->count()
            ),
            'total_comments_received' => $this->generateFictiveCommentCount(
                Contenu::where('id_auteur', $user->id)->count()
            ),
            'total_likes_given' => 0,
            'total_views' => $this->generateFictiveViewsCount($user->id),
        ];

        // Dernières contributions
        $recent_contributions = Contenu::with(['typeContenu', 'region'])
            ->where('id_auteur', $user->id)
            ->orderBy('date_creation', 'desc')
            ->limit(5)
            ->get()
            ->map(function($contenu) {
                return $this->addFictiveStatsToContent($contenu);
            });

        // Contenus les plus populaires
        $popular_contents = Contenu::with(['typeContenu'])
            ->where('id_auteur', $user->id)
            ->get()
            ->map(function($contenu) {
                $contenu = $this->addFictiveStatsToContent($contenu);
                $contenu->popularity_score = ($contenu->vues_count * 0.5) +
                                           ($contenu->likes_count * 2) +
                                           ($contenu->commentaires_count * 1.5);
                return $contenu;
            })
            ->sortByDesc('popularity_score')
            ->take(5);

        $recent_likes = collect([]);

        return view('front.dashboard.index', [
            'user' => $userWithRelations,
            'stats' => $stats,
            'recent_contributions' => $recent_contributions,
            'popular_contents' => $popular_contents,
            'recent_likes' => $recent_likes,
            'typesContenu' => $typesContenu // AJOUTEZ CETTE LIGNE
        ]);
    }

    /**
     * Afficher les contributions de l'utilisateur
     */
    public function contributions()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Récupérer toutes les contributions de l'utilisateur
        $contributions = Contenu::with(['typeContenu', 'region', 'langue'])
            ->where('id_auteur', $user->id)
            ->orderBy('date_creation', 'desc')
            ->paginate(10);

        // Ajouter les statistiques fictives
        $contributions->getCollection()->transform(function($contenu) {
            return $this->addFictiveStatsToContent($contenu);
        });

        // Récupérer tous les types de contenu pour le filtre
        $types = TypeContenu::all();

        $stats = [
            'total_contributions' => Contenu::where('id_auteur', $user->id)->count(),
            'published_contributions' => Contenu::where('id_auteur', $user->id)->count(),
            'pending_contributions' => 0,
            'rejected_contributions' => 0,
        ];

        return view('front.dashboard.contributions', [
            'user' => $user,
            'contributions' => $contributions,
            'types' => $types,
            'stats' => $stats
        ]);
    }

    /**
     * Afficher les contenus aimés
     */
    public function likes()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Simuler des contenus aimés (fictifs pour l'instant)
        $likedContents = Contenu::with(['typeContenu', 'region', 'auteur'])
            ->inRandomOrder()
            ->limit(9)
            ->get()
            ->map(function($contenu) {
                $contenu = $this->addFictiveStatsToContent($contenu);
                $contenu->liked_at = now()->subDays(rand(1, 30));
                return $contenu;
            })
            ->sortByDesc('liked_at');

        $stats = [
            'total_likes_given' => count($likedContents),
            'most_liked_category' => $likedContents->groupBy('typeContenu.nom_contenu')
                ->sortByDesc('count')
                ->keys()
                ->first() ?? 'Aucune',
        ];

        return view('front.dashboard.likes', [
            'user' => $user,
            'likedContents' => $likedContents,
            'stats' => $stats
        ]);
    }

    /**
     * Afficher la page des paramètres
     */
    public function settings()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Charger les données nécessaires pour les paramètres
        $regions = Region::all();
        $langues = Langue::all();
        $typesContenu = TypeContenu::all();

        return view('front.dashboard.settings', [
            'user' => $user,
            'regions' => $regions,
            'langues' => $langues,
            'typesContenu' => $typesContenu
        ]);
    }

    /**
     * Afficher la page de contribution
     */
    public function contribuer()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Charger les données pour le formulaire
        $regions = Region::orderBy('nom_region')->get();
        $langues = Langue::orderBy('nom_langue')->get();
        $typesContenu = TypeContenu::all();

        return view('front.dashboard.contribuer', [
            'user' => $user,
            'regions' => $regions,
            'langues' => $langues,
            'typesContenu' => $typesContenu
        ]);
    }

    /**
     * TRAITER la soumission de contribution (MÉTHODE IMPORTANTE MANQUANTE)
     */
    public function storeContribution(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter.');
        }

        // Validation
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'texte' => 'required|string|min:50',
            'id_region' => 'required|exists:regions,id_region',
            'id_langue' => 'nullable|exists:langues,id_langue',
            'id_type_contenu' => 'required|exists:type_contenus,id_type_contenu',
            'media_file' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp,mp4,avi,mov,mkv,webm,mp3,wav,ogg,aac|max:102400',
            'mots_cles' => 'nullable|string|max:500',
            'terms' => 'required|accepted',
        ]);

        try {
            // Créer le contenu
            $contenu = Contenu::create([
                'titre' => $validated['titre'],
                'texte' => $validated['texte'],
                'id_region' => $validated['id_region'],
                'id_langue' => $validated['id_langue'] ?? null,
                'id_type_contenu' => $validated['id_type_contenu'],
                'statut' => 'en_attente',
                'id_auteur' => $user->id,
                'date_creation' => now(),
                'mots_cles' => $validated['mots_cles'] ?? null,
            ]);

            // Upload du média
            if ($request->hasFile('media_file')) {
                $file = $request->file('media_file');
                $path = $file->store('medias', 'public');

                $extension = strtolower($file->getClientOriginalExtension());
                $typesVideo = ['mp4', 'avi', 'mov', 'mkv', 'webm'];
                $typesAudio = ['mp3', 'wav', 'ogg', 'aac'];

                if (in_array($extension, $typesVideo)) {
                    $id_type_media = 2;
                } elseif (in_array($extension, $typesAudio)) {
                    $id_type_media = 3;
                } else {
                    $id_type_media = 1;
                }

                Media::create([
                    'chemin' => $path,
                    'description' => 'Média pour: ' . $validated['titre'],
                    'id_type_media' => $id_type_media,
                    'id_contenu' => $contenu->id_contenu
                ]);
            }

            return redirect()->route('dashboard.contributions')
                ->with('success', 'Votre contribution a été soumise avec succès ! Elle est en attente de validation.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur: ' . $e->getMessage());
        }
    }

  
    /**
     * Méthodes utilitaires fictives
     */
    private function generateFictiveViewsCount($userId)
    {
        $contributionsCount = Contenu::where('id_auteur', $userId)->count();
        if ($contributionsCount == 0) return 0;
        $base = $contributionsCount * rand(100, 1000);
        return $this->roundToRealisticNumber($base);
    }

    private function generateFictiveLikeCount($contributionsCount)
    {
        if ($contributionsCount == 0) return 0;
        $base = $contributionsCount * rand(5, 20);
        return $this->roundToRealisticNumber($base);
    }

    private function generateFictiveCommentCount($contributionsCount)
    {
        if ($contributionsCount == 0) return 0;
        $base = $contributionsCount * rand(2, 8);
        return $this->roundToRealisticNumber($base);
    }

    private function addFictiveStatsToContent($contenu)
    {
        $fictiveStats = [
            'min_views' => 300,
            'max_views' => 50000,
            'like_rate_min' => 0.05,
            'like_rate_max' => 0.15,
            'comment_rate_min' => 0.01,
            'comment_rate_max' => 0.05,
        ];

        $typeFactors = [
            'Vodoun' => 1.8, 'Histoire' => 1.5, 'Gastronomie' => 1.7,
            'Musique' => 2.0, 'Danse' => 1.9, 'Art' => 1.4,
            'Architecture' => 1.3, 'Traditions' => 1.6,
            'Langues' => 1.2, 'Coutumes' => 1.5
        ];

        $typeName = $contenu->typeContenu->nom_contenu ?? 'Histoire';
        $typeFactor = $typeFactors[$typeName] ?? 1.4;

        $baseViews = rand($fictiveStats['min_views'], $fictiveStats['max_views']);
        $views = $baseViews * $typeFactor;
        $views = $this->roundToRealisticNumber($views);

        $likeRate = rand($fictiveStats['like_rate_min'] * 100, $fictiveStats['like_rate_max'] * 100) / 100;
        $commentRate = rand($fictiveStats['comment_rate_min'] * 100, $fictiveStats['comment_rate_max'] * 100) / 100;

        $contenu->vues_count = $views;
        $contenu->likes_count = (int) ($views * $likeRate);
        $contenu->commentaires_count = (int) ($views * $commentRate);
        $contenu->engagement_rate = round(($contenu->likes_count + $contenu->commentaires_count) / max(1, $views) * 100, 1);

        $wordCount = str_word_count(strip_tags($contenu->texte ?? ''));
        $contenu->reading_time = max(1, ceil($wordCount / 200));

        return $contenu;
    }

    private function roundToRealisticNumber($number)
    {
        if ($number < 1000) return round($number / 10) * 10;
        elseif ($number < 10000) return round($number / 100) * 100;
        elseif ($number < 100000) return round($number / 1000) * 1000;
        else return round($number / 10000) * 10000;
    }
}
