<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

/**
 * Class Impresora
 *
 * @property $cod_gamea
 * @property $tecnico
 * @property $cod_registro
 * @property $fecha
 * @property $fecha_inicio
 * @property $fecha_entrega
 * @property $marca
 * @property $modelo
 * @property $falla
 * @property $observaciones
 * @property $dependencia_id
 * @property $estado_id
 * @property $responsable_id
 * @property $user_id
 * @property $funcionario_id
 * @property $resultado_id
 * @property $reguser_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Dependencia $dependencia
 * @property Estado $estado
 * @property User $user
 * @property User $reguser
 * @property Responsable $responsable
 * @property Funcionario $funcionario
 * @property Resultado $resultado
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Impresora extends Model
{
    use SoftDeletes;
    use Auditable;
    protected $perPage = 1000;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['funcionario_id', 'cod_gamea', 'tecnico', 'cod_registro', 'fecha', 'fecha_inicio','fecha_entrega', 'marca', 'modelo', 'falla', 'observaciones', 'dependencia_id', 'estado_id','user_id', 'responsable_id','reguser_id','fecha_asignacion'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dependencia()
    {
        return $this->belongsTo(\App\Models\Dependencia::class, 'dependencia_id', 'id');
    }

        public function responsable(): BelongsTo
    {
        return $this->belongsTo(Responsable::class);
    }

        public function funcionario(): BelongsTo
    {
        return $this->belongsTo(Funcionario::class);
    }

    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estado()
    {
        return $this->belongsTo(\App\Models\Estado::class, 'estado_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }
    public function reguser()
    {
        return $this->belongsTo(User::class, 'reguser_id','id');

    }

    public function resultado()
    {
        return $this->belongsTo(Resultado::class, 'resultado_id','id');
    }
    protected static function booted()
    {
        static::creating(function ($model) {
            $model->reguser_id = Auth::id();
        });

        // static::updating(function ($model) {
        //     $model->reguser_id = Auth::id();
        // });
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
    protected function tecnico(): Attribute
    {
        return new Attribute(
            set: function ($tecnico) {
                return empty($tecnico) ? null : mb_strtoupper($tecnico);
            }
        );
    }
    protected function marca(): Attribute
    {
        return new Attribute(
            set: function ($marca) {
                return empty($marca) ? null : mb_strtoupper($marca);
            }
        );
    }
    protected function modelo(): Attribute
    {
        return new Attribute(
            set: function ($modelo) {
                return empty($modelo) ? null : mb_strtoupper($modelo);
            }
        );
    }

    protected function observaciones(): Attribute
    {
        return new Attribute(
            set: function ($observaciones) {
                return empty($observaciones) ? null : mb_strtoupper($observaciones);
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
    
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // public function users(): BelongsToMany
    // {
    //     return $this->belongsToMany(User::class);
    // }

    public function getTipoEquipo()
{
    return 'Impresora';
}

}
