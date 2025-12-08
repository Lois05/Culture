<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Appel des seeders dans l'ordre correct
        $this->call([
            RoleSeeder::class,
            LangueSeeder::class, // si tu as déjà le seeder
            RegionSeeder::class,
            TypeContenuSeeder::class,
            TypeMediaSeeder::class,
            UserSeeder::class, // remplace User::factory si tu veux générer plusieurs utilisateurs
            ContenuSeeder::class,
            MediaSeeder::class,
            CommentaireSeeder::class,
            ParlerSeeder::class,
        ]);
    }
}
