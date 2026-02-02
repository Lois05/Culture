<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TypeContenu;
use Illuminate\Support\Facades\DB;

class TypeContenuSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['nom_contenu' => 'Histoire et conte traditionnel'],
            ['nom_contenu' => 'Recette culinaire traditionnelle'],
            ['nom_contenu' => 'Article culturel'],
            ['nom_contenu' => 'Pratique artisanale'],
            ['nom_contenu' => 'Proverbe et sagesse populaire'],
            ['nom_contenu' => 'Chanson traditionnelle'],
            ['nom_contenu' => 'Danse traditionnelle'],
            ['nom_contenu' => 'Festival culturel'],
        ];

        foreach ($types as $type) {
            TypeContenu::firstOrCreate(
                ['nom_contenu' => $type['nom_contenu']],
                $type
            );
        }

        $this->command->info('✅ Types de contenus créés avec succès !');
    }
}
