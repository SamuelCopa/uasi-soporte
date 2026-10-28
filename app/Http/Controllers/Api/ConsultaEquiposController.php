<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Models\RegistroCpu;

class ConsultaEquiposController extends Controller
{
    public function index(Request $request, string $tipo)
    {
        $modelos = [
            'impresora'     => \App\Models\Impresora::class,
            'teclado'       => \App\Models\Teclado::class,
            'monitor'       => \App\Models\Monitor::class,
            'laptop'        => \App\Models\Laptop::class,
            'cpu'           => \App\Models\RegistroCpu::class,
            'mouse'         => \App\Models\Raton::class,
            'estabilizador' => \App\Models\Estabilizador::class,
            'parlante'      => \App\Models\Parlante::class,
            'ups'           => \App\Models\Upese::class,
            'audifono'      => \App\Models\Audifono::class,
            'otro'          => \App\Models\OtrosEquipo::class,
        ];

        if (!isset($modelos[$tipo])) {
            return response()->json([
                'success' => false,
                'message' => 'Tipo de equipo no válido.',
                'tipos_disponibles' => array_keys($modelos),
            ], 400);
        }

        $gestionActual = Carbon::now()->year;
        $gestionPasada = $gestionActual - 1;

        $fechaFinPasada = Carbon::create(
            $gestionPasada, 12, 31
        )->endOfDay();

        $fechaInicioPasada = $fechaFinPasada
            ->copy()
            ->subDays(29)
            ->startOfDay();

        $modelo = $modelos[$tipo];

        /*
         * Relaciones comunes que existan en cada modelo.
         */
        $relaciones = [];

        foreach ([
            'estado',
            'resultado',
            'user',
            'funcionario.dependencia',
        ] as $relacion) {
            $instancia = new $modelo();

            $metodo = explode('.', $relacion)[0];

            if (method_exists($instancia, $metodo)) {
                $relaciones[] = $relacion;
            }
        }

        /*
         * Relaciones específicas del CPU.
         */
        if ($tipo === 'cpu') {
            $relaciones = array_merge($relaciones, [
                'marcaCase',
                'colorCase',
                'marcaDisco',
                'tipoDisco',
                'capacidadDisco',
                'marcaFuente',
                'potenciaFuente',
                'marcaLectorcd',
                'cantidadRam',
                'capacidadRam',
                'disipadorRam',
                'marcaRam',
                'tipoRam',
                'cantidadRam2',
                'capacidadRam2',
                'disipadorRam2',
                'marcaRam2',
                'tipoRam2',
                'cantidadRam3',
                'capacidadRam3',
                'disipadorRam3',
                'marcaRam3',
                'tipoRam3',
                'cantidadRam4',
                'capacidadRam4',
                'disipadorRam4',
                'marcaRam4',
                'tipoRam4',
                'marcaProcesador',
                'genProcesador',
                'modeloProcesador',
                'marcaTmadre',
                'modeloTmadre',
                'marcaTred',
                'modeloTred',
                'marcaTvideo',
                'capacidadTvideo',
                'tipoTvideo',
                'marcaTwifi',
                'modeloWifi',
            ]);

            if (method_exists(new $modelo(), 'user')) {
                $relaciones[] = 'user.especialidad';
            }
        }

        $consulta = $modelo::query()
            ->with(array_unique($relaciones))
            ->where(function ($query) use (
                $fechaInicioPasada,
                $fechaFinPasada,
                $gestionActual
            ) {
                $query->where(function ($subquery) use (
                    $fechaInicioPasada,
                    $fechaFinPasada
                ) {
                    $subquery
                        ->whereBetween('fecha', [
                            $fechaInicioPasada,
                            $fechaFinPasada,
                        ])
                        ->where('estado_id', '!=', 5);
                })
                ->orWhereYear('fecha', $gestionActual);
            })
            ->orderByDesc('fecha');

        $equipos = $consulta->paginate(15);

        $data = $equipos->getCollection()->map(
            function ($equipo) use ($tipo) {
                $funcionario = $equipo->funcionario;
                $tecnico = $equipo->user;
                $estado = $equipo->estado;
                $resultado = $equipo->resultado;

                $fechaRegistro = $equipo->created_at;
                $fechaRecepcion = $equipo->fecha ?? null;

                /*
                 * Estructura general.
                 */
                $registro = [
                    'id' => $equipo->id,

                    'numeroRecepcion' =>
                        $equipo->cod_registro ?? null,

                    'tipoEquipo' => $tipo,

                    'fechaRegistro' => $fechaRegistro
                        ? Carbon::parse($fechaRegistro)
                            ->utc()
                            ->format('Y-m-d\TH:i:s.v\Z')
                        : null,

                    'fechaRecepcion' => $fechaRecepcion
                        ? Carbon::parse($fechaRecepcion)
                            ->format('Y-m-d')
                        : null,

                    'fechaConclucion' => $equipo->fecha_entrega
                        ?? null,

                    'estadoActual' => [
                        'estado' => $estado?->nombre,
                        'detalle' => $resultado?->nombre,
                    ],

                    'codigoGamea' => $equipo->cod_gamea ?? null,

                    'falla' => $equipo->falla ?? null,

                    'tecnicoEncargado' => $tecnico ? [
                        'id' => $tecnico->id,
                        'nombres' => $tecnico->name,
                        'apellidos' => trim(
                            ($tecnico->paterno ?? '') . ' ' .
                            ($tecnico->materno ?? '')
                        ),
                        'ci' => $tecnico->ci,
                        'especialidad' =>
                            $tecnico->especialidad?->nombre,
                    ] : null,

                    'equipoDetalle' => [],

                    'funcionario' => $funcionario ? [
                        'es_ex_funcionario' => false,
                        'id' => (string) $funcionario->id,
                        'nombres' => $funcionario->nombre,
                        'apellidos' => trim(
                            ($funcionario->paterno ?? '') . ' ' .
                            ($funcionario->materno ?? '')
                        ),
                        'cargo' => $funcionario->cargo,
                        'dependencia' =>
                            $funcionario->dependencia?->nombre,
                        'celular' => $funcionario->celular,
                    ] : null,
                ];

                /*
                 * Características específicas del CPU.
                 */
                if ($tipo === 'cpu') {
                    $valor = function ($relacion, $campo = 'nombre')
                        use ($equipo) {
                            $objeto = $equipo->{$relacion};

                            return $objeto?->{$campo} ?? '';
                        };

                    $registro['equipoDetalle'] = [
                        'case' => [
                            'case' => $valor('marcaCase') !== ''
                                ? 'GABINETE'
                                : '',
                            'color' => $valor('colorCase'),
                            'marca' => $valor('marcaCase'),
                        ],

                        'disco' => [
                            'capacidad' => $valor('capacidadDisco'),
                            'marca' => $valor('marcaDisco'),
                            'tipo' => $valor('tipoDisco'),
                        ],

                        'fuente' => [
                            'cablePoder' =>
                                $equipo->cable_id ? 'SI' : 'NO',
                            'marca' => $valor('marcaFuente'),
                            'potencia' => $valor('potenciaFuente'),
                        ],

                        'lector' => [
                            'marca' => $valor('marcaLectorcd'),
                        ],

                        'memoria' => [
                            'cantidad' => (int) (
                                $equipo->cantidadRam?->nombre ?? 0
                            ),
                            'modulos' => [
                                [
                                    'capacidad' => $valor('capacidadRam'),
                                    'disipador' => $valor('disipadorRam'),
                                    'marca' => $valor('marcaRam'),
                                    'tipoConexion' => $valor('tipoRam'),
                                ],
                                [
                                    'capacidad' => $valor('capacidadRam2'),
                                    'disipador' => $valor('disipadorRam2'),
                                    'marca' => $valor('marcaRam2'),
                                    'tipoConexion' => $valor('tipoRam2'),
                                ],
                                [
                                    'capacidad' => $valor('capacidadRam3'),
                                    'disipador' => $valor('disipadorRam3'),
                                    'marca' => $valor('marcaRam3'),
                                    'tipoConexion' => $valor('tipoRam3'),
                                ],
                                [
                                    'capacidad' => $valor('capacidadRam4'),
                                    'disipador' => $valor('disipadorRam4'),
                                    'marca' => $valor('marcaRam4'),
                                    'tipoConexion' => $valor('tipoRam4'),
                                ],
                            ],
                        ],

                        'procesador' => [
                            'generacion' => $valor('genProcesador'),
                            'marca' => $valor('marcaProcesador'),
                            'modelo' => $valor('modeloProcesador'),
                        ],

                        'tarjetaMadre' => [
                            'marca' => $valor('marcaTmadre'),
                            'modelo' => $valor('modeloTmadre'),
                        ],

                        'tarjetaRed' => [
                            'marca' => $valor('marcaTred'),
                            'modelo' => $valor('modeloTred'),
                        ],

                        'tarjetaVideo' => [
                            'capacidad' => $valor('capacidadTvideo'),
                            'marca' => $valor('marcaTvideo'),
                            'tipoConexion' => $valor('tipoTvideo'),
                        ],

                        'tarjetaWifi' => [
                            'antena' => $equipo->antena_id
                                ? 'SI'
                                : 'NO',
                            'marca' => $valor('marcaTwifi'),
                            'modelo' => $valor('modeloWifi'),
                        ],
                    ];
                } else {
                    /*
                     * Para los demás equipos, devuelve los datos BASICOS
                     
                     */
                    $registro['equipoDetalle'] = [
                        'codigo_gamea' => $equipo->cod_gamea ?? null,
                        'falla' => $equipo->falla ?? null,
                        'marca' => $equipo->marca ?? null,
                        'modelo' => $equipo->modelo ?? null,
                        'observaciones' =>
                            $equipo->observaciones ?? null,
                    ];
                }

                return $registro;
            }
        );

        $equipos->setCollection($data);

        return response()->json([
            'success' => true,
            'tipo' => $tipo,
            'gestion' => $gestionActual,
            'total' => $equipos->total(),
            'pagina_actual' => $equipos->currentPage(),
            'por_pagina' => $equipos->perPage(),
            'ultima_pagina' => $equipos->lastPage(),
            'data' => $equipos->items(),
        ]);
    }

private function modelos(): array
{
    return [
        'impresora'     => \App\Models\Impresora::class,
        'teclado'       => \App\Models\Teclado::class,
        'monitor'       => \App\Models\Monitor::class,
        'laptop'        => \App\Models\Laptop::class,
        'cpu'           => \App\Models\RegistroCpu::class,
        'mouse'         => \App\Models\Raton::class,
        'estabilizador' => \App\Models\Estabilizador::class,
        'parlante'      => \App\Models\Parlante::class,
        'ups'           => \App\Models\Upese::class,
        'audifono'      => \App\Models\Audifono::class,
        'otro'          => \App\Models\OtrosEquipo::class,
    ];
}

private function relaciones(string $tipo, string $modelo): array
{
    $instancia = new $modelo();

    $relaciones = [];

    foreach (['estado', 'resultado', 'user', 'funcionario'] as $nombre) {
        if (method_exists($instancia, $nombre)) {
            $relaciones[] = $nombre;
        }
    }

    if (method_exists($instancia, 'funcionario')) {
        $funcionario = $instancia->funcionario()->getRelated();

        if (method_exists($funcionario, 'dependencia')) {
            $relaciones[] = 'funcionario.dependencia';
        }
    }

    if ($tipo === 'cpu') {
        $especificas = [
            'marcaCase',
            'colorCase',
            'marcaDisco',
            'tipoDisco',
            'capacidadDisco',
            'marcaFuente',
            'potenciaFuente',
            'marcaLectorcd',
            'cantidadRam',
            'capacidadRam',
            'disipadorRam',
            'marcaRam',
            'tipoRam',
            'cantidadRam2',
            'capacidadRam2',
            'disipadorRam2',
            'marcaRam2',
            'tipoRam2',
            'cantidadRam3',
            'capacidadRam3',
            'disipadorRam3',
            'marcaRam3',
            'tipoRam3',
            'cantidadRam4',
            'capacidadRam4',
            'disipadorRam4',
            'marcaRam4',
            'tipoRam4',
            'marcaProcesador',
            'genProcesador',
            'modeloProcesador',
            'marcaTmadre',
            'modeloTmadre',
            'marcaTred',
            'modeloTred',
            'marcaTvideo',
            'capacidadTvideo',
            'tipoTvideo',
            'marcaTwifi',
            'modeloWifi',
        ];

        foreach ($especificas as $nombre) {
            if (method_exists($instancia, $nombre)) {
                $relaciones[] = $nombre;
            }
        }

        if (method_exists($instancia, 'user')) {
            $user = $instancia->user()->getRelated();

            if (method_exists($user, 'especialidad')) {
                $relaciones[] = 'user.especialidad';
            }
        }
    }

    return array_values(array_unique($relaciones));
}


private function formatearEquipo($equipo, string $tipo): array
{
    $funcionario = $equipo->funcionario;
    $tecnico = $equipo->user;
    $estado = $equipo->estado;
    $resultado = $equipo->resultado;

    $fechaRegistro = $equipo->created_at;
    $fechaRecepcion = $equipo->fecha ?? null;

    $registro = [
        'id' => $equipo->id,
        'numeroRecepcion' => $equipo->cod_registro ?? null,
        'tipoEquipo' => $tipo,

        'fechaRegistro' => $fechaRegistro
            ? Carbon::parse($fechaRegistro)
                ->utc()
                ->format('Y-m-d\TH:i:s.v\Z')
            : null,

        'fechaRecepcion' => $fechaRecepcion
            ? Carbon::parse($fechaRecepcion)->format('Y-m-d')
            : null,

        'fechaConclucion' => $equipo->fecha_entrega ?? null,

        'estadoActual' => [
            'estado' => $estado?->nombre,
            'detalle' => $resultado?->nombre,
        ],

        'codigoGamea' => $equipo->cod_gamea ?? null,
        'falla' => $equipo->falla ?? null,

        'tecnicoEncargado' => $tecnico ? [
            'id' => $tecnico->id,
            'nombres' => $tecnico->name,
            'apellidos' => trim(
                ($tecnico->paterno ?? '') . ' ' .
                ($tecnico->materno ?? '')
            ),
            'ci' => $tecnico->ci,
            'especialidad' => $tecnico->especialidad?->nombre,
        ] : null,

        'equipoDetalle' => [],

        'funcionario' => $funcionario ? [
            'es_ex_funcionario' => false,
            'id' => (string) $funcionario->id,
            'nombres' => $funcionario->nombre,
            'apellidos' => trim(
                ($funcionario->paterno ?? '') . ' ' .
                ($funcionario->materno ?? '')
            ),
            'cargo' => $funcionario->cargo,
            'dependencia' => $funcionario->dependencia?->nombre,
            'celular' => $funcionario->celular,
        ] : null,
    ];

    if ($tipo === 'cpu') {
        $valor = function ($relacion, $campo = 'nombre') use ($equipo) {
            $objeto = $equipo->{$relacion};

            return $objeto?->{$campo} ?? '';
        };

        $registro['equipoDetalle'] = [
            'case' => [
                'case' => $valor('marcaCase') !== '' ? 'GABINETE' : '',
                'color' => $valor('colorCase'),
                'marca' => $valor('marcaCase'),
            ],

            'disco' => [
                'capacidad' => $valor('capacidadDisco'),
                'marca' => $valor('marcaDisco'),
                'tipo' => $valor('tipoDisco'),
            ],

            'fuente' => [
                'cablePoder' => $equipo->cable_id ? 'SI' : 'NO',
                'marca' => $valor('marcaFuente'),
                'potencia' => $valor('potenciaFuente'),
            ],

            'lector' => [
                'marca' => $valor('marcaLectorcd'),
            ],

            'memoria' => [
                'cantidad' => (int) ($equipo->cantidadRam?->nombre ?? 0),
                'modulos' => [
                    [
                        'capacidad' => $valor('capacidadRam'),
                        'disipador' => $valor('disipadorRam'),
                        'marca' => $valor('marcaRam'),
                        'tipoConexion' => $valor('tipoRam'),
                    ],
                    [
                        'capacidad' => $valor('capacidadRam2'),
                        'disipador' => $valor('disipadorRam2'),
                        'marca' => $valor('marcaRam2'),
                        'tipoConexion' => $valor('tipoRam2'),
                    ],
                    [
                        'capacidad' => $valor('capacidadRam3'),
                        'disipador' => $valor('disipadorRam3'),
                        'marca' => $valor('marcaRam3'),
                        'tipoConexion' => $valor('tipoRam3'),
                    ],
                    [
                        'capacidad' => $valor('capacidadRam4'),
                        'disipador' => $valor('disipadorRam4'),
                        'marca' => $valor('marcaRam4'),
                        'tipoConexion' => $valor('tipoRam4'),
                    ],
                ],
            ],

            'procesador' => [
                'generacion' => $valor('genProcesador'),
                'marca' => $valor('marcaProcesador'),
                'modelo' => $valor('modeloProcesador'),
            ],

            'tarjetaMadre' => [
                'marca' => $valor('marcaTmadre'),
                'modelo' => $valor('modeloTmadre'),
            ],

            'tarjetaRed' => [
                'marca' => $valor('marcaTred'),
                'modelo' => $valor('modeloTred'),
            ],

            'tarjetaVideo' => [
                'capacidad' => $valor('capacidadTvideo'),
                'marca' => $valor('marcaTvideo'),
                'tipoConexion' => $valor('tipoTvideo'),
            ],

            'tarjetaWifi' => [
                'antena' => $equipo->antena_id ? 'SI' : 'NO',
                'marca' => $valor('marcaTwifi'),
                'modelo' => $valor('modeloWifi'),
            ],
        ];
    } else {
        $registro['equipoDetalle'] = [
            'codigo_gamea' => $equipo->cod_gamea ?? null,
            'falla' => $equipo->falla ?? null,
            'marca' => $equipo->marca ?? null,
            'modelo' => $equipo->modelo ?? null,
            'observaciones' => $equipo->observaciones ?? null,
        ];
    }

    return $registro;
}


public function todos(Request $request)
{
    $modelos = $this->modelos();

    $gestionActual = Carbon::now()->year;
    $gestionPasada = $gestionActual - 1;

    $fechaFinPasada = Carbon::create(
        $gestionPasada, 12, 31
    )->endOfDay();

    $fechaInicioPasada = $fechaFinPasada
        ->copy()
        ->subDays(29)
        ->startOfDay();

    $porPagina = min(
        max((int) $request->input('per_page', 15), 1),
        100
    );

    $pagina = max((int) $request->input('page', 1), 1);

    $todos = collect();

    foreach ($modelos as $tipo => $modelo) {
        $relaciones = $this->relaciones($tipo, $modelo);

        $registros = $modelo::query()
            ->with($relaciones)
            ->where(function ($query) use (
                $fechaInicioPasada,
                $fechaFinPasada,
                $gestionActual
            ) {
                $query->where(function ($subquery) use (
                    $fechaInicioPasada,
                    $fechaFinPasada
                ) {
                    $subquery
                        ->whereBetween('fecha', [
                            $fechaInicioPasada,
                            $fechaFinPasada,
                        ])
                        ->where('estado_id', '!=', 5);
                })
                ->orWhereYear('fecha', $gestionActual);
            })
            ->get();

        foreach ($registros as $equipo) {
            $registro = $this->formatearEquipo($equipo, $tipo);

            // Conservamos la fecha completa para ordenar correctamente.
            $registro['_ordenFecha'] = $equipo->fecha
                ? Carbon::parse($equipo->fecha)->timestamp
                : 0;

            $todos->push($registro);
        }
    }

    $todos = $todos
        ->sortByDesc('_ordenFecha')
        ->values();

    $total = $todos->count();

    $data = $todos
        ->slice(($pagina - 1) * $porPagina, $porPagina)
        ->values()
        ->map(function ($registro) {
            unset($registro['_ordenFecha']);

            return $registro;
        });

    return response()->json([
        'success' => true,
        'tipo' => 'todos',
        'gestion' => $gestionActual,
        'total' => $total,
        'pagina_actual' => $pagina,
        'por_pagina' => $porPagina,
        'ultima_pagina' => max(
            (int) ceil($total / $porPagina),
            1
        ),
        'data' => $data,
    ]);
}
}
