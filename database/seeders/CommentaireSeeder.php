<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentaireSeeder extends Seeder
{
    public function run()
    {
        // Récupérer tous les utilisateurs et contenus existants
        $utilisateurs = DB::table('users')->pluck('id')->toArray();
        $contenus = DB::table('contenus')->pluck('id_contenu')->toArray();

        if (empty($utilisateurs) || empty($contenus)) {
            echo "⚠️ Pas assez d'utilisateurs ou de contenus pour créer des commentaires.\n";
            return;
        }

        $commentaires = [
            // Commentaires réels et pertinents
            [
                'texte' => 'Histoire passionnante ! Gbêhanzin reste un symbole de résistance pour notre nation.',
                'note' => 5,
                'date' => now()->subDays(rand(1, 30)),
                'id_utilisateur' => $utilisateurs[array_rand($utilisateurs)],
                'id_contenu' => 1, // Roi Gbêhanzin
            ],
            [
                'texte' => 'Je connaissais cette recette mais votre version est plus détaillée. Merci !',
                'note' => 4,
                'date' => now()->subDays(rand(1, 30)),
                'id_utilisateur' => $utilisateurs[array_rand($utilisateurs)],
                'id_contenu' => 3, // Pâte rouge
            ],
            [
                'texte' => 'La danse Zinli est un trésor culturel qu\'il faut préserver à tout prix.',
                'note' => 5,
                'date' => now()->subDays(rand(1, 30)),
                'id_utilisateur' => $utilisateurs[array_rand($utilisateurs)],
                'id_contenu' => 5, // Danse Zinli
            ],
            [
                'texte' => 'Article très instructif sur le festival Gaani. J\'aimerais y assister un jour.',
                'note' => 4,
                'date' => now()->subDays(rand(1, 30)),
                'id_utilisateur' => $utilisateurs[array_rand($utilisateurs)],
                'id_contenu' => 6, // Festival Gaani
            ],
            [
                'texte' => 'Le tissage du Kente est un art ancestral qui mérite d\'être enseigné dans les écoles.',
                'note' => 5,
                'date' => now()->subDays(rand(1, 30)),
                'id_utilisateur' => $utilisateurs[array_rand($utilisateurs)],
                'id_contenu' => 7, // Tissage Kente
            ],
            [
                'texte' => 'Ce proverbe est plein de sagesse. Nos ancêtres avaient une profonde compréhension de la vie.',
                'note' => 5,
                'date' => now()->subDays(rand(1, 30)),
                'id_utilisateur' => $utilisateurs[array_rand($utilisateurs)],
                'id_contenu' => 8, // Proverbe Fon
            ],
            [
                'texte' => 'La légende de Têhou explique bien nos liens avec le peuple Yoruba. Histoire fascinante.',
                'note' => 4,
                'date' => now()->subDays(rand(1, 30)),
                'id_utilisateur' => $utilisateurs[array_rand($utilisateurs)],
                'id_contenu' => 2, // Légende de Têhou
            ],
            [
                'texte' => 'L\'Amiwo est un plat délicieux mais sa préparation demande de la patience. Merci pour les conseils.',
                'note' => 4,
                'date' => now()->subDays(rand(1, 30)),
                'id_utilisateur' => $utilisateurs[array_rand($utilisateurs)],
                'id_contenu' => 4, // Amiwo
            ],
        ];

        DB::table('commentaires')->insert($commentaires);

        echo "CommentaireSeeder terminé. " . count($commentaires) . " commentaires créés.\n";
    }
}
