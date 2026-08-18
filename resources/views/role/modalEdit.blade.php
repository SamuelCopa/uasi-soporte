<!--ventana para Update--->
<div class="modal fade" id="edit{{ $role->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #1493ee !important;">
          <h6 class="modal-title" style="color: #fff; text-align: center;">
              Actualizar registro
          </h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <section class="content container-fluid">
          <div class="">
              <div class="col-md-12">
      
                  <div class="card card-default">
                      <div class="card-header">
                          <span class="card-title">{{ __('Actualizar') }}</span>
                      </div>
                      <div class="card">
                        <form method="POST" action="{{ route('roles.update', $role->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('role.form')

                                  </div>
                                  <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">GUARDAR</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
                                    
                                  </div>
                            </form>
                        </div>
                    </div>
            </div>
          </div>
  
      </div>
    </div>
  </div>
  <!---fin ventana Update --->
