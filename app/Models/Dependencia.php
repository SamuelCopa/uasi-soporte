<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Dependencia
 *
 * @property $id
 * @property $dependencias
 * @property $created_at
 * @property $updated_at
 *
 * @property RegistroCpu[] $registroCpuses
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Dependencia extends Model
{
    use SoftDeletes;
    use Auditable;
    protected $perPage = 500;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['dependencias'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function registroCpuses()
    {
        return $this->hasMany(\App\Models\RegistroCpu::class, 'id', 'dependencia_id');
    }

    public function dependencia()
    {
        return $this->hasMany(\App\Models\Funcionario::class, 'id', 'dependencia_id');
    }

    protected function dependencias():Attribute
    {
        return new Attribute(
            set:function($dependencias){
                return mb_strtoupper($dependencias);
            }
        );
        
    }

    public function servicios()
    {
        return $this->hasMany(Servicio::class);
    }
    
}
