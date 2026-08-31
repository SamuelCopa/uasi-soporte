@extends('layouts.app')



@section('content_header')
    <div class="header-panel">
        <div class="header-left">
            <h1 class="header-title">
                Panel de control
            </h1>
            <div class="header-subtitle">
                Usuario:
                <strong>
                    {{ $user->name }}
                    {{ $user->paterno }}
                    {{ $user->materno }}
                </strong>
            </div>
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
@section('content')
{{-- ==========================================================
     FILTROS
========================================================== --}}
<div class="card shadow-sm mb-4">
    <div class="card-header bg-primary">
        <h5 class="mb-0 text-white">
            <i class="fas fa-filter mr-2"></i>
            Filtros del reporte
        </h5>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ url()->current() }}">
            <div class="row">
                {{-- ==================================================
                     AÑO
                =================================================== --}}
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="year">
                            <i class="fas fa-calendar-alt"></i>
                            Año
                        </label>
                        <select name="year"
                                id="year"
                                class="form-control">
                            @for(
                                $i = now()->year;
                                $i >= now()->year - 4;
                                $i--
                            )
                                <option value="{{ $i }}"
                                    {{ request('year', $year) == $i ? 'selected' : '' }}>
                                    {{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>
                </div>
                {{-- ==================================================
                     MES
                =================================================== --}}
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="month">
                            <i class="fas fa-calendar"></i>
                            Mes
                        </label>
                        <select name="month"
                                id="month"
                                class="form-control">
                            <option value="">
                                Todos los meses
                            </option>
                            @php
                                $meses = [
                                    1 => 'Enero',
                                    2 => 'Febrero',
                                    3 => 'Marzo',
                                    4 => 'Abril',
                                    5 => 'Mayo',
                                    6 => 'Junio',
                                    7 => 'Julio',
                                    8 => 'Agosto',
                                    9 => 'Septiembre',
                                    10 => 'Octubre',
                                    11 => 'Noviembre',
                                    12 => 'Diciembre',
                                ];
                            @endphp
                            @foreach($meses as $numero => $nombre)
                                <option value="{{ $numero }}"
                                    {{ request('month') == $numero ? 'selected' : '' }}>
                                    {{ $nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{-- ==================================================
                     EQUIPO
                =================================================== --}}
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="equipo">
                            <i class="fas fa-desktop"></i>
                            Equipo
                        </label>
                        <select name="equipo"
                                id="equipo"
                                class="form-control">
                            <option value="">
                                Todos los equipos
                            </option>
                            <option value="CPU"
                                {{ request('equipo') == 'CPU' ? 'selected' : '' }}>
                                CPU
                            </option>
                            <option value="Impresora"
                                {{ request('equipo') == 'Impresora' ? 'selected' : '' }}>
                                Impresora
                            </option>
                            <option value="Monitor"
                                {{ request('equipo') == 'Monitor' ? 'selected' : '' }}>
                                Monitor
                            </option>
                            <option value="Audifono"
                                {{ request('equipo') == 'Audifono' ? 'selected' : '' }}>
                                Audífono
                            </option>
                            <option value="Laptop"
                                {{ request('equipo') == 'Laptop' ? 'selected' : '' }}>
                                Laptop
                            </option>
                            <option value="Teclado"
                                {{ request('equipo') == 'Teclado' ? 'selected' : '' }}>
                                Teclado
                            </option>
                            <option value="Parlante"
                                {{ request('equipo') == 'Parlante' ? 'selected' : '' }}>
                                Parlante
                            </option>
                            <option value="Mouse"
                                {{ request('equipo') == 'Mouse' ? 'selected' : '' }}>
                                Mouse
                            </option>
                            <option value="UPS"
                                {{ request('equipo') == 'UPS' ? 'selected' : '' }}>
                                UPS
                            </option>
                            <option value="Estabilizador"
                                {{ request('equipo') == 'Estabilizador' ? 'selected' : '' }}>
                                Estabilizador
                            </option>
                            <option value="Otros"
                                {{ request('equipo') == 'Otros' ? 'selected' : '' }}>
                                Otros
                            </option>
                        </select>
                    </div>
                </div>
                {{-- ==================================================
                     RESULTADO
                =================================================== --}}
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="resultado">
                            <i class="fas fa-tasks"></i>
                            Resultado
                        </label>
                        <select name="resultado"
                                id="resultado"
                                class="form-control">
                            <option value="">
                                Todos
                            </option>
                            <option value="devolucion"
                                {{ request('resultado') == 'devolucion' ? 'selected' : '' }}>
                                Devolución
                            </option>
                            <option value="reposicion"
                                {{ request('resultado') == 'reposicion' ? 'selected' : '' }}>
                                Reposición
                            </option>
                            <option value="repliegue"
                                {{ request('resultado') == 'repliegue' ? 'selected' : '' }}>
                                Repliegue
                            </option>
                            <option value="custodio"
                                {{ request('resultado') == 'custodio' ? 'selected' : '' }}>
                                Custodio
                            </option>
                            <option value="baja"
                                {{ request('resultado') == 'baja' ? 'selected' : '' }}>
                                Baja
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            {{-- ======================================================
                 BOTONES
            ======================================================= --}}
            <div class="row">
                <div class="col-12 text-right">
                    {{-- BUSCAR --}}
                    <button type="submit"
                            class="btn-filtro btn-aplicar">
                        <i class="fas fa-search"></i>
                        Buscar
                    </button>
                    {{-- LIMPIAR --}}
                    <a href="{{ url()->current() }}"
                       class="btn-filtro btn-limpiar">
                        <i class="fas fa-sync-alt"></i>
                        Limpiar
                    </a>
                    {{-- PDF --}}
                    <a href="{{ route('resultado.reporte.pdf', request()->query()) }}"
                       target="_blank"
                       class="btn-filtro btn-pdf">
                        <i class="fas fa-file-pdf"></i>
                        Generar PDF
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
{{-- ==========================================================
     TABLA
========================================================== --}}
<div class="card shadow-sm">
    <div class="card-header bg-primary">
        <h5 class="mb-0 text-white">
            <i class="fas fa-table mr-2"></i>
            DETALLE POR ACTIVOS -
            GESTIÓN {{ $year }}
            @if(request('month'))
                -
                {{ $meses[(int) request('month')] ?? '' }}
            @endif
        </h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered text-center">
                <thead>
                    <tr>
                        <th>Equipo</th>
                        <th>Devolución</th>
                        <th>Reposición</th>
                        <th>Repliegue </th>
                        <th>Custodio</th>
                        <th>Baja</th>
                        <th>TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($detalle as $modelo => $datos)
                        @php
                            $totalFila = array_sum($datos);
                        @endphp
                        <tr>
                            <td class="font-weight-bold">{{ strtoupper($modelo) }}</td>
                            <td>{{ $datos['devolucion'] ?? 0 }}</td>
                            <td>{{ $datos['reposicion'] ?? 0 }}</td>
                            <td>{{ $datos['repliegue'] ?? 0 }}</td>
                            <td>{{ $datos['custodio'] ?? 0 }}</td>
                            <td>{{ $datos['baja'] ?? 0 }}</td>
                            <td class="font-weight-bold">{{ $totalFila }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7"
                                class="text-center">
                                <i class="fas fa-info-circle"></i>
                                No existen registros para los filtros seleccionados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                {{-- ==================================================
                     TOTAL GENERAL
                =================================================== --}}
                <tfoot>
                    <tr class="font-weight-bold">
                        <td>
                            TOTAL GENERAL
                        </td>
                        <td>
                            {{ $totales['devolucion'] ?? 0 }}
                        </td>
                        <td>
                            {{ $totales['reposicion'] ?? 0 }}
                        </td>
                        <td>
                            {{ $totales['repliegue'] ?? 0 }}
                        </td>
                        <td>
                            {{ $totales['custodio'] ?? 0 }}
                        </td>
                        <td>
                            {{ $totales['baja'] ?? 0 }}
                        </td>
                        <td>
                            {{ array_sum($totales) }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<link rel="stylesheet" href="{{ asset('estilos/filtros.css') }}">  
@stop