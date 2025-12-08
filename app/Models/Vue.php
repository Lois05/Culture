<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vue extends Model
{
    protected $table = 'vues';
    protected $primaryKey = 'id_vue';

    protected $fillable = ['id_contenu', 'ip_address', 'user_id'];

    public function contenu()
    {
        return $this->belongsTo(Contenu::class, 'id_contenu');
    }

    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
