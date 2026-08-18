<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Registro
 *
 * @property $id
 * @property $fecha
 * @property $fecha_asignacion
 * @property $fecha_inicio
 * @property $fecha_entrega
 * @property $cod_registro
 * @property $falla
 * @property $respaldo
 * @property $observaciones
 * @property $otro
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 * @property $cpu_id
 * @property $impresora_id
 * @property $raton_id
 * @property $parlante_id
 * @property $teclado_id
 * @property $laptop_id
 * @property $monitor_id
 * @property $audifono_id
 * @property $estabilizador_id
 * @property $ups_id
 * @property $user_id
 * @property $resultado_id
 *
 * @property Audifono $audifono
 * @property RegistroCpu $registroCpu
 * @property Estabilizador $estabilizador
 * @property Impresora $impresora
 * @property Laptop $laptop
 * @property Monitor $monitor
 * @property Parlante $parlante
 * @property Raton $raton
 * @property Resultado $resultado
 * @property Teclado $teclado
 * @property Upese $upese
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Registro extends Model
{
    use SoftDeletes;

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['fecha', 'fecha_asignacion', 'fecha_inicio', 'fecha_entrega', 'cod_registro', 'falla', 'respaldo', 'observaciones', 'otro', 'cpu_id', 'impresora_id', 'raton_id', 'parlante_id', 'teclado_id', 'laptop_id', 'monitor_id', 'audifono_id', 'estabilizador_id', 'ups_id', 'user_id', 'resultado_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function audifono()
    {
        return $this->belongsTo(\App\Models\Audifono::class, 'audifono_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function registroCpu()
    {
        return $this->belongsTo(\App\Models\RegistroCpu::class, 'cpu_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estabilizador()
    {
        return $this->belongsTo(\App\Models\Estabilizador::class, 'estabilizador_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function impresora()
    {
        return $this->belongsTo(\App\Models\Impresora::class, 'impresora_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function laptop()
    {
        return $this->belongsTo(\App\Models\Laptop::class, 'laptop_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function monitor()
    {
        return $this->belongsTo(\App\Models\Monitor::class, 'monitor_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parlante()
    {
        return $this->belongsTo(\App\Models\Parlante::class, 'parlante_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function raton()
    {
        return $this->belongsTo(\App\Models\Raton::class, 'raton_id', 'id');
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
    public function teclado()
    {
        return $this->belongsTo(\App\Models\Teclado::class, 'teclado_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function upese()
    {
        return $this->belongsTo(\App\Models\Upese::class, 'ups_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }
    
}
