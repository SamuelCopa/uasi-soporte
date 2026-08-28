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
                            <h1 class="header-title">Requerimientos de Servicios</h1>
                        </div>
                    </div>

                    <div class="filtros-servicios">
                        <div class="filtros-header">
                            <div class="filtros-titulo">
                                <div class="filtros-icono">
                                    <i class="fas fa-filter"></i>
                                </div>
                                <div>
                                    <h5>Filtros de servicios</h5>
                                    <span>Seleccione los criterios para consultar los registros</span>
                                </div>
                            </div>
                        </div>
 <div>
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
                                        <select name="year" class="form-control filtro-control">
                                            <option value="">Todos los años</option>
                                            @for($año = date('Y'); $año >= 2020; $año--)
                                                <option value="{{ $año }}"
                                                    {{ request('year') == $año ? 'selected' : '' }}>
                                                    {{ $año }}
                                                </option>
                                            @endfor
                                        </select>
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
                                        <select name="estado" class="form-control filtro-control">
                                            <option value="">Todos</option>
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
                                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                                    <label class="filtro-label">
                                        <i class="fas fa-user-cog"></i>
                                        Técnico
                                    </label>
                                    <div class="campo-filtro">
                                        <i class="fas fa-user campo-icono"></i>
                                        <select name="tecnico" class="form-control filtro-control">
                                            <option value="">Todos los técnicos</option>
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
                                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                                    <label class="filtro-label">
                                        <i class="fas fa-building"></i>
                                        Dependencia
                                    </label>
                                    <div class="campo-filtro">
                                        <i class="fas fa-building campo-icono"></i>
                                        <select name="dependencia"
                                                id="dependencia"
                                                class="form-control filtro-control">

                                            <option value="">Todas las dependencias</option>

                                            @foreach($dependencias as $dependencia)

                                                <option value="{{ $dependencia->id }}"
                                                    {{ request('dependencia') == $dependencia->id ? 'selected' : '' }}>

                                                    {{ $dependencia->dependencias }}

                                                </option>

                                            @endforeach

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
                                        <input
                                            type="date"
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
                                        <input
                                            type="date"
                                            name="fecha_hasta"
                                            class="form-control filtro-control"
                                            value="{{ request('fecha_hasta') }}">
                                    </div>
                                </div>
                            </div>
                            {{-- BOTONES --}}
                            <div class="filtros-acciones">
                                <button type="submit"
                                        class="btn-filtro btn-aplicar">
                                    <i class="fas fa-search"></i>
                                    <span>Aplicar filtros</span>
                                </button>
                                <a href="{{ route('servicios.index') }}"
                                class="btn-filtro btn-limpiar">
                                    <i class="fas fa-rotate-right"></i>
                                    <span>Limpiar</span>
                                </a>
                                <a href="{{ route('servicio.reporte.pdf', request()->query()) }}"
                                target="_blank"
                                class="btn-filtro btn-pdf">
                                    <i class="fas fa-file-pdf"></i>
                                    <span>Generar PDF</span>
                                </a>
                            </div>
                        </form>
 </div>
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

<style>
    /* =========================================================
   PANEL DE FILTROS - SERVICIOS
   ========================================================= */

.filtros-servicios {
    background: #ffffff;
    border: 1px solid #e6eaf0;
    border-radius: 14px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.06);
    overflow: hidden;
    margin-bottom: 20px;
}


/* ENCABEZADO */

.filtros-header {

    padding: 15px 20px;

}


.filtros-titulo {
    display: flex;
    align-items: center;
    gap: 12px;
}


.filtros-icono {
    width: 40px;
    height: 40px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: rgba(255, 255, 255, 0.16);

    border-radius: 10px;

    font-size: 17px;
}


.filtros-titulo h5 {
    margin: 0;

    font-size: 16px;
    font-weight: 600;

    letter-spacing: 0.2px;
}


.filtros-titulo span {
    display: block;

    margin-top: 2px;

    font-size: 12px;

    opacity: 0.85;
}


/* FORMULARIO */

.filtros-form {
    padding: 20px;
}


/* LABEL */

.filtro-label {
    display: block;

    margin-bottom: 7px;

    color: #344054;

    font-size: 12px;

    font-weight: 600;

    text-transform: uppercase;

    letter-spacing: 0.3px;
}


.filtro-label i {
    margin-right: 5px;

    color: #0052cc;
}


/* CONTENEDOR DEL CAMPO */

.campo-filtro {
    position: relative;
}


.campo-icono {
    position: absolute;

    left: 12px;

    top: 50%;

    transform: translateY(-50%);

    color: #667085;

    font-size: 13px;

    z-index: 2;

    pointer-events: none;
}


/* INPUT Y SELECT */

.filtro-control {
    height: 42px;

    padding-left: 36px;

    border: 1px solid #d9dee7;

    border-radius: 9px;

    background-color: #f9fafb;

    color: #344054;

    font-size: 13px;

    transition:
        border-color 0.2s ease,
        box-shadow 0.2s ease,
        background-color 0.2s ease;
}


.filtro-control:hover {
    background-color: #ffffff;
}


.filtro-control:focus {
    background-color: #ffffff;

    border-color: #2684ff;

    box-shadow: 0 0 0 3px rgba(38, 132, 255, 0.12);

    outline: none;
}


/* ACCIONES */

.filtros-acciones {
    display: flex;

    align-items: center;

    gap: 10px;

    margin-top: 20px;

    padding-top: 16px;

    border-top: 1px solid #edf0f4;
}


/* BOTONES */

.btn-filtro {
    min-height: 40px;

    padding: 0 17px;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 7px;

    border: none;

    border-radius: 8px;

    font-size: 13px;

    font-weight: 600;

    text-decoration: none;

    cursor: pointer;

    transition:
        transform 0.15s ease,
        box-shadow 0.2s ease,
        background-color 0.2s ease;
}


.btn-filtro:hover {
    transform: translateY(-1px);

    text-decoration: none;
}


.btn-filtro i {
    font-size: 13px;
}


/* APLICAR */

.btn-aplicar {
    background: linear-gradient(
        135deg,
        #0052cc,
        #2684ff
    );

    color: #ffffff;

    box-shadow: 0 3px 8px rgba(0, 82, 204, 0.22);
}


.btn-aplicar:hover {
    color: #ffffff;

    box-shadow: 0 5px 13px rgba(0, 82, 204, 0.28);
}


/* LIMPIAR */

.btn-limpiar {
    background: #f2f4f7;

    color: #475467;

    border: 1px solid #e4e7ec;
}


.btn-limpiar:hover {
    background: #e9ecf1;

    color: #344054;
}


/* PDF */

.btn-pdf {
    margin-left: auto;

    background: #dc3545;

    color: #ffffff;

    box-shadow: 0 3px 8px rgba(220, 53, 69, 0.20);
}


.btn-pdf:hover {
    background: #c82333;

    color: #ffffff;

    box-shadow: 0 5px 13px rgba(220, 53, 69, 0.28);
}


/* RESPONSIVE */

@media (max-width: 768px) {

    .filtros-form {
        padding: 15px;
    }

    .filtros-acciones {
        flex-wrap: wrap;
    }

    .btn-filtro {
        flex: 1;
    }

    .btn-pdf {
        margin-left: 0;
    }

}


@media (max-width: 480px) {

    .filtros-acciones {
        flex-direction: column;
        align-items: stretch;
    }

    .btn-filtro {
        width: 100%;
    }

}
</style>

@stop