<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class UploadStaticImages extends Command
{
    protected $signature = 'cloudinary:upload-static';
    protected $description = 'Upload les images statiques sur Cloudinary et met à jour CloudinaryHelper';

    // Images qui sont DÉJÀ sur Cloudinary (avec leurs URLs)
    private $existingImages = [
        'discoverbenin.jpg' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1765979252/discoverbenin_vq9mik.jpg',
        'fresque.jpg' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1765979182/fresque_s4pcmz.jpg',
        'routeesclave.webp' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1765979213/routeesclave_n5fo3i.webp',
        'beninwest.jpg' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1765979237/beninwest_rj3d0o.jpg',
        'mosqueeporto.jpeg' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1765979195/mosqueeporto_hdaiki.jpg',
        'royaumeabo.webp' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1765980140/royaumeabo_hiduap.webp',
        'independancegraph.jpg' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1765980111/independancegraph_erzbdw.jpg',
        'ancientemps.jpg' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1765978489/ancientemps_dqc9bc.jpg',
        'renaissance.webp' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1765980053/renaissance_js7sja.webp',
        'contemporain.webp' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1765980083/contemporain_qces9z.webp',
    ];

    // Images à uploader depuis local
    private $imagesToUpload = [
        'collage.png' => 'adminlte/img/collage.png',
        'mamaafrica.jpg' => 'adminlte/img/mamaafrica.jpg',
        'festi.jpg' => 'adminlte/img/festi.jpg',
        'danse.jpg' => 'adminlte/img/danse.jpg',
        'pattern.png' => 'adminlte/img/pattern.png',
        'placeholder.jpg' => 'adminlte/img/placeholder.jpg',
        'hero-bg.jpg' => 'adminlte/img/discoverbenin.jpg', // Fallback
        'hero-slide1.jpg' => 'adminlte/img/discoverbenin.jpg',
        'hero-slide2.jpg' => 'adminlte/img/fresque.jpg',
        'hero-slide3.jpg' => 'adminlte/img/routeesclave.webp',
        'default-content.jpg' => 'adminlte/img/placeholder.jpg',
        'default-avatar.png' => 'adminlte/img/placeholder.jpg',
        'default.jpg' => 'adminlte/img/placeholder.jpg',
    ];

    public function handle()
    {
        $this->info('🚀 DÉBUT DU TRANSFERT DES IMAGES STATIQUES');
        $this->info('==========================================');
        $this->newLine();

        $uploadedImages = [];
        $uploadedCount = 0;
        $skippedCount = 0;
        $failedCount = 0;

        // Étape 1: Vérifier les images existantes
        $this->info('📋 IMAGES DÉJÀ SUR CLOUDINARY:');
        foreach ($this->existingImages as $filename => $url) {
            $this->line("✅ $filename -> $url");
            $uploadedImages[$filename] = $url;
        }
        $this->newLine();

        // Étape 2: Uploader les nouvelles images
        $this->info('📤 UPLOAD DES NOUVELLES IMAGES:');

        foreach ($this->imagesToUpload as $cloudinaryFilename => $localPath) {
            $fullLocalPath = public_path($localPath);

            // Vérifier si le fichier existe
            if (!file_exists($fullLocalPath)) {
                $this->warn("⚠️  Fichier introuvable: $localPath");
                $skippedCount++;
                continue;
            }

            // Vérifier si c'est une image
            if (!getimagesize($fullLocalPath)) {
                $this->warn("⚠️  Ce n'est pas une image valide: $localPath");
                $skippedCount++;
                continue;
            }

            try {
                $this->line("Envoi de: " . basename($localPath) . "...");

                // Upload sur Cloudinary
                $result = Cloudinary::upload($fullLocalPath, [
                    'folder' => 'culture_app/static',
                    'public_id' => pathinfo($cloudinaryFilename, PATHINFO_FILENAME),
                    'overwrite' => true,
                ]);

                $secureUrl = $result->getSecurePath();
                $uploadedImages[$cloudinaryFilename] = $secureUrl;
                $uploadedCount++;

                $this->info("✅ " . basename($localPath) . " -> $secureUrl");

                // Petite pause
                usleep(500000); // 0.5 seconde

            } catch (\Exception $e) {
                $failedCount++;
                $this->error("❌ Échec pour $localPath: " . $e->getMessage());
            }
        }

        // Étape 3: Afficher le résumé
        $this->newLine();
        $this->info("📊 RÉSUMÉ:");
        $this->info("✅ Images déjà sur Cloudinary: " . count($this->existingImages));
        $this->info("✅ Nouvelles images uploadées: $uploadedCount");
        $this->info("⚠️  Images ignorées: $skippedCount");
        $this->info("❌ Échecs: $failedCount");
        $this->info("📁 Total images disponibles: " . count($uploadedImages));

        // Étape 4: Mettre à jour CloudinaryHelper.php automatiquement
        $this->updateCloudinaryHelper($uploadedImages);

        $this->newLine();
        $this->info("🎉 OPÉRATION TERMINÉE AVEC SUCCÈS !");
        $this->info("🌐 Vos images sont disponibles sur Cloudinary dans: culture_app/static/");
    }

    /**
     * Met à jour automatiquement le fichier CloudinaryHelper.php
     */
    private function updateCloudinaryHelper($images)
    {
        $helperPath = app_path('Helpers/CloudinaryHelper.php');

        if (!file_exists($helperPath)) {
            $this->error("❌ Fichier CloudinaryHelper.php non trouvé!");
            return;
        }

        $this->newLine();
        $this->info("🔄 MISE À JOUR DE CloudinaryHelper.php...");

        // Lire le contenu actuel
        $content = file_get_contents($helperPath);

        // Trouver et remplacer le tableau $staticImages
        $pattern = '/private static \$staticImages = \[(.*?)\];/s';

        // Créer le nouveau tableau
        $newArray = "private static \$staticImages = [\n";

        // Trier les images par catégorie pour une meilleure organisation
        $categories = [
            'Hero/Home' => ['discoverbenin', 'fresque', 'routeesclave', 'beninwest', 'mosqueeporto'],
            'Timeline' => ['royaumeabo', 'independancegraph', 'ancientemps', 'renaissance', 'contemporain'],
            'Static' => ['collage', 'mamaafrica', 'festi', 'danse', 'pattern', 'placeholder'],
            'Hero/Bannière' => ['hero-bg', 'hero-slide1', 'hero-slide2', 'hero-slide3'],
            'Defaults' => ['default-content', 'default-avatar', 'default']
        ];

        $addedImages = [];

        foreach ($categories as $category => $imageNames) {
            $newArray .= "\n        // ========== " . strtoupper($category) . " ==========\n";

            foreach ($imageNames as $imageName) {
                // Chercher l'image avec l'extension correcte
                foreach ($images as $filename => $url) {
                    if (strpos($filename, $imageName) === 0) {
                        $newArray .= "        '$filename' => '$url',\n";
                        $addedImages[] = $filename;
                        break;
                    }
                }
            }
        }

        // Ajouter les images qui n'ont pas été catégorisées
        $remainingImages = array_diff(array_keys($images), $addedImages);
        if (!empty($remainingImages)) {
            $newArray .= "\n        // ========== AUTRES IMAGES ==========\n";
            foreach ($remainingImages as $filename) {
                $newArray .= "        '$filename' => '{$images[$filename]}',\n";
            }
        }

        $newArray .= "    ];";

        // Remplacer l'ancien tableau par le nouveau
        if (preg_match($pattern, $content)) {
            $newContent = preg_replace($pattern, $newArray, $content);

            // Sauvegarder le fichier
            file_put_contents($helperPath, $newContent);

            $this->info("✅ CloudinaryHelper.php mis à jour avec " . count($images) . " images!");

            // Afficher un aperçu
            $this->newLine();
            $this->info("📝 APERÇU DES PREMIÈRES IMAGES:");
            $firstImages = array_slice($images, 0, 5, true);
            foreach ($firstImages as $filename => $url) {
                $this->line("   '$filename' => '$url'");
            }
            $this->line("   ... et " . (count($images) - 5) . " autres images");
        } else {
            $this->error("❌ Impossible de trouver le tableau \$staticImages dans CloudinaryHelper.php");
        }
    }
}
