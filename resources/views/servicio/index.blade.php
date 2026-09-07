@extends('layouts.app')

@section('template_title')
    Servicios
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-header card-header--custom">
                </div>
                    <div class="header-panel">
                        <div class="header-left">
                            <h1 class="header-title">Requerimientos de Asistencia técnica</h1>
                        </div>
                                <div class="header-actions">
                        {{-- VOLVER --}}
                        <a href="{{ route('home') }}"
                        class="btn-header">
                            <i class="fas fa-arrow-left"></i>
                            Volver
                        </a>
                    </div>
                    </div>

<div class="filtros-servicios">

    {{-- ENCABEZADO --}}
    <div class="filtros-header">

        <div class="filtros-titulo">

            <div class="filtros-icono">
                <i class="fas fa-filter"></i>
            </div>

            <div>
                <h5>Filtros de servicios</h5>
                <span>
                    Seleccione los criterios para consultar los registros
                </span>
            </div>

        </div>

    </div>


    {{-- FORMULARIO --}}
    <form action="{{ route('servicios.index') }}"
          method="GET"
          class="filtros-form">

        <div class="row g-3">

            {{-- AÑO --}}
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">

                <label class="filtro-label">
                    <i class="fas fa-calendar-alt"></i>
                    Año
                </label>

                <div class="campo-filtro">

                    <i class="fas fa-calendar campo-icono"></i>

                    <select name="year"
                            class="form-control filtro-control">

                        <option value="">
                            Todos los años
                        </option>

                        @for($año = date('Y'); $año >= 2026; $año--)

                            <option value="{{ $año }}"
                                {{ request('year') == $año ? 'selected' : '' }}>

                                {{ $año }}

                            </option>

                        @endfor

                    </select>

                </div>

            </div>
            {{-- FECHA DESDE --}}
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">

                <label class="filtro-label">
                    <i class="fas fa-calendar-day"></i>
                    Fecha desde
                </label>

                <div class="campo-filtro">

                    <i class="fas fa-calendar campo-icono"></i>

                    <input type="date"
                           name="fecha_desde"
                           class="form-control filtro-control"
                           value="{{ request('fecha_desde') }}">

                </div>

            </div>


            {{-- FECHA HASTA --}}
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">

                <label class="filtro-label">
                    <i class="fas fa-calendar-check"></i>
                    Fecha hasta
                </label>

                <div class="campo-filtro">

                    <i class="fas fa-calendar campo-icono"></i>

                    <input type="date"
                           name="fecha_hasta"
                           class="form-control filtro-control"
                           value="{{ request('fecha_hasta') }}">

                </div>

            </div>


            {{-- ESTADO --}}
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">

                <label class="filtro-label">
                    <i class="fas fa-tasks"></i>
                    Estado
                </label>

                <div class="campo-filtro">

                    <i class="fas fa-circle-check campo-icono"></i>

                    <select name="estado"
                            class="form-control filtro-control">

                        <option value="">
                            Todos
                        </option>

                        <option value="pendiente"
                            {{ request('estado') == 'pendiente' ? 'selected' : '' }}>
                            Pendiente
                        </option>

                        <option value="atendido"
                            {{ request('estado') == 'atendido' ? 'selected' : '' }}>
                            Atendido
                        </option>

                    </select>

                </div>

            </div>


            {{-- TÉCNICO --}}
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">

                <label class="filtro-label">
                    <i class="fas fa-user-cog"></i>
                    Técnico
                </label>

                <div class="campo-filtro">

                    <i class="fas fa-user campo-icono"></i>

                    <select name="tecnico"
                            class="form-control filtro-control">

                        <option value="">
                            Todos los técnicos
                        </option>

                        @foreach($users as $user)

                            <option value="{{ $user->id }}"
                                {{ request('tecnico') == $user->id ? 'selected' : '' }}>

                                {{ $user->name }}
                                {{ $user->paterno }}
                                {{ $user->materno }}

                            </option>

                        @endforeach

                    </select>

                </div>

            </div>


                {{-- DEPENDENCIA --}}
                <div class="col-md-3">

                    <label
                        for="buscar_dependencia"
                        class="form-label fw-semibold"
                    >

                        <i class="fas fa-building me-1"></i>

                        Dependencia

                    </label>


                    <input
                        type="text"
                        id="buscar_dependencia"
                        class="form-control"
                        list="listaDependencias"
                        placeholder="Buscar dependencia..."
                        autocomplete="off"
                        value="{{ $dependencias->firstWhere('id', request('dependencia_id'))?->dependencias }}"
                    >


                    <input
                        type="hidden"
                        name="dependencia_id"
                        id="dependencia_id"
                        value="{{ request('dependencia_id') }}"
                    >


                    <datalist id="listaDependencias">

                        @foreach($dependencias as $dependencia)

                            <option
                                value="{{ $dependencia->dependencias }}"
                                data-id="{{ $dependencia->id }}"
                            ></option>

                        @endforeach

                    </datalist>

                </div>
{{-- =========================================================
     JAVASCRIPT DEPENDENCIA
     ========================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const buscarDependencia =
        document.getElementById('buscar_dependencia');

    const dependenciaId =
        document.getElementById('dependencia_id');

    const opciones =
        document.querySelectorAll(
            '#listaDependencias option'
        );


    if (!buscarDependencia || !dependenciaId) {
        return;
    }


    buscarDependencia.addEventListener(
        'input',
        function () {

            const nombre =
                this.value.trim();

            dependenciaId.value = '';


            opciones.forEach(function (opcion) {

                if (
                    opcion.value.trim() === nombre
                ) {

                    dependenciaId.value =
                        opcion.dataset.id;

                }

            });

        }
    );

});

