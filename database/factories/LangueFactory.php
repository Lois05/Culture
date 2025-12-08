<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LangueFactory extends Factory
{
    protected $model = \App\Models\Langue::class;

    public function definition()
    {
        return [
            'nom_langue' => $this->faker->unique()->language,
            'code_langue' => strtoupper($this->faker->lexify('??')),
            'description' => $this->faker->sentence,
        ];
    }
}
