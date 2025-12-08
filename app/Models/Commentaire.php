<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_commentaire
 * @property string $texte
 * @property int|null $note
 * @property string $date
 * @property int $id_utilisateur
 * @property int $id_contenu
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read \App\Models\Contenu $contenu
 * @property-read \App\Models\User $utilisateur
 * @method static \Database\Factories\CommentaireFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commentaire newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commentaire newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commentaire query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commentaire whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commentaire whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commentaire whereIdCommentaire($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commentaire whereIdContenu($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commentaire whereIdUtilisateur($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commentaire whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commentaire whereTexte($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commentaire whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Commentaire extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_commentaire'; // ← clé primaire personnalisée

    public $timestamps = false; // si pas de created_at / updated_at

    protected $fillable = [
        'texte',
        'note',
        'date',
        'id_utilisateur',
        'id_contenu'
    ];
    protected $casts = [
        'date' => 'datetime', // ⬅️ Ajoute cette ligne
    ];

    // Relations
    public function utilisateur() // optionnel : tu peux renommer user() → utilisateur() pour cohérence
    {
        return $this->belongsTo(User::class, 'id_utilisateur');
    }

    public function contenu()
    {
        return $this->belongsTo(Contenu::class, 'id_contenu');
    }
}
