@extends('layouts.app')
@section('content')

<style>

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

    </div>

@stop

<div class="row g-4">
  @php
      $charts = [
          ['id' => 'chart', 'title' => 'Resumen general ' . date('Y')],
          ['id'=>'chartCpu','title'=>'CPUs ' . date('Y')],
          ['id'=>'chartImpresora','title'=>'Impresoras ' . date('Y')],
          ['id'=>'chartMonitor','title'=>'Monitores ' . date('Y')],
          ['id'=>'ChartAudifono','title'=>'Audífonos ' . date('Y')],
          ['id'=>'chartTeclado','title'=>'Teclados ' . date('Y')],
          ['id'=>'chartParlante','title'=>'Parlantes ' . date('Y')],
          ['id'=>'chartMouse','title'=>'Mouse ' . date('Y')],
          ['id'=>'chartUps','title'=>'UPS ' . date('Y')],
          ['id'=>'chartEstabilizador','title'=>'Estabilizadores ' . date('Y')],
          ['id'=>'chartLaptop','title'=>'Laptops ' . date('Y')],
      ];
  @endphp

  @foreach($charts as $chart)
<div class="col-lg-4 col-md-6 col-sm-12 mb-4">
    <div class="chart-card-prof">

        <!-- Header -->
        <div class="chart-card-header">
            <span class="chart-title">{{ $chart['title'] }}</span>
        </div>

        <!-- Contenido -->
        <div class="chart-card-body">
            <canvas id="{{ $chart['id'] }}"></canvas>
        </div>

    </div>
</div>
  @endforeach
</div>
<link rel="stylesheet" href="{{ asset('estilos/estadistica.css') }}">  
@endsection

