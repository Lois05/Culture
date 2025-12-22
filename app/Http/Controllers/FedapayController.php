<?php
// app/Http/Controllers/FedapayController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FedapayController extends Controller
{
    /**
     * Traiter le paiement avec FedaPay
     */
    public function process(Request $request)
    {
        $request->validate([
            'operator' => 'required|in:mtn,moov',
            'phone_number' => 'required|string|min:12|max:15'
        ]);

        // Récupérer l'achat depuis la session
        if (!session()->has('achat_choisi')) {
            return redirect()->route('boutique.choisir')
                ->with('error', 'Veuillez choisir un abonnement d\'abord');
        }

        $achat = session('achat_choisi');
        $user = Auth::user();

        // SIMULATION DE PAIEMENT (À REMPLACER PAR L'INTÉGRATION RÉELLE)
        // Pour l'instant, on simule un paiement réussi

        $reference = 'FEDAPAY_' . date('YmdHis') . '_' . strtoupper(uniqid());

        // Enregistrer la transaction dans la base de données
        // Créez cette table si elle n'existe pas
        // php artisan make:model Transaction -m

        \App\Models\Transaction::create([
            'user_id' => $user->id,
            'reference' => $reference,
            'amount' => $achat['prix'],
            'currency' => $achat['devise'],
            'operator' => $request->operator,
            'phone_number' => $request->phone_number,
            'description' => 'Abonnement ' . $achat['nom'],
            'status' => 'pending',
            'metadata' => json_encode([
                'abonnement_id' => $achat['id'],
                'period' => $achat['period'],
                'duree_jours' => $achat['duree_jours']
            ])
        ]);

        // SIMULER UN APPEL À L'API FEDAPAY
        // En production, utilisez le SDK FedaPay
        /*
        FedaPay::setApiKey(config('services.fedapay.secret_key'));
        FedaPay::setEnvironment(config('services.fedapay.mode'));

        $transaction = Transaction::create([
            'description' => 'Abonnement ' . $achat['nom'],
            'amount' => $achat['prix'],
            'currency' => ['iso' => 'XOF'],
            'callback_url' => route('paiement.fedapay.callback'),
            'customer' => [
                'email' => $user->email,
                'lastname' => $user->name,
                'phone_number' => $request->phone_number
            ]
        ]);

        $token = $transaction->generateToken();
        return redirect()->away($token->url);
        */

        // Pour l'instant, simuler un délai de paiement
        sleep(2);

        // Mettre à jour le statut de la transaction
        \App\Models\Transaction::where('reference', $reference)->update([
            'status' => 'completed',
            'completed_at' => now()
        ]);

        // Activer l'abonnement pour l'utilisateur
        $this->activateSubscription($user, $achat);

        // Rediriger vers la page de succès
        return redirect()->route('paiement.success', ['reference' => $reference])
            ->with('success', 'Paiement effectué avec succès !');
    }

    /**
     * Callback de FedaPay
     */
    public function callback(Request $request)
    {
        $transactionId = $request->input('transaction_id');

        if (!$transactionId) {
            return redirect()->route('paiement.fedapay.echec')
                ->with('error', 'Transaction ID manquant');
        }

        // En production, vérifiez le statut avec FedaPay
        // $transaction = Transaction::retrieve($transactionId);

        // Pour l'instant, simuler un succès
        $reference = 'FEDAPAY_' . $transactionId;

        // Mettre à jour la transaction
        $transaction = \App\Models\Transaction::where('reference', $reference)->first();

        if ($transaction) {
            $transaction->update([
                'status' => 'completed',
                'completed_at' => now()
            ]);

            // Activer l'abonnement
            $achat = session('achat_choisi');
            $user = Auth::user();
            $this->activateSubscription($user, $achat);

            return redirect()->route('dashboard.index')
                ->with('success', 'Paiement effectué avec succès !');
        }

        return redirect()->route('paiement.fedapay.echec')
            ->with('error', 'Transaction non trouvée');
    }

    /**
     * Page d'échec de paiement
     */
    public function echec()
    {
        return view('front.boutique.echec');
    }

    /**
     * Activer l'abonnement pour l'utilisateur
     */
    private function activateSubscription($user, $achat)
    {
        // Créez cette table si elle n'existe pas
        // php artisan make:model UserSubscription -m

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

        // Nettoyer la session
        session()->forget('achat_choisi');
    }
}
