<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Media;
use App\Models\User;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\File;

class MigrateImagesToCloudinary extends Command
{
    protected $signature = 'cloudinary:migrate
        {--type=all : media|user|all}
        {--id= : ID spécifique}
        {--dry-run : Affiche seulement ce qui serait migré}
        {--force : Force la migration même si has_cloudinary=true}';

    protected $description = 'Migre les images locales vers Cloudinary avec correspondance intelligente';

    private $imageDir;

    public function __construct()
    {
        parent::__construct();
        $this->imageDir = public_path('adminlte/img');
    }

    public function handle()
    {
        $type = $this->option('type');
        $id = $this->option('id');
        $dryRun = $this->option('dry-run');
        $force = $this->option('force');

        $this->info('🔍 DÉBUT DE LA MIGRATION INTELLIGENTE');
        $this->info('=======================================');

        // Obtenir tous les fichiers images disponibles
        $availableFiles = $this->getAvailableImageFiles();
        $this->info("📁 Fichiers disponibles dans le dossier : " . count($availableFiles));

        if ($dryRun) {
            $this->info("🔍 MODE TEST - Aucune modification ne sera faite");
        }

        if ($type === 'media' || $type === 'all') {
            $this->migrateMedias($availableFiles, $id, $dryRun, $force);
        }

        if ($type === 'user' || $type === 'all') {
            $this->migrateUsers($availableFiles, $id, $dryRun, $force);
        }

        if (!$dryRun) {
            $this->info('✅ Migration terminée !');
            $this->info('🌐 Tes images sont maintenant sur Cloudinary et accessibles partout.');
            $this->info('📊 Vérifie les résultats avec : php artisan cloudinary:stats');
        }
    }

    /**
     * Récupère tous les fichiers images du dossier
     */
    private function getAvailableImageFiles()
    {
        $files = [];

        if (!File::exists($this->imageDir)) {
            $this->error("❌ Dossier introuvable : {$this->imageDir}");
            return $files;
        }

        $allFiles = File::files($this->imageDir);

        foreach ($allFiles as $file) {
            $extension = strtolower($file->getExtension());
            if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                $files[] = $file->getFilename();
            }
        }

