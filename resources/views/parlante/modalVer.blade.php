<!-- =========================================================
     MODAL VER PARLANTE
     ========================================================= -->
<div class="modal fade"
     id="ver{{ $parlante->id }}"
     tabindex="-1"
     role="dialog"
     aria-labelledby="verParlanteLabel{{ $parlante->id }}"
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
                        <i class="fas fa-volume-up"></i>
                    </div>

                    <div>
                        <h5 class="modal-title"
                            id="verParlanteLabel{{ $parlante->id }}">
                            REGISTRO DE PARLANTE
                        </h5>

                        <small>
                            Información detallada del equipo y seguimiento
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

                        <!-- Estado funcionario -->
                        <div class="col-md-4">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-user-check"></i>
                                    ESTADO DEL FUNCIONARIO
                                </div>

                                <div class="registro-view-value">
                                    @if($parlante->funcionario_activo == 1)
                                        FUNCIONARIO ACTIVO
                                    @else
                                        EX FUNCIONARIO
                                    @endif
                                </div>

                            </div>
                        </div>


                        <!-- Recepcionado por -->
                        <div class="col-md-8">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-user-shield"></i>
                                    RECEPCIONADO POR
                                </div>

                                <div class="registro-view-value">
                                    {{ $parlante->reguser?->name }}
                                    {{ $parlante->reguser?->paterno }}
                                    {{ $parlante->reguser?->materno }}

                                    @if(!$parlante->reguser)
                                        <span class="text-muted">
                                            SIN REGISTRO
                                        </span>
                                    @endif
                                </div>

                            </div>
                        </div>


                        <!-- Nombre -->
                        <div class="col-md-8">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-id-card"></i>
                                    NOMBRE COMPLETO
                                </div>

                                <div class="registro-view-value">

                                    {{ strtoupper($parlante->funcionario?->grado_academico ?? '') }}

                                    {{ $parlante->funcionario?->nombre }}
                                    {{ $parlante->funcionario?->paterno }}
                                    {{ $parlante->funcionario?->materno }}

                                    @if(!$parlante->funcionario)
                                        <span class="text-muted">
                                            SIN REGISTRO
                                        </span>
                                    @endif

                                </div>

                            </div>
                        </div>


                        <!-- CI -->
                        <div class="col-md-4">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-address-card"></i>
                                    C.I.
                                </div>

                                <div class="registro-view-value">

                                    {{ $parlante->funcionario?->ci ?? 'SIN REGISTRO' }}

                                    @if($parlante->funcionario?->expedido)
                                        {{ $parlante->funcionario->expedido }}
                                    @endif

                                </div>

                            </div>
                        </div>


                        <!-- Celular -->
                        <div class="col-md-4">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-mobile-alt"></i>
                                    CELULAR
                                </div>

                                <div class="registro-view-value">
                                    {{ $parlante->funcionario?->celular ?? 'SIN REGISTRO' }}
                                </div>

                            </div>
                        </div>


                        <!-- Correo -->
                        <div class="col-md-4">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-envelope"></i>
                                    CORREO ELECTRÓNICO
                                </div>

                                <div class="registro-view-value">
                                    {{ $parlante->funcionario?->email ?? 'SIN REGISTRO' }}
                                </div>

                            </div>
                        </div>


                        <!-- Cargo -->
                        <div class="col-md-4">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-briefcase"></i>
                                    CARGO
                                </div>

                                <div class="registro-view-value">
                                    {{ $parlante->funcionario?->cargo ?? 'SIN REGISTRO' }}
                                </div>

                            </div>
                        </div>


                        <!-- Dependencia -->
                        <div class="col-md-8">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-building"></i>
                                    DEPENDENCIA
                                </div>

                                <div class="registro-view-value">

                                    @if($parlante->dependencia_id)
                                        {{ $parlante->Dependencia?->dependencias ?? 'SIN DEPENDENCIA' }}
                                    @else
                                        <span class="text-muted">
                                            SIN DEPENDENCIA
                                        </span>
                                    @endif

                                </div>

                            </div>
                        </div>


                        <!-- Fecha recepción -->
                        <div class="col-md-4">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-calendar-alt"></i>
                                    FECHA DE RECEPCIÓN
                                </div>

                                <div class="registro-view-value">

                                    @if($parlante->fecha)
                                        {{ date('d-m-Y H:i', strtotime($parlante->fecha)) }}
                                    @else
                                        <span class="text-muted">
                                            SIN REGISTRO
                                        </span>
                                    @endif

                                </div>

                            </div>
                        </div>

                    </div>

                </div>


                <!-- =================================================
                     ASIGNACIÓN Y SEGUIMIENTO
                     ================================================= -->
                <div class="registro-section">

                    <div class="registro-section-title">
                        <i class="fas fa-user-cog"></i>
                        ASIGNACIÓN Y SEGUIMIENTO
                    </div>

                    <div class="row">

                        <!-- Técnico -->
                        <div class="col-md-4">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-user-cog"></i>
                                    TÉCNICO A CARGO
                                </div>

                                <div class="registro-view-value">

                                    @if($parlante->user_id && $parlante->user)

                                        {{ $parlante->user->name }}
                                        {{ $parlante->user->paterno }}
                                        {{ $parlante->user->materno }}

                                    @else

                                        <span class="text-muted">
                                            SIN ASIGNAR
                                        </span>

                                    @endif

                                </div>

                            </div>
                        </div>


                        <!-- Fecha asignación -->
                        <div class="col-md-4">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-calendar-check"></i>
                                    FECHA DE ASIGNACIÓN
                                </div>

                                <div class="registro-view-value">

                                    @if($parlante->fecha_asignacion)

                                        {{ date('d-m-Y H:i', strtotime($parlante->fecha_asignacion)) }}

                                    @else

                                        <span class="text-muted">
                                            SIN ASIGNAR
                                        </span>

                                    @endif

                                </div>

                            </div>
                        </div>


                        <!-- Fecha inicio -->
                        <div class="col-md-4">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-play-circle"></i>
                                    FECHA DE INICIO
                                </div>

                                <div class="registro-view-value">

                                    @if($parlante->fecha_inicio)

                                        {{ date('d-m-Y H:i', strtotime($parlante->fecha_inicio)) }}

                                    @else

                                        <span class="text-muted">
                                            SIN INICIAR
                                        </span>

                                    @endif

                                </div>

                            </div>
                        </div>

                    </div>

                </div>


                <!-- =================================================
                     DATOS DEL PARLANTE
                     ================================================= -->
                <div class="registro-section">

                    <div class="registro-section-title">
                        <i class="fas fa-volume-up"></i>
                        DATOS DEL PARLANTE
                    </div>

                    <div class="row">

                        <!-- Código GAMEA -->
                        <div class="col-md-6">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-barcode"></i>
                                    CÓDIGO GAMEA
                                </div>

                                <div class="registro-view-value">
                                    {{ $parlante->cod_gamea ?? 'SIN REGISTRO' }}
                                </div>

                            </div>
                        </div>


                        <!-- Número recepción -->
                        <div class="col-md-6">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-receipt"></i>
                                    NÚMERO DE RECEPCIÓN
                                </div>

                                <div class="registro-view-value">

                                    @if($parlante->cod_registro)
                                        {{ $parlante->cod_registro }}
                                    @else
                                        <span class="text-muted">
                                            SIN ASIGNAR
                                        </span>
                                    @endif

                                </div>

                            </div>
                        </div>


                        <!-- Marca -->
                        <div class="col-md-6">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-tag"></i>
                                    MARCA
                                </div>

                                <div class="registro-view-value">
                                    {{ $parlante->marca ?? 'SIN REGISTRO' }}
                                </div>

                            </div>
                        </div>


                        <!-- Modelo -->
                        <div class="col-md-6">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-cube"></i>
                                    MODELO
                                </div>

                                <div class="registro-view-value">
                                    {{ $parlante->modelo ?? 'SIN REGISTRO' }}
                                </div>

                            </div>
                        </div>


                        <!-- Falla -->
                        <div class="col-md-12">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    FALLA
                                </div>

                                <div class="registro-view-value">
                                    {{ $parlante->falla ?? 'SIN REGISTRO' }}
                                </div>

                            </div>
                        </div>


                        <!-- Estado -->
                        <div class="col-md-12">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-info-circle"></i>
                                    ESTADO
                                </div>

                                <div class="registro-view-value">

                                    {{ $parlante->Estado?->nombre ?? 'SIN ESTADO' }}

                                    @if($parlante->estado_id == 5 && $parlante->fecha_entrega)

                                        — Entregado:
                                        {{ date('d-m-Y H:i', strtotime($parlante->fecha_entrega)) }}

                                    @endif

                                </div>

                            </div>
                        </div>


                        <!-- Observaciones -->
                        <div class="col-md-12">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-comment-alt"></i>
                                    OBSERVACIONES
                                </div>

                                <div class="registro-view-value">

                                    {{ $parlante->observaciones ?? 'SIN OBSERVACIONES' }}

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
<link rel="stylesheet" href="{{ asset('estilos/password.css') }}">