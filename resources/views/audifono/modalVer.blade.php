<div class="modal fade" id="ver{{ $audifono->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                    <div class="card">
                      <fieldset class="fieldset1">
                          <legend class="legend1">DATOS DEL SOLICITANTE</legend>
                        <div class="fila-1">
                              <div class="div title">
                                  <label>ESTADO DEL FUNCIONARIO: </label>
                                  @if($audifono?->funcionario_activo == 1)
                                <div class="form-control">{{ 'FUNCIONARIO ACTIVO'}}</div>
                                  @else
                                <div class="form-control">{{ 'EX FUNCIONARIO'}}</div>
                                  @endif
                              </div>
                                <div class="div title">
                                    <label>RECEPCIONADO POR: </label>
                                <div class="form-control">{{$audifono->reguser?->name}} {{$audifono->reguser?->paterno}} {{$audifono->reguser?->materno}}</div> 
                              </div>
                        </div>
                        <div class="fila-1">
                              <div class="div title">
                                  <label>NOMBRE: </label>
                                <div class="form-control">{{strtoupper($audifono->funcionario?->grado_academico)  }} {{ $audifono->funcionario?->nombre }} {{ $audifono->funcionario?->paterno }} {{ $audifono->funcionario?->materno }}</div>  
                              </div>
                              <div class="div title">
                                <label>C.I.: </label>
                              <div class="form-control">{{ $audifono->funcionario?->ci }} {{ $audifono->funcionario?->expedido }}</div> 
                            </div>
                        </div>
                        <div class="fila-2">
                            <div class="div title">
                              <label>CELULAR: </label>
                            <div class="form-control">{{ $audifono->funcionario?->celular }}</div> 
                          </div>
                          <div class="div title">
                            <label>CORREO ELECTRÓNICO: </label>
                            <div class="form-control">{{ $audifono->funcionario?->email }}</div>
                          </div>
                          <div class="div title">
                            <label>CARGO: </label>
                            <div class="form-control">{{ $audifono->funcionario?->cargo }}</div>
                          </div>
                        </div>
                        <div class="fila-1">
                          @if(! $audifono->dependencia_id == '')
                          <div class="div title" >
                            <label>DEPENDENCIA:</label>
                            <div class="form-control">{{ $audifono->Dependencia?->dependencias }}</div> 
                          </div>
                          @else
                          <div class="div title" >
                            <label>DEPENDENCIA:</label>
                            <div class="form-control">{{'SIN DEPENDENCIA'}}</div> 
                          </div>
                          @endif
                          <div class="div title">
                            <label>FECHA DE RECEPCIÓN: </label>
                            @if($audifono->fecha)
                              <div class="form-control">{{ date('d-m-Y H:i',strtotime($audifono->fecha))}}</div> 
                            @elseif(! $audifono->fecha)	
                              <div class="form-control">{{ $audifono->fecha ?? ''}}</div> 
                            @endif	
                          </div>
                        </div>
                        <div class="fila-2">
                          <div class="div title">
                            <label>TECNICO A CARGO: </label>
                            <div class="{{ empty($audifono->user_id) ? 'color1' : '' }}" >
                              @if($audifono->user_id)
                            <div class="form-control">{{ $audifono->user->name}} {{ $audifono->user->paterno}} {{ $audifono->user->materno}}</div> 
                              @elseif(! $audifono->user_id)	
                            <div class="form-control ">{{ $audifono->user->name ?? 'SIN ASIGNAR'}}</div> 
                              @endif
                          </div>
                          </div>
                          <div class="div title">
                            <label>FECHA DE ASIGNACIÓN: </label>
                            <div class="{{ empty($audifono->fecha_asignacion) ? 'color1' : '' }}">
                              @if($audifono->fecha_asignacion)
                                <div class="form-control">{{ date('d-m-Y H:i',strtotime($audifono->fecha_asignacion ))}}</div> 
                              @elseif(! $audifono->fecha_asignacion)	
                                <div class="form-control">{{ $audifono->fecha_asignacion ?? 'SIN ASIGNAR'}}</div> 
                              @endif								
                          </div>
                          </div>
                          <div class="div title">
                            <label>FECHA DE INICIO: </label>
                            <div class="{{ empty($audifono->fecha_inicio) ? 'color1' : '' }}">
                              @if($audifono->fecha_inicio)
                                <div class="form-control">{{ date('d-m-Y H:i',strtotime($audifono->fecha_inicio ))}}</div> 
                              @elseif(! $audifono->fecha_inicio)	
                                <div class="form-control">{{ $audifono->fecha_inicio ?? 'SIN ASIGNAR'}}</div> 
                              @endif								
                          </div>
                          </div>
                        </div>
                      </fieldset>
                      <fieldset class="fieldset1">
                          <legend class="legend1">DATOS DEL AUDIFONO</legend>
                        <div class="fila-1">
                          <div class="div ">
                            <label>CODIGO GAMEA: </label>
                              <div class="form-control">{{ $audifono->cod_gamea }}</div> 
                          </div>
                          <div class="div title">
                            <label>NÚMERO DE RECEPCIÓN: </label>
                              <div class="{{ empty($audifono->cod_registro) ? 'color1' : '' }}">
                                <div class="form-control">{{ $audifono->cod_registro ?? 'SIN ASIGNAR' }}</div>
                              </div>
                          </div>
                        </div>
                        <div class="fila-1">
                          <div class="div title">
                            <label>MARCA: </label>
                              <div class="form-control">{{ $audifono->marca }}</div>
                          </div>
                          <div class="div title">
                            <label>MODELO: </label>
                              <div class="form-control">{{ $audifono->modelo }}</div> 
                          </div>
                        </div>
                        <div class="fila-1">
                          <div class="div title">
                            <label>FALLA: </label> 
                              <div class="form-control">{{ $audifono->falla }}</div>   
                          </div>
                          <div class="div title">
                            <label>ESTADO: </label>
                            @if ($audifono->estado_id == 5)
                              <div class="form-control">{{ $audifono->Estado?->nombre }} {{ date('d-m-Y H:i',strtotime($audifono->fecha_entrega ))}}</div>
                            @else
                              <div class="form-control">{{ $audifono->Estado?->nombre }}</div> 
                            @endif
                          </div>
                        </div>
                        <div class="fila-1">
                          <div class="div title">
                            <label>OBSERVACIONES: </label>
                              <div class="form-control">{{ $audifono->observaciones ?? 'SIN OBSERVACIONES' }}</div> 
                          </div>
                        </div>
                      </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </section>
      <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
      </div>
    </div>
  </div>
</div>