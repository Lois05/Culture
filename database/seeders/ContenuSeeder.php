<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contenu;
use App\Models\User;
use Carbon\Carbon;

class ContenuSeeder extends Seeder
{
    // Images de couverture pour chaque type de contenu
    private $coverImages = [
        'histoire' => 'https://images.unsplash.com/photo-1593693399746-69c26c4a5bc0?w=1200&auto=format&fit=crop', // Palais Royal
        'recette' => 'https://images.unsplash.com/photo-1565958011703-44f9829ba187?w=1200&auto=format&fit=crop', // Nourriture
        'danse' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?w=1200&auto=format&fit=crop', // Danse
        'festival' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?w=1200&auto=format&fit=crop', // Festival
        'artisanat' => 'https://images.unsplash.com/photo-1566305977571-5666677c6e98?w=1200&auto=format&fit=crop', // Tissage
        'proverbe' => 'https://images.unsplash.com/photo-1528164344705-47542687000d?w=1200&auto=format&fit=crop', // Art
        'chanson' => 'https://images.unsplash.com/photo-1511379938547-c1f69419868d?w=1200&auto=format&fit=crop', // Musique
        'article' => 'https://images.unsplash.com/photo-1551632811-561732d1e306?w=1200&auto=format&fit=crop', // Culture
    ];

