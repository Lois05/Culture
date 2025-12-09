<?php
// app/Models/Media.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $primaryKey = 'id_media';
    protected $table = 'medias';

    protected $fillable = [
        'chemin',
        'description',
        'id_contenu',
        'id_type_media'
    ];

    protected $appends = ['url'];

    /**
     * Relation avec contenu
     */
    public function contenu()
    {
        return $this->belongsTo(Contenu::class, 'id_contenu', 'id_contenu');
    }

    /**
     * Relation avec type media
     */
    public function typeMedia()
    {
        return $this->belongsTo(TypeMedia::class, 'id_type_media', 'id_type_media');
    }

    /**
     * Accessor pour l'URL complète
     */
    public function getUrlAttribute()
    {
        // Si le chemin est déjà une URL complète
        if (strpos($this->chemin, 'http') === 0) {
            return $this->chemin;
        }

        // Si le chemin contient déjà adminlte/img
        if (strpos($this->chemin, 'adminlte/img/') === 0) {
            return asset($this->chemin);
        }

        // Sinon, construire l'URL
        return asset('adminlte/img/' . $this->chemin);
    }
}
