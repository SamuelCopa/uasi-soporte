@extends('layouts.app')

@section('content')

<div class="container-fluid">

@section('content_header')
    <div class="header-panel">
        <div class="header-left">
            <h1 class="header-title">
                    <h4 class="mb-0">
                        Reporte de equipos atendidos
                    </h4>
                    <small>
                        Consulta y seguimiento de equipos recepcionados
                    </small>
            </h1>
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
@stop
    {{-- FILTROS --}}
    <div class="filtros-servicios">
        <div class="filtros-header">
            <div class="filtros-titulo">
                <div class="filtros-icono">
                    <i class="fas fa-filter"></i>
                </div>
                <div>
                    <h5>Filtros de búsqueda</h5>
                    <span>
                        Seleccione los criterios para consultar los equipos ingresados
                    </span>
                </div>
            </div>
        </div>
        <form action="{{ route('equipos.reporte') }}"
              method="GET"
              class="filtros-form">
            <div class="row g-3">
                {{-- TIPO DE EQUIPO --}}
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                    <label class="filtro-label">
                        <i class="fas fa-desktop"></i>
                        Equipo
                    </label>
                    <div class="campo-filtro">
                        <i class="fas fa-computer campo-icono"></i>
                <select name="tipo_equipo"
                        class="form-control filtro-control">
                    <option value="">
                        Todos los equipos
                    </option>
                    @foreach($tiposEquipos as $tipo)
                        <option value="{{ $tipo }}"
                            {{ request('tipo_equipo') == $tipo ? 'selected' : '' }}>
                            {{ $tipo }}
                        </option>
                    @endforeach
                </select>
                    </div>
                </div>
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
                            @for($año = now()->year; $año >= 2026; $año--)
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
                {{-- DEPENDENCIA --}}
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                    <label class="filtro-label">
                        <i class="fas fa-building"></i>
                        Dependencia
                    </label>
                    <div class="campo-filtro">
                        <i class="fas fa-building campo-icono"></i>
                        <select name="dependencia"
                                class="form-control filtro-control">
                            <option value="">
                                Todas las dependencias
                            </option>
                            @foreach($dependencias as $dependencia)
                                <option value="{{ $dependencia->id }}"
                                    {{ request('dependencia') == $dependencia->id ? 'selected' : '' }}>
                                    {{ $dependencia->dependencias }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- CÓDIGO --}}
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                    <label class="filtro-label">
                        <i class="fas fa-barcode"></i>
                        Código del equipo
                    </label>
                    <div class="campo-filtro">
                        <i class="fas fa-barcode campo-icono"></i>
                        <input type="text"
                               name="codigo"
                               class="form-control filtro-control"
                               value="{{ request('codigo') }}"
                               placeholder="Ej. CPU-0001">
                    </div>
                </div>
            </div>
            {{-- BOTONES --}}

            <div class="filtros-acciones">
                <div class="col-12  text-right">
                    <button type="submit"
                            class="btn-filtro btn-aplicar">
                        <i class="fas fa-search"></i>
                        <span>Buscar</span>
                    </button>
                    <a href="{{ route('equipos.reporte') }}"
                    class="btn-filtro btn-limpiar">
                        <i class="fas fa-sync-alt"></i>
                        <span>Limpiar</span>
                    </a>
                    <a href="{{ route('equipos.reporte.pdf', request()->query()) }}"
                    target="_blank"
                    class="btn-filtro btn-pdf">
                        <i class="fas fa-file-pdf"></i>
                        <span>Generar PDF</span>
                    </a>
                </div>
            </div>
        </form>
    </div>

    {{-- RESULTADOS --}}
    @if(isset($equipos))
        <div class="card card-reporte">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-list"></i>
                    Resultados de la búsqueda
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table-modern table-striped table-hover table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>FECHA</th>
                                <th>TIPO DE EQUIPO</th>
                                <th>CÓDIGO</th>
                                <th>FUNCIONARIO</th>
                                <th>C.I.</th>
                                <th>DEPENDENCIA</th>
                                <th>N° RECEPCIÓN</th>
                                <th>TÉCNICO</th>
                                <th>ESTADO</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($equipos as $equipo)
                                <tr>
                                    <td class="text-center">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="text-center">
                                        {{ $equipo->fecha
                                            ? date('d-m-Y', strtotime($equipo->fecha))
                                            : '-' }}
                                    </td>
                                    <td>
                        @if($equipo->tipo_equipo === 'OTRO EQUIPO')
                            {{ $equipo->tipoEquipo?->nombre
                                ?? 'OTRO EQUIPO' }}
                        @else
                            {{ $equipo->tipo_equipo }}
                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ $equipo->cod_gamea ?? '-' }}
                                    </td>
                                    <td>
                                        {{ $equipo->funcionario?->nombre }}
                                        {{ $equipo->funcionario?->paterno }}
                                        {{ $equipo->funcionario?->materno }}
                                    </td>
                                    <td>
                                        {{ $equipo->funcionario?->ci }}
                                        {{ $equipo->funcionario?->expedido }}
                                    </td>
                                    <td>
                                        {{ $equipo->Dependencia?->dependencias
                                            ?? 'SIN DEPENDENCIA' }}
                                    </td>
                                    <td class="text-center">
                                        {{ $equipo->cod_registro ?? '-' }}
                                    </td>
                                    <td>
                                        {{ $equipo->user?->name }}
                                        {{ $equipo->user?->paterno }}
                                        {{ $equipo->user?->materno }}
                                    </td>
                                    <td class="text-center">
                                    @if($equipo->fecha_entrega)
                                        {{ $equipo->resultado?->nombre }}<br>
                                        {{ date('d-m-Y', strtotime($equipo->fecha_entrega)) }}
                                    @else
                                        {{ $equipo->estado?->nombre }}
                                    @endif	
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10"
                                        class="text-center">
                                        No se encontraron registros.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>
<link rel="stylesheet" href="{{ asset('estilos/filtros.css') }}">  
@endsection