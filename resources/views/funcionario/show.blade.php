@extends('layouts.app')

@section('template_title')
    {{ $funcionario->name ?? __('Show') . " " . __('Funcionario') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Funcionario</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('funcionarios.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Paterno:</strong>
                                    {{ $funcionario->paterno }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Materno:</strong>
                                    {{ $funcionario->materno }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Nombre:</strong>
                                    {{ $funcionario->nombre }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Ci:</strong>
                                    {{ $funcionario->ci }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Extension:</strong>
                                    {{ $funcionario->extension }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Cargo:</strong>
                                    {{ $funcionario->cargo }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Celular:</strong>
                                    {{ $funcionario->celular }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
