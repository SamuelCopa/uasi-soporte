@extends('layouts.app')

@section('template_title')
    {{ $user->name ?? __('Perfil') }}
@endsection


@section('content_header')

<div class="perfil-page-header">

    <div>
        <div class="perfil-breadcrumb">
            <i class="fas fa-home"></i>
            <span>Inicio</span>
            <i class="fas fa-chevron-right"></i>
            <span>Perfil</span>
        </div>

        <h1 class="perfil-page-title">
            Mi Perfil
        </h1>

        <p class="perfil-page-subtitle">
            Información y datos de acceso del usuario
        </p>
    </div>

    <div class="perfil-header-actions">

        <button type="button"
                class="btn-header"
                data-toggle="modal"
                data-target="#changePasswordModal">

            <i class="fas fa-key"></i>
            <span>Cambiar contraseña</span>

        </button>

        <a href="{{ route('home') }}"
           class="btn-header">

            <i class="fas fa-arrow-left"></i>
            <span>Volver</span>

        </a>

    </div>

</div>

@stop


@section('content')

{{-- MODAL CAMBIAR CONTRASEÑA --}}
@include('user.CambiarContrasena')


<div class="container-fluid perfil-container">

    <div class="row">

        {{-- =========================================
             COLUMNA IZQUIERDA
             ========================================= --}}
        <div class="col-lg-4 mb-4">

            <div class="card perfil-profile-card">

                {{-- CABECERA --}}
                <div class="perfil-cover">

                    <div class="perfil-avatar-wrapper">

                        <div class="perfil-avatar">

                            <i class="fas fa-user"></i>

                        </div>

                        <span class="perfil-online"></span>

                    </div>

                </div>


                {{-- INFORMACIÓN PRINCIPAL --}}
                <div class="perfil-profile-body">

                    <h2 class="perfil-name">

                        {{ $user->name }}
                        {{ $user->paterno }}
                        {{ $user->materno }}

                    </h2>


                    {{-- ROL --}}
                    <div class="perfil-role">

                        @if(auth()->user()->hasRole('SuperAdministrador'))

                            <i class="fas fa-user-shield"></i>
                            SUPER ADMINISTRADOR

                        @elseif(auth()->user()->hasRole('Administrador'))

                            <i class="fas fa-user-cog"></i>
                            ADMINISTRADOR

                        @elseif(auth()->user()->hasRole('Tecnico'))

                            <i class="fas fa-tools"></i>
                            TÉCNICO

                        @else

                            <i class="fas fa-user"></i>
                            USUARIO

                        @endif

                    </div>
                    {{-- ESTADO --}}
                    <div class="perfil-status">
                        <span class="status-dot"></span>
                        {{ $user->estadoUsuario->nombre ?? 'Activo' }}
                    </div>
                    <div class="perfil-divider"></div>
                    {{-- CORREO --}}
                    <div class="perfil-contact">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <span>Correo electrónico</span>
                            <strong>
                                {{ $user->email }}
                            </strong>
                        </div>
                    </div>
                    {{-- CELULAR --}}
                    <div class="perfil-contact">
                        <div class="contact-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <div>
                            <span>Celular</span>
                            <strong>
                                {{ $user->celular ?? 'No registrado' }}
                            </strong>
                        </div>
                    </div>
                </div>
            </div>
            {{-- TARJETA SEGURIDAD --}}
            <div class="card perfil-security-card">

                <div class="security-icon">

                    <i class="fas fa-shield-alt"></i>

                </div>

                <div>

                    <h5>
                        Seguridad de la cuenta
                    </h5>

                    <p>
                        Mantén segura tu cuenta utilizando
                        una contraseña actualizada.
                    </p>

                </div>

            </div>

        </div>


        {{-- =========================================
             COLUMNA DERECHA
             ========================================= --}}
        <div class="col-lg-8">

            <div class="card perfil-data-card">

                {{-- CABECERA --}}
                <div class="perfil-data-header">

                    <div>

                        <h4>
                            <i class="fas fa-id-card"></i>
                            Información personal
                        </h4>

                        <p>
                            Datos registrados en el sistema
                        </p>

                    </div>

                    <div class="perfil-header-icon">

                        <i class="fas fa-user-circle"></i>

                    </div>

                </div>


                {{-- DATOS --}}
                <div class="card-body">

                    <div class="row">


                        {{-- NOMBRES --}}
                        <div class="col-md-6">

                            <div class="data-box">

                                <div class="data-icon">

                                    <i class="fas fa-user"></i>

                                </div>

                                <div class="data-content">

                                    <span>NOMBRE(S)</span>

                                    <strong>
                                        {{ $user->name }}
                                    </strong>

                                </div>

                            </div>

                        </div>


                        {{-- PATERNO --}}
                        <div class="col-md-6">

                            <div class="data-box">

                                <div class="data-icon">

                                    <i class="fas fa-user-tag"></i>

                                </div>

                                <div class="data-content">

                                    <span>APELLIDO PATERNO</span>

                                    <strong>
                                        {{ $user->paterno ?? 'No registrado' }}
                                    </strong>

                                </div>

                            </div>

                        </div>


                        {{-- MATERNO --}}
                        <div class="col-md-6">

                            <div class="data-box">

                                <div class="data-icon">

                                    <i class="fas fa-user-tag"></i>

                                </div>

                                <div class="data-content">

                                    <span>APELLIDO MATERNO</span>

                                    <strong>
                                        {{ $user->materno ?? 'No registrado' }}
                                    </strong>

                                </div>

                            </div>

                        </div>


                        {{-- C.I. --}}
                        <div class="col-md-6">

                            <div class="data-box">

                                <div class="data-icon">

                                    <i class="fas fa-id-badge"></i>

                                </div>

                                <div class="data-content">

                                    <span>DOCUMENTO DE IDENTIDAD</span>

                                    <strong>

                                        {{ $user->ci ?? 'No registrado' }}

                                        @if($user->expedido)
                                            {{ $user->expedido }}
                                        @endif

                                    </strong>

                                </div>

                            </div>

                        </div>


                        {{-- CELULAR --}}
                        <div class="col-md-6">

                            <div class="data-box">

                                <div class="data-icon">

                                    <i class="fas fa-phone-alt"></i>

                                </div>

                                <div class="data-content">

                                    <span>CELULAR</span>

                                    <strong>

                                        {{ $user->celular ?? 'No registrado' }}

                                    </strong>

                                </div>

                            </div>

                        </div>


                        {{-- EMAIL --}}
                        <div class="col-md-6">

                            <div class="data-box">

                                <div class="data-icon">

                                    <i class="fas fa-envelope"></i>

                                </div>

                                <div class="data-content">

                                    <span>CORREO ELECTRÓNICO</span>

                                    <strong>

                                        {{ $user->email }}

                                    </strong>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- INFORMACIÓN DE ACCESO --}}
                    <div class="access-section">

                        <div class="access-title">

                            <i class="fas fa-lock"></i>

                            Información de acceso

                        </div>


                        <div class="row">

                            {{-- ROL --}}
                            <div class="col-md-6">

                                <div class="access-box">

                                    <span>
                                        ROL DEL SISTEMA
                                    </span>

                                    <strong>

                                        @if(auth()->user()->hasRole('SuperAdministrador'))
                                            <i class="fas fa-user-shield"></i>
                                            SuperAdministrador

                                        @elseif(auth()->user()->hasRole('Administrador'))
                                            <i class="fas fa-user-cog"></i>
                                            Administrador

                                        @elseif(auth()->user()->hasRole('Tecnico'))
                                            <i class="fas fa-tools"></i>
                                            Técnico

                                        @else
                                            <i class="fas fa-user"></i>
                                            Usuario
                                        @endif

                                    </strong>

                                </div>

                            </div>


                            {{-- ESTADO --}}
                            <div class="col-md-6">

                                <div class="access-box">

                                    <span>
                                        ESTADO DE CUENTA
                                    </span>

                                    <strong class="account-active">

                                        <i class="fas fa-check-circle"></i>

                                        {{ $user->estadoUsuario->nombre ?? 'Activo' }}

                                    </strong>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- FOOTER --}}
                <div class="perfil-data-footer">

                    <div class="footer-message">

                        <i class="fas fa-info-circle"></i>

                        La información mostrada corresponde
                        a tu cuenta de usuario.

                    </div>


                    <!-- <button type="button"
                            class="btn btn-primary btn-edit-profile"
                            data-toggle="modal"
                            data-target="#changePasswordModal">

                        <i class="fas fa-key"></i>

                        Cambiar contraseña

                    </button> -->

                </div>

            </div>

        </div>

    </div>

</div>

@stop


@section('css')

<link rel="stylesheet" href="{{ asset('estilos/perfil.css') }}">

@stop