    public function run(): void
    {
        $faker = \Faker\Factory::create('fr_FR');

        // Récupérer les contributeurs
        $contributeurs = User::where('id_role', 3)->get();
        $moderateurs = User::where('id_role', 2)->get();

        // Contenus réalistes sur la culture béninoise avec vraies images
        $contenus = [
            [
                'titre' => 'Histoire du Royaume du Dahomey',
                'description' => 'L\'histoire complète du puissant royaume du Dahomey',
                'texte' => $this->getHistoireText(),
                'cover_image' => $this->coverImages['histoire'],
                'id_type_contenu' => 1, // Histoire
                'id_region' => 3, // Zou
                'id_langue' => 6, // Français
                'statut' => 'validé',
                'is_premium' => false,
            ],
            [
                'titre' => 'Recette traditionnelle du Pâte rouge',
                'description' => 'Apprenez à préparer le plat emblématique du Bénin',
                'texte' => $this->getRecetteText(),
                'cover_image' => $this->coverImages['recette'],
                'id_type_contenu' => 2, // Recette
                'id_region' => 1, // Atlantique
                'id_langue' => 1, // Fon
                'statut' => 'validé',
                'is_premium' => false,
            ],
            [
                'titre' => 'La Danse du Zinli',
                'description' => 'Danse traditionnelle du peuple Fon',
                'texte' => $this->getDanseText(),
                'cover_image' => $this->coverImages['danse'],
                'id_type_contenu' => 7, // Danse
                'id_region' => 3, // Zou
                'id_langue' => 1, // Fon
                'statut' => 'validé',
                'is_premium' => true,
            ],
            [
                'titre' => 'Festival de la Gaani',
                'description' => 'Célébration annuelle des Bariba dans le Borgou',
                'texte' => $this->getFestivalText(),
                'cover_image' => $this->coverImages['festival'],
                'id_type_contenu' => 8, // Festival
                'id_region' => 7, // Borgou
                'id_langue' => 5, // Bariba
                'statut' => 'validé',
                'is_premium' => false,
            ],
            [
                'titre' => 'Art du tissage du Kente',
                'description' => 'Technique traditionnelle de tissage',
                'texte' => $this->getArtisanatText(),
                'cover_image' => $this->coverImages['artisanat'],
                'id_type_contenu' => 4, // Artisanat
                'id_region' => 10, // Couffo
                'id_langue' => 7, // Adja
                'statut' => 'validé',
                'is_premium' => true,
            ],
            [
                'titre' => 'Proverbes Fon et leur sagesse',
                'description' => 'Sagesse populaire du peuple Fon',
                'texte' => $this->getProverbeText(),
                'cover_image' => $this->coverImages['proverbe'],
                'id_type_contenu' => 5, // Proverbe
                'id_region' => 3, // Zou
                'id_langue' => 1, // Fon
                'statut' => 'validé',
                'is_premium' => false,
            ],
            [
                'titre' => 'Chants de récolte Yoruba',
                'description' => 'Chants traditionnels pour la récolte',
                'texte' => $this->getChansonText(),
                'cover_image' => $this->coverImages['chanson'],
                'id_type_contenu' => 6, // Chanson
                'id_region' => 2, // Littoral
                'id_langue' => 2, // Yoruba
                'statut' => 'en attente',
                'is_premium' => false,
            ],
            [
                'titre' => 'Les Portes du Palais d\'Abomey',
                'description' => 'Bas-reliefs classés à l\'UNESCO',
                'texte' => $this->getArticleText(),
                'cover_image' => $this->coverImages['article'],
                'id_type_contenu' => 3, // Article culturel
                'id_region' => 3, // Zou
                'id_langue' => 6, // Français
                'statut' => 'validé',
                'is_premium' => true,
            ],
            [
                'titre' => 'Cérémonie du Vodoun',
                'description' => 'Rituels et traditions de la religion Vodoun',
                'texte' => $this->getVodounText(),
                'cover_image' => 'https://images.unsplash.com/photo-1528164344705-47542687000d?w=1200&auto=format&fit=crop',
                'id_type_contenu' => 8, // Festival
                'id_region' => 1, // Atlantique
                'id_langue' => 1, // Fon
                'statut' => 'validé',
                'is_premium' => false,
            ],
            [
                'titre' => 'Marchés traditionnels du Bénin',
                'description' => 'Découverte des marchés colorés',
                'texte' => $this->getMarcheText(),
                'cover_image' => 'https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?w=1200&auto=format&fit=crop',
                'id_type_contenu' => 3, // Article
                'id_region' => 1, // Atlantique
                'id_langue' => 6, // Français
                'statut' => 'validé',
                'is_premium' => false,
            ],
        ];

        foreach ($contenus as $contenuData) {
            $dateCreation = Carbon::now()->subDays(rand(1, 180));

            $contenu = Contenu::create([
                'titre' => $contenuData['titre'],
                'description' => $contenuData['description'],
                'texte' => $contenuData['texte'],
                'id_type_contenu' => $contenuData['id_type_contenu'],
                'id_region' => $contenuData['id_region'],
                'id_langue' => $contenuData['id_langue'],
                'id_auteur' => $contributeurs->random()->id,
                'statut' => $contenuData['statut'],
                'is_premium' => $contenuData['is_premium'],
                'date_creation' => $dateCreation,
                'date_validation' => $contenuData['statut'] === 'validé'
                    ? $dateCreation->addDays(rand(1, 7))
                    : null,
                'id_moderateur' => $contenuData['statut'] === 'validé'
                    ? $moderateurs->random()->id
                    : null,
                'rating' => $faker->randomFloat(2, 3, 5),
                'prix' => $contenuData['is_premium'] ? $faker->numberBetween(500, 2000) : null,
            ]);

            // Ajouter l'image de couverture comme média principal
            if (isset($contenuData['cover_image'])) {
                \App\Models\Media::create([
                    'chemin' => $contenuData['cover_image'],
                    'description' => 'Image de couverture: ' . $contenuData['titre'],
                    'id_contenu' => $contenu->id_contenu,
                    'id_type_media' => 1, // Image
                    'type_fichier' => 'image/jpeg',
                    'taille' => $faker->numberBetween(500000, 3000000),
                    'id_langue' => $contenu->id_langue,
                ]);
            }
        }

        $this->command->info('✅ Contenus avec vraies images créés avec succès !');
    }

    private function getHistoireText()
    {
        return "Le Royaume du Dahomey, fondé au XVIIe siècle, était l'un des États les plus puissants d'Afrique de l'Ouest. Riche en traditions militaires et culturelles, il a résisté à la colonisation française jusqu'en 1894. Les Amazones du Dahomey, un régiment entièrement féminin, sont restées célèbres pour leur bravoure.\n\nLe royaume était organisé autour d'une monarchie absolue avec un système administratif complexe. Les rois successifs ont étendu leur influence sur une grande partie du sud du Bénin actuel.";
    }

    private function getRecetteText()
    {
        return "Le pâte rouge est un plat traditionnel à base de farine de maïs et de sauce tomate épicée.\n\nINGRÉDIENTS (pour 4 personnes) :\n- 500g de farine de maïs\n- 1kg de tomates fraîches\n- 500g de poisson fumé (capitaine)\n- 2 oignons\n- 3 gousses d'ail\n- Piment frais\n- Huile de palme\n- Cube d'assaisonnement\n- Sel\n\nPRÉPARATION :\n1. Préparer la pâte de maïs selon la méthode traditionnelle\n2. Faire revenir l'oignon et l'ail dans l'huile rouge\n3. Ajouter les tomates fraîches mixées\n4. Laisser mijoter 20 minutes\n5. Ajouter le poisson fumé et les épices\n6. Servir la sauce avec la pâte de maïs";
    }

