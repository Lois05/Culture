<?php
// app/Models/UserSubscription.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont assignables en masse.
     *
     * @var array<string>
     */
    protected $fillable = [
        'user_id',
        'abonnement_id',
        'type',
        'date_debut',
        'date_fin',
        'statut',
        'montant'
    ];

    /**
     * Les attributs qui doivent être castés.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_debut' => 'datetime',
        'date_fin' => 'datetime',
        'montant' => 'decimal:2'
    ];

    /**
     * Les attributs par défaut.
     *
     * @var array
     */
    protected $attributes = [
        'statut' => 'actif'
    ];

    /**
     * Relation avec l'utilisateur.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Vérifier si l'abonnement est actif.
     */
    public function isActive(): bool
    {
        return $this->statut === 'actif' && $this->date_fin->isFuture();
    }

    /**
     * Vérifier si l'abonnement a expiré.
     */
    public function isExpired(): bool
    {
        return $this->date_fin->isPast();
    }

    /**
     * Vérifier si l'abonnement est annulé.
     */
    public function isCancelled(): bool
    {
        return $this->statut === 'annulé';
    }

    /**
     * Récupérer le temps restant avant expiration.
     */
    public function getTimeRemainingAttribute(): string
    {
        if ($this->isExpired()) {
            return 'Expiré';
        }

        $remaining = now()->diff($this->date_fin);

        if ($remaining->days > 30) {
            return $remaining->m . ' mois ' . $remaining->d . ' jours';
        } elseif ($remaining->days > 0) {
            return $remaining->days . ' jours';
        } else {
            return $remaining->h . ' heures ' . $remaining->i . ' minutes';
        }
    }

    /**
     * Récupérer le montant formaté.
     */
    public function getFormattedAmountAttribute(): string
    {
        return number_format($this->montant, 0, ',', ' ') . ' FCFA';
    }

    /**
     * Récupérer la durée formatée.
     */
    public function getDurationAttribute(): string
    {
        $diff = $this->date_debut->diff($this->date_fin);

        if ($diff->days > 365) {
            return $diff->y . ' an' . ($diff->y > 1 ? 's' : '');
        } elseif ($diff->days > 30) {
            return $diff->m . ' mois';
        } else {
            return $diff->days . ' jour' . ($diff->days > 1 ? 's' : '');
        }
    }

    /**
     * Récupérer le type formaté.
     */
    public function getFormattedTypeAttribute(): string
    {
        return match($this->type) {
            'monthly' => 'Mensuel',
            'yearly' => 'Annuel',
            'lifetime' => 'À vie',
            default => ucfirst($this->type)
        };
    }

    /**
     * Activer l'abonnement.
     */
    public function activate(): bool
    {
        return $this->update([
            'statut' => 'actif',
            'date_debut' => now(),
            'date_fin' => $this->calculateEndDate()
        ]);
    }

    /**
     * Annuler l'abonnement.
     */
    public function cancel(): bool
    {
        return $this->update(['statut' => 'annulé']);
    }

    /**
     * Calculer la date de fin.
     */
    private function calculateEndDate()
    {
        return match($this->type) {
            'monthly' => now()->addMonth(),
            'yearly' => now()->addYear(),
            'lifetime' => now()->addYears(100),
            default => now()->addMonth()
        };
    }

    /**
     * Vérifier si l'utilisateur a un abonnement actif.
     */
    public static function userHasActiveSubscription($userId): bool
    {
        $subscription = self::where('user_id', $userId)
            ->where('statut', 'actif')
            ->where('date_fin', '>', now())
            ->first();

        return $subscription !== null;
    }

    /**
     * Récupérer l'abonnement actif d'un utilisateur.
     */
    public static function getUserActiveSubscription($userId)
    {
        return self::where('user_id', $userId)
            ->where('statut', 'actif')
            ->where('date_fin', '>', now())
            ->first();
    }

    /**
     * Récupérer l'historique des abonnements d'un utilisateur.
     */
    public static function getUserSubscriptionHistory($userId, $limit = 10)
    {
        return self::where('user_id', $userId)
            ->latest('date_debut')
            ->take($limit)
            ->get();
    }

    /**
     * Créer un nouvel abonnement pour un utilisateur.
     */
    public static function createSubscription($userId, $abonnementId, $type, $amount)
    {
        $dateFin = match($type) {
            'monthly' => now()->addMonth(),
            'yearly' => now()->addYear(),
            'lifetime' => now()->addYears(100),
            default => now()->addMonth()
        };

        // Désactiver les anciens abonnements
        self::where('user_id', $userId)
            ->where('statut', 'actif')
            ->update(['statut' => 'expiré']);

        // Créer le nouvel abonnement
        return self::create([
            'user_id' => $userId,
            'abonnement_id' => $abonnementId,
            'type' => $type,
            'date_debut' => now(),
            'date_fin' => $dateFin,
            'statut' => 'actif',
            'montant' => $amount
        ]);
    }
}
