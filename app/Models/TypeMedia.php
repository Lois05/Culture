<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeMedia extends Model
{
    use HasFactory;

    // Spécifiez explicitement le nom de la table
    protected $table = 'type_medias';

    // Spécifiez la clé primaire si différente de 'id'
    protected $primaryKey = 'id_type_media';

    protected $fillable = [
        'nom_media' // Selon votre migration
    ];

    public function medias()
    {
        return $this->hasMany(Media::class, 'id_type_media');
    }
}
