<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RegionFactory extends Factory
{
    protected $model = \App\Models\Region::class;

    public function definition()
    {
        return [
            'nom_region' => $this->faker->unique()->City,
            'description' => $this->faker->sentence,
            'population' => $this->faker->numberBetween(100000, 2000000),
            'superficie' => $this->faker->numberBetween(500, 20000),
            'localisation' => $this->faker->city,
        ];
    }
}
