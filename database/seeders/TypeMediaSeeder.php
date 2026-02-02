<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TypeMedia;
use Illuminate\Support\Facades\DB;

class TypeMediaSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['nom_media' => 'Image'],
            ['nom_media' => 'Vidéo'],
            ['nom_media' => 'Audio'],
        ];

        foreach ($types as $type) {
            TypeMedia::firstOrCreate(
                ['nom_media' => $type['nom_media']],
                $type
            );
        }

        $this->command->info('✅ Types de médias créés avec succès !');
    }
}
