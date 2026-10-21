<!-- =========================================================
     MODAL VER IMPRESORA
     ========================================================= -->
<div class="modal fade"
     id="ver{{ $impresora->id }}"
     tabindex="-1"
     role="dialog"
     aria-labelledby="verImpresoraLabel{{ $impresora->id }}"
     aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">

        <div class="modal-content modal-password">

            <!-- =================================================
                 HEADER
                 ================================================= -->
            <div class="modal-header modal-password-header">

                <div class="modal-title-container">

                    <div class="modal-password-icon">
                        <i class="fas fa-print"></i>
                    </div>

                    <div>
                        <h5 class="modal-title"
                            id="verImpresoraLabel{{ $impresora->id }}">
                            REGISTRO DE IMPRESORA
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


                    <div class="row">

                        <!-- ESTADO DEL FUNCIONARIO -->
                        <div class="col-md-6">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-user-tag"></i>
                                    ESTADO DEL FUNCIONARIO
                                </div>

                                <div class="registro-view-value">

                                    @if($impresora?->funcionario_activo == 1)
                                        FUNCIONARIO ACTIVO
                                    @else
                                        EX FUNCIONARIO
                                    @endif

                                </div>

                            </div>

                        </div>


                        <!-- RECEPCIONADO POR -->
                        <div class="col-md-6">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-user-check"></i>
                                    RECEPCIONADO POR
                                </div>

                                <div class="registro-view-value">

                                    {{ $impresora->reguser?->name }}
                                    {{ $impresora->reguser?->paterno }}
                                    {{ $impresora->reguser?->materno }}

                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="row">

                        <!-- NOMBRE -->
                        <div class="col-md-7">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-user"></i>
                                    NOMBRE
                                </div>

                                <div class="registro-view-value">

                                    {{ strtoupper($impresora->funcionario?->grado_academico ?? '') }}
                                    {{ $impresora->funcionario?->nombre }}
                                    {{ $impresora->funcionario?->paterno }}
                                    {{ $impresora->funcionario?->materno }}

                                </div>

                            </div>

                        </div>


                        <!-- C.I. -->
                        <div class="col-md-5">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-id-card"></i>
                                    C.I.
                                </div>

                                <div class="registro-view-value">

                                    {{ $impresora->funcionario?->ci ?? 'SIN REGISTRO' }}

                                    @if($impresora->funcionario?->expedido)
                                        — {{ $impresora->funcionario->expedido }}
                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="row">

                        <!-- CELULAR -->
                        <div class="col-md-4">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-phone-alt"></i>
                                    CELULAR
                                </div>

                                <div class="registro-view-value">

                                    {{ $impresora->funcionario?->celular ?? 'SIN REGISTRO' }}

                                </div>

                            </div>

                        </div>


                        <!-- CORREO -->
                        <div class="col-md-4">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-envelope"></i>
                                    CORREO ELECTRÓNICO
                                </div>

                                <div class="registro-view-value">

                                    {{ $impresora->funcionario?->email ?? 'SIN REGISTRO' }}

                                </div>

                            </div>

                        </div>


                        <!-- CARGO -->
                        <div class="col-md-4">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-briefcase"></i>
                                    CARGO
                                </div>

                                <div class="registro-view-value">

                                    {{ $impresora->funcionario?->cargo ?? 'SIN REGISTRO' }}

                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="row">

                        <!-- DEPENDENCIA -->
                        <div class="col-md-6">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-building"></i>
                                    DEPENDENCIA
                                </div>

                                <div class="registro-view-value">

                                    {{ $impresora->Dependencia?->dependencias ?? 'SIN DEPENDENCIA' }}

                                </div>

                            </div>

                        </div>


                        <!-- FECHA DE RECEPCIÓN -->
                        <div class="col-md-6">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-calendar-alt"></i>
                                    FECHA DE RECEPCIÓN
                                </div>

                                <div class="registro-view-value">

                                    @if($impresora->fecha)

                                        {{ date('d-m-Y H:i', strtotime($impresora->fecha)) }}

                                    @else

                                        <span class="text-muted">
                                            SIN REGISTRO
                                        </span>

                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="row">

                        <!-- TÉCNICO -->
                        <div class="col-md-4">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-user-cog"></i>
                                    TÉCNICO A CARGO
                                </div>

                                <div class="registro-view-value">

                                    @if($impresora->user_id)

                                        {{ $impresora->user?->name }}
                                        {{ $impresora->user?->paterno }}
                                        {{ $impresora->user?->materno }}

                                    @else

                                        <span class="text-muted">
                                            SIN ASIGNAR
                                        </span>

                                    @endif

                                </div>

                            </div>

                        </div>


                        <!-- FECHA ASIGNACIÓN -->
                        <div class="col-md-4">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-calendar-check"></i>
                                    FECHA DE ASIGNACIÓN
                                </div>

                                <div class="registro-view-value">

                                    @if($impresora->fecha_asignacion)

                                        {{ date('d-m-Y H:i', strtotime($impresora->fecha_asignacion)) }}

                                    @else

                                        <span class="text-muted">
                                            SIN ASIGNAR
                                        </span>

                                    @endif

                                </div>

                            </div>

                        </div>


                        <!-- FECHA DE INICIO -->
                        <div class="col-md-4">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-play-circle"></i>
                                    FECHA DE INICIO
                                </div>

                                <div class="registro-view-value">

                                    @if($impresora->fecha_inicio)

                                        {{ date('d-m-Y H:i', strtotime($impresora->fecha_inicio)) }}

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
                     DATOS DE LA IMPRESORA
                     ================================================= -->
                <div class="registro-section">

                    <div class="registro-section-title">
                        <i class="fas fa-print"></i>
                        DATOS DE LA IMPRESORA
                    </div>


                    <div class="row">

                        <!-- CÓDIGO GAMEA -->
                        <div class="col-md-6">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-barcode"></i>
                                    CÓDIGO GAMEA
                                </div>

                                <div class="registro-view-value">

                                    {{ $impresora->cod_gamea ?? 'SIN REGISTRO' }}

                                </div>

                            </div>

                        </div>


                        <!-- NÚMERO DE RECEPCIÓN -->
                        <div class="col-md-6">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-receipt"></i>
                                    NÚMERO DE RECEPCIÓN
                                </div>

                                <div class="registro-view-value">

                                    {{ $impresora->cod_registro ?? 'SIN ASIGNAR' }}

                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="row">

                        <!-- MARCA -->
                        <div class="col-md-6">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-tag"></i>
                                    MARCA
                                </div>

                                <div class="registro-view-value">

                                    {{ $impresora->marca ?? 'SIN REGISTRO' }}

                                </div>

                            </div>

                        </div>


                        <!-- MODELO -->
                        <div class="col-md-6">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-microchip"></i>
                                    MODELO
                                </div>

                                <div class="registro-view-value">

                                    {{ $impresora->modelo ?? 'SIN REGISTRO' }}

                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="row">

                        <!-- FALLA -->
                        <div class="col-md-6">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    FALLA
                                </div>

                                <div class="registro-view-value">

                                    {{ $impresora->falla ?? 'SIN REGISTRO' }}

                                </div>

                            </div>

                        </div>


                        <!-- ESTADO -->
                        <div class="col-md-6">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-info-circle"></i>
                                    ESTADO
                                </div>

                                <div class="registro-view-value">

                                    {{ $impresora->Estado?->nombre ?? 'SIN ESTADO' }}

                                    @if($impresora->estado_id == 5 && $impresora->fecha_entrega)

                                        — {{ date('d-m-Y H:i', strtotime($impresora->fecha_entrega)) }}

                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- OBSERVACIONES -->
                    <div class="row">
                        <div class="col-md-6">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-comment-alt"></i>
                                    DETALLE DEL TRABAJO REALIZADO
                                </div>

                                <div class="registro-view-value">
                                    {{ $impresora->detalle_trabajo ?? 'EN ESPERA' }}
                                </div>

                            </div>

                        </div>
                        <div class="col-md-6">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-comment-alt"></i>
                                    OBSERVACIONES
                                </div>

                                <div class="registro-view-value">

                                    {{ $impresora->observaciones ?? 'SIN OBSERVACIONES' }}

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
     FIN MODAL VER IMPRESORA
     ========================================================= -->

<link rel="stylesheet" href="{{ asset('estilos/password.css') }}"> 