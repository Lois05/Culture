<?php
// app/Http/Controllers/PaiementController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Abonnement;
use App\Models\Paiement;
use App\Models\Facture;
use App\Models\Contenu;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class PaiementController extends Controller
{
    /**
     * Page d'accueil boutique
     */
    public function index()
    {
        Log::info('=== PAGE BOUTIQUE INDEX ===');

        try {
            // Récupérer les abonnements actifs
            $abonnements = Abonnement::where('statut', 'actif')
                ->orderBy('prix', 'asc')
                ->get();

            // Si pas d'abonnements, créer des données de démo
            if ($abonnements->isEmpty()) {
                $abonnements = collect([
                    (object) [
                        'id' => 1,
                        'nom' => 'Découverte',
                        'prix' => 2500,
                        'devise' => 'FCFA',
                        'duree_jours' => 30,
                        'description_courte' => 'Idéal pour commencer',
                        'features' => json_encode([
                            '5 contenus premium par mois',
                            'Accès aux contenus gratuits',
                            'Support par email'
                        ])
                    ],
                    (object) [
                        'id' => 2,
                        'nom' => 'Passionné',
                        'prix' => 5000,
                        'devise' => 'FCFA',
                        'duree_jours' => 30,
                        'description_courte' => 'Le choix de 85% de nos membres',
                        'features' => json_encode([
                            'Contenus premium illimités',
                            'Accès aux masters class',
                            'Téléchargements HD',
                            'Support prioritaire'
                        ])
                    ],
                    (object) [
                        'id' => 3,
                        'nom' => 'Professionnel',
                        'prix' => 10000,
                        'devise' => 'FCFA',
                        'duree_jours' => 30,
                        'description_courte' => 'Pour institutions et entreprises',
                        'features' => json_encode([
                            'Tous les avantages Passionné',
                            'Licence commerciale',
                            'Formations personnalisées',
                            'Support dédié 24/7'
                        ])
                    ]
                ]);
            }

            // Récupérer un contenu premium aléatoire pour l'achat unitaire
            $singleContent = Contenu::where('is_premium', true)
                ->inRandomOrder()
                ->first();

            Log::info('Abonnements trouvés: ' . $abonnements->count());

            return view('front.boutique.index', compact('abonnements', 'singleContent'));

        } catch (\Exception $e) {
            Log::error('Erreur page boutique: ' . $e->getMessage());
            return view('front.boutique.error', [
                'error' => 'Erreur technique: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Traiter le choix (abonnement, pack ou contenu unique)
     */
    public function processChoix(Request $request)
    {
        Log::info('=== PROCESS CHOIX ===');
        Log::info('Données reçues:', $request->all());

        // Validation selon le type
        if ($request->has('id_abonnement')) {
            $request->validate([
                'id_abonnement' => 'required|exists:abonnements,id',
            ]);

            $type = 'abonnement';
            $item = Abonnement::findOrFail($request->id_abonnement);
            $itemData = [
                'type' => 'abonnement',
                'id' => $item->id,
                'nom' => $item->nom,
                'prix' => $item->prix,
                'devise' => $item->devise ?? 'FCFA',
                'duree_jours' => $item->duree_jours,
                'description' => $item->description,
            ];

        } elseif ($request->has('contenu_id')) {
            $request->validate([
                'contenu_id' => 'required|exists:contenus,id_contenu',
                'type' => 'required|in:single'
            ]);

            $type = 'contenu_single';
            $item = Contenu::findOrFail($request->contenu_id);
            $itemData = [
                'type' => 'contenu_single',
                'id' => $item->id_contenu,
                'titre' => $item->titre,
                'prix' => $item->prix ?? 9.99,
                'devise' => 'EUR',
                'description' => $item->description,
            ];

        } elseif ($request->has('type') && $request->type == 'pack') {
            $request->validate([
                'pack_name' => 'required|string',
                'pack_price' => 'required|numeric',
            ]);

            $type = 'pack';
            $itemData = [
                'type' => 'pack',
                'nom' => $request->pack_name,
                'prix' => $request->pack_price,
                'devise' => 'FCFA',
                'description' => 'Pack de 10 contenus premium au choix',
            ];

        } else {
            return redirect()->route('boutique.index')
                ->with('error', 'Type d\'achat non reconnu');
        }

        try {
            // Sauvegarder dans la session
            session([
                'achat_choisi' => $itemData
            ]);

            Log::info('Achat choisi en session:', session('achat_choisi'));

            // Rediriger vers le paiement
            return redirect()->route('paiement.formulaire');

        } catch (\Exception $e) {
            Log::error('Erreur choix achat: ' . $e->getMessage());
            return redirect()->route('boutique.index')
                ->with('error', 'Erreur lors du choix: ' . $e->getMessage());
        }
    }

    /**
     * Page de formulaire de paiement
     */
    public function formulaire()
    {
        Log::info('=== AFFICHAGE FORMULAIRE PAIEMENT ===');

        if (!session()->has('achat_choisi')) {
            Log::warning('Pas d\'achat choisi en session');
            return redirect()->route('boutique.index')
                ->with('error', 'Veuillez choisir un produit d\'abord');
        }

        $achat = session('achat_choisi');
        Log::info('Achat en session:', $achat);

        return view('front.boutique.paiement', compact('achat'));
    }

    /**
     * Traiter le paiement
     */
    public function processPaiement(Request $request)
    {
        Log::info('=== PROCESS PAIEMENT ===');
        Log::info('Données reçues:', $request->except(['_token']));

        // Vérifier l'achat en session
        if (!session()->has('achat_choisi')) {
            Log::error('Achat non trouvé en session');
            return redirect()->route('boutique.index')
                ->with('error', 'Session expirée. Veuillez choisir un produit à nouveau.');
        }

        $achat = session('achat_choisi');
        $user = Auth::user();

        // Démarrer une transaction
        DB::beginTransaction();

        try {
            // Générer une référence unique
            $reference = 'PAY_' . date('Ymd') . '_' . strtoupper(Str::random(8));

            // Créer le paiement
            $paiement = Paiement::create([
                'user_id' => $user->id,
                'transaction_id' => null, // À remplir après FedaPay
                'reference' => $reference,
                'montant' => $achat['prix'],
                'devise' => $achat['devise'],
                'statut' => 'en_attente',
                'service' => $achat['type'] == 'abonnement' ? 'abonnement' : 'contenu',
                'type_service' => $achat['type'],
                'metadata' => json_encode([
                    'achat_details' => $achat,
                    'user_info' => [
                        'name' => $user->name,
                        'email' => $user->email,
                        'phone' => $user->telephone ?? null
                    ]
                ]),
            ]);

            Log::info('Paiement créé avec ID:', ['id' => $paiement->id]);

            // ICI: INTÉGRER FEDAPAY
            // Pour l'instant, simuler un paiement réussi
            $transactionId = 'FEDAPAY_' . strtoupper(Str::random(16));

            // Mettre à jour le paiement
            $paiement->transaction_id = $transactionId;
            $paiement->statut = 'payé';
            $paiement->date_paiement = now();
            $paiement->save();

            // Si c'est un abonnement, mettre à jour l'utilisateur
            if ($achat['type'] == 'abonnement') {
                $abonnement = Abonnement::find($achat['id']);
                if ($abonnement) {
                    $user->id_abonnement = $abonnement->id;
                    $user->date_debut_abonnement = now();
                    $user->date_fin_abonnement = now()->addDays($abonnement->duree_jours);
                    $user->statut_abonnement = 'actif';
                    $user->save();
                }
            }

            // Si c'est un contenu unique, lier à l'utilisateur
            if ($achat['type'] == 'contenu_single') {
                // Ici, vous pourriez avoir une table user_contenus
                // Pour l'instant, on met dans les métadonnées
                $metadata = json_decode($paiement->metadata, true);
                $metadata['contenu_id'] = $achat['id'];
                $paiement->metadata = json_encode($metadata);
                $paiement->save();
            }

            // Nettoyer la session
            session()->forget('achat_choisi');

            // Valider la transaction
            DB::commit();

            // Rediriger vers la confirmation
            return redirect()->route('paiement.success', $paiement->id)
                ->with('success', 'Paiement effectué avec succès!');

        } catch (\Exception $e) {
            // Annuler la transaction en cas d'erreur
            DB::rollBack();

            Log::error('Erreur paiement: ' . $e->getMessage());
            Log::error('Trace: ' . $e->getTraceAsString());

            return redirect()->route('paiement.formulaire')
                ->with('error', 'Erreur lors du paiement: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Page de succès/confirmation
     */
    public function success($id)
    {
        Log::info('=== PAGE SUCCESS PAIEMENT ===', ['id' => $id]);

        try {
            // Charger le paiement
            $paiement = Paiement::findOrFail($id);

            // Vérifier que le paiement appartient à l'utilisateur connecté
            if ($paiement->user_id !== Auth::id()) {
                abort(403, 'Accès non autorisé');
            }

            Log::info('Affichage succès pour paiement ID: ' . $paiement->id);

            return view('front.boutique.success', compact('paiement'));

        } catch (\Exception $e) {
            Log::error('Erreur page success: ' . $e->getMessage());
            return redirect()->route('dashboard.index')
                ->with('error', 'Paiement non trouvé: ' . $e->getMessage());
        }
    }

    // app/Http/Controllers/PaiementController.php

/**
 * Page de choix d'abonnement (si vous voulez une page intermédiaire)
 */
public function choisir()
{
    Log::info('=== PAGE CHOISIR ABONNEMENT ===');

    try {
        $abonnements = Abonnement::where('statut', 'actif')
            ->orderBy('prix', 'asc')
            ->get();

        if ($abonnements->isEmpty()) {
            Log::warning('Aucun abonnement actif trouvé');
            return redirect()->route('boutique.index')
                ->with('warning', 'Aucun abonnement disponible pour le moment.');
        }

        Log::info('Abonnements pour choisir: ' . $abonnements->count());

        return view('front.boutique.choisir', compact('abonnements'));

    } catch (\Exception $e) {
        Log::error('Erreur page choisir: ' . $e->getMessage());
        return redirect()->route('boutique.index')
            ->with('error', 'Erreur technique: ' . $e->getMessage());
    }
}
}
