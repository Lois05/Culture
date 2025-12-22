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
            // ==================== CONTENU 1 ====================
            [
                'chemin' => 'adminlte/img/mikwabo.jpg',
                'type_fichier' => 'image/jpeg',
                'taille' => 2048000,
                'description' => 'Portrait du Roi Gbêhanzin',
                'id_contenu' => 1,
                'id_type_media' => 1,
                'id_langue' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // ==================== CONTENU 2 ====================
            [
                'chemin' => 'adminlte/img/tehou.webp',
                'type_fichier' => 'image/jpeg',
                'taille' => 1800000,
                'description' => 'Illustration de la légende de Têhou',
                'id_contenu' => 2,
                'id_type_media' => 1,
                'id_langue' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],


            // ==================== CONTENU 3 ====================
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


            // ==================== CONTENU 4 ====================
            [
                'chemin' => 'adminlte/img/amiwo.jpg',
                'type_fichier' => 'image/jpeg',
                'taille' => 1700000,
                'description' => 'Préparation de l\'Amiwo',
                'id_contenu' => 4,
                'id_type_media' => 1,
                'id_langue' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // ==================== CONTENU 5 ====================
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


            // ==================== CONTENU 6 ====================
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


            // ==================== CONTENU 7 ====================
            [
                'chemin' => 'adminlte/img/kante.webp',
                'type_fichier' => 'image/jpeg',
                'taille' => 2200000,
                'description' => 'Tissage du Kente traditionnel',
                'id_contenu' => 7,
                'id_type_media' => 1,
                'id_langue' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],


            // ==================== CONTENU 8 ====================
            [
                'chemin' => 'adminlte/img/fon.webp',
                'type_fichier' => 'image/jpeg',
                'taille' => 1200000,
                'description' => 'Illustration du proverbe Fon',
                'id_contenu' => 8,
                'id_type_media' => 1,
                'id_langue' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],


            // ==================== CONTENU 9 ====================
            [
                'chemin' => 'adminlte/img/chant.webp',
                'type_fichier' => 'image/jpeg',
                'taille' => 1600000,
                'description' => 'Chant de récolte Yoruba',
                'id_contenu' => 9,
                'id_type_media' => 1,
                'id_langue' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],


            // ==================== CONTENU 10 ====================
            [
                'chemin' => 'adminlte/img/Abomey_royal_palace_wall.jpg',
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
        echo "📊 Répartition :\n";
        echo "   - Images : " . count(array_filter($medias, fn($m) => $m['id_type_media'] == 1)) . "\n";
        echo "   - Vidéos : " . count(array_filter($medias, fn($m) => $m['id_type_media'] == 2)) . "\n";
        echo "   - Audios : " . count(array_filter($medias, fn($m) => $m['id_type_media'] == 3)) . "\n";
    }
}
