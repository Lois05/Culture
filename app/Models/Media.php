<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    use HasFactory;

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
 *
 * @return string
 */
public function getUrlAttribute()
{
    /** @var \Illuminate\Contracts\Filesystem\Filesystem $disk */
    $disk = Storage::disk('public');
    return $disk->url($this->chemin);
}


    public function contenu()
    {
        return $this->belongsTo(Contenu::class, 'id_contenu');
    }

    public function typeMedia()
    {
        return $this->belongsTo(TypeMedia::class, 'id_type_media');
    }
}
