<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TipoRam
 *
 * @property $id
 * @property $tipo
 * @property $created_at
 * @property $updated_at
 *
 * @property Laptop[] $laptops
 * @property Laptop[] $laptops2
 * @property RegistroCpu[] $registroCpuses
 * @property RegistroCpu[] $registroCpuses2
 * @property RegistroCpu[] $registroCpuses
 * @property RegistroCpu[] $registroCpuses
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TipoRam extends Model
{
    use SoftDeletes;
    use Auditable;
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['tipo'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function laptops2()
    {
        return $this->hasMany(\App\Models\Laptop::class, 'id', 'tiporam2_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function laptops()
    {
        return $this->hasMany(\App\Models\Laptop::class, 'id', 'tiporam_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function registroCpuses2()
    {
        return $this->hasMany(\App\Models\RegistroCpu::class, 'id', 'tiporam2_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function registroCpuses()
    {
        return $this->hasMany(\App\Models\RegistroCpu::class, 'id', 'tiporam_id');
    }

        protected function tipo():Attribute
    {
        return new Attribute(
            set:function($tipo){
                return mb_strtoupper($tipo);
            }
        );
        
    }
    
}
