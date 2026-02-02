<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Log;

class ImageHelper
{
    // VOS IMAGES LOCALES (dans adminlte/img/)
    private static $localImages = [
        // Hero carousel
        'hero1' => 'fresque.jpg',
        'hero2' => 'portenonretour.jpg',
        'hero3' => 'discoverbenin.jpg',
        'hero4' => 'beninwest.jpg',
        'hero5' => 'mosqueeporto.jpeg',

        // Timeline
        'timeline1' => 'ancientemps.jpg',
        'timeline2' => 'coloniale.jpeg',
        'timeline3' => 'independancegraph.jpg',
        'timeline4' => 'renaissance.webp',
        'timeline5' => 'contemporain.webp',

        // Mission (utilisez travelbenin.jpg si mission.jpg n'existe pas)
        'mission' => 'mission.jpg',

        // Explorer hero
        'explorer_hero' => 'fresque.jpg',

        // Fallback
        'default_content' => 'default-150x150.png',
        'default_avatar' => 'avatar.png',
    ];

    /**
     * Images locales (hero, timeline, mission)
     */
    public static function local($key)
    {
        $filename = self::$localImages[$key] ?? self::$localImages['default_content'];

        // Vérifier si le fichier existe
        $path = public_path('adminlte/img/' . $filename);
        if (!file_exists($path)) {
            // Fallback sur une image existante
            if ($filename === 'mission.jpg' && file_exists(public_path('adminlte/img/travelbenin.jpg'))) {
                $filename = 'travelbenin.jpg';
            } elseif ($filename === 'portenonretour.jpg' && file_exists(public_path('adminlte/img/ouidah.jpeg'))) {
                $filename = 'ouidah.jpeg';
            }
        }

        return asset('adminlte/img/' . $filename);
    }

    /**
     * Images des contenus (depuis les seeders - URLs Internet)
     * Version améliorée qui gère mieux les relations
     */
    public static function getContentImage($contenu, $returnDefault = true)
    {
        try {
            // Vérifier d'abord si le contenu a une image de couverture
            if (isset($contenu->cover_image) && !empty($contenu->cover_image)) {
                return self::content($contenu->cover_image);
            }

            // Vérifier les médias associés
            if (isset($contenu->medias) && $contenu->medias->count() > 0) {
                // Chercher d'abord une image
                foreach ($contenu->medias as $media) {
                    if ($media->id_type_media == 1 || strpos($media->type_fichier, 'image') !== false) {
                        if (!empty($media->chemin)) {
                            return self::content($media->chemin);
                        }
                    }
                }

                // Sinon prendre le premier média
                $firstMedia = $contenu->medias->first();
                if (!empty($firstMedia->chemin)) {
                    return self::content($firstMedia->chemin);
                }
            }

            // Si le contenu a un champ chemin d'image direct
            if (isset($contenu->image_url) && !empty($contenu->image_url)) {
                return self::content($contenu->image_url);
            }

        } catch (\Exception $e) {
            \Log::error('Erreur lors de la récupération de l\'image du contenu: ' . $e->getMessage());
        }

        // Fallback sur l'image par défaut
        return $returnDefault ? self::defaultContent() : null;
    }

    /**
 * Récupère l'URL d'un média (image, vidéo, audio)
 * Gère les URLs externes, les chemins locaux, et Storage
 */
public static function media($media)
{
    if (!$media || !$media->chemin) {
        return self::defaultContent();
    }

    // Utiliser la méthode content qui gère déjà tout
    return self::content($media->chemin);
}

/**
 * Récupère l'image d'un contenu
 */
public static function contentImage($contenu)
{
    return self::getContentImage($contenu);
}

/**
 * Récupère l'URL d'un fichier quelconque
 * Version plus simple de content()
 */
public static function file($path)
{
    return self::content($path);
}

    /**
     * Transforme un chemin en URL accessible
     */
    public static function content($mediaPath)
    {
        if (empty($mediaPath)) {
            return self::defaultContent();
        }

        // Si c'est déjà une URL complète
        if (filter_var($mediaPath, FILTER_VALIDATE_URL)) {
            return $mediaPath;
        }

        // Si c'est un chemin Cloudinary
        if (strpos($mediaPath, 'cloudinary') !== false || strpos($mediaPath, 'res.cloudinary.com') !== false) {
            return $mediaPath;
        }

        // Si c'est un chemin local (storage)
        if (strpos($mediaPath, 'storage/') === 0) {
            return asset($mediaPath);
        }

        // Si c'est un chemin local (adminlte/img)
        if (strpos($mediaPath, 'adminlte/img/') !== false) {
            return asset($mediaPath);
        }

        // Si ça ressemble à un nom de fichier, chercher dans adminlte/img
        if (preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $mediaPath)) {
            $path = public_path('adminlte/img/' . $mediaPath);
            if (file_exists($path)) {
                return asset('adminlte/img/' . $mediaPath);
            }
        }

        // Par défaut, supposer que c'est dans storage
        return asset('storage/' . ltrim($mediaPath, '/'));
    }

    /**
     * Image par défaut pour les contenus
     */
    public static function defaultContent()
    {
        return self::local('default_content');
    }

    /**
     * Image par défaut pour les avatars
     */
    public static function defaultAvatar()
    {
        return self::local('default_avatar');
    }

    /**
     * Pour le hero de l'explorer
     */
    public static function explorerHero()
    {
        return self::local('explorer_hero');
    }

    /**
     * Récupère l'avatar d'un utilisateur
     */
    public static function getUserAvatar($user)
    {
        if (!$user || !is_object($user)) {
            return self::defaultAvatar();
        }

        // Cloudinary en priorité
        if (!empty($user->cloudinary_url)) {
            return $user->cloudinary_url;
        }

        // Photo locale
        if (!empty($user->photo)) {
            return self::content($user->photo);
        }

        return self::defaultAvatar();
    }

    /**
     * Récupère les infos complètes de l'avatar
     */
    public static function getUserAvatarInfo($user)
    {
        if (!$user || !is_object($user)) {
            return [
                'photo_url' => self::defaultAvatar(),
                'name' => 'Anonyme',
                'initials' => 'A',
                'color' => '#E8112D',
                'has_photo' => false
            ];
        }

        // Nom complet
        $name = '';
        if (!empty($user->prenom) && !empty($user->name)) {
            $name = trim($user->prenom . ' ' . $user->name);
        } elseif (!empty($user->name)) {
            $name = trim($user->name);
        } elseif (!empty($user->prenom)) {
            $name = trim($user->prenom);
        } elseif (!empty($user->username)) {
            $name = trim($user->username);
        } else {
            $name = 'Anonyme';
        }

        // Initiales
        $initials = 'A';
        if ($name !== 'Anonyme') {
            $words = explode(' ', $name);
            if (count($words) >= 2) {
                $initials = strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
            } else {
                $initials = strtoupper(substr($name, 0, 1));
            }
        }

        // Couleur pour les initiales (basée sur le hash du nom)
        $colors = ['#E8112D', '#FCD116', '#008751', '#8B5CF6', '#6366F1'];
        $hash = crc32($name);
        $color = $colors[abs($hash) % count($colors)];

        // URL de la photo
        $photoUrl = self::getUserAvatar($user);
        $hasRealPhoto = !empty($user->photo) || !empty($user->cloudinary_url);

        return [
            'photo_url' => $photoUrl,
            'name' => $name,
            'initials' => $initials,
            'color' => $color,
            'has_photo' => $hasRealPhoto
        ];
    }
}
