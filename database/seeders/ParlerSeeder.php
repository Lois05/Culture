<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParlerSeeder extends Seeder
{
    public function run()
    {
        $associations = [
            ['id_region'=>1, 'id_langue'=>1],
            ['id_region'=>1, 'id_langue'=>2],
            ['id_region'=>2, 'id_langue'=>1],
            ['id_region'=>2, 'id_langue'=>3],
            ['id_region'=>3, 'id_langue'=>2],
            ['id_region'=>3, 'id_langue'=>3],
        ];

        DB::table('parler')->insert($associations);
    }
}
