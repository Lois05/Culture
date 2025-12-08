<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Crypt;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id';

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
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'date_naissance' => 'date',
        'date_inscription' => 'datetime',
    ];

    /**
     * Relation avec le rôle - CORRIGÉ
     * users.id_role → roles.id
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
     * Relation avec les contenus
     */
    public function contenus()
    {
        return $this->hasMany(Contenu::class, 'id_auteur', 'id');
    }

    /**
     * Accesseur pour le nom complet
     */
    public function getNomCompletAttribute()
    {
        return ($this->prenom ?? '') . ' ' . $this->name;
    }

    /**
     * Accesseur pour l'URL de la photo
     */
    public function getPhotoUrlAttribute()
    {
        if ($this->photo && file_exists(storage_path('app/public/' . $this->photo))) {
            return asset('storage/' . $this->photo);
        }

        // Photo par défaut avec initiales
        $initials = strtoupper(
            substr($this->prenom ?? $this->name, 0, 1) .
            substr($this->name, 0, 1)
        );

        return "https://ui-avatars.com/api/?name={$initials}&background=random&color=fff&size=150";
    }

    /**
     * Accesseur pour l'âge
     */
    public function getAgeAttribute()
    {
        if (!$this->date_naissance) {
            return null;
        }

        return $this->date_naissance->age;
    }

    /**
     * Vérifie si l'utilisateur est admin
     */
    public function isAdmin()
    {
        return $this->role && $this->role->nom_role === 'Administrateur';
    }

    /**
     * Vérifie si l'utilisateur est actif
     */
    public function isActive()
    {
        return $this->statut === 'actif';
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
}

