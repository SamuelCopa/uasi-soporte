<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Resultado
 *
 * @property $id
 * @property $nombre
 * @property $created_at
 * @property $updated_at
 *
 * @property Registro[] $registros
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Resultado extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nombre'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function registros()
    {
        return $this->hasMany(\App\Models\Registro::class, 'id', 'resultado_id');
    }
    
}
