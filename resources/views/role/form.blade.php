<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="name" class="form-label">{{ __('ROL') }}</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $role?->name) }}" id="name" placeholder="Rol">
            {!! $errors->first('name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            {{-- <label for="guard_name" class="form-label">{{ __('Guard Name') }}</label> --}}
            <input type="hidden" name="guard_name" class="form-control @error('guard_name') is-invalid @enderror" value="{{ old('guard_name', $role?->guard_name ?? 'web') }}" id="guard_name" placeholder="Guard Name">
            {!! $errors->first('guard_name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
</div>