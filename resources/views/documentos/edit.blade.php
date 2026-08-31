@extends('layouts.app')

@section('content')

<div class="container">

    <div class="card">

        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-edit"></i>
                EDITAR DOCUMENTO
            </h3>
        </div>

        <div class="card-body">

            <form
                action="{{ route('documentos.update', $documento->id) }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf
                @method('PUT')


                {{-- TÍTULO --}}
                <div class="form-group mb-3">

                    <label for="titulo">
                        TÍTULO DEL DOCUMENTO
                    </label>

                    <input
                        type="text"
                        name="titulo"
                        id="titulo"
                        class="form-control @error('titulo') is-invalid @enderror"
                        value="{{ old('titulo', $documento->titulo) }}"
                        required
                    >

                    @error('titulo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- ARCHIVO ACTUAL --}}
                <div class="form-group mb-3">

                    <label>
                        DOCUMENTO ACTUAL
                    </label>

                    <div class="alert alert-info">

                        <i class="fas fa-file"></i>

                        {{ $documento->nombre_original }}

                    </div>

                </div>


                {{-- NUEVO ARCHIVO --}}
                <div class="form-group mb-3">

                    <label for="archivo">
                        REEMPLAZAR DOCUMENTO
                    </label>

                    <input
                        type="file"
                        name="archivo"
                        id="archivo"
                        class="form-control @error('archivo') is-invalid @enderror"
                        accept=".pdf,.doc,.docx"
                    >

                    <small class="text-muted">

                        Si no selecciona un archivo,
                        se conservará el documento actual.

                    </small>

                    @error('archivo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- BOTONES --}}
                <div class="mt-4">

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >

                        <i class="fas fa-save"></i>

                        ACTUALIZAR

                    </button>


                    <a href="{{ route('documentos.index') }}"
                        class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i>
                        CANCELAR
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection