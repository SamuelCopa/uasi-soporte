<div class="modal fade" id="crear" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
    <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
        <div class="modal-header modal-header bg-primary text-white border-0 py-3">
            <h4>REGISTRAR</h4>
        <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <section class="content container-fluid">
          <div class="">
              <div class="col-md-12">
                <form method="POST" action="{{ route('users.store') }}">
                @csrf
                  <div class="row padding-1 p-1">
                  <div class="col-md-12">
                      <fieldset class="fieldset1">
                          <legend class="legend1">DATOS DEL ADMINISTRADOR</legend>
                    <div class="fila-2">
                      <div class="div title">
                        <label for="paterno" class="form-label">{{ __('APELLIDO PATERNO') }}<span class="required">*</span></label>
                        <input type="text" name="paterno" class="form-control @error('paterno') is-invalid @enderror" id="paterno" placeholder="Apellido Paterno" oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')" required>
                        {!! $errors->first('paterno', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                      </div>
                      <div class="div title">
                        <label for="materno" class="form-label">{{ __('APELLIDO MATERNO') }}<span class="required">*</span></label>
                        <input type="text" name="materno" class="form-control @error('materno') is-invalid @enderror" id="materno" placeholder="Apellido materno" oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')" required>
                        {!! $errors->first('materno', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                      </div>
                      <div class="div title">
                        <label for="name" class="form-label">{{ __('NOMBRE') }}<span class="required">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Nombre" oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')" required>
                        {!! $errors->first('name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                      </div>
                    </div>

                    <div class="fila-2">
                      <div class="div title">
                        <label for="ci" class="form-label">{{ __('C.I.') }}<span class="required">*</span></label>
                        <input type="text" class="form-control" id="ci" name="ci" placeholder="Ingrese C.I." minlength="6" maxlength="10"
                          pattern="[0-9]{6,10}" inputmode="numeric" required>
                      </div>
                      <div class="div title">
                          <label for="expedido" class="form-label">{{ __('EXPEDIDO:') }}<span class="required">*</span></label>
                          <select name="expedido" class="form-control">
                              <option value="" disabled {{ 'selected' }}>SELECCIONE UNA OPCION</option>
                              <option value="LP" >QR</option>
                              <option value="LP" >LA PAZ</option>
                              <option value="CB">COCHABAMBA</option>
                              <option value="SC">SANTA CRUZ</option>
                              <option value="OR">ORURO</option>
                              <option value="CH">CHUQUISACA</option>
                              <option value="PO">POTOSI</option>
                              <option value="T">TARIJA</option>
                              <option value="B" >BENI</option>
                              <option value="P" >PANDO</option>
                          </select>
                      </div>
                      <div class="div title">
                        <label for="email" class="form-label">{{ __('CORREO ELECTRONICO') }}<span class="required">*</span></label>
                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Correo electronico" required>
                        {!! $errors->first('email', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                      </div>
                    </div>

                    <div class="fila-1">
                      <div class="div title">
                        <label for="celular" class="form-label">{{ __('CELULAR') }}<span class="required">*</span></label>
                          <input type="text" class="form-control" id="celular" name="celular" placeholder="Ingrese celular" minlength="8"
                           maxlength="8" pattern="[0-9]{8}" inputmode="numeric" required>
                      </div>

                      <div class="div title">
                        <label for="password" class="form-label">{{ __('CONTRASEÑA') }}<span class="required">*</span></label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required id="password" placeholder="Contraseña automatica es el numero de C.I.">
                      </div>

                    </div>
                    <div class="fila-1">


<div class="form-group mb-3">
    <label>{{ __('ROL') }}</label>

    @foreach ($roles as $rol)
        <div class="form-group mb-2">
            <input
                type="radio"
                name="role"
                value="{{ $rol->name }}"
                id="rol-{{ $rol->id }}"
                required
            >

            <label for="rol-{{ $rol->id }}">
                {{ $rol->name }}
            </label>
        </div>
    @endforeach
</div>
                      </div>
                    </div>

                    </div>


                      {{-- <label for="password_confirmation">CONFIRMAR CONTRASEÑA</label> --}}
                      <input type="hidden" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" required id="password_confirmation" placeholder="Confirmar contraseña">
                    </div>
                    <div class="">
                      <div class="div title" style="display:none;">
                      <input type="hidden" name="id_estadousuario" value="{{ $estados?->first()->id }}">
                      </div>
                  </div>
                    <label class="form-label">{{ __('Campos obligatorios') }}<span class="required">(*)</span></label>
                  </fieldset>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-save"></i> {{ __('GUARDAR') }}</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> CERRAR</button>
                  </div>

                </form>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>

<script src="{{ asset('js/pass.js') }}"></script>
