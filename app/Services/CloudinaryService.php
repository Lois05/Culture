<?php

namespace App\Services;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CloudinaryService
{
    /**
     * Upload une image vers Cloudinary
     */
    public function uploadImage($file, $tableName, $entityName = null)
    {
        try {
            // Générer un public_id unique
            $publicId = Str::slug($tableName) . '_' . time() . '_' . uniqid();

            if ($entityName) {
                $publicId = Str::slug($entityName) . '_' . $publicId;
            }

            $uploadedFile = Cloudinary::upload($file->getRealPath(), [
                'folder' => "bambou_beach/{$tableName}",
                'public_id' => $publicId,
                'transformation' => [
                    'quality' => 'auto:good',
                    'fetch_format' => 'auto',
                    'width' => 1200,
                    'height' => 800,
                    'crop' => 'limit'
                ]
            ]);

            return [
                'success' => true,
                'url' => $uploadedFile->getSecurePath(),
                'url_thumbnail' => $this->generateThumbnailUrl($uploadedFile->getPublicId()),
                'public_id' => $uploadedFile->getPublicId(),
                'format' => $uploadedFile->getExtension(),
                'size' => $uploadedFile->getSize()
            ];

        } catch (Exception $e) {
            Log::error('Cloudinary Upload Error: ' . $e->getMessage());

            return [
                'success' => false,
                'error' => $e->getMessage(),
                'url' => null,
                'public_id' => null
            ];
        }
    }

    /**
     * Génère une URL pour une miniature
     */
    private function generateThumbnailUrl($publicId)
    {
        $cloudName = config('cloudinary.cloud_name');
        return "https://res.cloudinary.com/{$cloudName}/image/upload/c_fill,w_300,h_300,q_auto/{$publicId}";
    }

    /**
     * Supprime une image de Cloudinary
     */
    public function deleteImage($publicId)
    {
        try {
            Cloudinary::destroy($publicId);
            return true;
        } catch (Exception $e) {
            Log::error('Cloudinary Delete Error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Migre une image locale vers Cloudinary
     */
    public function migrateLocalImage($localPath, $tableName, $identifier)
    {
        if (!file_exists($localPath)) {
            return ['success' => false, 'error' => 'Fichier local introuvable'];
        }

        try {
            $publicId = 'migrated_' . Str::slug($tableName) . '_' . $identifier;

            $uploadedFile = Cloudinary::upload($localPath, [
                'folder' => "bambou_beach/migrated/{$tableName}",
                'public_id' => $publicId
            ]);

            return [
                'success' => true,
                'url' => $uploadedFile->getSecurePath(),
                'public_id' => $uploadedFile->getPublicId()
            ];

        } catch (Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Vérifie si Cloudinary est configuré
     */
    public function isConfigured()
    {
        return config('cloudinary.cloud_name') &&
               config('cloudinary.api_key') &&
               config('cloudinary.api_secret');
    }
}
