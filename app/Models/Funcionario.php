<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Servicio;
/**
 * Class Funcionario
 *
 * @property $id
 * @property $grado_academico
 * @property $paterno
 * @property $materno
 * @property $nombre
 * @property $ci
 * @property $expedido
 * @property $cargo
 * @property $celular
 * @property $dependencia_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Impresora[] $impresoras
 * @property Dependencia $dependencia
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Funcionario extends Model
{
    use SoftDeletes;
    use Auditable;
    protected $perPage = 500;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['grado_academico', 'paterno', 'materno', 'nombre', 'ci', 'expedido', 'cargo', 'email', 'celular','dependencia_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */


    public function servicios()
    {
        return $this->hasMany(Servicio::class);
    }

    public function impresoras()
    {
        return $this->hasMany(\App\Models\Impresora::class, 'id', 'funcionario_id');
    }
    public function cpus()
    {
        return $this->hasMany(\App\Models\RegistroCpu::class, 'id', 'funcionario_id');
    }
    public function audifono()
    {
        return $this->hasMany(\App\Models\Audifono::class, 'id', 'funcionario_id');
    }
    public function estabilizador()
    {
        return $this->hasMany(\App\Models\Estabilizador::class, 'id', 'funcionario_id');
    }
    public function parlante()
    {
        return $this->hasMany(\App\Models\Parlante::class, 'id', 'funcionario_id');
    }
    public function mouse()
    {
        return $this->hasMany(\App\Models\Raton::class, 'id', 'funcionario_id');
    }
    public function monitor()
    {
        return $this->hasMany(\App\Models\Monitor::class, 'id', 'funcionario_id');
    }
    public function teclado()
    {
        return $this->hasMany(\App\Models\Teclado::class, 'id', 'funcionario_id');
    }
    public function ups()
    {
        return $this->hasMany(\App\Models\Upese::class, 'id', 'funcionario_id');
    }

    public function dependencia()
    {
        return $this->belongsTo(\App\Models\Dependencia::class, 'dependencia_id', 'id');
    }

        protected function paterno(): Attribute
    {
        return new Attribute(
            set: function ($paterno) {
                return empty($paterno) ? null : mb_strtoupper($paterno);
            }
        );
    }
        protected function materno(): Attribute
    {
        return new Attribute(
            set: function ($materno) {
                return empty($materno) ? null : mb_strtoupper($materno);
            }
        );
    }
        protected function nombre(): Attribute
    {
        return new Attribute(
            set: function ($nombre) {
                return empty($nombre) ? null : mb_strtoupper($nombre);
            }
        );
    }
    protected function cargo(): Attribute
    {
        return new Attribute(
            set: function ($cargo) {
                return empty($cargo) ? null : mb_strtoupper($cargo);
            }
        );
    }
    protected function expedido(): Attribute
    {
        return new Attribute(
            set: function ($expedido) {
                return empty($expedido) ? null : mb_strtoupper($expedido);
            }
        );
    }
    
}
