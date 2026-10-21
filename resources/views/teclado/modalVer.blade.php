<div class="modal fade"
     id="ver{{ $teclado->id }}"
     tabindex="-1"
     role="dialog"
     aria-labelledby="verTecladoLabel{{ $teclado->id }}"
     aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-centered"
         role="document">

        <div class="modal-content modal-password">

            {{-- =====================================================
                 HEADER
                 ===================================================== --}}
            <div class="modal-header modal-password-header">

                <div class="modal-title-container">

                    <div class="modal-password-icon">
                        <i class="fas fa-keyboard"></i>
                    </div>

                    <div>
                        <h5 class="modal-title"
                            id="verTecladoLabel{{ $teclado->id }}">
                            REGISTRO DE TECLADO
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


            {{-- =====================================================
                 BODY
                 ===================================================== --}}
            <div class="modal-body modal-password-body">

                {{-- =================================================
                     DATOS DEL SOLICITANTE
                     ================================================= --}}
                <div class="registro-section">

                    <div class="registro-section-title">
                        <i class="fas fa-user"></i>
                        DATOS DEL SOLICITANTE
                    </div>


                    <div class="row">

                        {{-- Estado funcionario --}}
                        <div class="col-md-4">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-user-check"></i>
                                    ESTADO DEL FUNCIONARIO
                                </div>

                                <div class="registro-view-value">

                                    @if($teclado?->funcionario_activo == 1)
                                        FUNCIONARIO ACTIVO
                                    @else
                                        EX FUNCIONARIO
                                    @endif

                                </div>

                            </div>
                        </div>


                        {{-- Recepcionado por --}}
                        <div class="col-md-4">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-user-shield"></i>
                                    RECEPCIONADO POR
                                </div>

                                <div class="registro-view-value">

                                    {{ $teclado->reguser?->name }}
                                    {{ $teclado->reguser?->paterno }}
                                    {{ $teclado->reguser?->materno }}

                                </div>

                            </div>
                        </div>


                        {{-- Dependencia --}}
                        <div class="col-md-4">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-building"></i>
                                    DEPENDENCIA
                                </div>

                                <div class="registro-view-value">

                                    {{ $teclado->Dependencia?->dependencias ?? 'SIN DEPENDENCIA' }}

                                </div>

                            </div>
                        </div>

                    </div>


                    <div class="row">

                        {{-- Nombre --}}
                        <div class="col-md-8">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-id-card"></i>
                                    NOMBRE COMPLETO
                                </div>

                                <div class="registro-view-value">

                                    {{ strtoupper($teclado->funcionario?->grado_academico) }}
                                    {{ $teclado->funcionario?->nombre }}
                                    {{ $teclado->funcionario?->paterno }}
                                    {{ $teclado->funcionario?->materno }}

                                </div>

                            </div>
                        </div>


                        {{-- CI --}}
                        <div class="col-md-4">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-address-card"></i>
                                    C.I.
                                </div>

                                <div class="registro-view-value">

                                    {{ $teclado->funcionario?->ci }}
                                    {{ $teclado->funcionario?->expedido }}

                                </div>

                            </div>
                        </div>

                    </div>


                    <div class="row">

                        {{-- Celular --}}
                        <div class="col-md-4">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-mobile-alt"></i>
                                    CELULAR
                                </div>

                                <div class="registro-view-value">

                                    {{ $teclado->funcionario?->celular ?? 'SIN REGISTRO' }}

                                </div>

                            </div>
                        </div>


                        {{-- Correo --}}
                        <div class="col-md-4">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-envelope"></i>
                                    CORREO ELECTRÓNICO
                                </div>

                                <div class="registro-view-value">

                                    {{ $teclado->funcionario?->email ?? 'SIN REGISTRO' }}

                                </div>

                            </div>
                        </div>


                        {{-- Cargo --}}
                        <div class="col-md-4">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-briefcase"></i>
                                    CARGO
                                </div>

                                <div class="registro-view-value">

                                    {{ $teclado->funcionario?->cargo ?? 'SIN REGISTRO' }}

                                </div>

                            </div>
                        </div>

                    </div>


                    <div class="row">

                        {{-- Fecha recepción --}}
                        <div class="col-md-4">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-calendar-alt"></i>
                                    FECHA DE RECEPCIÓN
                                </div>

                                <div class="registro-view-value">

                                    @if($teclado->fecha)
                                        {{ date('d-m-Y H:i', strtotime($teclado->fecha)) }}
                                    @else
                                        SIN REGISTRO
                                    @endif

                                </div>

                            </div>
                        </div>


                        {{-- Técnico --}}
                        <div class="col-md-4">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-user-cog"></i>
                                    TÉCNICO A CARGO
                                </div>

                                <div class="registro-view-value">

                                    @if($teclado->user_id)

                                        {{ $teclado->user?->name }}
                                        {{ $teclado->user?->paterno }}
                                        {{ $teclado->user?->materno }}

                                    @else

                                        <span class="text-muted">
                                            SIN ASIGNAR
                                        </span>

                                    @endif

                                </div>

                            </div>
                        </div>


                        {{-- Fecha asignación --}}
                        <div class="col-md-4">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-calendar-check"></i>
                                    FECHA DE ASIGNACIÓN
                                </div>

                                <div class="registro-view-value">

                                    @if($teclado->fecha_asignacion)

                                        {{ date('d-m-Y H:i', strtotime($teclado->fecha_asignacion)) }}

                                    @else

                                        <span class="text-muted">
                                            SIN ASIGNAR
                                        </span>

                                    @endif

                                </div>

                            </div>
                        </div>

                    </div>


                    <div class="row">

                        {{-- Fecha inicio --}}
                        <div class="col-md-4">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-play-circle"></i>
                                    FECHA DE INICIO
                                </div>

                                <div class="registro-view-value">

                                    @if($teclado->fecha_inicio)

                                        {{ date('d-m-Y H:i', strtotime($teclado->fecha_inicio)) }}

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


                {{-- =================================================
                     DATOS DEL TECLADO
                     ================================================= --}}
                <div class="registro-section">

                    <div class="registro-section-title">
                        <i class="fas fa-keyboard"></i>
                        DATOS DEL TECLADO
                    </div>


                    <div class="row">

                        {{-- Código GAMEA --}}
                        <div class="col-md-4">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-barcode"></i>
                                    CÓDIGO GAMEA
                                </div>

                                <div class="registro-view-value">

                                    {{ $teclado->cod_gamea ?? 'SIN REGISTRO' }}

                                </div>

                            </div>
                        </div>


                        {{-- Número recepción --}}
                        <div class="col-md-4">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-hashtag"></i>
                                    NÚMERO DE RECEPCIÓN
                                </div>

                                <div class="registro-view-value">

                                    {{ $teclado->cod_registro ?? 'SIN ASIGNAR' }}

                                </div>

                            </div>
                        </div>


                        {{-- Marca --}}
                        <div class="col-md-4">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-tag"></i>
                                    MARCA
                                </div>

                                <div class="registro-view-value">

                                    {{ $teclado->marca ?? 'SIN REGISTRO' }}

                                </div>

                            </div>
                        </div>

                    </div>


                    <div class="row">

                        {{-- Modelo --}}
                        <div class="col-md-4">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-keyboard"></i>
                                    MODELO
                                </div>

                                <div class="registro-view-value">

                                    {{ $teclado->modelo ?? 'SIN REGISTRO' }}

                                </div>

                            </div>
                        </div>


                        {{-- Falla --}}
                        <div class="col-md-4">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    FALLA
                                </div>

                                <div class="registro-view-value">

                                    {{ $teclado->falla ?? 'SIN REGISTRO' }}

                                </div>

                            </div>
                        </div>


                        {{-- Estado --}}
                        <div class="col-md-4">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-tasks"></i>
                                    ESTADO
                                </div>

                                <div class="registro-view-value">

                                    {{ $teclado->Estado?->nombre ?? 'SIN ESTADO' }}

                                    @if($teclado->estado_id == 5 && $teclado->fecha_entrega)

                                        <small class="d-block text-muted mt-1">
                                            <i class="fas fa-calendar-check"></i>
                                            Entregado:
                                            {{ date('d-m-Y H:i', strtotime($teclado->fecha_entrega)) }}
                                        </small>

                                    @endif

                                </div>

                            </div>
                        </div>

                    </div>


                    {{-- Observaciones --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-comment-alt"></i>
                                    DETALLE DEL TRABAJO REAIZADO
                                </div>

                                <div class="registro-view-value">

                                    {{ $teclado->detalle_trabajo
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

                                    {{ $teclado->observaciones ?? 'SIN OBSERVACIONES' }}

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =====================================================
                 FOOTER
                 ===================================================== --}}
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