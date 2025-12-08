<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_region
 * @property string $nom_region
 * @property string|null $description
 * @property int|null $population
 * @property float|null $superficie
 * @property string|null $localisation
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contenu> $contenus
 * @property-read int|null $contenus_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Parler> $parler
 * @property-read int|null $parler_count
 * @method static \Database\Factories\RegionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region whereIdRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region whereLocalisation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region whereNomRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region wherePopulation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region whereSuperficie($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Region extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_region';
    protected $fillable = [
        'nom_region',
        'description',
        'population',
        'superficie',
        'localisation',
    ];

    public function contenus()
    {
        return $this->hasMany(Contenu::class, 'id_region');
    }

    public function parler()
    {
        return $this->hasMany(Parler::class, 'id_region');
    }
}
