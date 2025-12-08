<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_langue
 * @property string $nom_langue
 * @property string|null $code_langue
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\LangueFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Langue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Langue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Langue query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Langue whereCodeLangue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Langue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Langue whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Langue whereIdLangue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Langue whereNomLangue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Langue whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Langue extends Model
{
    use HasFactory;

    protected $table = 'langues';
    protected $primaryKey = 'id_langue'; // important car pas 'id'

    protected $fillable = ['nom_langue', 'code_langue', 'description'];
}
