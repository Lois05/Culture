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
        Schema::create('abonnements', function (Blueprint $table) {
            $table->id(); // id automatique
            $table->string('nom', 100);
            $table->text('description')->nullable();
            $table->decimal('prix', 8, 2); // 999999.99
            $table->integer('duree_jours')->default(30); // Durée en jours
            $table->enum('statut', ['actif', 'inactif'])->default('actif');
            $table->boolean('recommandé')->default(false);
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abonnements');
    }
};
