<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MediaSeeder extends Seeder
{
    public function run(): void
    {
        // Supprimer les anciens médias
        DB::table('medias')->delete();

        $medias = [
            [
                'chemin' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1766157101/roi_gbehanzin.jpg',
                'cloudinary_url' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1766157101/roi_gbehanzin.jpg',
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
                'chemin' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1766157102/legende_tehou.jpg',
                'cloudinary_url' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1766157102/legende_tehou.jpg',
                'type_fichier' => 'image/webp',
                'taille' => 1800000,
                'description' => 'Illustration de la légende de Têhou',
                'id_contenu' => 2,
                'id_type_media' => 1,
                'id_langue' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'chemin' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1766157103/amiwo_plat.jpg',
                'cloudinary_url' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1766157103/amiwo_plat.jpg',
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
                'chemin' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1766157104/preparation_amiwo.jpg',
                'cloudinary_url' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1766157104/preparation_amiwo.jpg',
                'type_fichier' => 'image/jpeg',
                'taille' => 1700000,
                'description' => 'Préparation de l\'Amiwo',
                'id_contenu' => 4,
                'id_type_media' => 1,
                'id_langue' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'chemin' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1766157105/danse_zinli.jpg',
                'cloudinary_url' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1766157105/danse_zinli.jpg',
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
                'chemin' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1766157106/festival_gaani.jpg',
                'cloudinary_url' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1766157106/festival_gaani.jpg',
                'type_fichier' => 'image/jpeg',
                'taille' => 1900000,
                'description' => 'Célébration du festival Gaani',
                'id_contenu' => 6,
                'id_type_media' => 1,
                'id_langue' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'chemin' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1766157107/tissage_kente.jpg',
                'cloudinary_url' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1766157107/tissage_kente.jpg',
                'type_fichier' => 'image/webp',
                'taille' => 2200000,
                'description' => 'Tissage du Kente traditionnel',
                'id_contenu' => 7,
                'id_type_media' => 1,
                'id_langue' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'chemin' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1766157108/proverbe_fon.jpg',
                'cloudinary_url' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1766157108/proverbe_fon.jpg',
                'type_fichier' => 'image/jpeg',
                'taille' => 1200000,
                'description' => 'Illustration du proverbe Fon',
                'id_contenu' => 8,
                'id_type_media' => 1,
                'id_langue' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'chemin' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1766157109/chant_recolte.jpg',
                'cloudinary_url' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1766157109/chant_recolte.jpg',
                'type_fichier' => 'image/jpeg',
                'taille' => 1600000,
                'description' => 'Chant de récolte Yoruba',
                'id_contenu' => 9,
                'id_type_media' => 1,
                'id_langue' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'chemin' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1766157110/palais_abomey.jpg',
                'cloudinary_url' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1766157110/palais_abomey.jpg',
                'type_fichier' => 'image/jpeg',
                'taille' => 2400000,
                'description' => 'Portes du Palais Royal d\'Abomey',
                'id_contenu' => 10,
                'id_type_media' => 1,
                'id_langue' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('medias')->insert($medias);

        echo "✅ MediaSeeder terminé. " . count($medias) . " médias créés.\n";
    }
}
