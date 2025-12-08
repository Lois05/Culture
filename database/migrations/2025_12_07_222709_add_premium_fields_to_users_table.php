<?php
// database/migrations/xxxx_add_premium_fields_to_users_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Pour la publication prioritaire
            $table->boolean('publication_prioritaire')->default(false);
            $table->timestamp('publication_prioritaire_expire')->nullable();

            // Pour le badge expert
            $table->boolean('badge_expert')->default(false);
            $table->timestamp('expert_depuis')->nullable();
            $table->timestamp('expert_jusque')->nullable();

            // Autres champs premium
            $table->boolean('est_premium')->default(false);
            $table->timestamp('premium_depuis')->nullable();
            $table->timestamp('premium_jusque')->nullable();

            // Statistiques
            $table->integer('total_depense')->default(0)->comment('Total dépensé en FCFA');
            $table->integer('nombre_achats')->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'publication_prioritaire',
                'publication_prioritaire_expire',
                'badge_expert',
                'expert_depuis',
                'expert_jusque',
                'est_premium',
                'premium_depuis',
                'premium_jusque',
                'total_depense',
                'nombre_achats',
            ]);
        });
    }
};
