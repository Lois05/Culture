<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContenuSeeder extends Seeder
{
    public function run()
    {
        // D'abord, vérifions combien d'utilisateurs existent
        $totalUsers = DB::table('users')->count();

        if ($totalUsers < 4) {
            // Pas assez d'utilisateurs, on ne peut pas créer de contenus
            echo "⚠️ Pas assez d'utilisateurs pour créer des contenus. Créez d'abord des utilisateurs.\n";
            return;
        }

        // Données culturelles réelles du Bénin (en français)
        $contenusCulturels = [
            // HISTOIRES ET CONTES
            [
                'titre' => 'Le Roi Gbêhanzin et la résistance contre la colonisation',
                'texte' => 'Gbêhanzin, né vers 1845, fut le dernier roi du Dahomey (actuel Bénin) à résister à la colonisation française. Son règne fut marqué par la célèbre bataille de Cana en 1890 où il infligea de lourdes pertes aux troupes françaises. Capturé en 1894, il fut exilé en Martinique puis en Algérie où il mourut en 1906. Sa résistance est devenue un symbole de la fierté nationale béninoise.',
                'description' => 'Histoire du dernier roi du Dahomey qui résista à la colonisation française',
                'date_creation' => now()->subDays(30),
                'statut' => 'validé',
                'parent_id' => null,
                'date_validation' => now()->subDays(25),
                'id_region' => 3, // Zou
                'id_langue' => 1, // Fon
                'id_moderateur' => 2, // PIQUET Madina
                'id_type_contenu' => 1, // Histoire
                'id_auteur' => 1, // COMLAN Maurice
            ],
            [
                'titre' => 'La Légende de Têhou et les origines du peuple Fon',
                'texte' => 'Selon la tradition orale fon, Têhou était un prince yoruba qui quitta Tado au Togo pour fonder le royaume d\'Allada. Ses descendants créèrent les royaumes d\'Abomey, de Porto-Novo et de Savi. Cette légende explique l\'origine commune des peuples Adja et Fon et leur migration vers le sud du Bénin actuel.',
                'description' => 'Conte traditionnel sur les origines du peuple Fon',
                'date_creation' => now()->subDays(25),
                'statut' => 'validé',
                'parent_id' => null,
                'date_validation' => now()->subDays(20),
                'id_region' => 1, // Atlantique
                'id_langue' => 1, // Fon
                'id_moderateur' => 2,
                'id_type_contenu' => 1,
                'id_auteur' => 2, // PIQUET Madina
            ],

            // RECETTES CULINAIRES
            [
                'titre' => 'Recette traditionnelle du Pâte rouge',
                'texte' => 'INGRÉDIENTS :
- 500g de farine de maïs
- 500g de tomates fraîches
- 200g de concentré de tomate
- 500g de poisson fumé (capitaine)
- 2 oignons
- 3 gousses d\'ail
- Piment frais
- Huile rouge (huile de palme)
- Cube d\'assaisonnement
- Sel

PRÉPARATION :
1. Préparer la pâte de maïs selon la méthode traditionnelle
2. Faire revenir l\'oignon et l\'ail dans l\'huile rouge
3. Ajouter les tomates fraîches mixées et le concentré de tomate
4. Laisser mijoter 20 minutes
5. Ajouter le poisson fumé et les épices
6. Servir la sauce avec la pâte de maïs',
                'description' => 'Plat traditionnel béninois à base de pâte de maïs et sauce tomate',
                'date_creation' => now()->subDays(20),
                'statut' => 'validé',
                'parent_id' => null,
                'date_validation' => now()->subDays(15),
                'id_region' => 1, // Atlantique
                'id_langue' => 6, // Français
                'id_moderateur' => 3, // DOSSOU Koffi
                'id_type_contenu' => 2, // Recette
                'id_auteur' => 3, // DOSSOU Koffi
            ],
            [
                'titre' => 'L\'Amiwo : la pâte de maïs rouge',
                'texte' => 'L\'Amiwo est un plat emblématique du Bénin, particulièrement apprécié dans le sud. Il s\'agit d\'une pâte de maïs préparée avec de l\'huile de palme qui lui donne sa couleur caractéristique.

INGRÉDIENTS POUR 4 PERSONNES :
- 1 kg de farine de maïs
- 250 ml d\'huile de palme
- 2 oignons
- 3 tomates
- 300g de viande ou poisson
- Épices locales
- Sel

TECHNIQUE :
La particularité de l\'Amiwo réside dans sa préparation : la farine de maïs est d\'abord torréfiée légèrement avant d\'être mélangée à l\'eau chaude, ce qui lui donne un goût unique.',
                'description' => 'Plat traditionnel à base de pâte de maïs et huile de palme',
                'date_creation' => now()->subDays(15),
                'statut' => 'validé',
                'parent_id' => null,
                'date_validation' => now()->subDays(10),
                'id_region' => 3, // Zou
                'id_langue' => 6, // Français
                'id_moderateur' => 2,
                'id_type_contenu' => 2,
                'id_auteur' => 4, // ADJOVI Clémentine
            ],

            // ARTICLES CULTURELS
            [
                'titre' => 'La Danse du Zinli : expression culturelle du peuple Fon',
                'texte' => 'Le Zinli est une danse traditionnelle pratiquée par le peuple Fon lors des cérémonies importantes : mariages, funérailles, intronisations. Les danseurs, vêtus de pagnes blancs et de tuniques brodées, exécutent des pas synchronisés au rythme des tambours parlants. Chaque mouvement a une signification précise, racontant souvent des histoires historiques ou mythologiques.',
                'description' => 'Danse traditionnelle du peuple Fon',
                'date_creation' => now()->subDays(10),
                'statut' => 'validé',
                'parent_id' => null,
                'date_validation' => now()->subDays(5),
                'id_region' => 5, // Ouémé
                'id_langue' => 3, // Goun
                'id_moderateur' => 4,
                'id_type_contenu' => 3, // Article
                'id_auteur' => 2,
            ],
            [
                'titre' => 'Le Festival de la Gaani : célébration des Bariba',
                'texte' => 'Le festival de la Gaani est la plus importante célébration du peuple Bariba dans le nord du Bénin. Il marque la fin de la saison des récoltes et le début de l\'année nouvelle. Pendant trois jours, des cérémonies traditionnelles, des danses masquées et des compétitions équestres animent la ville de Nikki, capitale historique du royaume Bariba.',
                'description' => 'Célébration annuelle des Bariba dans le Borgou',
                'date_creation' => now()->subDays(8),
                'statut' => 'validé',
                'parent_id' => null,
                'date_validation' => now()->subDays(3),
                'id_region' => 7, // Borgou
                'id_langue' => 5, // Bariba
                'id_moderateur' => 3,
                'id_type_contenu' => 3,
                'id_auteur' => 3,
            ],

            // PRATIQUES ARTISANALES
            [
                'titre' => 'L\'art du tissage du Kente au métier à tisser traditionnel',
                'texte' => 'Le Kente est un tissu traditionnel tissé à la main, particulièrement dans la région du Couffo. Les artisans utilisent des métiers à tisser horizontaux en bois pour créer des motifs géométriques complexes. Chaque motif a une signification symbolique : les losanges représentent la féminité, les zigzags les difficultés de la vie, etc. La teinture utilise des colorants naturels extraits de plantes locales.',
                'description' => 'Technique de tissage des tissus traditionnels',
                'date_creation' => now()->subDays(6),
                'statut' => 'validé',
                'parent_id' => null,
                'date_validation' => now()->subDays(2),
                'id_region' => 10, // Couffo
                'id_langue' => 7, // Adja
                'id_moderateur' => 2,
                'id_type_contenu' => 4, // Pratique artisanale
                'id_auteur' => 4,
            ],

            // PROVERBES
            [
                'titre' => 'Proverbe Fon : "A quand on mange la langue..."',
                'texte' => '"A quand on mange la langue, on ne dit pas que la viande est dure."

Signification : Lorsqu\'on profite d\'un avantage ou d\'un privilège, on ne se plaint pas des inconvénients mineurs qui l\'accompagnent. Ce proverbe enseigne la gratitude et l\'acceptation des aspects négatifs qui accompagnent les situations positives.',
                'description' => 'Explication d\'un proverbe traditionnel fon',
                'date_creation' => now()->subDays(4),
                'statut' => 'validé',
                'parent_id' => null,
                'date_validation' => now()->subDays(1),
                'id_region' => 3, // Zou
                'id_langue' => 1, // Fon
                'id_moderateur' => 2,
                'id_type_contenu' => 5, // Proverbe
                'id_auteur' => 1,
            ],

            // CHANSONS TRADITIONNELLES
            [
                'titre' => 'Chant de récolte des cultivateurs Yoruba',
                'texte' => 'Paroles en Yoruba :
"Eku ise, eku ise
Awon odo re le
Igba odun, igba odun
A o tun pade ra ra"

Traduction :
"Félicitations pour le travail, félicitations pour le travail
Tes efforts ont porté fruit
Dans cent ans, dans cent ans
Nous nous retrouverons à nouveau"

Ce chant est entonné par les cultivateurs pendant la récolte du maïs pour célébrer le fruit de leur labeur.',
                'description' => 'Chant traditionnel yoruba pour la récolte',
                'date_creation' => now()->subDays(2),
                'statut' => 'validé',
                'parent_id' => null,
                'date_validation' => now(),
                'id_region' => 6, // Plateau
                'id_langue' => 2, // Yoruba
                'id_moderateur' => 3,
                'id_type_contenu' => 6, // Chanson
                'id_auteur' => 2,
            ],

            // CONTENUS SUPPLÉMENTAIRES
            [
                'titre' => 'Les Portes du Palais Royal d\'Abomey',
                'texte' => 'Les bas-reliefs des portes du palais d\'Abomey constituent un système d\'écriture unique en Afrique. Chaque motif raconte un événement historique ou une prouesse militaire des rois du Dahomey. Réalisés en terre cuite et décorés de motifs symboliques, ces bas-reliefs ont été classés au patrimoine mondial de l\'UNESCO en 1985.',
                'description' => 'Bas-reliefs historiques du palais d\'Abomey',
                'date_creation' => now()->subDays(1),
                'statut' => 'validé',
                'parent_id' => null,
                'date_validation' => now(),
                'id_region' => 3, // Zou
                'id_langue' => 6, // Français
                'id_moderateur' => 4,
                'id_type_contenu' => 3, // Article
                'id_auteur' => 3,
            ],
        ];

        // S'assurer que les id_auteur existent dans la table users
        $existingUserIds = DB::table('users')->pluck('id')->toArray();

        foreach ($contenusCulturels as &$contenu) {
            // Vérifier que l'auteur existe
            if (!in_array($contenu['id_auteur'], $existingUserIds)) {
                // Si l'auteur n'existe pas, utiliser le premier utilisateur disponible
                $contenu['id_auteur'] = $existingUserIds[0] ?? 1;
            }

            // Vérifier que le modérateur existe
            if (!in_array($contenu['id_moderateur'], $existingUserIds)) {
                $contenu['id_moderateur'] = $existingUserIds[1] ?? 2;
            }
        }

        DB::table('contenus')->insert($contenusCulturels);

        echo "ContenuSeeder terminé. " . count($contenusCulturels) . " contenus culturels réels créés.\n";
    }
}
