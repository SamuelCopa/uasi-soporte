<div class="modal fade" id="ver{{ $teclado->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                  @if($teclado?->funcionario_activo == 1)
                                <div class="form-control">{{ 'FUNCIONARIO ACTIVO'}}</div>
                                  @else
                                <div class="form-control">{{ 'EX FUNCIONARIO'}}</div>
                                  @endif
                              </div>
                              <div class="div title">
                                  <label>RECEPCIONADO POR: </label>
                                  <div class="form-control">{{$teclado->reguser?->name}} {{$teclado->reguser?->paterno}} {{$teclado->reguser?->materno}}</div> 
                              </div>
                        </div>
                        <div class="fila-1">
                              <div class="div title">
                                  <label>NOMBRE: </label>
                                <div class="form-control">{{ strtoupper($teclado->funcionario?->grado_academico)}} {{ $teclado->funcionario?->nombre }} {{ $teclado->funcionario?->paterno }} {{ $teclado->funcionario?->materno }}</div>  
                              </div>
                              <div class="div title">
                                <label>C.I.: </label>
                                  <div class="form-control">{{ $teclado->funcionario?->ci }} {{ $teclado->funcionario?->expedido }}</div> 
                            </div>
                        </div>
                        <div class="fila-2">
                            <div class="div title">
                              <label>CELULAR: </label>
                            <div class="form-control">{{ $teclado->funcionario?->celular }}</div> 
                          </div>
                          <div class="div title">
                            <label>CORREO ELECTRÓNICO: </label>
                            <div class="form-control">{{ $teclado->funcionario?->email }}</div>
                          </div>
                          <div class="div title">
                            <label>CARGO: </label>
                            <div class="form-control">{{ $teclado->funcionario?->cargo }}</div>
                          </div>
                        </div>
                        <div class="fila-1">
                          @if(! $teclado->dependencia_id == '')
                          <div class="div title" >
                          <label>DEPENDENCIA:</label>
                            <div class="form-control">{{ $teclado->Dependencia?->dependencias }}</div> 
                          </div>
                          @else
                          <div class="div title" >
                          <label>DEPENDENCIA:</label>
                            <div class="form-control">{{'SIN DEPENDENCIA'}}</div> 
                          </div>
                          @endif
                          <div class="div title">
                            <label>FECHA DE RECEPCIÓN: </label>
                            @if($teclado->fecha)
                              <div class="form-control">{{ date('d-m-Y H:i',strtotime($teclado->fecha))}}</div> 
                            @elseif(! $teclado->fecha)	
                              <div class="form-control">{{ $teclado->fecha ?? ''}}</div> 
                            @endif	
                          </div>
                        </div>
                        <div class="fila-2">
                          <div class="div title">
                            <label>TECNICO A CARGO: </label>
                            <div class="{{ empty($teclado->user_id) ? 'color1' : '' }}" >
                              @if($teclado->user_id)
                            <div class="form-control">{{ $teclado->user->name}} {{ $teclado->user->paterno}} {{ $teclado->user->materno}}</div> 
                              @elseif(! $teclado->user_id)	
                            <div class="form-control ">{{ $teclado->user->name ?? 'SIN ASIGNAR'}}</div> 
                              @endif
                          </div>
                          </div>
                          <div class="div title">
                            <label>FECHA DE ASIGNACIÓN: </label>
                            <div class="{{ empty($teclado->fecha_asignacion) ? 'color1' : '' }}">
                              @if($teclado->fecha_asignacion)
                            <div class="form-control">{{ date('d-m-Y H:i',strtotime($teclado->fecha_asignacion ))}}</div> 
                              @elseif(! $teclado->fecha_asignacion)	
                            <div class="form-control">{{ $teclado->fecha_asignacion ?? 'SIN ASIGNAR'}}</div> 
                              @endif								
                          </div>
                          </div>
                          <div class="div title">
                            <label>FECHA DE INICIO: </label>
                            <div class="{{ empty($teclado->fecha_inicio) ? 'color1' : '' }}">
                              @if($teclado->fecha_inicio)
                            <div class="form-control">{{ date('d-m-Y H:i',strtotime($teclado->fecha_inicio ))}}</div> 
                              @elseif(! $teclado->fecha_inicio)	
                            <div class="form-control">{{ $teclado->fecha_inicio ?? 'EN ESPERA'}}</div> 
                              @endif								
                          </div>
                          </div>
                        </div>
                      </fieldset>
                      <fieldset class="fieldset1">
                          <legend class="legend1">DATOS DEL TECLADO</legend>
                        <div class="fila-1">
                          <div class="div ">
                            <label>CODIGO GAMEA: </label>
                          <div class="form-control">{{ $teclado->cod_gamea }}</div> 
                          </div>
                          <div class="div title">
                            <label>NÚMERO DE RECEPCIÓN: </label>
                              <div class="{{ empty($teclado->cod_registro) ? 'color1' : '' }}">
                                <div class="form-control">{{ $teclado->cod_registro ?? 'SIN ASIGNAR' }}</div>
                              </div>
                          </div>
                        </div>
                        <div class="fila-1">
                          <div class="div title">
                            <label>MARCA: </label>
                          <div class="form-control">{{ $teclado->marca }}</div>
                          </div>
                          <div class="div title">
                            <label>MODELO: </label>
                          <div class="form-control">{{ $teclado->modelo }}</div> 
                          </div>
                        </div>
                        <div class="fila-1">
                          <div class="div title">
                            <label>FALLA: </label> 
                              <div class="form-control">{{ $teclado->falla }}</div>   
                          </div>
                          <div class="div title">
                            <label>ESTADO: </label>
                            @if ($teclado->estado_id == 5)
                              <div class="form-control">{{ $teclado->Estado?->nombre }} {{ date('d-m-Y H:i',strtotime($teclado->fecha_entrega ))}}</div>
                            @else
                              <div class="form-control">{{ $teclado->Estado?->nombre }}</div> 
                            @endif
                          </div>
                        </div>
                        <div class="fila-1">
                          <div class="div title">
                            <label>OBSERVACIONES: </label>
                              <div class="form-control">{{ $teclado->observaciones ?? 'SIN OBSERVACIONES' }}</div> 
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