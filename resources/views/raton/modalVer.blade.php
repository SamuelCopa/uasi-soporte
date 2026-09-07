<link rel="stylesheet" href="{{ asset('estilos/password.css') }}">
<!-- =========================================================
     MODAL VER MOUSE
     ========================================================= -->
<div class="modal fade"
     id="ver{{ $raton->id }}"
     tabindex="-1"
     role="dialog"
     aria-labelledby="verRatonLabel{{ $raton->id }}"
     aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-centered"
         role="document">

        <div class="modal-content modal-password">


            <!-- =================================================
                 HEADER
                 ================================================= -->
            <div class="modal-header modal-password-header">

                <div class="modal-title-container">

                    <div class="modal-password-icon">
                        <i class="fas fa-mouse"></i>
                    </div>

                    <div>

                        <h5 class="modal-title"
                            id="verRatonLabel{{ $raton->id }}">

                            REGISTRO DE MOUSE

                        </h5>

                        <small>
                            Información del equipo y seguimiento del mantenimiento
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


            <!-- =================================================
                 BODY
                 ================================================= -->
            <div class="modal-body modal-password-body">


                <!-- =================================================
                     DATOS DEL SOLICITANTE
                     ================================================= -->
                <div class="registro-section">

                    <div class="registro-section-title">

                        <i class="fas fa-user"></i>

                        DATOS DEL SOLICITANTE

                    </div>


                    <!-- ESTADO FUNCIONARIO / RECEPCIONADO POR -->
                    <div class="row">

                        <div class="col-md-6">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-user-check"></i>
                                    ESTADO DEL FUNCIONARIO
                                </div>

                                <div class="registro-view-value">

                                    @if($raton->funcionario_activo == 1)

                                        FUNCIONARIO ACTIVO

                                    @else

                                        EX FUNCIONARIO

                                    @endif

                                </div>

                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-user-shield"></i>
                                    RECEPCIONADO POR
                                </div>

                                <div class="registro-view-value">

                                    {{ $raton->reguser?->name }}
                                    {{ $raton->reguser?->paterno }}
                                    {{ $raton->reguser?->materno }}

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- NOMBRE / C.I. -->
                    <div class="row">

                        <div class="col-md-8">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-user"></i>
                                    NOMBRE
                                </div>

                                <div class="registro-view-value">

                                    {{ strtoupper($raton->funcionario?->grado_academico ?? '') }}
                                    {{ $raton->funcionario?->nombre }}
                                    {{ $raton->funcionario?->paterno }}
                                    {{ $raton->funcionario?->materno }}

                                </div>

                            </div>

                        </div>


                        <div class="col-md-4">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-id-card"></i>
                                    C.I.
                                </div>

                                <div class="registro-view-value">

                                    {{ $raton->funcionario?->ci ?? 'SIN REGISTRO' }}

                                    @if($raton->funcionario?->expedido)

                                        - {{ $raton->funcionario->expedido }}

                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- CELULAR / CORREO / CARGO -->
                    <div class="row">

                        <div class="col-md-4">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-phone-alt"></i>
                                    CELULAR
                                </div>

                                <div class="registro-view-value">

                                    {{ $raton->funcionario?->celular ?? 'SIN REGISTRO' }}

                                </div>

                            </div>

                        </div>


                        <div class="col-md-4">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-envelope"></i>
                                    CORREO ELECTRÓNICO
                                </div>

                                <div class="registro-view-value">

                                    {{ $raton->funcionario?->email ?? 'SIN REGISTRO' }}

                                </div>

                            </div>

                        </div>


                        <div class="col-md-4">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-briefcase"></i>
                                    CARGO
                                </div>

                                <div class="registro-view-value">

                                    {{ $raton->funcionario?->cargo ?? 'SIN REGISTRO' }}

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- DEPENDENCIA / FECHA RECEPCIÓN -->
                    <div class="row">

                        <div class="col-md-7">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-building"></i>
                                    DEPENDENCIA
                                </div>

                                <div class="registro-view-value">

                                    {{ $raton->Dependencia?->dependencias ?? 'SIN DEPENDENCIA' }}

                                </div>

                            </div>

                        </div>


                        <div class="col-md-5">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-calendar-alt"></i>
                                    FECHA DE RECEPCIÓN
                                </div>

                                <div class="registro-view-value">

                                    @if($raton->fecha)

                                        {{ date('d-m-Y H:i', strtotime($raton->fecha)) }}

                                    @else

                                        <span class="text-muted">
                                            SIN REGISTRO
                                        </span>

                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- TÉCNICO / ASIGNACIÓN / INICIO -->
                    <div class="row">

                        <div class="col-md-4">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-user-cog"></i>
                                    TÉCNICO A CARGO
                                </div>

                                <div class="registro-view-value">

                                    @if($raton->user_id)

                                        {{ $raton->user?->name }}
                                        {{ $raton->user?->paterno }}
                                        {{ $raton->user?->materno }}

                                    @else

                                        <span class="text-muted">
                                            SIN ASIGNAR
                                        </span>

                                    @endif

                                </div>

                            </div>

                        </div>


                        <div class="col-md-4">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-calendar-check"></i>
                                    FECHA DE ASIGNACIÓN
                                </div>

                                <div class="registro-view-value">

                                    @if($raton->fecha_asignacion)

                                        {{ date('d-m-Y H:i', strtotime($raton->fecha_asignacion)) }}

                                    @else

                                        <span class="text-muted">
                                            SIN ASIGNAR
                                        </span>

                                    @endif

                                </div>

                            </div>

                        </div>


                        <div class="col-md-4">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-play-circle"></i>
                                    FECHA DE INICIO
                                </div>

                                <div class="registro-view-value">

                                    @if($raton->fecha_inicio)

                                        {{ date('d-m-Y H:i', strtotime($raton->fecha_inicio)) }}

                                    @else

                                        <span class="text-muted">
                                            EN ESPERA
                                        </span>

                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- =================================================
                     DATOS DEL MOUSE
                     ================================================= -->
                <div class="registro-section">

                    <div class="registro-section-title">

                        <i class="fas fa-mouse"></i>

                        DATOS DEL MOUSE

                    </div>


                    <!-- CÓDIGO GAMEA / NÚMERO RECEPCIÓN -->
                    <div class="row">

                        <div class="col-md-6">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-barcode"></i>
                                    CÓDIGO GAMEA
                                </div>

                                <div class="registro-view-value">

                                    {{ $raton->cod_gamea ?? 'SIN REGISTRO' }}

                                </div>

                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-hashtag"></i>
                                    NÚMERO DE RECEPCIÓN
                                </div>

                                <div class="registro-view-value">

                                    @if($raton->cod_registro)

                                        {{ $raton->cod_registro }}

                                    @else

                                        <span class="text-muted">
                                            SIN ASIGNAR
                                        </span>

                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- MARCA / MODELO -->
                    <div class="row">

                        <div class="col-md-6">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-tag"></i>
                                    MARCA
                                </div>

                                <div class="registro-view-value">

                                    {{ $raton->marca ?? 'SIN REGISTRO' }}

                                </div>

                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-mouse"></i>
                                    MODELO
                                </div>

                                <div class="registro-view-value">

                                    {{ $raton->modelo ?? 'SIN REGISTRO' }}

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- FALLA / ESTADO -->
                    <div class="row">

                        <div class="col-md-6">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    FALLA
                                </div>

                                <div class="registro-view-value">

                                    {{ $raton->falla ?? 'SIN REGISTRO' }}

                                </div>

                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-tasks"></i>
                                    ESTADO
                                </div>

                                <div class="registro-view-value">

                                    {{ $raton->Estado?->nombre ?? 'SIN ESTADO' }}

                                    @if($raton->estado_id == 5 && $raton->fecha_entrega)

                                        <span class="text-muted">
                                            — {{ date('d-m-Y H:i', strtotime($raton->fecha_entrega)) }}
                                        </span>

                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- OBSERVACIONES -->
                    <div class="row">

                        <div class="col-md-12">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-comment-alt"></i>
                                    OBSERVACIONES
                                </div>

                                <div class="registro-view-value">

                                    {{ $raton->observaciones ?? 'SIN OBSERVACIONES' }}

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <!-- =================================================
                 FOOTER
                 ================================================= -->
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

