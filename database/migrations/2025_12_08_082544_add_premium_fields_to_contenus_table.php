<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Ajouter des champs à la table contenus
        Schema::table('contenus', function (Blueprint $table) {
            $table->boolean('is_premium')->default(false)->after('statut');
            $table->decimal('prix', 8, 2)->nullable()->after('is_premium');
            $table->decimal('rating', 3, 2)->default(0)->after('prix');
            $table->string('description')->nullable()->after('texte');
        });

        // Ajouter des champs à la table users (pour les auteurs)
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_premium_author')->default(false)->after('id_role');
            $table->text('bio')->nullable()->after('is_premium_author');
            $table->string('specialites')->nullable()->after('bio');
            $table->string('facebook')->nullable()->after('specialites');
            $table->string('twitter')->nullable()->after('facebook');
            $table->string('linkedin')->nullable()->after('twitter');
            $table->decimal('author_rating', 3, 2)->default(0)->after('linkedin');
        });
    }

    public function down()
    {
        // Supprimer les champs de la table contenus
        Schema::table('contenus', function (Blueprint $table) {
            $table->dropColumn(['is_premium', 'prix', 'rating', 'description']);
        });

        // Supprimer les champs de la table users
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'is_premium_author', 'bio', 'specialites',
                'facebook', 'twitter', 'linkedin', 'author_rating'
            ]);
        });
    }
};
