<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Models\Dependencia;
use App\Models\Funcionario;
use Illuminate\Support\Str;
use App\Models\User;

/**
 * Class Servicio
 *
 * @property $id
 * @property $servicio
 * @property $equipo
 * @property $falla
 * @property $created_at
 * @property $updated_at
 * @property $user_id
 * @property $visto
 * @property $dependencia_id
 * @property $funcionario_id
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Servicio extends Model
{
    
    protected $perPage = 1000;
    
        use SoftDeletes;
        use Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['servicio', 'equipo', 'falla', 'user_id', 'visto', 'dependencia_id', 'funcionario_id'];

    protected static function booted()
{
    static::creating(function ($servicio) {

        if (!$servicio->token_evaluacion) {
            $servicio->token_evaluacion = Str::random(64);
        }

    });
}

public function tecnico()
{
    return $this->belongsTo(User::class, 'user_id');
}
    public function servicios()
    {
        return $this->hasMany(Servicio::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function equipo(): Attribute
    {
        return new Attribute(
            set: function ($equipo) {
                return empty($equipo) ? null : mb_strtoupper($equipo);
            }
        );
    }

        protected function falla(): Attribute
    {
        return new Attribute(
            set: function ($falla) {
                return empty($falla) ? null : mb_strtoupper($falla);
            }
        );
    }

        protected function servicio(): Attribute
    {
        return new Attribute(
            set: function ($servicio) {
                return empty($servicio) ? null : mb_strtoupper($servicio);
            }
        );
    }

    protected function fecha_asignacion(): Attribute
    {
        return new Attribute(
            set: function ($fecha_asignacion) {
                return empty($fecha_asignacion) ? null : mb_strtoupper($fecha_asignacion);
            }
        );
    }

    public function dependencia()
    {
        return $this->belongsTo(Dependencia::class);
    }

    public function funcionario()
{
    return $this->belongsTo(Funcionario::class);
}
}