    private function getDanseText()
    {
        return "Le Zinli est une danse rituelle exécutée lors des cérémonies importantes : mariages, funérailles, intronisations. Les danseurs, vêtus de pagnes blancs et de tuniques brodées, exécutent des pas synchronisés au rythme des tambours parlants.\n\nChaque mouvement a une signification précise, racontant souvent des histoires historiques ou mythologiques. La danse est accompagnée de chants traditionnels et de battements de tambours spécifiques.";
    }

    private function getFestivalText()
    {
        return "Le festival de la Gaani est la plus importante célébration du peuple Bariba dans le nord du Bénin. Il marque la fin de la saison des récoltes et le début de l'année nouvelle.\n\nPendant trois jours, des cérémonies traditionnelles, des danses masquées et des compétitions équestres animent la ville de Nikki, capitale historique du royaume Bariba. Les participants viennent de tout le Borgou et des régions voisines pour célébrer leur héritage culturel.";
    }

    private function getArtisanatText()
    {
        return "Le Kente est un tissu traditionnel tissé à la main, particulièrement dans la région du Couffo. Les artisans utilisent des métiers à tisser horizontaux en bois pour créer des motifs géométriques complexes.\n\nChaque motif a une signification symbolique : les losanges représentent la féminité, les zigzags les difficultés de la vie, etc. La teinture utilise des colorants naturels extraits de plantes locales. Cet art est transmis de génération en génération.";
    }

    private function getProverbeText()
    {
        return "Collection de proverbes traditionnels Fon avec leur signification :\n\n1. \"Agbé dé wè, ahwan dé gbè\" - \"La vie est un voyage, la mort est le retour\"\n   Enseigne que la vie est temporaire et qu'il faut vivre pleinement.\n\n2. \"Avùn dò kpón awùn, è nɔ̀ bɔ̀ atin ɖé\" - \"Le vieux singe ne montre pas comment grimper à l'arbre\"\n   Signifie que certaines choses s'apprennent par l'expérience personnelle.\n\n3. \"Jí ɖò xwé mɛ̀, à jí ɖò hwènú mɛ̀\" - \"On ne pleure pas dans une maison, on ne rit pas dans la rue\"\n   Enseigne la discrétion et le respect de l'intimité familiale.";
    }

    private function getChansonText()
    {
        return "Chants traditionnels yoruba entonnés pendant la récolte du maïs :\n\nParoles en Yoruba :\n\"Eku ise, eku ise\nAwon odo re le\nIgba odun, igba odun\nA o tun pade ra ra\"\n\nTraduction :\n\"Félicitations pour le travail, félicitations pour le travail\nTes efforts ont porté fruit\nDans cent ans, dans cent ans\nNous nous retrouverons à nouveau\"\n\nCes chants célèbrent le fruit du labeur et remercient les ancêtres pour les bonnes récoltes.";
    }

    private function getArticleText()
    {
        return "Les bas-reliefs des portes du palais d'Abomey constituent un système d'écriture unique en Afrique. Chaque motif raconte un événement historique ou une prouesse militaire des rois du Dahomey.\n\nRéalisés en terre cuite et décorés de motifs symboliques, ces bas-reliefs ont été classés au patrimoine mondial de l'UNESCO en 1985. Ils représentent une chronique visuelle de l'histoire du royaume et de ses conquêtes.";
    }

    private function getVodounText()
    {
        return "Le Vodoun, religion traditionnelle pratiquée au Bénin, est un système complexe de croyances et de pratiques rituelles. Les cérémonies Vodoun impliquent des danses, des chants, des offrandes et des consultations avec les esprits.\n\nLe Vodoun day, célébré le 10 janvier, est un jour férié national au Bénin depuis 1998, reconnaissant l'importance de cette religion dans la culture béninoise.";
    }

    private function getMarcheText()
    {
        return "Les marchés traditionnels du Bénin sont des centres vitaux de la vie économique et sociale. Du grand marché Dantokpa à Cotonou aux petits marchés de village, ces espaces sont remplis de couleurs, d'odeurs et de sons caractéristiques.\n\nOn y trouve des produits locaux : fruits, légumes, poissons, viandes, épices, tissus, artisanat et objets traditionnels. Les marchés sont aussi des lieux de rencontres et d'échanges culturels.";
    }
}
