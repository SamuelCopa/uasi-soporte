@extends('layouts.app')

@section('title', 'Historial de Equipo')

@section('content_header')

    <div class="header-institucional">

        <div>
            <h1>
                <i class="fas fa-history mr-2"></i>
                Historial del Equipo
            </h1>

            <span>
                Consulta y seguimiento de servicios y mantenimientos
            </span>
        </div>

    </div>

@stop


@section('content')

<div class="container-fluid">

    {{-- =====================================================
        BUSCADOR
    ====================================================== --}}

    <div class="card card-institucional mb-4">

        <div class="card-header">

            <h3 class="card-title">
                <i class="fas fa-search mr-2"></i>
                Consulta por Código GAMEA
            </h3>

        </div>

        <div class="card-body">

            <form action="{{ route('servicios.historial') }}" method="GET">

                <div class="row align-items-end">

                    <div class="col-md-8">

                        <label for="cod_gamea">
                            Código del activo
                        </label>

                        <div class="input-group">

                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-barcode"></i>
                                </span>
                            </div>

                            <input
                                type="text"
                                name="cod_gamea"
                                id="cod_gamea"
                                class="form-control"
                                value="{{ $codigo }}"
                                placeholder="Ingrese el código GAMEA"
                                autocomplete="off"
                            >

                        </div>

                    </div>

<div class="col-md-4 mt-3 mt-md-0">

    <div class="d-flex">

        <button type="submit" class="btn btn-consultar mr-2">
            <i class="fas fa-search mr-1"></i>
            Consultar
        </button>

        <a href="{{ route('servicios.historial') }}" class="btn btn-limpiar">
            <i class="fas fa-eraser mr-1"></i>
            Limpiar
        </a>

    </div>

</div>

                </div>

            </form>

        </div>

    </div>


    {{-- =====================================================
        SIN RESULTADOS
    ====================================================== --}}

    @if($codigo && !$equipo && $historial->isEmpty())

        <div class="alert alert-institucional">

            <i class="fas fa-info-circle mr-2"></i>

            No se encontraron registros asociados al código
            <strong>{{ $codigo }}</strong>.

        </div>

    @endif


    @if($equipo)


        {{-- =================================================
            INFORMACIÓN DEL EQUIPO
        ================================================== --}}

        <div class="card card-institucional mb-4">

            <div class="card-header">

                <h3 class="card-title">
                    <i class="fas fa-desktop mr-2"></i>
                    Información del activo
                </h3>

            </div>
                    <div class="d-flex justify-content-end mb-3">

        <a href="{{ route('servicios.historial.pdf', ['cod_gamea' => $codigo]) }}"
           target="_blank"
           class="btn btn-pdf">
            <i class="fas fa-file-pdf mr-1"></i>
            Generar PDF
        </a>

    </div>

<div class="card-body">

    <div class="row">

        @if(
            strtoupper(trim($equipo['tipo'] ?? '')) === 'CPU' ||
            strtoupper(trim($equipo['tipo'] ?? '')) === 'C.P.U.'
        )

            <div class="col-md-6">
                <div class="dato-equipo">
                    <span>Código GAMEA</span>
                    <strong>
                        {{ $equipo['cod_gamea'] ?? '-' }}
                    </strong>
                </div>
            </div>

            <div class="col-md-6">
                <div class="dato-equipo">
                    <span>Tipo de equipo</span>
                    <strong>
                        {{ $equipo['tipo'] ?? '-' }}
                    </strong>
                </div>
            </div>

        @else

            <div class="col-md-3">
                <div class="dato-equipo">
                    <span>Código GAMEA</span>
                    <strong>
                        {{ $equipo['cod_gamea'] ?? '-' }}
                    </strong>
                </div>
            </div>

            <div class="col-md-3">
                <div class="dato-equipo">
                    <span>Tipo de equipo</span>
                    <strong>
                        {{ $equipo['tipo'] ?? '-' }}
                    </strong>
                </div>
            </div>

            <div class="col-md-3">
                <div class="dato-equipo">
                    <span>Marca</span>
                    <strong>
                        {{ $equipo['marca'] ?: '-' }}
                    </strong>
                </div>
            </div>

            <div class="col-md-3">
                <div class="dato-equipo">
                    <span>Modelo</span>
                    <strong>
                        {{ $equipo['modelo'] ?: '-' }}
                    </strong>
                </div>
            </div>

        @endif

    </div>

