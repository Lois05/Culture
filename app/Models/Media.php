<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\HasCloudinaryImage;

class Media extends Model
{
    use HasCloudinaryImage;

    protected $table = 'medias';
    protected $primaryKey = 'id_media';

    // Tous les champs qui peuvent être remplis
    protected $fillable = [
        'chemin',
        'description',
        'id_contenu',
        'id_type_media',
        // Champs Cloudinary
        'cloudinary_url',
        'cloudinary_public_id',
        'has_cloudinary',
        'image_thumbnail'
    ];

    // Accessors qui seront disponibles automatiquement
    protected $appends = ['image_url', 'thumbnail_url', 'url'];

    // Relation avec le contenu (IMPORTANT : c'est là que ton image est liée au contenu)
    public function contenu()
    {
        return $this->belongsTo(Contenu::class, 'id_contenu', 'id_contenu');
    }

    // Relation avec le type de média
    public function typeMedia()
    {
        return $this->belongsTo(TypeMedia::class, 'id_type_media', 'id_type_media');
    }

    /**
     * Accessor pour compatibilité avec l'ancien code
     * Beaucoup de tes vues utilisent peut-être $media->url
     */
    public function getUrlAttribute()
    {
        return $this->image_url;
    }

    /**
     * Vérifie si le fichier existe (local ou Cloudinary)
     */
    public function getFileExistsAttribute()
    {
        if ($this->isOnCloudinary()) {
            return true; // Toujours disponible sur Cloudinary
        }

        if ($this->chemin) {
            $path = public_path('adminlte/img/' . $this->chemin);
            return file_exists($path);
        }

        return false;
    }

    /**
     * Chemin complet (pour compatibilité)
     */
    public function getFullPathAttribute()
    {
        if ($this->isOnCloudinary()) {
            return $this->cloudinary_url;
        }

        if ($this->chemin) {
            return public_path('adminlte/img/' . $this->chemin);
        }

        return null;
    }

    /**
     * Type de média formaté
     */
    public function getTypeFormattedAttribute()
    {
        switch($this->id_type_media) {
            case 1: return 'Image';
            case 2: return 'Vidéo';
            case 3: return 'Audio';
            default: return 'Inconnu';
        }
    }

    /**
     * Upload et attache une image à ce média
     */
    public function uploadImage($file, $description = null)
    {
        if ($description) {
            $this->description = $description;
        }

        // Garde l'ancien nom de fichier
        $this->chemin = $file->getClientOriginalName();

        // Upload vers Cloudinary
        if ($this->uploadToCloudinary($file)) {
            $this->save();
            return true;
        }

        return false;
    }
}
