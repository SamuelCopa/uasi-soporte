<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CapacidadTvideo
 *
 * @property $id
 * @property $capacidad
 * @property $created_at
 * @property $updated_at
 *
 * @property RegistroCpu[] $registroCpuses
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class CapacidadTvideo extends Model
{
    use SoftDeletes;
    use Auditable;
    protected $perPage = 100;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['capacidad'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function registroCpuses()
    {
        return $this->hasMany(\App\Models\RegistroCpu::class, 'id', 'capactvideo_id');
    }

    protected function capacidad():Attribute
    {
        return new Attribute(
            set:function($capacidad){
                return mb_strtoupper($capacidad);
            }
        );
        
    }
    
    
}
