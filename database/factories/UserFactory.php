<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = \App\Models\User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->lastName,
            'prenom' => $this->faker->firstName,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'sexe' => $this->faker->randomElement(['M', 'F']),
            'date_naissance' => $this->faker->date(),
            'date_inscription' => now(),
            'statut' => $this->faker->randomElement(['actif', 'inactif']),
            'photo' => null,
            'id_role' => $this->faker->numberBetween(1, 4),
            'id_langue' => $this->faker->numberBetween(1, 3),
            'remember_token' => Str::random(10),
        ];
    }
}
