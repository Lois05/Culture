<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abonnement extends Model
{
    use HasFactory;

    protected $table = 'abonnements';

    // Si votre clé primaire est 'id', c'est bon
    // Sinon, spécifiez-la :
    // protected $primaryKey = 'id_abonnement';

    protected $fillable = [
        'nom',
        'description',
        'prix',
        'duree_jours',
        'statut',
        'recommandé',
    ];

    protected $casts = [
        'prix' => 'decimal:2',
        'duree_jours' => 'integer',
        'recommandé' => 'boolean',
    ];

    /**
     * Relation avec les paiements
     */
    public function paiements()
    {
        return $this->hasMany(Paiement::class, 'id_abonnement', 'id');
    }

    /**
     * Relation avec les utilisateurs
     */
    public function users()
    {
        return $this->hasMany(User::class, 'id_abonnement', 'id');
    }
}
