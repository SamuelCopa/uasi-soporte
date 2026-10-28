<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

/**
 * Class Laptop
 *
 * @property $id
 * @property $fecha
 * @property $fecha_inicio
 * @property $usuario
 * @property $contrasena
 * @property $cod_gamea
 * @property $cod_registro
 * @property $marca
 * @property $modelo
 * @property $falla
 * @property $respaldo
 * @property $observaciones
 * @property $otro
 * @property $fecha_entrega
 * @property $dependencia_id
 * @property $estado_id
 * @property $funcionario_id
 * @property $user_id
 * @property $responsable_id
 * @property $resultado_id
 * @property $reguser_id
 * @property $boton_oculto
 * @property $funcionario_activo
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property Dependencia $dependencia
 * @property Estado $estado
 * @property Funcionario $funcionario
 * @property User $user
 * @property Responsable $responsable
 * @property User $user
 * @property Resultado $resultado
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Laptop extends Model
{
    use SoftDeletes;
    use Auditable;

    protected $perPage = 1000;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['fecha', 'fecha_inicio', 'usuario', 'contrasena', 'cod_gamea', 'cod_registro', 'marca', 'modelo', 'falla', 'respaldo', 'observaciones', 'otro', 'fecha_entrega', 'dependencia_id', 'estado_id', 'funcionario_id', 'user_id', 'responsable_id', 'reguser_id', 'boton_oculto', 'funcionario_activo','fecha_asignacion', 'resultado_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dependencia()
    {
        return $this->belongsTo(\App\Models\Dependencia::class, 'dependencia_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estado()
    {
        return $this->belongsTo(\App\Models\Estado::class, 'estado_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function funcionario()
    {
        return $this->belongsTo(\App\Models\Funcionario::class, 'funcionario_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reguser()
    {
        return $this->belongsTo(\App\Models\User::class, 'reguser_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function responsable()
    {
        return $this->belongsTo(\App\Models\Responsable::class, 'responsable_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }

    public function resultado()
    {
        return $this->belongsTo(Resultado::class, 'resultado_id','id');
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
    protected function detalle_trabajo(): Attribute
    {
        return new Attribute(
            set: function ($detalle_trabajo) {
                return empty($detalle_trabajo) ? null : mb_strtoupper($detalle_trabajo);
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

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->reguser_id = Auth::id();
        });
    }

    public function getTipoEquipo()
{
    return 'Laptop';
}
}
