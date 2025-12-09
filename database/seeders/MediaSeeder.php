<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MediaSeeder extends Seeder
{
    public function run(): void
    {
        $contenus = DB::table('contenus')->get();

        if ($contenus->isEmpty()) {
            echo "⚠️ Aucun contenu trouvé.\n";
            return;
        }

        $medias = [
            // Images
            [
                'chemin' => 'adminlte/img/roi-gbehanzin.jpg',
                'type_fichier' => 'image/jpeg',
                'taille' => 2048000,
                'description' => 'Portrait du Roi Gbêhanzin',
                'id_contenu' => 1,
                'id_type_media' => 1,
                'id_langue' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'chemin' => 'adminlte/img/amiwo.jpg',
                'type_fichier' => 'image/jpeg',
                'taille' => 1500000,
                'description' => 'Plat de pâte rouge traditionnel',
                'id_contenu' => 3,
                'id_type_media' => 1,
                'id_langue' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'chemin' => 'adminlte/img/danse.jpg',
                'type_fichier' => 'image/jpeg',
                'taille' => 1800000,
                'description' => 'Danse traditionnelle Zinli',
                'id_contenu' => 5,
                'id_type_media' => 1,
                'id_langue' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'chemin' => 'adminlte/img/festi.jpg',
                'type_fichier' => 'image/jpeg',
                'taille' => 1900000,
                'description' => 'Célébration du festival Gaani',
                'id_contenu' => 6,
                'id_type_media' => 1,
                'id_langue' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Vidéos
            [
                'chemin' => 'adminlte/img/danseagbadja.mp4',
                'type_fichier' => 'video/mp4',
                'taille' => 25600000,
                'description' => 'Reportage sur le festival Gaani',
                'id_contenu' => 6,
                'id_type_media' => 2,
                'id_langue' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'chemin' => 'adminlte/img/danse-zangbeto.mp4',
                'type_fichier' => 'video/mp4',
                'taille' => 32000000,
                'description' => 'Danse Zangbeto traditionnelle',
                'id_contenu' => 5,
                'id_type_media' => 2,
                'id_langue' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Audios
            [
                'chemin' => 'adminlte/img/conte-tehou.mp3',
                'type_fichier' => 'audio/mpeg',
                'taille' => 5120000,
                'description' => 'Conte de Têhou en langue Fon',
                'id_contenu' => 2,
                'id_type_media' => 3,
                'id_langue' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('medias')->insert($medias);

        echo "MediaSeeder terminé. " . count($medias) . " médias créés.\n";
    }
}
