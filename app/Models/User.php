<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use SoftDeletes;
    use Auditable;
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'ci',
        'expedido',
        'celular',
        'paterno',
        'materno',
        'id_estadousuario',
        'user_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


public function adminlte_image()
{
    $iniciales = collect([
        $this->name,
        $this->paterno
    ])->map(function ($texto) {
        return strtoupper(substr($texto, 0, 1));
    })->implode('');

    return 'https://ui-avatars.com/api/?name=' .
           urlencode($iniciales) .
           '&background=800000&color=ffffff&bold=true&size=256';
}

    public function adminlte_desc()
    {
        return $this->roles->pluck('name')->implode(', ') ?? 'Sin rol';
    }

    public function adminlte_profile_url()
    {
        return route('users.show', $this->id);
    }

    public function servicios()
    {
        return $this->hasMany(Servicio::class);
    }

    protected function name(): Attribute
    {
        return new Attribute(
            set: function ($name) {
                return empty($name) ? null : mb_strtoupper($name);
            }
        );
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


    public function estadoUsuario()
    {
        return $this->belongsTo(EstadoUsuario::class, 'id_estadousuario', 'id');
    }

    public function impresoras(): HasMany
    {
        return $this->hasMany(Impresora::class);
    }

    public function getImpresorasCountAttribute()
    {
        return $this->impresoras()->count();
    }

    public function registro_cpus(): HasMany
    {
        return $this->hasMany(RegistroCpu::class);
    }

    public function getRegistro_cpusCountAttribute()
    {
        return $this->registro_cpus()->count();
    }

    public function estabilizador(): HasMany
    {
        return $this->hasMany(Estabilizador::class);
    }

    public function getEstabilizadorsCountAttribute()
    {
        return $this->estabilizadors()->count();
    }

    public function audifonos(): HasMany
    {
        return $this->hasMany(Audifono::class);
    }

    public function getAudifonosCountAttribute()
    {
        return $this->audifonos()->count();
    }

    public function monitor(): HasMany
    {
        return $this->hasMany(Monitor::class);
    }

    public function getMonitorCountAttribute()
    {
        return $this->monitors()->count();
    }

    public function parlantes(): HasMany
    {
        return $this->hasMany(Parlante::class);
    }

    public function getParlanteCountAttribute()
    {
        return $this->parlantes()->count();
    }

    public function raton(): HasMany
    {
        return $this->hasMany(Raton::class);
    }

    public function getRatonCountAttribute()
    {
        return $this->ratons()->count();
    }

    public function teclados(): HasMany
    {
        return $this->hasMany(Teclado::class);
    }

    public function getTecladoCountAttribute()
    {
        return $this->teclados()->count();
    }

    public function upeses(): HasMany
    {
        return $this->hasMany(Upese::class);
    }

    public function getUpeseCountAttribute()
    {
        return $this->upeses()->count();
    }

    public function laptop(): HasMany
    {
        return $this->hasMany(Laptop::class);
    }

    public function getlaptopCountAttribute()
    {
        return $this->laptops()->count();
    }

    // ----------------------------------
    public function audifonosActuales()
    {
        $anioActual = date('Y');
        $anioAnterior = $anioActual - 1;

        return $this->audifonos()
            ->where(function ($q) use ($anioActual, $anioAnterior) {
                $q->whereYear('fecha_asignacion', $anioActual)
                    ->orWhere(function ($q2) use ($anioAnterior) {
                    $q2->whereYear('fecha_asignacion', $anioAnterior)
                        ->whereMonth('fecha_asignacion', 12);
                    });
            })
            ->orderBy('fecha_asignacion', 'desc')
            ->get();
    }


    public function cpuActuales()
    {
    $anioActual = date('Y');
    $anioAnterior = $anioActual - 1;
        return $this->registro_cpus()
                ->where(function ($q) use ($anioActual, $anioAnterior) {
            $q->whereYear('fecha_asignacion', $anioActual)
                ->orWhere(function ($q2) use ($anioAnterior) {
                $q2->whereYear('fecha_asignacion', $anioAnterior)
                    ->whereMonth('fecha_asignacion', 12);
                });
        })
        ->orderBy('fecha_asignacion', 'desc')
        ->get();
    }

        public function impresoraActuales()
    {
    $anioActual = date('Y');
    $anioAnterior = $anioActual - 1;
        return $this->impresoras()
        ->where(function ($q) use ($anioActual, $anioAnterior) {
            $q->whereYear('fecha_asignacion', $anioActual)
                ->orWhere(function ($q2) use ($anioAnterior) {
                $q2->whereYear('fecha_asignacion', $anioAnterior)
                    ->whereMonth('fecha_asignacion', 12);
                });
        })
        ->orderBy('fecha_asignacion', 'desc')
        ->get();
    }
    
    public function laptopActuales()
    {
    $anioActual = date('Y');
    $anioAnterior = $anioActual - 1;
        return $this->laptop()
        ->where(function ($q) use ($anioActual, $anioAnterior) {
            $q->whereYear('fecha_asignacion', $anioActual)
                ->orWhere(function ($q2) use ($anioAnterior) {
                $q2->whereYear('fecha_asignacion', $anioAnterior)
                    ->whereMonth('fecha_asignacion', 12);
                });
        })
        ->orderBy('fecha_asignacion', 'desc')
        ->get();
    }

    public function monitorActuales()
    {
    $anioActual = date('Y');
    $anioAnterior = $anioActual - 1;
        return $this->monitor()
                ->where(function ($q) use ($anioActual, $anioAnterior) {
            $q->whereYear('fecha_asignacion', $anioActual)
                ->orWhere(function ($q2) use ($anioAnterior) {
                $q2->whereYear('fecha_asignacion', $anioAnterior)
                    ->whereMonth('fecha_asignacion', 12);
                });
        })
        ->orderBy('fecha_asignacion', 'desc')
        ->get();
    }
    
    public function estabilizadorActuales()
    {
    $anioActual = date('Y');
    $anioAnterior = $anioActual - 1;
        return $this->estabilizador()
                ->where(function ($q) use ($anioActual, $anioAnterior) {
            $q->whereYear('fecha_asignacion', $anioActual)
                ->orWhere(function ($q2) use ($anioAnterior) {
                $q2->whereYear('fecha_asignacion', $anioAnterior)
                    ->whereMonth('fecha_asignacion', 12);
                });
        })
        ->orderBy('fecha_asignacion', 'desc')
        ->get();
    }

    public function parlantesActuales()
    {
    $anioActual = date('Y');
    $anioAnterior = $anioActual - 1;
        return $this->parlantes()
                ->where(function ($q) use ($anioActual, $anioAnterior) {
            $q->whereYear('fecha_asignacion', $anioActual)
                ->orWhere(function ($q2) use ($anioAnterior) {
                $q2->whereYear('fecha_asignacion', $anioAnterior)
                    ->whereMonth('fecha_asignacion', 12);
                });
        })
        ->orderBy('fecha_asignacion', 'desc')
        ->get();
    }

    public function mouseActuales()
    {
    $anioActual = date('Y');
    $anioAnterior = $anioActual - 1;
        return $this->raton()
                ->where(function ($q) use ($anioActual, $anioAnterior) {
            $q->whereYear('fecha_asignacion', $anioActual)
                ->orWhere(function ($q2) use ($anioAnterior) {
                $q2->whereYear('fecha_asignacion', $anioAnterior)
                    ->whereMonth('fecha_asignacion', 12);
                });
        })
        ->orderBy('fecha_asignacion', 'desc')
        ->get();
    }

    public function upsActuales()
    {
    $anioActual = date('Y');
    $anioAnterior = $anioActual - 1;
        return $this->upeses()
                ->where(function ($q) use ($anioActual, $anioAnterior) {
            $q->whereYear('fecha_asignacion', $anioActual)
                ->orWhere(function ($q2) use ($anioAnterior) {
                $q2->whereYear('fecha_asignacion', $anioAnterior)
                    ->whereMonth('fecha_asignacion', 12);
                });
        })
        ->orderBy('fecha_asignacion', 'desc')
        ->get();
    }

    public function tecladosActuales()
    {
    $anioActual = date('Y');
    $anioAnterior = $anioActual - 1;
        return $this->teclados()
                ->where(function ($q) use ($anioActual, $anioAnterior) {
            $q->whereYear('fecha_asignacion', $anioActual)
                ->orWhere(function ($q2) use ($anioAnterior) {
                $q2->whereYear('fecha_asignacion', $anioAnterior)
                    ->whereMonth('fecha_asignacion', 12);
                });
        })
        ->orderBy('fecha_asignacion', 'desc')
        ->get();
    }
}