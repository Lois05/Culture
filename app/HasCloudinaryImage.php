<?php

namespace App;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Log;

trait HasCloudinaryImage
{
    /**
     * Accessor magique pour l'URL de l'image
     * Utilise : $media->image_url ou $user->image_url
     */
    public function getImageUrlAttribute()
    {
        // 1. Priorité à Cloudinary
        if ($this->has_cloudinary && $this->cloudinary_url) {
            return $this->cloudinary_url;
        }

        // 2. Pour Media : chemin dans adminlte/img/
        if (property_exists($this, 'chemin') && $this->chemin) {
            if (filter_var($this->chemin, FILTER_VALIDATE_URL)) {
                return $this->chemin; // Déjà une URL
            }
            return asset('adminlte/img/' . $this->chemin);
        }

        // 3. Pour User : photo dans adminlte/img/
        if (property_exists($this, 'photo') && $this->photo) {
            if (filter_var($this->photo, FILTER_VALIDATE_URL)) {
                return $this->photo; // Déjà une URL
            }
            return asset('adminlte/img/' . $this->photo);
        }

        // 4. Image par défaut
        return $this->getDefaultImage();
    }

    /**
     * Accessor pour la miniature
     */
    public function getThumbnailUrlAttribute()
    {
        if ($this->image_thumbnail) {
            return $this->image_thumbnail;
        }
        return $this->image_url; // Fallback à l'image normale
    }

    /**
     * Upload une image vers Cloudinary
     */
    public function uploadToCloudinary($file, $options = [])
    {
        try {
            $defaultOptions = [
                'folder' => 'culture_app/' . $this->getTable(),
                'public_id' => $this->getTable() . '_' . $this->getKey() . '_' . time(),
                'resource_type' => 'auto'
            ];

            $options = array_merge($defaultOptions, $options);

            $upload = Cloudinary::upload($file->getRealPath(), $options);

            // Sauvegarde les infos Cloudinary
            $this->cloudinary_url = $upload->getSecurePath();
            $this->cloudinary_public_id = $upload->getPublicId();
            $this->has_cloudinary = true;

            // Crée une miniature
            $this->image_thumbnail = str_replace(
                '/upload/',
                '/upload/c_fill,w_300,h_300,q_auto/',
                $upload->getSecurePath()
            );

            return true;

        } catch (\Exception $e) {
            Log::error('Cloudinary upload error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Image par défaut selon le type
     */
    protected function getDefaultImage()
    {
        $defaults = [
            'medias' => asset('adminlte/img/default-media.jpg'),
            'users' => asset('adminlte/img/default-avatar.png'),
        ];

        return $defaults[$this->getTable()] ?? asset('adminlte/img/default.jpg');
    }

    /**
     * Vérifie si l'image est sur Cloudinary
     */
    public function isOnCloudinary()
    {
        return $this->has_cloudinary && $this->cloudinary_url;
    }
}
