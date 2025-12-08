<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    protected $model = \App\Models\Role::class;

    public function definition()
    {
        return [
            'nom_role' => $this->faker->randomElement(['Administrateur', 'Modérateur', 'Contributeur', 'Lecteur']),
        ];
    }
}
