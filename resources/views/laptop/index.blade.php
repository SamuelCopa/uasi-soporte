@extends('layouts.app')

@section('template_title')
    Laptops
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card-header--custom">
             </div>
                <div class="header-panel">
                    <div class="header-left">
                        <h1 class="header-title">Registro de Laptops</h1>
                    </div>
                    <div class="header-actions">
                    <!-- Botón -->
                    <button class="btn btn-primary"
                            data-toggle="modal"
                            data-target="#crearl">
                        <i class="fa fa-plus me-1"></i> Nuevo
                    </button>
                    </div>
                </div>
                    <!--Ventana Modal para Crear--->
                    @include('laptop.modalCrear')
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
                                     @foreach ($laptops as $laptop)
                                        <tr>
                                            <td class="text-center">{{ ++$i }}</td>
                                            <td>
                                                @if($laptop->fecha)
                                                {{date('d-m-Y H:i',strtotime($laptop->fecha))}}<br><br>
                                                        @if(auth()->check() && auth()->user()->hasAnyRole([
                                                            'Administrador',
                                                            'SuperAdministrador'
                                                        ]))
                                                            @if(!($laptop->estado_id == '5'))
                                                                @php
                                                                $dias = floor(\Carbon\Carbon::parse($laptop->fecha)->diffInDays(\Carbon\Carbon::now()));
                                                                @endphp
                                                                <button 
                                                                class="btn btn-sm btn-estado"
                                                                data-dias="{{ $dias }}"
                                                                title="Días transcurridos desde la recepción">
                                                                {{ $dias }} DÍAS 
                                                                </button>
                                                            @endif
                                                        @endif
                                                @elseif(! $laptop->fecha)	
                                                {{ $laptop->fecha ?? ''}}
                                                @endif
                                          
                                            </td>
                                            <td >{{ $laptop->funcionario?->nombre}} {{ $laptop->funcionario?->paterno}} {{ $laptop->funcionario?->materno}}</td>
                                            <td >{{ $laptop->funcionario?->ci }} {{ $laptop->funcionario?->expedido }}</td>
                                            <td >{{ $laptop->funcionario?->celular }}</td>
                                            @if(! $laptop->cargo == '')
                                                <td >{{ $laptop->cargo }}</td>
                                            @else
                                                <td >{{ 'EX FUNCIONARIO'}}</td>
                                            @endif	
                                            @if(! $laptop->dependencia_id == '')
                                            <td >{{ $laptop->Dependencia?->dependencias }}</td>
                                            @else
                                            <td >{{ 'SIN DEPENDENCIA'}}</td>
                                            @endif
                                            <td >{{ $laptop->cod_gamea }}</td>	


                                            @if(auth()->check() && auth()->user()->hasAnyRole([
                                                'Administrador',
                                                'SuperAdministrador'
                                            ]))								
                                                <td class="{{ empty($laptop->cod_registro) ? 'color1' : '' }}" >
                                                    @if($laptop->cod_registro)
                                                    {{$laptop->cod_registro }}
                                                    @elseif(! $laptop->cod_registro)	
                                                    <button type="button" class="btn btn-sm btn-outline-light" data-toggle="modal" data-target="#eRecepcion{{ $laptop->id }}">{{ __( 'REGISTRAR NUMERO DE RECEPCIÓN' ) }}</button>
                                                    @endif
                                                </td> 
                                                <td class="{{ empty($laptop->user_id) ? 'color1' : '' }}">
                                                    @if($laptop->cod_registro)
                                                        @if($laptop->user_id)
                                                        {{ $laptop->user->name}} {{ $laptop->user->paterno}} {{ $laptop->user->materno}}
                                                        @elseif(! $laptop->user_id)
                                                        <button type="button" class="btn btn-sm btn-outline-light" data-toggle="modal" data-target="#eTecnico{{ $laptop->id }}">{{ __('ASIGNAR TECNICO') }}</button>
                                                        @endif
                                                    @elseif(! $laptop->cod_registro)	
                                                    <button type="button" class="btn btn-sm btn-outline-light" onclick="Swal.fire({ title: 'Error', text: 'DEBES REGISTRAR NUMERO DE RECEPCIÓN', icon: 'error', confirmButtonText: 'ACEPTAR' });">{{ __('ASIGNAR TECNICO') }}</button>
                                                    @endif
                                                </td>
                                                <td class="{{ empty($laptop->fecha_asignacion) ? 'color1' : '' }}">
                                                    @if($laptop->fecha_asignacion)
                                                    {{ date('d-m-Y H:i',strtotime($laptop->fecha_asignacion ))}}<BR><BR>
                                                    @if(!($laptop->estado_id == '5') && !($laptop->estado_id == '4'))
                                                        @php
                                                        $dias = floor(\Carbon\Carbon::parse($laptop->fecha_asignacion)->diffInDays(\Carbon\Carbon::now()));
                                                        @endphp
                                                        <button class="btn btn-sm btn-estado" data-dias="{{ $dias }}" title="Dias transcurridos desde la fecha de asignación">
                                                        {{ $dias }} DÍAS
                                                        </button>
                                                    @endif
                                                    @elseif(! $laptop->fecha_asignacion)	
                                                    <button type="button" class="btn btn-sm btn-outline-light" onclick="Swal.fire({ title: 'Error', text: 'DEBES ASIGNAR UN TECNICO', icon: 'error', confirmButtonText: 'ACEPTAR' });">{{ __('FECHA DE ASIGNACIÓN') }}</button>
                                                    @endif							
                                                </td>	
                                                <td class="{{ empty($laptop->fecha_inicio) ? 'color1' : '' }}">
                                                    @if($laptop->fecha_inicio)
                                                    {{ date('d-m-Y H:i',strtotime($laptop->fecha_inicio ))}}<BR><BR>
                                                    @if(!($laptop->estado_id == '5') && !($laptop->estado_id == '4'))
                                                        @php
                                                        $dias = floor(\Carbon\Carbon::parse($laptop->fecha_inicio)->diffInDays(\Carbon\Carbon::now()));
                                                        @endphp
                                                        <button class="btn btn-sm btn-estado" data-dias="{{ $dias }}" title="Dias transcurridos desde la fecha de inico de la reparación">
                                                        {{ $dias }} DÍAS
                                                        </button>
                                                    @endif
                                                    @elseif(! $laptop->fecha_inicio)	
                                                    <button type="button" class="btn btn-sm btn-outline-light" onclick="Swal.fire({ title: 'Error', text: 'EN ESPERA DEL INICIO DEL TRABAJO', icon: 'error', confirmButtonText: 'ACEPTAR' });">{{ __('EN ESPERA') }}</button>
                                                    @endif							
                                                </td>	
                                            @else 
                                        {{-- ----------------------user---------------------------------- --}}
                                            <td class="{{ empty($laptop->cod_registro) ? 'color1' : '' }}">
                                                @if($laptop->cod_registro)
                                                {{ $laptop->cod_registro}}
                                                @elseif(! $laptop->cod_registro)	
                                                {{ $laptop->cod_registro ?? 'SIN ASIGNAR'}}
                                                @endif
                                            </td>
                                            <td class="{{ empty($laptop->user_id) ? 'color1' : '' }}" >
                                                    @if($laptop->user_id)
                                                    {{ $laptop->user->name}} {{ $laptop->user->paterno}} {{ $laptop->user->materno}}
                                                    @elseif(! $laptop->user_id )	
                                                    {{ $laptop->user->name ?? 'SIN ASIGNAR'}}
                                                @endif
                                            </td>
                                            <td class="{{ empty($laptop->fecha_asignacion) ? 'color1' : '' }}"  align="center">
                                                @if($laptop->fecha_asignacion)
                                                {{ date('d-m-Y',strtotime($laptop->fecha_asignacion ))}}<br><br>
                                                @elseif(! $laptop->fecha_asignacion)	
                                                {{($laptop->fecha_asignacion ?? 'SIN ASIGNAR' )}}
                                                @endif	
                                            </td>
                                            <td class="{{ empty($laptop->fecha_inicio) ? 'color1' : '' }}"  align="center">
                                                @if($laptop->fecha_inicio)
                                                {{ date('d-m-Y',strtotime($laptop->fecha_inicio ))}}<br><br>
                                                @elseif(! $laptop->fecha_inicio)	
                                                {{($laptop->fecha_inicio ?? 'EN ESPERA' )}} 
                                                @endif	
                                            </td>
                                        @endif

                                        <td>
                                                @if(
                                                    (!empty($laptop->cod_registro) &&
                                                    !empty($laptop->user_id) &&
                                                    !empty($laptop->fecha_asignacion))
                                                    ||
                                                    $laptop->estado_id != '1'
                                                )

                                                    @if($laptop->estado_id == '1')

                                                        <button
                                                            id="boton-actualizar-estado"
                                                            type="submit"
                                                            class="btn btn-primary btn-raised"

                                                            @if(auth()->check() && auth()->user()->hasAnyRole([
                                                                'Administrador',
                                                                'SuperAdministrador'
                                                            ]))
                                                                title="Actualizar estado"
                                                                data-id="{{ $laptop->id }}"
                                                                onclick="cambiarEstado(
                                                                    {{ $laptop->id }},
                                                                    {{ $laptop->estado_id }},
                                                                    {{ $laptop->resultado_id ? 'true' : 'false' }}
                                                                )"
                                                            @endif
                                                        >
                                                            RECEPCIONADO
                                                        </button>


                                                    @elseif($laptop->estado_id == '2')

                                                        <button
                                                            id="boton-actualizar-estado"
                                                            class="btn btn-warning btn-raised"

                                                            @if(auth()->check() && auth()->user()->hasAnyRole([
                                                                'Administrador',
                                                                'SuperAdministrador'
                                                            ]))
                                                                title="Actualizar estado"
                                                                data-id="{{ $laptop->id }}"
                                                                onclick="cambiarEstado(
                                                                    {{ $laptop->id }},
                                                                    {{ $laptop->estado_id }},
                                                                    {{ $laptop->resultado_id ? 'true' : 'false' }}
                                                                )"
                                                            @endif
                                                        >
                                                            EN PROCESO
                                                        </button>


                                                    @elseif($laptop->estado_id == '3')

                                                        <button
                                                            class="btn btn-danger btn-raised"

                                                            @if(auth()->check() && auth()->user()->hasAnyRole([
                                                                'Administrador',
                                                                'SuperAdministrador'
                                                            ]))
                                                                title="Actualizar estado"
                                                                data-id="{{ $laptop->id }}"
                                                                onclick="cambiarEstado(
                                                                    {{ $laptop->id }},
                                                                    {{ $laptop->estado_id }},
                                                                    {{ $laptop->resultado_id ? 'true' : 'false' }}
                                                                )"
                                                            @endif
                                                        >
                                                            APERSONARSE CON EL TECNICO
                                                            {{ $laptop->resultado?->nombre }}
                                                        </button>


                                                    @elseif($laptop->estado_id == '4')

                                                        <button
                                                            class="btn btn-success btn-raised"

                                                            @if(auth()->check() && auth()->user()->hasAnyRole([
                                                                'Administrador',
                                                                'SuperAdministrador'
                                                            ]))
                                                                title="Actualizar estado"
                                                                data-id="{{ $laptop->id }}"
                                                                onclick="cambiarEstado(
                                                                    {{ $laptop->id }},
                                                                    {{ $laptop->estado_id }},
                                                                    {{ $laptop->resultado_id ? 'true' : 'false' }}
                                                                )"
                                                            @endif
                                                        >
                                                            CONCLUIDO
                                                        </button>


                                                    @elseif($laptop->estado_id == '5')

                                                        {{-- ---------------------------------------RESULTADO FINAL-------------------------------------------- --}}

                                                        @if($laptop->resultado_id == '1')

                                                            <button class="boton300 badge-devolucion">
                                                                {{ $laptop->resultado?->nombre }}<br>
                                                                {{ date('d-m-Y H:i:s', strtotime($laptop->fecha_entrega)) }}
                                                            </button>

                                                        @elseif($laptop->resultado_id == '2')

                                                            <button class="boton300 badge-reposicion">
                                                                {{ $laptop->resultado?->nombre }}<br>
                                                                {{ date('d-m-Y H:i:s', strtotime($laptop->fecha_entrega)) }}
                                                            </button>

                                                        @elseif($laptop->resultado_id == '3')

                                                            <button class="boton300 badge-repliegue">
                                                                {{ $laptop->resultado?->nombre }}<br>
                                                                {{ date('d-m-Y H:i:s', strtotime($laptop->fecha_entrega)) }}
                                                            </button>

                                                        @elseif($laptop->resultado_id == '4')

                                                            <button class="boton300 badge-custodio">
                                                                {{ $laptop->resultado?->nombre }}<br>
                                                                {{ date('d-m-Y H:i:s', strtotime($laptop->fecha_entrega)) }}
                                                            </button>

                                                        @elseif($laptop->resultado_id == '5')

                                                            <button class="boton300 badge-baja">
                                                                {{ $laptop->resultado?->nombre }}<br>
                                                                {{ date('d-m-Y H:i:s', strtotime($laptop->fecha_entrega)) }}
                                                            </button>

                                                        @endif

                                                    @endif


                                                @else

                                                    @if(empty($laptop->user_id))

                                                        <button
                                                            type="submit"
                                                            class="btn btn-primary btn-raised"
                                                            data-id="{{ $laptop->id }}"

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


                                                    @elseif(empty($laptop->fecha_asignacion))

                                                        <button
                                                            type="submit"
                                                            class="btn btn-primary btn-raised"
                                                            data-id="{{ $laptop->id }}"

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
                                        <form id="form-cambiar-estado" method="POST" action="{{ route('estado-laptop') }}">
                                            @csrf
                                            <input type="hidden" name="id" id="id-laptop">
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
                                                        data-ver="{{ route('pdf.laptop.preview', ':id') }}"
                                                        data-descargar="{{ route('pdf.laptop.descargar', ':id') }}"
                                                        data-enviar="{{ route('pdf.laptop.enviar', ':id') }}"
                                                        data-id="{{ $laptop->id }}">
                                                        <i class="far fa-file-pdf"></i> FORMULARIO
                                                        </a>
                                                    <!-- VER -->
                                                    <button type="button" data-toggle="modal" data-target="#ver{{ $laptop->id }}"
                                                            class="dropdown-card card-primary">
                                                        <i class="fa fa-eye"></i> VER
                                                    </button>
                                                        @if(auth()->check() && auth()->user()->hasAnyRole([
                                                            'Administrador',
                                                            'SuperAdministrador'
                                                        ]))
                                                    <!-- EDITAR -->
                                                    <button type="button" data-toggle="modal" data-target="#editar{{ $laptop->id }}"
                                                            class="dropdown-card card-success">
                                                        <i class="fa fa-edit"></i> EDITAR
                                                    </button>
                                                    <!-- INFORME -->
                                                    <a href="{{ route('informe.laptop', $laptop->id) }}"
                                                    class="dropdown-card card-secondary">
                                                        <i class="fa fa-file"></i> INFORME
                                                    </a>
                                                    <!-- ELIMINAR -->
                                                    <form action="{{ route('laptops.destroy', $laptop->id) }}" method="POST" class="formEliminar">
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
                                    @include('laptop.modalVer')
                                    <!--Ventana Modal eRecepcion --->
                                    @include('laptop.modalRecepcion')
                                    <!--Ventana Modal eTecnico --->
                                    @include('laptop.registroTecnico')
                                    <!--Ventana Modal para Actualizar--->
                                    @include('laptop.modalEdit')
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
                {!! $laptops->withQueryString()->links() !!}
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
            xhr.open('POST', '{{ route('estado-laptop') }}', true);
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
<script src="{{ asset('js/laptop.js') }}"></script>
<script src="{{ asset('js/fechas.js') }}"></script>
<link rel="stylesheet" href="{{ asset('estilos/fechas.css') }}">  
<script src="{{ asset('js/equipoPdf.js') }}"></script>
<link rel="stylesheet" href="{{ asset('estilos/equipoPdf.css') }}"> 
<script>
const searchInputL = document.getElementById('search-inputL');
const optionsL = document.getElementById('optionsL').options;
const idSelectedInputL = document.getElementById('id-selectedL');

searchInputL.addEventListener('input', () => {
    const selectedOption = Array.from(optionsL).find(option => option.value === searchInputL.value);
    if (selectedOption) {
        idSelectedInputL.value = selectedOption.dataset.id;
    }
});
</script>
@endpush