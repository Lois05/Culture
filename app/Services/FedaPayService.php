<?php
// app/Services/FedaPayService.php

namespace App\Services;

use FedaPay\FedaPay;
use FedaPay\Transaction;
use FedaPay\Customer;
use Illuminate\Support\Facades\Log;

class FedaPayService
{
    public function __construct()
    {
        // Configuration simple de FedaPay
        try {
            FedaPay::setApiKey(env('FEDAPAY_SECRET_KEY'));
            FedaPay::setEnvironment(env('FEDAPAY_ENVIRONMENT', 'sandbox'));
        } catch (\Exception $e) {
            Log::error('Erreur configuration FedaPay: ' . $e->getMessage());
        }
    }

    /**
     * Créer un paiement simple
     */
    public function creerPaiement($montantFcfa, $emailClient, $description)
    {
        try {
            Log::info('Création paiement FedaPay', [
                'montant' => $montantFcfa,
                'email' => $emailClient,
                'description' => $description
            ]);

            // 1. Créer ou récupérer le client
            $customer = $this->getOrCreateCustomer($emailClient);

            if (!$customer) {
                throw new \Exception('Impossible de créer le client');
            }

            // 2. Créer la transaction
            $transaction = Transaction::create([
                'description' => $description,
                'amount' => $montantFcfa,
                'currency' => ['iso' => 'XOF'],
                'callback_url' => url('/fedapay/callback'),
                'customer' => $customer->id,
                'metadata' => [
                    'source' => 'Benin Culture',
                    'date' => date('Y-m-d H:i:s')
                ],
            ]);

            // 3. Générer le token de paiement
            $token = $transaction->generateToken();

            Log::info('Transaction créée', [
                'id' => $transaction->id,
                'reference' => $transaction->reference,
                'token' => $token
            ]);

            return [
                'success' => true,
                'transaction_id' => $transaction->id,
                'reference' => $transaction->reference,
                'payment_url' => "https://pay.fedapay.com/{$token}",
                'qr_code_url' => $transaction->generateQrCode(),
            ];

        } catch (\Exception $e) {
            Log::error('Erreur FedaPay: ' . $e->getMessage());
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Trouver ou créer un client
     */
    private function getOrCreateCustomer($email)
    {
        try {
            // Chercher par email
            $customers = Customer::all(['email' => $email]);

            if (count($customers) > 0) {
                Log::info('Client existant trouvé', ['email' => $email]);
                return $customers[0];
            }

            // Créer un nouveau client
            Log::info('Création nouveau client', ['email' => $email]);
            return Customer::create([
                'firstname' => 'Client',
                'lastname' => substr($email, 0, strpos($email, '@')) ?: 'Culture',
                'email' => $email,
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur client FedaPay: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Vérifier le statut d'un paiement
     */
    public function verifierPaiement($transactionId)
    {
        try {
            $transaction = Transaction::retrieve($transactionId);

            return [
                'success' => true,
                'id' => $transaction->id,
                'status' => $transaction->status, // 'approved', 'canceled', 'pending'
                'amount' => $transaction->amount,
                'reference' => $transaction->reference,
                'currency' => $transaction->currency,
                'created_at' => $transaction->created_at,
            ];

        } catch (\Exception $e) {
            Log::error('Erreur vérification FedaPay: ' . $e->getMessage());
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Tester la connexion à FedaPay
     */
    public function testConnexion()
    {
        try {
            // Essayer de récupérer la liste des transactions (vide en sandbox)
            $transactions = Transaction::all(['per_page' => 1]);
            return ['success' => true, 'message' => 'Connexion FedaPay OK'];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
}
