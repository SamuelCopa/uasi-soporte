<div class="row padding-1 p-1">
    <div class="col-md-12">
        <div class="fila-2">
            <div class="div title">
                <label for="paterno" class="form-label">{{ __('APELLIDO PATERNO') }}</label>
                <input type="text" name="paterno" class="form-control @error('paterno') is-invalid @enderror" value="{{ old('paterno', $user?->paterno) }}" id="paterno" placeholder="Apellido Paterno" required>
                {!! $errors->first('paterno', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>
            <div class="div title">
                <label for="materno" class="form-label">{{ __('APELLIDO MATERNO') }}</label>
                <input type="text" name="materno" class="form-control @error('materno') is-invalid @enderror" value="{{ old('materno', $user?->materno) }}" id="materno" placeholder="Apellido materno" required>
                {!! $errors->first('materno', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>
            <div class="div title">
                <label for="name" class="form-label">{{ __('NOMBRE') }}</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user?->name) }}" id="name" placeholder="Name">
                {!! $errors->first('name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>
        </div>

        <div class="fila-2">
        <div class="div title">
            <label for="email" class="form-label">{{ __('CORREO ELECTRONICO') }}</label>
            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user?->email) }}" id="email" placeholder="Email">
            {!! $errors->first('email', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="div title">
            <label for="ci" class="form-label">{{ __('C.I.') }}</label>
            <input type="text" name="ci" class="form-control @error('ci') is-invalid @enderror" value="{{ old('ci', $user?->ci) }}" id="ci" placeholder="Ci">
            {!! $errors->first('ci', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="div title">
            <label for="expedido" class="form-label">{{ __('EXPEDIDO:') }}<span class="required">*</span></label>
            <select name="expedido" class="form-control">
                <option value="" disabled {{ 'selected' }}>SELECCIONE UNA OPCION</option>
                <option value="LP" {{ old('expedido', $user->expedido ?? '') == 'LP' ? 'selected' : '' }} >LA PAZ</option>
                <option value="CB" {{ old('expedido', $user->expedido ?? '') == 'CB' ? 'selected' : '' }}>COCHABAMBA</option>
                <option value="SC" {{ old('expedido', $user->expedido ?? '') == 'SC' ? 'selected' : '' }}>SANTA CRUZ</option>
                <option value="OR" {{ old('expedido', $user->expedido ?? '') == 'OR' ? 'selected' : '' }}>ORURO</option>
                <option value="CH" {{ old('expedido', $user->expedido ?? '') == 'CH' ? 'selected' : '' }}>CHUQUISACA</option>
                <option value="PO" {{ old('expedido', $user->expedido ?? '') == 'PO' ? 'selected' : '' }}>POTOSI</option>
                <option value="T" {{ old('expedido', $user->expedido ?? '') == 'T' ? 'selected' : '' }}>TARIJA</option>
                <option value="B" {{ old('expedido', $user->expedido ?? '') == 'B' ? 'selected' : '' }} >BENI</option>
                <option value="P" {{ old('expedido', $user->expedido ?? '') == 'P' ? 'selected' : '' }} >PANDO</option>
            </select>
        </div>
        </div>

        <div class="fila-1">
        <div class="div title">
            <label for="celular" class="form-label">{{ __('CELULAR') }}</label>
            <input type="text" name="celular" class="form-control @error('celular') is-invalid @enderror" value="{{ old('celular', $user?->celular) }}" id="celular" placeholder="Celular">
            {!! $errors->first('celular', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
            <div class="div title">
                <label for="id_estadousuario" class="form-label">{{ __('ESTADO') }}</label>
                <select name="id_estadousuario" class="form-control @error('id_estadousuario') is invalid @enderror" id="id_estadousuario"> 
                    <option value="" disabled {{ old('id_estadousuario',$user?->id_estadousuario) ? '' : 'selected' }}>Seleccionar </option> 
                    @foreach ($estados as $item)
                    <option value="{{ $item->id }}" {{ (old('id_estadousuario',$user?->id_estadousuario)== $item->id ) ? 'selected' : '' }}> 
                        {{ $item->nombre}}
                    </option> 
                    @endforeach                 
                </select>  
                {!! $errors->first('id_estadousuario', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>
        </div>

        <div class="fila-1">
        <div class="div title">
            <label>{{ __('ROLES') }}</label>
            @foreach ($roles as $rol)
            <li form-group mb-2 mb20>
                <input type="checkbox" name="roles[]" value="{{ $rol->id }}" id="rol-{{ $rol->id }}" @if(in_array($rol->id, $user->roles->pluck('id')->toArray())) checked @endif>
                <label for="rol-{{ $rol->id }}">{{ $rol->name }}</label>
            </li>
            @endforeach
        </div>
        </div>
    </div>
    {{-- <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('GUARDAR') }}</button>
        <a class="btn btn-danger" href="{{ route('users.index') }}"> {{ __('CANCELAR') }}</a>
    </div> --}}
</div>
