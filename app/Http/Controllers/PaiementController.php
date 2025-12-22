<?php
// app/Http/Controllers/PaiementController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PaiementController extends Controller
{
    /**
     * Page principale de la boutique
     */
    public function index(Request $request)
    {
        $abonnements = [
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
                'description_courte' => 'Idéal pour commencer'
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
                'description_courte' => 'Le choix populaire'
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
                'description_courte' => 'Pour les experts'
            ]
        ];

        return view('front.boutique.index', compact('abonnements'));
    }

    /**
     * Page de choix d'abonnement
     */
    public function choisir()
    {
        if (!Auth::check()) {
            return redirect()->route('front.connexion')
                ->with('info', 'Connectez-vous pour choisir un abonnement');
        }

        $abonnements = [
            [
                'id' => 1,
                'nom' => 'Découverte',
                'prix' => 2500,
                'devise' => 'FCFA',
                'icon' => 'bi-rocket-takeoff'
            ],
            [
                'id' => 2,
                'nom' => 'Passionné',
                'prix' => 5000,
                'devise' => 'FCFA',
                'icon' => 'bi-stars'
            ],
            [
                'id' => 3,
                'nom' => 'Professionnel',
                'prix' => 10000,
                'devise' => 'FCFA',
                'icon' => 'bi-award'
            ]
        ];

        return view('front.boutique.choisir', compact('abonnements'));
    }

    /**
     * Traiter le choix de l'abonnement
     */
    public function processChoix(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('front.connexion')
                ->with('error', 'Connectez-vous pour continuer');
        }

        $request->validate([
            'id_abonnement' => 'required|in:1,2,3',
            'period' => 'required|in:monthly,yearly,lifetime'
        ]);

        // Sauvegarder en session
        $abonnement = $this->getAbonnementById($request->id_abonnement);
        $prix = $this->calculatePrice($abonnement['prix'], $request->period);
        $duree_jours = $this->calculateDuration($request->period);
        $prix_mensuel = $this->calculateMonthlyPrice($prix, $request->period);

        $achat = [
            'type' => 'abonnement',
            'id' => $abonnement['id'],
            'nom' => $abonnement['nom'],
            'prix' => $prix,
            'prix_mensuel' => $prix_mensuel,
            'prix_original' => $abonnement['prix'],
            'devise' => $abonnement['devise'],
            'period' => $request->period,
            'duree_jours' => $duree_jours,
            'icon' => $abonnement['icon'] ?? 'bi-star'
        ];

        session(['achat_choisi' => $achat]);

        return redirect()->route('paiement.formulaire');
    }

    /**
     * Page de paiement
     */
    public function formulaire()
    {
        if (!Auth::check()) {
            return redirect()->route('front.connexion')
                ->with('error', 'Connectez-vous pour payer');
        }

        if (!session()->has('achat_choisi')) {
            return redirect()->route('boutique.choisir')
                ->with('warning', 'Veuillez choisir un abonnement d\'abord');
        }

        $achat = session('achat_choisi');
        $user = Auth::user();

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
            return redirect()->route('boutique.index');
        }

        $achat = session('achat_choisi');
        $user = Auth::user();

        // SIMULER un paiement réussi
        $reference = 'PAY_' . date('Ymd') . '_' . strtoupper(uniqid());

        // Enregistrer la transaction
        $this->createTransaction($user, $achat, $reference, 'completed');

        // Activer l'abonnement
        $this->activateSubscription($user, $achat);

        // Nettoyer la session
        session()->forget('achat_choisi');

        return redirect()->route('paiement.success', ['reference' => $reference]);
    }

    /**
     * Page de succès
     */
    public function success($reference)
    {
        if (!Auth::check()) {
            return redirect()->route('front.connexion');
        }

        // Récupérer la transaction
        $transaction = \App\Models\Transaction::where('reference', $reference)
            ->where('user_id', Auth::id())
            ->first();

        if (!$transaction) {
            return redirect()->route('dashboard.index')
                ->with('error', 'Transaction non trouvée');
        }

        $paiement = [
            'reference' => $transaction->reference,
            'date' => $transaction->created_at->format('d/m/Y H:i'),
            'montant' => number_format($transaction->amount, 0, ',', ' ') . ' ' . $transaction->currency,
            'statut' => $transaction->status,
            'description' => $transaction->description
        ];

        return view('front.boutique.success', compact('paiement'));
    }

    /**
     * Méthodes utilitaires
     */
    private function getAbonnementById($id)
    {
        $abonnements = [
            1 => [
                'id' => 1,
                'nom' => 'Découverte',
                'prix' => 2500,
                'devise' => 'FCFA',
                'icon' => 'bi-rocket-takeoff'
            ],
            2 => [
                'id' => 2,
                'nom' => 'Passionné',
                'prix' => 5000,
                'devise' => 'FCFA',
                'icon' => 'bi-stars'
            ],
            3 => [
                'id' => 3,
                'nom' => 'Professionnel',
                'prix' => 10000,
                'devise' => 'FCFA',
                'icon' => 'bi-award'
            ]
        ];

        return $abonnements[$id] ?? $abonnements[1];
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
            'lifetime' => round($totalPrice / 1200), // Sur 100 ans
            default => $totalPrice
        };
    }

    private function calculateDuration($period)
    {
        return match($period) {
            'monthly' => 30,
            'yearly' => 365,
            'lifetime' => 36500, // 100 ans
            default => 30
        };
    }

    private function createTransaction($user, $achat, $reference, $status = 'pending')
    {
        if (!class_exists(\App\Models\Transaction::class)) {
            return;
        }

        \App\Models\Transaction::create([
            'user_id' => $user->id,
            'reference' => $reference,
            'amount' => $achat['prix'],
            'currency' => $achat['devise'],
            'description' => 'Abonnement ' . $achat['nom'],
            'status' => $status,
            'metadata' => json_encode([
                'abonnement_id' => $achat['id'],
                'period' => $achat['period'],
                'duree_jours' => $achat['duree_jours']
            ])
        ]);
    }

    private function activateSubscription($user, $achat)
    {
        if (!class_exists(\App\Models\UserSubscription::class)) {
            return;
        }

        $dateFin = now()->addDays($achat['duree_jours']);

        \App\Models\UserSubscription::updateOrCreate(
            ['user_id' => $user->id],
            [
                'abonnement_id' => $achat['id'],
                'type' => $achat['period'],
                'date_debut' => now(),
                'date_fin' => $dateFin,
                'statut' => 'actif',
                'montant' => $achat['prix']
            ]
        );
    }
}
