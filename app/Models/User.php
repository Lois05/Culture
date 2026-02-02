<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'prenom', 'email', 'password', 'photo', 'sexe',
        'date_naissance', 'id_langue', 'id_role', 'statut'
    ];

    protected $casts = [
    'date_naissance' => 'date',
    'date_inscription' => 'datetime',
];

    protected $hidden = ['password', 'remember_token'];

    // ==================== RELATIONS ====================

    /**
     * Relation avec le modèle Role
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role');
    }

    /**
     * Relation avec le modèle Langue
     */
    public function langue()
    {
        return $this->belongsTo(Langue::class, 'id_langue');
    }

    /**
     * Relation avec les contenus (si l'utilisateur en a créé)
     */
    public function contenus()
    {
        return $this->hasMany(Contenu::class, 'id_auteur');
    }

    /**
     * Relation avec les commentaires
     */
      public function commentaires()
    {
        // Utilisez 'id_utilisateur' comme clé étrangère
        return $this->hasMany(Commentaire::class, 'id_utilisateur');
    }

    /**
     * Relation avec les likes
     */
    public function likes()
    {
        return $this->hasMany(Like::class, 'id_utilisateur');
    }

    /**
     * Relation avec les favoris/bookmarks
     */
    public function favoris()
    {
        return $this->hasMany(Favori::class, 'id_utilisateur');
    }

    /**
     * Relation avec les abonnements (utilisateurs suivis)
     */
    public function abonnements()
    {
        return $this->hasMany(Abonnement::class, 'id_utilisateur');
    }

    /**
     * Relation avec les abonnés
     */
    public function abonnes()
    {
        return $this->hasMany(Abonnement::class, 'id_auteur');
    }

    // ==================== MÉTHODES D'ACCÈS ====================

    /**
     * Vérifier si l'utilisateur peut accéder à un contenu premium
     */
    public function canAccessContent($contenu): bool
    {
        // Si le contenu n'est pas premium, accès libre
        if (!$contenu->is_premium) {
            return true;
        }

        // Vérifier l'abonnement actif
        if ($this->hasActiveSubscription()) {
            return true;
        }

        return false;
    }

    /**
     * Vérifier si l'utilisateur a un abonnement actif
     */
    public function hasActiveSubscription(): bool
    {
        // Vérifier si l'utilisateur est premium
        if ($this->est_premium && $this->premium_jusque > now()) {
            return true;
        }

        // Vérifier les abonnements en base si existent
        if (class_exists(\App\Models\UserSubscription::class)) {
            return \App\Models\UserSubscription::where('user_id', $this->id)
                ->where('statut', 'actif')
                ->where('date_fin', '>', now())
                ->exists();
        }

        return false;
    }

    /**
     * Vérifier si l'utilisateur est admin
     */
    public function isAdmin(): bool
    {
        // Méthode 1: Via la relation
        if ($this->role) {
            return in_array($this->role->nom_role ?? '', ['Super Admin', 'Admin']);
        }

        // Méthode 2: Via id_role (fallback)
        return in_array($this->id_role, [1, 2]); // 1 = Super Admin, 2 = Admin
    }

    /**
     * Vérifier si l'utilisateur est actif
     */
    public function isActive(): bool
    {
        return $this->statut === 'actif';
    }

    /**
     * Récupérer le nom complet
     */
    public function getFullNameAttribute(): string
    {
        return ($this->prenom ? $this->prenom . ' ' : '') . $this->name;
    }

    /**
     * Récupérer l'URL de la photo
     */
    public function getPhotoUrlAttribute()
    {
        if ($this->photo && file_exists(public_path($this->photo))) {
            return asset($this->photo);
        }
        return asset('adminlte/img/default-avatar.jpg');
    }

    /**
     * Récupérer le nom du rôle
     */
    public function getRoleNameAttribute()
    {
        return $this->role ? $this->role->nom_role : 'Utilisateur';
    }

    /**
     * Récupérer la langue préférée
     */
    public function getPreferredLangueAttribute()
    {
        return $this->langue ? $this->langue->nom_langue : 'Français';
    }

    /**
     * Vérifier si l'utilisateur peut modifier un contenu
     */
    public function canEditContent($contenu): bool
    {
        // L'admin peut tout modifier
        if ($this->isAdmin()) {
            return true;
        }

        // L'auteur peut modifier son propre contenu
        return $this->id === $contenu->id_auteur;
    }
}
