<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PotenciaFuente
 *
 * @property $id
 * @property $potencia
 * @property $created_at
 * @property $updated_at
 *
 * @property RegistroCpu[] $registroCpuses
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class PotenciaFuente extends Model
{
    use SoftDeletes;
    use Auditable;
    protected $perPage = 50;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['potencia'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function registroCpuses()
    {
        return $this->hasMany(\App\Models\RegistroCpu::class, 'id', 'potfuente_id');
    }

    protected function potencia():Attribute
    {
        return new Attribute(
            set:function($potencia){
                return mb_strtoupper($potencia);
            }
        );
        
    }
    
}
