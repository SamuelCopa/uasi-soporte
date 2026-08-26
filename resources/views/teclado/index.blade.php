@extends('layouts.app')

@section('template_title')
    Teclados
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-header--custom">
                </div>
                    <div class="header-panel">
                        <div class="header-left">
                            <h1 class="header-title">Registro de Teclados</h1>
                        </div>
                        <div class="header-actions">
                            <!-- Botón -->
                            <button class="btn btn-primary" data-toggle="modal" data-target="#creart">
                                <i class="fa fa-plus me-1"></i> Nuevo
                            </button>
                        </div>
                    </div>
                    <!--Ventana Modal para Crear--->
                    @include('teclado.modalCrear')
                    <div class="card shadow-sm border-0 rounded-4">
                        <div class="table-responsive">
                            <table id="mitabla" class="table table-modern align-middle">
                                <thead>
                                    <!-- Encabezado principal -->
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th >FECHA DE RECEPCIÓN</th>  
                                        <th >NOMBRE</th>
                                        <th >C.I.</th>
                                        <th >CELULAR</th>
                                        <th >CARGO</th>
                                        <th >DEPENDENCIA</th>
                                        <th >CODIGO GAMEA</th>									
                                        <th >NUMERO DE RECEPCIÓN</th>
                                        <th >TECNICO A CARGO</th>									
                                        <th >FECHA DE ASIGNACIÓN</th>
                                        <th >FECHA DE INICIO</th>
                                        <th >ESTADO</th>
                                        <th>OPCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($teclados as $teclado)
                                        <tr>
                                            <td class="text-center">{{ ++$i }}</td>
                                            <td>
                                                @if($teclado->fecha)
                                                {{date('d-m-Y H:i',strtotime($teclado->fecha))}}<br><br>
                                                        @if(auth()->check() && auth()->user()->hasAnyRole([
                                                            'Administrador',
                                                            'SuperAdministrador'
                                                        ]))
                                                            @if(!($teclado->estado_id == '5'))
                                                                @php
                                                                $dias = floor(\Carbon\Carbon::parse($teclado->fecha)->diffInDays(\Carbon\Carbon::now()));
                                                                @endphp
                                                                <button 
                                                                class="btn btn-sm btn-estado"
                                                                data-dias="{{ $dias }}"
                                                                title="Días transcurridos desde la recepción">
                                                                {{ $dias }} DÍAS 
                                                                </button>
                                                            @endif
                                                        @endif
                                                @elseif(! $teclado->fecha)	
                                                {{ $teclado->fecha ?? ''}}
                                                @endif
                                          
                                            </td>
                                            <td >{{ $teclado->funcionario?->nombre}} {{ $teclado->funcionario?->paterno}} {{ $teclado->funcionario?->materno}}</td>
                                            <td >{{ $teclado->funcionario?->ci }} {{ $teclado->funcionario?->expedido }}</td>
                                            <td >{{ $teclado->funcionario?->celular }}</td>
                                            @if(! $teclado->cargo == '')
                                                <td >{{ $teclado->cargo }}</td>
                                            @else
                                                <td >{{ 'EX FUNCIONARIO'}}</td>
                                            @endif	
                                            @if(! $teclado->dependencia_id == '')
                                            <td >{{ $teclado->Dependencia?->dependencias }}</td>
                                            @else
                                            <td >{{ 'SIN DEPENDENCIA'}}</td>
                                            @endif
                                            <td >{{ $teclado->cod_gamea }}</td>	


                                            @if(auth()->check() && auth()->user()->hasAnyRole([
                                                'Administrador',
                                                'SuperAdministrador'
                                            ]))								
                                                <td class="{{ empty($teclado->cod_registro) ? 'color1' : '' }}" >
                                                    @if($teclado->cod_registro)
                                                    {{$teclado->cod_registro }}
                                                    @elseif(! $teclado->cod_registro)	
                                                    <button type="button" class="btn btn-sm btn-outline-light" data-toggle="modal" data-target="#eRecepcion{{ $teclado->id }}">{{ __( 'REGISTRAR NUMERO DE RECEPCIÓN' ) }}</button>
                                                    @endif
                                                </td> 
                                                <td class="{{ empty($teclado->user_id) ? 'color1' : '' }}">
                                                    @if($teclado->cod_registro)
                                                        @if($teclado->user_id)
                                                        {{ $teclado->user->name}} {{ $teclado->user->paterno}} {{ $teclado->user->materno}}
                                                        @elseif(! $teclado->user_id)
                                                        <button type="button" class="btn btn-sm btn-outline-light" data-toggle="modal" data-target="#eTecnico{{ $teclado->id }}">{{ __('ASIGNAR TECNICO') }}</button>
                                                        @endif
                                                    @elseif(! $teclado->cod_registro)	
                                                    <button type="button" class="btn btn-sm btn-outline-light" onclick="Swal.fire({ title: 'Error', text: 'DEBES REGISTRAR NUMERO DE RECEPCIÓN', icon: 'error', confirmButtonText: 'ACEPTAR' });">{{ __('ASIGNAR TECNICO') }}</button>
                                                    @endif
                                                </td>
                                                <td class="{{ empty($teclado->fecha_asignacion) ? 'color1' : '' }}">
                                                    @if($teclado->fecha_asignacion)
                                                    {{ date('d-m-Y H:i',strtotime($teclado->fecha_asignacion ))}}<BR><BR>
                                                    @if(!($teclado->estado_id == '5') && !($teclado->estado_id == '4'))
                                                        @php
                                                        $dias = floor(\Carbon\Carbon::parse($teclado->fecha_asignacion)->diffInDays(\Carbon\Carbon::now()));
                                                        @endphp
                                                        <button class="btn btn-sm btn-estado" data-dias="{{ $dias }}" title="Dias transcurridos desde la fecha de asignación">
                                                        {{ $dias }} DÍAS
                                                        </button>
                                                    @endif
                                                    @elseif(! $teclado->fecha_asignacion)	
                                                    <button type="button" class="btn btn-sm btn-outline-light" onclick="Swal.fire({ title: 'Error', text: 'DEBES ASIGNAR UN TECNICO', icon: 'error', confirmButtonText: 'ACEPTAR' });">{{ __('FECHA DE ASIGNACIÓN') }}</button>
                                                    @endif							
                                                </td>	
                                                <td class="{{ empty($teclado->fecha_inicio) ? 'color1' : '' }}">
                                                    @if($teclado->fecha_inicio)
                                                    {{ date('d-m-Y H:i',strtotime($teclado->fecha_inicio ))}}<BR><BR>
                                                    @if(!($teclado->estado_id == '5') && !($teclado->estado_id == '4'))
                                                        @php
                                                        $dias = floor(\Carbon\Carbon::parse($teclado->fecha_inicio)->diffInDays(\Carbon\Carbon::now()));
                                                        @endphp
                                                        <button class="btn btn-sm btn-estado" data-dias="{{ $dias }}" title="Dias transcurridos desde la fecha de inico de la reparación">
                                                        {{ $dias }} DÍAS
                                                        </button>
                                                    @endif
                                                    @elseif(! $teclado->fecha_inicio)	
                                                    <button type="button" class="btn btn-sm btn-outline-light" onclick="Swal.fire({ title: 'Error', text: 'EN ESPERA DEL INICIO DEL TRABAJO', icon: 'error', confirmButtonText: 'ACEPTAR' });">{{ __('EN ESPERA') }}</button>
                                                    @endif							
                                                </td>	
                                            @else 
                                            {{-- -------------------------------------------------------------------------- --}}
                                            <td class="{{ empty($teclado->cod_registro) ? 'color1' : '' }}" >
                                                @if($teclado->cod_registro)
                                                {{ $teclado->cod_registro}}
                                                @elseif(! $teclado->cod_registro)	
                                                {{ $teclado->cod_registro ?? 'SIN ASIGNAR'}}
                                                @endif
                                            </td> 
                                            <td class="{{ empty($teclado->user_id) ? 'color1' : '' }}" >
                                                @if($teclado->user_id)
                                                {{ $teclado->user->name}} {{ $teclado->user->paterno}} {{ $teclado->user->materno}}
                                                @elseif(! $teclado->user_id)	
                                                {{ $teclado->user->name ?? 'SIN ASIGNAR'}}
                                                @endif
                                            </td>
                                            <td class="{{ empty($teclado->fecha_asignacion) ? 'color1' : '' }}">
                                                @if($teclado->fecha_asignacion)
                                                {{ date('d-m-Y',strtotime($teclado->fecha_asignacion ))}}
                                                @elseif(! $teclado->fecha_asignacion)	
                                                {{($teclado->fecha_asignacion ?? 'SIN ASIGNAR' )}}
                                                @endif								
                                            </td>
                                            <td class="{{ empty($teclado->fecha_inicio) ? 'color1' : '' }}">
                                                @if($teclado->fecha_inicio)
                                                {{ date('d-m-Y',strtotime($teclado->fecha_inicio ))}}
                                                @elseif(! $teclado->fecha_inicio)	
                                                {{($teclado->fecha_inicio ?? 'EN ESPERA' )}}
                                                @endif								
                                            </td>
                                            @endif								
                                            <td >
                                                @if(
                                                    (!empty($teclado->cod_registro) &&
                                                    !empty($teclado->user_id) &&
                                                    !empty($teclado->fecha_asignacion))
                                                    ||
                                                    $teclado->estado_id != '1'
                                                )

                                                    @if($teclado->estado_id == '1')

                                                        <button
                                                            id="boton-actualizar-estado"
                                                            type="submit"
                                                            class="btn btn-primary btn-raised"

                                                            @if(auth()->check() && auth()->user()->hasAnyRole([
                                                                'Administrador',
                                                                'SuperAdministrador'
                                                            ]))
                                                                title="Actualizar estado"
                                                                data-id="{{ $teclado->id }}"
                                                                onclick="cambiarEstado(
                                                                    {{ $teclado->id }},
                                                                    {{ $teclado->estado_id }},
                                                                    {{ $teclado->resultado_id ? 'true' : 'false' }}
                                                                )"
                                                            @endif
                                                        >
                                                            RECEPCIONADO
                                                        </button>


                                                    @elseif($teclado->estado_id == '2')

                                                        <button
                                                            id="boton-actualizar-estado"
                                                            class="btn btn-warning btn-raised"

                                                            @if(auth()->check() && auth()->user()->hasAnyRole([
                                                                'Administrador',
                                                                'SuperAdministrador'
                                                            ]))
                                                                title="Actualizar estado"
                                                                data-id="{{ $teclado->id }}"
                                                                onclick="cambiarEstado(
                                                                    {{ $teclado->id }},
                                                                    {{ $teclado->estado_id }},
                                                                    {{ $teclado->resultado_id ? 'true' : 'false' }}
                                                                )"
                                                            @endif
                                                        >
                                                            EN PROCESO
                                                        </button>


                                                    @elseif($teclado->estado_id == '3')

                                                        <button
                                                            class="btn btn-danger btn-raised"

                                                            @if(auth()->check() && auth()->user()->hasAnyRole([
                                                                'Administrador',
                                                                'SuperAdministrador'
                                                            ]))
                                                                title="Actualizar estado"
                                                                data-id="{{ $teclado->id }}"
                                                                onclick="cambiarEstado(
                                                                    {{ $teclado->id }},
                                                                    {{ $teclado->estado_id }},
                                                                    {{ $teclado->resultado_id ? 'true' : 'false' }}
                                                                )"
                                                            @endif
                                                        >
                                                            APERSONARSE CON EL TECNICO
                                                            {{ $teclado->resultado?->nombre }}
                                                        </button>


                                                    @elseif($teclado->estado_id == '4')

                                                        <button
                                                            class="btn btn-success btn-raised"

                                                            @if(auth()->check() && auth()->user()->hasAnyRole([
                                                                'Administrador',
                                                                'SuperAdministrador'
                                                            ]))
                                                                title="Actualizar estado"
                                                                data-id="{{ $teclado->id }}"
                                                                onclick="cambiarEstado(
                                                                    {{ $teclado->id }},
                                                                    {{ $teclado->estado_id }},
                                                                    {{ $teclado->resultado_id ? 'true' : 'false' }}
                                                                )"
                                                            @endif
                                                        >
                                                            CONCLUIDO
                                                        </button>


                                                    @elseif($teclado->estado_id == '5')

                                                        {{-- ---------------------------------------RESULTADO FINAL-------------------------------------------- --}}

                                                        @if($teclado->resultado_id == '1')

                                                            <button class="boton300 badge-devolucion">
                                                                {{ $teclado->resultado?->nombre }}<br>
                                                                {{ date('d-m-Y H:i:s', strtotime($teclado->fecha_entrega)) }}
                                                            </button>

                                                        @elseif($teclado->resultado_id == '2')

                                                            <button class="boton300 badge-reposicion">
                                                                {{ $teclado->resultado?->nombre }}<br>
                                                                {{ date('d-m-Y H:i:s', strtotime($teclado->fecha_entrega)) }}
                                                            </button>

                                                        @elseif($teclado->resultado_id == '3')

                                                            <button class="boton300 badge-repliegue">
                                                                {{ $teclado->resultado?->nombre }}<br>
                                                                {{ date('d-m-Y H:i:s', strtotime($teclado->fecha_entrega)) }}
                                                            </button>

                                                        @elseif($teclado->resultado_id == '4')

                                                            <button class="boton300 badge-custodio">
                                                                {{ $teclado->resultado?->nombre }}<br>
                                                                {{ date('d-m-Y H:i:s', strtotime($teclado->fecha_entrega)) }}
                                                            </button>

                                                        @elseif($teclado->resultado_id == '5')

                                                            <button class="boton300 badge-baja">
                                                                {{ $teclado->resultado?->nombre }}<br>
                                                                {{ date('d-m-Y H:i:s', strtotime($teclado->fecha_entrega)) }}
                                                            </button>

                                                        @endif

                                                    @endif


                                                @else

                                                    @if(empty($teclado->user_id))

                                                        <button
                                                            type="submit"
                                                            class="btn btn-primary btn-raised"
                                                            data-id="{{ $teclado->id }}"

                                                            @if(auth()->check() && auth()->user()->hasAnyRole([
                                                                'Administrador',
                                                                'SuperAdministrador'
                                                            ]))
                                                                onclick="Swal.fire({
                                                                    title: 'Error',
                                                                    text: 'DEBES ASIGNAR UN TECNICO',
                                                                    icon: 'error',
                                                                    confirmButtonText: 'ACEPTAR'
                                                                });"
                                                            @endif
                                                        >
                                                            RECEPCIONADO
                                                        </button>


                                                    @elseif(empty($teclado->fecha_asignacion))

                                                        <button
                                                            type="submit"
                                                            class="btn btn-primary btn-raised"
                                                            data-id="{{ $teclado->id }}"

                                                            @if(auth()->check() && auth()->user()->hasAnyRole([
                                                                'Administrador',
                                                                'SuperAdministrador'
                                                            ]))
                                                                onclick="Swal.fire({
                                                                    title: 'Error',
                                                                    text: 'DEBES ASIGNAR UNA FECHA DE INICIO',
                                                                    icon: 'error',
                                                                    confirmButtonText: 'ACEPTAR'
                                                                });"
                                                            @endif
                                                        >
                                                            RECEPCIONADO
                                                        </button>

                                                    @endif

                                                @endif
                                                <form id="form-cambiar-estado" method="POST" action="{{ route('estado-teclado') }}">
                                                    @csrf
                                                    <input type="hidden" name="id" id="id-teclado">
                                                    <input type="hidden" name="estado_id" id="estado-id">
                                                </form> 
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-institucional dropdown-toggle" type="button" data-toggle="dropdown">
                                                        <i class="fas fa-cog"></i> OPCIONES
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right p-2">
                                                        <!-- PDF -->
                                                        <a href="#" 
                                                        class="dropdown-card card-danger btn-preview-pdf"
                                                        data-ver="{{ route('pdf.teclado.preview', ':id') }}"
                                                        data-descargar="{{ route('pdf.teclado.descargar', ':id') }}"
                                                        data-enviar="{{ route('pdf.teclado.enviar', ':id') }}"
                                                        data-id="{{ $teclado->id }}">
                                                        <i class="far fa-file-pdf"></i> FORMULARIO
                                                        </a>
                                                        <!-- VER -->
                                                        <button type="button" data-toggle="modal" data-target="#ver{{ $teclado->id }}"
                                                                class="dropdown-card card-primary">
                                                            <i class="fa fa-eye"></i> VER
                                                        </button>
                                                        @if(auth()->check() && auth()->user()->hasAnyRole([
                                                            'Administrador',
                                                            'SuperAdministrador'
                                                        ]))
                                                        <!-- EDITAR -->
                                                        <button type="button" data-toggle="modal" data-target="#editar{{ $teclado->id }}"
                                                                class="dropdown-card card-success">
                                                            <i class="fa fa-edit"></i> EDITAR
                                                        </button>
                                                        <!-- INFORME -->
                                                        <a href="{{ route('informe.teclado', $teclado->id) }}"
                                                        class="dropdown-card card-secondary">
                                                            <i class="fa fa-file"></i> INFORME
                                                        </a>
                                                        <!-- ELIMINAR -->
                                                        <form action="{{ route('teclados.destroy', $teclado->id) }}" method="POST" class="formEliminar">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                    class="dropdown-card card-danger">
                                                                <i class="fa fa-trash"></i> ELIMINAR
                                                            </button>
                                                        </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <!--Ventana Modal para Ver --->
                                        @include('teclado.modalVer')
                                        <!--Ventana Modal eRecepcion --->
                                        @include('teclado.modalRecepcion')
                                        <!--Ventana Modal eTecnico --->
                                        @include('teclado.registroTecnico')
                                        <!--Ventana Modal para Actualizar--->
                                        @include('teclado.modalEdit')
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr align="center">
                                        <th>No</th>                                        
                                        <th >FECHA DE RECEPCIÓN</th>   
                                        <th >NOMBRE</th>
                                        <th >C.I.</th>
                                        <th >CARGO</th>
                                        <th >CELULAR</th>
                                        <th >DEPENDENCIA</th>
                                        <th >CODIGO GAMEA</th>									
                                        <th >NÚMERO DE RECEPCIÓN</th>
                                        <th >TECNICO A CARGO</th>									
                                        <th >FECHA DE ASIGNACIÓN</th>
                                        <th >FECHA DE INICIO</th>
                                        <th >ESTADO</th>
                                        <th>OPCIONES</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $teclados->withQueryString()->links() !!}
            </div>
        </div>
    </div>
    <div id="panelPdf" class="pdf-panel">
        <!-- HEADER -->
        <div class="pdf-panel-header">
            <span>Vista previa Formulario de recepción</span>

            <div class="acciones">
                <a id="btnDescargar" class="btn btn-primary btn-sm"> ⬇ Descargar</a>

                <form id="formEnviar" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-success btn-sm">
                        ✉ Enviar
                    </button>
                </form>

                <button id="btnCerrarPdf" class="btn btn-danger btn-sm">
                    ✕ Cerrar
                </button>
            </div>
        </div>
        <!-- CONTENIDO -->
        <div class="pdf-panel-body">
            <iframe id="visorPdf"></iframe>
        </div>
    </div>
