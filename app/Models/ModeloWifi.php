<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ModeloWifi
 *
 * @property $id
 * @property $modelo
 * @property $created_at
 * @property $updated_at
 * @property $eliminado
 * @property $fecha_eliminacion
 * @property $deleted_at
 *
 * @property Laptop[] $laptops
 * @property RegistroCpu[] $registroCpuses
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ModeloWifi extends Model
{
    use SoftDeletes;
    use Auditable;

    protected $perPage = 50;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['modelo'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function laptops()
    {
        return $this->hasMany(\App\Models\Laptop::class, 'id', 'modcawifi_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function registroCpuses()
    {
        return $this->hasMany(\App\Models\RegistroCpu::class, 'id', 'modcawifi_id');
    }

    protected function modelo():Attribute
    {
        return new Attribute(
            set:function($modelo){
                return mb_strtoupper($modelo);
            }
        );
    }
    
}