        return $files;
    }

    /**
     * Trouve le meilleur fichier correspondant
     */
    private function findBestMatch($searchTerm, $availableFiles)
    {
        $bestMatch = null;
        $bestScore = 0;

        // Nettoyer le terme de recherche
        $cleanSearch = basename($searchTerm);

        foreach ($availableFiles as $file) {
            // Score 1 : Correspondance exacte
            if ($file === $cleanSearch) {
                return ['file' => $file, 'score' => 100, 'reason' => 'Correspondance exacte'];
            }

            // Score 2 : Le fichier contient le terme recherché
            if (str_contains($file, $cleanSearch)) {
                $score = 90;
                return ['file' => $file, 'score' => $score, 'reason' => 'Contient le nom'];
            }

            // Score 3 : Le terme recherché contient le nom de fichier
            if (str_contains($cleanSearch, $file)) {
                $score = 80;
                return ['file' => $file, 'score' => $score, 'reason' => 'Nom contenu dans le chemin'];
            }

            // Score 4 : Correspondance partielle
            similar_text($cleanSearch, $file, $percent);
            if ($percent > $bestScore) {
                $bestScore = $percent;
                $bestMatch = $file;
            }
        }

        if ($bestScore > 50) {
            return ['file' => $bestMatch, 'score' => $bestScore, 'reason' => 'Correspondance partielle'];
        }

        return null;
    }

    private function migrateMedias($availableFiles, $specificId = null, $dryRun = false, $force = false)
    {
        $query = Media::query();

        if (!$force) {
            $query->where(function($q) {
                $q->where('has_cloudinary', false)
                  ->orWhereNull('has_cloudinary');
            });
        }

        if ($specificId) {
            $query->where('id_media', $specificId);
        }

        $medias = $query->get();

        if ($medias->isEmpty()) {
            $this->info('✅ Aucun média à migrer');
            return;
        }

        $this->info("📊 Migration de {$medias->count()} médias...");

        $migrated = 0;
        $skipped = 0;
        $failed = 0;

        foreach ($medias as $media) {
            $result = $this->processMedia($media, $availableFiles, $dryRun);

            if ($result === 'migrated') $migrated++;
            elseif ($result === 'skipped') $skipped++;
            elseif ($result === 'failed') $failed++;
        }

        $this->info("📈 RÉSUMÉ MÉDIAS :");
        $this->info("   ✅ Migrés : $migrated");
        $this->info("   ⏭️  Ignorés : $skipped");
        $this->info("   ❌ Échecs : $failed");
        $this->newLine();
    }

    private function processMedia($media, $availableFiles, $dryRun = false)
    {
        if (!$media->chemin) {
            $this->warn("Média {$media->id_media} : ❌ pas de chemin défini");
            return 'skipped';
        }

        // Trouver le meilleur fichier correspondant
        $match = $this->findBestMatch($media->chemin, $availableFiles);

        if (!$match) {
            $this->warn("Média {$media->id_media} : ❌ aucune correspondance pour '{$media->chemin}'");
            return 'skipped';
        }

        $filePath = $this->imageDir . '/' . $match['file'];

        if (!File::exists($filePath)) {
            $this->error("Média {$media->id_media} : ❌ fichier introuvable - {$match['file']}");
            return 'failed';
        }

        $this->info("Média {$media->id_media} : 📁 '{$media->chemin}' → 🎯 '{$match['file']}' ({$match['reason']}, score: {$match['score']}%)");

        if ($dryRun) {
            $this->line("   🔍 MODE TEST : Ne serait migré que {$match['file']}");
            return 'skipped';
        }

        try {
            $result = Cloudinary::upload($filePath, [
                'folder' => 'culture_app/medias',
                'public_id' => 'media_' . $media->id_media . '_' . time(),
                'resource_type' => 'auto'
            ]);

            $media->cloudinary_url = $result->getSecurePath();
            $media->cloudinary_public_id = $result->getPublicId();
            $media->has_cloudinary = true;
            $media->image_thumbnail = $result->getSecurePath();
            $media->save();

            $this->info("   ✅ Migré : " . $result->getSecurePath());
            return 'migrated';

        } catch (\Exception $e) {
            $this->error("   ❌ Erreur : " . $e->getMessage());
            return 'failed';
        }
    }

    private function migrateUsers($availableFiles, $specificId = null, $dryRun = false, $force = false)
    {
        $query = User::whereNotNull('photo');

        if (!$force) {
            $query->where(function($q) {
                $q->where('has_cloudinary', false)
                  ->orWhereNull('has_cloudinary');
            });
        }

        if ($specificId) {
            $query->where('id', $specificId);
        }

        $users = $query->get();

        if ($users->isEmpty()) {
            $this->info('✅ Aucun utilisateur à migrer');
            return;
        }

        $this->info("📊 Migration de {$users->count()} utilisateurs...");

        $migrated = 0;
        $skipped = 0;
        $failed = 0;

        foreach ($users as $user) {
            $result = $this->processUser($user, $availableFiles, $dryRun);

            if ($result === 'migrated') $migrated++;
            elseif ($result === 'skipped') $skipped++;
            elseif ($result === 'failed') $failed++;
        }

        $this->info("📈 RÉSUMÉ UTILISATEURS :");
        $this->info("   ✅ Migrés : $migrated");
        $this->info("   ⏭️  Ignorés : $skipped");
        $this->info("   ❌ Échecs : $failed");
        $this->newLine();
    }

    private function processUser($user, $availableFiles, $dryRun = false)
    {
        // Nettoyer le chemin de la photo
        $photoPath = str_replace('/adminlte/img/', '', $user->photo);
        $photoPath = str_replace('adminlte/img/', '', $photoPath);
        $photoPath = ltrim($photoPath, '/');

        if (empty($photoPath)) {
            $this->warn("User {$user->id} : ❌ pas de photo définie");
            return 'skipped';
        }

        // Trouver le meilleur fichier correspondant
        $match = $this->findBestMatch($photoPath, $availableFiles);

        if (!$match) {
            $this->warn("User {$user->id} : ❌ aucune correspondance pour '{$photoPath}'");
            return 'skipped';
        }

        $filePath = $this->imageDir . '/' . $match['file'];

        if (!File::exists($filePath)) {
            $this->error("User {$user->id} : ❌ fichier introuvable - {$match['file']}");
            return 'failed';
        }

        $this->info("User {$user->id} : 📁 '{$photoPath}' → 🎯 '{$match['file']}' ({$match['reason']}, score: {$match['score']}%)");

        if ($dryRun) {
            $this->line("   🔍 MODE TEST : Ne serait migré que {$match['file']}");
            return 'skipped';
        }

        try {
            $result = Cloudinary::upload($filePath, [
                'folder' => 'culture_app/users',
                'public_id' => 'user_' . $user->id . '_' . time(),
                'resource_type' => 'auto'
            ]);

            $user->cloudinary_url = $result->getSecurePath();
            $user->cloudinary_public_id = $result->getPublicId();
            $user->has_cloudinary = true;
            $user->image_thumbnail = $result->getSecurePath();
            $user->save();

            $this->info("   ✅ Migré : " . $result->getSecurePath());
            return 'migrated';

        } catch (\Exception $e) {
            $this->error("   ❌ Erreur : " . $e->getMessage());
            return 'failed';
        }
    }
}
