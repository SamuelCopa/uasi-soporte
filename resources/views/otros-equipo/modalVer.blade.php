<link rel="stylesheet" href="{{ asset('estilos/password.css') }}">
<!-- =========================================================
     MODAL VER OTROS EQUIPO
     ========================================================= -->
<div class="modal fade"
     id="ver{{ $equipo->id }}"
     tabindex="-1"
     role="dialog"
     aria-labelledby="verOtroEquipoLabel{{ $equipo->id }}"
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
                        <i class="fas fa-desktop"></i>
                    </div>

                    <div>
                        <h5 class="modal-title"
                            id="verOtroEquipoLabel{{ $equipo->id }}">
                            REGISTRO DEL EQUIPO
                        </h5>

                        <small>
                            Información del equipo, funcionario y seguimiento
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
                                    @if($equipo->funcionario_activo == 1)
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
                                    {{ $equipo->reguser?->name }}
                                    {{ $equipo->reguser?->paterno }}
                                    {{ $equipo->reguser?->materno }}

                                    @if(!$equipo->reguser)
                                        <span class="text-muted">SIN REGISTRO</span>
                                    @endif
                                </div>

                            </div>
                        </div>

                    </div>


                    <!-- NOMBRE / CI -->
                    <div class="row">

                        <div class="col-md-7">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-user"></i>
                                    NOMBRE COMPLETO
                                </div>

                                <div class="registro-view-value">
                                    {{ $equipo->funcionario?->nombre }}
                                    {{ $equipo->funcionario?->paterno }}
                                    {{ $equipo->funcionario?->materno }}

                                    @if(!$equipo->funcionario)
                                        <span class="text-muted">SIN REGISTRO</span>
                                    @endif
                                </div>

                            </div>
                        </div>


                        <div class="col-md-5">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-id-card"></i>
                                    C.I.
                                </div>

                                <div class="registro-view-value">
                                    {{ $equipo->funcionario?->ci ?? 'SIN REGISTRO' }}
                                    {{ $equipo->funcionario?->expedido }}
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
                                    {{ $equipo->funcionario?->celular ?? 'SIN REGISTRO' }}
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
                                    {{ $equipo->funcionario?->email ?? 'SIN REGISTRO' }}
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
                                    {{ $equipo->funcionario?->cargo ?? 'SIN REGISTRO' }}
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
                                    {{ $equipo->Dependencia?->dependencias ?? 'SIN DEPENDENCIA' }}
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
                                    @if($equipo->fecha)
                                        {{ date('d-m-Y H:i', strtotime($equipo->fecha)) }}
                                    @else
                                        <span class="text-muted">SIN REGISTRO</span>
                                    @endif
                                </div>

                            </div>
                        </div>

                    </div>


                    <!-- =================================================
                         ASIGNACIÓN Y SEGUIMIENTO
                         ================================================= -->
                    <div class="registro-section-title mt-2">
                        <i class="fas fa-user-cog"></i>
                        ASIGNACIÓN Y SEGUIMIENTO
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

                                    @if($equipo->user_id && $equipo->user)

                                        {{ $equipo->user->name }}
                                        {{ $equipo->user->paterno }}
                                        {{ $equipo->user->materno }}

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

                                    @if($equipo->fecha_asignacion)

                                        {{ date('d-m-Y H:i', strtotime($equipo->fecha_asignacion)) }}

                                    @else

                                        <span class="text-muted">
                                            SIN ASIGNAR
                                        </span>

                                    @endif

                                </div>

                            </div>
                        </div>


                        <!-- FECHA INICIO -->
                        <div class="col-md-4">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-play-circle"></i>
                                    FECHA DE INICIO
                                </div>

                                <div class="registro-view-value">

                                    @if($equipo->fecha_inicio)

                                        {{ date('d-m-Y H:i', strtotime($equipo->fecha_inicio)) }}

                                    @else

                                        <span class="text-muted">
                                            SIN ASIGNAR
                                        </span>

                                    @endif

                                </div>

                            </div>
                        </div>

                    </div>

                </div>


                <!-- =================================================
                     DATOS DEL ACTIVO
                     ================================================= -->
                <div class="registro-section">

                    <div class="registro-section-title">
                        <i class="fas fa-desktop"></i>
                        DATOS {{ $equipo->tipoEquipo?->nombre ?? 'SIN TIPO DE EQUIPO' }}
                    </div>


                    <!-- CÓDIGO GAMEA / RECEPCIÓN -->
                    <div class="row">

                        <div class="col-md-6">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-barcode"></i>
                                    CÓDIGO GAMEA
                                </div>

                                <div class="registro-view-value">
                                    {{ $equipo->cod_gamea ?? 'SIN REGISTRO' }}
                                </div>

                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-receipt"></i>
                                    NÚMERO DE RECEPCIÓN
                                </div>

                                <div class="registro-view-value">

                                    @if($equipo->cod_registro)

                                        {{ $equipo->cod_registro }}

                                    @else

                                        <span class="text-muted">
                                            SIN ASIGNAR
                                        </span>

                                    @endif

                                </div>

                            </div>
                        </div>

                    </div>


                    <!-- TIPO / MARCA / MODELO -->
                    <div class="row">

                        <div class="col-md-4">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-layer-group"></i>
                                    TIPO DE EQUIPO
                                </div>

                                <div class="registro-view-value">
                                    {{ $equipo->tipoEquipo?->nombre ?? 'SIN REGISTRO' }}
                                </div>

                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-tag"></i>
                                    MARCA
                                </div>

                                <div class="registro-view-value">
                                    {{ $equipo->marca ?? 'SIN REGISTRO' }}
                                </div>

                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-cube"></i>
                                    MODELO
                                </div>

                                <div class="registro-view-value">
                                    {{ $equipo->modelo ?? 'SIN REGISTRO' }}
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
                                    {{ $equipo->falla ?? 'SIN REGISTRO' }}
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

                                    {{ $equipo->Estado?->nombre ?? 'SIN ESTADO' }}

                                    @if($equipo->estado_id == 5 && $equipo->fecha_entrega)

                                        <span class="text-muted ml-1">
                                            — Entregado:
                                            {{ date('d-m-Y H:i', strtotime($equipo->fecha_entrega)) }}
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
                                    {{ $equipo->observaciones ?? 'SIN OBSERVACIONES' }}
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

