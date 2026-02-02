<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Media;
use App\Models\Contenu;
use Illuminate\Support\Facades\Http;

class MediaSeeder extends Seeder
{
    // Collections d'images réelles sur la culture béninoise (Unsplash, Pexels)
    private $cultureImages = [
        // Histoire et patrimoine
        'https://images.unsplash.com/photo-1593693399746-69c26c4a5bc0?w=800&auto=format&fit=crop', // Palais Royal
        'https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?w=800&auto=format&fit=crop', // Statues africaines
        'https://images.unsplash.com/photo-1551632811-561732d1e306?w=800&auto=format&fit=crop', // Architecture traditionnelle
        'https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?w=800&auto=format&fit=crop', // Masques africains
        'https://images.unsplash.com/photo-1528164344705-47542687000d?w=800&auto=format&fit=crop', // Artisanat

        // Cuisine béninoise
        'https://images.unsplash.com/photo-1565958011703-44f9829ba187?w=800&auto=format&fit=crop', // Nourriture africaine
        'https://images.unsplash.com/photo-1563379926898-05f4575a45d8?w=800&auto=format&fit=crop', // Plats traditionnels
        'https://images.unsplash.com/photo-1546833999-b9f581a1996d?w=800&auto=format&fit=crop', // Préparation culinaire
        'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=800&auto=format&fit=crop', // Ingredients locaux

        // Danse et musique
        'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?w=800&auto=format&fit=crop', // Danse traditionnelle
        'https://images.unsplash.com/photo-1511379938547-c1f69419868d?w=800&auto=format&fit=crop', // Musicien africain
        'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?w=800&auto=format&fit=crop', // Tambours
        'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=800&auto=format&fit=crop', // Performance

        // Artisanat et tissage
        'https://images.unsplash.com/photo-1566305977571-5666677c6e98?w=800&auto=format&fit=crop', // Tissage Kente
        'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=800&auto=format&fit=crop', // Poterie
        'https://images.unsplash.com/photo-1536922246289-88c42f957773?w=800&auto=format&fit=crop', // Sculpture bois

        // Paysages et régions
        'https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=800&auto=format&fit=crop', // Village béninois
        'https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?w=800&auto=format&fit=crop', // Marché africain
        'https://images.unsplash.com/photo-1551632811-561732d1e306?w=800&auto=format&fit=crop', // Maisons traditionnelles
    ];

    private $videos = [
        'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4',
        'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ElephantsDream.mp4',
        'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerBlazes.mp4',
    ];

    private $audios = [
        'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3',
        'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-2.mp3',
        'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-3.mp3',
    ];

    public function run(): void
    {
        $faker = \Faker\Factory::create('fr_FR');

        $contenus = Contenu::all();

        foreach ($contenus as $contenu) {
            // 80% de chance d'avoir un média
            if ($faker->boolean(80)) {
                $nbMedias = $faker->numberBetween(1, 2);

                for ($i = 0; $i < $nbMedias; $i++) {
                    // Déterminer le type de média
                    $typeContenu = strtolower($contenu->typeContenu->nom_contenu ?? '');

                    if (str_contains($typeContenu, 'chanson') || str_contains($typeContenu, 'audio')) {
                        $this->createAudioMedia($contenu, $faker);
                    } elseif (str_contains($typeContenu, 'vidéo') || str_contains($typeContenu, 'danse')) {
                        $this->createVideoMedia($contenu, $faker);
                    } else {
                        $this->createImageMedia($contenu, $faker);
                    }
                }
            }
        }

        $this->command->info('✅ ' . Media::count() . ' médias avec vraies images créés !');
    }

    private function createImageMedia($contenu, $faker)
    {
        // Choisir une image aléatoire de la collection
        $imageUrl = $this->cultureImages[array_rand($this->cultureImages)];

        Media::create([
            'chemin' => $imageUrl, // URL directe de l'image
            'description' => $faker->sentence(10),
            'id_contenu' => $contenu->id_contenu,
            'id_type_media' => 1, // Image
            'type_fichier' => 'image/jpeg',
            'taille' => $faker->numberBetween(500000, 3000000), // 500KB à 3MB
            'id_langue' => $contenu->id_langue,
        ]);
    }

    private function createVideoMedia($contenu, $faker)
    {
        $videoUrl = $this->videos[array_rand($this->videos)];

        Media::create([
            'chemin' => $videoUrl,
            'description' => $faker->sentence(10),
            'id_contenu' => $contenu->id_contenu,
            'id_type_media' => 2, // Vidéo
            'type_fichier' => 'video/mp4',
            'taille' => $faker->numberBetween(5000000, 50000000), // 5MB à 50MB
            'id_langue' => $contenu->id_langue,
        ]);
    }

    private function createAudioMedia($contenu, $faker)
    {
        $audioUrl = $this->audios[array_rand($this->audios)];

        Media::create([
            'chemin' => $audioUrl,
            'description' => $faker->sentence(10),
            'id_contenu' => $contenu->id_contenu,
            'id_type_media' => 3, // Audio
            'type_fichier' => 'audio/mpeg',
            'taille' => $faker->numberBetween(1000000, 10000000), // 1MB à 10MB
            'id_langue' => $contenu->id_langue,
        ]);
    }
}
