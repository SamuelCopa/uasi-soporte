<link rel="stylesheet" href="{{ asset('estilos/password.css') }}"> 
<!-- =========================================================
     MODAL VER AUDÍFONO
     ========================================================= -->
<div class="modal fade"
     id="ver{{ $audifono->id }}"
     tabindex="-1"
     role="dialog"
     aria-labelledby="verAudifonoLabel{{ $audifono->id }}"
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
                        <i class="fas fa-headphones"></i>
                    </div>

                    <div>
                        <h5 class="modal-title"
                            id="verAudifonoLabel{{ $audifono->id }}">
                            REGISTRO DE AUDÍFONO
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
                                    <i class="fas fa-user-tag"></i>
                                    ESTADO DEL FUNCIONARIO
                                </div>

                                <div class="registro-view-value">

                                    @if($audifono?->funcionario_activo == 1)
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
                                    <i class="fas fa-user-check"></i>
                                    RECEPCIONADO POR
                                </div>

                                <div class="registro-view-value">

                                    {{ $audifono->reguser?->name }}
                                    {{ $audifono->reguser?->paterno }}
                                    {{ $audifono->reguser?->materno }}

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

                                    {{ strtoupper($audifono->funcionario?->grado_academico) }}
                                    {{ $audifono->funcionario?->nombre }}
                                    {{ $audifono->funcionario?->paterno }}
                                    {{ $audifono->funcionario?->materno }}

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

                                    {{ $audifono->funcionario?->ci }}
                                    {{ $audifono->funcionario?->expedido }}

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

                                    {{ $audifono->funcionario?->celular ?? 'SIN REGISTRO' }}

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

                                    {{ $audifono->funcionario?->email ?? 'SIN REGISTRO' }}

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

                                    {{ $audifono->funcionario?->cargo ?? 'SIN REGISTRO' }}

                                </div>

                            </div>
                        </div>

                    </div>


                    <!-- DEPENDENCIA / FECHA -->
                    <div class="row">

                        <div class="col-md-7">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-building"></i>
                                    DEPENDENCIA
                                </div>

                                <div class="registro-view-value">

                                    {{ $audifono->Dependencia?->dependencias ?? 'SIN DEPENDENCIA' }}

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

                                    @if($audifono->fecha)
                                        {{ date('d-m-Y H:i', strtotime($audifono->fecha)) }}
                                    @else
                                        SIN REGISTRO
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

                                    @if($audifono->user_id)

                                        {{ $audifono->user?->name }}
                                        {{ $audifono->user?->paterno }}
                                        {{ $audifono->user?->materno }}

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

                                    @if($audifono->fecha_asignacion)

                                        {{ date('d-m-Y H:i', strtotime($audifono->fecha_asignacion)) }}

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

                                    @if($audifono->fecha_inicio)

                                        {{ date('d-m-Y H:i', strtotime($audifono->fecha_inicio)) }}

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
                     DATOS DEL AUDÍFONO
                     ================================================= -->
                <div class="registro-section">

                    <div class="registro-section-title">
                        <i class="fas fa-headphones"></i>
                        DATOS DEL AUDÍFONO
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

                                    {{ $audifono->cod_gamea ?? 'SIN ASIGNAR' }}

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

                                    @if($audifono->cod_registro)

                                        {{ $audifono->cod_registro }}

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

                                    {{ $audifono->marca ?? 'SIN REGISTRO' }}

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

                                    {{ $audifono->modelo ?? 'SIN REGISTRO' }}

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

                                    {{ $audifono->falla ?? 'SIN REGISTRO' }}

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

                                    {{ $audifono->Estado?->nombre ?? 'SIN ESTADO' }}

                                    @if($audifono->estado_id == 5 && $audifono->fecha_entrega)

                                        <span class="text-muted">
                                            — {{ date('d-m-Y H:i', strtotime($audifono->fecha_entrega)) }}
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

                                    {{ $audifono->observaciones ?? 'SIN OBSERVACIONES' }}

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
<!-- FIN MODAL VER AUDÍFONO -->

