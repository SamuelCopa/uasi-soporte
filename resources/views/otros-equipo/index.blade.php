@extends('layouts.app')

@section('template_title')
    Monitors
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class=" card-header--custom">
                </div>
                    <div class="header-panel">
                        <div class="header-left">
                            <h1 class="header-title">Registro de Equipos</h1>
                        </div>
                    </div>

                    <div class="row mb-3">

                    <div class="col-md-4">

                            <label for="tipo_equipo_id">
                                Tipo de equipo
                            </label>

                            <select id="tipoEquipo"
                                    name="tipo_equipo_id"
                                    class="form-control"
                                    onchange="filtrarEquipo()">

                                <option value="">TODOS LOS EQUIPOS</option>

                                @foreach($tipoequipo as $tipo)
                                    <option value="{{ $tipo->id }}"
                                        {{ request('tipo_equipo_id') == $tipo->id ? 'selected' : '' }}>
                                        {{ strtoupper($tipo->nombre) }}
                                    </option>
                                @endforeach

                                <option value="nuevo">
                                    + CREAR NUEVO EQUIPO
                                </option>

                            </select>

                                </div>

                                <div class="col-md-3 d-flex align-items-end">

                            <button
                                type="button"
                                class="btn btn-primary"
                                onclick="abrirModalEquipo()"
                            >
                                <i class="fas fa-plus"></i>
                                REGISTRAR
                            </button>

                        </div>

                    </div>
                        <script>
                        function filtrarEquipo() {

                            const select = document.getElementById('tipoEquipo');
                            const tipo = select.value;

                            // ==============================
                            // CREAR NUEVO TIPO DE EQUIPO
                            // ==============================
                            if (tipo === 'nuevo') {

                                Swal.fire({
                                    title: 'NUEVO TIPO DE EQUIPO',
                                    input: 'text',
                                    inputLabel: 'Nombre del equipo',
                                    inputPlaceholder: 'Ej.: TABLETA',
                                    showCancelButton: true,
                                    confirmButtonText: 'GUARDAR',
                                    cancelButtonText: 'CANCELAR',

                                    inputValidator: (value) => {

                                        if (!value || value.trim() === '') {
                                            return 'Debe ingresar el nombre del equipo';
                                        }
                                    }

                                }).then((result) => {

                                    if (result.isConfirmed) {

                                        guardarTipoEquipo(result.value.trim());

                                    } else {

                                        // Volver a todos los equipos
                                        select.value = '';
                                    }
                                });

                                return;
                            }

                            // ==============================
                            // FILTRAR EQUIPOS
                            // ==============================

                            let url = "{{ route('otros-equipos.index') }}";

                            if (tipo !== '') {
                                url += '?tipo_equipo_id=' + tipo;
                            }

                            window.location.href = url;
                        }
                        </script>
                        <script>
                        function guardarTipoEquipo(nombre) {

                            fetch("{{ route('tipos-equipos.store') }}", {

                                method: 'POST',

                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json'
                                },

                                body: JSON.stringify({
                                    nombre: nombre
                                })

                            })
                            .then(response => response.json())

                            .then(data => {

                                if (data.success) {

                                    const select = document.getElementById('tipoEquipo');

                                    // Crear nueva opción
                                    const option = document.createElement('option');

                                    option.value = data.tipo.id;
                                    option.textContent = data.tipo.nombre.toUpperCase();

                                    // Agregar antes de "CREAR NUEVO EQUIPO"
                                    const opcionNuevo = select.querySelector('option[value="nuevo"]');

                                    select.insertBefore(option, opcionNuevo);

                                    // Seleccionar automáticamente el nuevo equipo
                                    select.value = data.tipo.id;

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'REGISTRADO',
                                        text: 'El tipo de equipo fue registrado correctamente',
                                        confirmButtonText: 'ACEPTAR'
                                    });

                                } else {

                                    Swal.fire({
                                        icon: 'error',
                                        title: 'ERROR',
                                        text: data.message ?? 'No se pudo registrar el tipo de equipo'
                                    });

                                    document.getElementById('tipoEquipo').value = '';
                                }

                            })
                            .catch(error => {

                                console.error(error);

                                Swal.fire({
                                    icon: 'error',
                                    title: 'ERROR',
                                    text: 'Ocurrió un error al registrar el tipo de equipo'
                                });

                                document.getElementById('tipoEquipo').value = '';
                            });
                        }
                        </script>
                    <script>
                        function abrirModalEquipo()
                    {
                        let tipoId = $('#tipoEquipo').val();

                        let tipoNombre = $('#tipoEquipo option:selected')
                            .text()
                            .trim();

                        if (!tipoId) {

                            Swal.fire({
                                icon: 'warning',
                                title: 'Seleccione un tipo de equipo',
                                text: 'Debe seleccionar el tipo de equipo.'
                            });

                            return;
                        }

                        // Enviar ID al formulario
                        $('#tipo_equipo_id_a').val(tipoId);

                        // Mostrar nombre en el modal
                        $('#nombre_tipo_equipo_a').val(tipoNombre);

                        // Abrir modal
                        $('#creara').modal('show');
                    }
                    </script>
                        <!--Ventana Modal para Crear--->
                        @include('otros-equipo.modalCrear')
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
                                    @foreach ($otrosEquipo as $monitor)
                                        <tr>
                                            <td class="text-center">{{ ++$i }}</td>
                                            <td>
                                                @if($monitor->fecha)
                                                {{date('d-m-Y H:i',strtotime($monitor->fecha))}}<br><br>
                                                        @if(auth()->check() && auth()->user()->hasAnyRole([
                                                            'Administrador',
                                                            'SuperAdministrador'
                                                        ]))
                                                            @if(!($monitor->estado_id == '5'))
                                                                @php
                                                                $dias = floor(\Carbon\Carbon::parse($monitor->fecha)->diffInDays(\Carbon\Carbon::now()));
                                                                @endphp
                                                                <button 
                                                                class="btn btn-sm btn-estado"
                                                                data-dias="{{ $dias }}"
                                                                title="Días transcurridos desde la recepción">
                                                                {{ $dias }} DÍAS 
                                                                </button>
                                                            @endif
                                                        @endif
                                                @elseif(! $monitor->fecha)	
                                                {{ $monitor->fecha ?? ''}}
                                                @endif
                                          
                                            </td>
                                            <td >{{ $monitor->funcionario?->nombre}} {{ $monitor->funcionario?->paterno}} {{ $monitor->funcionario?->materno}}</td>
                                            <td >{{ $monitor->funcionario?->ci }} {{ $monitor->funcionario?->expedido }}</td>
                                            <td >{{ $monitor->funcionario?->celular }}</td>
                                            @if(! $monitor->cargo == '')
                                                <td >{{ $monitor->cargo }}</td>
                                            @else
                                                <td >{{ 'EX FUNCIONARIO'}}</td>
                                            @endif	
                                            @if(! $monitor->dependencia_id == '')
                                            <td >{{ $monitor->Dependencia?->dependencias }}</td>
                                            @else
                                            <td >{{ 'SIN DEPENDENCIA'}}</td>
                                            @endif
                                            <td >{{ $monitor->cod_gamea }}</td>	


                                            @if(auth()->check() && auth()->user()->hasAnyRole([
                                                'Administrador',
                                                'SuperAdministrador'
                                            ]))								
                                                <td class="{{ empty($monitor->cod_registro) ? 'color1' : '' }}" >
                                                    @if($monitor->cod_registro)
                                                    {{$monitor->cod_registro }}
                                                    @elseif(! $monitor->cod_registro)	
                                                    <button type="button" class="btn btn-sm btn-outline-light" data-toggle="modal" data-target="#eRecepcion{{ $monitor->id }}">{{ __( 'REGISTRAR NUMERO DE RECEPCIÓN' ) }}</button>
                                                    @endif
                                                </td> 
                                                <td class="{{ empty($monitor->user_id) ? 'color1' : '' }}">
                                                    @if($monitor->cod_registro)
                                                        @if($monitor->user_id)
                                                        {{ $monitor->user->name}} {{ $monitor->user->paterno}} {{ $monitor->user->materno}}
                                                        @elseif(! $monitor->user_id)
                                                        <button type="button" class="btn btn-sm btn-outline-light" data-toggle="modal" data-target="#eTecnico{{ $monitor->id }}">{{ __('ASIGNAR TECNICO') }}</button>
                                                        @endif
                                                    @elseif(! $monitor->cod_registro)	
                                                    <button type="button" class="btn btn-sm btn-outline-light" onclick="Swal.fire({ title: 'Error', text: 'DEBES REGISTRAR NUMERO DE RECEPCIÓN', icon: 'error', confirmButtonText: 'ACEPTAR' });">{{ __('ASIGNAR TECNICO') }}</button>
                                                    @endif
                                                </td>
                                                <td class="{{ empty($monitor->fecha_asignacion) ? 'color1' : '' }}">
                                                    @if($monitor->fecha_asignacion)
                                                    {{ date('d-m-Y H:i',strtotime($monitor->fecha_asignacion ))}}<BR><BR>
                                                    @if(!($monitor->estado_id == '5') && !($monitor->estado_id == '4'))
                                                        @php
                                                        $dias = floor(\Carbon\Carbon::parse($monitor->fecha_asignacion)->diffInDays(\Carbon\Carbon::now()));
                                                        @endphp
                                                        <button class="btn btn-sm btn-estado" data-dias="{{ $dias }}" title="Dias transcurridos desde la fecha de asignación">
                                                        {{ $dias }} DÍAS 
                                                        </button>
                                                    @endif
                                                    @elseif(! $monitor->fecha_asignacion)	
                                                    <button type="button" class="btn btn-sm btn-outline-light" onclick="Swal.fire({ title: 'Error', text: 'DEBES ASIGNAR UN TECNICO', icon: 'error', confirmButtonText: 'ACEPTAR' });">{{ __('FECHA DE ASIGNACIÓN') }}</button>
                                                    @endif							
                                                </td>	
                                                <td class="{{ empty($monitor->fecha_inicio) ? 'color1' : '' }}">
                                                    @if($monitor->fecha_inicio)
                                                    {{ date('d-m-Y H:i',strtotime($monitor->fecha_inicio ))}}<BR><BR>
                                                    @if(!($monitor->estado_id == '5') && !($monitor->estado_id == '4'))
                                                        @php
                                                        $dias = floor(\Carbon\Carbon::parse($monitor->fecha_inicio)->diffInDays(\Carbon\Carbon::now()));
                                                        @endphp
                                                        <button class="btn btn-sm btn-estado" data-dias="{{ $dias }}" title="Dias transcurridos desde la fecha de inico de la reparación">
                                                        {{ $dias }} DÍAS 
                                                        </button>
                                                    @endif
                                                    @elseif(! $monitor->fecha_inicio)	
                                                    <button type="button" class="btn btn-sm btn-outline-light" onclick="Swal.fire({ title: 'Error', text: 'EN ESPERA DEL INICIO DEL TRABAJO', icon: 'error', confirmButtonText: 'ACEPTAR' });">{{ __('EN ESPERA') }}</button>
                                                    @endif							
                                                </td>	
                                            @else 
                                            {{-- ------------------------------user---------------------------- --}}
                                                <td class="{{ empty($monitor->cod_registro) ? 'color1' : '' }}" >
                                                    @if($monitor->cod_registro)
                                                    {{ $monitor->cod_registro}}
                                                    @elseif(! $monitor->cod_registro)	
                                                    {{ $monitor->cod_registro ?? 'SIN ASIGNAR'}}
                                                    @endif
                                                </td> 
                                                <td class="{{ empty($monitor->user_id) ? 'color1' : '' }}" >
                                                    @if($monitor->user_id)
                                                    {{ $monitor->user->name}} {{ $monitor->user->paterno}} {{ $monitor->user->materno}}
                                                    @elseif(! $monitor->user_id)	
                                                    {{ $monitor->user->name ?? 'SIN ASIGNAR'}}
                                                    @endif
                                                </td>
                                                <td class="{{ empty($monitor->fecha_asignacion) ? 'color1' : '' }}">
                                                    @if($monitor->fecha_asignacion)
                                                    {{ date('d-m-Y',strtotime($monitor->fecha_asignacion ))}}
                                                    @elseif(! $monitor->fecha_asignacion)	
                                                    {{($monitor->fecha_asignacion ?? 'SIN ASIGNAR' )}}
                                                    @endif								
                                                </td>
                                                <td class="{{ empty($monitor->fecha_inicio) ? 'color1' : '' }}">
                                                    @if($monitor->fecha_inicio)
                                                    {{ date('d-m-Y',strtotime($monitor->fecha_inicio ))}}
                                                    @elseif(! $monitor->fecha_inicio)	
                                                    {{($monitor->fecha_inicio ?? 'EN ESPERA' )}}
                                                    @endif								
                                                </td>
                                            @endif										
                                            <td >
                                                 @if(
                                                    (!empty($monitor->cod_registro) &&
                                                    !empty($monitor->user_id) &&
                                                    !empty($monitor->fecha_asignacion))
                                                    ||
                                                    $monitor->estado_id != '1'
                                                )

                                                    @if($monitor->estado_id == '1')

                                                        <button
                                                            id="boton-actualizar-estado"
                                                            type="submit"
                                                            class="btn btn-primary btn-raised"

                                                            @if(auth()->check() && auth()->user()->hasAnyRole([
                                                                'Administrador',
                                                                'SuperAdministrador'
                                                            ]))
                                                                title="Actualizar estado"
                                                                data-id="{{ $monitor->id }}"
                                                                onclick="cambiarEstado(
                                                                    {{ $monitor->id }},
                                                                    {{ $monitor->estado_id }},
                                                                    {{ $monitor->resultado_id ? 'true' : 'false' }}
                                                                )"
                                                            @endif
                                                        >
                                                            RECEPCIONADO
                                                        </button>


                                                    @elseif($monitor->estado_id == '2')

                                                        <button
                                                            id="boton-actualizar-estado"
                                                            class="btn btn-warning btn-raised"

                                                            @if(auth()->check() && auth()->user()->hasAnyRole([
                                                                'Administrador',
                                                                'SuperAdministrador'
                                                            ]))
                                                                title="Actualizar estado"
                                                                data-id="{{ $monitor->id }}"
                                                                onclick="cambiarEstado(
                                                                    {{ $monitor->id }},
                                                                    {{ $monitor->estado_id }},
                                                                    {{ $monitor->resultado_id ? 'true' : 'false' }}
                                                                )"
                                                            @endif
                                                        >
                                                            EN PROCESO
                                                        </button>


                                                    @elseif($monitor->estado_id == '3')

                                                        <button
                                                            class="btn btn-danger btn-raised"

                                                            @if(auth()->check() && auth()->user()->hasAnyRole([
                                                                'Administrador',
                                                                'SuperAdministrador'
                                                            ]))
                                                                title="Actualizar estado"
                                                                data-id="{{ $monitor->id }}"
                                                                onclick="cambiarEstado(
                                                                    {{ $monitor->id }},
                                                                    {{ $monitor->estado_id }},
                                                                    {{ $monitor->resultado_id ? 'true' : 'false' }}
                                                                )"
                                                            @endif
                                                        >
                                                            APERSONARSE CON EL TECNICO
                                                            {{ $monitor->resultado?->nombre }}
                                                        </button>


                                                    @elseif($monitor->estado_id == '4')

                                                        <button
                                                            class="btn btn-success btn-raised"

                                                            @if(auth()->check() && auth()->user()->hasAnyRole([
                                                                'Administrador',
                                                                'SuperAdministrador'
                                                            ]))
                                                                title="Actualizar estado"
                                                                data-id="{{ $monitor->id }}"
                                                                onclick="cambiarEstado(
                                                                    {{ $monitor->id }},
                                                                    {{ $monitor->estado_id }},
                                                                    {{ $monitor->resultado_id ? 'true' : 'false' }}
                                                                )"
                                                            @endif
                                                        >
                                                            CONCLUIDO
                                                        </button>


                                                    @elseif($monitor->estado_id == '5')

                                                        {{-- ---------------------------------------RESULTADO FINAL-------------------------------------------- --}}

                                                        @if($monitor->resultado_id == '1')

                                                            <button class="boton300 badge-devolucion">
                                                                {{ $monitor->resultado?->nombre }}<br>
                                                                {{ date('d-m-Y H:i:s', strtotime($monitor->fecha_entrega)) }}
                                                            </button>

                                                        @elseif($monitor->resultado_id == '2')

                                                            <button class="boton300 badge-reposicion">
                                                                {{ $monitor->resultado?->nombre }}<br>
                                                                {{ date('d-m-Y H:i:s', strtotime($monitor->fecha_entrega)) }}
                                                            </button>

                                                        @elseif($monitor->resultado_id == '3')

                                                            <button class="boton300 badge-repliegue">
                                                                {{ $monitor->resultado?->nombre }}<br>
                                                                {{ date('d-m-Y H:i:s', strtotime($monitor->fecha_entrega)) }}
                                                            </button>

                                                        @elseif($monitor->resultado_id == '4')

                                                            <button class="boton300 badge-custodio">
                                                                {{ $monitor->resultado?->nombre }}<br>
                                                                {{ date('d-m-Y H:i:s', strtotime($monitor->fecha_entrega)) }}
                                                            </button>

                                                        @elseif($monitor->resultado_id == '5')

                                                            <button class="boton300 badge-baja">
                                                                {{ $monitor->resultado?->nombre }}<br>
                                                                {{ date('d-m-Y H:i:s', strtotime($monitor->fecha_entrega)) }}
                                                            </button>

                                                        @endif

                                                    @endif


                                                @else

                                                    @if(empty($monitor->user_id))

                                                        <button
                                                            type="submit"
                                                            class="btn btn-primary btn-raised"
                                                            data-id="{{ $monitor->id }}"

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


                                                    @elseif(empty($monitor->fecha_asignacion))

                                                        <button
                                                            type="submit"
                                                            class="btn btn-primary btn-raised"
                                                            data-id="{{ $monitor->id }}"

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
                                            <form id="form-cambiar-estado" method="POST" action="{{ route('estado-equipo') }}">
                                                @csrf
                                                <input type="hidden" name="id" id="id-monitor">
                                                <input type="hidden" name="estado_id" id="estado-id">
                                            </form> 
                                            </td>
                                            <td>
                                               <div class="acciones">

                                            <!-- PDF -->
                                            <a href="#"
                                            class="btn-mini btn-danger btn-preview-pdf"
                                            data-ver="{{ route('pdf.equipo.preview', ':id') }}"
                                            data-descargar="{{ route('pdf.equipo.descargar', ':id') }}"
                                            data-enviar="{{ route('pdf.equipo.enviar', ':id') }}"
                                            data-id="{{ $monitor->id }}"
                                            title="Formulario PDF">
                                                <i class="far fa-file-pdf"></i>
                                            </a>

                                            <!-- VER -->
                                            <button type="button"
                                                    data-toggle="modal"
                                                    data-target="#ver{{ $monitor->id }}"
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
                                                        data-target="#editar{{ $monitor->id }}"
                                                        class="btn-mini btn-success"
                                                        title="Editar">
                                                    <i class="fa fa-edit"></i>
                                                </button>

                                                <!-- INFORME -->
                                                <a href="{{ route('informe.equipo', $monitor->id) }}"
                                                class="btn-mini btn-secondary"
                                                title="Informe">
                                                    <i class="fa fa-file"></i>
                                                </a>

                                                <!-- ELIMINAR -->
                                                <form action="{{ route('otros-equipos.destroy', $monitor->id) }}"
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
                                        @include('otros-equipo.modalVer')
                                        <!--Ventana Modal eRecepcion --->
                                        @include('otros-equipo.registroTecnico')
                                        <!--Ventana Modal para Actualizar--->
                                        @include('otros-equipo.modalEdit')
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
               {!! $otrosEquipo->withQueryString()->links() !!}
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

