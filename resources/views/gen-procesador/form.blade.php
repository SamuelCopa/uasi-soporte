<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="generacion" class="form-label">{{ __('GENERACIÓN') }}</label>
            <input type="text" name="generacion" class="form-control @error('generacion') is-invalid @enderror" value="{{ old('generacion', $genProcesador?->generacion) }}" id="generacion" placeholder="Generacion">
            {!! $errors->first('generacion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
</div>