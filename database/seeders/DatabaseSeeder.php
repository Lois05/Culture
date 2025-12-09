<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            LangueSeeder::class,
            RegionSeeder::class,
            TypeContenuSeeder::class,
            TypeMediaSeeder::class,
            UserSeeder::class, // IMPORTANT : UserSeeder doit être AVANT ContenuSeeder
            ParlerSeeder::class,
            ContenuSeeder::class, // Après UserSeeder pour que les auteurs existent
            MediaSeeder::class, // Après ContenuSeeder pour que les contenus existent
            CommentaireSeeder::class, // Après ContenuSeeder et UserSeeder
        ]);
    }
}
