<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Media;
use App\Models\User;

class CloudinaryStats extends Command
{
    protected $signature = 'cloudinary:stats';
    protected $description = 'Affiche les statistiques de migration Cloudinary';

    public function handle()
    {
        $this->info('📊 STATISTIQUES CLOUDINARY');
        $this->info('==========================');

        // Médias
        $totalMedias = Media::count();
        $migratedMedias = Media::where('has_cloudinary', true)->count();
        $notMigratedMedias = Media::where('has_cloudinary', false)->orWhereNull('has_cloudinary')->count();

        $this->info('📁 MÉDIAS :');
        $this->table(
            ['Total', 'Migrés vers Cloudinary', 'Non migrés'],
            [[$totalMedias, $migratedMedias, $notMigratedMedias]]
        );

        if ($notMigratedMedias > 0) {
            $this->info('📋 Médias non migrés (10 premiers) :');
            $medias = Media::where('has_cloudinary', false)
                ->orWhereNull('has_cloudinary')
                ->take(10)
                ->get(['id_media', 'chemin', 'description']); // CORRIGÉ : 'description' au lieu de 'titre_media'

            $this->table(['ID', 'Chemin', 'Description'], $medias->toArray());

            if ($notMigratedMedias > 10) {
                $this->info("... et " . ($notMigratedMedias - 10) . " autres médias non migrés");
            }
        }

        $this->newLine();

        // Utilisateurs
        $totalUsers = User::count();
        $usersWithPhoto = User::whereNotNull('photo')->count();
        $migratedUsers = User::where('has_cloudinary', true)->count();
        $notMigratedUsers = User::whereNotNull('photo')
            ->where(function($q) {
                $q->where('has_cloudinary', false)
                  ->orWhereNull('has_cloudinary');
            })->count();

        $this->info('👥 UTILISATEURS :');
        $this->table(
            ['Total', 'Avec photo', 'Photos migrées', 'Photos non migrées'],
            [[$totalUsers, $usersWithPhoto, $migratedUsers, $notMigratedUsers]]
        );

        if ($notMigratedUsers > 0) {
            $this->info('📋 Utilisateurs avec photos non migrées (10 premiers) :');
            $users = User::whereNotNull('photo')
                ->where(function($q) {
                    $q->where('has_cloudinary', false)
                      ->orWhereNull('has_cloudinary');
                })
                ->take(10)
                ->get(['id', 'name', 'email', 'photo']);

            $this->table(['ID', 'Nom', 'Email', 'Photo'], $users->toArray());
        }

        $this->newLine();
        $this->info('🚀 POUR MIGRER TOUTES LES IMAGES DU DOSSIER :');
        $this->line('   php artisan cloudinary:upload-all-images');
        $this->newLine();
        $this->info('📁 MIGRATION CIBLÉE :');
        $this->line('   php artisan cloudinary:migrate --dry-run    (test sans appliquer)');
        $this->line('   php artisan cloudinary:migrate              (migrer 10 par 10)');
        $this->line('   php artisan cloudinary:migrate --type=media (médias seulement)');
        $this->line('   php artisan cloudinary:migrate --type=user  (utilisateurs seulement)');
        $this->line('   php artisan cloudinary:migrate --force      (forcer tous)');
    }
}
