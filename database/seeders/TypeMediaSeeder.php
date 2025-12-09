<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeMediaSeeder extends Seeder
{
    public function run()
    {
        DB::table('type_medias')->insert([
            ['nom_media' => 'Image'],
            ['nom_media' => 'Vidéo'],
            ['nom_media' => 'Audio'],
        ]);
    }
}
