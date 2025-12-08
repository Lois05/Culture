<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContenuFactory extends Factory
{
    protected $model = \App\Models\Contenu::class;

    public function definition()
    {
        return [
            'titre' => $this->faker->sentence,
            'texte' => $this->faker->paragraph,
            'date_creation' => now(),
            'statut' => $this->faker->randomElement(['validé', 'en attente']),
            'parent_id' => null,
            'date_validation' => now(),
            'id_region' => $this->faker->numberBetween(1, 5),
            'id_langue' => $this->faker->numberBetween(1, 3),
            'id_moderateur' => $this->faker->numberBetween(1, 10),
            'id_type_contenu' => $this->faker->numberBetween(1, 4),
            'id_auteur' => $this->faker->numberBetween(1, 20),
        ];
    }
}
