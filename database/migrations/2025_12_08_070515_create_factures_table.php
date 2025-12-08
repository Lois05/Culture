<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('factures', function (Blueprint $table) {
        $table->id('id_facture');
        $table->unsignedBigInteger('id_paiement');
        $table->string('numero_facture')->unique();
        $table->decimal('montant_ht', 10, 2);
        $table->decimal('tva', 10, 2)->default(0);
        $table->decimal('montant_ttc', 10, 2);
        $table->enum('statut', ['en attente', 'payée', 'annulée'])->default('en attente');
        $table->dateTime('date_emission');
        $table->dateTime('date_paiement')->nullable();
        $table->text('notes')->nullable();
        $table->timestamps();

        $table->foreign('id_paiement')->references('id')->on('paiements')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};
