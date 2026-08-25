@extends('layouts.app')
@section('content')

<style>
  .chart-card {
    /* background: linear-gradient(135deg, #ffffff, #f8f9fa); */
    transition: transform 0.3s, box-shadow 0.3s;
}
.chart-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 20px rgba(0,0,0,0.15);
}

#card:hover {
    transform: translateY(-4px) scale(1.02);
    box-shadow: 0 15px 25px rgba(0,0,0,0.3);
}

.animate-pulse {
    animation: pulse 1.5s infinite;
}
@keyframes pulse {
    0% { opacity: 1; }
    50% { opacity: 0.6; }
    100% { opacity: 1; }
}
</style>
@section('content_header')
    <div class="header-panel">

        <div class="header-left">
            <h1 class="header-title">Panel de control</h1>

            <div class="header-subtitle">
                Usuario: 
                <strong>{{ $user->name }} {{ $user->paterno }} {{ $user->materno }}</strong>
            </div>
        </div>

        <div class="header-actions">
                <a href="{{ route('estadistica') }}" class="btn-header">
                    <i class="fas fa-arrow-left"></i>
                    Volver
                </a>
        </div>
    </div>
<style>
.icono {
  display: inline-block;
  transition: transform 0.3s ease;
}
a:hover .icono {
  transform: translateX(-4px);
}

.title-container {
    width: 100%;
    text-align: center;

    margin-bottom: 20px;
}

.main-title {
    margin: 0;
    font-size: 24px;
    font-weight: 700;
    color: #1f2937;
    text-transform: uppercase;
    letter-spacing: 1px;

    font-family: "Segoe UI", Tahoma, sans-serif;
}
</style>
@stop
<div class="row"  style="display: flex; justify-content: space-between; align-items: center;">
    <div class="title-container">
        <h3 class="main-title">
            RESULTADO DEL MANTENIMIENTO {{ date('Y') }}
        </h3>
    </div>
@php
$equipos = [
    [
        'nombre' => 'CPU',
        'modelo' =>  RegistroCpu::class,
        'color'  => 'bg-gradient-info',
        'icon'   => 'ion-stop',
    ],
    [
        'nombre' => 'Impresora',
        'modelo' => Impresora::class,
        'color'  => 'bg-gradient-success',
        'icon'   => 'ion-printer',
    ],
    [
        'nombre' => 'Monitor',
        'modelo' =>  Monitor::class,
        'color'  => 'bg-gradient-warning',
        'icon'   => 'ion-monitor',
    ],
    [
        'nombre' => 'Audifono',
        'modelo' => Audifono::class,
        'color'  => 'bg-gradient-purple',
        'icon'   => 'ion-headphone',
    ],
    [
        'nombre' => 'Parlante',
        'modelo' => Parlante::class,
        'color'  => 'bg-gradient-warning',
        'icon'   => 'ion-headphone',
    ],
    [
        'nombre' => 'Teclado',
        'modelo' => Teclado::class,
        'color'  => 'bg-gradient-success',
        'icon'   => 'ion-stop',
    ],
    [
        'nombre' => 'UPS',
        'modelo' => Upese::class,
        'color'  => 'bg-gradient-purple',
        'icon'   => 'ion-headphone',
    ],
    [
        'nombre' => 'Laptop',
        'modelo' => Laptop::class,
        'color'  => 'bg-gradient-info',
        'icon'   => 'ion-laptop',
    ],
    [
        'nombre' => 'Mouse',
        'modelo' => Raton::class,
        'color'  => 'bg-gradient-purple',
        'icon'   => 'ion-mouse',
    ],
    [
        'nombre' => 'Estabilizador',
        'modelo' => Estabilizador::class,
        'color'  => 'bg-gradient-success',
        'icon'   => 'ion-outlet',
    ],
    [
        'nombre' => 'Otros',
        'modelo' => OtrosEquipo::class,
        'color'  => 'bg-gradient-success',
        'icon'   => 'ion-outlet',
    ],
];
@endphp


    <div class="row">
    @foreach($detalle as $modelo => $datos)

        @php
            $equipoInfo = collect($equipos)->firstWhere('modelo', $modelo);

            $icon  = $equipoInfo['icon'] ?? 'ion-gear-a';
            $nombreEquipo = $equipoInfo['nombre'] ?? $modelo;

            $total = array_sum($datos);
        @endphp

    <!-- <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
        <div class="card dashboard-card-prof ">

            <div class="card-body">


                <div class="card-header-custom">
                    <span class="card-title">
                        {{ $nombreEquipo }}
                    </span>
                    <i class="ion {{ $icon }}"></i>
                </div>

   
                <div class="mb-2">
                    <h3 class="mb-0 font-weight-bold text-dark">
                        {{ $total }}
                    </h3>
                    <small class="">Total registros</small>
                </div>

                @foreach(['devolucion','reposicion','repliegue','custodio','baja'] as $estado)
                    @php
                        $porcentaje = $total > 0 ? round(($datos[$estado]/$total)*100) : 0;

                        $colorBar = match($estado) {
                            'devolucion' => '#0d6efd',
                            'reposicion' => '#198754',
                            'repliegue'  => '#ffc107',
                            'custodio'   => '#6f42c1',
                            'baja'       => '#dc3545',
                        };
                    @endphp

                    <div class="mb-2">

                        <div class="stat-row">
                            <span >
                                {{ ucfirst($estado) }}
                            </span>
                            <span class="value">
                                {{ $datos[$estado] }}
                            </span>
                        </div>


                    <div class="progress progress-custom">
                        <div class="progress-bar"
                                style="width: {{ $porcentaje }}%; background-color: {{ $colorBar }};">
                            </div>
                        </div>

                    </div>
                @endforeach

            </div>

        </div>
    </div>
    <link rel="stylesheet" href="{{ asset('estilos/panelAdmi.css') }}">
    @endforeach
