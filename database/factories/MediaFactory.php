<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MediaFactory extends Factory
{
    protected $model = \App\Models\Media::class;

    public function definition()
    {
        return [
            'chemin' => $this->faker->imageUrl(640, 480, 'animals', true),
            'description' => $this->faker->sentence,
            'id_contenu' => $this->faker->numberBetween(1, 20),
            'id_type_media' => $this->faker->numberBetween(1, 3),
        ];
    }
}