{{-- ------------------------------------------------------------------- --}}
@section('js')
<script src="{{ asset('js/mov.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('chart').getContext('2d');
const chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: {!! json_encode(array_keys($totales)) !!},
        datasets: [{
            label: 'Totales',
            data: {!! json_encode(array_values($totales)) !!},
            backgroundColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(128, 0, 0, 1)',
                'rgba(0, 128, 0, 1)',
                'rgba(0, 0, 255, 1)',
                'rgba(128, 128, 0, 1)',

            ],
            borderColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(128, 0, 0, 0.2)',
                'rgba(0, 128, 0, 0.2)',
                'rgba(0, 0, 255, 0.2)',
                'rgba(128, 128, 0, 0.2)',
            ],
            borderWidth: 1
        }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,

      layout: {
        padding: 8
      },

      plugins: {
        legend: {
          labels: {
            color: '#2c3e50',
            font: {
              size: 11
            }
          }
        }
      },

      scales: {
        x: {
          ticks: {
            color: '#6c757d',
            font: {
              size: 10
            }
          },
          grid: {
            color: '#e5e7eb'
          }
        },

        y: {
          ticks: {
            color: '#6c757d',
            font: {
              size: 10
            }
          },
          grid: {
            color: '#e5e7eb'
          }
        }
      }
    }
});
</script>
{{-- -------------------AUDIFONO---------------------------------- --}}
<script>
const ctxAudifono = document.getElementById('ChartAudifono').getContext('2d');
const chartAudifono = new Chart(ctxAudifono, {
    type: 'bar',
    data: {
        labels: {!! json_encode(array_keys($totalesAudifono)) !!},
        datasets: [{
            label: 'Totales',
            data: {!! json_encode(array_values($totalesAudifono)) !!},
            backgroundColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(128, 0, 0, 1)',
                'rgba(0, 128, 0, 1)',
                'rgba(0, 0, 255, 1)',
                'rgba(128, 128, 0, 1)',

            ],
            borderColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(128, 0, 0, 0.2)',
                'rgba(0, 128, 0, 0.2)',
                'rgba(0, 0, 255, 0.2)',
                'rgba(128, 128, 0, 0.2)',
            ],
            borderWidth: 1
        }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,

      layout: {
        padding: 8
      },

      plugins: {
        legend: {
          labels: {
            color: '#2c3e50',
            font: {
              size: 11
            }
          }
        }
      },

      scales: {
        x: {
          ticks: {
            color: '#6c757d',
            font: {
              size: 10
            }
          },
          grid: {
            color: '#e5e7eb'
          }
        },

        y: {
          ticks: {
            color: '#6c757d',
            font: {
              size: 10
            }
          },
          grid: {
            color: '#e5e7eb'
          }
        }
      }
    }
});
</script>
{{-- -------------------CPU---------------------------------- --}}
<script>
const ctxCpu = document.getElementById('chartCpu').getContext('2d');
const chartCpu = new Chart(ctxCpu, {
    type: 'bar',
    data: {
        labels: {!! json_encode(array_keys($totalesCpu)) !!},
        datasets: [{
            label: 'Totales',
            data: {!! json_encode(array_values($totalesCpu)) !!},
            backgroundColor: [
              'rgba(255, 99, 132, 1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)',
              'rgba(128, 0, 0, 1)',
              'rgba(0, 128, 0, 1)',
              'rgba(0, 0, 255, 1)',
              'rgba(128, 128, 0, 1)',
              'rgba(255, 0, 255, 1)', 
              'rgba(0, 255, 255, 1)', 
            ],

            borderColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(128, 0, 0, 0.2)',
              'rgba(0, 128, 0, 0.2)',
              'rgba(0, 0, 255, 0.2)',
              'rgba(128, 128, 0, 0.2)',
              'rgba(255, 0, 255, 0.2)', 
              'rgba(0, 255, 255, 0.2)', 
            ],
            borderWidth: 1
        }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,

      layout: {
        padding: 8
      },

      plugins: {
        legend: {
          labels: {
            color: '#2c3e50',
            font: {
              size: 11
            }
          }
        }
      },

      scales: {
        x: {
          ticks: {
            color: '#6c757d',
            font: {
              size: 10
            }
          },
          grid: {
            color: '#e5e7eb'
          }
        },

        y: {
          ticks: {
            color: '#6c757d',
            font: {
              size: 10
            }
          },
          grid: {
            color: '#e5e7eb'
          }
        }
      }
    }
});
</script>
{{-- -------------------IMPRESORA---------------------------------- --}}
<script>
const ctxImpresora = document.getElementById('chartImpresora').getContext('2d');
const chartImpresora = new Chart(ctxImpresora, {
    type: 'bar',
    data: {
        labels: {!! json_encode(array_keys($totalesImpresora)) !!},
        datasets: [{
            label: 'Totales',
            data: {!! json_encode(array_values($totalesImpresora)) !!},
            backgroundColor: [
              'rgba(255, 99, 132, 1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)',
              'rgba(128, 0, 0, 1)',
              'rgba(0, 128, 0, 1)',
              'rgba(0, 0, 255, 1)',
              'rgba(128, 128, 0, 1)',
              'rgba(255, 0, 255, 1)', 
              'rgba(0, 255, 255, 1)', 
            ],

            borderColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(128, 0, 0, 0.2)',
              'rgba(0, 128, 0, 0.2)',
              'rgba(0, 0, 255, 0.2)',
              'rgba(128, 128, 0, 0.2)',
              'rgba(255, 0, 255, 0.2)', 
              'rgba(0, 255, 255, 0.2)', 
            ],
            borderWidth: 1
        }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,

      layout: {
        padding: 8
      },

      plugins: {
        legend: {
          labels: {
            color: '#2c3e50',
            font: {
              size: 11
            }
          }
        }
      },

      scales: {
        x: {
          ticks: {
            color: '#6c757d',
            font: {
              size: 10
            }
          },
          grid: {
            color: '#e5e7eb'
          }
        },

        y: {
          ticks: {
            color: '#6c757d',
            font: {
              size: 10
            }
          },
          grid: {
            color: '#e5e7eb'
          }
        }
      }
    }
});
</script>
{{-- -------------------TECLADO---------------------------------- --}}
<script>
const ctxMonitor = document.getElementById('chartMonitor').getContext('2d');
const chartMonitor = new Chart(ctxMonitor, {
    type: 'bar',
    data: {
        labels: {!! json_encode(array_keys($totalesMonitor)) !!},
        datasets: [{
            label: 'Totales',
            data: {!! json_encode(array_values($totalesMonitor)) !!},
            backgroundColor: [
              'rgba(255, 99, 132, 1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)',
              'rgba(128, 0, 0, 1)',
              'rgba(0, 128, 0, 1)',
              'rgba(0, 0, 255, 1)',
              'rgba(128, 128, 0, 1)',
              'rgba(255, 0, 255, 1)', 
              'rgba(0, 255, 255, 1)', 
            ],

            borderColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(128, 0, 0, 0.2)',
              'rgba(0, 128, 0, 0.2)',
              'rgba(0, 0, 255, 0.2)',
              'rgba(128, 128, 0, 0.2)',
              'rgba(255, 0, 255, 0.2)', 
              'rgba(0, 255, 255, 0.2)', 
            ],
            borderWidth: 1
        }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,

      layout: {
        padding: 8
      },

      plugins: {
        legend: {
          labels: {
            color: '#2c3e50',
            font: {
              size: 11
            }
          }
        }
      },

      scales: {
        x: {
          ticks: {
            color: '#6c757d',
            font: {
              size: 10
            }
          },
          grid: {
            color: '#e5e7eb'
          }
        },

        y: {
          ticks: {
            color: '#6c757d',
            font: {
              size: 10
            }
          },
          grid: {
            color: '#e5e7eb'
          }
        }
      }
    }
});
</script>
{{-- -------------------TECLADO---------------------------------- --}}
<script>
const ctxTeclado = document.getElementById('chartTeclado').getContext('2d');
const chartTeclado = new Chart(ctxTeclado, {
    type: 'bar',
    data: {
        labels: {!! json_encode(array_keys($totalesTeclado)) !!},
        datasets: [{
            label: 'Totales',
            data: {!! json_encode(array_values($totalesTeclado)) !!},
            backgroundColor: [
              'rgba(255, 99, 132, 1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)',
              'rgba(128, 0, 0, 1)',
              'rgba(0, 128, 0, 1)',
              'rgba(0, 0, 255, 1)',
              'rgba(128, 128, 0, 1)',
              'rgba(255, 0, 255, 1)', 
              'rgba(0, 255, 255, 1)', 
            ],

            borderColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(128, 0, 0, 0.2)',
              'rgba(0, 128, 0, 0.2)',
              'rgba(0, 0, 255, 0.2)',
              'rgba(128, 128, 0, 0.2)',
              'rgba(255, 0, 255, 0.2)', 
              'rgba(0, 255, 255, 0.2)', 
            ],
            borderWidth: 1
        }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,

      layout: {
        padding: 8
      },

      plugins: {
        legend: {
          labels: {
            color: '#2c3e50',
            font: {
              size: 11
            }
          }
        }
      },

      scales: {
        x: {
          ticks: {
            color: '#6c757d',
            font: {
              size: 10
            }
          },
          grid: {
            color: '#e5e7eb'
          }
        },

        y: {
          ticks: {
            color: '#6c757d',
            font: {
              size: 10
            }
          },
          grid: {
            color: '#e5e7eb'
          }
        }
      }
    }
});
</script>
{{-- -------------------PARLANTE---------------------------------- --}}
<script>
const ctxParlante = document.getElementById('chartParlante').getContext('2d');
const chartParlante = new Chart(ctxParlante, {
    type: 'bar',
    data: {
        labels: {!! json_encode(array_keys($totalesParlante)) !!},
        datasets: [{
            label: 'Totales',
            data: {!! json_encode(array_values($totalesParlante)) !!},
            backgroundColor: [
              'rgba(255, 99, 132, 1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)',
              'rgba(128, 0, 0, 1)',
              'rgba(0, 128, 0, 1)',
              'rgba(0, 0, 255, 1)',
              'rgba(128, 128, 0, 1)',
              'rgba(255, 0, 255, 1)', 
              'rgba(0, 255, 255, 1)', 
            ],

            borderColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(128, 0, 0, 0.2)',
              'rgba(0, 128, 0, 0.2)',
              'rgba(0, 0, 255, 0.2)',
              'rgba(128, 128, 0, 0.2)',
              'rgba(255, 0, 255, 0.2)', 
              'rgba(0, 255, 255, 0.2)', 
            ],
            borderWidth: 1
        }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,

      layout: {
        padding: 8
      },

      plugins: {
        legend: {
          labels: {
            color: '#2c3e50',
            font: {
              size: 11
            }
          }
        }
      },

      scales: {
        x: {
          ticks: {
            color: '#6c757d',
            font: {
              size: 10
            }
          },
          grid: {
            color: '#e5e7eb'
          }
        },

        y: {
          ticks: {
            color: '#6c757d',
            font: {
              size: 10
            }
          },
          grid: {
            color: '#e5e7eb'
          }
        }
      }
    }
});
</script>
{{-- -------------------MOUSE---------------------------------- --}}
<script>
const ctxMouse = document.getElementById('chartMouse').getContext('2d');
const chartMouse = new Chart(ctxMouse, {
    type: 'bar',
    data: {
        labels: {!! json_encode(array_keys($totalesMouse)) !!},
        datasets: [{
            label: 'Totales',
            data: {!! json_encode(array_values($totalesMouse)) !!},
            backgroundColor: [
              'rgba(255, 99, 132, 1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)',
              'rgba(128, 0, 0, 1)',
              'rgba(0, 128, 0, 1)',
              'rgba(0, 0, 255, 1)',
              'rgba(128, 128, 0, 1)',
              'rgba(255, 0, 255, 1)', 
              'rgba(0, 255, 255, 1)', 
            ],

            borderColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(128, 0, 0, 0.2)',
              'rgba(0, 128, 0, 0.2)',
              'rgba(0, 0, 255, 0.2)',
              'rgba(128, 128, 0, 0.2)',
              'rgba(255, 0, 255, 0.2)', 
              'rgba(0, 255, 255, 0.2)', 
            ],
            borderWidth: 1
        }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,

      layout: {
        padding: 8
      },

      plugins: {
        legend: {
          labels: {
            color: '#2c3e50',
            font: {
              size: 11
            }
          }
        }
      },

      scales: {
        x: {
          ticks: {
            color: '#6c757d',
            font: {
              size: 10
            }
          },
          grid: {
            color: '#e5e7eb'
          }
        },

        y: {
          ticks: {
            color: '#6c757d',
            font: {
              size: 10
            }
          },
          grid: {
            color: '#e5e7eb'
          }
        }
      }
    }
});
</script>
{{-- -------------------UPS---------------------------------- --}}
<script>
const ctxUps = document.getElementById('chartUps').getContext('2d');
const chartUps = new Chart(ctxUps, {
    type: 'bar',
    data: {
        labels: {!! json_encode(array_keys($totalesUps)) !!},
        datasets: [{
            label: 'Totales',
            data: {!! json_encode(array_values($totalesUps)) !!},
            backgroundColor: [
              'rgba(255, 99, 132, 1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)',
              'rgba(128, 0, 0, 1)',
              'rgba(0, 128, 0, 1)',
              'rgba(0, 0, 255, 1)',
              'rgba(128, 128, 0, 1)',
              'rgba(255, 0, 255, 1)', 
              'rgba(0, 255, 255, 1)', 
            ],

            borderColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(128, 0, 0, 0.2)',
              'rgba(0, 128, 0, 0.2)',
              'rgba(0, 0, 255, 0.2)',
              'rgba(128, 128, 0, 0.2)',
              'rgba(255, 0, 255, 0.2)', 
              'rgba(0, 255, 255, 0.2)', 
            ],
            borderWidth: 1
        }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,

      layout: {
        padding: 8
      },

      plugins: {
        legend: {
          labels: {
            color: '#2c3e50',
            font: {
              size: 11
            }
          }
        }
      },

      scales: {
        x: {
          ticks: {
            color: '#6c757d',
            font: {
              size: 10
            }
          },
          grid: {
            color: '#e5e7eb'
          }
        },

        y: {
          ticks: {
            color: '#6c757d',
            font: {
              size: 10
            }
          },
          grid: {
            color: '#e5e7eb'
          }
        }
      }
    }
});
</script>
{{-- -------------------  ESTABILIZADOR---------------------------------- --}}
<script>
const ctxEstabilizador = document.getElementById('chartEstabilizador').getContext('2d');
const chartEstabilizador = new Chart(ctxEstabilizador, {
    type: 'bar',
    data: {
        labels: {!! json_encode(array_keys($totalesEstabilizador)) !!},
        datasets: [{
            label: 'Totales',
            data: {!! json_encode(array_values($totalesEstabilizador)) !!},
            backgroundColor: [
              'rgba(255, 99, 132, 1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)',
              'rgba(128, 0, 0, 1)',
              'rgba(0, 128, 0, 1)',
              'rgba(0, 0, 255, 1)',
              'rgba(128, 128, 0, 1)',
              'rgba(255, 0, 255, 1)', 
              'rgba(0, 255, 255, 1)', 
            ],

            borderColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(128, 0, 0, 0.2)',
              'rgba(0, 128, 0, 0.2)',
              'rgba(0, 0, 255, 0.2)',
              'rgba(128, 128, 0, 0.2)',
              'rgba(255, 0, 255, 0.2)', 
              'rgba(0, 255, 255, 0.2)', 
            ],
            borderWidth: 1
        }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,

      layout: {
        padding: 8
      },

      plugins: {
        legend: {
          labels: {
            color: '#2c3e50',
            font: {
              size: 11
            }
          }
        }
      },

      scales: {
        x: {
          ticks: {
            color: '#6c757d',
            font: {
              size: 10
            }
          },
          grid: {
            color: '#e5e7eb'
          }
        },

        y: {
          ticks: {
            color: '#6c757d',
            font: {
              size: 10
            }
          },
          grid: {
            color: '#e5e7eb'
          }
        }
      }
    }
});
</script>
{{-- -------------------LAPTOP---------------------------------- --}}
<script>
const ctxLaptop = document.getElementById('chartLaptop').getContext('2d');
const chartLaptop = new Chart(ctxLaptop, {
    type: 'bar',
    data: {
        labels: {!! json_encode(array_keys($totalesLaptop)) !!},
        datasets: [{
            label: 'Totales',
            data: {!! json_encode(array_values($totalesLaptop)) !!},
            backgroundColor: [
              'rgba(255, 99, 132, 1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)',
              'rgba(128, 0, 0, 1)',
              'rgba(0, 128, 0, 1)',
              'rgba(0, 0, 255, 1)',
              'rgba(128, 128, 0, 1)',
              'rgba(255, 0, 255, 1)', 
              'rgba(0, 255, 255, 1)', 
            ],

            borderColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(128, 0, 0, 0.2)',
              'rgba(0, 128, 0, 0.2)',
              'rgba(0, 0, 255, 0.2)',
              'rgba(128, 128, 0, 0.2)',
              'rgba(255, 0, 255, 0.2)', 
              'rgba(0, 255, 255, 0.2)', 
            ],
            borderWidth: 1
        }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,

      layout: {
        padding: 8
      },

      plugins: {
        legend: {
          labels: {
            color: '#2c3e50',
            font: {
              size: 11
            }
          }
        }
      },

      scales: {
        x: {
          ticks: {
            color: '#6c757d',
            font: {
              size: 10
            }
          },
          grid: {
            color: '#e5e7eb'
          }
        },

        y: {
          ticks: {
            color: '#6c757d',
            font: {
              size: 10
            }
          },
          grid: {
            color: '#e5e7eb'
          }
        }
      }
    }
});
</script>

@stop
@section('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
@stop
