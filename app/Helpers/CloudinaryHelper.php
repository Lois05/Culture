<?php

namespace App\Helpers;

class CloudinaryHelper
{
    private static $staticImages = [
        // ========== HERO/HOME ==========
        'discoverbenin.jpg' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1765979252/discoverbenin_vq9mik.jpg',
        'fresque.jpg' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1765979182/fresque_s4pcmz.jpg',
        'routeesclave.webp' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1765979213/routeesclave_n5fo3i.webp',
        'beninwest.jpg' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1765979237/beninwest_rj3d0o.jpg',
        'mosqueeporto.jpeg' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1765979195/mosqueeporto_hdaiki.jpg',

        // ========== TIMELINE ==========
        'royaumeabo.webp' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1765980140/royaumeabo_hiduap.webp',
        'independancegraph.jpg' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1765980111/independancegraph_erzbdw.jpg',
        'ancientemps.jpg' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1765978489/ancientemps_dqc9bc.jpg',
        'renaissance.webp' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1765980053/renaissance_js7sja.webp',
        'contemporain.webp' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1765980083/contemporain_qces9z.webp',

        // ========== MISSIONS ==========
        'mamaafrica.jpg' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1766156970/mamaafrica_vmmpcb.jpg',
        'collage.png' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1765979237/beninwest_rj3d0o.jpg',

        // ========== DEFAULTS ==========
        'default-content.jpg' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1765979237/beninwest_rj3d0o.jpg',
        'default-avatar.png' => 'https://ui-avatars.com/api/?name=??&background=E8112D&color=fff&size=200',
        'default.jpg' => 'https://res.cloudinary.com/drzud4wye/image/upload/v1765979237/beninwest_rj3d0o.jpg',
    ];

    /**
     * Récupère une image statique
     */
    public static function static($filename)
    {
        return self::$staticImages[$filename] ?? self::$staticImages['default.jpg'];
    }

    /**
     * Récupère l'URL d'un média (contenu)
     */
    public static function media($media)
    {
        if (!$media) {
            return self::static('default-content.jpg');
        }

        // Si c'est un tableau, convertir en objet
        if (is_array($media)) {
            $media = (object) $media;
        }

        // PRIORITÉ 1: URL Cloudinary directe
        if (!empty($media->cloudinary_url) && strpos($media->cloudinary_url, 'cloudinary.com') !== false) {
            return $media->cloudinary_url;
        }

        // PRIORITÉ 2: Chemin local
        if (!empty($media->chemin)) {
            // Si c'est déjà une URL complète
            if (filter_var($media->chemin, FILTER_VALIDATE_URL)) {
                return $media->chemin;
            }

            // Si c'est un chemin Cloudinary déjà
            if (strpos($media->chemin, 'cloudinary.com') !== false) {
                return $media->chemin;
            }

            // Si c'est un chemin local
            if (strpos($media->chemin, 'storage/') === 0) {
                return asset($media->chemin);
            }

            // Sinon, utiliser le chemin de stockage
            return asset('storage/' . $media->chemin);
        }

        return self::static('default-content.jpg');
    }

    /**
     * Récupère l'URL de la photo d'un utilisateur (AMÉLIORÉE)
     */
    public static function user($user)
    {
        if (!$user) {
            return null;
        }

        // Conversion si tableau
        if (is_array($user)) {
            $user = (object) $user;
        }

        // PRIORITÉ 1: URL Cloudinary directe et valide
        if (!empty($user->cloudinary_url) && strpos($user->cloudinary_url, 'cloudinary.com') !== false) {
            $url = $user->cloudinary_url;

            // Exclure les URLs génériques
            $genericPatterns = ['/user1', '/user2', '/user3', '/user4', '/default-avatar', 'ui-avatars.com'];
            foreach ($genericPatterns as $pattern) {
                if (strpos($url, $pattern) !== false) {
                    return null;
                }
            }

            return $url;
        }

        // PRIORITÉ 2: Photo locale valide
        if (!empty($user->photo)) {
            // Exclure les chemins génériques
            $excludedPatterns = ['adminlte/img/', 'user1', 'user2', 'user3', 'user4', 'default'];
            foreach ($excludedPatterns as $pattern) {
                if (strpos($user->photo, $pattern) !== false) {
                    return null;
                }
            }

            // Si c'est une URL Cloudinary valide
            if (strpos($user->photo, 'cloudinary.com') !== false) {
                return $user->photo;
            }

            // Si c'est une URL complète
            if (filter_var($user->photo, FILTER_VALIDATE_URL)) {
                return $user->photo;
            }

            // Si c'est un chemin local, construire l'URL
            if (strpos($user->photo, 'storage/') === 0) {
                return asset($user->photo);
            }

            // Sinon, considérer comme chemin storage/
            return asset('storage/' . $user->photo);
        }

        return null;
    }

