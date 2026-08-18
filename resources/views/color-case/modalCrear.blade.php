

<!--ventana para Update--->
<div class="modal fade" id="crear" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #1493ee !important;">
          <h4 class="modal-title" style="color: #fff; text-align: center;">
           REGISTRAR
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
          <section class="content container-fluid">
              <div class="row">
                  <div class="col-md-12">
                          <div class="card">
                            <form method="POST" action="{{ route('color-cases.store') }}">
                                @csrf
                                  <div class="modal-body" id="cont_modal">
                                    <div class="form-group mb-2 mb20">
                                        <label for="color" class="form-label">{{ __('COLOR') }}</label>
                                        <input type="text" name="color" class="form-control @error('color') is-invalid @enderror" id="color" placeholder="Color" required>
                                        {!! $errors->first('color', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
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
          </section>
      </div>
    </div>
  </div>
  <!---fin ventana Update --->