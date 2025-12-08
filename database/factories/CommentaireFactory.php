<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommentaireFactory extends Factory
{
    protected $model = \App\Models\Commentaire::class;

    public function definition()
    {
        return [
            'texte' => $this->faker->sentence,
            'note' => $this->faker->numberBetween(1, 5),
            'date' => now(),
            'id_utilisateur' => $this->faker->numberBetween(1, 20),
            'id_contenu' => $this->faker->numberBetween(1, 20),
        ];
    }
}
