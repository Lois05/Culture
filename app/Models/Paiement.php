<?php
// app/Models/Paiement.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    // Nom de la table (optionnel, Laravel le devine automatiquement)
    protected $table = 'paiements';

    // Champs remplissables
    protected $fillable = [
        'user_id',
        'transaction_id',
        'reference',
        'montant',
        'devise',
        'statut',
        'service',
        'type_service',
        'metadata',
        'date_paiement',
    ];

    // Casts (conversions de types)
    protected $casts = [
        'metadata' => 'array',
        'date_paiement' => 'datetime',
        'montant' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relation avec l'utilisateur
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope pour les paiements réussis
     */
    public function scopePayes($query)
    {
        return $query->where('statut', 'payé');
    }

    /**
     * Scope pour les paiements en attente
     */
    public function scopeEnAttente($query)
    {
        return $query->where('statut', 'en_attente');
    }

    /**
     * Scope pour les paiements échoués
     */
    public function scopeEchoues($query)
    {
        return $query->where('statut', 'échoué');
    }

    /**
     * Scope pour un service spécifique
     */
    public function scopeParService($query, $service)
    {
        return $query->where('service', $service);
    }

    /**
     * Vérifier si le paiement est réussi
     */
    public function estPaye()
    {
        return $this->statut === 'payé';
    }

    /**
     * Vérifier si le paiement est en attente
     */
    public function estEnAttente()
    {
        return $this->statut === 'en_attente';
    }

    /**
     * Formater le montant pour l'affichage
     */
    public function getMontantFormateAttribute()
    {
        return number_format($this->montant, 0, ',', ' ') . ' ' . $this->devise;
    }

    /**
     * Obtenir le statut formaté avec badge Bootstrap
     */
    public function getStatutBadgeAttribute()
    {
        $badges = [
            'en_attente' => '<span class="badge bg-warning">En attente</span>',
            'payé' => '<span class="badge bg-success">Payé</span>',
            'échoué' => '<span class="badge bg-danger">Échoué</span>',
            'annulé' => '<span class="badge bg-secondary">Annulé</span>',
            'remboursé' => '<span class="badge bg-info">Remboursé</span>',
        ];

        return $badges[$this->statut] ?? '<span class="badge bg-secondary">Inconnu</span>';
    }

    /**
     * Récupérer une métadonnée spécifique
     */
    public function getMetadonnee($key, $default = null)
    {
        $metadata = $this->metadata ?? [];
        return $metadata[$key] ?? $default;
    }

    /**
     * Déterminer le type de service à partir du nom
     */
    public function getTypeServiceAttribute($value)
    {
        if ($value) {
            return $value;
        }

        // Deviner le type de service à partir du nom
        if (str_contains(strtolower($this->service), 'publication')) {
            return 'publication';
        } elseif (str_contains(strtolower($this->service), 'badge') || str_contains(strtolower($this->service), 'expert')) {
            return 'badge';
        } elseif (str_contains(strtolower($this->service), 'formation') || str_contains(strtolower($this->service), 'cours')) {
            return 'formation';
        }

        return 'autre';
    }
}
