<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;

    protected $table = 'factures';
    protected $primaryKey = 'id_facture';

    protected $fillable = [
        'id_paiement',
        'numero_facture',
        'montant_ht',
        'tva',
        'montant_ttc',
        'statut',
        'date_emission',
        'date_paiement',
        'notes',
    ];

    protected $casts = [
        'montant_ht' => 'decimal:2',
        'tva' => 'decimal:2',
        'montant_ttc' => 'decimal:2',
        'date_emission' => 'datetime',
        'date_paiement' => 'datetime',
    ];

    /**
     * Relation avec le paiement
     */
    public function paiement()
    {
        return $this->belongsTo(Paiement::class, 'id_paiement', 'id');
    }
}
