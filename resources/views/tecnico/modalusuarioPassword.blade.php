<!--ventana para Update-->
<div class="modal fade" id="Password{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg"  role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #1493ee !important;">
        {{-- <h6 class="modal-title" style="color: #fff; text-align: center;"> Actualizar registro </h6> --}}
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <section class="content container-fluid">
        <div class="">
          <div class="">
            <div class="col-md-12">
              <div class="card card-default">
                <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                  <h4>{{ __('CAMBIAR CONTRASEÑA ') }}</h4>
                </div>
                <div class="card">
                  <form id="form-update" method="POST" action="{{ route('cambiar.pass',['id'=>$user->id]) }}" role="form" enctype="multipart/form-data">
                    {{ method_field('PATCH') }}
                    @csrf
                    <div class="modal-body" id="cont_modal">
                      <div>
                        <label for="password">Contraseña</label>
                        <input type="password" id="password_nueva" name="password" class="form-control @error('password') is-invalid @enderror" required id="password">
                    </div>
                
                    {{-- <div>
                        <label for="password_confirmation">Confirmar contraseña</label>
                        <input type="password" id="password_nueva" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" required id="password_confirmation">
                    </div> --}}
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
      </section>
    </div>
  </div>
</div>
<!---fin ventana modal --->
@section('css')
<style>
  .modal {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0px 0px 10px rgba(0,0,0,0.5);
}
</style>

@endsection
