<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TypeContenuFactory extends Factory
{
    protected $model = \App\Models\TypeContenu::class;

    public function definition()
    {
        return [
            'nom_contenu' => $this->faker->randomElement(['Histoire', 'Recette', 'Article', 'Média']),
        ];
    }
}