    /**
     * Génère les initiales d'un nom (AMÉLIORÉE - TOUJOURS RETOURNE QUELQUE CHOSE)
     */
    public static function getInitials($name)
    {
        // Toujours retourner quelque chose
        if (!$name || empty(trim($name)) || $name === 'Anonyme') {
            return '??';
        }

        $name = trim($name);

        // Nettoyer le nom
        $name = preg_replace('/\s+/', ' ', $name);

        // Séparer les mots
        $words = explode(' ', $name);
        $initials = '';

        // Prendre les premières lettres des deux premiers mots
        for ($i = 0; $i < min(2, count($words)); $i++) {
            $word = trim($words[$i]);
            if (!empty($word)) {
                $initials .= mb_strtoupper(mb_substr($word, 0, 1, 'UTF-8'), 'UTF-8');
            }
        }

        // Fallback si pas d'initiales
        if (empty($initials)) {
            if (strlen($name) >= 2) {
                $initials = mb_strtoupper(mb_substr($name, 0, 2, 'UTF-8'), 'UTF-8');
            } else {
                $initials = mb_strtoupper($name, 'UTF-8');
            }
        }

        return $initials ?: '??';
    }

    /**
     * Vérifie si un utilisateur a une vraie photo (pas l'avatar par défaut)
     */
    public static function hasRealPhoto($model)
    {
        if (!$model) {
            return false;
        }

        // Si c'est un utilisateur
        if (isset($model->email)) {
            $url = self::user($model);

            // Pas d'URL = pas de photo
            if (!$url) {
                return false;
            }

            // Si c'est l'avatar par défaut = pas de vraie photo
            if (strpos($url, 'default-avatar.png') !== false ||
                strpos($url, 'ui-avatars.com') !== false) {
                return false;
            }

            // Si c'est une URL Cloudinary = vraie photo
            if (strpos($url, 'cloudinary.com') !== false) {
                return true;
            }

            // Si c'est une URL valide = vraie photo
            if (filter_var($url, FILTER_VALIDATE_URL)) {
                return true;
            }

            return false;
        }

        // Si c'est un média
        elseif (isset($model->chemin)) {
            $url = self::media($model);

            if (!$url) {
                return false;
            }

            // Si c'est l'image par défaut
            if (strpos($url, 'default-content.jpg') !== false ||
                strpos($url, 'default.jpg') !== false) {
                return false;
            }

            return true;
        }

        return false;
    }

    /**
     * NOUVELLE MÉTHODE : Génère l'HTML complet de l'avatar (GARANTIE D'AFFICHAGE)
     */
    public static function getAvatarHtml($user, $size = 40)
    {
        // S'assurer d'avoir toujours un objet utilisateur
        if (!$user) {
            $user = (object) [
                'name' => 'Anonyme',
                'id' => 0,
                'prenom' => null
            ];
        }

        // Convertir si tableau
        if (is_array($user)) {
            $user = (object) $user;
        }

        // Nom complet
        $fullName = trim(($user->prenom ?? '') . ' ' . ($user->name ?? 'Anonyme'));
        if (empty($fullName)) {
            $fullName = 'Anonyme';
        }

        // Initiales
        $initials = self::getInitials($fullName);

        // Photo
        $photoUrl = self::user($user);
        $hasPhoto = $photoUrl !== null && !empty($photoUrl);

        // Couleur basée sur l'ID
        $colors = ['#E8112D', '#FCD116', '#008751', '#8B5CF6', '#6366F1'];
        $userId = $user->id ?? 0;
        $colorIndex = abs($userId) % count($colors);
        $color = $colors[$colorIndex];

        // CSS
        $sizePx = $size . 'px';
        $fontSize = max(12, $size * 0.35) . 'px';

        // HTML (toujours afficher quelque chose)
        if ($hasPhoto) {
            return <<<HTML
<div class="author-avatar" style="width: {$sizePx}; height: {$sizePx}; border-radius: 50%; overflow: hidden; border: 2px solid rgba(232, 17, 45, 0.2); flex-shrink: 0;">
    <img src="{$photoUrl}"
         alt="{$fullName}"
         class="author-photo"
         style="width: 100%; height: 100%; object-fit: cover;"
         onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
    <div class="avatar-initials" style="display: none; width: 100%; height: 100%; background: {$color}; color: white; font-weight: bold; font-size: {$fontSize}; align-items: center; justify-content: center;">
        {$initials}
    </div>
</div>
HTML;
        } else {
            return <<<HTML
<div class="author-avatar" style="width: {$sizePx}; height: {$sizePx}; border-radius: 50%; overflow: hidden; border: 2px solid rgba(232, 17, 45, 0.2); flex-shrink: 0; display: flex !important;">
    <div class="avatar-initials" style="width: 100%; height: 100%; background: {$color}; color: white; font-weight: bold; font-size: {$fontSize}; display: flex; align-items: center; justify-content: center;">
        {$initials}
    </div>
</div>
HTML;
        }
    }

    /**
     * Récupère l'image d'un contenu (premier média)
     */
    public static function getContentImage($contenu, $default = null)
    {
        if (!$contenu) {
            return $default ?? self::static('default-content.jpg');
        }

        // Si le contenu a des médias
        if (isset($contenu->medias) && $contenu->medias->count() > 0) {
            $media = $contenu->medias->first();
            return self::media($media);
        }

        return $default ?? self::static('default-content.jpg');
    }

