<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contenu extends Model
{
    use HasFactory;

    protected $dates = ['date_creation'];

    protected $casts = [
        'date_creation' => 'datetime',
        'is_premium' => 'boolean',
        'prix' => 'decimal:2',
    ];

    protected $table = 'contenus';
    protected $primaryKey = 'id_contenu';
    public $timestamps = true;

    protected $fillable = [
        'titre',
        'texte',
        'date_creation',
        'statut',
        'parent_id',
        'id_region',
        'id_langue',
        'id_moderateur',
        'id_type_contenu',
        'id_auteur',
        'is_premium',
        'prix',
        'description'
    ];

    public function typeContenu()
    {
        return $this->belongsTo(TypeContenu::class, 'id_type_contenu', 'id_type_contenu');
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'id_region', 'id_region');
    }

    public function auteur()
    {
        return $this->belongsTo(User::class, 'id_auteur', 'id');
    }

    public function langue()
    {
        return $this->belongsTo(Langue::class, 'id_langue', 'id_langue');
    }

    public function medias()
    {
        return $this->hasMany(Media::class, 'id_contenu', 'id_contenu');
    }

    public function achats()
    {
        return $this->hasMany(Achat::class, 'contenu_id', 'id_contenu');
    }

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class, 'id_contenu', 'id_contenu');
    }

    // Dans app/Models/Contenu.php

/**
 * Calculer les mots restants après le teaser
 */
public function getRemainingWords($previewPercentage = 40): int
{
    $fullText = strip_tags($this->texte);
    $fullWords = str_word_count($fullText);

    $previewWords = ceil(($previewPercentage / 100) * $fullWords);
    $remainingWords = max(0, $fullWords - $previewWords);

    return $remainingWords;
}

/**
 * Temps de lecture restant
 */
public function getRemainingReadingTime($previewPercentage = 40): int
{
    $remainingWords = $this->getRemainingWords($previewPercentage);
    return ceil($remainingWords / 200);
}
}
