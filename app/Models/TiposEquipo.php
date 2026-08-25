<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\OtrosEquipo;

/**
 * Class TiposEquipo
 *
 * @property $id
 * @property $nombre
 * @property $descripcion
 * @property $activo
 * @property $created_at
 * @property $updated_at
 *
 * @property OtrosEquipo[] $otrosEquipos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TiposEquipo extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nombre', 'descripcion', 'activo'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function otrosEquipos()
    {
        return $this->hasMany(OtrosEquipo::class, 'tipo_equipo_id');
    }
    
}
