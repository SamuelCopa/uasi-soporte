
<!--ventana para Update-->
<div class="modal fade" id="eRecepcion{{ $impresora->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
        <div class="modal-header modal-header bg-primary text-white border-0 py-3">
            <h4>REGISTRAR</h4>
        <button type="button" class="btn-close bg-primary" data-dismiss="modal" aria-label="Cerrar"><i class="fas fa-times"></i></button>
      </div>
      <section class="content container-fluid">
        <div class="">
          <div class="">
            <div class="col-md-12">
              <div class="card card-default">
                <div class="card">
                  <form method="POST" action="{{ route('impresora.recepcion',['id'=>$impresora->id]) }}" role="form" enctype="multipart/form-data">
                    {{ method_field('PATCH') }}
                    @csrf
                    <div class="modal-body" id="cont_modal">
                      <div class="div title">
                        <label for="cod_registro" class="form-label">{{ __('NÚMERO DE RECEPCIÓN') }}</label>
                        <input type="number" name="cod_registro" class="form-control @error('cod_registro') is-invalid @enderror" value="{{ old('cod_registro', $impresora?->cod_registro) }}" id="cod_registro" placeholder="INGRESE NÚMERO DE RECEPCIÓN" required>
                        {!! $errors->first('cod_registro', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">GUARDAR</button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">CANCELAR</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
<!---fin ventana Update --->

