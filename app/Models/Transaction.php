<?php
// app/Models/Transaction.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont assignables en masse.
     *
     * @var array<string>
     */
    protected $fillable = [
        'user_id',
        'reference',
        'amount',
        'currency',
        'operator',
        'phone_number',
        'description',
        'status',
        'metadata',
        'completed_at'
    ];

    /**
     * Les attributs qui doivent être castés.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'amount' => 'decimal:2',
        'metadata' => 'array',
        'completed_at' => 'datetime'
    ];

    /**
     * Les attributs par défaut.
     *
     * @var array
     */
    protected $attributes = [
        'status' => 'pending',
        'currency' => 'FCFA'
    ];

    /**
     * Relation avec l'utilisateur.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Vérifier si la transaction est terminée.
     */
    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    /**
     * Vérifier si la transaction a échoué.
     */
    public function isFailed(): bool
    {
        return $this->status === 'failed';
    }

    /**
     * Vérifier si la transaction est en attente.
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Marquer la transaction comme terminée.
     */
    public function markAsCompleted(): bool
    {
        return $this->update([
            'status' => 'completed',
            'completed_at' => now()
        ]);
    }

    /**
     * Marquer la transaction comme échouée.
     */
    public function markAsFailed(): bool
    {
        return $this->update(['status' => 'failed']);
    }

    /**
     * Récupérer le montant formaté.
     */
    public function getFormattedAmountAttribute(): string
    {
        return number_format($this->amount, 0, ',', ' ') . ' ' . $this->currency;
    }

    /**
     * Récupérer la date formatée.
     */
    public function getFormattedDateAttribute(): string
    {
        return $this->created_at->format('d/m/Y H:i');
    }

    /**
     * Récupérer les métadonnées sous forme de tableau.
     */
    public function getMetadataAttribute($value)
    {
        return json_decode($value, true) ?? [];
    }

    /**
     * Définir les métadonnées.
     */
    public function setMetadataAttribute($value)
    {
        $this->attributes['metadata'] = json_encode($value);
    }

    /**
     * Récupérer les transactions récentes d'un utilisateur.
     */
    public static function getUserTransactions($userId, $limit = 10)
    {
        return self::where('user_id', $userId)
            ->latest()
            ->take($limit)
            ->get();
    }

    /**
     * Trouver une transaction par référence.
     */
    public static function findByReference($reference)
    {
        return self::where('reference', $reference)->first();
    }

    /**
     * Générer une référence unique.
     */
    public static function generateReference(): string
    {
        do {
            $reference = 'TRX_' . date('YmdHis') . '_' . strtoupper(uniqid());
        } while (self::where('reference', $reference)->exists());

        return $reference;
    }
}
