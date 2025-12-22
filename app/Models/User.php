<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Crypt;
use App\HasCloudinaryImage;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasCloudinaryImage;

    protected $table = 'users';
    protected $primaryKey = 'id';

    // Champs remplissables
    protected $fillable = [
        'name',
        'prenom',
        'email',
        'password',
        'sexe',
        'date_naissance',
        'photo',
        'id_role',
        'id_langue',
        'statut',
        'date_inscription',
        'id_abonnement',
        'date_debut_abonnement',
        'date_fin_abonnement',
        'statut_abonnement',
        // Champs Cloudinary
        'cloudinary_url',
        'cloudinary_public_id',
        'has_cloudinary',
        'image_thumbnail'
    ];

    // Accessors disponibles
    protected $appends = ['image_url', 'thumbnail_url', 'nom_complet', 'photo_url'];

    // Champs cachés
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Casts
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'date_naissance' => 'date',
        'date_inscription' => 'datetime',
    ];

    /**
     * Relation avec le rôle
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role', 'id');
    }

    /**
     * Relation avec la langue
     */
    public function langue()
    {
        return $this->belongsTo(Langue::class, 'id_langue', 'id_langue');
    }

    /**
     * Relation avec les contenus (en tant qu'auteur)
     */
    public function contenus()
    {
        return $this->hasMany(Contenu::class, 'id_auteur', 'id');
    }

    /**
     * Nom complet
     */
    public function getNomCompletAttribute()
    {
        return ($this->prenom ? $this->prenom . ' ' : '') . $this->name;
    }

    /**
     * URL de la photo (alias pour image_url)
     */
    public function getPhotoUrlAttribute()
    {
        return $this->image_url;
    }

    /**
     * Âge
     */
    public function getAgeAttribute()
    {
        if (!$this->date_naissance) {
            return null;
        }
        return $this->date_naissance->age;
    }

    /**
     * Vérifie si admin
     */
    public function isAdmin()
    {
        return $this->role && $this->role->nom_role === 'Administrateur';
    }

    /**
     * Vérifie si actif
     */
    public function isActive()
    {
        return $this->statut === 'actif';
    }

    /**
     * Upload une photo de profil
     */
    public function uploadPhoto($file)
    {
        // Garde l'ancien nom
        $this->photo = $file->getClientOriginalName();

        // Upload vers Cloudinary
        if ($this->uploadToCloudinary($file, [
            'folder' => 'culture_app/users',
            'public_id' => 'user_' . $this->id . '_' . time()
        ])) {
            $this->save();
            return true;
        }

        return false;
    }

     public function setGoogle2faSecretAttribute($value)
    {
        $this->attributes['google2fa_secret'] = Crypt::encrypt($value);
    }

    public function getGoogle2faSecretAttribute($value)
    {
        return $value ? Crypt::decrypt($value) : null;
    }

    public function setBackupCodesAttribute($value)
    {
        if ($value) {
            $this->attributes['backup_codes'] = Crypt::encrypt(json_encode($value));
        } else {
            $this->attributes['backup_codes'] = null;
        }
    }

    public function getBackupCodesAttribute($value)
    {
        if (!$value) {
            return [];
        }
        try {
            return json_decode(Crypt::decrypt($value), true);
        } catch (\Exception $e) {
            return [];
        }
    }

      /**
     * Relation avec les transactions.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Relation avec les abonnements.
     */
    public function subscriptions()
    {
        return $this->hasMany(UserSubscription::class);
    }

    /**
     * Récupérer l'abonnement actif.
     */
    public function activeSubscription()
    {
        return $this->hasOne(UserSubscription::class)
            ->where('statut', 'actif')
            ->where('date_fin', '>', now())
            ->latest();
    }

    /**
     * Vérifier si l'utilisateur a un abonnement actif.
     */
    public function hasActiveSubscription(): bool
    {
        return UserSubscription::userHasActiveSubscription($this->id);
    }

    /**
     * Récupérer le type d'abonnement actif.
     */
    public function getSubscriptionTypeAttribute()
    {
        $subscription = $this->activeSubscription;
        return $subscription ? $subscription->type : null;
    }

    /**
     * Récupérer le niveau d'abonnement.
     */
    public function getSubscriptionLevelAttribute()
    {
        $subscription = $this->activeSubscription;
        return $subscription ? $subscription->abonnement_id : 0;
    }

    /**
     * Récupérer les transactions récentes.
     */
    public function recentTransactions($limit = 5)
    {
        return $this->transactions()
            ->latest()
            ->take($limit)
            ->get();
    }

    /**
     * Ajouter une transaction.
     */
    public function addTransaction($data)
    {
        return $this->transactions()->create($data);
    }
}

