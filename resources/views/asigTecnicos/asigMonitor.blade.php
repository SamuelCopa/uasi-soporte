@extends('layouts.app')

@section('template_title')
    {{ $user->name ?? __('Show') . " " . __('User') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-header card-header--custom">
                </div>
                    <div class="header-panel">
                        <div class="header-left">
                            <h1 class="header-title">ASIGNACIONES DE monitor</h1>
                            <div class="header-subtitle">
                            Técnico: 
                            <strong>{{ $users->name }} {{ $users->paterno }} {{ $users->materno }}</strong>
                            </div>
                        </div>
                        <div class="header-actions">
                        <!-- Botón -->
                        <a href="{{ url()->previous() }}"
                        class="btn-header">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                        </div>
                    </div>
                        <div class="card shadow-sm border-0 rounded-4">
                            <div class="table-responsive">
                                <table id="mitabla" class="table-modern table-striped table-hover table-bordered">
                                    <thead class="thead">
                                        <tr align="center">
                                            <th>No</th>
                                            <th >FECHA DE RECEPCIÓN</th>
                                            <th >NOMBRE</th>
                                            <th >CELULAR</th>
                                            <th >DEPENDENCIA</th>
                                            <th >CODIGO GAMEA</th>
                                            <th >FALLA</th>
                                            <th >FECHA DE ASIGNACION</th>
                                            <th >FECHA DE INICIO</th>
                                            <th >ESTADO</th>
                                            <th>OPCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users->monitorActuales() as $monitor)                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ date('d-m-Y',strtotime($monitor->fecha))}}</td>
                                                <td>{{ $monitor->funcionario?->nombre }} {{ $monitor->funcionario?->paterno }} {{ $monitor->funcionario?->materno }}</td>
                                                <td>{{ $monitor->funcionario?->celular }}</td>
                                                <td>{{ $monitor->Dependencia?->dependencias }}</td>
                                                <td>{{ $monitor->cod_gamea }}</td>
                                                <td>{{ $monitor->falla }}</td>
                                                <td class="{{ empty($monitor->fecha_asignacion) ? 'color1' : '' }}">
                                                    @if($monitor->fecha_asignacion)
                                                    {{ date('d-m-Y H:i',strtotime($monitor->fecha_asignacion ))}}<BR><BR>
                                                        @if(!($monitor->estado_id == '5') && !($monitor->estado_id == '4'))
                                                        <button class="btn btn-sm btn-danger boton-parpadea">
                                                        {{ floor(\Carbon\Carbon::parse($monitor->fecha_asignacion)->diffInDays(\Carbon\Carbon::now())) }} DÍAS TRANSCURRIDOS
                                                        </button>
                                                        @endif
                                                    @endif							
                                                </td>	
                                                <td class="{{ empty($monitor->fecha_inicio) ? 'color1' : '' }}">
                                                    @if($monitor->fecha_inicio)
                                                    {{ date('d-m-Y H:i',strtotime($monitor->fecha_inicio ))}}<BR><BR>
                                                    @if(!($monitor->estado_id == '5') && !($monitor->estado_id == '4'))
                                                    <button class="btn btn-sm btn-info boton-parpadea">
                                                    {{ floor(\Carbon\Carbon::parse($monitor->fecha_inicio)->diffInDays(\Carbon\Carbon::now())) }} DÍAS TRANSCURRIDOS
                                                    </button>
                                                    @endif
                                                    @elseif(! $monitor->fecha_inicio)	
                                                    <button type="button" class="btn btn-sm btn-outline-light" onclick="Swal.fire({ title: 'Información', text: 'EN ESPERA DEL INICIO DEL TRABAJO', icon: 'info', confirmButtonText: 'ACEPTAR' });">{{ __('EN ESPERA') }}</button>
                                                    @endif							
                                                </td>	
                                                <td>
                                                    @if($monitor->estado_id == '1')
                                                    <button type="submit" class="btn btn-primary btn-raised" title="Actualizar estado" data-id="{{ $monitor->id }}" onclick="cambiarEstado({{ $monitor->id }},{{ $monitor->estado_id }} )">RECEPCIONADO</button>
                                                    @elseif($monitor->estado_id == '2')
                                                        <button class="btn btn-warning btn-raised" title="Actualizar estado" data-id="{{ $monitor->id }}" onclick="cambiarEstado({{ $monitor->id }}, {{ $monitor->estado_id }} )">EN PROCESO</button>
                                                    @elseif($monitor->estado_id == '3')
                                                        <button class="btn btn-danger btn-raised" title="Actualizar estado" data-id="{{ $monitor->id }}" onclick="cambiarEstado({{ $monitor->id }}, {{ $monitor->estado_id }} )">APERSONARSE CON EL TECNICO</button>
                                                    @elseif($monitor->estado_id == '4')
                                                        <button class="btn btn-success btn-raised" title="Actualizar estado" data-id="{{ $monitor->id }}" onclick="cambiarEstado({{ $monitor->id }}, {{ $monitor->estado_id }} )">CONCLUIDO</button>
                                                    @elseif($monitor->estado_id == '5')
                                                    {{-- ---------------------------------------RESULTADO FINAL--------------------------------------------}}
                                                        @if($monitor->resultado_id == '1')
                                                        <button class="boton300 badge-devolucion">
                                                        {{ $monitor->resultado?->nombre }}<br>  {{ date('d-m-Y H:i:s',strtotime($monitor->fecha_entrega ))}}</button>
                                                        @elseif($monitor->resultado_id == '2')
                                                        <button class="boton300 badge-reposicion">
                                                        {{ $monitor->resultado?->nombre }} <br>  {{ date('d-m-Y H:i:s',strtotime($monitor->fecha_entrega ))}}</button>
                                                        @elseif($monitor->resultado_id == '3')
                                                        <button class="boton300  badge-repliegue">
                                                            {{ $monitor->resultado?->nombre }} <br>  {{ date('d-m-Y H:i:s',strtotime($monitor->fecha_entrega ))}}</button>
                                                        @elseif($monitor->resultado_id == '4')
                                                        <button class="boton300  badge-custodio">
                                                            {{ $monitor->resultado?->nombre }}  <br>  {{ date('d-m-Y H:i:s',strtotime($monitor->fecha_entrega ))}}</button>
                                                        @elseif($monitor->resultado_id == '5')
                                                        <button class="boton300  badge-baja" >
                                                            {{ $monitor->resultado?->nombre }} <br>  {{ date('d-m-Y H:i:s',strtotime($monitor->fecha_entrega ))}}</button>
                                                        @endif
                                                    @endif
                                                <form id="form-cambiar-estado" method="POST" action="{{ route('estado-monitor') }}">
                                                    @csrf
                                                    <input type="hidden" name="id" id="id-monitor">
                                                    <input type="hidden" name="estado_id" id="estado-id">
                                                </form> 
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#ver{{ $monitor->id }}"><i class="fa fa-fw fa-eye"></i> {{ __('VER') }}</button>
                                                    @if($monitor->estado_id == '4' || $monitor->estado_id == '5')
                                                    <a class="btn btn-sm btn-secondary" href="{{ route('informe.monitor', $monitor->id) }}"><i class="fa fa-fw fa-file"></i>{{ __('INFORME') }}</a>
                                                    @endif
                                                </td>
                                            </tr>
                                    <!--Ventana Modal para Ver --->
                                    @include('monitor.modalVer')
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr align="center">
                                            <th>No</th>
                                            <th >FECHA DE RECEPCIÓN</th>
                                            <th >NOMBRE</th>
                                            <th >CELULAR</th>
                                            <th >DEPENDENCIA</th>
                                            <th >CODIGO GAMEA</th>
                                            <th >FALLA</th>
                                            <th >FECHA DE ASIGNACION</th>
                                            <th >FECHA DE INICIO</th>
                                            <th >ESTADO</th>
                                            <th>OPCIONES</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
