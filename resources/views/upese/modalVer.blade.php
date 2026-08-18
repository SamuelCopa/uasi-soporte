<div class="modal fade" id="ver{{ $upese->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                  @if($upese?->funcionario_activo == 1)
                                <div class="form-control">{{ 'FUNCIONARIO ACTIVO'}}</div>
                                  @else
                                <div class="form-control">{{ 'EX FUNCIONARIO'}}</div>
                                  @endif
                              </div>
                              <div class="div title">
                                  <label>RECEPCIONADO POR: </label>
                                  <div class="form-control">{{$upese->reguser?->name}} {{$upese->reguser?->paterno}} {{$upese->reguser?->materno}}</div> 
                              </div>
                        </div>
                        <div class="fila-1">
                              <div class="div title">
                                  <label>NOMBRE: </label>
                                <div class="form-control">{{ strtoupper($upese->funcionario?->grado_academico) }} {{ $upese->funcionario?->nombre }} {{ $upese->funcionario?->paterno }} {{ $upese->funcionario?->materno }}</div>  
                              </div>
                              <div class="div title">
                                <label>C.I.: </label>
                                  <div class="form-control">{{ $upese->funcionario?->ci }} {{ $upese->funcionario?->expedido }}</div> 
                            </div>
                        </div>
                        <div class="fila-2">
                            <div class="div title">
                              <label>CELULAR: </label>
                            <div class="form-control">{{ $upese->funcionario?->celular }}</div> 
                          </div>
                          <div class="div title">
                            <label>CORREO   ELECTRÓNICO: </label>
                            <div class="form-control">{{ $upese->funcionario?->email }}</div>
                          </div>
                          <div class="div title">
                            <label>CARGO: </label>
                            <div class="form-control">{{ $upese->funcionario?->cargo }}</div>
                          </div>
                        </div>
                        <div class="fila-1">
                          @if(! $upese->dependencia_id == '')
                          <div class="div title" >
                          <label>DEPENDENCIA:</label>
                            <div class="form-control">{{ $upese->Dependencia?->dependencias }}</div> 
                          </div>
                          @else
                          <div class="div title" >
                          <label>DEPENDENCIA:</label>
                            <div class="form-control">{{'SIN DEPENDENCIA'}}</div> 
                          </div>
                          @endif
                          <div class="div title">
                            <label>FECHA DE RECEPCIÓN: </label>
                            @if($upese->fecha)
                              <div class="form-control">{{ date('d-m-Y H:i',strtotime($upese->fecha))}}</div> 
                            @elseif(! $upese->fecha)	
                              <div class="form-control">{{ $upese->fecha ?? ''}}</div> 
                            @endif	
                          </div>
                        </div>
                        <div class="fila-2">
                          <div class="div title">
                            <label>TECNICO A CARGO: </label>
                            <div class="{{ empty($upese->user_id) ? 'color1' : '' }}" >
                              @if($upese->user_id)
                            <div class="form-control">{{ $upese->user->name}} {{ $upese->user->paterno}} {{ $upese->user->materno}}</div> 
                              @elseif(! $upese->user_id)	
                            <div class="form-control ">{{ $upese->user->name ?? 'SIN ASIGNAR'}}</div> 
                              @endif
                          </div>
                          </div>
                          <div class="div title">
                            <label>FECHA DE ASIGNACIÓN: </label>
                            <div class="{{ empty($upese->fecha_asignacion) ? 'color1' : '' }}">
                              @if($upese->fecha_asignacion)
                                <div class="form-control">{{ date('d-m-Y H:i',strtotime($upese->fecha_asignacion ))}}</div> 
                              @elseif(! $upese->fecha_asignacion)	
                                <div class="form-control">{{ $upese->fecha_asignacion ?? 'SIN ASIGNAR'}}</div> 
                              @endif								
                          </div>
                          </div>
                          <div class="div title">
                            <label>FECHA DE INICIO: </label>
                            <div class="{{ empty($upese->fecha_inicio) ? 'color1' : '' }}">
                              @if($upese->fecha_inicio)
                                <div class="form-control">{{ date('d-m-Y H:i',strtotime($upese->fecha_inicio ))}}</div> 
                              @elseif(! $upese->fecha_inicio)	
                                <div class="form-control">{{ $upese->fecha_inicio ?? 'EN ESPERA'}}</div> 
                              @endif								
                          </div>
                          </div>
                        </div>
                      </fieldset>
                      <fieldset class="fieldset1">
                          <legend class="legend1">DATOS DEL UPS</legend>
                        <div class="fila-1">
                          <div class="div ">
                            <label>CODIGO GAMEA: </label>
                              <div class="form-control">{{ $upese->cod_gamea }}</div> 
                          </div>
                          <div class="div title">
                            <label>NÚMERO DE RECEPCIÓN: </label>
                              <div class="{{ empty($upese->cod_registro) ? 'color1' : '' }}">
                                <div class="form-control">{{ $upese->cod_registro ?? 'SIN ASIGNAR' }}</div>
                              </div>
                          </div>
                        </div>
                        <div class="fila-1">
                          <div class="div title">
                            <label>MARCA: </label>
                              <div class="form-control">{{ $upese->marca }}</div>
                          </div>
                          <div class="div title">
                            <label>MODELO: </label>
                              <div class="form-control">{{ $upese->modelo }}</div> 
                          </div>
                        </div>
                        <div class="fila-1">
                          <div class="div title">
                            <label>FALLA: </label> 
                              <div class="form-control">{{ $upese->falla }}</div>   
                          </div>
                          <div class="div title">
                            <label>ESTADO: </label>
                            @if ($upese->estado_id == 5)
                              <div class="form-control">{{ $upese->Estado?->nombre }} {{ date('d-m-Y H:i',strtotime($upese->fecha_entrega ))}}</div>
                            @else
                              <div class="form-control">{{ $upese->Estado?->nombre }}</div> 
                            @endif
                          </div>
                        </div>
                        <div class="fila-1">
                          <div class="div title">
                            <label>OBSERVACIONES: </label>
                              <div class="form-control">{{ $upese->observaciones ?? 'SIN OBSERVACIONES' }}</div> 
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