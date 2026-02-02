<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Récupérer les IDs des rôles (DOIT ÊTRE APRÈS RolesTableSeeder)
        $adminRoleId = DB::table('roles')->where('nom_role', 'Administrateur')->value('id');
        $moderateurRoleId = DB::table('roles')->where('nom_role', 'Modérateur')->value('id');
        $contributeurRoleId = DB::table('roles')->where('nom_role', 'Contributeur')->value('id');
        $lecteurRoleId = DB::table('roles')->where('nom_role', 'Lecteur')->value('id');

        // Vos utilisateurs principaux
        $users = [
            [
                'name' => 'COMLAN',
                'prenom' => 'Maurice',
                'email' => 'comlan.maurice@uac.bj',
                'password' => Hash::make('Eneam123'),
                'sexe' => 'M',
                'date_naissance' => '1985-06-15',
                'date_inscription' => now(),
                'statut' => 'actif',
                'photo' => '/adminlte/img/admin.jpg',
                'id_role' => $adminRoleId,
                'id_langue' => 6, // Français
                'email_verified_at' => now(),
                'is_premium_author' => 1,
                'bio' => 'Administrateur principal de la plateforme Culture Bénin',
            ],
            [
                'name' => 'PIQUET',
                'prenom' => 'Madina',
                'email' => 'madina@gmail.com',
                'password' => Hash::make('madi02'),
                'sexe' => 'F',
                'date_naissance' => '1990-03-22',
                'date_inscription' => now(),
                'statut' => 'actif',
                'photo' => '/adminlte/img/moderateur1.jpg',
                'id_role' => $adminRoleId,
                'id_langue' => 6,
                'email_verified_at' => now(),
                'is_premium_author' => 1,
                'bio' => 'Co-administratrice de la plateforme',
            ],
            [
                'name' => 'DOSSOU',
                'prenom' => 'Koffi',
                'email' => 'koffi.dossou@culture.bj',
                'password' => Hash::make('moderateur123'),
                'sexe' => 'M',
                'date_naissance' => '1978-11-10',
                'date_inscription' => now(),
                'statut' => 'actif',
                'photo' => '/adminlte/img/moderateur2.jpg',
                'id_role' => $moderateurRoleId,
                'id_langue' => 1, // Fon
                'email_verified_at' => now(),
                'is_premium_author' => 1,
                'bio' => 'Modérateur spécialiste en histoire béninoise',
            ],
            [
                'name' => 'ADJOVI',
                'prenom' => 'Clémentine',
                'email' => 'clementine.adjovi@culture.bj',
                'password' => Hash::make('moderateur456'),
                'sexe' => 'F',
                'date_naissance' => '1982-08-30',
                'date_inscription' => now(),
                'statut' => 'actif',
                'photo' => '/adminlte/img/moderateur3.jpg',
                'id_role' => $moderateurRoleId,
                'id_langue' => 3, // Goun
                'email_verified_at' => now(),
                'is_premium_author' => 1,
                'bio' => 'Modératrice spécialiste en culture Adja et Fon',
            ],
        ];

        foreach ($users as $userData) {
            User::firstOrCreate(
                ['email' => $userData['email']],
                $userData
            );
        }

        // Ajouter des contributeurs (10 contributeurs)
        $faker = \Faker\Factory::create('fr_FR');

        for ($i = 1; $i <= 10; $i++) {
            $sexe = $faker->randomElement(['M', 'F']);
            $prenom = $sexe === 'M' ? $faker->firstNameMale : $faker->firstNameFemale;

            User::firstOrCreate(
                ['email' => "contributeur{$i}@culture.bj"],
                [
                    'name' => strtoupper($faker->lastName),
                    'prenom' => $prenom,
                    'email' => "contributeur{$i}@culture.bj",
                    'password' => Hash::make('password123'),
                    'sexe' => $sexe,
                    'date_naissance' => $faker->date('Y-m-d', '-25 years'),
                    'date_inscription' => now(),
                    'statut' => 'actif',
                    'photo' => '/adminlte/img/user' . (($i % 4) + 1) . '.jpg',
                    'id_role' => $contributeurRoleId,
                    'id_langue' => $faker->numberBetween(1, 6),
                    'email_verified_at' => now(),
                    'is_premium_author' => $faker->boolean(30), // 30% chance d'être premium
                    'bio' => $faker->sentence(8),
                ]
            );
        }

        // Ajouter des lecteurs (5 lecteurs)
        for ($i = 1; $i <= 5; $i++) {
            $sexe = $faker->randomElement(['M', 'F']);
            $prenom = $sexe === 'M' ? $faker->firstNameMale : $faker->firstNameFemale;

            User::firstOrCreate(
                ['email' => "lecteur{$i}@example.com"],
                [
                    'name' => strtoupper($faker->lastName),
                    'prenom' => $prenom,
                    'email' => "lecteur{$i}@example.com",
                    'password' => Hash::make('password123'),
                    'sexe' => $sexe,
                    'date_naissance' => $faker->date('Y-m-d', '-30 years'),
                    'date_inscription' => now(),
                    'statut' => 'actif',
                    'photo' => null,
                    'id_role' => $lecteurRoleId,
                    'id_langue' => 6, // Français par défaut
                    'email_verified_at' => now(),
                    'is_premium_author' => 0,
                    'bio' => null,
                ]
            );
        }

        $this->command->info('✅ ' . User::count() . ' utilisateurs créés avec succès !');
    }
}
