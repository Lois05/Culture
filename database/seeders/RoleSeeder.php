<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->insert([
            ['id' => 1, 'nom_role' => 'Administrateur'],  // IMPORTANT: ID 1 pour Admin
            ['id' => 2, 'nom_role' => 'Modérateur'],      // ID 2 pour Modérateur
            ['id' => 3, 'nom_role' => 'Contributeur'],    // ID 3 pour Contributeur
            ['id' => 4, 'nom_role' => 'Lecteur'],         // ID 4 pour Lecteur
        ]);
    }
}