@endsection

@section('js')
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
            cambiarEstadoAjax(id, 5);
            console.log(id);
        } else {
                Swal.fire({
                    position: "top-center",
                    icon: "error",
                    title: 'Debes llenar el informe antes de actualizar el estado',
                    showConfirmButton: true,
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

// Llamada a SweetAlert
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
            xhr.open('POST', '{{ route('estado-teclado') }}', true);
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

@push('js')
<script src="{{ asset('js/funcion.js') }}"></script>
<script src="{{ asset('js/mov.js') }}"></script>
<script src="{{ asset('js/teclado.js') }}"></script>
<script src="{{ asset('js/fechas.js') }}"></script>
<link rel="stylesheet" href="{{ asset('estilos/fechas.css') }}"> 
<script src="{{ asset('js/equipoPdf.js') }}"></script>
<link rel="stylesheet" href="{{ asset('estilos/equipoPdf.css') }}">  
<script>
const searchInputT = document.getElementById('search-inputT');
const optionsT = document.getElementById('optionsT').options;
const idSelectedInputT = document.getElementById('id-selectedT');

searchInputT.addEventListener('input', () => {
    const selectedOption = Array.from(optionsT).find(option => option.value === searchInputT.value);
    if (selectedOption) {
        idSelectedInputT.value = selectedOption.dataset.id;
    }
});
</script>
@endpush