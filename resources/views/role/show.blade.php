@extends('layouts.app')

@section('template_title')
    {{ $role->name ?? __('Show') . " " . __('Role') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Asignar rol a:') }} </span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('roles.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                                <div class="form-group mb-2 mb20">
                                    <strong>Name:</strong>
                                    {{ $role->name }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <label for="permission_id" class="form-label">{{ __('Permission Id') }}</label>
                                    <select name="permission_id" class="form-control @error('permission_id') is-invalid @enderror" id="permission_id">
                                        @foreach($permissions as $permission)
                                            <option value="{{ $permission->id }}" {{ old('permission_id', $roleHasPermission?->permission_id) == $permission->id ? 'selected' : '' }}>{{ $permission->name }}</option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('permission_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                </div>
                                
                                
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
