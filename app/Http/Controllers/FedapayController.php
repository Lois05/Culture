<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use Fedapay\Fedapay;
use Fedapay\Transaction as FedapayTransaction;

class FedapayController extends Controller
{
    /**
     * Initialiser un paiement avec Fedapay
     */
    public function process(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:100',
            'currency' => 'required|string|size:3',
            'description' => 'required|string',
            'reference' => 'required|string'
        ]);

        // Configurer Fedapay (à mettre dans votre .env)
        Fedapay::setApiKey(config('services.fedapay.secret_key'));
        Fedapay::setEnvironment(config('services.fedapay.environment', 'sandbox'));

        try {
            // Créer une transaction Fedapay
            $fedapayTransaction = FedapayTransaction::create([
                "amount" => $request->amount,
                "currency" => ["iso" => $request->currency],
                "description" => $request->description,
                "callback_url" => route('fedapay.callback'),
                "cancel_url" => route('boutique.echec', ['reference' => $request->reference]),
                "redirect_url" => route('boutique.success', ['reference' => $request->reference]),
                "metadata" => [
                    'reference' => $request->reference,
                    'user_id' => Auth::id()
                ]
            ]);

            // Rediriger vers la page de paiement Fedapay
            return redirect($fedapayTransaction->url);

        } catch (\Exception $e) {
            // En cas d'erreur, rediriger vers la page d'échec
            return redirect()->route('boutique.echec', ['reference' => $request->reference])
                ->with('error', 'Erreur lors de l\'initialisation du paiement: ' . $e->getMessage());
        }
    }

    /**
     * Vérifier le statut d'une transaction
     */
    public function checkStatus($reference)
    {
        $transaction = Transaction::where('reference', $reference)->first();

        if (!$transaction) {
            return response()->json(['error' => 'Transaction non trouvée'], 404);
        }

        // Vérifier avec Fedapay
        try {
            Fedapay::setApiKey(config('services.fedapay.secret_key'));
            $fedapayTransaction = FedapayTransaction::retrieve($transaction->transaction_id);

            return response()->json([
                'status' => $fedapayTransaction->status,
                'amount' => $fedapayTransaction->amount,
                'currency' => $fedapayTransaction->currency->iso,
                'created_at' => $fedapayTransaction->created_at
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Webhook pour les notifications Fedapay
     */
    public function webhook(Request $request)
    {
        // Vérifier la signature
        $signature = $request->header('X-Fedapay-Signature');
        $payload = $request->getContent();

        if (!$this->verifySignature($signature, $payload)) {
            return response()->json(['error' => 'Signature invalide'], 403);
        }

        $data = json_decode($payload, true);
        $event = $data['type'];

        if ($event === 'transaction.approved') {
            $transaction = $data['data'];

            // Mettre à jour votre transaction
            $localTransaction = Transaction::where('transaction_id', $transaction['id'])->first();

            if ($localTransaction) {
                $localTransaction->update([
                    'statut' => 'completed',
                    'date_paiement' => now(),
                    'metadata' => json_encode(array_merge(
                        json_decode($localTransaction->metadata, true),
                        ['webhook_data' => $data]
                    ))
                ]);
            }
        }

        return response()->json(['status' => 'success']);
    }

    private function verifySignature($signature, $payload)
    {
        // Implémenter la vérification de signature
        // (consulter la documentation Fedapay)
        return true; // À remplacer par la vraie vérification
    }
}
