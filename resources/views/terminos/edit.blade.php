@extends('layouts.app')

@section('title', 'Términos y Condiciones')

@section('content_header')

    <h1>
        TÉRMINOS Y CONDICIONES
    </h1>

@stop

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">
            EDITAR TÉRMINOS Y CONDICIONES
        </h3>
    </div>

    <form
        action="{{ route('terminos.update') }}"
        method="POST"
    >
        @csrf
        @method('PUT')

        <div class="card-body">

            {{-- Título --}}
            <div class="form-group mb-3">
                <label for="titulo">
                    TÍTULO
                </label>

                <input
                    type="text"
                    id="titulo"
                    name="titulo"
                    class="form-control"
                    value="{{ old('titulo', $termino->titulo ?? '') }}"
                    required
                >

                @error('titulo')
                    <div class="text-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Contenido --}}
            <div class="form-group mb-3">
                <label for="contenido">
                    CONTENIDO
                </label>

                <textarea
                    id="contenido"
                    name="contenido"
                    class="form-control"
                    rows="15"
                    required
                >{{ old('contenido', $termino->contenido ?? '') }}</textarea>

                @error('contenido')
                    <div class="text-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

        </div>

        <div class="card-footer">

            <button
                type="submit"
                class="btn btn-primary"
            >
                <i class="fas fa-save"></i>
                ACTUALIZAR
            </button>

        </div>

    </form>

</div>

@stop
```
