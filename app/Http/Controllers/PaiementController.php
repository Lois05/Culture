<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Contenu;
use App\Models\Transaction;
use App\Models\Abonnement;
use App\Models\UserSubscription;

class PaiementController extends Controller
{
    /**
     * Page principale de la boutique
     */
    public function index()
    {
        // Récupérer les abonnements actifs depuis la base de données
        $abonnements = Abonnement::where('statut', 'actif')
            ->orderBy('prix')
            ->get()
            ->map(function($abonnement) {
                return [
                    'id' => $abonnement->id,
                    'nom' => $abonnement->nom,
                    'prix' => $abonnement->prix,
                    'prix_mensuel' => $abonnement->prix,
                    'devise' => 'FCFA',
                    'description' => $abonnement->description ?? 'Abonnement premium',
                    'features_list' => $this->getFeaturesByAbonnement($abonnement->id),
                    'couleur' => $this->getColorByAbonnement($abonnement->id),
                    'icon' => $this->getIconByAbonnement($abonnement->id),
                    'slug' => strtolower(str_replace(' ', '-', $abonnement->nom)),
                    'duree_jours' => $abonnement->duree_jours ?? 30,
                    'recommandé' => $abonnement->recommandé ?? false
                ];
            })
            ->toArray();

        // Si pas d'abonnements en base, utiliser les données par défaut
        if (empty($abonnements)) {
            $abonnements = $this->getDefaultAbonnements();
        }

        return view('front.boutique.index', compact('abonnements'));
    }

    /**
     * Traiter le choix de l'abonnement (POST) - Version simplifiée
     */
    public function processChoix(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('front.connexion')
                ->with('error', 'Connectez-vous pour choisir un abonnement');
        }

        $request->validate([
            'id_abonnement' => 'required|exists:abonnements,id',
            'period' => 'required|in:monthly,yearly,lifetime'
        ]);

        // Sauvegarder en session
        session([
            'selected_abonnement_id' => $request->id_abonnement,
            'selected_period' => $request->period,
            'selection_time' => now()
        ]);

