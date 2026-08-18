<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

/**
 * Class RegistroCpu
 *
 * @property $id
 * @property $fecha
 * @property $fecha_inicio
 * @property $nombre
 * @property $ci
 * @property $cargo
 * @property $celular
 * @property $usuario
 * @property $contrasena
 * @property $cod_gamea
 * @property $cod_registro
 * @property $tecnico
 * @property $falla
 * @property $respaldo
 * @property $observaciones
 * @property $fecha_entrega
 * @property $otro
 * @property $deleted_at
 * @property $modtmadre_id
 * @property $dependencia_id
 * @property $estado_id
 * @property $cable_id
 * @property $marcacase_id
 * @property $colorcase_id
 * @property $marcaprocesador_id
 * @property $genprocesador_id
 * @property $modeloprocesador_id
 * @property $marcatmadre_id
 * @property $marcadisco_id
 * @property $moddisco_id
 * @property $capacdisco_id
 * @property $tipodisco_id
 * @property $marcadisco2_id
 * @property $moddisco2_id
 * @property $capacdisco2_id
 * @property $tipodisco2_id
 * @property $disipador_id
 * @property $marcaram_id
 * @property $tiporam_id
 * @property $capacram_id
 * @property $cantidad_id
 * @property $disipador2_id
 * @property $marcaram2_id
 * @property $tiporam2_id
 * @property $capacram2_id
 * @property $cantidad2_id
 * @property $disipador3_id
 * @property $marcaram3_id
 * @property $tiporam3_id
 * @property $capacram3_id
 * @property $cantidad3_id
 * @property $disipador4_id
 * @property $marcaram4_id
 * @property $tiporam4_id
 * @property $capacram4_id
 * @property $cantidad4_id
 * @property $marcatvideo_id
 * @property $capactvideo_id
 * @property $tipotvideo_id
 * @property $marcatred_id
 * @property $modtred_id
 * @property $marcawifi_id
 * @property $modcawifi_id
 * @property $marcafuente_id
 * @property $potfuente_id
 * @property $marcacd_id
 * @property $user_id
 * @property $reguser_id
 * @property $responsable_id
 * @property $funcionario_id
 * @property $resultado_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Resultado $resultado
 * @property CantidadRam $cantidadRam
 * @property CantidadRam $cantidadRam2
 * @property CantidadRam $cantidadRam3
 * @property CantidadRam $cantidadRam4
 * @property CapacidadDisco $capacidadDisco
 * @property CapacidadDisco $capacidadDisco2
 * @property CapacidadRam $capacidadRam
 * @property CapacidadRam $capacidadRam2
 * @property CapacidadRam $capacidadRam3
 * @property CapacidadRam $capacidadRam4
 * @property CapacidadTvideo $capacidadTvideo
 * @property ColorCase $colorCase
 * @property Dependencia $dependencia
 * 
 * @property DisipadorRam $cable
 * @property DisipadorRam $antena
 * @property DisipadorRam $disipadorRam
 * @property DisipadorRam $disipadorRam2
 * @property DisipadorRam $disipadorRam3
 * @property DisipadorRam $disipadorRam4
 * @property Estado $estado
 * @property GenProcesador $genProcesador
 * @property MarcaCase $marcaCase
 * @property MarcaLectorcd $marcaLectorcd
 * @property MarcaDisco $marcaDisco
 * @property MarcaDisco $marcaDisco2
 * @property MarcaFuente $marcaFuente
 * @property MarcaProcesador $marcaProcesador
 * @property MarcaRam $marcaRam
 * @property MarcaRam $marcaRam2
 * @property MarcaRam $marcaRam3
 * @property MarcaRam $marcaRam4
 * @property MarcaTmadre $marcaTmadre
 * @property MarcaTred $marcaTred
 * @property MarcaTvideo $marcaTvideo
 * @property MarcaTwifi $marcaTwifi
 * @property ModeloWifi $modeloWifi
 * @property ModeloDisco $modeloDisco
 * @property ModeloDisco $modeloDisco2
 * @property ModeloProcesador $modeloProcesador
 * @property ModeloTmadre $modeloTmadre
 * @property ModeloTred $modeloTred
 * @property PotenciaFuente $potenciaFuente
 * @property TipoDisco $tipoDisco
 * @property TipoDisco $tipoDisco
 * @property TipoRam $tipoRam
 * @property TipoRam $tipoRam2
 * @property TipoRam $tipoRam3
 * @property TipoRam $tipoRam4
 * @property TipoTvideo $tipoTvideo
 * @property User $user
 * @property User $reguser
 * @property Responsable $responsable
 * @property Funcionario $funcionario
 * @property Resultado $resultado
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class RegistroCpu extends Model
{
    use SoftDeletes;
    use Auditable;
    protected $perPage = 1000;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['fecha', 'fecha_inicio', 'nombre', 'ci', 'cargo', 'celular', 'usuario', 'contrasena', 'cod_gamea',
     'cod_registro', 'tecnico', 'falla', 'respaldo', 'observaciones','fecha_entrega', 'otro', 'modtmadre_id', 'dependencia_id',
      'estado_id', 'marcacase_id', 'colorcase_id', 'marcaprocesador_id', 'genprocesador_id', 'modeloprocesador_id', 'marcatmadre_id',
       'marcadisco_id', 'moddisco_id', 'capacdisco_id', 'tipodisco_id', 'marcadisco2_id', 'moddisco2_id', 'capacdisco2_id',
        'tipodisco2_id', 'disipador_id', 'marcaram_id', 'tiporam_id', 'capacram_id', 'cantidad_id', 'disipador2_id', 'marcaram2_id',
         'tiporam2_id', 'capacram2_id', 'cantidad2_id', 'disipador3_id', 'marcaram3_id', 'tiporam3_id', 'capacram3_id', 'cantidad3_id',
          'disipador4_id', 'marcaram4_id', 'tiporam4_id', 'capacram4_id', 'cantidad4_id', 'marcatvideo_id', 'capactvideo_id',
           'tipotvideo_id', 'marcatred_id', 'modtred_id', 'marcawifi_id', 'modcawifi_id', 'marcafuente_id', 'potfuente_id',
            'fecha_asignacion','marcacd_id','user_id','responsable_id','resultado_id','reguser_id', 'funcionario_id', 'cable_id', 'antena_id', 'boton_oculto'];
    
    public function responsable(): BelongsTo
    {
        return $this->belongsTo(Responsable::class);
    }
    public function funcionario(): BelongsTo
    {
        return $this->belongsTo(Funcionario::class);
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
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cantidadRam2()
    {
        return $this->belongsTo(\App\Models\CantidadRam::class, 'cantidad2_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cantidadRam3()
    {
        return $this->belongsTo(\App\Models\CantidadRam::class, 'cantidad3_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cantidadRam4()
    {
        return $this->belongsTo(\App\Models\CantidadRam::class, 'cantidad4_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cantidadRam()
    {
        return $this->belongsTo(\App\Models\CantidadRam::class, 'cantidad_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function capacidadDisco2()
    {
        return $this->belongsTo(\App\Models\CapacidadDisco::class, 'capacdisco2_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function capacidadDisco()
    {
        return $this->belongsTo(\App\Models\CapacidadDisco::class, 'capacdisco_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function capacidadRam2()
    {
        return $this->belongsTo(\App\Models\CapacidadRam::class, 'capacram2_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function capacidadRam3()
    {
        return $this->belongsTo(\App\Models\CapacidadRam::class, 'capacram3_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function capacidadRam4()
    {
        return $this->belongsTo(\App\Models\CapacidadRam::class, 'capacram4_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function capacidadRam()
    {
        return $this->belongsTo(\App\Models\CapacidadRam::class, 'capacram_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function capacidadTvideo()
    {
        return $this->belongsTo(\App\Models\CapacidadTvideo::class, 'capactvideo_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function colorCase()
    {
        return $this->belongsTo(\App\Models\ColorCase::class, 'colorcase_id', 'id');
    }
    
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
    public function disipadorRam2()
    {
        return $this->belongsTo(\App\Models\DisipadorRam::class, 'disipador2_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function disipadorRam3()
    {
        return $this->belongsTo(\App\Models\DisipadorRam::class, 'disipador3_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function disipadorRam4()
    {
        return $this->belongsTo(\App\Models\DisipadorRam::class, 'disipador4_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function disipadorRam()
    {
        return $this->belongsTo(\App\Models\DisipadorRam::class, 'disipador_id', 'id');
    }

    public function cable()
    {
        return $this->belongsTo(\App\Models\DisipadorRam::class, 'cable_id', 'id');
    }

    public function antena()
    {
        return $this->belongsTo(\App\Models\DisipadorRam::class, 'antena_id', 'id');
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
    public function genProcesador()
    {
        return $this->belongsTo(\App\Models\GenProcesador::class, 'genprocesador_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function marcaCase()
    {
        return $this->belongsTo(\App\Models\MarcaCase::class, 'marcacase_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function marcaLectorcd()
    {
        return $this->belongsTo(\App\Models\MarcaLectorcd::class, 'marcacd_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function marcaDisco2()
    {
        return $this->belongsTo(\App\Models\MarcaDisco::class, 'marcadisco2_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function marcaDisco()
    {
        return $this->belongsTo(\App\Models\MarcaDisco::class, 'marcadisco_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function marcaFuente()
    {
        return $this->belongsTo(\App\Models\MarcaFuente::class, 'marcafuente_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function marcaProcesador()
    {
        return $this->belongsTo(\App\Models\MarcaProcesador::class, 'marcaprocesador_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function marcaRam2()
    {
        return $this->belongsTo(\App\Models\MarcaRam::class, 'marcaram2_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function marcaRam3()
    {
        return $this->belongsTo(\App\Models\MarcaRam::class, 'marcaram3_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function marcaRam4()
    {
        return $this->belongsTo(\App\Models\MarcaRam::class, 'marcaram4_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function marcaRam()
    {
        return $this->belongsTo(\App\Models\MarcaRam::class, 'marcaram_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function marcaTmadre()
    {
        return $this->belongsTo(\App\Models\MarcaTmadre::class, 'marcatmadre_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function marcaTred()
    {
        return $this->belongsTo(\App\Models\MarcaTred::class, 'marcatred_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function marcaTvideo()
    {
        return $this->belongsTo(\App\Models\MarcaTvideo::class, 'marcatvideo_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function marcaTwifi()
    {
        return $this->belongsTo(\App\Models\MarcaTwifi::class, 'marcawifi_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function modeloWifi()
    {
        return $this->belongsTo(\App\Models\ModeloWifi::class, 'modcawifi_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function modeloDisco2()
    {
        return $this->belongsTo(\App\Models\ModeloDisco::class, 'moddisco2_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function modeloDisco()
    {
        return $this->belongsTo(\App\Models\ModeloDisco::class, 'moddisco_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function modeloProcesador()
    {
        return $this->belongsTo(\App\Models\ModeloProcesador::class, 'modeloprocesador_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function modeloTmadre()
    {
        return $this->belongsTo(\App\Models\ModeloTmadre::class, 'modtmadre_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function modeloTred()
    {
        return $this->belongsTo(\App\Models\ModeloTred::class, 'modtred_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function potenciaFuente()
    {
        return $this->belongsTo(\App\Models\PotenciaFuente::class, 'potfuente_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipoDisco2()
    {
        return $this->belongsTo(\App\Models\TipoDisco::class, 'tipodisco2_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipoDisco()
    {
        return $this->belongsTo(\App\Models\TipoDisco::class, 'tipodisco_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipoRam2()
    {
        return $this->belongsTo(\App\Models\TipoRam::class, 'tiporam2_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipoRam3()
    {
        return $this->belongsTo(\App\Models\TipoRam::class, 'tiporam3_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipoRam4()
    {
        return $this->belongsTo(\App\Models\TipoRam::class, 'tiporam4_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipoRam()
    {
        return $this->belongsTo(\App\Models\TipoRam::class, 'tiporam_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipoTvideo()
    {
        return $this->belongsTo(\App\Models\TipoTvideo::class, 'tipotvideo_id', 'id');
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

    protected function otro(): Attribute
    {
        return new Attribute(
            set: function ($otro) {
                return empty($otro) ? null : mb_strtoupper($otro);
            }
        );
    }

    protected function fecha_inicio(): Attribute
    {
        return new Attribute(
            set: function ($fecha_inicio) {
                return empty($fecha_inicio) ? null : $fecha_inicio;
            }
        );
    }
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getTipoEquipo()
{
    return 'CPU';
}

}
