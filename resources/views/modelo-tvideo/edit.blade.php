@extends('adminlte::page') 

@section('template_title')
    {{ __('Update') }} Modelo Tvideo
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Editar') }} Modelo Tarjeta de video</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('modelo-tvideos.update', $modeloTvideo->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('modelo-tvideo.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
