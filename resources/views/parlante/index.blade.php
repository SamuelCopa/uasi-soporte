@extends('layouts.app')

@section('template_title')
    Parlantes
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-header--custom">
                </div>
                    <div class="header-panel">
                        <div class="header-left">
                            <h1 class="header-title">Registro de Parlantes</h1>
                        </div>
                        <div class="header-actions">
                        <!-- Botón -->
                        <button class="btn btn-primary"
                                data-toggle="modal"
                                data-target="#crearp">
                            <i class="fa fa-plus me-1"></i> Nuevo
                        </button>
                        </div>
                    </div>
                    <!--Ventana Modal para Crear--->
                    @include('parlante.modalCrear')
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
                                    @foreach ($parlantes as $parlante)
                                        <tr>
                                            <td class="text-center">{{ ++$i }}</td>
                                            <td>
                                                @if($parlante->fecha)
                                                {{date('d-m-Y H:i',strtotime($parlante->fecha))}}<br><br>
                                                        @if(auth()->check() && auth()->user()->hasAnyRole([
                                                            'Administrador',
                                                            'SuperAdministrador'
                                                        ]))
                                                            @if(!($parlante->estado_id == '5'))
                                                                @php
                                                                $dias = floor(\Carbon\Carbon::parse($parlante->fecha)->diffInDays(\Carbon\Carbon::now()));
                                                                @endphp
                                                                <button 
                                                                class="btn btn-sm btn-estado"
                                                                data-dias="{{ $dias }}"
                                                                title="Días transcurridos desde la recepción">
                                                                {{ $dias }} DÍAS 
                                                                </button>
                                                            @endif
                                                        @endif
                                                @elseif(! $parlante->fecha)	
                                                {{ $parlante->fecha ?? ''}}
                                                @endif
                                          
                                            </td>
                                            <td >{{ $parlante->funcionario?->nombre}} {{ $parlante->funcionario?->paterno}} {{ $parlante->funcionario?->materno}}</td>
                                            <td >{{ $parlante->funcionario?->ci }} {{ $parlante->funcionario?->expedido }}</td>
                                            <td >{{ $parlante->funcionario?->celular }}</td>
                                            @if(! $parlante->cargo == '')
                                                <td >{{ $parlante->cargo }}</td>
                                            @else
                                                <td >{{ 'EX FUNCIONARIO'}}</td>
                                            @endif	
                                            @if(! $parlante->dependencia_id == '')
                                            <td >{{ $parlante->Dependencia?->dependencias }}</td>
                                            @else
                                            <td >{{ 'SIN DEPENDENCIA'}}</td>
                                            @endif
                                            <td >{{ $parlante->cod_gamea }}</td>	


                                            @if(auth()->check() && auth()->user()->hasAnyRole([
                                                'Administrador',
                                                'SuperAdministrador'
                                            ]))								
                                                <td class="{{ empty($parlante->cod_registro) ? 'color1' : '' }}" >
                                                    @if($parlante->cod_registro)
                                                    {{$parlante->cod_registro }}
                                                    @elseif(! $parlante->cod_registro)	
                                                    <button type="button" class="btn btn-sm btn-outline-light" data-toggle="modal" data-target="#eRecepcion{{ $parlante->id }}">{{ __( 'REGISTRAR NUMERO DE RECEPCIÓN' ) }}</button>
                                                    @endif
                                                </td> 
                                                <td class="{{ empty($parlante->user_id) ? 'color1' : '' }}">
                                                    @if($parlante->cod_registro)
                                                        @if($parlante->user_id)
                                                        {{ $parlante->user->name}} {{ $parlante->user->paterno}} {{ $parlante->user->materno}}
                                                        @elseif(! $parlante->user_id)
                                                        <button type="button" class="btn btn-sm btn-outline-light" data-toggle="modal" data-target="#eTecnico{{ $parlante->id }}">{{ __('ASIGNAR TECNICO') }}</button>
                                                        @endif
                                                    @elseif(! $parlante->cod_registro)	
                                                    <button type="button" class="btn btn-sm btn-outline-light" onclick="Swal.fire({ title: 'Error', text: 'DEBES REGISTRAR NUMERO DE RECEPCIÓN', icon: 'error', confirmButtonText: 'ACEPTAR' });">{{ __('ASIGNAR TECNICO') }}</button>
                                                    @endif
                                                </td>
                                                <td class="{{ empty($parlante->fecha_asignacion) ? 'color1' : '' }}">
                                                    @if($parlante->fecha_asignacion)
                                                    {{ date('d-m-Y H:i',strtotime($parlante->fecha_asignacion ))}}<BR><BR>
                                                    @if(!($parlante->estado_id == '5') && !($parlante->estado_id == '4'))
                                                        @php
                                                        $dias = floor(\Carbon\Carbon::parse($parlante->fecha_asignacion)->diffInDays(\Carbon\Carbon::now()));
                                                        @endphp
                                                        <button class="btn btn-sm btn-estado" data-dias="{{ $dias }}" title="Dias transcurridos desde la fecha de asignación">
                                                        {{ $dias }} DÍAS
                                                        </button>
                                                    @endif
                                                    @elseif(! $parlante->fecha_asignacion)	
                                                    <button type="button" class="btn btn-sm btn-outline-light" onclick="Swal.fire({ title: 'Error', text: 'DEBES ASIGNAR UN TECNICO', icon: 'error', confirmButtonText: 'ACEPTAR' });">{{ __('FECHA DE ASIGNACIÓN') }}</button>
                                                    @endif							
                                                </td>	
                                                <td class="{{ empty($parlante->fecha_inicio) ? 'color1' : '' }}">
                                                    @if($parlante->fecha_inicio)
                                                    {{ date('d-m-Y H:i',strtotime($parlante->fecha_inicio ))}}<BR><BR>
                                                    @if(!($parlante->estado_id == '5') && !($parlante->estado_id == '4'))
                                                        @php
                                                        $dias = floor(\Carbon\Carbon::parse($parlante->fecha_inicio)->diffInDays(\Carbon\Carbon::now()));
                                                        @endphp
                                                        <button class="btn btn-sm btn-estado" data-dias="{{ $dias }}" title="Dias transcurridos desde la fecha de inico de la reparación">
                                                        {{ $dias }} DÍAS
                                                        </button>
                                                    @endif
                                                    @elseif(! $parlante->fecha_inicio)	
                                                    <button type="button" class="btn btn-sm btn-outline-light" onclick="Swal.fire({ title: 'Error', text: 'EN ESPERA DEL INICIO DEL TRABAJO', icon: 'error', confirmButtonText: 'ACEPTAR' });">{{ __('EN ESPERA') }}</button>
                                                    @endif							
                                                </td>	
                                            @else 
                                            {{-- ----------------------user---------------------------------- --}}
                                                <td class="{{ empty($parlante->cod_registro) ? 'color1' : '' }}">
                                                    @if($parlante->cod_registro)
                                                    {{ $parlante->cod_registro}}
                                                    @elseif(! $parlante->cod_registro)	
                                                    {{ $parlante->cod_registro ?? 'SIN ASIGNAR'}}
                                                    @endif
                                                </td>
                                                <td class="{{ empty($parlante->user_id) ? 'color1' : '' }}" >
                                                        @if($parlante->user_id)
                                                        {{ $parlante->user->name}} {{ $parlante->user->paterno}} {{ $parlante->user->materno}}
                                                        @elseif(! $parlante->user_id)	
                                                        {{ $parlante->user->name?? 'SIN ASIGNAR'}}
                                                    @endif
                                                </td>
                                                <td class="{{ empty($parlante->fecha_asignacion) ? 'color1' : '' }}"  align="center">
                                                    @if($parlante->fecha_asignacion)
                                                    {{ date('d-m-Y',strtotime($parlante->fecha_asignacion ))}}<br><br>
                                                    @elseif(! $parlante->fecha_asignacion)	
                                                    {{($parlante->fecha_asignacion ?? 'SIN ASIGNAR' )}}
                                                    @endif	
                                                </td>
                                                <td class="{{ empty($parlante->fecha_inicio) ? 'color1' : '' }}"  align="center">
                                                    @if($parlante->fecha_inicio)
                                                    {{ date('d-m-Y',strtotime($parlante->fecha_inicio ))}}<br><br>
                                                    @elseif(! $parlante->fecha_inicio)	
                                                    {{($parlante->fecha_inicio ?? 'EN ESPERA' )}}
                                                    @endif	
                                                </td>
                                            @endif								
                                            <td>
                                                @if(
                                                    (!empty($parlante->cod_registro) &&
                                                    !empty($parlante->user_id) &&
                                                    !empty($parlante->fecha_asignacion))
                                                    ||
                                                    $parlante->estado_id != '1'
                                                )

                                                    @if($parlante->estado_id == '1')

                                                        <button
                                                            id="boton-actualizar-estado"
                                                            type="submit"
                                                            class="btn btn-primary btn-raised"

                                                            @if(auth()->check() && auth()->user()->hasAnyRole([
                                                                'Administrador',
                                                                'SuperAdministrador'
                                                            ]))
                                                                title="Actualizar estado"
                                                                data-id="{{ $parlante->id }}"
                                                                onclick="cambiarEstado(
                                                                    {{ $parlante->id }},
                                                                    {{ $parlante->estado_id }},
                                                                    {{ $parlante->resultado_id ? 'true' : 'false' }}
                                                                )"
                                                            @endif
                                                        >
                                                            RECEPCIONADO
                                                        </button>


                                                    @elseif($parlante->estado_id == '2')

                                                        <button
                                                            id="boton-actualizar-estado"
                                                            class="btn btn-warning btn-raised"

                                                            @if(auth()->check() && auth()->user()->hasAnyRole([
                                                                'Administrador',
                                                                'SuperAdministrador'
                                                            ]))
                                                                title="Actualizar estado"
                                                                data-id="{{ $parlante->id }}"
                                                                onclick="cambiarEstado(
                                                                    {{ $parlante->id }},
                                                                    {{ $parlante->estado_id }},
                                                                    {{ $parlante->resultado_id ? 'true' : 'false' }}
                                                                )"
                                                            @endif
                                                        >
                                                            EN PROCESO
                                                        </button>


                                                    @elseif($parlante->estado_id == '3')

                                                        <button
                                                            class="btn btn-danger btn-raised"

                                                            @if(auth()->check() && auth()->user()->hasAnyRole([
                                                                'Administrador',
                                                                'SuperAdministrador'
                                                            ]))
                                                                title="Actualizar estado"
                                                                data-id="{{ $parlante->id }}"
                                                                onclick="cambiarEstado(
                                                                    {{ $parlante->id }},
                                                                    {{ $parlante->estado_id }},
                                                                    {{ $parlante->resultado_id ? 'true' : 'false' }}
                                                                )"
                                                            @endif
                                                        >
                                                            APERSONARSE CON EL TECNICO
                                                            {{ $parlante->resultado?->nombre }}
                                                        </button>


                                                    @elseif($parlante->estado_id == '4')

                                                        <button
                                                            class="btn btn-success btn-raised"

                                                            @if(auth()->check() && auth()->user()->hasAnyRole([
                                                                'Administrador',
                                                                'SuperAdministrador'
                                                            ]))
                                                                title="Actualizar estado"
                                                                data-id="{{ $parlante->id }}"
                                                                onclick="cambiarEstado(
                                                                    {{ $parlante->id }},
                                                                    {{ $parlante->estado_id }},
                                                                    {{ $parlante->resultado_id ? 'true' : 'false' }}
                                                                )"
                                                            @endif
                                                        >
                                                            CONCLUIDO
                                                        </button>


                                                    @elseif($parlante->estado_id == '5')

                                                        {{-- ---------------------------------------RESULTADO FINAL-------------------------------------------- --}}

                                                        @if($parlante->resultado_id == '1')

                                                            <button class="boton300 badge-devolucion">
                                                                {{ $parlante->resultado?->nombre }}<br>
                                                                {{ date('d-m-Y H:i:s', strtotime($parlante->fecha_entrega)) }}
                                                            </button>

                                                        @elseif($parlante->resultado_id == '2')

                                                            <button class="boton300 badge-reposicion">
                                                                {{ $parlante->resultado?->nombre }}<br>
                                                                {{ date('d-m-Y H:i:s', strtotime($parlante->fecha_entrega)) }}
                                                            </button>

                                                        @elseif($parlante->resultado_id == '3')

                                                            <button class="boton300 badge-repliegue">
                                                                {{ $parlante->resultado?->nombre }}<br>
                                                                {{ date('d-m-Y H:i:s', strtotime($parlante->fecha_entrega)) }}
                                                            </button>

                                                        @elseif($parlante->resultado_id == '4')

                                                            <button class="boton300 badge-custodio">
                                                                {{ $parlante->resultado?->nombre }}<br>
                                                                {{ date('d-m-Y H:i:s', strtotime($parlante->fecha_entrega)) }}
                                                            </button>

                                                        @elseif($parlante->resultado_id == '5')

                                                            <button class="boton300 badge-baja">
                                                                {{ $parlante->resultado?->nombre }}<br>
                                                                {{ date('d-m-Y H:i:s', strtotime($parlante->fecha_entrega)) }}
                                                            </button>

                                                        @endif

                                                    @endif


                                                @else

                                                    @if(empty($parlante->user_id))

                                                        <button
                                                            type="submit"
                                                            class="btn btn-primary btn-raised"
                                                            data-id="{{ $parlante->id }}"

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


                                                    @elseif(empty($parlante->fecha_asignacion))

                                                        <button
                                                            type="submit"
                                                            class="btn btn-primary btn-raised"
                                                            data-id="{{ $parlante->id }}"

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
                                                <form id="form-cambiar-estado" method="POST" action="{{ route('estado-parlante') }}">
                                                    @csrf
                                                    <input type="hidden" name="id" id="id-parlante">
                                                    <input type="hidden" name="estado_id" id="estado-id">
                                                </form> 
                                            </td>
                                            <td>
                                            <div class="acciones">

                                                <!-- PDF -->
                                                <a href="#"
                                                class="btn-mini btn-danger btn-preview-pdf"
                                                data-ver="{{ route('pdf.parlante.preview', ':id') }}"
                                                data-descargar="{{ route('pdf.parlante.descargar', ':id') }}"
                                                data-enviar="{{ route('pdf.parlante.enviar', ':id') }}"
                                                data-id="{{ $parlante->id }}"
                                                title="Formulario PDF">
                                                    <i class="far fa-file-pdf"></i>
                                                </a>

                                                <!-- VER -->
                                                <button type="button"
                                                        data-toggle="modal"
                                                        data-target="#ver{{ $parlante->id }}"
                                                        class="btn-mini btn-primary"
                                                        title="Ver">
                                                    <i class="fa fa-eye"></i>
                                                </button>

                                                @if(auth()->check() && auth()->user()->hasAnyRole([
                                                    'Administrador',
                                                    'SuperAdministrador'
                                                ]))

                                                    <!-- EDITAR -->
                                                    <button type="button"
                                                            data-toggle="modal"
                                                            data-target="#editar{{ $parlante->id }}"
                                                            class="btn-mini btn-success"
                                                            title="Editar">
                                                        <i class="fa fa-edit"></i>
                                                    </button>

                                                <!-- DETALLE DEL TRABAJO REALIZADO -->
                                                <button type="button"
                                                        class="btn btn-sm btn-secondary"
                                                        data-toggle="modal"
                                                        data-target="#modalResultado{{ $parlante->id }}"
                                                        title="Registrar detalle del trabajo realizado">
                                                    <i class="fas fa-file-alt"></i>
                                                </button>  

                                                    <!-- ELIMINAR -->
                                                    <form action="{{ route('parlantes.destroy', $parlante->id) }}"
                                                        method="POST"
                                                        class="formEliminar">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit"
                                                                class="btn-mini btn-danger"
                                                                title="Eliminar">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>

                                                @endif

                                            </div>
                                            </td>
                                        </tr>
                                            <!--Ventana Modal para Ver --->
                                            @include('parlante.modalVer')
                                            @include('parlante.modalResultado')
                                            <!--Ventana Modal eRecepcion --->
                                            @include('parlante.modalRecepcion')
                                            <!--Ventana Modal eTecnico --->
                                            @include('parlante.registroTecnico')
                                            <!--Ventana Modal para Actualizar--->
                                            @include('parlante.modalEdit')
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr align="center">
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
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $parlantes->withQueryString()->links() !!}
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
            xhr.open('POST', '{{ route('estado-parlante') }}', true);
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
<script src="{{ asset('js/parlante.js') }}"></script>
<script src="{{ asset('js/fechas.js') }}"></script>
<link rel="stylesheet" href="{{ asset('estilos/fechas.css') }}">  
<script src="{{ asset('js/equipoPdf.js') }}"></script>
<link rel="stylesheet" href="{{ asset('estilos/equipoPdf.css') }}"> 
```html
<script>
document.addEventListener('DOMContentLoaded', function () {

    const input = document.getElementById('search-inputP');
    const lista = document.getElementById('optionsP');
    const hidden = document.getElementById('id-selectedP');

    if (!input || !lista || !hidden) return;

    function validarDependencia() {

        const valor = input.value.trim();

        // Limpiar cualquier ID anterior.
        hidden.value = '';

        if (valor === '') {
            input.setCustomValidity('');
            return;
        }

        const opcion = Array.from(lista.options).find(option =>
            option.value.trim() === valor &&
            option.dataset.id &&
            /^[1-9]\d*$/.test(option.dataset.id)
        );

        if (opcion) {
            hidden.value = opcion.dataset.id;
            input.setCustomValidity('');
        } else {
            input.setCustomValidity(
                'Seleccione una dependencia registrada en la lista.'
            );
        }
    }

    input.addEventListener('input', validarDependencia);
    input.addEventListener('change', validarDependencia);

    const formulario = input.closest('form');

    if (formulario) {
        formulario.addEventListener('submit', function (event) {

            validarDependencia();

            if (input.value.trim() !== '' && !hidden.value) {
                event.preventDefault();
                input.reportValidity();
                input.focus();
            }
        });
    }
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    // Buscar todos los formularios que envían datos mediante POST.
    document.querySelectorAll('form[method="POST"]').forEach(function (formulario) {

        formulario.addEventListener('submit', function (event) {

            // Evitar que se envíe nuevamente el mismo formulario.
            if (formulario.dataset.enviando === 'true') {
                event.preventDefault();
                return;
            }

            // Respetar la validación HTML de los campos obligatorios.
            if (!formulario.checkValidity()) {
                return;
            }

            formulario.dataset.enviando = 'true';

            // Deshabilitar el botón que inició el envío.
            const boton = event.submitter;

            if (boton) {
                boton.disabled = true;
                boton.textContent = 'Registrando...';
            }

        });

    });

});
</script>
@endpush