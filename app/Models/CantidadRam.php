<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CantidadRam
 *
 * @property $id
 * @property $cantidad
 * @property $created_at
 * @property $updated_at
 *
 * @property Laptop[] $laptops
 * @property Laptop[] $laptops
 * @property RegistroCpu[] $registroCpuses
 * @property RegistroCpu[] $registroCpuses
 * @property RegistroCpu[] $registroCpuses
 * @property RegistroCpu[] $registroCpuses
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class CantidadRam extends Model
{
    use SoftDeletes;
    use Auditable;
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['cantidad'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function laptops2()
    {
        return $this->hasMany(\App\Models\Laptop::class, 'id', 'cantidad2_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function laptops()
    {
        return $this->hasMany(\App\Models\Laptop::class, 'id', 'cantidad_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function registroCpuses2()
    {
        return $this->hasMany(\App\Models\RegistroCpu::class, 'id', 'cantidad2_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function registroCpuses3()
    {
        return $this->hasMany(\App\Models\RegistroCpu::class, 'id', 'cantidad3_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function registroCpuses4()
    {
        return $this->hasMany(\App\Models\RegistroCpu::class, 'id', 'cantidad4_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function registroCpuses()
    {
        return $this->hasMany(\App\Models\RegistroCpu::class, 'id', 'cantidad_id');
    }
    
}
