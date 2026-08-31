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
    action="{{ route('documentos.store') }}"
    method="POST"
    enctype="multipart/form-data"
>
    @csrf

    <input
        type="text"
        name="titulo"
        class="form-control"
        required
    >

    <input
        type="file"
        name="archivo"
        class="form-control"
        accept=".pdf,.doc,.docx"
        required
    >

    @error('archivo')
        <div class="text-danger mt-2">
            {{ $message }}
        </div>
    @enderror

    <button type="submit" class="btn btn-primary">
        SUBIR
    </button>

</form>

</div>

@stop