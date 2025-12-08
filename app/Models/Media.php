<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    // Spécifier le nom de la table
    protected $table = 'medias';

    protected $primaryKey = 'id_media';

    protected $fillable = [
        'chemin',
        'description',
        'id_contenu',
        'id_type_media'
    ];

    /**
     * URL complète de l'image
     */
    public function getUrlAttribute()
    {
        /** @var \Illuminate\Filesystem\FilesystemAdapter $disk */
        $disk = Storage::disk('public');
        return $disk->url($this->chemin);
    }

    /**
     * Relation avec le contenu
     */
    public function contenu()
    {
        return $this->belongsTo(Contenu::class, 'id_contenu');
    }

    /**
     * Relation avec le type de média
     */
    public function typeMedia()
    {
        return $this->belongsTo(TypeMedia::class, 'id_type_media');
    }
}
