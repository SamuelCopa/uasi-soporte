@extends('layouts.app')

@section('template_title')
    Registro Cpus
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-header--custom">
                </div>
                    <div class="header-panel">
                        <div class="header-left">
                            <h1 class="header-title">Registro de CPUs</h1>
                        </div>
                        <div class="header-actions">
                        <!-- Botón -->
                        <button class="btn btn-primary"
                                data-toggle="modal"
                                data-target="#crearc">
                            <i class="fa fa-plus me-1"></i> Nuevo
                        </button>
                        </div>
                    </div>
                    <!--Ventana Modal para Crear--->
                    @include('registro-cpu.modalCrear')
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
                                    @foreach ($registroCpus as $registroCpu)
                                        <tr>
                                            <td class="text-center">{{ ++$i }}</td>
                                            <td>
                                                @if($registroCpu->fecha)
                                                {{date('d-m-Y H:i',strtotime($registroCpu->fecha))}}<br>
                                                        @if(auth()->check() && auth()->user()->hasAnyRole([
                                                            'Administrador',
                                                            'SuperAdministrador'
                                                        ]))
                                                            @if(!($registroCpu->estado_id == '5'))
                                                                @php
                                                                $dias = floor(\Carbon\Carbon::parse($registroCpu->fecha)->diffInDays(\Carbon\Carbon::now()));
                                                                @endphp
                                                                <button 
                                                                class="btn btn-sm btn-estado"
                                                                data-dias="{{ $dias }}"
                                                                title="Días transcurridos desde la recepción">
                                                                {{ $dias }} DÍAS 
                                                                </button>
                                                            @endif
                                                        @endif
                                                @elseif(! $registroCpu->fecha)	
                                                {{ $registroCpu->fecha ?? ''}}
                                                @endif
                                          
                                            </td>
                                            <td >{{ $registroCpu->funcionario?->nombre}} {{ $registroCpu->funcionario?->paterno}} {{ $registroCpu->funcionario?->materno}}</td>
                                            <td >{{ $registroCpu->funcionario?->ci }} {{ $registroCpu->funcionario?->expedido }}</td>
                                            <td >{{ $registroCpu->funcionario?->celular }}</td>
                                            @if(! $registroCpu->cargo == '')
                                                <td >{{ $registroCpu->cargo }}</td>
                                            @else
                                                <td >{{ 'EX FUNCIONARIO'}}</td>
                                            @endif	
                                            @if(! $registroCpu->dependencia_id == '')
                                            <td >{{ $registroCpu->Dependencia?->dependencias }}</td>
                                            @else
                                            <td >{{ 'SIN DEPENDENCIA'}}</td>
                                            @endif
                                            <td >{{ $registroCpu->cod_gamea }}</td>	


                                            @if(auth()->check() && auth()->user()->hasAnyRole([
                                                'Administrador',
                                                'SuperAdministrador'
                                            ]))								
                                                <td class="{{ empty($registroCpu->cod_registro) ? 'color1' : '' }}" >
                                                    @if($registroCpu->cod_registro)
                                                    {{$registroCpu->cod_registro }}
                                                    @elseif(! $registroCpu->cod_registro)	
                                                    <button type="button" class="btn btn-sm btn-outline-light" data-toggle="modal" data-target="#eRecepcion{{ $registroCpu->id }}">{{ __( 'REGISTRAR NUMERO DE RECEPCIÓN' ) }}</button>
                                                    @endif
                                                </td> 
                                                <td class="{{ empty($registroCpu->user_id) ? 'color1' : '' }}">
                                                    @if($registroCpu->cod_registro)
                                                        @if($registroCpu->user_id)
                                                        {{ $registroCpu->user->name}} {{ $registroCpu->user->paterno}} {{ $registroCpu->user->materno}}
                                                        @elseif(! $registroCpu->user_id)
                                                        <button type="button" class="btn btn-sm btn-outline-light" data-toggle="modal" data-target="#eTecnico{{ $registroCpu->id }}">{{ __('ASIGNAR TECNICO') }}</button>
                                                        @endif
                                                    @elseif(! $registroCpu->cod_registro)	
                                                    <button type="button" class="btn btn-sm btn-outline-light" onclick="Swal.fire({ title: 'Error', text: 'DEBES REGISTRAR NUMERO DE RECEPCIÓN', icon: 'error', confirmButtonText: 'ACEPTAR' });">{{ __('ASIGNAR TECNICO') }}</button>
                                                    @endif
                                                </td>
                                                <td class="{{ empty($registroCpu->fecha_asignacion) ? 'color1' : '' }}">
                                                    @if($registroCpu->fecha_asignacion)
                                                    {{ date('d-m-Y H:i',strtotime($registroCpu->fecha_asignacion ))}}<BR>
                                                    @if(!($registroCpu->estado_id == '5') && !($registroCpu->estado_id == '4'))
                                                        @php
                                                        $dias = floor(\Carbon\Carbon::parse($registroCpu->fecha_asignacion)->diffInDays(\Carbon\Carbon::now()));
                                                        @endphp
                                                        <button class="btn btn-sm btn-estado" data-dias="{{ $dias }}" title="Dias transcurridos desde la fecha de asignación">
                                                        {{ $dias }} DÍAS 
                                                        </button>
                                                    @endif
                                                    @elseif(! $registroCpu->fecha_asignacion)	
                                                    <button type="button" class="btn btn-sm btn-outline-light" onclick="Swal.fire({ title: 'Error', text: 'DEBES ASIGNAR UN TECNICO', icon: 'error', confirmButtonText: 'ACEPTAR' });">{{ __('FECHA DE ASIGNACIÓN') }}</button>
                                                    @endif							
                                                </td>	
                                                <td class="{{ empty($registroCpu->fecha_inicio) ? 'color1' : '' }}">
                                                    @if($registroCpu->fecha_inicio)
                                                    {{ date('d-m-Y H:i',strtotime($registroCpu->fecha_inicio ))}}<BR>
                                                    @if(!($registroCpu->estado_id == '5') && !($registroCpu->estado_id == '4'))
                                                        @php
                                                        $dias = floor(\Carbon\Carbon::parse($registroCpu->fecha_inicio)->diffInDays(\Carbon\Carbon::now()));
                                                        @endphp
                                                        <button class="btn btn-sm btn-estado" data-dias="{{ $dias }}" title="Dias transcurridos desde la fecha de inico de la reparación">
                                                        {{ $dias }} DÍAS 
                                                        </button>
                                                    @endif
                                                    @elseif(! $registroCpu->fecha_inicio)	
                                                    <button type="button" class="btn btn-sm btn-outline-light" onclick="Swal.fire({ title: 'Error', text: 'EN ESPERA DEL INICIO DEL TRABAJO', icon: 'error', confirmButtonText: 'ACEPTAR' });">{{ __('EN ESPERA') }}</button>
                                                    @endif							
                                                </td>	
                                            @else 
                                        {{-- ----------------------user---------------------------------- --}}
                                            <td class="{{ empty($registroCpu->cod_registro) ? 'color1' : '' }}">
                                                @if($registroCpu->cod_registro)
                                                {{ $registroCpu->cod_registro}}
                                                @elseif(! $registroCpu->cod_registro)	
                                                {{ $registroCpu->cod_registro ?? 'SIN ASIGNAR'}}
                                                @endif
                                            </td>
                                            <td class="{{ empty($registroCpu->user_id) ? 'color1' : '' }}" >
                                                    @if($registroCpu->user_id)
                                                    {{ $registroCpu->user->name}} {{ $registroCpu->user->paterno}} {{ $registroCpu->user->materno}}
                                                    @elseif(! $registroCpu->user_id )	
                                                    {{ $registroCpu->user->name ?? 'SIN ASIGNAR'}}
                                                    @endif
                                            </td>
                                            <td class="{{ empty($registroCpu->fecha_asignacion) ? 'color1' : '' }}"  align="center">
                                                @if($registroCpu->fecha_asignacion)
                                                {{ date('d-m-Y H:i',strtotime($registroCpu->fecha_asignacion ))}}<br>
                                                @elseif(! $registroCpu->fecha_asignacion)	
                                                {{($registroCpu->fecha_asignacion ?? 'SIN ASIGNAR' )}}
                                                @endif	
                                            </td>
                                            <td class="{{ empty($registroCpu->fecha_inicio) ? 'color1' : '' }}"  align="center">
                                                @if($registroCpu->fecha_inicio)
                                                {{ date('d-m-Y H:i',strtotime($registroCpu->fecha_inicio ))}}<br>
                                                @elseif(! $registroCpu->fecha_inicio)	
                                                {{($registroCpu->fecha_inicio ?? 'EN ESPERA' )}}
                                                @endif	
                                            </td>
                                        @endif
										<td >
                                                @if(
                                                    (!empty($registroCpu->cod_registro) &&
                                                    !empty($registroCpu->user_id) &&
                                                    !empty($registroCpu->fecha_asignacion))
                                                    ||
                                                    $registroCpu->estado_id != '1'
                                                )

                                                    @if($registroCpu->estado_id == '1')

                                                        <button
                                                            id="boton-actualizar-estado"
                                                            type="submit"
                                                            class="btn btn-primary btn-raised"

                                                            @if(auth()->check() && auth()->user()->hasAnyRole([
                                                                'Administrador',
                                                                'SuperAdministrador'
                                                            ]))
                                                                title="Actualizar estado"
                                                                data-id="{{ $registroCpu->id }}"
                                                                onclick="cambiarEstado(
                                                                    {{ $registroCpu->id }},
                                                                    {{ $registroCpu->estado_id }},
                                                                    {{ $registroCpu->resultado_id ? 'true' : 'false' }}
                                                                )"
                                                            @endif
                                                        >
                                                            RECEPCIONADO
                                                        </button>


                                                    @elseif($registroCpu->estado_id == '2')

                                                        <button
                                                            id="boton-actualizar-estado"
                                                            class="btn btn-warning btn-raised"

                                                            @if(auth()->check() && auth()->user()->hasAnyRole([
                                                                'Administrador',
                                                                'SuperAdministrador'
                                                            ]))
                                                                title="Actualizar estado"
                                                                data-id="{{ $registroCpu->id }}"
                                                                onclick="cambiarEstado(
                                                                    {{ $registroCpu->id }},
                                                                    {{ $registroCpu->estado_id }},
                                                                    {{ $registroCpu->resultado_id ? 'true' : 'false' }}
                                                                )"
                                                            @endif
                                                        >
                                                            EN PROCESO
                                                        </button>


                                                    @elseif($registroCpu->estado_id == '3')

                                                        <button
                                                            class="btn btn-danger btn-raised"

                                                            @if(auth()->check() && auth()->user()->hasAnyRole([
                                                                'Administrador',
                                                                'SuperAdministrador'
                                                            ]))
                                                                title="Actualizar estado"
                                                                data-id="{{ $registroCpu->id }}"
                                                                onclick="cambiarEstado(
                                                                    {{ $registroCpu->id }},
                                                                    {{ $registroCpu->estado_id }},
                                                                    {{ $registroCpu->resultado_id ? 'true' : 'false' }}
                                                                )"
                                                            @endif
                                                        >
                                                            APERSONARSE CON EL TECNICO
                                                            {{ $registroCpu->resultado?->nombre }}
                                                        </button>


                                                    @elseif($registroCpu->estado_id == '4')

                                                        <button
                                                            class="btn btn-success btn-raised"

                                                            @if(auth()->check() && auth()->user()->hasAnyRole([
                                                                'Administrador',
                                                                'SuperAdministrador'
                                                            ]))
                                                                title="Actualizar estado"
                                                                data-id="{{ $registroCpu->id }}"
                                                                onclick="cambiarEstado(
                                                                    {{ $registroCpu->id }},
                                                                    {{ $registroCpu->estado_id }},
                                                                    {{ $registroCpu->resultado_id ? 'true' : 'false' }}
                                                                )"
                                                            @endif
                                                        >
                                                            CONCLUIDO
                                                        </button>


                                                    @elseif($registroCpu->estado_id == '5')

                                                        {{-- ---------------------------------------RESULTADO FINAL-------------------------------------------- --}}

                                                        @if($registroCpu->resultado_id == '1')

                                                            <button class="boton300 badge-devolucion">
                                                                {{ $registroCpu->resultado?->nombre }}<br>
                                                                {{ date('d-m-Y H:i:s', strtotime($registroCpu->fecha_entrega)) }}
                                                            </button>

                                                        @elseif($registroCpu->resultado_id == '2')

                                                            <button class="boton300 badge-reposicion">
                                                                {{ $registroCpu->resultado?->nombre }}<br>
                                                                {{ date('d-m-Y H:i:s', strtotime($registroCpu->fecha_entrega)) }}
                                                            </button>

                                                        @elseif($registroCpu->resultado_id == '3')

                                                            <button class="boton300 badge-repliegue">
                                                                {{ $registroCpu->resultado?->nombre }}<br>
                                                                {{ date('d-m-Y H:i:s', strtotime($registroCpu->fecha_entrega)) }}
                                                            </button>

                                                        @elseif($registroCpu->resultado_id == '4')

                                                            <button class="boton300 badge-custodio">
                                                                {{ $registroCpu->resultado?->nombre }}<br>
                                                                {{ date('d-m-Y H:i:s', strtotime($registroCpu->fecha_entrega)) }}
                                                            </button>

                                                        @elseif($registroCpu->resultado_id == '5')

                                                            <button class="boton300 badge-baja">
                                                                {{ $registroCpu->resultado?->nombre }}<br>
                                                                {{ date('d-m-Y H:i:s', strtotime($registroCpu->fecha_entrega)) }}
                                                            </button>

                                                        @endif

                                                    @endif


                                                @else

                                                    @if(empty($registroCpu->user_id))

                                                        <button
                                                            type="submit"
                                                            class="btn btn-primary btn-raised"
                                                            data-id="{{ $registroCpu->id }}"

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

                                                    @elseif(empty($registroCpu->fecha_asignacion))

                                                        <button
                                                            type="submit"
                                                            class="btn btn-primary btn-raised"
                                                            data-id="{{ $registroCpu->id }}"

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
                                            <form id="form-cambiar-estado" method="POST" action="{{ route('estado-cpu') }}">
                                                @csrf
                                                <input type="hidden" name="id" id="id-cpu">
                                                <input type="hidden" name="estado_id" id="estado-id">
                                            </form>
                                        </td>
                                        <td>
                                           <div class="acciones">

                                            <!-- PDF -->
                                            <a href="#"
                                            class="btn-mini btn-danger btn-preview-pdf tooltip-salto"
                                            data-ver="{{ route('pdf.cpu.preview', ':id') }}"
                                            data-descargar="{{ route('pdf.cpu.descargar', ':id') }}"
                                            data-enviar="{{ route('pdf.cpu.enviar', ':id') }}"
                                            data-id="{{ $registroCpu->id }}"
                                            title="Formulario PDF">
                                                <i class="far fa-file-pdf"></i>
                                            </a>

                                            <!-- VER -->
                                            <button type="button"
                                                    data-toggle="modal"
                                                    data-target="#ver{{ $registroCpu->id }}"
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
                                                        data-target="#editar{{ $registroCpu->id }}"
                                                        class="btn-mini btn-success"
                                                        title="Editar">
                                                    <i class="fa fa-edit"></i>
                                                </button>

                                                <!-- INFORME -->
                                                <a href="{{ route('informe.cpu', $registroCpu->id) }}"
                                                class="btn-mini btn-secondary"
                                                title="Informe">
                                                    <i class="fa fa-file"></i>
                                                </a>

                                                <!-- ELIMINAR -->
                                                <form action="{{ route('registro-cpus.destroy', $registroCpu->id) }}"
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
                                        @include('registro-cpu.modalVer')
                                        <!--Ventana Modal eRecepcion --->
                                        @include('registro-cpu.modalRecepcion')
                                        <!--Ventana Modal eTecnico --->
                                        @include('registro-cpu.registroTecnico')
                                        <!--Ventana Modal para Actualizar--->
                                        @include('registro-cpu.modalEdit')
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                    <th>#</th>
									<th >FECHA DE RECEPCIÓN</th>									
									<th >NOMBRE</th>
									<th >C.I.</th>
									<th >CELULAR</th>	
									<th >CARGO</th>
                                    <th >DEPENDENCIA</th>								
									<th >COD. GAMEA</th>
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
                {!! $registroCpus->withQueryString()->links() !!}
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
@push('js')
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
            xhr.open('POST', '{{ route('estado-cpu') }}', true);
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
@endpush
@push('js')
<script>
    document.querySelectorAll('#menu_principal > li > label').forEach(label => {
    label.addEventListener('click', function () {
        const submenu = this.nextElementSibling.nextElementSibling;

        // cerrar otros (opcional)
        document.querySelectorAll('#menu_principal .ul, #menu_principal1 .ul').forEach(ul => {
            if (ul !== submenu) ul.style.display = 'none';
        });

        // toggle
        submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
    });
});
</script>
<script>
    document.querySelectorAll('#menu_principal1 > li > label').forEach(label => {
    label.addEventListener('click', function () {
        const submenu = this.nextElementSibling.nextElementSibling;

        // cerrar otros (opcional)
        document.querySelectorAll('#menu_principal .ul, #menu_principal1 .ul').forEach(ul => {
            if (ul !== submenu) ul.style.display = 'none';
        });

        // toggle
        submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
    });
}); 
</script>
<script src="{{ asset('js/funcion.js') }}"></script>
<script src="{{ asset('js/mov.js') }}"></script>
<script src="{{ asset('js/buscar.js') }}"></script>
<script src="{{ asset('js/registroCpu.js') }}"></script>
<script src="{{ asset('js/cpu.js') }}"></script>
<script src="{{ asset('js/fechas.js') }}"></script>
<link rel="stylesheet" href="{{ asset('estilos/fechas.css') }}">  
<script src="{{ asset('js/equipoPdf.js') }}"></script>
<link rel="stylesheet" href="{{ asset('estilos/equipoPdf.css') }}"> 
@endpush
@push('css')
<link rel="stylesheet" href="{{ asset('estilos/registroCpu.css') }}">  
@endpush