<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->insert([
            ['nom_role' => 'Administrateur'],
            ['nom_role' => 'Modérateur'],
            ['nom_role' => 'Contributeur'],
            ['nom_role' => 'Lecteur'],
        ]);
    }
}
