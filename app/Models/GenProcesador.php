<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class GenProcesador
 *
 * @property $id
 * @property $generacion
 * @property $created_at
 * @property $updated_at
 *
 * @property RegistroCpu[] $registroCpuses
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class GenProcesador extends Model
{
    use SoftDeletes;
    use Auditable;
    protected $perPage = 50;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['generacion'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function registroCpuses()
    {
        return $this->hasMany(\App\Models\RegistroCpu::class, 'id', 'genprocesador_id');
    }
    
    // protected function generacion():Attribute
    // {
    //     return new Attribute(
    //         set:function($generacion){
    //             return mb_strtoupper($generacion);
    //         }
    //     );
        
    // }
    
}
