<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="servicio" class="form-label">{{ __('Servicio') }}</label>
            <input type="text" name="servicio" class="form-control @error('servicio') is-invalid @enderror" value="{{ old('servicio', $servicio?->servicio) }}" id="servicio" placeholder="Servicio">
            {!! $errors->first('servicio', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="update_at" class="form-label">{{ __('Update At') }}</label>
            <input type="text" name="update_at" class="form-control @error('update_at') is-invalid @enderror" value="{{ old('update_at', $servicio?->update_at) }}" id="update_at" placeholder="Update At">
            {!! $errors->first('update_at', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>