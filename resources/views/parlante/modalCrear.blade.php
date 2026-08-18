<div class="modal fade" id="crearp" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
    <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
        <div class="modal-header modal-header bg-primary text-white border-0 py-3">
            <h4>REGISTRAR</h4>
        <button type="button" class="btn-close bg-primary" data-dismiss="modal" aria-label="Cerrar"><i class="fas fa-times"></i></button>
        </div>
        <section class="content container-fluid">
          <div class="card">
              <div class="col-md-12">
                <form method="POST" action="{{ route('parlantes.store') }}" autocomplete="off">
                @csrf
                      <fieldset class="fieldset1">
                          <legend class="legend1">DATOS DEL SOLICITANTE</legend>
                      <div class="fila-3">
                          <div class="title div">
                            <label for="funcionario_activo" class="form-label">{{ __('TIPO DE FUNCIONARIO:') }}<span class="required">*</span></label>
                          <select name="funcionario_activo" class="form-control" required id="miSelect">
                            <option value="" disabled {{ 'selected' }}>SELECCIONE UNA OPCION</option>
                              <option value="1" >FUNCIONARIO ACTIVO</option>
                                <option value="0" >EX FUNCIONARIO</option>
                            </select>
                          </div>
                      </div>
            <div id="formulariop">
                      <div class="fila-2">
                      <div class="div title">
                        <label for="ci" class="form-label">{{ __('C.I.') }}<span class="required">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-id-card text-primary"></i></span>
                            <input type="text" name="ci" class="form-control @error('ci') is-invalid @enderror" id="ci" placeholder="Ci">
                            {!! $errors->first('ci', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                        </div>
                      </div>
                      <div class="div title">
                          <label for="expedido" class="form-label">{{ __('EXPEDIDO:') }}<span class="required">*</span></label>
                          <select name="expedido" class="form-control">
                              <option value="" disabled {{ 'selected' }}>SELECCIONE UNA OPCION</option>
                              <option value="QR" >QR</option>
                              <option value="LP" >LA PAZ</option>
                              <option value="CB">COCHABAMBA</option>
                              <option value="SC">SANTA CRUZ</option>
                              <option value="OR">ORURO</option>
                              <option value="CH">CHUQUISACA</option>
                              <option value="PO">POTOSI</option>
                              <option value="T">TARIJA</option>
                              <option value="B" >BENI</option>
                              <option value="P" >PANDO</option>
                          </select>
                      </div>
                        <div class="div title">
                            <label for="celular" class="form-label">{{ __('CELULAR') }}<span class="required">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-phone-alt text-primary"></i></span>
                                <input type="text" name="celular" class="form-control @error('celular') is-invalid @enderror" id="celular" placeholder="Celular">
                                {!! $errors->first('celular', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="fila-4">
                        <div class="div title">
                            <label for="grado_academico" class="form-label">{{ __('GRADO ACADEMICO:') }}<span class="required">*</span></label>
                            <select name="grado_academico" class="form-control">
                                <option value="" disabled {{ 'selected' }}>SELECCIONE UNA OPCION</option>
                                <option value="Abg." >ABG.</option>
                                <option value="Arq.">ARQ.</option>
                                <option value="Dr.">DR.</option>
                                <option value="Dra.">DRA.</option>
                                <option value="Ing.">ING.</option>
                                <option value="Lic.">LIC.</option>
                                <option value="Tec.">TEC.</option>
                                <option value="Sr.">SR.</option>
                                <option value="Sra.">SRA.</option>
                            </select>
                        </div>
                        <div class="div title">
                              <label for="paterno" class="form-label">{{ __('APELLIDO PATERNO') }}<span class="required">*</span></label>
                              <div class="input-group">
                                  <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" name="paterno" class="form-control @error('paterno') is-invalid @enderror" id="paterno" placeholder="Paterno" oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')" require>
                              </div>
                              {!! $errors->first('paterno', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                          </div>
                          <div class="div title">
                              <label for="materno" class="form-label">{{ __('APELLIDO MATERNO') }}<span class="required">*</span></label>
                              <div class="input-group">
                                  <span class="input-group-text"><i class="fas fa-user"></i></span>
                                  <input type="text" name="materno" class="form-control @error('materno') is-invalid @enderror" id="materno" placeholder="Materno" oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')" require>
                              </div>
                              {!! $errors->first('materno', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                          </div>
                          <div class="div title">
                              <label for="nombre" class="form-label">{{ __('NOMBRE(S)') }}<span class="required">*</span></label>
                              <div class="input-group">
                                  <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                                  <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" id="nombre" placeholder="Nombre" oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')">
                              </div>
                              {!! $errors->first('nombre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                          </div>
                        </div>
                        <div class="fila-1">            
                            <div class="div title" id="cargoA">
                                <label for="cargo" class="form-label">{{ __('CARGO') }}<span class="required">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-briefcase"></i></span>
                                    <input type="text" name="cargo" class="form-control @error('cargo') is-invalid @enderror" id="cargo" placeholder="Cargo" oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')" require>
                                    {!! $errors->first('cargo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                </div>
                            </div>
                        <div class="div title" id="emailP">
                          <label for="email" class="form-label">{{ __('CORREO ELECTRONICO') }}<span class="required">*</span></label>
                          <div class="input-group">
                              <span class="input-group-text"><i class="fa fa-briefcase"></i></span>
                              <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Correo electrónico">
                              {!! $errors->first('email', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                          </div>
                    </div>
                    </div>
                    <div class="fila-1">
                      <div class="div title" id="search-inputPP">
                          <label for="search-inputP" class="form-label">DEPENDENCIA</label>
                          <input type="text" id="search-inputP" list="optionsP" placeholder="Buscar dependencia ..." class="form-control">
                          <datalist name="dependencia_id" id="optionsP" style="display: none">
                              <option value="" ></option>
                              @foreach ($dependencia as $item)
                                  <option value="{{ $item->dependencias }}"data-id="{{ $item->id }}"></option>
                              @endforeach
                              <option value=" ">QUITAR</option>
                          </datalist>
                          <input type="hidden" id="id-selectedP" name="dependencia_id">
                      </div>
                                              <div class="div title">
                            <label for="fecha" class="form-label">{{ __('FECHA DE RECEPCIÓN') }}<span class="required">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-calendar-alt text-primary"></i></span>
                                    <input type="datetime-local" name="fecha" class="form-control @error('fecha') is-invalid @enderror" value="{{ old('fecha_hora', date('Y-m-d\TH:i:s')) }}" id="fecha" placeholder="Fecha" readonly>
                                {!! $errors->first('fecha', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                            </div>
                        </div>
                    </div>
                    </fieldset>
            </div>
            <div id="formulariop2">
                      <fieldset class="fieldset1">
                          <legend class="legend1">DATOS DEL PARLANTE</legend>
                      <div class="fila-1">
                          <div class="div title">
                              <label for="cod_gamea" class="form-label">{{ __('CODIGO GAMEA') }}<span class="required">*</span></label>
                              <input type="text" name="cod_gamea" class="form-control @error('cod_gamea') is-invalid @enderror" id="cod_gamea" placeholder="Cod Gamea" required>
                              {!! $errors->first('cod_gamea', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                          </div>
                      </div>
                      <div class="fila-1">
                          <div class="div title">
                              <label for="marca" class="form-label">{{ __('MARCA') }}<span class="required">*</span></label>
                              <input type="text" name="marca" class="form-control @error('marca') is-invalid @enderror" id="marca" placeholder="Marca" required>
                              {!! $errors->first('marca', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                          </div>
                          <div class="div title">
                              <label for="modelo" class="form-label">{{ __('MODELO') }}<span class="required">*</span></label>
                              <input type="text" name="modelo" class="form-control @error('modelo') is-invalid @enderror" id="modelo" placeholder="Modelo" required>
                              {!! $errors->first('modelo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                          </div>
                      </div>
                      <div class="fila-1">
                          <div class="div title">
                              <label for="falla" class="form-label">{{ __('FALLA') }} <span class="required">*</span></label>
                              <input type="text" name="falla" class="form-control @error('falla') is-invalid @enderror" id="falla" placeholder="Falla" required>
                              {!! $errors->first('falla', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                          </div>
                          <div class="div title">
                              <label for="observaciones" class="form-label">{{ __('OBSERVACIONES') }}</label>
                              <input type="text" name="observaciones" class="form-control @error('observaciones') is-invalid @enderror" id="observaciones" placeholder="Observaciones">
                              {!! $errors->first('observaciones', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                          </div>
                      </div>
                      <div class="fila-1">
                      <div class="div title" style="display:none;">
                          <input type="hidden" name="estado_id" value="{{ $estado?->first()->id }}">
                      </div>
                    </div>
                    <label class="form-label">{{ __('Campos obligatorios') }}<span class="required">(*)</span></label>
                    </fieldset>
                  </div>
            </div>
                  <div class="modal-footer">
                      <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm"><i class="fa fa-fw fa-save"></i> GUARDAR</button>
                      <button type="button" class="btn btn-danger rounded-pill px-4 shadow-sm" data-dismiss="modal"><i class="fas fa-times"></i>  CANCELAR</button>
                  </div>
                </form>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
