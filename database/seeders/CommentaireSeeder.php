<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CommentaireSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 50; $i++) {
            DB::table('commentaires')->insert([
                'texte' => $faker->sentence,
                'note' => $faker->numberBetween(1,5),
                'date' => $faker->dateTimeThisYear(),
                'id_utilisateur' => $faker->numberBetween(1,20),
                'id_contenu' => $faker->numberBetween(1,30),
            ]);
        }
    }
}

