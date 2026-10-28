@extends('layouts.app')

@section('template_title')
    Upeses
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class=" card-header--custom">
                </div>
                    <div class="header-panel">
                        <div class="header-left">
                            <h1 class="header-title">Registro de UPS</h1>
                        </div>
                        <div class="header-actions">
                        <!-- Botón -->
                        <button class="btn btn-primary"
                                data-toggle="modal"
                                data-target="#crearu">
                            <i class="fa fa-plus me-1"></i> Nuevo
                        </button>
                        </div>
                    </div>
                    <!--Ventana Modal para Crear--->
                    @include('upese.modalCrear')
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
                                     @foreach ($upeses as $upese)
                                        <tr>
                                            <td class="text-center">{{ ++$i }}</td>
                                            <td>
                                                @if($upese->fecha)
                                                {{date('d-m-Y H:i',strtotime($upese->fecha))}}<br><br>
                                                        @if(auth()->check() && auth()->user()->hasAnyRole([
                                                            'Administrador',
                                                            'SuperAdministrador'
                                                        ]))
                                                            @if(!($upese->estado_id == '5'))
                                                                @php
                                                                $dias = floor(\Carbon\Carbon::parse($upese->fecha)->diffInDays(\Carbon\Carbon::now()));
                                                                @endphp
                                                                <button 
                                                                class="btn btn-sm btn-estado"
                                                                data-dias="{{ $dias }}"
                                                                title="Días transcurridos desde la recepción">
                                                                {{ $dias }} DÍAS 
                                                                </button>
                                                            @endif
                                                        @endif
                                                @elseif(! $upese->fecha)	
                                                {{ $upese->fecha ?? ''}}
                                                @endif
                                          
                                            </td>
                                            <td >{{ $upese->funcionario?->nombre}} {{ $upese->funcionario?->paterno}} {{ $upese->funcionario?->materno}}</td>
                                            <td >{{ $upese->funcionario?->ci }} {{ $upese->funcionario?->expedido }}</td>
                                            <td >{{ $upese->funcionario?->celular }}</td>
                                            @if(! $upese->cargo == '')
                                                <td >{{ $upese->cargo }}</td>
                                            @else
                                                <td >{{ 'EX FUNCIONARIO'}}</td>
                                            @endif	
                                            @if(! $upese->dependencia_id == '')
                                            <td >{{ $upese->Dependencia?->dependencias }}</td>
                                            @else
                                            <td >{{ 'SIN DEPENDENCIA'}}</td>
                                            @endif
                                            <td >{{ $upese->cod_gamea }}</td>	


                                            @if(auth()->check() && auth()->user()->hasAnyRole([
                                                'Administrador',
                                                'SuperAdministrador'
                                            ]))								
                                                <td class="{{ empty($upese->cod_registro) ? 'color1' : '' }}" >
                                                    @if($upese->cod_registro)
                                                    {{$upese->cod_registro }}
                                                    @elseif(! $upese->cod_registro)	
                                                    <button type="button" class="btn btn-sm btn-outline-light" data-toggle="modal" data-target="#eRecepcion{{ $upese->id }}">{{ __( 'REGISTRAR NUMERO DE RECEPCIÓN' ) }}</button>
                                                    @endif
                                                </td> 
                                                <td class="{{ empty($upese->user_id) ? 'color1' : '' }}">
                                                    @if($upese->cod_registro)
                                                        @if($upese->user_id)
                                                        {{ $upese->user->name}} {{ $upese->user->paterno}} {{ $upese->user->materno}}
                                                        @elseif(! $upese->user_id)
                                                        <button type="button" class="btn btn-sm btn-outline-light" data-toggle="modal" data-target="#eTecnico{{ $upese->id }}">{{ __('ASIGNAR TECNICO') }}</button>
                                                        @endif
                                                    @elseif(! $upese->cod_registro)	
                                                    <button type="button" class="btn btn-sm btn-outline-light" onclick="Swal.fire({ title: 'Error', text: 'DEBES REGISTRAR NUMERO DE RECEPCIÓN', icon: 'error', confirmButtonText: 'ACEPTAR' });">{{ __('ASIGNAR TECNICO') }}</button>
                                                    @endif
                                                </td>
                                                <td class="{{ empty($upese->fecha_asignacion) ? 'color1' : '' }}">
                                                    @if($upese->fecha_asignacion)
                                                    {{ date('d-m-Y H:i',strtotime($upese->fecha_asignacion ))}}<BR><BR>
                                                    @if(!($upese->estado_id == '5') && !($upese->estado_id == '4'))
                                                        @php
                                                        $dias = floor(\Carbon\Carbon::parse($upese->fecha_asignacion)->diffInDays(\Carbon\Carbon::now()));
                                                        @endphp
                                                        <button class="btn btn-sm btn-estado" data-dias="{{ $dias }}" title="Dias transcurridos desde la fecha de asignación">
                                                        {{ $dias }} DÍAS
                                                        </button>
                                                    @endif
                                                    @elseif(! $upese->fecha_asignacion)	
                                                    <button type="button" class="btn btn-sm btn-outline-light" onclick="Swal.fire({ title: 'Error', text: 'DEBES ASIGNAR UN TECNICO', icon: 'error', confirmButtonText: 'ACEPTAR' });">{{ __('FECHA DE ASIGNACIÓN') }}</button>
                                                    @endif							
                                                </td>	
                                                <td class="{{ empty($upese->fecha_inicio) ? 'color1' : '' }}">
                                                    @if($upese->fecha_inicio)
                                                    {{ date('d-m-Y H:i',strtotime($upese->fecha_inicio ))}}<BR><BR>
                                                    @if(!($upese->estado_id == '5') && !($upese->estado_id == '4'))
                                                        @php
                                                        $dias = floor(\Carbon\Carbon::parse($upese->fecha_inicio)->diffInDays(\Carbon\Carbon::now()));
                                                        @endphp
                                                        <button class="btn btn-sm btn-estado" data-dias="{{ $dias }}" title="Dias transcurridos desde la fecha de inico de la reparación">
                                                        {{ $dias }} DÍAS
                                                        </button>
                                                    @endif
                                                    @elseif(! $upese->fecha_inicio)	
                                                    <button type="button" class="btn btn-sm btn-outline-light" onclick="Swal.fire({ title: 'Error', text: 'EN ESPERA DEL INICIO DEL TRABAJO', icon: 'error', confirmButtonText: 'ACEPTAR' });">{{ __('EN ESPERA') }}</button>
                                                    @endif							
                                                </td>	
                                            @else 
                                            {{-- ----------------------------------------------------------------- --}}
                                                <td class="{{ empty($upese->cod_registro) ? 'color1' : '' }}" >
                                                    @if($upese->cod_registro)
                                                    {{ $upese->cod_registro}}
                                                    @elseif(! $upese->cod_registro)	
                                                    {{ $upese->cod_registro ?? 'SIN ASIGNAR'}}
                                                    @endif
                                                </td> 
                                                <td class="{{ empty($upese->user_id) ? 'color1' : '' }}" >
                                                    @if($upese->user_id)
                                                    {{ $upese->user->name}} {{ $upese->user->paterno}} {{ $upese->user->materno}}
                                                    @elseif(! $upese->user_id)	
                                                    {{ $upese->user->name ?? 'SIN ASIGNAR'}}
                                                    @endif
                                                </td>
                                                <td class="{{ empty($upese->fecha_asignacion) ? 'color1' : '' }}">
                                                    @if($upese->fecha_asignacion)
                                                    {{ date('d-m-Y',strtotime($upese->fecha_asignacion ))}}
                                                    @elseif(! $upese->fecha_asignacion)	
                                                    {{($upese->fecha_asignacion ?? 'SIN ASIGNAR' )}}
                                                    @endif								
                                                </td>
                                                <td class="{{ empty($upese->fecha_inicio) ? 'color1' : '' }}">
                                                    @if($upese->fecha_inicio)
                                                    {{ date('d-m-Y',strtotime($upese->fecha_inicio ))}}
                                                    @elseif(! $upese->fecha_inicio)	
                                                    {{($upese->fecha_inicio ?? 'EN ESPERA' )}}
                                                    @endif								
                                                </td>
                                            @endif										
                                            <td>
                                                @if(
                                                    (!empty($upese->cod_registro) &&
                                                    !empty($upese->user_id) &&
                                                    !empty($upese->fecha_asignacion))
                                                    ||
                                                    $upese->estado_id != '1'
                                                )

                                                    @if($upese->estado_id == '1')

                                                        <button
                                                            id="boton-actualizar-estado"
                                                            type="submit"
                                                            class="btn btn-primary btn-raised"

                                                            @if(auth()->check() && auth()->user()->hasAnyRole([
                                                                'Administrador',
                                                                'SuperAdministrador'
                                                            ]))
                                                                title="Actualizar estado"
                                                                data-id="{{ $upese->id }}"
                                                                onclick="cambiarEstado(
                                                                    {{ $upese->id }},
                                                                    {{ $upese->estado_id }},
                                                                    {{ $upese->resultado_id ? 'true' : 'false' }}
                                                                )"
                                                            @endif
                                                        >
                                                            RECEPCIONADO
                                                        </button>


                                                    @elseif($upese->estado_id == '2')

                                                        <button
                                                            id="boton-actualizar-estado"
                                                            class="btn btn-warning btn-raised"

                                                            @if(auth()->check() && auth()->user()->hasAnyRole([
                                                                'Administrador',
                                                                'SuperAdministrador'
                                                            ]))
                                                                title="Actualizar estado"
                                                                data-id="{{ $upese->id }}"
                                                                onclick="cambiarEstado(
                                                                    {{ $upese->id }},
                                                                    {{ $upese->estado_id }},
                                                                    {{ $upese->resultado_id ? 'true' : 'false' }}
                                                                )"
                                                            @endif
                                                        >
                                                            EN PROCESO
                                                        </button>


                                                    @elseif($upese->estado_id == '3')

                                                        <button
                                                            class="btn btn-danger btn-raised"

                                                            @if(auth()->check() && auth()->user()->hasAnyRole([
                                                                'Administrador',
                                                                'SuperAdministrador'
                                                            ]))
                                                                title="Actualizar estado"
                                                                data-id="{{ $upese->id }}"
                                                                onclick="cambiarEstado(
                                                                    {{ $upese->id }},
                                                                    {{ $upese->estado_id }},
                                                                    {{ $upese->resultado_id ? 'true' : 'false' }}
                                                                )"
                                                            @endif
                                                        >
                                                            APERSONARSE CON EL TECNICO
                                                            {{ $upese->resultado?->nombre }}
                                                        </button>


                                                    @elseif($upese->estado_id == '4')

                                                        <button
                                                            class="btn btn-success btn-raised"

                                                            @if(auth()->check() && auth()->user()->hasAnyRole([
                                                                'Administrador',
                                                                'SuperAdministrador'
                                                            ]))
                                                                title="Actualizar estado"
                                                                data-id="{{ $upese->id }}"
                                                                onclick="cambiarEstado(
                                                                    {{ $upese->id }},
                                                                    {{ $upese->estado_id }},
                                                                    {{ $upese->resultado_id ? 'true' : 'false' }}
                                                                )"
                                                            @endif
                                                        >
                                                            CONCLUIDO
                                                        </button>


                                                    @elseif($upese->estado_id == '5')

                                                        {{-- ---------------------------------------RESULTADO FINAL-------------------------------------------- --}}

                                                        @if($upese->resultado_id == '1')

                                                            <button class="boton300 badge-devolucion">
                                                                {{ $upese->resultado?->nombre }}<br>
                                                                {{ date('d-m-Y H:i:s', strtotime($upese->fecha_entrega)) }}
                                                            </button>

                                                        @elseif($upese->resultado_id == '2')

                                                            <button class="boton300 badge-reposicion">
                                                                {{ $upese->resultado?->nombre }}<br>
                                                                {{ date('d-m-Y H:i:s', strtotime($upese->fecha_entrega)) }}
                                                            </button>

                                                        @elseif($upese->resultado_id == '3')

                                                            <button class="boton300 badge-repliegue">
                                                                {{ $upese->resultado?->nombre }}<br>
                                                                {{ date('d-m-Y H:i:s', strtotime($upese->fecha_entrega)) }}
                                                            </button>

                                                        @elseif($upese->resultado_id == '4')

                                                            <button class="boton300 badge-custodio">
                                                                {{ $upese->resultado?->nombre }}<br>
                                                                {{ date('d-m-Y H:i:s', strtotime($upese->fecha_entrega)) }}
                                                            </button>

                                                        @elseif($upese->resultado_id == '5')

                                                            <button class="boton300 badge-baja">
                                                                {{ $upese->resultado?->nombre }}<br>
                                                                {{ date('d-m-Y H:i:s', strtotime($upese->fecha_entrega)) }}
                                                            </button>

                                                        @endif

                                                    @endif


                                                @else

                                                    @if(empty($upese->user_id))

                                                        <button
                                                            type="submit"
                                                            class="btn btn-primary btn-raised"
                                                            data-id="{{ $upese->id }}"

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


                                                    @elseif(empty($upese->fecha_asignacion))

                                                        <button
                                                            type="submit"
                                                            class="btn btn-primary btn-raised"
                                                            data-id="{{ $upese->id }}"

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
                                                <form id="form-cambiar-estado" method="POST" action="{{ route('estado-ups') }}">
                                                    @csrf
                                                    <input type="hidden" name="id" id="id-ups">
                                                    <input type="hidden" name="estado_id" id="estado-id">
                                                </form> 
                                            </td>
                                            <td>
                                                <div class="acciones">

                                            <!-- PDF -->
                                            <a href="#"
                                            class="btn-mini btn-danger btn-preview-pdf"
                                            data-ver="{{ route('pdf.ups.preview', ':id') }}"
                                            data-descargar="{{ route('pdf.ups.descargar', ':id') }}"
                                            data-enviar="{{ route('pdf.ups.enviar', ':id') }}"
                                            data-id="{{ $upese->id }}"
                                            title="Formulario PDF">
                                                <i class="far fa-file-pdf"></i>
                                            </a>

                                            <!-- VER -->
                                            <button type="button"
                                                    data-toggle="modal"
                                                    data-target="#ver{{ $upese->id }}"
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
                                                        data-target="#editar{{ $upese->id }}"
                                                        class="btn-mini btn-success"
                                                        title="Editar">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button"
                                                        data-toggle="modal"
                                                        data-target="#modalResultado{{ $upese->id }}"
                                                        class="btn-mini btn-success"
                                                        title="Detalle del trabajo realizado">
                                                    <i class="fa fa-file"></i>
                                                </button>
                                                <!-- DETALLE DEL TRABAJO REALIZADO -->
                                                <button type="button"
                                                        class="btn btn-sm btn-secondary"
                                                        data-toggle="modal"
                                                        data-target="#modalResultado{{ $upese->id }}"
                                                        title="Registrar detalle del trabajo realizado">
                                                    <i class="fas fa-file-alt"></i>
                                                </button>  

                                                <!-- ELIMINAR -->
                                                <form action="{{ route('upeses.destroy', $upese->id) }}"
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
                                        @include('upese.modalVer')
                                        <!--Ventana Modal eRecepcion --->
                                        @include('upese.modalRecepcion')
                                        <!--Ventana Modal eTecnico --->
                                        @include('upese.registroTecnico')
                                        <!--Ventana Modal para Actualizar--->
                                        @include('upese.modalEdit')
                                        @include('upese.modalResultado')
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr align="center">
                                        <th>No</th>
                                        
                                        <th >FECHA DE RECEPCIÓN</th>  
                                        <th >NOMBRE</th>
                                        <th >C.I.</th>
                                        <th >CELULAR</th>
                                        <th >CARGO</th>
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
                {!! $upeses->withQueryString()->links() !!}
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
            xhr.open('POST', '{{ route('estado-ups') }}', true);
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
<script src="{{ asset('js/ups.js') }}"></script>
<script src="{{ asset('js/fechas.js') }}"></script>
<link rel="stylesheet" href="{{ asset('estilos/fechas.css') }}"> 
<script src="{{ asset('js/equipoPdf.js') }}"></script>
<link rel="stylesheet" href="{{ asset('estilos/equipoPdf.css') }}">  
<script>
document.addEventListener('DOMContentLoaded', function () {

    const searchInputU = document.getElementById('search-inputU');
    const optionsU = document.getElementById('optionsU');
    const idSelectedU = document.getElementById('id-selectedU');

    if (!searchInputU || !optionsU || !idSelectedU) {
        return;
    }

    function validarDependenciaU() {

        const valor = searchInputU.value.trim();

        // Nunca conservar el ID de una selección anterior.
        idSelectedU.value = '';

        const opcion = Array.from(optionsU.options).find(option =>
            option.value.trim() === valor &&
            option.dataset.id &&
            /^[1-9]\d*$/.test(option.dataset.id)
        );

        if (valor !== '' && opcion) {
            idSelectedU.value = opcion.dataset.id;
            searchInputU.setCustomValidity('');
        } else if (valor === '') {
            searchInputU.setCustomValidity('');
        } else {
            searchInputU.setCustomValidity(
                'Seleccione una dependencia registrada en la lista.'
            );
        }
    }

    searchInputU.addEventListener('input', validarDependenciaU);
    searchInputU.addEventListener('change', validarDependenciaU);

    const formulario = searchInputU.closest('form');

    if (formulario) {
        formulario.addEventListener('submit', function (event) {

            validarDependenciaU();

            if (searchInputU.value.trim() !== '' && !idSelectedU.value) {
                event.preventDefault();
                searchInputU.reportValidity();
                searchInputU.focus();
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