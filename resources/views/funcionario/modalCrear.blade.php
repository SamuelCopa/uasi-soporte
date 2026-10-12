<div class="modal fade" id="crearf" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
    <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
        <div class="modal-header modal-header bg-primary text-white border-0 py-3">
            <h4>REGISTRAR</h4>
        <button type="button" class="btn-close bg-primary" data-dismiss="modal" aria-label="Cerrar"><i class="fas fa-times"></i></button>
        </div>
        <section class="content container-fluid">
          <div class="card">
              <div class="col-md-12">
            <form method="POST" action="{{ route('funcionarios.store') }}"  role="form" enctype="multipart/form-data">
                @csrf
        <fieldset class="fieldset1">
            <legend class="legend1">DATOS DEL FUNCIONARIO</legend>
            <div class="fila-4">
                <div class="div title">
                    <label for="grado_academico" class="form-label">{{ __('GRADO ACADEMICO:') }}</label>
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
                    <label for="paterno" class="form-label">{{ __('PATERNO') }}</label>
                    <input type="text" name="paterno" class="form-control @error('paterno') is-invalid @enderror" id="paterno" placeholder="Paterno">
                    {!! $errors->first('paterno', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
                <div class="div title">
                    <label for="materno" class="form-label">{{ __('MATERNO') }}</label>
                    <input type="text" name="materno" class="form-control @error('materno') is-invalid @enderror"  id="materno" placeholder="Materno">
                    {!! $errors->first('materno', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
                <div class="div title">
                    <label for="nombre" class="form-label">{{ __('NOMBRE') }}</label>
                    <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" id="nombre" placeholder="Nombre">
                    {!! $errors->first('nombre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
            </div>
            <div class="fila-2">
                <div class="div title">
                    <label for="ci" class="form-label">{{ __('C.I.') }}</label>
                    <input type="text" name="ci" class="form-control @error('ci') is-invalid @enderror" id="ci" placeholder="Ci">
                    {!! $errors->first('ci', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
                        <div class="div title">
                            <label for="expedido" class="form-label">{{ __('EXPEDIDO:') }}<span class="required">*</span></label>
                            <select name="expedido" class="form-control">
                                <option value="" disabled {{ 'selected' }}>SELECCIONE UNA OPCION</option>
                                <option value="QR">QR</option>
                                <option value="LP">LA PAZ</option>
                                <option value="CB">COCHABAMBA</option>
                                <option value="SC">SANTA CRUZ</option>
                                <option value="OR">ORURO</option>
                                <option value="CH">CHUQUISACA</option>
                                <option value="PO">POTOSI</option>
                                <option value="T">TARIJA</option>
                                <option value="B">BENI</option>
                                <option value="P">PANDO</option>
                            </select>
                          </div>
                <div class="div title">
                    <label for="celular" class="form-label">{{ __('CELULAR') }}</label>
                    <input type="number" name="celular" class="form-control @error('celular') is-invalid @enderror" id="celular" placeholder="Celular">
                    {!! $errors->first('celular', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
            </div>
            <div class="fila-1">
                <div class="div title">
                    <label for="cargo" class="form-label">{{ __('CARGO') }}</label>
                    <input type="text" name="cargo" class="form-control @error('cargo') is-invalid @enderror" id="cargo" placeholder="Cargo">
                    {!! $errors->first('cargo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
                <div class="div title">
                    <label for="email" class="form-label">{{ __('CORREO ELECTRÓNICO') }}</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Correo Electrónico">
                    {!! $errors->first('email', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>

            </div>
            <div class="fila-3">
                      <div class="div title" id="search-inputII">
                        <label for="dependencia">DEPENDENCIA</label>
                          <input type="text" id="search-inputI" list="optionsI" placeholder="Buscar dependencia ..." class="form-control">
                          <datalist name="dependencia_id" id="optionsI" style="display: none">
                              <option value="" ></option>
                              @foreach ($dependencia as $item)
                                  <option value="{{ $item->dependencias }}"data-id="{{ $item->id }}"></option>
                              @endforeach
                              <option value=" ">QUITAR</option>
                          </datalist>
                          <input type="hidden" id="id-selectedI" name="dependencia_id">
                      </div>
            </div>
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

