<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TipoTvideo
 *
 * @property $id
 * @property $tipo
 * @property $created_at
 * @property $updated_at
 *
 * @property RegistroCpu[] $registroCpuses
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TipoTvideo extends Model
{
    use SoftDeletes;
    use Auditable;
    protected $perPage = 50;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['tipo'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function registroCpuses()
    {
        return $this->hasMany(\App\Models\RegistroCpu::class, 'id', 'tipotvideo_id');
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
