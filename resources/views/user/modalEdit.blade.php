<!--ventana para Update--->
<div class="modal fade" id="editar{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #1493ee !important;">
          <h3 class="modal-title" style="color: #fff; text-align: center;">
              ACTUALIZAR REGISTRO
          </h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <section class="content container-fluid">
          <div class="">
              <div class="col-md-12">
                <form method="POST" action="{{ route('users.update', $user->id) }}"  role="form" enctype="multipart/form-data">
                    {{ method_field('PATCH') }}
                    @csrf
                    @include('user.form')

                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-save"></i>  {{ __('GUARDAR') }}</button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> CERRAR</button>
                    </div>
                </form>
              </div>
          </div>
        </section>
      </div>
    </div>
  </div>
  <!---fin ventana Update --->
