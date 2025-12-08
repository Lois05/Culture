<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Region;

class RegionSeeder extends Seeder
{
    public function run(): void
    {
        $regions = [
            'Atlantique', 'Littoral', 'Zou', 'Collines', 'Ouémé',
            'Plateau', 'Borgou', 'Alibori', 'Mono', 'Couffo',
            'Donga', 'Atacora', 'Kouffo'
        ];

        foreach ($regions as $nom) {
            Region::create([
                'nom_region' => $nom,
                'description' => 'Description pour ' . $nom,
                'population' => rand(50000, 1500000),
                'superficie' => rand(1000, 10000),
                'localisation' => rand(-90, 90) . ', ' . rand(-180, 180),
            ]);
        }
    }
}
