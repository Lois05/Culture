<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('medias', function (Blueprint $table) {
            // Ajouter les colonnes manquantes pour gérer correctement les fichiers
            $table->string('type_fichier', 100)->nullable()->after('chemin');
            $table->integer('taille')->nullable()->after('type_fichier');
            $table->unsignedBigInteger('id_langue')->nullable()->after('id_type_media');

            // Clé étrangère pour langue
            $table->foreign('id_langue')->references('id_langue')->on('langues')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('medias', function (Blueprint $table) {
            $table->dropForeign(['id_langue']);
            $table->dropColumn(['type_fichier', 'taille', 'id_langue']);
        });
    }
};
