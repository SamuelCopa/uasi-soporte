@extends('layouts.app')

@section('template_title')
    {{ $user->name ?? __('Show') . " " . __('User') }}
@endsection
@section('content_header')
    <div class="header-panel">
        <div class="header-left">
            <h1 class="header-title">
                        <div class="float-left">
                            @if(auth()->user()->hasRole('SuperAdministrador'))
                                <h3>{{ __('SUPER ADMINISTRADOR') }}</h3>

                            @elseif(auth()->user()->hasRole('Administrador'))
                                <h3>{{ __('ADMINISTRADOR') }}</h3>

                            @elseif(auth()->user()->hasRole('Tecnico'))
                                <h3>{{ __('TECNICO') }}</h3>

                            @endif
                        </div>
            </h1>
        </div>
                <div class="header-actions">
                    <div class="float-right">
                        <!-- Botón para abrir el modal -->
                        <button type="button" class="btn-header" data-toggle="modal" data-target="#changePasswordModal">
                            <i class="fas fa-key"></i> Cambiar Contraseña
                        </button>
                    </div>
                    {{-- VOLVER --}}
                    <a href="{{ route('home') }}"
                    class="btn-header">
                        <i class="fas fa-arrow-left"></i>
                        Volver
                    </a>
                </div>
            </div>
@stop
@section('content')

<!--Ventana Modal para Crear--->
@include('user.CambiarContrasena')

<div class="card shadow-sm border-0 rounded-4 perfil-card">
    <div class="card-header perfil-header text-white">
        <h4 class="mb-0">
            <i class="fas fa-user-circle me-2"></i>
            PERFIL DEL USUARIO
        </h4>
    </div>

    <div class="card-body p-4">

        <!-- Encabezado -->
        <div class="d-flex align-items-center mb-4 perfil-info-top">
            <div class="perfil-avatar">
                <i class="fas fa-user"></i>
            </div>

            <div class="ms-3">
                <h4 class="mb-1 text-dark">
                    {{ $user->name }} {{ $user->paterno }} {{ $user->materno }}
                </h4>

                <span class="badge bg-success px-3 py-2">
                    {{ $user->estadoUsuario->nombre }}
                </span>
            </div>
        </div>

        <!-- Información -->
        <div class="row g-4">

            <div class="col-md-6">
                <div class="perfil-item">
                    <label>APELLIDO PATERNO</label>
                    <p>{{ $user->paterno }}</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="perfil-item">
                    <label>APELLIDO MATERNO</label>
                    <p>{{ $user->materno }}</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="perfil-item">
                    <label>NOMBRE(S)</label>
                    <p>{{ $user->name }}</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="perfil-item">
                    <label>C.I.</label>
                    <p>{{ $user->ci }} {{ $user->expedido }}</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="perfil-item">
                    <label>CELULAR</label>
                    <p>{{ $user->celular }}</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="perfil-item">
                    <label>CORREO ELECTRÓNICO</label>
                    <p>{{ $user->email }}</p>
                </div>
            </div>

        </div>

    </div>
</div>
            </div>
        </div>
    </section>

<style>
  /* CARD PRINCIPAL */
.perfil-card{
    border-radius: 18px;
    overflow: hidden;
    background: #ffffff;
    border: 1px solid #dee2e6;
}

/* HEADER */
.perfil-header{
    background: linear-gradient(135deg, #7b1113, #a61d24);
    padding: 18px 25px;
    border-bottom: none;
}

/* AVATAR */
.perfil-avatar{
    width: 85px;
    height: 85px;
    border-radius: 50%;
    background: linear-gradient(135deg, #7b1113, #b22222);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 34px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

/* ITEMS */
.perfil-item{
    border-left: 4px solid #7b1113;
    padding: 15px 18px;
    border-radius: 12px;
    transition: all .2s ease;
    height: 100%;
}

.perfil-item:hover{
    transform: translateY(-2px);
    box-shadow: 0 3px 10px rgba(0,0,0,0.08);
}

.perfil-item label{
    display: block;
    font-size: 12px;
    font-weight: 700;
    margin-bottom: 6px;
    letter-spacing: .5px;
}

.perfil-item p{
    margin: 0;
    font-size: 15px;
    font-weight: 500;
}

/* RESPONSIVE */
@media(max-width:768px){

    .perfil-info-top{
        flex-direction: column;
        text-align: center;
    }

    .perfil-info-top .ms-3{
        margin-left: 0 !important;
        margin-top: 15px;
    }

}
</style>
@endsection
