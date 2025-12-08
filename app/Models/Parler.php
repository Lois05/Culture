<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_parler
 * @property int $id_region
 * @property int $id_langue
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Langue $langue
 * @property-read \App\Models\Region $region
 * @method static \Database\Factories\ParlerFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parler newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parler newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parler query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parler whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parler whereIdLangue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parler whereIdParler($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parler whereIdRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parler whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Parler extends Model
{
    use HasFactory;

    protected $table = 'parler';
    protected $primaryKey = 'id_parler';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = ['id_region', 'id_langue'];

    public function getRouteKeyName()
    {
        return 'id_parler';
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'id_region');
    }

    public function langue()
    {
        return $this->belongsTo(Langue::class, 'id_langue');
    }
}