$('.btnEquipo').on('click', function () {

    let tipoId = $(this).data('id');

    // Si selecciona TODOS
    if (tipoId === '') {
        location.reload();
        return;
    }

    $.ajax({

        url: "{{ url('/otros-equipos/por-tipo') }}/" + tipoId,

        type: "GET",

        success: function (equipos) {

            let tabla = $('#mitabla').DataTable();

            tabla.clear();

            equipos.forEach(function (equipo, index) {

                // NOMBRE DEL FUNCIONARIO
                let nombre = '';

                if (equipo.funcionario) {

                    nombre =
                        (equipo.funcionario.grado_academico ?? '') + ' ' +
                        (equipo.funcionario.nombre ?? '') + ' ' +
                        (equipo.funcionario.paterno ?? '') + ' ' +
                        (equipo.funcionario.materno ?? '');

                }

                // TÉCNICO
                let tecnico = '';

                if (equipo.user) {

                    tecnico =
                        (equipo.user.name ?? '') + ' ' +
                        (equipo.user.paterno ?? '') + ' ' +
                        (equipo.user.materno ?? '');

                }

                tabla.row.add([

                    // 0 #
                    index + 1,

                    // 1 FECHA RECEPCIÓN
                    equipo.fecha
                        ? new Date(equipo.fecha).toLocaleString('es-BO')
                        : '',

                    // 2 NOMBRE
                    nombre,

                    // 3 C.I.
                    equipo.funcionario
                        ? (
                            (equipo.funcionario.ci ?? '') +
                            ' ' +
                            (equipo.funcionario.expedido ?? '')
                        )
                        : '',

                    // 4 CELULAR
                    equipo.funcionario
                        ? (equipo.funcionario.celular ?? '')
                        : '',

                    // 5 CARGO
                    equipo.cargo ?? '',

                    // 6 DEPENDENCIA
                    equipo.dependencia
                        ? equipo.dependencia.dependencias
                        : '',

                    // 7 CODIGO GAMEA
                    equipo.cod_gamea ?? '',

                    // 8 NUMERO DE RECEPCIÓN
                    equipo.cod_registro ?? '',

                    // 9 TECNICO
                    tecnico,

                    // 10 FECHA ASIGNACIÓN
                    equipo.fecha_asignacion
                        ? new Date(equipo.fecha_asignacion).toLocaleString('es-BO')
                        : '',

                    // 11 FECHA INICIO
                    equipo.fecha_inicio
                        ? new Date(equipo.fecha_inicio).toLocaleString('es-BO')
                        : '',

                    // 12 ESTADO
                    equipo.estado
                        ? equipo.estado.nombre
                        : '',

                    // 13 OPCIONES
                    `
                    <div class="text-center">

                        <button
                            type="button"
                            class="btn btn-primary btn-sm"
                            title="Ver"
                            onclick="verEquipo(${equipo.id})"
                        >
                            <i class="fas fa-eye"></i>
                        </button>

                    </div>
                    `

                ]);

            });

            tabla.draw();

        },

        error: function (xhr) {

            console.error(xhr);

            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se pudieron cargar los equipos.'
            });

        }

    });

});
</script>

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
            xhr.open('POST', '{{ route('estado-equipo') }}', true);
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
<script src="{{ asset('js/otroequipo.js') }}"></script>
<script src="{{ asset('js/fechas.js') }}"></script>
<link rel="stylesheet" href="{{ asset('estilos/fechas.css') }}">  
<script src="{{ asset('js/equipoPdf.js') }}"></script>
<link rel="stylesheet" href="{{ asset('estilos/equipoPdf.css') }}"> 
<script>
const searchInputM = document.getElementById('search-inputA');
const optionsM = document.getElementById('optionsA').options;
const idSelectedInputM = document.getElementById('id-selectedA');

searchInputM.addEventListener('input', () => {
    const selectedOption = Array.from(optionsM).find(option => option.value === searchInputM.value);
    if (selectedOption) {
        idSelectedInputM.value = selectedOption.dataset.id;
    }
});
</script>
@endpush