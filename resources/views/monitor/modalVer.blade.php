<!-- =========================================================
     MODAL VER MONITOR
     ========================================================= -->
<div class="modal fade"
     id="ver{{ $monitor->id }}"
     tabindex="-1"
     role="dialog"
     aria-labelledby="verMonitorLabel{{ $monitor->id }}"
     aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">

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
                            id="verMonitorLabel{{ $monitor->id }}">
                            REGISTRO DE MONITOR
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

                        <!-- Estado funcionario -->
                        <div class="col-md-6">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-user-check"></i>
                                    ESTADO DEL FUNCIONARIO
                                </div>

                                <div class="registro-view-value">
                                    {{ $monitor?->funcionario_activo == 1
                                        ? 'FUNCIONARIO ACTIVO'
                                        : 'EX FUNCIONARIO' }}
                                </div>

                            </div>
                        </div>


                        <!-- Recepcionado por -->
                        <div class="col-md-6">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-user-shield"></i>
                                    RECEPCIONADO POR
                                </div>

                                <div class="registro-view-value">
                                    {{ $monitor->reguser?->name ?? '' }}
                                    {{ $monitor->reguser?->paterno ?? '' }}
                                    {{ $monitor->reguser?->materno ?? '' }}

                                    @if(!$monitor->reguser)
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
                                    NOMBRE DEL FUNCIONARIO
                                </div>

                                <div class="registro-view-value">

                                    {{ strtoupper($monitor->funcionario?->grado_academico ?? '') }}
                                    {{ $monitor->funcionario?->nombre ?? '' }}
                                    {{ $monitor->funcionario?->paterno ?? '' }}
                                    {{ $monitor->funcionario?->materno ?? '' }}

                                    @if(!$monitor->funcionario)
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

                                    {{ $monitor->funcionario?->ci ?? 'SIN REGISTRO' }}

                                    @if($monitor->funcionario?->expedido)
                                        {{ $monitor->funcionario->expedido }}
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
                                    {{ $monitor->funcionario?->celular ?? 'SIN REGISTRO' }}
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
                                    {{ $monitor->funcionario?->email ?? 'SIN REGISTRO' }}
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
                                    {{ $monitor->funcionario?->cargo ?? 'SIN REGISTRO' }}
                                </div>

                            </div>
                        </div>


                        <!-- Dependencia -->
                        <div class="col-md-6">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-building"></i>
                                    DEPENDENCIA
                                </div>

                                <div class="registro-view-value">

                                    {{ $monitor->Dependencia?->dependencias
                                        ?? 'SIN DEPENDENCIA' }}

                                </div>

                            </div>
                        </div>


                        <!-- Fecha recepción -->
                        <div class="col-md-6">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-calendar-alt"></i>
                                    FECHA DE RECEPCIÓN
                                </div>

                                <div class="registro-view-value">

                                    @if($monitor->fecha)
                                        {{ date('d-m-Y H:i', strtotime($monitor->fecha)) }}
                                    @else
                                        <span class="text-muted">
                                            SIN REGISTRO
                                        </span>
                                    @endif

                                </div>

                            </div>
                        </div>


                        <!-- Técnico -->
                        <div class="col-md-4">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-user-cog"></i>
                                    TÉCNICO A CARGO
                                </div>

                                <div class="registro-view-value">

                                    @if($monitor->user_id && $monitor->user)

                                        {{ $monitor->user->name }}
                                        {{ $monitor->user->paterno }}
                                        {{ $monitor->user->materno }}

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

                                    @if($monitor->fecha_asignacion)

                                        {{ date(
                                            'd-m-Y H:i',
                                            strtotime($monitor->fecha_asignacion)
                                        ) }}

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

                                    @if($monitor->fecha_inicio)

                                        {{ date(
                                            'd-m-Y H:i',
                                            strtotime($monitor->fecha_inicio)
                                        ) }}

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
                     DATOS DEL MONITOR
                     ================================================= -->
                <div class="registro-section">

                    <div class="registro-section-title">
                        <i class="fas fa-desktop"></i>
                        DATOS DEL MONITOR
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
                                    {{ $monitor->cod_gamea ?? 'SIN REGISTRO' }}
                                </div>

                            </div>
                        </div>


                        <!-- Número recepción -->
                        <div class="col-md-6">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-hashtag"></i>
                                    NÚMERO DE RECEPCIÓN
                                </div>

                                <div class="registro-view-value">

                                    @if($monitor->cod_registro)

                                        {{ $monitor->cod_registro }}

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
                                    {{ $monitor->marca ?? 'SIN REGISTRO' }}
                                </div>

                            </div>
                        </div>


                        <!-- Modelo -->
                        <div class="col-md-6">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-desktop"></i>
                                    MODELO
                                </div>

                                <div class="registro-view-value">
                                    {{ $monitor->modelo ?? 'SIN REGISTRO' }}
                                </div>

                            </div>
                        </div>


                        <!-- Falla -->
                        <div class="col-md-6">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    FALLA
                                </div>

                                <div class="registro-view-value">
                                    {{ $monitor->falla ?? 'SIN REGISTRO' }}
                                </div>

                            </div>
                        </div>


                        <!-- Tamaño -->
                        <div class="col-md-6">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-ruler-horizontal"></i>
                                    TAMAÑO
                                </div>

                                <div class="registro-view-value">

                                    {{ $monitor->tamano ?? 'SIN REGISTRO' }}

                                    @if($monitor->tamano)
                                        ''
                                    @endif

                                </div>

                            </div>
                        </div>


                        <!-- Estado -->



                        <!-- Observaciones -->
                        <div class="col-md-6">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-comment-alt"></i>
                                    DETALLE DEL TRABAJO REAIZADO
                                </div>

                                <div class="registro-view-value">

                                    {{ $monitor->detalle_trabajo
                                        ?? 'EN ESPERA' }}

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

                                    {{ $monitor->observaciones
                                        ?? 'SIN OBSERVACIONES' }}

                                </div>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-info-circle"></i>
                                    ESTADO
                                </div>

                                <div class="registro-view-value">

                                    {{ $monitor->Estado?->nombre
                                        ?? 'SIN ESTADO' }}

                                    @if($monitor->estado_id == 5 && $monitor->fecha_entrega)

                                        <span class="text-muted">
                                            —
                                            {{ date(
                                                'd-m-Y H:i',
                                                strtotime($monitor->fecha_entrega)
                                            ) }}
                                        </span>

                                    @endif

                                </div>

                            </div>
                        </div>
                    </div>

                </div>


                <!-- =================================================
                     INFORMACIÓN
                     ================================================= -->
                <div class="registro-required">

                    <i class="fas fa-info-circle"></i>

                    Información de consulta del registro.
                    Los datos mostrados corresponden al estado actual
                    del monitor.

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