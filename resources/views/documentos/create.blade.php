@extends('layouts.app')

@section('title', 'Cargar Documento')

@section('content_header')

    <h1>
        CARGAR DOCUMENTO
    </h1>

@stop

@section('content')

<div class="card">

    <div class="card-header">

        <h3 class="card-title">
            NUEVO DOCUMENTO
        </h3>

    </div>

    <form
        action="{{ route('documentos.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf

        <div class="card-body">

            <div class="form-group mb-3">

                <label for="titulo">
                    NOMBRE DEL DOCUMENTO
                </label>

                <input
                    type="text"
                    name="titulo"
                    id="titulo"
                    class="form-control"
                    value="{{ old('titulo') }}"
                    placeholder="Ej. Reglamento de soporte técnico"
                    required
                >

            </div>


            <div class="form-group">

                <label for="archivo">
                    DOCUMENTO
                </label>

                <input
                    type="file"
                    name="archivo"
                    id="archivo"
                    class="form-control"
                    accept=".pdf,.doc,.docx"
                    required
                >

                <small class="form-text text-muted">
                    Formatos permitidos: PDF, DOC y DOCX.
                    Tamaño máximo: 10 MB.
                </small>

            </div>

        </div>

        <div class="card-footer">

            <button
                type="submit"
                class="btn btn-primary"
            >

                <i class="fas fa-upload"></i>

                CARGAR DOCUMENTO

            </button>
                    <a href="{{ route('documentos.index') }}"
                        class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i>
                        CANCELAR
                    </a>

        </div>

    </form>

</div>

@stop