<script src="{{ asset('js/mov.js') }}"></script>
<script>
    // Función para cambiar el estado
function cambiarEstado(id, estado_id) {
  // Obtener el formulario
  var form = document.getElementById('form-cambiar-estado');
  
  // Establecer los valores de los campos ocultos
  document.getElementById('id-monitor').value = id;
  document.getElementById('estado-id').value = estado_id;

  // Obtener el valor de fecha_entrega
  var fecha = new Date();
    var fecha_entrega = fecha.getFullYear() + '-' + 
                        String(fecha.getMonth() + 1).padStart(2, '0') + '-' + 
                        String(fecha.getDate()).padStart(2, '0') + ' ' + 
                        String(fecha.getHours()).padStart(2, '0') + ':' + 
                        String(fecha.getMinutes()).padStart(2, '0') + ':' + 
                        String(fecha.getSeconds()).padStart(2, '0');
  // Crear una solicitud AJAX
  var xhr = new XMLHttpRequest();
  xhr.open('POST', '{{ route('estado-monitor') }}', true);
  xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  
  // Enviar la solicitud
  if (estado_id == 4) {
        xhr.send('id=' + id + '&estado_id=' + estado_id + '&fecha_entrega=' + fecha_entrega);
    } else {
        xhr.send('id=' + id + '&estado_id=' + estado_id);
    }
  
  // Actualizar el botón de estado
  xhr.onload = function() {
    if (xhr.status === 200) {
  // Obtener el nuevo estado
  var respuesta = JSON.parse(xhr.responseText);
  var nuevoEstado = respuesta.estado;

  // Actualizar el botón de estado
  var boton = document.querySelector('button[data-id="' + id + '"]');
  boton.textContent = nuevoEstado;
  boton.classList.remove('btn-primary', 'btn-warning', 'btn-danger', 'btn-success', 'btn-info');
  if (nuevoEstado === 'RECEPCIONADO') {
    boton.classList.add('btn-primary');
  } else if (nuevoEstado === 'EN PROCESO') {
    boton.classList.add('btn-warning');
  } else if (nuevoEstado === 'APERSONARSE CON EL TECNICO') {
    boton.classList.add('btn-danger');
  } else if (nuevoEstado === 'CONCLUIDO') {
    boton.classList.add('btn-success');
  }else if (nuevoEstado === 'ENTREGADO') {
    boton.classList.add('btn-info');
  }
Swal.fire({
      position: "top-center",
      icon: "success",
      title: "ESTADO ACTUALIZADO <script>
function cambiarEstado(id, estadoId) {
    Swal.fire({
        title: 'CAMBIAR ESTADO',
        icon:'info',
        html: `
            <div><button class="btn btn-warning btn-block" id="en-proceso">EN PROCESO</button></div><br>
            <div><button class="btn btn-danger btn-block" id="apersonarse">APERSONARSE CON EL TECNICO</button></div><br>
            <div><button class="btn btn-success btn-block" id="concluido">CONCLUIDO</button></div><br>
            <div><button class="btn btn-info btn-block" id="entregado">ENTREGADO</button></div>
        `,
        showConfirmButton: false,
        showCancelButton: true,
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.dismiss === Swal.DismissReason.cancel) {
            // Código a ejecutar si se cancela
        }
    })

    // Agregar evento a los botones
    document.addEventListener('click', (event) => {
        if (event.target.id === 'en-proceso') {
            cambiarEstadoAjax(id, 2); 
        console.log(id, estadoId);           
        } else if (event.target.id === 'apersonarse') {
            cambiarEstadoAjax(id, 3); 
        console.log(id);   
        } else if (event.target.id === 'concluido') {
            cambiarEstadoAjax(id, 4); 
                    console.log(id);   
        }else if (event.target.id === 'entregado') {
            cambiarEstadoAjax(id, 5); 
                    console.log(id);   
        }
    })
}

function cambiarEstadoAjax(id, estado_id) {
let texto, botonConfirm;

if (estado_id == 5) {
    texto = "¿Quieres cambiar el estado?";
    botonConfirm = "Sí, cambiar";
} else {
    texto = "¿Quieres cambiar el estado y enviar alerta?";
    botonConfirm = "Sí, cambiar y enviar alerta!";
}

    Swal.fire({
    title: '¿Estás seguro?',
    text: texto,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: botonConfirm,
    cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {

            var xhr = new XMLHttpRequest();
            xhr.open('POST', '{{ route('estado-monitor') }}', true);
            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            // ✔️ SOLO enviar lo necesario
            xhr.send('id=' + id + '&estado_id=' + estado_id);

            xhr.onload = function() {
                if (xhr.status === 200) {

                    var respuesta = JSON.parse(xhr.responseText);
                    var nuevoEstado = respuesta.estado;

                    var boton = document.querySelector('button[data-id="' + id + '"]');

                    boton.textContent = nuevoEstado;
                    boton.classList.remove(
                        'btn-primary', 'btn-warning', 'btn-success',
                        'btn-danger', 'btn-info'
                    );

                    if (nuevoEstado === 'RECEPCIONADO') {
                        boton.classList.add('btn-primary');
                    } else if (nuevoEstado === 'EN PROCESO') {
                        boton.classList.add('btn-warning');
                    } else if (nuevoEstado === 'APERSONARSE CON EL TECNICO') {
                        boton.classList.add('btn-danger');
                    } else if (nuevoEstado === 'CONCLUIDO') {
                        boton.classList.add('btn-success');
                    } else if (nuevoEstado === 'DEVOLUCIÓN') {
                        boton.classList.add('btn-info');
                    }else if (nuevoEstado === 'REPOSICIÓN') {
                        boton.classList.add('btn-info');
                    }else if (nuevoEstado === 'REPLIEGUE') {
                        boton.classList.add('btn-info');
                    }else if (nuevoEstado === 'CUSTODIO') {
                        boton.classList.add('btn-info');
                    }else if (nuevoEstado === 'BAJA') {
                        boton.classList.add('btn-info');
                    }

                    let texto2, texto3;

                    if (estado_id == 5) {
                        texto2 = "El estado del equipo fue actualizado correctamente";
                        texto3 = "";
                    } else {
                        texto2 = "El estado del equipo fue actualizado correctamente.";
                        texto3 = "La alerta fue enviada correctamente.";
                    }

                    Swal.fire({
                        position: "top-center",
                        icon: "success",
                        title: texto2,
                        text: texto3,
                        showConfirmButton: true,
                    });
                }
            };
        }
    })
}
</script>
@stop