</script>

        </div>


        {{-- BOTONES --}}
            <div class="filtros-acciones">
                <div class="col-12  text-right">
                    <button type="submit"
                            class="btn-filtro btn-aplicar">

                        <i class="fas fa-search"></i>
                        <span>
                            Aplicar filtros
                        </span>
                    </button>
                    <a href="{{ route('servicios.index') }}"
                    class="btn-filtro btn-limpiar">
                        <i class="fas fa-rotate-right"></i>
                        <span>
                            Limpiar
                        </span>
                    </a>
                    <a href="{{ route('servicio.reporte.pdf', request()->query()) }}"
                    target="_blank"
                    class="btn-filtro btn-pdf">
                        <i class="fas fa-file-pdf"></i>
                        <span>
                            Generar PDF
                        </span>
                    </a>
                </div>
            </div>

    </form>

</div>
                    <div class="card shadow-sm border-0 rounded-4">
                        <div class="table-responsive">
                            <table id="mitabla" class="table table-modern align-middle">
                                <thead>
                                    <tr>
                                    <th>No</th>                                        
									<th >Fecha</th>
									<th >Nombre</th>
									<th >ci</th>
									<th >Dependencia</th>
									<th >Equipo</th>
									<th >Falla</th>
									<th >Tipo de Servicio</th>
									<th >tecnico</th>
                                    <th >FECHA DE ASIGNACIÓN</th>
                                    <th >FECHA DE ATENCION</th>
									<th >Estado</th>
									<th >Calificación</th>
									<th >Asignado por:</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($servicios as $servicio)
                                        <tr>
                                        <td>{{ ++$i }}</td>                                            
										<td >{{date('d-m-Y H:i',strtotime($servicio->created_at ?? ''))}}</td>
                                         <td >{{ $servicio->funcionario?->nombre }} {{ $servicio->funcionario?->paterno }} {{ $servicio->funcionario?->materno }}</td>
                                         <td >{{ $servicio->funcionario?->ci }}</td>
										<td >{{ $servicio->Dependencia?->dependencias }}</td>
										<td >{{ $servicio->equipo ?? '' }}</td>
										<td >{{ $servicio->falla ?? '' }}</td>
										<td >{{ $servicio->servicio ?? '' }}</td>
                                        <td class="{{ empty($servicio->user_id) ? 'color1' : '' }}">
                                            @if($servicio->user_id)
                                            {{ $servicio->user->name ?? ''}} {{ $servicio->user->paterno}} {{ $servicio->user->materno}}
                                            @elseif(! $servicio->user_id)	
                                            <button type="button" class="btn btn-sm btn-outline-light" data-toggle="modal" data-target="#eTecnico{{ $servicio->id }}">{{ __('ASIGNAR TECNICO') }}</button>
                                            @endif
                                        </td>
                                        <td class="{{ empty($servicio->fecha_asignacion) ? 'color1' : '' }}"  align="center">
                                                @if($servicio->fecha_asignacion)
                                                {{ date('d-m-Y H:i',strtotime($servicio->fecha_asignacion ))}}
                                                @elseif(! $servicio->fecha_asignacion)	
                                                <button type="button" class="btn btn-sm btn-outline-light" onclick="Swal.fire({ title: 'Error', text: 'DEBES ASIGNAR UN TECNICO', icon: 'error', confirmButtonText: 'ACEPTAR' });">{{ __('FECHA DE ASIGNACIÓN') }}</button>
                                                @endif	
                                        </td>
                                        <td class="{{ empty($servicio->fecha_atencion) ? 'color1' : '' }}"  align="center">
                                                @if($servicio->fecha_atencion)
                                                {{ date('d-m-Y H:i',strtotime($servicio->fecha_atencion ))}}
                                                @elseif(! $servicio->fecha_atencion)	
                                                <button type="button" class="btn btn-sm btn-outline-light" >{{ __('FECHA DE ATENCIÓN') }}</button>
                                                @endif	
                                        </td>
                                        <td>
                                            @if(!empty($servicio->user_id))
                                                <button
                                                    class="btn btn-visto {{ $servicio->visto ? 'btn-primary' : 'btn-danger' }}"
                                                    data-id="{{ $servicio->id }}">
                                                    {{ $servicio->visto ? 'ATENDIDO' : 'PENDIENTE' }}
                                                </button>
                                            @elseif(empty($servicio->user_id))
                                                <button type="submit" class="btn btn-danger btn-raised" onclick="Swal.fire({ title: 'Error', text: 'DEBES ASIGNAR UN TECNICO', icon: 'error', confirmButtonText: 'ACEPTAR' });">PENDIENTE</button>
                                            @endif
                                        </td>
                                                                                <td class="text-center">
                                            @switch($servicio->puntuacion)

                                                @case(1)
                                                    <span class="evaluacion">
                                                        <span>Muy malo</span>
                                                    </span>
                                                    @break

                                                @case(2)
                                                    <span class="evaluacion">
                                                        <span>Malo</span>
                                                    </span>
                                                    @break

                                                @case(3)
                                                    <span class="evaluacion">
                                                        <span>Regular</span>
                                                    </span>
                                                    @break

                                                @case(4)
                                                    <span class="evaluacion">
                                                        <span>Bueno</span>
                                                    </span>
                                                    @break

                                                @case(5)
                                                    <span class="evaluacion">
                                                        <span>Excelente</span>
                                                    </span>
                                                    @break
                                                @default
                                                    <span class="text-muted">Sin evaluar</span>
                                            @endswitch
                                        </td>	
                                        <td>
                                            {{ $servicio->asignadoPor? trim($servicio->asignadoPor->name . ' ' . ($servicio->asignadoPor->paterno ?? ''))
                                                    : 'No registrado'
                                                }}
                                        </td>
                                        </tr>
                                        @include('servicio.registroTecnico')
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                    <th>No</th>                                        
									<th >Fecha</th>
									<th >Nombre</th>
									<th >ci</th>
									<th >Dependencia</th>
									<th >Equipo</th>
									<th >Falla</th>
									<th >Tipo de Servicio</th>
									<th >tecnico</th>
                                    <th >FECHA DE ASIGNACIÓN</th>
                                    <th >FECHA DE ATENCION</th>
									<th >Estado</th>
									<th >Calificación</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- {!! $servicios->withQueryString()->links() !!} -->
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
$(document).on('click', '.btn-visto', function () {

    let boton = $(this);

    // Verificar el estado actual del botón
    let atendido = boton.hasClass('btn-primary');

    let titulo = atendido
        ? '¿Marcar como pendiente?'
        : '¿Marcar como atendido?';

    let texto = atendido
        ? 'La solicitud volverá al estado pendiente.'
        : 'La solicitud será marcada como atendida.';

    Swal.fire({
        title: titulo,
        text: texto,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Sí, continuar',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33'
    }).then((result) => {

        if (result.isConfirmed) {

            $.ajax({

                url: "{{ route('servicio.marcarVisto') }}",
                type: "POST",

                data: {
                    _token: "{{ csrf_token() }}",
                    id: boton.data("id")
                },

                success: function (respuesta) {

                    if (respuesta.visto == 1) {

                        boton.removeClass("btn-danger")
                             .addClass("btn-primary")
                             .text("ATENDIDO");

                    } else {

                        boton.removeClass("btn-primary")
                             .addClass("btn-danger")
                             .text("PENDIENTE");

                    }

                    Swal.fire({
                        icon: 'success',
                        title: 'Actualizado',
                        text: 'La solicitud fue actualizada correctamente.',
                        timer: 2500,
                        showConfirmButton: false
                    });

                }

            });

        }

    });

});
</script>

<link rel="stylesheet" href="{{ asset('estilos/filtros.css') }}">  

@stop