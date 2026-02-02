<?php

namespace App\Helpers;

class CloudinaryFixer
{
    public static function fix()
    {
        $path = app_path('Helpers/CloudinaryHelper.php');
        
        if (!file_exists($path)) {
            return 'Fichier non trouvé: ' . $path;
        }
        
        $content = file_get_contents($path);
        
        // 1. Sauvegarde
        file_put_contents($path . '.backup', $content);
        
        // 2. Remplacer beninwest par discoverbenin
        $content = str_replace(
            "'default-content.jpg' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1765979237/beninwest_rj3d0o.jpg',",
            "'default-content.jpg' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1765979252/discoverbenin_vq9mik.jpg',",
            $content
        );
        
        $content = str_replace(
            "'default.jpg' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1765979237/beninwest_rj3d0o.jpg',",
            "'default.jpg' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1765979252/discoverbenin_vq9mik.jpg',",
            $content
        );
        
        // 3. Sauvegarder
        file_put_contents($path, $content);
        
        return '✅ Fix appliqué! Backup: CloudinaryHelper.php.backup';
    }
}
