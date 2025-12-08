<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Créer la table uniquement si elle n'existe pas
        if (!Schema::hasTable('achats')) {
            Schema::create('achats', function (Blueprint $table) {
                $table->id('id_achat');

                // Clé étrangère vers users (standard Laravel - colonne 'id')
                $table->foreignId('utilisateur_id')
                      ->constrained('users')
                      ->onDelete('cascade');

                // IMPORTANT : Pour contenus qui a 'id_contenu' comme clé primaire
                $table->unsignedBigInteger('contenu_id');

                $table->decimal('montant', 8, 2);
                $table->string('methode_paiement')->default('stripe');
                $table->string('transaction_id')->nullable();
                $table->enum('statut', ['pending', 'completed', 'failed', 'refunded'])
                      ->default('pending');
                $table->timestamp('date_achat')->useCurrent();
                $table->timestamps();

                // Clé étrangère vers contenus AVEC la colonne personnalisée
                $table->foreign('contenu_id')
                      ->references('id_contenu')  // Référence la colonne id_contenu
                      ->on('contenus')            // Dans la table contenus
                      ->onDelete('cascade');      // Suppression en cascade

                // Index pour les performances
                $table->index('utilisateur_id');
                $table->index('contenu_id');
                $table->index('transaction_id');
                $table->index('statut');
                $table->index('date_achat');
            });

            echo "Table 'achats' créée avec succès!\n";
        } else {
            echo "Table 'achats' existe déjà.\n";
        }
    }

    public function down()
    {
        Schema::dropIfExists('achats');
    }
};
