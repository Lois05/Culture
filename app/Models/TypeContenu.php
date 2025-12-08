<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeContenu extends Model
{
    protected $table = 'type_contenus';
    protected $primaryKey = 'id_type_contenu';

    protected $fillable = ['nom_contenu'];

    public function contenus()
    {
        return $this->hasMany(Contenu::class, 'id_type_contenu');
    }

    // Accessor pour l'icône
    public function getIconeAttribute()
    {
        $icones = [
            'Vodoun' => 'fas fa-mask',
            'Art' => 'fas fa-palette',
            'Gastronomie' => 'fas fa-utensils',
            'Histoire' => 'fas fa-landmark',
            'Musique' => 'fas fa-music',
            'Danse' => 'fas fa-child',
            'Architecture' => 'fas fa-archway',
            'Traditions' => 'fas fa-hands',
            'Langues' => 'fas fa-language',
            'Coutumes' => 'fas fa-users',
        ];

        return $icones[$this->nom_contenu] ?? 'fas fa-star';
    }

    // Accessor pour la couleur
    public function getCouleurAttribute()
    {
        $couleurs = [
            'Vodoun' => '#8B4513',
            'Art' => '#FF6B6B',
            'Gastronomie' => '#4ECDC4',
            'Histoire' => '#45B7D1',
            'Musique' => '#96CEB4',
            'Danse' => '#FFEAA7',
            'Architecture' => '#DDA0DD',
            'Traditions' => '#98D8C8',
            'Langues' => '#F7DC6F',
            'Coutumes' => '#A569BD',
        ];

        return $couleurs[$this->nom_contenu] ?? '#6c757d';
    }
}