</div> -->


{{-- -----------------------------TABLA DE DATOS--------------------------------- --}}

<div class="card">
    <div class="table-responsive">

        <table class="table table-striped table-hover table-bordered">

            <thead>

                <tr align="center">
                    <td colspan="7" class="color2">
                        <h4 class="mb-0">
                            DETALLE POR ACTIVOS - GESTIÓN {{ $year }}
                        </h4>
                    </td>
                </tr>

                <tr align="center">
                    <th>Equipo</th>
                    <th>Devolución</th>
                    <th>Reposición</th>
                    <th>Repliegue</th>
                    <th>Custodio</th>
                    <th>Baja</th>
                    <th>TOTAL</th>
                </tr>

            </thead>

            <tbody>

                @foreach ($detalle as $modelo => $datos)

                    @php
                        $total = array_sum($datos);
                    @endphp

                    <tr align="center">

                        <td>
                            {{ strtoupper($modelo) }}
                        </td>

                        <td>
                            {{ $datos['devolucion'] }}
                        </td>

                        <td>
                            {{ $datos['reposicion'] }}
                        </td>

                        <td>
                            {{ $datos['repliegue'] }}
                        </td>

                        <td>
                            {{ $datos['custodio'] }}
                        </td>

                        <td>
                            {{ $datos['baja'] }}
                        </td>

                        <td class="font-weight-bold">
                            {{ $total }}
                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>
</div>

{{-- 
<h3 class="mt-4">GRÁFICOS POR ACTIVOS {{ date('Y') }}</h3>

<div class="row">
    @foreach ($detalle as $modelo => $datos)
  <div class="col-lg-4 col-xs-6">
      <div id="card" class="card shadow-sm rounded-lg border-0 p-3 h-100 chart-card">
            <h5 class="text-center">{{ $modelo }}</h5>
            <div class="chart">
                <canvas id="chart_{{ Str::slug($modelo) }}"></canvas>
            </div>
            
        </div>
  </div>
    @endforeach --}}
</div>

@endsection



{{-- ------------------------------------------------------------------- --}}
@section('js')
<script src="{{ asset('js/mov.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
@foreach ($detalle as $modelo => $datos)

new Chart(document.getElementById('chart_{{ Str::slug($modelo) }}'), {
    type: 'doughnut',
    data: {
        labels: ['Devolución', 'Reposición', 'Repliegue', 'Custodio', 'Baja'],
        datasets: [{
            data: [
                {{ $datos['devolucion'] }},
                {{ $datos['reposicion'] }},
                {{ $datos['repliegue'] }},
                {{ $datos['custodio'] }},
                {{ $datos['baja'] }}
            ],
                backgroundColor: [
                'rgba(255, 99, 132, 1)',   // Devolución
                'rgba(54, 162, 235, 1)',   // Reposición
                'rgba(255, 206, 86, 1)',   // Repliegue
                'rgba(75, 192, 192, 1)',   // Custodio
                'rgba(153, 102, 255, 1)'   // Baja
            ],
              borderColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
            ],
            borderColor: '#fff',
            borderWidth: 1
            
        }]
    },
    options: {
        plugins: {
            title: {
                display: true,
                text: '{{ $modelo }}',   //modelo del modelo como título
                color:'#3498db',
                font: {
                    size: 16
                },
                padding: 10
            },
            legend: {
                labels: {
                    color: '#3498db',   // azul
                    font: {
                        size: 13,
                        style: 'italic'
                    }
                }
            }
            
        }
        
    }
});


@endforeach
</script>


<script>
  new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Devolución', 'Reposición', 'Repliegue', 'Custodio', 'Baja'],
        datasets: [{
            data: [3, 2, 5, 1, 4]
        }]
    },
    options: {
        plugins: {
            title: {
                display: true,
                text: 'CPU - Equipos de Escritorio',
                font: {
                    size: 16
                }
            },
            legend: {
                labels: {
                    color: '#3498db',   // azul
                    font: {
                        size: 13,
                        style: 'italic'
                    }
                }
            }
        }
    }
});

</script>
@endsection

