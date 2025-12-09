<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeContenuSeeder extends Seeder
{
    public function run()
    {
        DB::table('type_contenus')->insert([
            ['nom_contenu' => 'Histoire et conte traditionnel'],
            ['nom_contenu' => 'Recette culinaire traditionnelle'],
            ['nom_contenu' => 'Article culturel'],
            ['nom_contenu' => 'Pratique artisanale'],
            ['nom_contenu' => 'Proverbe et sagesse populaire'],
            ['nom_contenu' => 'Chanson traditionnelle'],
        ]);
    }
}
