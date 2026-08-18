

<!--ventana para Update--->
<div class="modal fade" id="crear" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #1493ee !important;">
          <h6 class="modal-title" style="color: #fff; text-align: center;">
           REGISTRAR
          </h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form method="POST" action="{{ route('roles.store') }}">
            @csrf
  
              <div class="modal-body" id="cont_modal">
  
                  <div class="form-group mb-2 mb20">
                      <label for="name" class="form-label">{{ __('ROL') }}</label>
                      <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Rol" required>
                      {!! $errors->first('name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                  </div>
                  <div class="form-group mb-2 mb20">
                      {{-- <label for="guard_name" class="form-label">{{ __('Guard Name') }}</label> --}}
                      <input type="hidden" name="guard_name" class="form-control @error('guard_name') is-invalid @enderror" id="guard_name" placeholder="Guard Name">
                      {!! $errors->first('guard_name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
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
  <!---fin ventana Update --->