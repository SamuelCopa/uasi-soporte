<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="clave" class="form-label">{{ __('CLAVE') }}</label>
            <input type="text" name="clave" class="form-control @error('clave') is-invalid @enderror" value="{{ old('clave', $configuracion?->clave) }}" id="clave" placeholder="Clave">
            {!! $errors->first('clave', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="valor" class="form-label">{{ __('VALOR') }}</label>
            <input type="text" name="valor" class="form-control @error('valor') is-invalid @enderror" value="{{ old('valor', $configuracion?->valor) }}" id="valor" placeholder="Valor">
            {!! $errors->first('valor', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
</div>