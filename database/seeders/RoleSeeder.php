<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role; // Assurez-vous que le modèle Role existe

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Liste des rôles à créer
        $roles = [
            ['id' => 1, 'nom_role' => 'Administrateur'],
            ['id' => 2, 'nom_role' => 'Modérateur'],
            ['id' => 3, 'nom_role' => 'Contributeur'],
            ['id' => 4, 'nom_role' => 'Lecteur'],
        ];

        foreach ($roles as $roleData) {
            // updateOrCreate : Met à jour le nom si l'ID existe, sinon crée le rôle
            Role::updateOrCreate(
                ['id' => $roleData['id']], // Condition de recherche (par ID)
                ['nom_role' => $roleData['nom_role']] // Données à insérer/mettre à jour
            );
        }
    }
}
