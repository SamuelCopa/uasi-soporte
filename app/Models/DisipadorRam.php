<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DisipadorRam
 *
 * @property $id
 * @property $opcion
 * @property $created_at
 * @property $updated_at
 *
 * @property RegistroCpu[] $registroCpuses
 * @property RegistroCpu[] $registroCpuses2
 * @property RegistroCpu[] $registroCpuses3
 * @property RegistroCpu[] $registroCpuses4
 * @property RegistroCpu[] $registroCpuses5
 * @property RegistroCpu[] $registroCpuses6
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class DisipadorRam extends Model
{
    use SoftDeletes;
    use Auditable;
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['opcion'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function registroCpuses2()
    {
        return $this->hasMany(\App\Models\RegistroCpu::class, 'id', 'disipador2_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function registroCpuses3()
    {
        return $this->hasMany(\App\Models\RegistroCpu::class, 'id', 'disipador3_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function registroCpuses4()
    {
        return $this->hasMany(\App\Models\RegistroCpu::class, 'id', 'disipador4_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function registroCpuses()
    {
        return $this->hasMany(\App\Models\RegistroCpu::class, 'id', 'disipador_id');
    }

        /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function registroCpuses5()
    {
        return $this->hasMany(\App\Models\RegistroCpu::class, 'id', 'cable_id');
    }

        /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function registroCpuses6()
    {
        return $this->hasMany(\App\Models\RegistroCpu::class, 'id', 'antena_id');
    }
    
}