</div>


        {{-- =================================================
            RESUMEN
        ================================================== --}}

        <div class="row mb-4">

            {{-- OFICINA --}}
            <div class="col-lg-4 col-md-6 mb-3">

                <div class="resumen-card">

                    <div class="resumen-icon">
                        <i class="fas fa-building"></i>
                    </div>

                    <div class="resumen-info">

                        <span>Servicios en oficina</span>

                        <strong>
                            {{ $totalOficina }}
                        </strong>

                    </div>

                </div>

            </div>


            {{-- TALLER --}}
            <div class="col-lg-4 col-md-6 mb-3">

                <div class="resumen-card">

                    <div class="resumen-icon">
                        <i class="fas fa-tools"></i>
                    </div>

                    <div class="resumen-info">

                        <span>Ingresos a taller</span>

                        <strong>
                            {{ $totalTaller }}
                        </strong>

                    </div>

                </div>

            </div>


            {{-- TOTAL --}}
            <div class="col-lg-4 col-md-6 mb-3">

                <div class="resumen-card resumen-total">

                    <div class="resumen-icon">
                        <i class="fas fa-clipboard-list"></i>
                    </div>

                    <div class="resumen-info">

                        <span>Total de atenciones</span>

                        <strong>
                            {{ $totalAtenciones }}
                        </strong>

                    </div>

                </div>

            </div>

        </div>


        {{-- =================================================
            FECHAS
        ================================================== --}}

        @if($historial->isNotEmpty())

            <div class="card card-institucional mb-4">

                <div class="card-header">

                    <h3 class="card-title">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        Resumen de atención
                    </h3>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6">

                            <div class="fecha-resumen">

                                <span>Primera atención registrada</span>

                                <strong>

                                    @if($primeraAtencion && $primeraAtencion['fecha'])

                                        {{ \Carbon\Carbon::parse($primeraAtencion['fecha'])->format('d/m/Y') }}

                                    @else
                                        -
                                    @endif

                                </strong>

                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="fecha-resumen">

                                <span>Última atención registrada</span>

                                <strong>

                                    @if($ultimaAtencion && $ultimaAtencion['fecha'])

                                        {{ \Carbon\Carbon::parse($ultimaAtencion['fecha'])->format('d/m/Y') }}

                                    @else
                                        -
                                    @endif

                                </strong>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        @endif


        {{-- =================================================
            HISTORIAL
        ================================================== --}}

        <div class="card card-institucional">

            <div class="card-header">

                <h3 class="card-title">
                    <i class="fas fa-list mr-2"></i>
                    Historial de atenciones
                </h3>

                <div class="card-tools">

                    <span class="badge badge-total">
                        {{ $totalAtenciones }} registros
                    </span>

                </div>

            </div>


            <div class="card-body p-0">

                @if($historial->isNotEmpty())

                    <div class="table-responsive">

                        <table class="table table-hover tabla-historial mb-0">

                            <thead>

                                <tr>

                                    <th>FECHA</th>

                                    <th>LUGAR</th>

                                    <th>TIPO</th>

                                    <th>EQUIPO</th>

                                    <th>FALLA / MOTIVO</th>

                                    <th>INICIO</th>

                                    <th>ENTREGA</th>

                                    <th>RESULTADO</th>

                                    <th>OBSERVACIONES</th>

                                </tr>

                            </thead>


                            <tbody>

                                @foreach($historial as $item)

                                    <tr>

                                        {{-- FECHA --}}
                                        <td class="fecha-columna">

                                            @if($item['fecha'])

                                                {{ \Carbon\Carbon::parse($item['fecha'])->format('d/m/Y') }}

                                            @else
                                                -
                                            @endif

                                        </td>


                                        {{-- LUGAR --}}
                                        <td>

                                            @if($item['lugar'] === 'Oficina')

                                                <span class="badge badge-oficina">
                                                    <i class="fas fa-building mr-1"></i>
                                                    Oficina
                                                </span>

                                            @else

                                                <span class="badge badge-taller">
                                                    <i class="fas fa-tools mr-1"></i>
                                                    Taller
                                                </span>

                                            @endif

                                        </td>


                                        {{-- TIPO --}}
                                        <td>

                                            <span class="tipo-atencion">
                                                {{ $item['tipo'] }}
                                            </span>

                                        </td>


                                        {{-- EQUIPO --}}
                                        <td>

                                            <strong class="nombre-equipo">
                                                {{ $item['equipo'] ?? 'Equipo' }}
                                            </strong>

                                        </td>


                                        {{-- FALLA --}}
                                        <td>

                                            {{ $item['falla'] ?: '-' }}

                                        </td>


                                        {{-- INICIO --}}
                                        <td>

                                            @if($item['fecha_inicio'])

                                                {{ \Carbon\Carbon::parse($item['fecha_inicio'])->format('d/m/Y') }}

                                            @else
                                                -
                                            @endif

                                        </td>


                                        {{-- ENTREGA --}}
                                        <td>

                                            @if($item['fecha_entrega'])

                                                {{ \Carbon\Carbon::parse($item['fecha_entrega'])->format('d/m/Y') }}

                                            @else
                                                -
                                            @endif

                                        </td>


                                        {{-- RESULTADO --}}
