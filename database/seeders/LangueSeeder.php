<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Langue;

class LangueSeeder extends Seeder
{
    public function run(): void
    {
        $langues = [
            ['nom_langue' => 'Français', 'code_langue' => 'fr', 'description' => 'Langue française'],
            ['nom_langue' => 'Anglais', 'code_langue' => 'en', 'description' => 'Langue anglaise'],
            ['nom_langue' => 'Espagnol', 'code_langue' => 'es', 'description' => 'Langue espagnole'],
            ['nom_langue' => 'Allemand', 'code_langue' => 'de', 'description' => 'Langue allemande'],
        ];

        foreach ($langues as $langue) {
            Langue::create($langue);
        }
    }
}
