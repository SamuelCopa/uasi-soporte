@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Funcionario
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Nuevo') }} Funcionario</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('funcionarios.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('funcionario.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
