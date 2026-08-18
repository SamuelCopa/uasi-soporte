<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        {{-- <div class="form-group mb-2 mb20">
            <label for="permission_id" class="form-label">{{ __('Permission Id') }}</label>
            <input type="text" name="permission_id" class="form-control @error('permission_id') is-invalid @enderror" value="{{ old('permission_id', $roleHasPermission?->permission_id) }}" id="permission_id" placeholder="Permission Id">
            {!! $errors->first('permission_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div> --}}
        <div class="form-group mb-2 mb20">
            <label for="permission_id" class="form-label">{{ __('Permission Id') }}</label>
            <select name="permission_id" class="form-control @error('permission_id') is-invalid @enderror" id="permission_id">
                @foreach($permissions as $permission)
                    <option value="{{ $permission->id }}" {{ old('permission_id', $roleHasPermission?->permission_id) == $permission->id ? 'selected' : '' }}>{{ $permission->name }}</option>
                @endforeach
            </select>
            {!! $errors->first('permission_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="role_id" class="form-label">{{ __('Permission Id') }}</label>
            <select name="role_id" class="form-control @error('role_id') is-invalid @enderror" id="role_id">
                @foreach($roles as $permission)
                    <option value="{{ $permission->id }}" {{ old('role_id', $roleHasPermission?->role_id) == $permission->id ? 'selected' : '' }}>{{ $permission->name }}</option>
                @endforeach
            </select>
            {!! $errors->first('role_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        
        {{-- <div class="form-group mb-2 mb20">
            <label for="role_id" class="form-label">{{ __('Role Id') }}</label>
            <input type="text" name="role_id" class="form-control @error('role_id') is-invalid @enderror" value="{{ old('role_id', $roleHasPermission?->role_id) }}" id="role_id" placeholder="Role Id">
            {!! $errors->first('role_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div> --}}

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>