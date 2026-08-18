@extends('layouts.app')

@section('template_title')
    Audifonos
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-header card-header--custom">
                </div>
                    <div class="header-panel">
                        <div class="header-left">
                            <h1 class="header-title">Registro de Audífonos</h1>
                        </div>
                        <div class="header-actions">
                        <!-- Botón -->
                        <button class="btn btn-primary"
                                data-toggle="modal"
                                data-target="#creara">
                            <i class="fa fa-plus me-1"></i> Nuevo
                        </button>
                        </div>
                    </div>
                    <!--Ventana Modal para Crear--->
                    @include('audifono.modalCrear')
                    <div class="card shadow-sm border-0 rounded-4">
                        <div class="table-responsive">
                            <table id="mitabla" class="table table-modern align-middle">

                                <thead>
                                    <!-- Encabezado agrupado -->
                                    <tr class="table-group-header text-center">
                                        <th colspan="8" class="color2">DATOS DEL SOLICITANTE</th>
                                        <th colspan="3" class="color3">ASIGNACIÓN</th>
                                        <th colspan="3" class="color2">CONTROL</th>
                                    </tr>

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
                                    @foreach ($audifonos as $audifono)
                                        <tr>
                                            <td class="text-center">{{ ++$i }}</td>
                                            <td>
                                                @if($audifono->fecha)
                                                {{date('d-m-Y H:i',strtotime($audifono->fecha))}}<br><br>
                                                    @role('Administrador')
                                                    @if(!($audifono->estado_id == '5'))
                                                        @php
                                                        $dias = floor(\Carbon\Carbon::parse($audifono->fecha)->diffInDays(\Carbon\Carbon::now()));
                                                        @endphp
                                                        <button 
                                                        class="btn btn-sm btn-estado"
                                                        data-dias="{{ $dias }}"
                                                        title="Días transcurridos desde la recepción">
                                                        {{ $dias }} DÍAS TRANSCURRIDOS
                                                        </button>
                                                    @endif
                                                    @endrole
                                                @elseif(! $audifono->fecha)	
                                                {{ $audifono->fecha ?? ''}}
                                                @endif
                                                @role('Administrador')
                                                @if(floor(\Carbon\Carbon::parse($audifono->fecha)->diffInDays(\Carbon\Carbon::now())) <= 30 )
                                                    @if(!$audifono->boton_oculto && $audifono->estado_id != '5')
                                                        <div class="div title">
                                                            <form class="actualizarFecha" method="POST" action="{{ route('audifono.fecha',['id'=>$audifono->id]) }}" role="form" enctype="multipart/form-data">
                                                                {{ method_field('PATCH') }}
                                                                @csrf
                                                                <input type="hidden" name="fecha" class="form-control @error('fecha') is-invalid @enderror" value="{{ old('fecha', date('Y-m-d\TH:i:s'))}}" id="fecha">
                                                                <button type="submit" class="btn btn-primary btn-sm" title="Este botón registra la fecha actual">ACTUALIZAR FECHA</button>
                                                            </form>
                                                        </div>
                                                    @endif
                                                @endif
                                                @endrole	                                           
                                            </td>
                                            <td >{{ $audifono->funcionario?->nombre}} {{ $audifono->funcionario?->paterno}} {{ $audifono->funcionario?->materno}}</td>
                                            <td >{{ $audifono->funcionario?->ci }} {{ $audifono->funcionario?->expedido }}</td>
                                            <td >{{ $audifono->funcionario?->celular }}</td>
                                            @if(! $audifono->cargo == '')
                                                <td >{{ $audifono->cargo }}</td>
                                            @else
                                                <td >{{ 'EX FUNCIONARIO'}}</td>
                                            @endif	
                                            @if(! $audifono->dependencia_id == '')
                                            <td >{{ $audifono->Dependencia?->dependencias }}</td>
                                            @else
                                            <td >{{ 'SIN DEPENDENCIA'}}</td>
                                            @endif
                                            <td >{{ $audifono->cod_gamea }}</td>	
                                            @if (auth()->user()->hasRole('Administrador')) 									
                                                <td class="{{ empty($audifono->cod_registro) ? 'color1' : '' }}" >
                                                    @if($audifono->cod_registro)
                                                    {{$audifono->cod_registro }}
                                                    @elseif(! $audifono->cod_registro)	
                                                    <button type="button" class="btn btn-sm btn-outline-light" data-toggle="modal" data-target="#eRecepcion{{ $audifono->id }}">{{ __( 'REGISTRAR NUMERO DE RECEPCIÓN' ) }}</button>
                                                    @endif
                                                </td> 
                                                <td class="{{ empty($audifono->user_id) ? 'color1' : '' }}">
                                                    @if($audifono->cod_registro)
                                                        @if($audifono->user_id)
                                                        {{ $audifono->user->name}} {{ $audifono->user->paterno}} {{ $audifono->user->materno}}
                                                        @elseif(! $audifono->user_id)
                                                        <button type="button" class="btn btn-sm btn-outline-light" data-toggle="modal" data-target="#eTecnico{{ $audifono->id }}">{{ __('ASIGNAR TECNICO') }}</button>
                                                        @endif
                                                    @elseif(! $audifono->cod_registro)	
                                                    <button type="button" class="btn btn-sm btn-outline-light" onclick="Swal.fire({ title: 'Error', text: 'DEBES REGISTRAR NUMERO DE RECEPCIÓN', icon: 'error', confirmButtonText: 'ACEPTAR' });">{{ __('ASIGNAR TECNICO') }}</button>
                                                    @endif
                                                </td>
                                                <td class="{{ empty($audifono->fecha_asignacion) ? 'color1' : '' }}">
                                                    @if($audifono->fecha_asignacion)
                                                    {{ date('d-m-Y H:i',strtotime($audifono->fecha_asignacion ))}}<BR><BR>
                                                    @if(!($audifono->estado_id == '5') && !($audifono->estado_id == '4'))
                                                        @php
                                                        $dias = floor(\Carbon\Carbon::parse($audifono->fecha_asignacion)->diffInDays(\Carbon\Carbon::now()));
                                                        @endphp
                                                        <button class="btn btn-sm btn-estado" data-dias="{{ $dias }}" title="Dias transcurridos desde la fecha de asignación">
                                                        {{ $dias }} DÍAS TRANSCURRIDOS
                                                        </button>
                                                    @endif
                                                    @elseif(! $audifono->fecha_asignacion)	
                                                    <button type="button" class="btn btn-sm btn-outline-light" onclick="Swal.fire({ title: 'Error', text: 'DEBES ASIGNAR UN TECNICO', icon: 'error', confirmButtonText: 'ACEPTAR' });">{{ __('FECHA DE ASIGNACIÓN') }}</button>
                                                    @endif							
                                                </td>	
                                                <td class="{{ empty($audifono->fecha_inicio) ? 'color1' : '' }}">
                                                    @if($audifono->fecha_inicio)
                                                    {{ date('d-m-Y H:i',strtotime($audifono->fecha_inicio ))}}<BR><BR>
                                                    @if(!($audifono->estado_id == '5') && !($audifono->estado_id == '4'))
                                                        @php
                                                        $dias = floor(\Carbon\Carbon::parse($audifono->fecha_inicio)->diffInDays(\Carbon\Carbon::now()));
                                                        @endphp
                                                        <button class="btn btn-sm btn-estado" data-dias="{{ $dias }}" title="Dias transcurridos desde la fecha de inico de la reparación">
                                                        {{ $dias }} DÍAS TRANSCURRIDOS
                                                        </button>
                                                    @endif
                                                    @elseif(! $audifono->fecha_inicio)	
                                                    <button type="button" class="btn btn-sm btn-outline-light" onclick="Swal.fire({ title: 'Error', text: 'EN ESPERA DEL INICIO DEL TRABAJO', icon: 'error', confirmButtonText: 'ACEPTAR' });">{{ __('EN ESPERA') }}</button>
                                                    @endif							
                                                </td>	
                                            @else 
                                            {{-- -----------------------usuario--------------------------------------------------}}
                                                <td class="{{ empty($audifono->cod_registro) ? 'color1' : '' }}">
                                                    @if($audifono->cod_registro)
                                                    {{$audifono->cod_registro }}
                                                    @elseif(! $audifono->cod_registro)	
                                                    {{$audifono->cod_registro ?? 'SIN ASIGNAR' }}                                                   
                                                    @endif
                                                </td> 
                                                <td class="{{ empty($audifono->user_id) ? 'color1' : '' }}" >
                                                    @if($audifono->user_id)
                                                    {{ $audifono->user->name}} {{ $audifono->user->paterno}} {{ $audifono->user->materno}}
                                                    @elseif(! $audifono->user_id)	
                                                    {{ $audifono->user->name ?? 'SIN ASIGNAR'}}
                                                @endif
                                                </td>
                                                <td class="{{ empty($audifono->fecha_asignacion) ? 'color1' : '' }}">
                                                    @if($audifono->fecha_asignacion)
                                                    {{ date('d-m-Y',strtotime($audifono->fecha_asignacion ))}}
                                                    @elseif(! $audifono->fecha_asignacion)	
                                                    {{($audifono->fecha_asignacion ?? 'SIN ASIGNAR' )}}                                                    
                                                    @endif							
                                                </td>	
                                                <td class="{{ empty($audifono->fecha_inicio) ? 'color1' : '' }}">
                                                    @if($audifono->fecha_inicio)
                                                    {{ date('d-m-Y',strtotime($audifono->fecha_inicio ))}}
                                                    @elseif(! $audifono->fecha_inicio)	
                                                    {{($audifono->fecha_inicio ?? 'EN ESPERA' )}}                                                    
                                                    @endif							
                                                </td>	
                                            @endif
                                            <td>
                                            @if(!empty($audifono->cod_registro) && !empty($audifono->user_id) && !empty($audifono->fecha_asignacion) || $audifono->estado_id != '1')
                                                @if($audifono->estado_id == '1')
                                                    <button id="#boton-actualizar-estado" type="submit" class="btn btn-primary btn-raised" @role('Administrador') title="Actualizar estado"data-id="{{ $audifono->id }}" onclick="cambiarEstado({{ $audifono->id }}, {{ $audifono->estado_id }}, {{ $audifono->resultado_id ? 'true' : 'false' }} )"@endrole>RECEPCIONADO</button>
                                                @elseif($audifono->estado_id == '2')
                                                    <button id="#boton-actualizar-estado" class="btn btn-warning btn-raised" @role('Administrador') title="Actualizar estado" data-id="{{ $audifono->id }}" onclick="cambiarEstado({{ $audifono->id }}, {{ $audifono->estado_id }}, {{ $audifono->resultado_id ? 'true' : 'false' }} )"@endrole>EN PROCESO</button>
                                                @elseif($audifono->estado_id == '3')
                                                <button class="btn btn-danger btn-raised" @role('Administrador') title="Actualizar estado" data-id="{{ $audifono->id }}" onclick="cambiarEstado({{ $audifono->id }}, {{ $audifono->estado_id }}, {{ $audifono->resultado_id ? 'true' : 'false' }} )"@endrole>APERSONARSE CON EL TECNICO{{ $audifono->resultado?->nombre }}</button>
                                                @elseif($audifono->estado_id == '4')
                                                <button class="btn btn-success btn-raised" @role('Administrador') title="Actualizar estado" data-id="{{ $audifono->id }}" onclick="cambiarEstado({{ $audifono->id }}, {{ $audifono->estado_id }}, {{ $audifono->resultado_id ? 'true' : 'false' }} )"@endrole>CONCLUIDO</button>
                                                @elseif($audifono->estado_id == '5')
                                                {{-- ---------------------------------------RESULTADO FINAL--------------------------------------------}}
                                                    @if($audifono->resultado_id == '1')
                                                    <button class="boton300 badge-devolucion">
                                                    {{ $audifono->resultado?->nombre }}<br>  {{ date('d-m-Y H:i:s',strtotime($audifono->fecha_entrega ))}}</button>
                                                    @elseif($audifono->resultado_id == '2')
                                                    <button class="boton300 badge-reposicion">
                                                    {{ $audifono->resultado?->nombre }} <br>  {{ date('d-m-Y H:i:s',strtotime($audifono->fecha_entrega ))}}</button>
                                                    @elseif($audifono->resultado_id == '3')
                                                    <button class="boton300  badge-repliegue">
                                                        {{ $audifono->resultado?->nombre }} <br>  {{ date('d-m-Y H:i:s',strtotime($audifono->fecha_entrega ))}}</button>
                                                    @elseif($audifono->resultado_id == '4')
                                                    <button class="boton300  badge-custodio">
                                                        {{ $audifono->resultado?->nombre }}  <br>  {{ date('d-m-Y H:i:s',strtotime($audifono->fecha_entrega ))}}</button>
                                                    @elseif($audifono->resultado_id == '5')
                                                    <button class="boton300  badge-baja" >
                                                        {{ $audifono->resultado?->nombre }} <br>  {{ date('d-m-Y H:i:s',strtotime($audifono->fecha_entrega ))}}</button>
                                                    @endif
                                                @endif
                                            @else 
                                                @if(empty($audifono->cod_registro))
                                                <button type="submit" class="btn btn-primary btn-raised" data-id="{{ $audifono->id }}" @role('Administrador') onclick="Swal.fire({ title: 'Error', text: 'DEBES REGISTRAR NUMERO DE RECEPCIÓN', icon: 'error', confirmButtonText: 'ACEPTAR' });"@endrole>RECEPCIONADO</button>
                                                @elseif(empty($audifono->user_id))
                                                <button type="submit" class="btn btn-primary btn-raised" data-id="{{ $audifono->id }}" @role('Administrador') onclick="Swal.fire({ title: 'Error', text: 'DEBES ASIGNAR UN TECNICO', icon: 'error', confirmButtonText: 'ACEPTAR' });"@endrole>RECEPCIONADO</button>
                                                @elseif(empty($audifono->fecha_asignacion))
                                                <button type="submit" class="btn btn-primary btn-raised" data-id="{{ $audifono->id }}" @role('Administrador') onclick="Swal.fire({ title: 'Error', text: 'DEBES ASIGNAR UNA FECHA DE INICIO', icon: 'error', confirmButtonText: 'ACEPTAR' });"@endrole>RECEPCIONADO</button>
                                                @endif
                                            @endif
                                                <form id="form-cambiar-estado" method="POST" action="{{ route('estado-audifono') }}">
                                                    @csrf
                                                    <input type="hidden" name="id" id="id-audifono">
                                                    <input type="hidden" name="estado_id" id="estado-id">
                                                </form>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-institucional dropdown-toggle" type="button" data-toggle="dropdown">
                                                        <i class="fas fa-cog"></i> OPCIONES
                                                    </button>
                                                    <!-- PDF -->
                                                    <div class="dropdown-menu dropdown-menu-right p-2">
                                                        <a href="#" 
                                                        class="dropdown-card card-danger btn-preview-pdf"
                                                        data-ver="{{ route('pdf.audifono.preview', ':id') }}"
                                                        data-descargar="{{ route('pdf.audifono.descargar', ':id') }}"
                                                        data-enviar="{{ route('pdf.audifono.enviar', ':id') }}"
                                                        data-id="{{ $audifono->id }}">
                                                        <i class="far fa-file-pdf"></i> FORMULARIO
                                                        </a>
                                                        <!-- VER -->
                                                        <button type="button" data-toggle="modal" data-target="#ver{{ $audifono->id }}"
                                                                class="dropdown-card card-primary">
                                                            <i class="fa fa-eye"></i> VER
                                                        </button>
                                                        @role('Administrador')
                                                        <!-- EDITAR -->
                                                        <button type="button" data-toggle="modal" data-target="#editar{{ $audifono->id }}"
                                                                class="dropdown-card card-success">
                                                            <i class="fa fa-edit"></i> EDITAR
                                                        </button>
                                                        <!-- INFORME -->
                                                        <a href="{{ route('informe.audifono', $audifono->id) }}"
                                                        class="dropdown-card card-secondary">
                                                            <i class="fa fa-file"></i> INFORME
                                                        </a>
                                                        <!-- ELIMINAR -->
                                                        <form action="{{ route('audifonos.destroy', $audifono->id) }}" method="POST" class="formEliminar">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                    class="dropdown-card card-danger">
                                                                <i class="fa fa-trash"></i> ELIMINAR
                                                            </button>
                                                        </form>
                                                        @endrole
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <!--Ventana Modal para Ver --->
                                        @include('audifono.modalVer')
                                        <!--Ventana Modal eRecepcion --->
                                        @include('audifono.modalRecepcion')
                                        <!--Ventana Modal eTecnico --->
                                        @include('audifono.registroTecnico')
                                        <!--Ventana Modal para Actualizar--->
                                        @include('audifono.modalEdit')
                                    @endforeach

                                </tbody>
                                <tfoot>
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
                                </tfoot>

                            </table>
                        </div>
                    </div>
                </div>
                {!! $audifonos->withQueryString()->links() !!}
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
// Definir texto y botón según condición
let texto, botonConfirm;

if (estado_id == 5) {
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
            xhr.open('POST', '{{ route('estado-audifono') }}', true);
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
<script src="{{ asset('js/funcion.js') }}"></script>
<script src="{{ asset('js/mov.js') }}"></script>
<script src="{{ asset('js/audifono.js') }}"></script>
<script src="{{ asset('js/fechas.js') }}"></script>
<script src="{{ asset('js/equipoPdf.js') }}"></script>
<link rel="stylesheet" href="{{ asset('estilos/fechas.css') }}">  
<link rel="stylesheet" href="{{ asset('estilos/headerinicio.css') }}">  
<link rel="stylesheet" href="{{ asset('estilos/equipoPdf.css') }}">  
<script>
const searchInputA = document.getElementById('search-inputA');
const optionsA = document.getElementById('optionsA').options;
const idSelectedInputA = document.getElementById('id-selectedA');

searchInputA.addEventListener('input', () => {
    const selectedOption = Array.from(optionsA).find(option => option.value === searchInputA.value);
    if (selectedOption) {
        idSelectedInputA.value = selectedOption.dataset.id;
    }
});
</script>

@endpush
@push('css')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endpush