<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="role_id" class="form-label">{{ __('Role Id') }}</label>
            <input type="text" name="role_id" class="form-control @error('role_id') is-invalid @enderror" value="{{ old('role_id', $modelHasRole?->role_id) }}" id="role_id" placeholder="Role Id">
            {!! $errors->first('role_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="model_type" class="form-label">{{ __('Model Type') }}</label>
            <input type="text" name="model_type" class="form-control @error('model_type') is-invalid @enderror" value="{{ old('model_type', $modelHasRole?->model_type) }}" id="model_type" placeholder="Model Type">
            {!! $errors->first('model_type', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="model_id" class="form-label">{{ __('Model Id') }}</label>
            <input type="text" name="model_id" class="form-control @error('model_id') is-invalid @enderror" value="{{ old('model_id', $modelHasRole?->model_id) }}" id="model_id" placeholder="Model Id">
            {!! $errors->first('model_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>