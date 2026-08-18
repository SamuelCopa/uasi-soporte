
<!--ventana para Update--->

<div class="modal fade" id="ver{{ $registroCpu->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
    <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
        <div class="modal-header modal-header bg-primary text-white border-0 py-3">
            <h4>REGISTRO</h4>
        <button type="button" class="btn-close bg-primary" data-dismiss="modal" aria-label="Cerrar"><i class="fas fa-times"></i></button>
        </div>
      <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                      <fieldset class="fieldset1">
                          <legend class="legend1">DATOS DEL SOLICITANTE</legend>
                        <div class="fila-1">
                              <div class="div title">
                                  <label>ESTADO DEL FUNCIONARIO: </label>
                                  @if($registroCpu?->funcionario_activo == 1)
                                <div class="form-control">{{ 'FUNCIONARIO ACTIVO'}}</div>
                                  @else
                                <div class="form-control">{{ 'EX FUNCIONARIO'}}</div>
                                  @endif
                              </div>
                              <div class="div title">
                                  <label>RECEPCIONADO POR: </label>
                              <div class="form-control">{{$registroCpu->reguser?->name}} {{$registroCpu->reguser?->paterno}} {{$registroCpu->reguser?->materno}}</div> 
                              </div>
                        </div>
                        <div class="fila-1">
                              <div class="div title">
                                  <label>NOMBRE: </label>
                                <div class="form-control">{{ $registroCpu->funcionario?->grado_academico }} {{ $registroCpu->funcionario?->nombre }} {{ $registroCpu->funcionario?->paterno }} {{ $registroCpu->funcionario?->materno }}</div>  
                              </div>
                              <div class="div title">
                                <label>C.I.: </label>
                              <div class="form-control">{{ $registroCpu->funcionario?->ci }} {{ $registroCpu->funcionario?->expedido }}</div> 
                            </div>
                        </div>
                        <div class="fila-2">
                            <div class="div title">
                              <label>CELULAR: </label>
                            <div class="form-control">{{ $registroCpu->funcionario?->celular }}</div> 
                          </div>
                          <div class="div title">
                            <label>CORREO ELECTRÓNICO: </label>
                            <div class="form-control">{{ $registroCpu->funcionario?->email }}</div>
                          </div>
                          <div class="div title">
                            <label>CARGO: </label>
                            <div class="form-control">{{ $registroCpu->funcionario?->cargo }}</div>
                          </div>
                        </div>
                        <div class="fila-1">
                          @if(! $registroCpu->dependencia_id == '')
                          <div class="div title" >
                          <label>DEPENDENCIA:</label>
                         <div class="form-control">{{ $registroCpu->Dependencia?->dependencias }}</div> 
                          </div>
                          @else
                          <div class="div title" >
                          <label>DEPENDENCIA:</label>
                         <div class="form-control">{{'SIN DEPENDENCIA'}}</div> 
                          </div>
                          @endif
                          <div class="div title">
                            <label>FECHA DE RECEPCIÓN: </label>
                            @if($registroCpu->fecha)
                          <div class="form-control">{{ date('d-m-Y H:i',strtotime($registroCpu->fecha))}}</div> 
                            @elseif(! $registroCpu->fecha)	
                          <div class="form-control">{{ $registroCpu->fecha ?? ''}}</div> 
                            @endif	
                          </div>
                        </div>
                        <div class="fila-2">
                            <div class="div title">
                              <label>TECNICO A CARGO: </label>
                              <div class="{{ empty($registroCpu->user_id) ? 'color1' : '' }}" >
                                  @if($registroCpu->user_id)
                                <div class="form-control">{{ $registroCpu->user->name}} {{ $registroCpu->user->paterno}} {{ $registroCpu->user->materno}}</div> 
                                  @elseif(! $registroCpu->user_id)	
                                <div class="form-control ">{{ $registroCpu->user->name ?? 'SIN ASIGNAR'}}</div> 
                                  @endif
                              </div>
                            </div>
                            <div class="div title">
                            <label>FECHA DE ASIGNACIÓN: </label>
                            <div class="{{ empty($registroCpu->fecha_asignacion) ? 'color1' : '' }}">
                              @if($registroCpu->fecha_asignacion)
                              <div class="form-control">{{ date('d-m-Y H:i',strtotime($registroCpu->fecha_asignacion ))}}</div> 
                              @elseif(! $registroCpu->fecha_asignacion)	
                              <div class="form-control">{{ $registroCpu->fecha_asignacion ?? 'SIN ASIGNAR'}}</div> 
                              @endif								
                          </div>
                            </div>
                          <div class="div title">
                            <label>FECHA DE INICIO: </label>
                            <div class="{{ empty($registroCpu->fecha_inicio) ? 'color1' : '' }}">
                              @if($registroCpu->fecha_inicio)
                              <div class="form-control">{{ date('d-m-Y H:i',strtotime($registroCpu->fecha_inicio ))}}</div> 
                              @elseif(! $registroCpu->fecha_inicio)	
                              <div class="form-control">{{ $registroCpu->fecha_inicio ?? 'EN ESPERA'}}</div> 
                              @endif								
                          </div>
                          </div>
                      </div>
                      </fieldset>
                      <fieldset class="fieldset1">
                          <legend class="legend1">DATOS DEL CPU</legend>
                          <div class="fila-1">
                            <div class="div title">
                              <label>CODIGO GAMEA: </label>
                              <div class="form-control">{{ $registroCpu->cod_gamea }}</div>
                            </div>
                            <div class="div title">
                              <label>NÚMERO DE RECEPCIÓN: </label>
                              <div class="{{ empty($registroCpu->cod_registro) ? 'color1' : '' }}">
                                <div class="form-control">{{ $registroCpu->cod_registro ?? 'SIN ASIGNAR' }}</div>
                              </div>
                            </div>
                          </div>
                          <div class="fila-1">
                            <div class="div title">
                              <label>USUARIO: </label>
                              <div class="form-control">{{ $registroCpu->usuario ?? '-------------' }}</div>
                            </div>
                            <div class="div title">
                              <label>CONTRASEÑA: </label>
                              <div class="form-control">{{ $registroCpu->contrasena ?? '----------'  }}</div>
                            </div>
                          </div>
                          <div class="fila-3">
                            <div class="div title" align="center">
                              <h4 class="color10">PIEZAS</h4>
                            </div>
                          </div>
                          <div class="fila-1">
                            <div class="div title">
                              <label>CASE:</label> 
                              <div class="form-control">{{ $registroCpu->Marcacase?->marca}} {{ $registroCpu->colorcase?->color }}</div>
                            </div>
                            <div class="div title">
                              <label>PROCESADOR:</label>
                              <div class="form-control">{{ $registroCpu->Marcaprocesador?->marca}}   {{ $registroCpu->Modeloprocesador?->modelo }}  {{ $registroCpu->Genprocesador?->generacion}}</div>
                            </div>
                          </div>

                          <div class="fila-1">
                            <div class="div title">
                              <label>TARJETA MADRE :</label> 
                              <div class="form-control">{{ $registroCpu->Marcatmadre?->marca}}  {{ $registroCpu->ModeloTmadre?->modelo }} </div>
                            </div>
                            <div class="div title">
                              <label>DISCO DURO :</label>
                              <div class="form-control">{{ $registroCpu->Marcadisco?->marca }} {{ $registroCpu->CapacidadDisco?->capacidad }}  {{ $registroCpu->TipoDisco?->tipo }}</div>                                        
                            </div>
                          </div>
                          <div class="fila-1">
                            <div class="div title">
                              <label>MEMORIA RAM :</label>                                            
                                @if($registroCpu->DisipadorRam && $registroCpu->DisipadorRam->opcion)
                                <div class="form-control">DISIPADOR {{ $registroCpu->DisipadorRam?->opcion }}, {{ $registroCpu->MarcaRam?->marca }}  {{ $registroCpu->TipoRam?->tipo }} {{ $registroCpu->CapacidadRam?->capacidad }} {{ $registroCpu->CantidadRam?->cantidad }}</div>
                                @endif
                                @if($registroCpu->DisipadorRam2 && $registroCpu->DisipadorRam2->opcion)
                                <div class="form-control">DISIPADOR {{ $registroCpu->DisipadorRam2?->opcion }}, {{ $registroCpu->MarcaRam2?->marca }}  {{ $registroCpu->TipoRam2?->tipo }} {{ $registroCpu->CapacidadRam2?->capacidad }} {{ $registroCpu->CantidadRam2?->cantidad }}</div>
                                @endif
                                @if($registroCpu->DisipadorRam3 && $registroCpu->DisipadorRam3->opcion)
                                <div class="form-control">DISIPADOR {{ $registroCpu->DisipadorRam3?->opcion }}, {{ $registroCpu->MarcaRam3?->marca }}  {{ $registroCpu->TipoRam3?->tipo }} {{ $registroCpu->CapacidadRam3?->capacidad }} {{ $registroCpu->CantidadRam3?->cantidad }}</div>
                                @endif
                                @if($registroCpu->DisipadorRam4 && $registroCpu->DisipadorRam4->opcion)
                                <div class="form-control"> DISIPADOR {{ $registroCpu->DisipadorRam4?->opcion }}, {{ $registroCpu->MarcaRam4?->marca }}  {{ $registroCpu->TipoRam4?->tipo }} {{ $registroCpu->CapacidadRam4?->capacidad }} {{ $registroCpu->CantidadRam4?->cantidad }}</div>
                                @endif
                            </div>
                            <div class="div title">
                              <label>TARJETA DE VIDEO :</label>                                            
                              <div class="form-control">{{ $registroCpu->MarcaTvideo->marca ?? 'INTEGRADO' }}  {{ $registroCpu->CapacidadTvideo?->capacidad }} {{ $registroCpu->TipoTvideo?->tipo }}</div>
                            </div>
                          </div>

                          <div class="fila-1">
                            <div class="div title">
                              <label>TARJETA DE RED :</label>                                            
                              <div class="form-control">{{ $registroCpu->MarcaTred->marca ?? 'NINGUNA' }}  {{ $registroCpu->ModeloTred?->modelo }}</div>
                            </div>
                            <div class="div title">
                              <label>TARJETA WI-FI :</label>                                            
                              <div class="form-control">{{ $registroCpu->MarcaTwifi->marca ?? 'NINGUNA' }} {{ $registroCpu->modeloWifi?->modelo }} @if($registroCpu->antena_id == 1){{ 'CON ANTENA' }} @else {{ 'SIN ANTENA' }} @endif</div>
                            </div>
                          </div>

                          <div class="fila-1">
                            <div class="div title">
                              <label>FUENTE:</label>                                            
                              <div class="form-control">{{ $registroCpu->MarcaFuente?->marca }}  {{ $registroCpu->PotenciaFuente?->potencia }} @if($registroCpu->cable_id == 1){{ 'CON CABLE DE PODER' }} @else {{ 'SIN CABLE DE PODER' }} @endif</div>
                            </div>
                            <div class="div title">
                              <label>LECTOR CD :</label>                                            
                              <div class="form-control">{{ $registroCpu->MarcaLectorcd->nombre ?? 'NO' }}</div>
                            </div>
                          </div>

                          <div class="fila-1">
                            <div class="div title">
                              <label>TIPO DE FALLA:</label> 
                              <div class="form-control">{{ $registroCpu->falla }}</div>                                           
                            </div>
                            <div class="div title">
                              <label>REQUIERE RESPALDO:</label>  
                              <div class="form-control">{{ $registroCpu->respaldo }}</div>
                            </div>
                          </div>
                          <div class="fila-1">
                            <div class="div title">
                              <label>OTROS:</label>  
                              <div class="form-control">{{ $registroCpu->otro ?? '----------------'}}</div>
                            </div>
                            <div class="div title">
                              <label>OBSERVACIONES: </label>
                              <div class="form-control">{{$registroCpu->observaciones ?? 'SIN OBSERVACIONES'}}</div>
                            </div>
                          </div>
                          <div class="fila-1">
                          <div class="div title">
                            <label>ESTADO: </label>
                            @if ($registroCpu->estado_id == 5)
                              <div class="form-control">{{ $registroCpu->Estado?->nombre }} {{ date('d-m-Y H:i',strtotime($registroCpu->fecha_entrega ))}}</div>
                            @else
                              <div class="form-control">{{ $registroCpu->Estado?->nombre }}</div> 
                            @endif
                          </div>
                          </div>
                      </fieldset>
                      </div>
                  </div>
              </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
                  </div>
          </div>
      </section>
      </div>
    </div>
  </div>
  <!---fin ventana Update --->