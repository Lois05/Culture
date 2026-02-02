<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['nom_role' => 'Administrateur'],
            ['nom_role' => 'Modérateur'],
            ['nom_role' => 'Contributeur'],
            ['nom_role' => 'Lecteur'],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['nom_role' => $role['nom_role']], $role);
        }

        $this->command->info('✅ Rôles créés avec succès !');
    }
}
