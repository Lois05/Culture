<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Media;
use Faker\Factory as Faker;

class MediaSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        Media::factory()->count(10)->create(); // ou utiliser Faker directement
    }
}
