<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="potencia" class="form-label">{{ __('POTENCIA') }}</label>
            <input type="text" name="potencia" class="form-control @error('potencia') is-invalid @enderror" value="{{ old('potencia', $potenciaFuente?->potencia) }}" id="potencia" placeholder="Potencia">
            {!! $errors->first('potencia', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>

</div>