<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Region;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    public function run(): void
    {
        $regions = [
            ['nom_region' => 'Atlantique', 'description' => 'Département du Sud-Bénin avec Cotonou', 'population' => 1450000, 'superficie' => 3233],
            ['nom_region' => 'Littoral', 'description' => 'Département le plus peuplé, centre économique', 'population' => 960000, 'superficie' => 79],
            ['nom_region' => 'Zou', 'description' => 'Région historique du royaume du Dahomey', 'population' => 1050000, 'superficie' => 5243],
            ['nom_region' => 'Collines', 'description' => 'Région montagneuse au centre du Bénin', 'population' => 780000, 'superficie' => 13661],
            ['nom_region' => 'Ouémé', 'description' => 'Département côtier avec Porto-Novo comme capitale', 'population' => 1275000, 'superficie' => 1281],
            ['nom_region' => 'Plateau', 'description' => 'Région agricole importante', 'population' => 650000, 'superficie' => 3264],
            ['nom_region' => 'Borgou', 'description' => 'Grand département du Nord, terre des Bariba', 'population' => 1200000, 'superficie' => 25756],
            ['nom_region' => 'Alibori', 'description' => 'Département le plus vaste du Bénin', 'population' => 950000, 'superficie' => 26242],
            ['nom_region' => 'Mono', 'description' => 'Région côtière à l\'ouest, culture Adja', 'population' => 550000, 'superficie' => 1605],
            ['nom_region' => 'Couffo', 'description' => 'Région agricole riche en traditions', 'population' => 850000, 'superficie' => 2404],
            ['nom_region' => 'Donga', 'description' => 'Région du Nord-Ouest', 'population' => 600000, 'superficie' => 11126],
            ['nom_region' => 'Atacora', 'description' => 'Région montagneuse avec le parc de la Pendjari', 'population' => 900000, 'superficie' => 20499],
        ];

        foreach ($regions as $region) {
            Region::firstOrCreate(
                ['nom_region' => $region['nom_region']],
                $region
            );
        }

        $this->command->info('✅ Régions créées avec succès !');
    }
}
