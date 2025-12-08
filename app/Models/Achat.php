<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achat extends Model
{
    use HasFactory;

    protected $table = 'achats';
    protected $primaryKey = 'id_achat';

    protected $fillable = [
        'utilisateur_id',
        'contenu_id',
        'montant',
        'methode_paiement',
        'transaction_id',
        'statut',
        'date_achat'
    ];

    protected $casts = [
        'date_achat' => 'datetime',
        'montant' => 'decimal:2'
    ];

    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'utilisateur_id');
    }

    public function contenu()
    {
        return $this->belongsTo(Contenu::class, 'contenu_id');
    }
}
