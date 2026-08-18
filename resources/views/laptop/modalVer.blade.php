
<div class="modal fade" id="ver{{ $laptop->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                  @if($laptop?->funcionario_activo == 1)
                                <div class="form-control">{{ 'FUNCIONARIO ACTIVO'}}</div>
                                  @else
                                <div class="form-control">{{ 'EX FUNCIONARIO'}}</div>
                                  @endif
                              </div>
                              <div class="div title">
                                  <label>RECEPCIONADO POR: </label>
                                  <div class="form-control">{{$laptop->reguser?->name}} {{$laptop->reguser?->paterno}} {{$laptop->reguser?->materno}}</div> 
                              </div>
                        </div>
                        <div class="fila-1">
                              <div class="div title">
                                  <label>NOMBRE: </label>
                                <div class="form-control">{{ strtoupper($laptop->funcionario?->grado_academico) }} {{ $laptop->funcionario?->nombre }} {{ $laptop->funcionario?->paterno }} {{ $laptop->funcionario?->materno }}</div>  
                              </div>
                              <div class="div title">
                                <label>C.I.: </label>
                                  <div class="form-control">{{ $laptop->funcionario?->ci }} {{ $laptop->funcionario?->expedido }}</div> 
                            </div>
                        </div>
                        <div class="fila-2">
                            <div class="div title">
                              <label>CELULAR: </label>
                            <div class="form-control">{{ $laptop->funcionario?->celular }}</div> 
                          </div>
                          <div class="div title">
                            <label>CORREO ELECTRÓNICO: </label>
                            <div class="form-control">{{ $laptop->funcionario?->email }}</div>
                          </div>
                          <div class="div title">
                            <label>CARGO: </label>
                            <div class="form-control">{{ $laptop->funcionario?->cargo }}</div>
                          </div>
                        </div>
                        <div class="fila-1">
                          @if(! $laptop->dependencia_id == '')
                          <div class="div title" >
                          <label>DEPENDENCIA:</label>
                            <div class="form-control">{{ $laptop->Dependencia?->dependencias }}</div> 
                          </div>
                          @else
                          <div class="div title" >
                          <label>DEPENDENCIA:</label>
                            <div class="form-control">{{'SIN DEPENDENCIA'}}</div> 
                          </div>
                          @endif
                          <div class="div title">
                            <label>FECHA DE RECEPCIÓN: </label>
                            @if($laptop->fecha)
                              <div class="form-control">{{ date('d-m-Y H:i',strtotime($laptop->fecha))}}</div> 
                            @elseif(! $laptop->fecha)	
                              <div class="form-control">{{ $laptop->fecha ?? ''}}</div> 
                            @endif	
                          </div>
                        </div>
                        <div class="fila-1">
                          <div class="div title">
                            <label>TECNICO A CARGO: </label>
                            <div class="{{ empty($laptop->user_id) ? 'color1' : '' }}" >
                              @if($laptop->user_id)
                            <div class="form-control">{{ $laptop->user->name}} {{ $laptop->user->paterno}} {{ $laptop->user->materno}}</div> 
                              @elseif(! $laptop->user_id)	
                            <div class="form-control ">{{ $laptop->user->name ?? 'SIN ASIGNAR'}}</div> 
                              @endif
                          </div>
                          </div>
                          <div class="div title">
                            <label>FECHA DE ASIGNACIÓN: </label>
                            <div class="{{ empty($laptop->fecha_asignacion) ? 'color1' : '' }}">
                              @if($laptop->fecha_asignacion)
                                <div class="form-control">{{ date('d-m-Y H:i',strtotime($laptop->fecha_asignacion ))}}</div> 
                              @elseif(! $laptop->fecha_asignacion)	
                                <div class="form-control">{{ $laptop->fecha_asignacion ?? 'SIN ASIGNAR'}}</div> 
                              @endif								
                          </div>
                          </div>
                          <div class="div title">
                            <label>FECHA DE INICIO: </label>
                            <div class="{{ empty($laptop->fecha_inicio) ? 'color1' : '' }}">
                              @if($laptop->fecha_inicio)
                                <div class="form-control">{{ date('d-m-Y H:i',strtotime($laptop->fecha_inicio ))}}</div> 
                              @elseif(! $laptop->fecha_inicio)	
                                <div class="form-control">{{ $laptop->fecha_inicio ?? 'SIN ASIGNAR'}}</div> 
                              @endif								
                          </div>
                          </div>
                        </div>
                      </fieldset>
                      <fieldset class="fieldset1">
                          <legend class="legend1">DATOS LAPTOP</legend>
                          <div class="fila-1">
                            <div class="div title">
                              <label>USUARIO: </label>
                              <div class="form-control">{{ $laptop->usuario ?? '-------------' }}</div> 
                            </div>
                            <div class="div title">
                              <label>CONTRASEÑA: </label>
                              <div class="form-control">{{ $laptop->contrasena ?? '-------------'}}</div> 
                            </div>
                        </div>
                        <div class="fila-1">
                          <div class="div ">
                            <label>CODIGO GAMEA: </label>
                              <div class="form-control">{{ $laptop->cod_gamea }}</div> 
                          </div>
                          <div class="div title">
                            <label>NÚMERO DE RECEPCIÓN: </label>
                              <div class="{{ empty($laptop->cod_registro) ? 'color1' : '' }}">
                                <div class="form-control">{{ $laptop->cod_registro ?? 'SIN ASIGNAR' }}</div>
                              </div>
                          </div>
                        </div>
                        <div class="fila-1">
                          <div class="div title">
                            <label>MARCA: </label>
                              <div class="form-control">{{ $laptop->marca }}</div>
                          </div>
                          <div class="div title">
                            <label>MODELO: </label>
                              <div class="form-control">{{ $laptop->modelo }}</div> 
                          </div>
                        </div>
                        <div class="fila-1">
                          <div class="div title">
                            <label>FALLA: </label> 
                              <div class="form-control">{{ $laptop->falla }}</div>   
                          </div>
                          <div class="div title">
                            <label>ESTADO: </label>
                            @if ($laptop->estado_id == 5)
                              <div class="form-control">{{ $laptop->Estado?->nombre }} {{ date('d-m-Y H:i',strtotime($laptop->fecha_entrega ))}}</div>
                            @else
                              <div class="form-control">{{ $laptop->Estado?->nombre }}</div> 
                            @endif
                          </div>
                        </div>
                        <div class="fila-1">
                          <div class="div title">
                            <label>OBSERVACIONES: </label>
                              <div class="form-control">{{ $laptop->observaciones ?? 'SIN OBSERVACIONES' }}</div> 
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