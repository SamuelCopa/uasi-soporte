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

                      <div class="card card-default">
                          <div class="card">
                            <form method="POST" action="{{ route('responsables.store') }}"   role="form" enctype="multipart/form-data">
                              @csrf
                    
                                <div class="modal-body" id="cont_modal">
                                  <div class="form-group mb-2 mb20">
                                      <label for="nombre" class="form-label">{{ __('Nombre') }}</label>
                                      <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" id="nombre" placeholder="Nombre" required>
                                      {!! $errors->first('nombre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                  </div>
                                  <div class="form-group mb-2 mb20">
                                      <label for="cargo" class="form-label">{{ __('Cargo') }}</label>
                                      <input type="text" name="cargo" class="form-control @error('cargo') is-invalid @enderror" id="cargo" placeholder="Cargo" required>
                                      {!! $errors->first('cargo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
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
          </section>
      </div>
    </div>
  </div>
