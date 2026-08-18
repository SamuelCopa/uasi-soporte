<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class Configuracion
 *
 * @property $id
 * @property $clave
 * @property $valor
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Configuracion extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['clave', 'valor'];
}
