<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // 🔥 OPTION A : VIDER LES TABLES (MySQL syntax)
        if (config('database.default') === 'mysql') {
            // Désactiver les contraintes de clé étrangère
            DB::statement('SET FOREIGN_KEY_CHECKS=0');

            // Vider les tables
            DB::table('users')->truncate();
            DB::table('medias')->truncate();
            DB::table('contenus')->truncate();
            DB::table('commentaires')->truncate();

            // Réactiver les contraintes
            DB::statement('SET FOREIGN_KEY_CHECKS=1');

            echo "✅ Tables vidées avec succès\n";
        } else {
            // Pour PostgreSQL ou autre
            Schema::disableForeignKeyConstraints();

            DB::table('users')->truncate();
            DB::table('medias')->truncate();
            DB::table('contenus')->truncate();
            DB::table('commentaires')->truncate();

            Schema::enableForeignKeyConstraints();
        }

        // 🔥 OPTION B : NETTOYER SANS VIDER (si tu veux garder les données)
        /*
        // Nettoyer seulement les chemins Cloudinary
        DB::table('users')->update(['photo' => null]);
        DB::table('medias')->update(['chemin' => null]);

        // Ou mettre des valeurs par défaut
        DB::table('users')->update([
            'photo' => 'avatars/default-avatar.png'
        ]);

        DB::table('medias')->update([
            'chemin' => 'adminlte/img/default-content.jpg'
        ]);
        */
    }

    public function down()
    {
        // Pas de rollback possible pour TRUNCATE
    }
};
