<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="dependencias" class="form-label">{{ __('DEPENDENCIAS') }}</label>
            <input type="text" name="dependencias" class="form-control @error('dependencias') is-invalid @enderror" value="{{ old('dependencias', $dependencia?->dependencias) }}" id="dependencias" placeholder="Dependencias">
            {!! $errors->first('dependencias', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>

</div>