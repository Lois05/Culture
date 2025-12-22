<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class UploadAllImages extends Command
{
    protected $signature = 'cloudinary:upload-all-images
        {--folder=all : culture_app/medias|culture_app/users|culture_app/static|all}
        {--limit=0 : Limite d\'images (0 pour toutes)}
        {--dry-run : Affiche seulement ce qui serait uploadé}';

    protected $description = 'Upload TOUTES les images du dossier adminlte/img vers Cloudinary';

    private $imageDir;
    private $results = [];
    private $excludedExtensions = ['mp4', 'exe', 'html'];
    private $excludedFolders = ['Vodoun Days in Benin_files', 'beignetvideo_files', 'recette akassa -_files', 'public', 'medias', 'profile-photos', 'credit'];

    public function __construct()
    {
        parent::__construct();
        $this->imageDir = public_path('adminlte/img');
    }

    public function handle()
    {
        $folder = $this->option('folder');
        $limit = (int)$this->option('limit');
        $dryRun = $this->option('dry-run');

        $this->info('🚀 UPLOAD COMPLET DU DOSSIER IMAGES');
        $this->info('====================================');

        if ($dryRun) {
            $this->info('🔍 MODE TEST - Aucun upload ne sera effectué');
        }

        // 1. Compter toutes les images
        $allFiles = $this->getAllImageFiles();
        $totalFiles = count($allFiles);

        $this->info("📁 Dossier : {$this->imageDir}");
        $this->info("📊 Total fichiers trouvés : $totalFiles");

        if ($limit > 0 && $limit < $totalFiles) {
            $allFiles = array_slice($allFiles, 0, $limit);
            $this->info("📝 Limite appliquée : " . count($allFiles) . " fichiers");
        }

        // 2. Afficher les catégories
        $this->info("\n📂 CATÉGORIES D'IMAGES :");
        $categories = $this->categorizeFiles($allFiles);

        foreach ($categories as $category => $filesArray) {
            $this->line("   $category : " . count($filesArray) . " fichiers");
        }

        // 3. Demander confirmation
        if (!$dryRun && count($allFiles) > 0 && !$this->confirm("Voulez-vous uploader " . count($allFiles) . " images vers Cloudinary ?")) {
            $this->info('❌ Opération annulée');
            return;
        }

        // 4. Uploader les fichiers
        if (count($allFiles) === 0) {
            $this->warn('❌ Aucun fichier image trouvé');
            return;
        }

        $uploaded = 0;
        $failed = 0;

        $this->info("\n📤 DÉBUT DE L'UPLOAD...");

        foreach ($allFiles as $index => $fileData) {
            $result = $this->uploadFile($fileData, $dryRun);

            if ($result === 'uploaded') $uploaded++;
            elseif ($result === 'failed') $failed++;

            // Afficher la progression
            if (($index + 1) % 10 === 0 || ($index + 1) === count($allFiles)) {
                $percent = round((($index + 1) / count($allFiles)) * 100);
                $this->line("   Progression : {$percent}% (" . ($index + 1) . "/" . count($allFiles) . ")");
            }
        }

        // 5. Afficher le résumé
        $this->showSummary($uploaded, $failed, count($allFiles), $dryRun);

        // 6. Mettre à jour la base de données si nécessaire
        if (!$dryRun && $uploaded > 0) {
            $this->updateDatabaseWithCloudinaryUrls();
        }
    }

    /**
     * Récupère TOUS les fichiers images du dossier
     */
    private function getAllImageFiles()
    {
        $files = [];

        if (!File::exists($this->imageDir)) {
            $this->error("❌ Dossier introuvable : {$this->imageDir}");
            return $files;
        }

        // Scanner les fichiers dans le dossier principal
        $items = scandir($this->imageDir);

        foreach ($items as $item) {
            if ($item === '.' || $item === '..') {
                continue;
            }

            $fullPath = $this->imageDir . '/' . $item;

            // Vérifier si c'est un dossier exclu
            if (is_dir($fullPath)) {
                if (in_array($item, $this->excludedFolders)) {
                    $this->line("   ⏭️  Dossier exclu : $item");
                    continue;
                }
                // Pour l'instant, on ne scanne pas les sous-dossiers
                continue;
            }

            // Vérifier si c'est un fichier image
            $extension = strtolower(pathinfo($item, PATHINFO_EXTENSION));

            if (in_array($extension, $this->excludedExtensions)) {
                continue; // Fichier exclu
            }

            // Accepter les images
            $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'ico', 'bmp'];
            if (in_array($extension, $imageExtensions)) {
                $files[] = [
                    'full_path' => $fullPath,
                    'relative_path' => $item,
                    'filename' => $item,
                    'extension' => $extension,
                    'size' => filesize($fullPath)
                ];
            }
        }

        return $files;
    }

    /**
     * Catégorise les fichiers (version simplifiée)
     */
    private function categorizeFiles($files)
    {
        $categories = [
            'culture_app/static' => [], // Images statiques
            'culture_app/medias' => [], // Images de médias
            'culture_app/users' => [],  // Photos utilisateurs
            'culture_app/others' => []  // Autres images
        ];

        foreach ($files as $file) {
            $filename = $file['filename'];
            $relativePath = $file['relative_path'];

            // Déterminer la catégorie
            if (str_contains($filename, 'user') || str_contains($filename, 'avatar') ||
                str_contains($filename, 'admin') || str_contains($filename, 'moderateur')) {
                $categories['culture_app/users'][] = $file;
            }
            elseif (preg_match('/^\d+_/', $filename) || str_contains($filename, 'media')) {
                $categories['culture_app/medias'][] = $file;
            }
            elseif (in_array($filename, [
                'discoverbenin.jpg', 'fresque.jpg', 'routeesclave.webp', 'beninwest.jpg',
                'mosqueeporto.jpeg', 'royaumeabo.webp', 'independancegraph.jpg',
                'ancientemps.jpg', 'renaissance.webp', 'contemporain.webp', 'collage.png',
                'mamaafrica.jpg', 'festi.jpg', 'danse.jpg', 'pattern.png', 'placeholder.jpg'
            ])) {
                $categories['culture_app/static'][] = $file;
            }
            else {
                $categories['culture_app/others'][] = $file;
            }
        }

        return $categories;
    }

    /**
     * Upload un fichier vers Cloudinary
     */
    private function uploadFile($file, $dryRun = false)
    {
        $filename = $file['filename'];
        $relativePath = $file['relative_path'];
        $fullPath = $file['full_path'];

        // Déterminer le dossier Cloudinary
        $folder = 'culture_app/others';

        if (str_contains($filename, 'user') || str_contains($filename, 'avatar') ||
            str_contains($filename, 'admin') || str_contains($filename, 'moderateur')) {
            $folder = 'culture_app/users';
        }
        elseif (preg_match('/^\d+_/', $filename)) {
            $folder = 'culture_app/medias';
        }
        elseif (in_array($filename, [
            'discoverbenin.jpg', 'fresque.jpg', 'routeesclave.webp', 'beninwest.jpg',
            'mosqueeporto.jpeg', 'royaumeabo.webp', 'independancegraph.jpg',
            'ancientemps.jpg', 'renaissance.webp', 'contemporain.webp', 'collage.png',
            'mamaafrica.jpg', 'festi.jpg', 'danse.jpg', 'pattern.png', 'placeholder.jpg'
        ])) {
            $folder = 'culture_app/static';
        }

        $this->line("   📤 $relativePath → [$folder]...");

        if ($dryRun) {
            $this->line("      🔍 TEST : serait uploadé vers $folder");
            return 'skipped';
        }

        try {
            // Créer un public_id propre
            $publicId = pathinfo($filename, PATHINFO_FILENAME);
            $publicId = preg_replace('/[^a-zA-Z0-9_-]/', '_', $publicId);
            $publicId = substr($publicId, 0, 100); // Limiter la longueur

            $result = Cloudinary::upload($fullPath, [
                'folder' => $folder,
                'public_id' => $publicId,
                'resource_type' => 'auto',
                'overwrite' => false // Ne pas écraser les fichiers existants
            ]);

            $url = $result->getSecurePath();
            $publicId = $result->getPublicId();

            // Sauvegarder le résultat
            $this->results[] = [
                'local_path' => $relativePath,
                'cloudinary_url' => $url,
                'public_id' => $publicId,
                'folder' => $folder,
                'success' => true
            ];

            $this->line("      ✅ " . $url);

            // Petite pause pour éviter les limites
            usleep(300000); // 0.3 seconde

            return 'uploaded';

        } catch (\Exception $e) {
            $this->error("      ❌ Erreur : " . $e->getMessage());

            $this->results[] = [
                'local_path' => $relativePath,
                'error' => $e->getMessage(),
                'folder' => $folder,
                'success' => false
            ];

            return 'failed';
        }
    }

    /**
     * Affiche le résumé
     */
    private function showSummary($uploaded, $failed, $total, $dryRun = false)
    {
        $this->info("\n" . str_repeat('=', 50));
        $this->info("📊 RÉSUMÉ DE L'UPLOAD");
        $this->info(str_repeat('=', 50));

        if ($dryRun) {
            $this->info("🔍 MODE TEST : $total fichiers auraient été traités");
        } else {
            $this->info("✅ Upload réussis : $uploaded");
            $this->info("❌ Échecs : $failed");
            $this->info("📁 Total fichiers : $total");

            // Afficher quelques exemples
            if (!empty($this->results)) {
                $successResults = array_filter($this->results, function($r) {
                    return $r['success'] ?? false;
                });

                if (!empty($successResults)) {
                    $this->info("\n🎯 EXEMPLES D'URLS CLOUDINARY :");
                    $examples = array_slice($successResults, 0, 3);
                    foreach ($examples as $result) {
                        $this->line("   📍 " . $result['local_path'] . " → " . $result['cloudinary_url']);
                    }

                    if (count($successResults) > 3) {
                        $this->line("   ... et " . (count($successResults) - 3) . " autres");
                    }
                }
            }
        }
    }

    /**
     * Met à jour la base de données avec les URLs Cloudinary
     */
    private function updateDatabaseWithCloudinaryUrls()
    {
        $this->info("\n🔄 MISE À JOUR DE LA BASE DE DONNÉES...");

        $updatedMedias = 0;
        $updatedUsers = 0;

        foreach ($this->results as $result) {
            if (!$result['success']) continue;

            $filename = $result['local_path'];
            $cloudinaryUrl = $result['cloudinary_url'];

            // Chercher dans les médias (par nom de fichier exact)
            $mediaUpdated = DB::table('medias')
                ->where('chemin', $filename)
                ->update([
                    'cloudinary_url' => $cloudinaryUrl,
                    'has_cloudinary' => true,
                    'image_thumbnail' => $cloudinaryUrl
                ]);

            $updatedMedias += $mediaUpdated;

            // Chercher dans les utilisateurs
            // Les photos utilisateurs sont stockées comme "/adminlte/img/fichier.jpg"
            $userPhoto = '/adminlte/img/' . $filename;
            $userUpdated = DB::table('users')
                ->where('photo', $userPhoto)
                ->orWhere('photo', 'like', "%$filename%")
                ->update([
                    'cloudinary_url' => $cloudinaryUrl,
                    'has_cloudinary' => true,
                    'image_thumbnail' => $cloudinaryUrl
                ]);

            $updatedUsers += $userUpdated;
        }

        $this->info("✅ Base de données mise à jour :");
        $this->info("   📁 Médias mis à jour : $updatedMedias");
        $this->info("   👥 Utilisateurs mis à jour : $updatedUsers");

        // Sauvegarder les résultats dans un fichier JSON
        $this->saveResultsToJson();
    }

    /**
     * Sauvegarde les résultats dans un fichier JSON
     */
    private function saveResultsToJson()
    {
        $jsonFile = storage_path('logs/cloudinary_upload_' . date('Y-m-d_H-i-s') . '.json');

        $data = [
            'timestamp' => now()->toDateTimeString(),
            'total_files' => count($this->results),
            'successful_uploads' => count(array_filter($this->results, function($r) {
                return $r['success'] ?? false;
            })),
            'failed_uploads' => count(array_filter($this->results, function($r) {
                return !($r['success'] ?? false);
            })),
            'results' => $this->results
        ];

        file_put_contents($jsonFile, json_encode($data, JSON_PRETTY_PRINT));
        $this->info("📝 Résultats sauvegardés dans : $jsonFile");
    }
}
