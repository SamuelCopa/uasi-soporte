<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

/**
 * Class Responsable
 *
 * @property $id
 * @property $nombre
 * @property $cargo
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property Reporte[] $reportes
 * @property Reporte[] $reportes
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Responsable extends Model
{
    use SoftDeletes;
    use Auditable;

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nombre', 'cargo'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

        public function impresoras()
    {
        return $this->hasMany(Impresora::class);
    }

        public function audifono()
    {
        return $this->hasMany(Audifono::class);
    }

        public function estabilizador()
    {
        return $this->hasMany(Estabilizador::class);
    }

        public function raton()
    {
        return $this->hasMany(Raton::class);
    }

        public function teclado()
    {
        return $this->hasMany(Teclado::class);
    }

        public function monitor()
    {
        return $this->hasMany(Monitor::class);
    }

        public function registroCpu()
    {
        return $this->hasMany(RegistroCpu::class);
    }

        public function parlante()
    {
        return $this->hasMany(Parlante::class);
    }

        public function upese()
    {
        return $this->hasMany(Upese::class);
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
    
}
