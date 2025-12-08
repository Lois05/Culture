<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeContenuSeeder extends Seeder
{
    public function run()
    {
        DB::table('type_contenus')->insert([
            ['nom_contenu' => 'Histoire'],
            ['nom_contenu' => 'Recette culinaire'],
            ['nom_contenu' => 'Article culturel'],
            ['nom_contenu' => 'Vidéo'],
        ]);
    }
}
