

<!--ventana para Update--->

<div class="modal fade" id="ver{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #1493ee !important;">
        <h2 class="modal-title" style="color: #fff; text-align: center;">
          REGISTRO
        </h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                      <fieldset class="fieldset1">
                          <legend class="legend1">DATOS DEL USUARIO</legend>
                      <div class="fila-1">
                              <div class="form-control">
                              <strong>APELLIDO PATERNO: </strong>
                                  {{ $user?->paterno }}
                              </div>
                              <div class="form-control">
                                <strong>APELLIDO MATERNO: </strong>
                                {{ $user->materno }}
                            </div>
                        </div>
                        <div class="fila-1">
                          <div class="form-control">
                            <strong>NOMBRE (S): </strong>
                            {{ $user->name }}
                          </div>
                          <div class="form-control">
                            <strong>C.I. : </strong>
                            {{ $user->ci }}
                          </div>
                        </div>
                        <div class="fila-1">
                          <div class="form-control">
                            <strong>CELULAR: </strong>
                            {{ $user->celular }}
                          </div>
                        </div>
                        <div class="fila-1">
                          <div class="form-control">
                            <strong>CORREO ELECTRONICO: </strong>
                            {{ $user->email }}
                          </div>
                          <div class="form-control ">
                            <strong>ESTADO: </strong>
                            {{ $user->estadoUsuario->nombre }}
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
<!---fin ventana Update --->

</script>