<td class="text-center">
    @if(!empty($item['resultado']))
        <span class="resultado-badge">
            {{ $item['resultado'] }}
        </span>
    @else
        <span class="text-muted">-</span>
    @endif
</td>


                                        {{-- OBSERVACIONES --}}
                                        <td>

                                            {{ $item['observaciones'] ?: '-' }}

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    <div class="sin-registros">

                        <i class="fas fa-folder-open"></i>

                        <h5>No existen atenciones registradas</h5>

                        <p>
                            No se encontraron servicios o mantenimientos
                            para este activo.
                        </p>

                    </div>

                @endif

            </div>

        </div>

    @endif

</div>

@stop


@section('css')

<style>

/* =========================================================
   CABECERA INSTITUCIONAL
   ========================================================= */

.header-institucional {
    background: #ffffff;
    border-left: 5px solid #1e3a5f;
    padding: 16px 20px;
    margin-bottom: 20px;
    border-radius: 4px;
    box-shadow: 0 1px 4px rgba(0,0,0,.08);
}

.header-institucional h1 {
    font-size: 22px;
    font-weight: 600;
    color: #1e3a5f;
    margin: 0;
}

.header-institucional span {
    display: block;
    margin-top: 4px;
    color: #6c757d;
    font-size: 13px;
}


/* =========================================================
   TARJETAS
   ========================================================= */

.card-institucional {
    border: 1px solid #dfe4ea;
    border-radius: 5px;
    box-shadow: 0 1px 4px rgba(0,0,0,.06);
}

.card-institucional .card-header {
    background: #f7f9fb;
    border-bottom: 1px solid #dfe4ea;
    padding: 12px 16px;
}

.card-institucional .card-title {
    color: #1e3a5f;
    font-size: 15px;
    font-weight: 600;
}


/* =========================================================
   BUSCADOR
   ========================================================= */

.card-institucional label {
    font-size: 13px;
    font-weight: 600;
    color: #495057;
}

.card-institucional .form-control {
    height: 40px;
    border-color: #ced4da;
}

.card-institucional .input-group-text {
    background: #f4f6f8;
    border-color: #ced4da;
    color: #1e3a5f;
}

.btn-consultar {
    width: 100%;
    height: 40px;
    background: #1e3a5f;
    border: 1px solid #1e3a5f;
    color: #fff;
    font-weight: 500;
    border-radius: 4px;
}

.btn-consultar:hover {
    background: #162d4a;
    color: #fff;
}


/* =========================================================
   ALERTA
   ========================================================= */

.alert-institucional {
    background: #f4f7fa;
    border: 1px solid #cbd5df;
    border-left: 4px solid #1e3a5f;
    color: #495057;
}


/* =========================================================
   INFORMACIÓN DEL EQUIPO
   ========================================================= */

.dato-equipo {
    padding: 10px 12px;
    border-left: 3px solid #1e3a5f;
    background: #f8f9fa;
    margin-bottom: 5px;
}

.dato-equipo span {
    display: block;
    font-size: 11px;
    text-transform: uppercase;
    color: #7a828a;
    font-weight: 600;
    margin-bottom: 3px;
}

.dato-equipo strong {
    display: block;
    font-size: 14px;
    color: #343a40;
}


/* =========================================================
   RESUMEN
   ========================================================= */

