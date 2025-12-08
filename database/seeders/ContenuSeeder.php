<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ContenuSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('fr_FR');

        for ($i = 1; $i <= 30; $i++) {
            DB::table('contenus')->insert([
                'titre' => $faker->sentence(4),
                'texte' => $faker->paragraph,
                'date_creation' => $faker->dateTimeThisYear(),
                'statut' => $faker->randomElement(['validé','en attente']),
                'parent_id' => null,
                'date_validation' => $faker->dateTimeThisYear(),
                'id_region' => $faker->numberBetween(1,5),
                'id_langue' => $faker->numberBetween(1,3),
                'id_moderateur' => $faker->numberBetween(1,20),
                'id_type_contenu' => $faker->numberBetween(1,4),
                'id_auteur' => $faker->numberBetween(1,20),
            ]);
        }
    }
}