    /**
     * Récupère l'URL avec transformation Cloudinary
     */
    public static function getTransformedUrl($model, $width = null, $height = null, $crop = 'fill', $quality = 'auto')
    {
        $url = '';

        if (isset($model->email)) { // Utilisateur
            $url = self::user($model);
        } elseif (isset($model->chemin)) { // Média
            $url = self::media($model);
        } else {
            return '';
        }

        // Si ce n'est pas une URL Cloudinary, retourner l'URL originale
        if (strpos($url, 'cloudinary.com') === false) {
            return $url;
        }

        // Construire les transformations
        $transformations = [];

        if ($width) {
            $transformations[] = "w_$width";
        }

        if ($height) {
            $transformations[] = "h_$height";
        }

        if ($crop) {
            $transformations[] = "c_$crop";
        }

        if ($quality) {
            $transformations[] = "q_$quality";
        }

        // Ajouter les transformations à l'URL
        if (!empty($transformations)) {
            $transformationString = implode(',', $transformations);
            $url = preg_replace(
                '/\/upload\/(v\d+\/)?/',
                "/upload/$transformationString/$1",
                $url
            );
        }

        return $url;
    }

    /**
     * Récupère toutes les informations d'avatar d'un utilisateur
     */
    public static function getUserAvatarInfo($user)
    {
        if (!$user) {
            $user = (object) ['name' => 'Anonyme', 'id' => 0];
        }

        if (is_array($user)) {
            $user = (object) $user;
        }

        $fullName = trim(($user->prenom ?? '') . ' ' . ($user->name ?? 'Anonyme'));
        if (empty($fullName)) {
            $fullName = 'Anonyme';
        }

        $initials = self::getInitials($fullName);
        $photoUrl = self::user($user);
        $hasPhoto = $photoUrl !== null && !empty($photoUrl);

        $colors = ['#E8112D', '#FCD116', '#008751', '#8B5CF6', '#6366F1'];
        $userId = $user->id ?? 0;
        $colorIndex = abs($userId) % count($colors);
        $color = $colors[$colorIndex];

        return [
            'name' => $fullName,
            'initials' => $initials,
            'photo_url' => $photoUrl,
            'has_photo' => $hasPhoto,
            'color' => $color,
            'id' => $userId
        ];
    }

    /**
     * Récupère l'image optimisée pour l'affichage
     */
    public static function display($filename = null, $type = 'content')
    {
        if (!$filename) {
            return self::static('default-content.jpg');
        }

        // Si c'est déjà une URL Cloudinary
        if (strpos($filename, 'cloudinary.com') !== false) {
            // Optimiser pour le web
            return preg_replace(
                '/\/upload\/(v\d+\/)?/',
                '/upload/q_auto,f_auto,w_800/$1',
                $filename
            );
        }

        // Si c'est un chemin local
        if (strpos($filename, 'storage/') === 0 ||
            strpos($filename, 'uploads/') === 0 ||
            strpos($filename, 'images/') === 0) {
            return asset($filename);
        }

        // Image statique
        if (isset(self::$staticImages[$filename])) {
            return self::$staticImages[$filename];
        }

        // Par défaut selon le type
        return $type === 'avatar'
            ? self::static('default-avatar.png')
            : self::static('default-content.jpg');
    }

    /**
     * Version simple pour Blade (sans inline styles)
     */
    public static function getSimpleAvatarHtml($user)
    {
        if (!$user) {
            $user = (object) ['name' => 'Anonyme', 'id' => 0];
        }

        if (is_array($user)) {
            $user = (object) $user;
        }

        $fullName = trim(($user->prenom ?? '') . ' ' . ($user->name ?? 'Anonyme')) ?: 'Anonyme';
        $initials = self::getInitials($fullName);
        $photoUrl = self::user($user);
        $hasPhoto = $photoUrl !== null && !empty($photoUrl);

        $colors = ['#E8112D', '#FCD116', '#008751', '#8B5CF6', '#6366F1'];
        $userId = $user->id ?? 0;
        $colorIndex = abs($userId) % count($colors);
        $color = $colors[$colorIndex];

        if ($hasPhoto && $photoUrl) {
            return <<<HTML
<div class="author-avatar-epic" style="width: 50px; height: 50px; border-radius: 50%; overflow: hidden; border: 2px solid rgba(232, 17, 45, 0.2);">
    <img src="{$photoUrl}"
         alt="{$fullName}"
         style="width: 100%; height: 100%; object-fit: cover;"
         onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
    <div class="d-none" style="width: 100%; height: 100%; background: {$color}; color: white; display: flex; align-items: center; justify-content: center; font-weight: bold;">
        {$initials}
    </div>
</div>
HTML;
        } else {
            return <<<HTML
<div class="author-avatar-epic" style="width: 50px; height: 50px; border-radius: 50%; overflow: hidden; border: 2px solid rgba(232, 17, 45, 0.2); display: flex; align-items: center; justify-content: center; background: {$color};">
    <span style="color: white; font-weight: bold;">{$initials}</span>
</div>
HTML;
        }
    }
}
