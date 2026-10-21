<!-- =========================================================
     MODAL VER U.P.S.
     ========================================================= -->
     <link rel="stylesheet" href="{{ asset('estilos/password.css') }}">  
<div class="modal fade"
     id="ver{{ $upese->id }}"
     tabindex="-1"
     role="dialog"
     aria-labelledby="verUpsLabel{{ $upese->id }}"
     aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">

        <div class="modal-content modal-password">

            <!-- =================================================
                 HEADER
                 ================================================= -->
            <div class="modal-header modal-password-header">

                <div class="modal-title-container">

                    <div class="modal-password-icon">
                        <i class="fas fa-plug"></i>
                    </div>

                    <div>

                        <h5 class="modal-title"
                            id="verUpsLabel{{ $upese->id }}">
                            REGISTRO DEL U.P.S.
                        </h5>

                        <small>
                            Información detallada del equipo y solicitante
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


                    <div class="row">

                        <!-- ESTADO FUNCIONARIO -->
                        <div class="col-md-4">
                            <div class="registro-view-field">

                                <span class="registro-view-label">
                                    <i class="fas fa-user-check"></i>
                                    ESTADO DEL FUNCIONARIO
                                </span>

                                <span class="registro-view-value">

                                    @if($upese?->funcionario_activo == 1)
                                        FUNCIONARIO ACTIVO
                                    @else
                                        EX FUNCIONARIO
                                    @endif

                                </span>

                            </div>
                        </div>


                        <!-- RECEPCIONADO POR -->
                        <div class="col-md-8">
                            <div class="registro-view-field">

                                <span class="registro-view-label">
                                    <i class="fas fa-user-shield"></i>
                                    RECEPCIONADO POR
                                </span>

                                <span class="registro-view-value">

                                    {{ $upese->reguser?->name }}
                                    {{ $upese->reguser?->paterno }}
                                    {{ $upese->reguser?->materno }}

                                </span>

                            </div>
                        </div>

                    </div>


                    <div class="row">

                        <!-- NOMBRE -->
                        <div class="col-md-8">
                            <div class="registro-view-field">

                                <span class="registro-view-label">
                                    <i class="fas fa-user"></i>
                                    NOMBRE COMPLETO
                                </span>

                                <span class="registro-view-value">

                                    {{ strtoupper($upese->funcionario?->grado_academico ?? '') }}

                                    {{ $upese->funcionario?->nombre }}
                                    {{ $upese->funcionario?->paterno }}
                                    {{ $upese->funcionario?->materno }}

                                </span>

                            </div>
                        </div>


                        <!-- C.I. -->
                        <div class="col-md-4">
                            <div class="registro-view-field">

                                <span class="registro-view-label">
                                    <i class="fas fa-id-card"></i>
                                    C.I.
                                </span>

                                <span class="registro-view-value">

                                    {{ $upese->funcionario?->ci ?? 'SIN REGISTRO' }}

                                    @if($upese->funcionario?->expedido)
                                        - {{ $upese->funcionario->expedido }}
                                    @endif

                                </span>

                            </div>
                        </div>

                    </div>


                    <div class="row">

                        <!-- CELULAR -->
                        <div class="col-md-4">
                            <div class="registro-view-field">

                                <span class="registro-view-label">
                                    <i class="fas fa-mobile-alt"></i>
                                    CELULAR
                                </span>

                                <span class="registro-view-value">
                                    {{ $upese->funcionario?->celular ?? 'SIN REGISTRO' }}
                                </span>

                            </div>
                        </div>


                        <!-- CORREO -->
                        <div class="col-md-4">
                            <div class="registro-view-field">

                                <span class="registro-view-label">
                                    <i class="fas fa-envelope"></i>
                                    CORREO ELECTRÓNICO
                                </span>

                                <span class="registro-view-value">
                                    {{ $upese->funcionario?->email ?? 'SIN REGISTRO' }}
                                </span>

                            </div>
                        </div>


                        <!-- CARGO -->
                        <div class="col-md-4">
                            <div class="registro-view-field">

                                <span class="registro-view-label">
                                    <i class="fas fa-briefcase"></i>
                                    CARGO
                                </span>

                                <span class="registro-view-value">
                                    {{ $upese->funcionario?->cargo ?? 'SIN REGISTRO' }}
                                </span>

                            </div>
                        </div>

                    </div>


                    <div class="row">

                        <!-- DEPENDENCIA -->
                        <div class="col-md-6">
                            <div class="registro-view-field">

                                <span class="registro-view-label">
                                    <i class="fas fa-building"></i>
                                    DEPENDENCIA
                                </span>

                                <span class="registro-view-value">

                                    {{ $upese->Dependencia?->dependencias ?? 'SIN DEPENDENCIA' }}

                                </span>

                            </div>
                        </div>


                        <!-- FECHA RECEPCIÓN -->
                        <div class="col-md-6">
                            <div class="registro-view-field">

                                <span class="registro-view-label">
                                    <i class="fas fa-calendar-alt"></i>
                                    FECHA DE RECEPCIÓN
                                </span>

                                <span class="registro-view-value">

                                    @if($upese->fecha)
                                        {{ date('d-m-Y H:i', strtotime($upese->fecha)) }}
                                    @else
                                        SIN REGISTRO
                                    @endif

                                </span>

                            </div>
                        </div>

                    </div>


                    <div class="row">

                        <!-- TÉCNICO -->
                        <div class="col-md-4">
                            <div class="registro-view-field">

                                <span class="registro-view-label">
                                    <i class="fas fa-user-cog"></i>
                                    TÉCNICO A CARGO
                                </span>

                                <span class="registro-view-value">

                                    @if($upese->user_id && $upese->user)

                                        {{ $upese->user->name }}
                                        {{ $upese->user->paterno }}
                                        {{ $upese->user->materno }}

                                    @else

                                        SIN ASIGNAR

                                    @endif

                                </span>

                            </div>
                        </div>


                        <!-- FECHA ASIGNACIÓN -->
                        <div class="col-md-4">
                            <div class="registro-view-field">

                                <span class="registro-view-label">
                                    <i class="fas fa-calendar-check"></i>
                                    FECHA DE ASIGNACIÓN
                                </span>

                                <span class="registro-view-value">

                                    @if($upese->fecha_asignacion)

                                        {{ date('d-m-Y H:i', strtotime($upese->fecha_asignacion)) }}

                                    @else

                                        SIN ASIGNAR

                                    @endif

                                </span>

                            </div>
                        </div>


                        <!-- FECHA INICIO -->
                        <div class="col-md-4">
                            <div class="registro-view-field">

                                <span class="registro-view-label">
                                    <i class="fas fa-play-circle"></i>
                                    FECHA DE INICIO
                                </span>

                                <span class="registro-view-value">

                                    @if($upese->fecha_inicio)

                                        {{ date('d-m-Y H:i', strtotime($upese->fecha_inicio)) }}

                                    @else

                                        EN ESPERA

                                    @endif

                                </span>

                            </div>
                        </div>

                    </div>

                </div>


                <!-- =================================================
                     DATOS DEL U.P.S.
                     ================================================= -->
                <div class="registro-section">

                    <div class="registro-section-title">
                        <i class="fas fa-plug"></i>
                        DATOS DEL U.P.S.
                    </div>


                    <div class="row">

                        <!-- CÓDIGO GAMEA -->
                        <div class="col-md-6">
                            <div class="registro-view-field">

                                <span class="registro-view-label">
                                    <i class="fas fa-barcode"></i>
                                    CÓDIGO GAMEA
                                </span>

                                <span class="registro-view-value">
                                    {{ $upese->cod_gamea ?? 'SIN REGISTRO' }}
                                </span>

                            </div>
                        </div>


                        <!-- NÚMERO RECEPCIÓN -->
                        <div class="col-md-6">
                            <div class="registro-view-field">

                                <span class="registro-view-label">
                                    <i class="fas fa-hashtag"></i>
                                    NÚMERO DE RECEPCIÓN
                                </span>

                                <span class="registro-view-value">

                                    {{ $upese->cod_registro ?? 'SIN ASIGNAR' }}

                                </span>

                            </div>
                        </div>

                    </div>


                    <div class="row">

                        <!-- MARCA -->
                        <div class="col-md-6">
                            <div class="registro-view-field">

                                <span class="registro-view-label">
                                    <i class="fas fa-tag"></i>
                                    MARCA
                                </span>

                                <span class="registro-view-value">
                                    {{ $upese->marca ?? 'SIN REGISTRO' }}
                                </span>

                            </div>
                        </div>


                        <!-- MODELO -->
                        <div class="col-md-6">
                            <div class="registro-view-field">

                                <span class="registro-view-label">
                                    <i class="fas fa-cube"></i>
                                    MODELO
                                </span>

                                <span class="registro-view-value">
                                    {{ $upese->modelo ?? 'SIN REGISTRO' }}
                                </span>

                            </div>

                        </div>

                    </div>


                    <div class="row">

                        <!-- FALLA -->
                        <div class="col-md-6">
                            <div class="registro-view-field">

                                <span class="registro-view-label">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    FALLA
                                </span>

                                <span class="registro-view-value">
                                    {{ $upese->falla ?? 'SIN REGISTRO' }}
                                </span>

                            </div>
                        </div>


                        <!-- ESTADO -->
                        <div class="col-md-6">
                            <div class="registro-view-field">

                                <span class="registro-view-label">
                                    <i class="fas fa-tasks"></i>
                                    ESTADO
                                </span>

                                <span class="registro-view-value">

                                    {{ $upese->Estado?->nombre ?? 'SIN ESTADO' }}

                                    @if($upese->estado_id == 5 && $upese->fecha_entrega)

                                        — {{ date('d-m-Y H:i', strtotime($upese->fecha_entrega)) }}

                                    @endif

                                </span>

                            </div>
                        </div>

                    </div>


                    <!-- OBSERVACIONES -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-comment-alt"></i>
                                    DETALLE DEL TRABAJO REAIZADO
                                </div>

                                <div class="registro-view-value">

                                    {{ $upese->detalle_trabajo
                                        ?? 'EN ESPERA' }}

                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="registro-view-field">

                                <span class="registro-view-label">
                                    <i class="fas fa-comment-alt"></i>
                                    OBSERVACIONES
                                </span>

                                <span class="registro-view-value">
                                    {{ $upese->observaciones ?? 'SIN OBSERVACIONES' }}
                                </span>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- INFORMACIÓN -->
                <div class="registro-required">

                    <i class="fas fa-info-circle"></i>

                    Información de solo lectura.
                    Los datos mostrados corresponden al registro actual
                    del U.P.S.

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

<!-- =========================================================
     FIN MODAL VER U.P.S.
     ========================================================= -->