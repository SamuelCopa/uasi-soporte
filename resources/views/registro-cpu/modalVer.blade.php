```blade
<!-- =========================================================
     MODAL VER CPU
     ========================================================= -->
<div class="modal fade"
     id="ver{{ $registroCpu->id }}"
     tabindex="-1"
     role="dialog"
     aria-labelledby="verCpuLabel{{ $registroCpu->id }}"
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
                            id="verCpuLabel{{ $registroCpu->id }}">
                            REGISTRO DE CPU
                        </h5>

                        <small>
                            Información del equipo y datos del solicitante
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
                        <span>DATOS DEL SOLICITANTE</span>
                    </div>


                    <div class="row">

                        <!-- ESTADO FUNCIONARIO -->
                        <div class="col-md-6">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-user-check"></i>
                                    ESTADO DEL FUNCIONARIO
                                </div>

                                <div class="registro-view-value">

                                    @if($registroCpu->funcionario_activo == 1)
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
                                    <i class="fas fa-user-tie"></i>
                                    RECEPCIONADO POR
                                </div>

                                <div class="registro-view-value">
                                    {{ $registroCpu->reguser?->name }}
                                    {{ $registroCpu->reguser?->paterno }}
                                    {{ $registroCpu->reguser?->materno }}
                                </div>

                            </div>

                        </div>


                        <!-- NOMBRE -->
                        <div class="col-md-8">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-user"></i>
                                    NOMBRE
                                </div>

                                <div class="registro-view-value">
                                    {{ $registroCpu->funcionario?->grado_academico }}
                                    {{ $registroCpu->funcionario?->nombre }}
                                    {{ $registroCpu->funcionario?->paterno }}
                                    {{ $registroCpu->funcionario?->materno }}
                                </div>

                            </div>

                        </div>


                        <!-- CI -->
                        <div class="col-md-4">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-id-card"></i>
                                    C.I.
                                </div>

                                <div class="registro-view-value">
                                    {{ $registroCpu->funcionario?->ci }}
                                    {{ $registroCpu->funcionario?->expedido }}
                                </div>

                            </div>

                        </div>


                        <!-- CELULAR -->
                        <div class="col-md-4">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-phone"></i>
                                    CELULAR
                                </div>

                                <div class="registro-view-value">
                                    {{ $registroCpu->funcionario?->celular ?? 'SIN REGISTRO' }}
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
                                    {{ $registroCpu->funcionario?->email ?? 'SIN REGISTRO' }}
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
                                    {{ $registroCpu->funcionario?->cargo ?? 'SIN REGISTRO' }}
                                </div>

                            </div>

                        </div>


                        <!-- DEPENDENCIA -->
                        <div class="col-md-6">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-building"></i>
                                    DEPENDENCIA
                                </div>

                                <div class="registro-view-value">
                                    {{ $registroCpu->Dependencia?->dependencias ?? 'SIN DEPENDENCIA' }}
                                </div>

                            </div>

                        </div>


                        <!-- FECHA RECEPCIÓN -->
                        <div class="col-md-6">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-calendar-alt"></i>
                                    FECHA DE RECEPCIÓN
                                </div>

                                <div class="registro-view-value">

                                    @if($registroCpu->fecha)
                                        {{ date('d-m-Y H:i', strtotime($registroCpu->fecha)) }}
                                    @else
                                        SIN REGISTRO
                                    @endif

                                </div>

                            </div>

                        </div>


                        <!-- TÉCNICO -->
                        <div class="col-md-4">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-user-cog"></i>
                                    TÉCNICO A CARGO
                                </div>

                                <div class="registro-view-value">

                                    @if($registroCpu->user_id)

                                        {{ $registroCpu->user?->name }}
                                        {{ $registroCpu->user?->paterno }}
                                        {{ $registroCpu->user?->materno }}

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

                                    @if($registroCpu->fecha_asignacion)
                                        {{ date('d-m-Y H:i', strtotime($registroCpu->fecha_asignacion)) }}
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

                                    @if($registroCpu->fecha_inicio)
                                        {{ date('d-m-Y H:i', strtotime($registroCpu->fecha_inicio)) }}
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
                     DATOS DEL CPU
                     ================================================= -->
                <div class="registro-section">

                    <div class="registro-section-title">
                        <i class="fas fa-desktop"></i>
                        <span>DATOS DEL CPU</span>
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
                                    {{ $registroCpu->cod_gamea ?? 'SIN REGISTRO' }}
                                </div>

                            </div>

                        </div>


                        <!-- NÚMERO RECEPCIÓN -->
                        <div class="col-md-6">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-hashtag"></i>
                                    NÚMERO DE RECEPCIÓN
                                </div>

                                <div class="registro-view-value">
                                    {{ $registroCpu->cod_registro ?? 'SIN ASIGNAR' }}
                                </div>

                            </div>

                        </div>


                        <!-- USUARIO -->
                        <div class="col-md-6">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-user"></i>
                                    USUARIO
                                </div>

                                <div class="registro-view-value">
                                    {{ $registroCpu->usuario ?? '-------------' }}
                                </div>

                            </div>

                        </div>


                        <!-- CONTRASEÑA -->
                        <div class="col-md-6">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-key"></i>
                                    CONTRASEÑA
                                </div>

                                <div class="registro-view-value">
                                    {{ $registroCpu->contrasena ?? '----------' }}
                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- =================================================
                     PIEZAS DEL CPU
                     ================================================= -->
                <div class="registro-section">

                    <div class="registro-section-title">
                        <i class="fas fa-microchip"></i>
                        <span>PIEZAS DEL EQUIPO</span>
                    </div>


                    <div class="row">

                        <!-- CASE -->
                        <div class="col-md-6">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-desktop"></i>
                                    CASE
                                </div>

                                <div class="registro-view-value">
                                    {{ $registroCpu->Marcacase?->marca ?? 'SIN MARCA' }}
                                    {{ $registroCpu->colorcase?->color }}
                                </div>

                            </div>

                        </div>


                        <!-- PROCESADOR -->
                        <div class="col-md-6">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-microchip"></i>
                                    PROCESADOR
                                </div>

                                <div class="registro-view-value">
                                    {{ $registroCpu->Marcaprocesador?->marca ?? 'SIN MARCA' }}
                                    {{ $registroCpu->Modeloprocesador?->modelo }}
                                    {{ $registroCpu->Genprocesador?->generacion }}
                                </div>

                            </div>

                        </div>


                        <!-- TARJETA MADRE -->
                        <div class="col-md-6">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-memory"></i>
                                    TARJETA MADRE
                                </div>

                                <div class="registro-view-value">
                                    {{ $registroCpu->Marcatmadre?->marca ?? 'SIN MARCA' }}
                                    {{ $registroCpu->ModeloTmadre?->modelo }}
                                </div>

                            </div>

                        </div>


                        <!-- DISCO -->
                        <div class="col-md-6">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-hdd"></i>
                                    DISCO DURO
                                </div>

                                <div class="registro-view-value">
                                    {{ $registroCpu->Marcadisco?->marca ?? 'SIN MARCA' }}
                                    {{ $registroCpu->CapacidadDisco?->capacidad }}
                                    {{ $registroCpu->TipoDisco?->tipo }}
                                </div>

                            </div>

                        </div>


                        <!-- MEMORIA RAM -->
                        <div class="col-md-6">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-memory"></i>
                                    MEMORIA RAM
                                </div>

                                <div class="registro-view-value">

                                    @php
                                        $ramRegistrada = false;
                                    @endphp

                                    @if($registroCpu->DisipadorRam?->opcion)
                                        @php $ramRegistrada = true; @endphp
                                        <div class="mb-1">
                                            DISIPADOR {{ $registroCpu->DisipadorRam->opcion }},
                                            {{ $registroCpu->MarcaRam?->marca }}
                                            {{ $registroCpu->TipoRam?->tipo }}
                                            {{ $registroCpu->CapacidadRam?->capacidad }}
                                            {{ $registroCpu->CantidadRam?->cantidad }}
                                        </div>
                                    @endif

                                    @if($registroCpu->DisipadorRam2?->opcion)
                                        @php $ramRegistrada = true; @endphp
                                        <div class="mb-1">
                                            DISIPADOR {{ $registroCpu->DisipadorRam2->opcion }},
                                            {{ $registroCpu->MarcaRam2?->marca }}
                                            {{ $registroCpu->TipoRam2?->tipo }}
                                            {{ $registroCpu->CapacidadRam2?->capacidad }}
                                            {{ $registroCpu->CantidadRam2?->cantidad }}
                                        </div>
                                    @endif

                                    @if($registroCpu->DisipadorRam3?->opcion)
                                        @php $ramRegistrada = true; @endphp
                                        <div class="mb-1">
                                            DISIPADOR {{ $registroCpu->DisipadorRam3->opcion }},
                                            {{ $registroCpu->MarcaRam3?->marca }}
                                            {{ $registroCpu->TipoRam3?->tipo }}
                                            {{ $registroCpu->CapacidadRam3?->capacidad }}
                                            {{ $registroCpu->CantidadRam3?->cantidad }}
                                        </div>
                                    @endif

                                    @if($registroCpu->DisipadorRam4?->opcion)
                                        @php $ramRegistrada = true; @endphp
                                        <div>
                                            DISIPADOR {{ $registroCpu->DisipadorRam4->opcion }},
                                            {{ $registroCpu->MarcaRam4?->marca }}
                                            {{ $registroCpu->TipoRam4?->tipo }}
                                            {{ $registroCpu->CapacidadRam4?->capacidad }}
                                            {{ $registroCpu->CantidadRam4?->cantidad }}
                                        </div>
                                    @endif

                                    @if(!$ramRegistrada)
                                        SIN REGISTRO
                                    @endif

                                </div>

                            </div>

                        </div>


                        <!-- VIDEO -->
                        <div class="col-md-6">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-video"></i>
                                    TARJETA DE VIDEO
                                </div>

                                <div class="registro-view-value">
                                    {{ $registroCpu->MarcaTvideo?->marca ?? 'INTEGRADO' }}
                                    {{ $registroCpu->CapacidadTvideo?->capacidad }}
                                    {{ $registroCpu->TipoTvideo?->tipo }}
                                </div>

                            </div>

                        </div>


                        <!-- RED -->
                        <div class="col-md-6">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-network-wired"></i>
                                    TARJETA DE RED
                                </div>

                                <div class="registro-view-value">
                                    {{ $registroCpu->MarcaTred?->marca ?? 'NINGUNA' }}
                                    {{ $registroCpu->ModeloTred?->modelo }}
                                </div>

                            </div>

                        </div>


                        <!-- WI-FI -->
                        <div class="col-md-6">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-wifi"></i>
                                    TARJETA WI-FI
                                </div>

                                <div class="registro-view-value">

                                    {{ $registroCpu->MarcaTwifi?->marca ?? 'NINGUNA' }}
                                    {{ $registroCpu->modeloWifi?->modelo }}

                                    @if($registroCpu->antena_id == 1)
                                        — CON ANTENA
                                    @else
                                        — SIN ANTENA
                                    @endif

                                </div>

                            </div>

                        </div>


                        <!-- FUENTE -->
                        <div class="col-md-6">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-plug"></i>
                                    FUENTE
                                </div>

                                <div class="registro-view-value">

                                    {{ $registroCpu->MarcaFuente?->marca ?? 'SIN MARCA' }}
                                    {{ $registroCpu->PotenciaFuente?->potencia }}

                                    @if($registroCpu->cable_id == 1)
                                        — CON CABLE DE PODER
                                    @else
                                        — SIN CABLE DE PODER
                                    @endif

                                </div>

                            </div>

                        </div>


                        <!-- LECTOR CD -->
                        <div class="col-md-6">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-compact-disc"></i>
                                    LECTOR CD
                                </div>

                                <div class="registro-view-value">
                                    {{ $registroCpu->MarcaLectorcd?->nombre ?? 'NO' }}
                                </div>

                            </div>

                        </div>


                        <!-- TIPO DE FALLA -->
                        <div class="col-md-6">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    TIPO DE FALLA
                                </div>

                                <div class="registro-view-value">
                                    {{ $registroCpu->falla ?? 'SIN REGISTRO' }}
                                </div>

                            </div>

                        </div>


                        <!-- RESPALDO -->
                        <div class="col-md-6">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-database"></i>
                                    REQUIERE RESPALDO
                                </div>

                                <div class="registro-view-value">
                                    {{ $registroCpu->respaldo ?? 'SIN REGISTRO' }}
                                </div>

                            </div>

                        </div>


                        <!-- OTROS -->
                        <div class="col-md-6">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-list"></i>
                                    OTROS
                                </div>

                                <div class="registro-view-value">
                                    {{ $registroCpu->otro ?? '----------------' }}
                                </div>

                            </div>

                        </div>


                        <!-- OBSERVACIONES -->
                        <div class="col-md-6">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-comment-alt"></i>
                                    OBSERVACIONES
                                </div>

                                <div class="registro-view-value">
                                    {{ $registroCpu->observaciones ?? 'SIN OBSERVACIONES' }}
                                </div>

                            </div>

                        </div>


                        <!-- ESTADO -->
                        <div class="col-md-12">

                            <div class="registro-view-field">

                                <div class="registro-view-label">
                                    <i class="fas fa-info-circle"></i>
                                    ESTADO
                                </div>

                                <div class="registro-view-value">

                                    {{ $registroCpu->Estado?->nombre ?? 'SIN ESTADO' }}

                                    @if($registroCpu->estado_id == 5 && $registroCpu->fecha_entrega)
                                        —
                                        {{ date('d-m-Y H:i', strtotime($registroCpu->fecha_entrega)) }}
                                    @endif

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

                    <i class="fas fa-times mr-1"></i>
                    CERRAR

                </button>

            </div>

        </div>

    </div>
</div>
<!-- =========================================================
     FIN MODAL VER CPU
     ========================================================= -->
```
