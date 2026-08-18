<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class MarcaTwifi
 *
 * @property $id
 * @property $marca
 * @property $created_at
 * @property $updated_at
 *
 * @property RegistroCpu[] $registroCpuses
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class MarcaTwifi extends Model
{
    use SoftDeletes;
    use Auditable;
    protected $perPage = 50;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['marca'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function registroCpuses()
    {
        return $this->hasMany(\App\Models\RegistroCpu::class, 'id', 'marcawifi_id');
    }
    
    protected function marca():Attribute
    {
        return new Attribute(
            set:function($marca){
                return mb_strtoupper($marca);
            }
        );
        
    }
}