        // Rediriger vers la page de détails
        return redirect()->route('boutique.choisir', [
            'id' => $request->id_abonnement,
            'period' => $request->period
        ]);
    }

    /**
     * Page de détails de l'abonnement choisi (GET)
     */
    public function choisir(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('front.connexion')
                ->with('info', 'Connectez-vous pour voir les détails de l\'offre');
        }

        // Récupérer les paramètres
        $abonnementId = $request->input('id', session('selected_abonnement_id', 1));
        $period = $request->input('period', session('selected_period', 'monthly'));

        // Vérifier que l'abonnement existe
        $abonnement = Abonnement::where('id', $abonnementId)
            ->where('statut', 'actif')
            ->first();

        if (!$abonnement) {
            // Fallback sur les données par défaut
            $defaultAbonnements = $this->getDefaultAbonnements();
            $abonnementData = collect($defaultAbonnements)->firstWhere('id', $abonnementId);

            if (!$abonnementData) {
                return redirect()->route('boutique.index')
                    ->with('error', 'Abonnement non trouvé');
            }

            $abonnement = (object) $abonnementData;
        }

        // Calculer les prix
        $prix = $this->calculatePrice($abonnement->prix, $period);
        $prixMensuel = $this->calculateMonthlyPrice($prix, $period);
        $dureeJours = $this->calculateDuration($period, $abonnement->duree_jours ?? 30);

        // Préparer les données de l'achat
        $achat = [
            'type' => 'abonnement',
            'id' => $abonnement->id,
            'nom' => $abonnement->nom,
            'prix' => $prix,
            'prix_mensuel' => $prixMensuel,
            'devise' => 'FCFA',
            'period' => $period,
            'duree_jours' => $dureeJours,
            'icon' => $this->getIconByAbonnement($abonnement->id),
            'description' => $abonnement->description ?? 'Abonnement premium',
            'features' => $this->getFeaturesByAbonnement($abonnement->id),
            'recommandé' => $abonnement->recommandé ?? false
        ];

        // Sauvegarder en session pour paiement
        session(['achat_choisi' => $achat]);

        // Vérifier si c'est pour débloquer un article spécifique
        $articleId = session('unlock_article_id');
        $contenu = $articleId ? Contenu::find($articleId) : null;

        return view('front.boutique.choisir', compact('achat', 'contenu'));
    }

    /**
     * Page de paiement
     */
    public function paiement()
    {
        if (!Auth::check()) {
            return redirect()->route('front.connexion')
                ->with('error', 'Connectez-vous pour procéder au paiement');
        }

        if (!session()->has('achat_choisi')) {
            return redirect()->route('boutique.index')
                ->with('warning', 'Veuillez choisir un abonnement d\'abord');
        }

        $achat = session('achat_choisi');
        $user = Auth::user();

        // Vérifier si c'est un article unique
        if (isset($achat['type']) && $achat['type'] === 'article') {
            $contenu = Contenu::find($achat['id']);
            return view('front.boutique.paiement-article', compact('achat', 'user', 'contenu'));
        }

        return view('front.boutique.paiement', compact('achat', 'user'));
    }

    /**
     * Traiter le paiement
     */
    public function processPaiement(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('front.connexion');
        }

        if (!session()->has('achat_choisi')) {
            return redirect()->route('boutique.index')
                ->with('error', 'Aucun achat sélectionné');
        }

        $achat = session('achat_choisi');
        $user = Auth::user();

        // Vérifier si l'utilisateur a déjà cet abonnement
        if ($achat['type'] === 'abonnement') {
            $hasActiveSubscription = UserSubscription::where('user_id', $user->id)
                ->where('abonnement_id', $achat['id'])
                ->where('statut', 'actif')
                ->where('date_fin', '>', now())
                ->exists();

            if ($hasActiveSubscription) {
                return redirect()->route('boutique.index')
                    ->with('info', 'Vous avez déjà cet abonnement actif');
            }
        }

        // Générer une référence
        $reference = 'FEDA_' . date('YmdHis') . '_' . strtoupper(uniqid());

        // Créer la transaction
        $transaction = Transaction::create([
            'user_id' => $user->id,
            'reference' => $reference,
            'montant' => $achat['prix'],
            'devise' => $achat['devise'],
            'description' => $achat['type'] === 'abonnement'
                ? "Abonnement {$achat['nom']} ({$achat['period']})"
                : "Achat article: {$achat['nom']}",
            'statut' => 'pending',
            'type' => $achat['type'],
            'id_item' => $achat['id'],
            'metadata' => json_encode([
                'achat' => $achat,
                'user' => [
                    'id' => $user->id,
                    'email' => $user->email,
                    'nom' => $user->nom,
                    'prenom' => $user->prenom
                ]
            ])
        ]);

        // Rediriger vers Fedapay
        return redirect()->route('fedapay.process', [
            'reference' => $reference,
            'amount' => $achat['prix'],
            'currency' => $achat['devise'],
            'description' => $transaction->description
        ]);
    }

    /**
     * Page de succès
     */
    public function success(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('front.connexion');
        }

        $reference = $request->input('reference');

        // Chercher la transaction
        $transaction = $reference ? Transaction::where('reference', $reference)
            ->where('user_id', Auth::id())
            ->first() : null;

        $paiement = [
            'reference' => $reference ?? 'N/A',
            'date' => now()->format('d/m/Y H:i'),
            'montant' => session('achat_choisi')['prix'] ?? '0',
            'statut' => 'Payé',
            'description' => session('achat_choisi')['nom'] ?? 'Achat premium'
        ];

        // Nettoyer la session
        session()->forget(['achat_choisi', 'unlock_article_id', 'selected_abonnement_id', 'selected_period']);

        return view('front.boutique.success', compact('paiement'));
    }

    /**
     * Page d'échec
     */
    public function echec(Request $request)
    {
        $reference = $request->input('reference');

        if ($reference) {
            Transaction::where('reference', $reference)
                ->where('user_id', Auth::id())
                ->update(['statut' => 'failed']);
        }

        // Nettoyer la session
        session()->forget(['achat_choisi', 'unlock_article_id']);

        return view('front.boutique.echec', compact('reference'));
    }

    /**
     * Annuler l'achat
     */
    public function annuler()
    {
        // Nettoyer la session
        session()->forget(['achat_choisi', 'unlock_article_id', 'selected_abonnement_id', 'selected_period']);

        return redirect()->route('boutique.index')
            ->with('info', 'Achat annulé. Vous pouvez choisir une autre offre.');
    }

    /**
     * Acheter un article unique
     */
    public function acheterArticle($id)
    {
        if (!Auth::check()) {
            return redirect()->route('front.connexion')
                ->with('error', 'Connectez-vous pour acheter cet article');
        }

        $contenu = Contenu::findOrFail($id);
        $user = Auth::user();

        // Vérifier si déjà acheté
        if ($user->canAccessContent($contenu)) {
            return redirect()->route('front.contenu', $id)
                ->with('info', 'Vous avez déjà accès à cet article');
        }

        // Sauvegarder l'article en session
        session(['unlock_article_id' => $id]);

        // Créer l'objet achat
        $achat = [
            'type' => 'article',
            'id' => $id,
            'nom' => $contenu->titre,
            'prix' => $contenu->prix ?? 990,
            'prix_mensuel' => 0,
            'devise' => 'FCFA',
            'period' => 'once',
            'duree_jours' => 36500,
            'icon' => 'bi-book',
            'description' => "Achat unique : {$contenu->titre}",
            'features' => ['Accès permanent à cet article']
        ];

        session(['achat_choisi' => $achat]);

        return redirect()->route('boutique.paiement');
    }

    /**
     * Callback Fedapay
     */
    public function fedapayCallback(Request $request)
    {
        $reference = $request->input('reference');
        $status = $request->input('status', 'failed');

        // Chercher la transaction
        $transaction = Transaction::where('reference', $reference)->first();

        if (!$transaction) {
            Log::error('Transaction Fedapay non trouvée', ['reference' => $reference]);
            return redirect()->route('boutique.echec', ['reference' => $reference]);
        }

        // Mettre à jour le statut
        $transaction->update([
            'statut' => $status === 'success' ? 'completed' : 'failed',
            'date_paiement' => $status === 'success' ? now() : null,
            'metadata' => json_encode(array_merge(
                json_decode($transaction->metadata, true) ?? [],
                ['fedapay_callback' => $request->all()]
            ))
        ]);

        // Si succès, activer l'accès
        if ($status === 'success') {
            $metadata = json_decode($transaction->metadata, true);
            $achat = $metadata['achat'] ?? null;

            if ($achat) {
                $user = \App\Models\User::find($transaction->user_id);
                $this->activateAccess($user, $achat);
            }

            return redirect()->route('boutique.success', ['reference' => $reference]);
        }

        return redirect()->route('boutique.echec', ['reference' => $reference]);
    }

    /**
     * Méthodes utilitaires
     */

    private function getDefaultAbonnements()
    {
        return [
            [
                'id' => 1,
                'nom' => 'Découverte',
                'prix' => 2500,
                'prix_mensuel' => 2500,
                'devise' => 'FCFA',
                'description' => 'Parfait pour débuter',
                'features_list' => [
                    'Accès à 10 contenus premium/mois',
                    'Support par email',
                    'Certificat standard',
                    'Contenus en définition standard'
                ],
                'couleur' => '#667eea',
                'icon' => 'bi-rocket-takeoff',
                'slug' => 'decouverte',
                'duree_jours' => 30,
                'recommandé' => false
            ],
            [
                'id' => 2,
                'nom' => 'Passionné',
                'prix' => 5000,
                'prix_mensuel' => 5000,
                'devise' => 'FCFA',
                'description' => 'Le plus populaire',
                'features_list' => [
                    'Accès illimité aux contenus',
                    'Support prioritaire',
                    'Téléchargements HD',
                    'Certificat premium',
                    'Formations complètes',
                    'Accès aux archives'
                ],
                'couleur' => '#764ba2',
                'icon' => 'bi-stars',
                'slug' => 'passionne',
                'duree_jours' => 30,
                'recommandé' => true
            ],
            [
                'id' => 3,
                'nom' => 'Professionnel',
                'prix' => 10000,
                'prix_mensuel' => 10000,
                'devise' => 'FCFA',
                'description' => 'Pour les experts',
                'features_list' => [
                    'Licence commerciale',
                    'Support 24/7',
                    'Accès API',
                    'Formations personnalisées',
                    'Certificat expert',
                    'Accès aux données brutes',
                    'Consultations privées'
                ],
                'couleur' => '#2D3748',
                'icon' => 'bi-award',
                'slug' => 'professionnel',
                'duree_jours' => 30,
                'recommandé' => false
            ]
        ];
    }

    private function calculatePrice($basePrice, $period)
    {
        return match($period) {
            'monthly' => $basePrice,
            'yearly' => $basePrice * 10, // 10 mois payés pour 1 an
            'lifetime' => $basePrice * 50, // Prix à vie
            default => $basePrice
        };
    }

    private function calculateMonthlyPrice($totalPrice, $period)
    {
        return match($period) {
            'monthly' => $totalPrice,
            'yearly' => round($totalPrice / 12),
            'lifetime' => round($totalPrice / 1200),
            default => $totalPrice
        };
    }

    private function calculateDuration($period, $baseDuration = 30)
    {
        return match($period) {
            'monthly' => $baseDuration,
            'yearly' => 365,
            'lifetime' => 36500, // 100 ans
            default => $baseDuration
        };
    }

    private function getIconByAbonnement($abonnementId)
    {
        return match($abonnementId) {
            1 => 'bi-rocket-takeoff',
            2 => 'bi-stars',
            3 => 'bi-award',
            default => 'bi-star'
        };
    }

    private function getColorByAbonnement($abonnementId)
    {
        return match($abonnementId) {
            1 => '#667eea',
            2 => '#764ba2',
            3 => '#2D3748',
            default => '#667eea'
        };
    }

    private function getFeaturesByAbonnement($abonnementId)
    {
        return match($abonnementId) {
            1 => [
                'Accès à 10 contenus premium/mois',
                'Support par email',
                'Certificat standard',
                'Contenus en définition standard'
            ],
            2 => [
                'Accès illimité aux contenus',
                'Support prioritaire',
                'Téléchargements HD',
                'Certificat premium',
                'Formations complètes',
                'Accès aux archives'
            ],
            3 => [
                'Licence commerciale',
                'Support 24/7',
                'Accès API',
                'Formations personnalisées',
                'Certificat expert',
                'Accès aux données brutes',
                'Consultations privées'
            ],
            default => ['Accès aux contenus premium']
        };
    }

    private function activateAccess($user, $achat)
    {
        if ($achat['type'] === 'article') {
            \App\Models\Achat::create([
                'user_id' => $user->id,
                'contenu_id' => $achat['id'],
                'montant' => $achat['prix'],
                'statut' => 'payé',
                'date_achat' => now(),
                'reference' => uniqid('ART_')
            ]);
        }
        elseif ($achat['type'] === 'abonnement') {
            // Désactiver anciens abonnements
            UserSubscription::where('user_id', $user->id)
                ->where('statut', 'actif')
                ->update(['statut' => 'expired']);

            // Créer nouvel abonnement
            UserSubscription::create([
                'user_id' => $user->id,
                'abonnement_id' => $achat['id'],
                'date_debut' => now(),
                'date_fin' => now()->addDays($achat['duree_jours']),
                'statut' => 'actif',
                'montant' => $achat['prix'],
                'devise' => $achat['devise'],
                'period' => $achat['period'],
                'reference' => uniqid('SUB_')
            ]);

            // Mettre à jour l'utilisateur
            $user->update([
                'est_premium' => true,
                'premium_depuis' => now(),
                'premium_jusque' => now()->addDays($achat['duree_jours']),
                'id_abonnement' => $achat['id']
            ]);
        }
    }
}
