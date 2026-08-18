<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="opcion" class="form-label">{{ __('Opcion') }}</label>
            <input type="text" name="opcion" class="form-control @error('opcion') is-invalid @enderror" value="{{ old('opcion', $disipadorRam?->opcion) }}" id="opcion" placeholder="Opcion">
            {!! $errors->first('opcion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>