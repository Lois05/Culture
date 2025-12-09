<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    public function run(): void
    {
        $regions = [
            [
                'nom_region' => 'Atlantique',
                'description' => 'Département du Sud-Bénin avec Cotonou comme principale ville',
                'population' => 1450000,
                'superficie' => 3233,
                'localisation' => '6.3667, 2.4333',
            ],
            [
                'nom_region' => 'Littoral',
                'description' => 'Département le plus petit mais le plus peuplé, centre économique',
                'population' => 960000,
                'superficie' => 79,
                'localisation' => '6.3547, 2.4403',
            ],
            [
                'nom_region' => 'Zou',
                'description' => 'Région historique du royaume du Dahomey',
                'population' => 1050000,
                'superficie' => 5243,
                'localisation' => '7.1833, 2.0667',
            ],
            [
                'nom_region' => 'Collines',
                'description' => 'Région montagneuse au centre du Bénin',
                'population' => 780000,
                'superficie' => 13661,
                'localisation' => '8.0000, 2.2500',
            ],
            [
                'nom_region' => 'Ouémé',
                'description' => 'Département côtier avec Porto-Novo comme capitale nationale',
                'population' => 1275000,
                'superficie' => 1281,
                'localisation' => '6.4969, 2.6283',
            ],
            [
                'nom_region' => 'Plateau',
                'description' => 'Région agricole importante',
                'population' => 650000,
                'superficie' => 3264,
                'localisation' => '7.2000, 2.5000',
            ],
            [
                'nom_region' => 'Borgou',
                'description' => 'Grand département du Nord, terre des Bariba',
                'population' => 1200000,
                'superficie' => 25756,
                'localisation' => '9.9000, 2.7500',
            ],
            [
                'nom_region' => 'Alibori',
                'description' => 'Département le plus vaste du Bénin',
                'population' => 950000,
                'superficie' => 26242,
                'localisation' => '11.2500, 2.5000',
            ],
            [
                'nom_region' => 'Mono',
                'description' => 'Région côtière à l\'ouest, culture Adja',
                'population' => 550000,
                'superficie' => 1605,
                'localisation' => '6.5833, 1.7500',
            ],
            [
                'nom_region' => 'Couffo',
                'description' => 'Région agricole riche en traditions',
                'population' => 850000,
                'superficie' => 2404,
                'localisation' => '7.0833, 1.8333',
            ],
            [
                'nom_region' => 'Donga',
                'description' => 'Région du Nord-Ouest',
                'population' => 600000,
                'superficie' => 11126,
                'localisation' => '9.4167, 1.7500',
            ],
            [
                'nom_region' => 'Atacora',
                'description' => 'Région montagneuse avec le parc de la Pendjari',
                'population' => 900000,
                'superficie' => 20499,
                'localisation' => '10.3000, 1.6667',
            ]
        ];

        foreach ($regions as $region) {
            DB::table('regions')->insert($region);
        }
    }
}
