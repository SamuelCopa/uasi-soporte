{{-- =========================================================
     MODAL VER USUARIO
========================================================= --}}

<div class="modal fade"
     id="ver{{ $user->id }}"
     tabindex="-1"
     role="dialog"
     aria-labelledby="verModalLabel{{ $user->id }}"
     aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-centered">

        <div class="modal-content modal-password">


            {{-- =================================================
                 CABECERA
            ================================================== --}}
            <div class="modal-header modal-password-header">

                <div class="modal-title-container">

                    <div class="modal-password-icon">
                        <i class="fas fa-user"></i>
                    </div>

                    <div>
                        <h4 class="modal-title">
                            REGISTRO DEL USUARIO
                        </h4>

                        <small>
                            Información registrada en el sistema
                        </small>
                    </div>

                </div>

                <button type="button"
                        class="close modal-password-close"
                        data-dismiss="modal"
                        aria-label="Cerrar">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>


            {{-- =================================================
                 CUERPO
            ================================================== --}}
            <div class="modal-body modal-password-body">


                {{-- =================================================
                     DATOS PERSONALES
                ================================================== --}}
                <div class="registro-section">

                    <div class="registro-section-title">

                        <i class="fas fa-id-card"></i>

                        DATOS PERSONALES

                    </div>


                    <div class="row">

                        {{-- APELLIDO PATERNO --}}
                        <div class="col-md-4">

                            <div class="registro-view-field">

                                <span class="registro-view-label">
                                    APELLIDO PATERNO
                                </span>

                                <span class="registro-view-value">
                                    {{ $user?->paterno ?? 'SIN REGISTRO' }}
                                </span>

                            </div>

                        </div>


                        {{-- APELLIDO MATERNO --}}
                        <div class="col-md-4">

                            <div class="registro-view-field">

                                <span class="registro-view-label">
                                    APELLIDO MATERNO
                                </span>

                                <span class="registro-view-value">
                                    {{ $user?->materno ?? 'SIN REGISTRO' }}
                                </span>

                            </div>

                        </div>


                        {{-- NOMBRE --}}
                        <div class="col-md-4">

                            <div class="registro-view-field">

                                <span class="registro-view-label">
                                    NOMBRE(S)
                                </span>

                                <span class="registro-view-value">
                                    {{ $user?->name ?? 'SIN REGISTRO' }}
                                </span>

                            </div>

                        </div>

                    </div>


                    <div class="row">

                        {{-- C.I. --}}
                        <div class="col-md-4">

                            <div class="registro-view-field">

                                <span class="registro-view-label">
                                    C.I.
                                </span>

                                <span class="registro-view-value">
                                    {{ $user?->ci ?? 'SIN REGISTRO' }}
                                </span>

                            </div>

                        </div>


                        {{-- EXPEDIDO --}}
                        <div class="col-md-4">

                            <div class="registro-view-field">

                                <span class="registro-view-label">
                                    EXPEDIDO
                                </span>

                                <span class="registro-view-value">

                                    @php
                                        $expedidos = [
                                            'QR' => 'QR',
                                            'LP' => 'LA PAZ',
                                            'CB' => 'COCHABAMBA',
                                            'SC' => 'SANTA CRUZ',
                                            'OR' => 'ORURO',
                                            'CH' => 'CHUQUISACA',
                                            'PO' => 'POTOSÍ',
                                            'T'  => 'TARIJA',
                                            'B'  => 'BENI',
                                            'P'  => 'PANDO',
                                        ];
                                    @endphp

                                    {{ $expedidos[$user?->expedido] ?? 'SIN REGISTRO' }}

                                </span>

                            </div>

                        </div>


                        {{-- CELULAR --}}
                        <div class="col-md-4">

                            <div class="registro-view-field">

                                <span class="registro-view-label">
                                    CELULAR
                                </span>

                                <span class="registro-view-value">
                                    {{ $user?->celular ?? 'SIN REGISTRO' }}
                                </span>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     ACCESO Y ESTADO
                ================================================== --}}
                <div class="registro-section">

                    <div class="registro-section-title">

                        <i class="fas fa-user-shield"></i>

                        ACCESO Y ESTADO

                    </div>


                    <div class="row">

                        {{-- CORREO --}}
                        <div class="col-md-6">

                            <div class="registro-view-field">

                                <span class="registro-view-label">
                                    CORREO ELECTRÓNICO
                                </span>

                                <span class="registro-view-value">
                                    {{ $user?->email ?? 'SIN REGISTRO' }}
                                </span>

                            </div>

                        </div>


                        {{-- ESTADO --}}
                        <div class="col-md-6">

                            <div class="registro-view-field">

                                <span class="registro-view-label">
                                    ESTADO
                                </span>

                                <span class="registro-view-value">

                                    {{ $user?->estadoUsuario?->nombre ?? 'SIN ESTADO' }}

                                </span>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     ROLES
                ================================================== --}}
                <div class="registro-section">

                    <div class="registro-section-title">

                        <i class="fas fa-user-tag"></i>

                        ROLES DEL USUARIO

                    </div>


                    <div class="roles-container">

                        @forelse ($user->roles as $rol)

                            <div class="rol-option">

                                <i class="fas fa-check-circle"></i>

                                <span>
                                    {{ $rol->name }}
                                </span>

                            </div>

                        @empty

                            <span class="text-muted">
                                Sin roles asignados
                            </span>

                        @endforelse

                    </div>

                </div>


                {{-- INFORMACIÓN --}}
                <div class="registro-required">

                    <i class="fas fa-info-circle"></i>

                    Esta información corresponde al registro actual
                    del usuario en el sistema.

                </div>

            </div>


            {{-- =================================================
                 FOOTER
            ================================================== --}}
            <div class="modal-footer modal-password-footer">

                <button type="button"
                        class="btn btn-password-close"
                        data-dismiss="modal">

                    <i class="fas fa-times"></i>

                    CERRAR

                </button>

            </div>

        </div>

    </div>

</div>

<link rel="stylesheet" href="{{ asset('estilos/password.css') }}">  
