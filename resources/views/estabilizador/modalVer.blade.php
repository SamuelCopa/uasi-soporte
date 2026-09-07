<!-- =========================================================
     MODAL VER ESTABILIZADOR
     ========================================================= -->
<div class="modal fade"
     id="ver{{ $estabilizador->id }}"
     tabindex="-1"
     role="dialog"
     aria-labelledby="verEstabilizadorLabel{{ $estabilizador->id }}"
     aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">

        <div class="modal-content modal-password">

            <!-- =================================================
                 HEADER
                 ================================================= -->
            <div class="modal-header modal-password-header">

                <div class="modal-title-container">

                    <div class="modal-password-icon">
                        <i class="fas fa-bolt"></i>
                    </div>

                    <div>
                        <h5 class="modal-title"
                            id="verEstabilizadorLabel{{ $estabilizador->id }}">
                            REGISTRO DE ESTABILIZADOR
                        </h5>

                        <small>
                            Información detallada del equipo y funcionario
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

                                    @if($estabilizador?->funcionario_activo == 1)

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

                                    {{ $estabilizador->reguser?->name ?? '' }}
                                    {{ $estabilizador->reguser?->paterno ?? '' }}
                                    {{ $estabilizador->reguser?->materno ?? '' }}

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- NOMBRE / CI -->
                    <div class="row">

                        <div class="col-md-8">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-user"></i>
                                    NOMBRE
                                </div>

                                <div class="registro-view-value">

                                    {{ strtoupper($estabilizador->funcionario?->grado_academico ?? '') }}
                                    {{ $estabilizador->funcionario?->nombre ?? '' }}
                                    {{ $estabilizador->funcionario?->paterno ?? '' }}
                                    {{ $estabilizador->funcionario?->materno ?? '' }}

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

                                    {{ $estabilizador->funcionario?->ci ?? 'SIN REGISTRO' }}

                                    @if($estabilizador->funcionario?->expedido)
                                        - {{ $estabilizador->funcionario->expedido }}
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
                                    <i class="fas fa-mobile-alt"></i>
                                    CELULAR
                                </div>

                                <div class="registro-view-value">

                                    {{ $estabilizador->funcionario?->celular ?? 'SIN REGISTRO' }}

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

                                    {{ $estabilizador->funcionario?->email ?? 'SIN REGISTRO' }}

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

                                    {{ $estabilizador->funcionario?->cargo ?? 'SIN REGISTRO' }}

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- DEPENDENCIA / FECHA RECEPCIÓN -->
                    <div class="row">

                        <div class="col-md-6">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-building"></i>
                                    DEPENDENCIA
                                </div>

                                <div class="registro-view-value">

                                    {{ $estabilizador->Dependencia?->dependencias ?? 'SIN DEPENDENCIA' }}

                                </div>

                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-calendar-alt"></i>
                                    FECHA DE RECEPCIÓN
                                </div>

                                <div class="registro-view-value">

                                    @if($estabilizador->fecha)

                                        {{ date('d-m-Y H:i', strtotime($estabilizador->fecha)) }}

                                    @else

                                        <span class="text-muted">
                                            SIN REGISTRO
                                        </span>

                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- =================================================
                         ASIGNACIÓN Y SEGUIMIENTO
                         ================================================= -->
                    <div class="row">

                        <div class="col-md-4">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-user-cog"></i>
                                    TÉCNICO A CARGO
                                </div>

                                <div class="registro-view-value">

                                    @if($estabilizador->user_id && $estabilizador->user)

                                        {{ $estabilizador->user->name }}
                                        {{ $estabilizador->user->paterno }}
                                        {{ $estabilizador->user->materno }}

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

                                    @if($estabilizador->fecha_asignacion)

                                        {{ date('d-m-Y H:i', strtotime($estabilizador->fecha_asignacion)) }}

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

                                    @if($estabilizador->fecha_inicio)

                                        {{ date('d-m-Y H:i', strtotime($estabilizador->fecha_inicio)) }}

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
                     DATOS DEL ESTABILIZADOR
                     ================================================= -->
                <div class="registro-section">

                    <div class="registro-section-title">
                        <i class="fas fa-bolt"></i>
                        DATOS DEL ESTABILIZADOR
                    </div>


                    <!-- CÓDIGOS -->
                    <div class="row">

                        <div class="col-md-6">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-barcode"></i>
                                    CÓDIGO GAMEA
                                </div>

                                <div class="registro-view-value">

                                    {{ $estabilizador->cod_gamea ?? 'SIN REGISTRO' }}

                                </div>

                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-receipt"></i>
                                    NÚMERO DE REGISTRO
                                </div>

                                <div class="registro-view-value">

                                    {{ $estabilizador->cod_registro ?? 'SIN ASIGNAR' }}

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

                                    {{ $estabilizador->marca ?? 'SIN REGISTRO' }}

                                </div>

                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-cube"></i>
                                    MODELO
                                </div>

                                <div class="registro-view-value">

                                    {{ $estabilizador->modelo ?? 'SIN REGISTRO' }}

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

                                    {{ $estabilizador->falla ?? 'SIN REGISTRO' }}

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

                                    {{ $estabilizador->Estado?->nombre ?? 'SIN ESTADO' }}

                                    @if($estabilizador->estado_id == 5 && $estabilizador->fecha_entrega)

                                        — ENTREGADO:
                                        {{ date('d-m-Y H:i', strtotime($estabilizador->fecha_entrega)) }}

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

                                    {{ $estabilizador->observaciones ?? 'SIN OBSERVACIONES' }}

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
<!-- =========================================================
     FIN MODAL VER ESTABILIZADOR
     ========================================================= -->
        <link rel="stylesheet" href="{{ asset('estilos/password.css') }}"> 