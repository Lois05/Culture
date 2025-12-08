<?php
// database/migrations/xxxx_add_abonnement_fields_to_users_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('id_abonnement')->nullable()->after('id_role');
            $table->dateTime('date_debut_abonnement')->nullable()->after('id_abonnement');
            $table->dateTime('date_fin_abonnement')->nullable()->after('date_debut_abonnement');
            $table->enum('statut_abonnement', ['actif', 'inactif', 'expiré'])->default('inactif')->after('date_fin_abonnement');

            // Clé étrangère
            $table->foreign('id_abonnement')->references('id')->on('abonnements')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['id_abonnement']);
            $table->dropColumn(['id_abonnement', 'date_debut_abonnement', 'date_fin_abonnement', 'statut_abonnement']);
        });
    }
};
