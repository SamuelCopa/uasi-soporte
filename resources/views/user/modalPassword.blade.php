<div class="modal fade" id="Password{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #1493ee !important;">
          <h3 class="modal-title" style="color: #fff; text-align: center;">
           CAMBIAR CONTRASEÑA
          </h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <section class="content container-fluid">
        <div class="">
          <div class="">
            <div class="col-md-12">
              <div class="card card-default">
                <div class="card">
                  <form id="form-update" method="POST" action="{{ route('user.pass',['id'=>$user->id]) }}" role="form" enctype="multipart/form-data">
                    {{ method_field('PATCH') }}
                    @csrf
                    <div class="modal-body" id="cont_modal">
                      <div>
                        <label for="password">CONTRASEÑA</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required id="password">
                    </div>
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
