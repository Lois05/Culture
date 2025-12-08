<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ParlerFactory extends Factory
{
    protected $model = \App\Models\Parler::class;

    public function definition()
    {
        return [
            'id_region' => $this->faker->numberBetween(1, 5),
            'id_langue' => $this->faker->numberBetween(1, 3),
        ];
    }
}
