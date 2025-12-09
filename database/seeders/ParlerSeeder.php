<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParlerSeeder extends Seeder
{
    public function run()
    {
        $associations = [
            // Atlantique et Littoral
            ['id_region' => 1, 'id_langue' => 1], // Fon
            ['id_region' => 1, 'id_langue' => 6], // Français
            ['id_region' => 2, 'id_langue' => 1], // Fon
            ['id_region' => 2, 'id_langue' => 6], // Français

            // Zou
            ['id_region' => 3, 'id_langue' => 1], // Fon
            ['id_region' => 3, 'id_langue' => 2], // Yoruba

            // Ouémé
            ['id_region' => 5, 'id_langue' => 3], // Goun
            ['id_region' => 5, 'id_langue' => 6], // Français

            // Borgou
            ['id_region' => 7, 'id_langue' => 5], // Bariba
            ['id_region' => 7, 'id_langue' => 4], // Dendi

            // Alibori
            ['id_region' => 8, 'id_langue' => 4], // Dendi
            ['id_region' => 8, 'id_langue' => 5], // Bariba

            // Mono et Couffo
            ['id_region' => 9, 'id_langue' => 7], // Adja
            ['id_region' => 10, 'id_langue' => 7], // Adja

            // Atacora
            ['id_region' => 12, 'id_langue' => 8], // Yom
            ['id_region' => 12, 'id_langue' => 9], // Ditammari

            // Plateau
            ['id_region' => 6, 'id_langue' => 2], // Yoruba
            ['id_region' => 6, 'id_langue' => 1], // Fon

            // Collines
            ['id_region' => 4, 'id_langue' => 1], // Fon
            ['id_region' => 4, 'id_langue' => 2], // Yoruba

            // Donga
            ['id_region' => 11, 'id_langue' => 8], // Yom
            ['id_region' => 11, 'id_langue' => 5], // Bariba
        ];

        DB::table('parler')->insert($associations);
    }
}
