<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Models\TiposEquipo;

/**
 * Class OtrosEquipo
 *
 * @property $id
 * @property $tipo_equipo_id
 * @property $cargo
 * @property $cod_gamea
 * @property $cod_registro
 * @property $fecha
 * @property $fecha_asignacion
 * @property $marca
 * @property $modelo
 * @property $falla
 * @property $otro
 * @property $observaciones
 * @property $fecha_inicio
 * @property $fecha_entrega
 * @property $dependencia_id
 * @property $estado_id
 * @property $responsable_id
 * @property $funcionario_id
 * @property $resultado_id
 * @property $user_id
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
 * @property Resultado $resultado
 * @property TiposEquipo $tiposEquipo
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class OtrosEquipo extends Model
{
    use SoftDeletes;
    use Auditable;
    protected $perPage = 1000;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['tipo_equipo_id', 'cargo', 'cod_gamea', 'cod_registro', 'fecha', 'fecha_asignacion', 'marca', 'modelo', 'falla', 'otro', 'observaciones', 'fecha_inicio', 'fecha_entrega', 'dependencia_id', 'estado_id', 'responsable_id', 'funcionario_id', 'resultado_id', 'user_id', 'reguser_id', 'boton_oculto', 'funcionario_activo'];


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
    public function resultado()
    {
        return $this->belongsTo(\App\Models\Resultado::class, 'resultado_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
public function tipoEquipo(): BelongsTo
{
    return $this->belongsTo(
        TiposEquipo::class,
        'tipo_equipo_id',
        'id'
    );
}
    

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
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
    

    public function getTipoEquipo()
{
    return 'otroEquipo';
}

public function getDiasTranscurridosAttribute()
{
    return $this->fecha->diffInDays(now());
}

}
