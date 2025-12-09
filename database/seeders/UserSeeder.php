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
        // S'assurer que les rôles existent d'abord
        $roles = DB::table('roles')->pluck('id', 'nom_role')->toArray();

        if (empty($roles)) {
            // Créer les rôles s'ils n'existent pas
            DB::table('roles')->insert([
                ['nom_role' => 'Administrateur'],
                ['nom_role' => 'Modérateur'],
                ['nom_role' => 'Contributeur'],
                ['nom_role' => 'Lecteur'],
            ]);
            $roles = DB::table('roles')->pluck('id', 'nom_role')->toArray();
        }

        // Vos utilisateurs principaux
        User::firstOrCreate(
            ['email' => 'comlan.maurice@uac.bj'],
            [
                'name' => 'COMLAN',
                'prenom' => 'Maurice',
                'password' => Hash::make('Eneam123'),
                'sexe' => 'M',
                'date_naissance' => '1985-06-15',
                'date_inscription' => now(),
                'statut' => 'actif',
                'photo' => '/adminlte/img/admin.jpg',
                'id_role' => isset($roles['Administrateur']) ? $roles['Administrateur'] : 1,
                'id_langue' => 6,
                'email_verified_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['email' => 'madina@gmail.com'],
            [
                'name' => 'PIQUET',
                'prenom' => 'Madina',
                'password' => Hash::make('madi02'),
                'sexe' => 'F',
                'date_naissance' => '1990-03-22',
                'date_inscription' => now(),
                'statut' => 'actif',
                'photo' => '/adminlte/img/moderateur1.jpg',
                'id_role' => isset($roles['Administrateur']) ? $roles['Administrateur'] : 1,
                'id_langue' => 6,
                'email_verified_at' => now(),
            ]
        );

        // Modérateurs supplémentaires
        User::firstOrCreate(
            ['email' => 'koffi.dossou@culture.bj'],
            [
                'name' => 'DOSSOU',
                'prenom' => 'Koffi',
                'password' => Hash::make('moderateur123'),
                'sexe' => 'M',
                'date_naissance' => '1978-11-10',
                'date_inscription' => now(),
                'statut' => 'actif',
                'photo' => '/adminlte/img/moderateur2.jpg',
                'id_role' => isset($roles['Modérateur']) ? $roles['Modérateur'] : 2,
                'id_langue' => 1,
                'email_verified_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['email' => 'clementine.adjovi@culture.bj'],
            [
                'name' => 'ADJOVI',
                'prenom' => 'Clémentine',
                'password' => Hash::make('moderateur456'),
                'sexe' => 'F',
                'date_naissance' => '1982-08-30',
                'date_inscription' => now(),
                'statut' => 'actif',
                'photo' => '/adminlte/img/moderateur3.jpg',
                'id_role' => isset($roles['Modérateur']) ? $roles['Modérateur'] : 2,
                'id_langue' => 3,
                'email_verified_at' => now(),
            ]
        );

        // Ajouter des contributeurs
        $faker = \Faker\Factory::create('fr_FR');
        $totalUsers = User::count();

        if ($totalUsers < 15) {
            for ($i = $totalUsers; $i < 15; $i++) {
                User::create([
                    'name' => strtoupper($faker->lastName),
                    'prenom' => $faker->firstName(),
                    'email' => $faker->unique()->safeEmail,
                    'password' => Hash::make('password123'),
                    'sexe' => $faker->randomElement(['M', 'F']),
                    'date_naissance' => $faker->date(),
                    'date_inscription' => now(),
                    'statut' => 'actif',
                    'photo' => '/adminlte/img/user' . (($i % 4) + 1) . '.jpg',
                    'id_role' => isset($roles['Contributeur']) ? $roles['Contributeur'] : 3,
                    'id_langue' => $faker->numberBetween(1, 6),
                    'email_verified_at' => now(),
                ]);
            }
        }

        echo "UserSeeder terminé. " . User::count() . " utilisateurs créés/actualisés.\n";

        // Afficher les rôles assignés pour vérification
        $users = User::with('role')->get();
        foreach ($users as $user) {
            $roleName = ($user->role && isset($user->role->nom_role)) ? $user->role->nom_role : 'Pas de rôle';
            echo $user->prenom . " " . $user->name . ": " . $roleName . "\n";
        }
    }
}
