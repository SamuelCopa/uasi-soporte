<!--ventana para Update--->
<div class="modal fade" id="editar{{ $raton->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
    <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
        <div class="modal-header modal-header bg-primary text-white border-0 py-3">
            <h4>ACTUALIZAR</h4>
        <button type="button" class="btn-close bg-primary" data-dismiss="modal" aria-label="Cerrar"><i class="fas fa-times"></i></button>
        </div>
        <section class="content container-fluid">
          <div class="card">
              <div class="col-md-12">
                <form method="POST" action="{{ route('ratons.update', $raton->id) }}"  role="form" enctype="multipart/form-data">
                    {{ method_field('PATCH') }}
                    @csrf
                    @include('raton.form')

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
