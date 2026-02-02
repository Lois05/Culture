<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'medias';
    protected $primaryKey = 'id_media';

    protected $fillable = [
        'chemin',
        'description',
        'id_contenu',
        'id_type_media',
        'type_fichier',
        'taille',
        'id_langue',
    ];

    protected $appends = ['url', 'is_external'];

    /**
     * URL du média - Supporte URLs externes et locales
     */
    public function getUrlAttribute()
    {
        // Si c'est une URL externe (http:// ou https://)
        if ($this->isExternalUrl()) {
            return $this->chemin;
        }

        // Sinon, c'est un chemin local
        if ($this->chemin && file_exists(public_path($this->chemin))) {
            return asset($this->chemin);
        }

        // Fallback : image par défaut
        return asset('adminlte/img/default-content.jpg');
    }

    /**
     * Vérifie si c'est une URL externe
     */
    public function getIsExternalAttribute()
    {
        return $this->isExternalUrl();
    }

    private function isExternalUrl()
    {
        if (empty($this->chemin)) {
            return false;
        }

        return str_starts_with($this->chemin, 'http://') ||
               str_starts_with($this->chemin, 'https://');
    }

    /**
     * Relation avec le contenu
     */
    public function contenu()
    {
        return $this->belongsTo(Contenu::class, 'id_contenu', 'id_contenu');
    }

    public function typeMedia()
    {
        return $this->belongsTo(TypeMedia::class, 'id_type_media', 'id_type_media');
    }

    public function langue()
    {
        return $this->belongsTo(Langue::class, 'id_langue', 'id_langue');
    }
}
