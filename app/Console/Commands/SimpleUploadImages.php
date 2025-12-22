<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class SimpleUploadImages extends Command
{
    protected $signature = 'cloudinary:simple-upload {limit=10}';
    protected $description = 'Upload simple des images vers Cloudinary';

    public function handle()
    {
        $limit = $this->argument('limit');
        $imageDir = public_path('adminlte/img');

        $this->info("📤 Upload des premières $limit images...");

        // Lister les fichiers
        $files = scandir($imageDir);
        $imageFiles = [];

        foreach ($files as $file) {
            if ($file === '.' || $file === '..') continue;

            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                $imageFiles[] = $file;
            }
        }

        $this->info("📁 " . count($imageFiles) . " images trouvées");

        // Prendre les premières $limit images
        $filesToUpload = array_slice($imageFiles, 0, $limit);

        $success = 0;
        $failed = 0;

        foreach ($filesToUpload as $index => $filename) {
            $this->line("[" . ($index+1) . "/$limit] $filename...");

            $filePath = $imageDir . '/' . $filename;

            try {
                // Déterminer le dossier
                $folder = 'culture_app/others';

                if (str_contains($filename, 'user') || str_contains($filename, 'avatar')) {
                    $folder = 'culture_app/users';
                } elseif (preg_match('/^\d+_/', $filename)) {
                    $folder = 'culture_app/medias';
                }

                $result = Cloudinary::upload($filePath, [
                    'folder' => $folder,
                    'public_id' => pathinfo($filename, PATHINFO_FILENAME),
                    'resource_type' => 'auto'
                ]);

                $url = $result->getSecurePath();
                $this->line("   ✅ $url");

                // Mettre à jour la base de données
                $this->updateDatabase($filename, $url);

                $success++;

            } catch (\Exception $e) {
                $this->error("   ❌ " . $e->getMessage());
                $failed++;
            }

            // Pause
            sleep(1);
        }

        $this->info("\n📊 RÉSULTAT : $success succès, $failed échecs");

        if ($success > 0) {
            $this->info("🌐 Tes images sont maintenant sur Cloudinary !");
            $this->info("📊 Vérifie avec : php artisan cloudinary:stats");
        }
    }

    private function updateDatabase($filename, $url)
    {
        // Médias
        DB::table('medias')
            ->where('chemin', $filename)
            ->update([
                'cloudinary_url' => $url,
                'has_cloudinary' => true
            ]);

        // Utilisateurs
        $userPhoto = '/adminlte/img/' . $filename;
        DB::table('users')
            ->where('photo', $userPhoto)
            ->update([
                'cloudinary_url' => $url,
                'has_cloudinary' => true
            ]);
    }
}