.resumen-card {
    display: flex;
    align-items: center;
    min-height: 90px;
    background: #ffffff;
    border: 1px solid #dfe4ea;
    border-left: 4px solid #1e3a5f;
    border-radius: 5px;
    padding: 15px;
    box-shadow: 0 1px 4px rgba(0,0,0,.05);
}

.resumen-total {
    border-left-color: #495057;
}

.resumen-icon {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #eef2f6;
    color: #1e3a5f;
    border-radius: 4px;
    font-size: 20px;
    margin-right: 15px;
}

.resumen-info span {
    display: block;
    font-size: 12px;
    color: #6c757d;
}

.resumen-info strong {
    display: block;
    color: #1e3a5f;
    font-size: 25px;
    line-height: 1.2;
}


/* =========================================================
   FECHAS
   ========================================================= */

.fecha-resumen {
    background: #f8f9fa;
    border: 1px solid #e1e5e9;
    padding: 12px 15px;
    border-radius: 4px;
    margin-bottom: 5px;
}

.fecha-resumen span {
    display: block;
    font-size: 11px;
    color: #777;
    text-transform: uppercase;
    font-weight: 600;
}

.fecha-resumen strong {
    color: #1e3a5f;
    font-size: 15px;
}


.btn-pdf {
    height: 40px;
    background: #1e3a5f;
    border: 1px solid #1e3a5f;
    color: #ffffff;
    font-weight: 500;
    border-radius: 4px;
    padding: 8px 16px;
}

.btn-pdf:hover {
    background: #162d49;
    border-color: #162d49;
    color: #ffffff;
}

/* =========================================================
   TABLA
   ========================================================= */

.tabla-historial {
    font-size: 13px;
}

.tabla-historial thead th {
    background: #1e3a5f;
    color: #ffffff;
    border: 0;
    font-size: 11px;
    font-weight: 600;
    white-space: nowrap;
    padding: 11px 10px;
    vertical-align: middle;
}

.tabla-historial tbody td {
    vertical-align: middle;
    padding: 10px;
    border-top: 1px solid #e9ecef;
    color: #495057;
}

.tabla-historial tbody tr:hover {
    background: #f7f9fb;
}

.fecha-columna {
    white-space: nowrap;
    color: #495057 !important;
    font-weight: 500;
}

.nombre-equipo {
    color: #1e3a5f;
    white-space: nowrap;
}

.tipo-atencion {
    color: #495057;
    font-weight: 500;
}


/* =========================================================
   BADGES
   ========================================================= */

.badge-oficina {
    background: #e8eef5;
    color: #1e3a5f;
    border: 1px solid #ccd8e5;
    font-weight: 500;
    padding: 6px 8px;
}

.badge-taller {
    background: #f2eee5;
    color: #705d35;
    border: 1px solid #ded3bc;
    font-weight: 500;
    padding: 6px 8px;
}

.badge-total {
    background: #e9edf1;
    color: #495057;
    border: 1px solid #d5dbe0;
    font-weight: 500;
    padding: 6px 9px;
}

.resultado {
    color: #495057;
    font-size: 12px;
}


/* =========================================================
   SIN REGISTROS
   ========================================================= */

.sin-registros {
    text-align: center;
    padding: 50px 20px;
    color: #6c757d;
}

.sin-registros i {
    font-size: 38px;
    color: #adb5bd;
    margin-bottom: 12px;
}

.sin-registros h5 {
    color: #495057;
    font-weight: 600;
}

.sin-registros p {
    margin-bottom: 0;
    font-size: 13px;
}

.btn-limpiar {
    height: 40px;
    background: #ffffff;
    border: 1px solid #adb5bd;
    color: #495057;
    font-weight: 500;
    border-radius: 4px;
    padding: 8px 16px;
    white-space: nowrap;
}

.btn-limpiar:hover {
    background: #f1f3f5;
    border-color: #6c757d;
    color: #343a40;
}

.resultado-badge {
    display: inline-block;
    padding: 5px 10px;
    border: 1px solid #1e3a5f;
    border-radius: 4px;
    background: #f1f5f9;
    color: #1e3a5f;
    font-size: 12px;
    font-weight: 600;
    letter-spacing: .2px;
}
/* =========================================================
   RESPONSIVE
   ========================================================= */

@media (max-width: 768px) {

    .header-institucional h1 {
        font-size: 19px;
    }

    .resumen-card {
        min-height: 80px;
    }

    .tabla-historial {
        min-width: 1100px;
    }
}

</style>

@stop