<!--ventana para Update--->
<div class="modal fade" id="edit{{ $marcaProcesador->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #1493ee !important;">
          <h4 class="modal-title" style="color: #fff; text-align: center;">
              Actualizar registro
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
          <section class="content container-fluid">
              <div class="">
                  <div class="col-md-12">
                      <div class="card card-default">
                          <div class="card">
                        <form method="POST" action="{{ route('marca-procesadors.update', $marcaProcesador->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf
                            @include('marca-procesador.form')
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
  <!---fin ventana Update --->
