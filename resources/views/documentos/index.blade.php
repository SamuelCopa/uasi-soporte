@extends('layouts.app')

@section('title', 'Documentos')

@section('content_header')

    <div class="d-flex justify-content-between align-items-center">

        <h1>
            DOCUMENTOS
        </h1>

        <a
            href="{{ route('documentos.create') }}"
            class="btn btn-primary"
        >
            <i class="fas fa-upload"></i>
            CARGAR DOCUMENTO
        </a>

    </div>

@stop

@section('content')

<div class="card">

    <div class="card-header">

        <h3 class="card-title">
            DOCUMENTOS DISPONIBLES
        </h3>

    </div>

    <div class="card-body">

        @if($documentos->count())

            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead>

                        <tr>
                            <th>#</th>
                            <th>DOCUMENTO</th>
                            <th>ARCHIVO</th>
                            <th>FECHA</th>
                            <th width="180">
                                ACCIONES
                            </th>
                        </tr>

                    </thead>

                    <tbody>

                        @foreach($documentos as $i => $documento)

                            <tr>

                                <td>
                                    {{ $i + 1 }}
                                </td>

                                <td>
                                    <strong>
                                        {{ $documento->titulo }}
                                    </strong>
                                </td>

                                <td>

                                    @if($documento->tipo === 'application/pdf')

                                        <i class="fas fa-file-pdf text-danger"></i>

                                    @elseif(
                                        in_array(
                                            $documento->tipo,
                                            [
                                                'application/msword',
                                                'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                                            ]
                                        )
                                    )

                                        <i class="fas fa-file-word text-primary"></i>

                                    @else

                                        <i class="fas fa-file"></i>

                                    @endif

                                    {{ $documento->nombre_original }}

                                </td>

                                <td>
                                    {{ $documento->created_at->format('d/m/Y') }}
                                </td>

                                <td>

<div class="flex gap-2">

    {{-- EDITAR --}}
    <a href="{{ route('documentos.edit', $documento->id) }}"
       class="btn btn-warning btn-sm"
       title="Editar documento">

        <i class="fas fa-edit"></i>

    </a>

    {{-- DESCARGAR --}}
    <a href="{{ route('documentos.descargar', $documento) }}"
       class="btn btn-primary btn-sm"
       title="Descargar">

        <i class="fas fa-download"></i>

    </a>

    {{-- ELIMINAR --}}
    <form action="{{ route('documentos.destroy', $documento->id) }}"
          method="POST"
          style="display:inline">

        @csrf
        @method('DELETE')

        <button type="submit"
                class="btn btn-danger btn-sm"
                onclick="return confirm('¿Está seguro de eliminar este documento?')"
                title="Eliminar">

            <i class="fas fa-trash"></i>

        </button>

    </form>

</div>
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="alert alert-info">

                <i class="fas fa-info-circle"></i>

                No existen documentos registrados.

            </div>

        @endif

    </div>

</div>

@stop