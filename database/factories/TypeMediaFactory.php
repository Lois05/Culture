<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TypeMediaFactory extends Factory
{
    protected $model = \App\Models\TypeMedia::class;

    public function definition()
    {
        return [
            'nom_media' => $this->faker->randomElement(['Image', 'Vidéo', 'Audio']),
        ];
    }
}
