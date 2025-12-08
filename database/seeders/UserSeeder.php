<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('fr_FR');

        // Création de 20 utilisateurs fictifs
        for ($i = 1; $i <= 20; $i++) {
            DB::table('users')->insert([
                'name' => $faker->lastName,
                'prenom' => $faker->firstName,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // mot de passe par défaut
                'sexe' => $faker->randomElement(['M', 'F']),
                'date_naissance' => $faker->date(),
                'date_inscription' => now(),
                'statut' => $faker->randomElement(['actif', 'inactif']),
                'photo' => null,
                'id_role' => $faker->numberBetween(1, 4), // doit correspondre aux roles existants
                'id_langue' => $faker->numberBetween(1, 3), // doit correspondre aux langues existantes
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
