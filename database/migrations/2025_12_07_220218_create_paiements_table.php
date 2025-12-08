<?php
// database/migrations/xxxx_create_paiements_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();

            // Référence à l'utilisateur (clé étrangère)
            $table->unsignedBigInteger('user_id');

            // Informations FedaPay
            $table->string('transaction_id')->nullable()->comment('ID transaction FedaPay');
            $table->string('reference')->unique()->comment('Référence unique du paiement');

            // Informations financières
            $table->decimal('montant', 10, 2);
            $table->string('devise', 3)->default('XOF');
            $table->enum('statut', ['en_attente', 'payé', 'échoué', 'annulé', 'remboursé'])->default('en_attente');

            // Service acheté
            $table->string('service');
            $table->string('type_service')->nullable();

            // Métadonnées
            $table->json('metadata')->nullable()->comment('Données FedaPay et autres informations');

            // Dates
            $table->timestamp('date_paiement')->nullable();
            $table->timestamps();

            // Index et clés étrangères
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index(['user_id', 'statut']);
            $table->index('transaction_id');
            $table->index('reference');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
