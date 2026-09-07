@extends('layouts.app')

@section('title', 'Especialidades')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0">
                <i class="fas fa-tools text-primary"></i>
                ESPECIALIDADES
            </h1>
            <small class="text-muted">
                Administración de especialidades de técnicos
            </small>
        </div>

        <button type="button"
                class="btn btn-primary shadow-sm"
                data-toggle="modal"
                data-target="#modalCrearEspecialidad">
            <i class="fas fa-plus"></i>
            NUEVA ESPECIALIDAD
        </button>
    </div>
@stop

@section('content')

<div class="container-fluid">

    {{-- MENSAJES --}}
    @if(session('success'))
        <div class="alert alert-{{ session('icono', 'success') }} alert-dismissible fade show shadow-sm"
             role="alert">
            <i class="fas fa-info-circle"></i>
            <strong>{{ session('success') }}</strong>

            <button type="button"
                    class="close"
                    data-dismiss="alert"
                    aria-label="Cerrar">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif


    {{-- =========================================================
         TABLA DE ESPECIALIDADES
         ========================================================= --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white border-0 py-3">
            <div class="d-flex align-items-center">

                <div class="mr-3">
                    <span class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary text-white"
                          style="width:42px;height:42px;">
                        <i class="fas fa-tools"></i>
                    </span>
                </div>

                <div>
                    <h5 class="mb-0 font-weight-bold">
                        CATÁLOGO DE ESPECIALIDADES
                    </h5>

                    <small class="text-muted">
                        Especialidades disponibles para los técnicos
                    </small>
                </div>

            </div>
        </div>


        <div class="card-body">

            <div class="table-responsive">

                <table id="tablaEspecialidades"
                       class="table table-hover align-middle">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>CÓDIGO</th>
                            <th>ESPECIALIDAD</th>
                            <th>DESCRIPCIÓN</th>
                            <th>TÉCNICOS</th>
                            <th>ESTADO</th>
                            <th class="text-center">ACCIONES</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($especialidades as $especialidad)

                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td>
                                    <span class="badge badge-secondary">
                                        {{ $especialidad->codigo }}
                                    </span>
                                </td>

                                <td>
                                    <strong>
                                        <i class="fas fa-tools text-primary"></i>
                                        {{ $especialidad->nombre }}
                                    </strong>
                                </td>

                                <td>
                                    {{ $especialidad->descripcion ?: 'SIN DESCRIPCIÓN' }}
                                </td>

                                <td>
                                    <span class="badge badge-info">
                                        <i class="fas fa-users"></i>
                                        {{ $especialidad->usuarios_count }}
                                    </span>
                                </td>

                                <td>

                                    @if($especialidad->activo)

                                        <span class="badge badge-success">
                                            <i class="fas fa-check-circle"></i>
                                            ACTIVO
                                        </span>

                                    @else

                                        <span class="badge badge-secondary">
                                            <i class="fas fa-times-circle"></i>
                                            INACTIVO
                                        </span>

                                    @endif

                                </td>

                                <td class="text-center">

                                    {{-- EDITAR --}}
                                    <button type="button"
                                            class="btn btn-sm btn-outline-primary"
                                            data-toggle="modal"
                                            data-target="#modalEditarEspecialidad{{ $especialidad->id }}"
                                            title="Editar">

                                        <i class="fas fa-edit"></i>

                                    </button>


                                    {{-- ELIMINAR --}}
                                    @if($especialidad->usuarios_count == 0)

                                        <form action="{{ route('especialidades.destroy', $especialidad->id) }}"
                                              method="POST"
                                              class="d-inline formulario-eliminar">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger"
                                                    title="Eliminar">

                                                <i class="fas fa-trash"></i>

                                            </button>

                                        </form>

                                    @else

                                        <button type="button"
                                                class="btn btn-sm btn-outline-secondary"
                                                title="Tiene técnicos asignados"
                                                disabled>

                                            <i class="fas fa-lock"></i>

                                        </button>

                                    @endif

                                </td>

                            </tr>


                            {{-- =================================================
                                 MODAL EDITAR
                                 ================================================= --}}
                            <div class="modal fade"
                                 id="modalEditarEspecialidad{{ $especialidad->id }}"
                                 tabindex="-1"
                                 role="dialog"
                                 aria-hidden="true">

                                <div class="modal-dialog modal-lg modal-dialog-centered">

                                    <div class="modal-content modal-password">

                                        <div class="modal-header modal-password-header">

                                            <div>
                                                <h4 class="modal-title mb-1">
                                                    <i class="fas fa-edit"></i>
                                                    EDITAR ESPECIALIDAD
                                                </h4>

                                                <small>
                                                    Actualización de información
                                                </small>
                                            </div>

                                            <button type="button"
                                                    class="close text-white"
                                                    data-dismiss="modal">
                                                &times;
                                            </button>

                                        </div>


                                        <form method="POST"
                                              action="{{ route('especialidades.update', $especialidad->id) }}">

                                            @csrf
                                            @method('PUT')

                                            <div class="modal-body modal-password-body">

                                                <div class="registro-section">

                                                    <div class="registro-section-title">
                                                        <i class="fas fa-tools"></i>
                                                        DATOS DE LA ESPECIALIDAD
                                                    </div>


                                                    <div class="row">

                                                        {{-- CÓDIGO --}}
                                                        <div class="col-md-4">

                                                            <div class="registro-field">

                                                                <label>
                                                                    <i class="fas fa-code"></i>
                                                                    CÓDIGO
                                                                    <span class="required">*</span>
                                                                </label>

                                                                <input type="text"
                                                                       name="codigo"
                                                                       class="form-control"
                                                                       value="{{ $especialidad->codigo }}"
                                                                       maxlength="50"
                                                                       required>

                                                            </div>

                                                        </div>


                                                        {{-- NOMBRE --}}
                                                        <div class="col-md-8">

                                                            <div class="registro-field">

                                                                <label>
                                                                    <i class="fas fa-tools"></i>
                                                                    NOMBRE
                                                                    <span class="required">*</span>
                                                                </label>

                                                                <input type="text"
                                                                       name="nombre"
                                                                       class="form-control"
                                                                       value="{{ $especialidad->nombre }}"
                                                                       maxlength="100"
                                                                       required>

                                                            </div>

                                                        </div>

                                                    </div>


                                                    <div class="row">

                                                        {{-- DESCRIPCIÓN --}}
                                                        <div class="col-md-12">

                                                            <div class="registro-field">

                                                                <label>
                                                                    <i class="fas fa-align-left"></i>
                                                                    DESCRIPCIÓN
                                                                </label>

                                                                <textarea name="descripcion"
                                                                          class="form-control"
                                                                          rows="3"
                                                                          maxlength="500"
                                                                          placeholder="Descripción de la especialidad">{{ $especialidad->descripcion }}</textarea>

                                                            </div>

                                                        </div>

                                                    </div>


                                                    <div class="row">

                                                        <div class="col-md-12">

                                                            <div class="registro-field">

                                                                <label>
                                                                    <i class="fas fa-toggle-on"></i>
                                                                    ESTADO
                                                                </label>

                                                                <div class="custom-control custom-switch">

                                                                    <input type="checkbox"
                                                                           class="custom-control-input"
                                                                           name="activo"
                                                                           value="1"
                                                                           id="activo{{ $especialidad->id }}"
                                                                           {{ $especialidad->activo ? 'checked' : '' }}>

                                                                    <label class="custom-control-label"
                                                                           for="activo{{ $especialidad->id }}">
                                                                        ESPECIALIDAD ACTIVA
                                                                    </label>

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>


                                            <div class="modal-footer modal-password-footer">

                                                <button type="button"
                                                        class="btn btn-secondary"
                                                        data-dismiss="modal">

                                                    <i class="fas fa-times"></i>
                                                    CERRAR

                                                </button>

                                                <button type="submit"
                                                        class="btn btn-primary">

                                                    <i class="fas fa-save"></i>
                                                    ACTUALIZAR

                                                </button>

                                            </div>

                                        </form>

                                    </div>

                                </div>

                            </div>

                        @empty

                            <tr>
                                <td colspan="7"
                                    class="text-center py-5">

                                    <i class="fas fa-tools fa-3x text-muted mb-3"></i>

                                    <h5 class="text-muted">
                                        NO HAY ESPECIALIDADES REGISTRADAS
                                    </h5>

                                    <small class="text-muted">
                                        Registre una nueva especialidad para comenzar.
                                    </small>

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>


{{-- =============================================================
     MODAL NUEVA ESPECIALIDAD
     ============================================================= --}}
<div class="modal fade"
     id="modalCrearEspecialidad"
     tabindex="-1"
     role="dialog"
     aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content modal-password">

            <div class="modal-header modal-password-header">

                <div>

                    <h4 class="modal-title mb-1">
                        <i class="fas fa-tools"></i>
                        NUEVA ESPECIALIDAD
                    </h4>

                    <small>
                        Registro de una nueva especialidad técnica
                    </small>

                </div>

                <button type="button"
                        class="close text-white"
                        data-dismiss="modal">
                    &times;
                </button>

            </div>


            <form method="POST"
                  action="{{ route('especialidades.store') }}"
                  autocomplete="off">

                @csrf

                <div class="modal-body modal-password-body">

                    <div class="registro-section">

                        <div class="registro-section-title">

                            <i class="fas fa-tools"></i>
                            DATOS DE LA ESPECIALIDAD

                        </div>


                        <div class="row">

                            {{-- CÓDIGO --}}
                            <div class="col-md-4">

                                <div class="registro-field">

                                    <label for="codigo">

                                        <i class="fas fa-code"></i>
                                        CÓDIGO
                                        <span class="required">*</span>

                                    </label>

                                    <input type="text"
                                           name="codigo"
                                           id="codigo"
                                           class="form-control @error('codigo') is-invalid @enderror"
                                           value="{{ old('codigo') }}"
                                           placeholder="Ej. SOPORTE"
                                           maxlength="50"
                                           required>

                                    @error('codigo')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror

                                </div>

                            </div>


                            {{-- NOMBRE --}}
                            <div class="col-md-8">

                                <div class="registro-field">

                                    <label for="nombre">

                                        <i class="fas fa-tools"></i>
                                        NOMBRE
                                        <span class="required">*</span>

                                    </label>

                                    <input type="text"
                                           name="nombre"
                                           id="nombre"
                                           class="form-control @error('nombre') is-invalid @enderror"
                                           value="{{ old('nombre') }}"
                                           placeholder="Ej. SOPORTE TÉCNICO"
                                           maxlength="100"
                                           required>

                                    @error('nombre')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror

                                </div>

                            </div>

                        </div>


                        <div class="row">

                            {{-- DESCRIPCIÓN --}}
                            <div class="col-md-12">

                                <div class="registro-field">

                                    <label for="descripcion">

                                        <i class="fas fa-align-left"></i>
                                        DESCRIPCIÓN

                                    </label>

                                    <textarea name="descripcion"
                                              id="descripcion"
                                              class="form-control @error('descripcion') is-invalid @enderror"
                                              rows="3"
                                              maxlength="500"
                                              placeholder="Descripción de la especialidad">{{ old('descripcion') }}</textarea>

                                    @error('descripcion')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror

                                </div>

                            </div>

                        </div>


                        <div class="row">

                            <div class="col-md-12">

                                <div class="registro-field">

                                    <label>

                                        <i class="fas fa-toggle-on"></i>
                                        ESTADO

                                    </label>

                                    <div class="custom-control custom-switch">

                                        <input type="checkbox"
                                               class="custom-control-input"
                                               name="activo"
                                               value="1"
                                               id="activoNuevo"
                                               checked>

                                        <label class="custom-control-label"
                                               for="activoNuevo">
                                            ESPECIALIDAD ACTIVA
                                        </label>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="registro-required">

                        <i class="fas fa-info-circle"></i>

                        Verifique los datos antes de guardar.
                        Los campos marcados con
                        <strong>*</strong>
                        son obligatorios.

                    </div>

                </div>


                <div class="modal-footer modal-password-footer">

                    <button type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal">

                        <i class="fas fa-times"></i>
                        CERRAR

                    </button>

                    <button type="submit"
                            class="btn btn-primary">

                        <i class="fas fa-save"></i>
                        GUARDAR

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
<link rel="stylesheet" href="{{ asset('estilos/password.css') }}"> 
@stop

