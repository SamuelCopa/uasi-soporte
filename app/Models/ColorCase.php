<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;

//use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class ColorCase
 *
 * @property $id
 * @property $color
 * @property $created_at
 * @property $updated_at
 *
 * @property RegistroCpu[] $registroCpuses
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ColorCase extends Model
{
    use SoftDeletes;
    use Auditable;
    protected $perPage = 100;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['color'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function registroCpuses()
    {
        return $this->hasMany(\App\Models\RegistroCpu::class, 'id', 'colorcase_id');
    }

    protected function color():Attribute
    {
        return new Attribute(
            set:function($color){
                return mb_strtoupper($color);
            }
        );
        
    }
    

   // use SoftDeletes;


    
}
