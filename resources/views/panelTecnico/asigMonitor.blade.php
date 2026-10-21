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
                            <h1 class="header-title">Asignaciones monitor</h1>
                        </div>
                        <div class="header-actions">
                        <!-- Botón -->
                            <a href="{{ route('home') }}"
                                class="btn  btn-block fw-bold text-white"
                                style="background: linear-gradient(90deg, #dc3545, #a71d2a);
                                        border: none;
                                        border-radius: 8px;
                                        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
                                        transition: all 0.3s;">
                                <span class="icono">↩️</span> Volver a panel de control
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
                                        @foreach($user->monitorActuales() as $monitor)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ date('d-m-Y',strtotime($monitor->fecha))}}</td>	
                                                <td>{{ $monitor->funcionario?->nombre }} {{ $monitor->funcionario?->paterno }} {{ $monitor->funcionario?->materno }}</td>
                                                <td>{{ $monitor->funcionario?->celular }}</td>
                                                <td>{{ $monitor->Dependencia?->dependencias ?? 'SIN DEPENDENCIA'}}</td>
                                                <td>{{ $monitor->cod_gamea }}</td>
                                                <td>{{ $monitor->falla }}</td>
                                                <td class="{{ empty($monitor->fecha_asignacion) ? 'color1' : '' }}">
                                                    @if($monitor->fecha_asignacion)
                                                    {{ date('d-m-Y H:i',strtotime($monitor->fecha_asignacion ))}}
                                                    @endif								
                                                </td>
                                                <td class="{{ empty($monitor->fecha_inicio) ? 'color1' : '' }}">
                                                    @if($monitor->fecha_inicio)
                                                    {{ date('d-m-Y H:i',strtotime($monitor->fecha_inicio ))}}
                                                    @elseif(! $monitor->fecha_inicio)	
                                                    <button type="button" class="btn btn-sm btn-outline-light" onclick="Swal.fire({ title: 'Información', text: 'EN ESPERA DEL INICIO DEL TRABAJO', icon: 'info', confirmButtonText: 'ACEPTAR' });">{{ __('EN ESPERA') }}</button>
                                                    @endif								
                                                </td>
                                                <td>
                                                    @if($monitor->estado_id == '1')
                                                    <button type="submit" class="btn btn-primary btn-raised" title="Actualizar estado" data-id="{{ $monitor->id }}" onclick="cambiarEstado({{ $monitor->id }},{{ $monitor->estado_id }}, {{ $monitor->resultado_id ? 'true' : 'false' }} )">RECEPCIONADO</button>
                                                    @elseif($monitor->estado_id == '2')
                                                        <button class="btn btn-warning btn-raised" title="Actualizar estado" data-id="{{ $monitor->id }}" onclick="cambiarEstado({{ $monitor->id }}, {{ $monitor->estado_id }}, {{ $monitor->resultado_id ? 'true' : 'false' }} )">EN PROCESO</button>
                                                    @elseif($monitor->estado_id == '3')
                                                        <button class="btn btn-danger btn-raised" title="Actualizar estado" data-id="{{ $monitor->id }}" onclick="cambiarEstado({{ $monitor->id }}, {{ $monitor->estado_id }}, {{ $monitor->resultado_id ? 'true' : 'false' }} )">APERSONARSE CON EL TECNICO</button>
                                                    @elseif($monitor->estado_id == '4')
                                                        <button class="btn btn-success btn-raised" title="Actualizar estado" data-id="{{ $monitor->id }}" onclick="cambiarEstado({{ $monitor->id }}, {{ $monitor->estado_id }}, {{ $monitor->resultado_id ? 'true' : 'false' }} )">CONCLUIDO</button>
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
                                                   @if($monitor->estado_id == 4)
                                                        <button
                                                            type="button"
                                                            class="btn btn-sm btn-secondary"
                                                            data-toggle="modal"
                                                            data-target="#modalResultado{{ $monitor->id }}">
                                                            <i class="fa fa-fw fa-file"></i>
                                                            DETALLE DEL TRABAJO REALIZADO
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                    <!--Ventana Modal para Ver --->
                                    @include('monitor.modalVer')
                                    @include('monitor.modalResultado')
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
function cambiarEstado(id, estadoId, tieneResultado) {
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
        }
        else if (event.target.id === 'entregado') {
        if (tieneResultado) {

            // Si tiene resultado, actualizar el estado a Entregado
            cambiarEstadoAjax(id, 5);
            console.log(id);

        } else {

            // Mostrar únicamente el mensaje
            Swal.fire({
                position: 'top-center',
                icon: 'warning',
                title: 'Detalle del trabajo pendiente',
                text: 'Debes llenar el detalle de trabajo realizado para actualizar el estado a Entregado.',
                confirmButtonText: 'Entendido',
                confirmButtonColor: '#3085d6'
            });

        }
        }
    })
}

function cambiarEstadoAjax(id, estado_id) {
let texto, botonConfirm;

    if ([2, 5].includes(Number(estado_id))) {

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
                Swal.fire({
                title: 'Actualizando...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
                });
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