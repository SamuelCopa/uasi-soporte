<!--ventana para Update--->
<div class="modal fade" id="resultado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
    <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
        <div class="modal-header modal-header bg-primary text-white border-0 py-3">
            <h4>ACTUALIZAR</h4>
        <button type="button" class="btn-close bg-primary" data-dismiss="modal" aria-label="Cerrar"><i class="fas fa-times"></i></button>
        </div>
        <section class="content container-fluid">
          <div class="card">
              <div class="col-md-12">

<div class="row">


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
];
@endphp


<div class="row">
@foreach($detalle as $modelo => $datos)

    @php
        // Buscar el equipo correspondiente por el modelo
        $equipoInfo = collect($equipos)->firstWhere('modelo', $modelo);

        // Si no hay equipo configurado, ponemos valores por defecto
        $color = $equipoInfo['color'] ?? 'bg-gradient-info';
        $icon  = $equipoInfo['icon'] ?? '';
        $nombreEquipo = $equipoInfo['nombre'] ?? $modelo;

        $total = array_sum($datos);
    @endphp

    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
        <div class="{{ $color }} card shadow-lg border-0 position-relative" style="border-radius: 15px;">
            <div class="card-body p-3">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="font-weight-bold">{{ $nombreEquipo }}</h4>
                    <i class="ion {{ $icon }}" style="font-size: 45px; opacity: 0.3;"></i>
                </div>

                <!-- Mini gráfico -->
                <div class="mb-3">
                    @foreach(['devolucion','reposicion','repliegue','custodio','baja'] as $estado)
                        @php
                            $porcentaje = $total > 0 ? round(($datos[$estado]/$total)*100) : 0;
                            $colorBar = match($estado) {
                                'devolucion' => '#ff6384',
                                'reposicion' => '#36a2eb',
                                'repliegue'  => '#ffce56',
                                'custodio'   => '#4bc0c0',
                                'baja'       => '#9966ff',
                            };
                        @endphp

                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span>{{ ucfirst($estado) }}: {{ $datos[$estado] }}</span>
                            <span>{{ $porcentaje }}%</span>
                        </div>
                        <div class="progress mb-2" style="height: 10px; border-radius:5px;">
                            <div class="progress-bar"
                                 style="width: {{ $porcentaje }}%; background-color: {{ $colorBar }};">
                            </div>
                        </div>
                    @endforeach
                </div>

                <hr class="border-light my-2">
                <h5 class="font-weight-bold">Total: {{ $total }}</h5>

            </div>
        </div>
    </div>

@endforeach
</div>

</div>
{{-- -----------------------------TABLA DE DATOS--------------------------------- --}}
<div class="card">
    <div class="table-responsive">
  <table class="table-modern table-striped table-hover table-bordered">
      <thead>
          <tr align="center">
              <td colspan="7" class="color2"><h4>DETALLE POR ACTIVOS</h4></td>
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
                  <td>{{ strtoupper($modelo )}}</td>
                  <td>{{ $datos['devolucion'] }}</td>
                  <td>{{ $datos['reposicion'] }}</td>
                  <td>{{ $datos['repliegue'] }}</td>
                  <td>{{ $datos['custodio'] }}</td>
                  <td>{{ $datos['baja'] }}</td>
                  <td>{{ $total }}</td>
              </tr>
          @endforeach
      </tbody>
  </table>
</div>
</div>
<h3 class="mt-4">Gráficos por ACTIVOS</h3>

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
    @endforeach
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

                
              </div>
          </div>
        </section>
      </div>
    </div>
  </div>
  <!---fin ventana Update --->
