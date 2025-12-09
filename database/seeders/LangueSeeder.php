<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LangueSeeder extends Seeder
{
    public function run(): void
    {
        $langues = [
            ['nom_langue' => 'Fon', 'code_langue' => 'fon', 'description' => 'Langue majoritaire du Sud-Bénin'],
            ['nom_langue' => 'Yoruba', 'code_langue' => 'yor', 'description' => 'Langue parlée au Sud-Est du Bénin'],
            ['nom_langue' => 'Goun', 'code_langue' => 'guw', 'description' => 'Langue parlée dans le département de l\'Ouémé'],
            ['nom_langue' => 'Dendi', 'code_langue' => 'ddn', 'description' => 'Langue parlée au Nord-Bénin'],
            ['nom_langue' => 'Bariba', 'code_langue' => 'bba', 'description' => 'Langue principale du Borgou'],
            ['nom_langue' => 'Français', 'code_langue' => 'fr', 'description' => 'Langue officielle du Bénin'],
            ['nom_langue' => 'Adja', 'code_langue' => 'ajg', 'description' => 'Langue parlée dans le Mono et le Couffo'],
            ['nom_langue' => 'Yom', 'code_langue' => 'pil', 'description' => 'Langue parlée dans l\'Atacora'],
            ['nom_langue' => 'Ditammari', 'code_langue' => 'tbz', 'description' => 'Langue parlée dans l\'Atacora'],
            ['nom_langue' => 'Mina', 'code_langue' => 'gej', 'description' => 'Langue parlée dans le littoral'],
        ];

        foreach ($langues as $langue) {
            DB::table('langues')->insert($langue);
        }
    }
}
