@extends('layouts.app')

@section('template_title')
    Users
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-header card-header--custom">
                </div>
                    <div class="header-panel">
                        <div class="header-left">
                            <h1 class="header-title">lista de responsables</h1>
                        </div>
                        <div class="header-actions">
                        <!-- Botón -->
                        <button class="btn btn-primary"
                                data-toggle="modal"
                                data-target="#crear">
                            <i class="fa fa-plus me-1"></i> Nuevo
                        </button>
                        </div>
                    </div>
                    <!--Ventana Modal para Crear--->
                    @include('user.modalCrear')
                    <div class="card shadow-sm border-0 rounded-4">
                        <div class="card-header  border-0 d-flex justify-content-between align-items-center">
                        </div>

                        <div class="table-responsive">
                            <table id="mitabla" class="table table-modern align-middle">

                                <thead>
                                    <!-- Encabezado principal -->
                                    <tr class="text-center">
                                        <th>#</th>
									<th >APELLIDO PATERNO</th>
									<th >APELLIDO MATERNO</th>
									<th >NOMBRE(S)</th>
									<th >C.I.</th>
									<th >CELULAR</th>
									<th >CORREO ELECTRONICO (Usuario)</th>
									<th >CARGO</th>
									<th >ESTADO</th>
                                    <th>OPCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
                                            <td>{{ $user->paterno }}</td>
                                            <td>{{ $user->materno }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->ci }} {{$user->expedido}}</td>
                                            <td>{{ $user->celular }}</td>
                                            <td>{{ $user->email }}</td>
                                                <td>
                                                    @forelse($user->roles as $rol)
                                                        <span class="badge bg-primary d-block mb-1">
                                                            {{ $rol->name }}
                                                        </span>
                                                    @empty
                                                        <span class="text-muted">SIN ROL</span>
                                                    @endforelse
                                                </td>
                                            <td>
                                                @if($user->id_estadousuario == '1')
                                                    <button type="submit"
                                                            class="btn btn-primary btn-raised"
                                                            @hasAnyRole(['Administrador', 'SuperAdministrador'])
                                                                title="Actualizar estado"
                                                                data-id="{{ $user->id }}"
                                                                onclick="cambiarEstado({{ $user->id }}, {{ $user->id_estadousuario }})"
                                                            @endhasAnyRole>
                                                        ACTIVO
                                                    </button>

                                                @elseif($user->id_estadousuario == '2')
                                                    <button type="submit"
                                                            class="btn btn-danger btn-raised"
                                                            @hasAnyRole(['Administrador', 'SuperAdministrador'])
                                                                title="Actualizar estado"
                                                                data-id="{{ $user->id }}"
                                                                onclick="cambiarEstado({{ $user->id }}, {{ $user->id_estadousuario }})"
                                                            @endhasAnyRole>
                                                        INACTIVO
                                                    </button>
                                                @endif
                                            <form id="form-cambiar-estado" method="POST" action="{{ route('estado-usuario') }}">
                                                @csrf
                                                <input type="hidden" name="id" id="id-user">
                                                <input type="hidden" name="id_estadousuario" id="id_estadousuario">
                                            </form> 
                                            </td>

                                            <td>
                                               <div class="acciones">

                                            <!-- VER -->
                                            <button
                                                type="button"
                                                data-toggle="modal"
                                                data-target="#ver{{ $user->id }}"
                                                class="btn btn-primary btn-sm btn-mini"
                                                title="Ver">

                                                <i class="fa fa-eye"></i>
                                            </button>

                                            <!-- EDITAR -->
                                            <button
                                                type="button"
                                                data-toggle="modal"
                                                data-target="#editar{{ $user->id }}"
                                                class="btn btn-success btn-sm btn-mini"
                                                title="Editar">

                                                <i class="fa fa-edit"></i>
                                            </button>

                                            <!-- CAMBIAR CONTRASEÑA -->
                                            <button
                                                type="button"
                                                data-toggle="modal"
                                                data-target="#Password{{ $user->id }}"
                                                class="btn btn-secondary btn-sm btn-mini"
                                                title="Cambiar contraseña">

                                                <i class="fa fa-key"></i>
                                            </button>

                                            <!-- ELIMINAR -->
                                            <form
                                                action="{{ route('users.destroy', $user->id) }}"
                                                method="POST"
                                                class="formEliminar d-inline">

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="btn btn-danger btn-sm btn-mini"
                                                    title="Eliminar">

                                                    <i class="fa fa-trash"></i>
                                                </button>

                                            </form>

                                        </div>
                                            </td>
                                        </tr>
                                        <!--Ventana Modal Password --->
                                        @include('user.modalPassword')
                                        <!--Ventana Modal para Ver --->
                                        @include('user.modalVer')
                                        <!--Ventana Modal para Actualizar--->
                                        @include('user.modalEdit')
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th >APELLIDO PATERNO</th>
                                        <th >APELLIDO MATERNO</th>
                                        <th >NOMBRE</th>
                                        <th >C.I.</th>
                                        <th >CELULAR</th>
                                        <th >CORREO ELECTRONICO (Usuario)</th>
                                        <th >CARGO</th>
                                        <th >ESTADO</th>
                                        <th>OPCIONES</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $users->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@if ($errors->any())
<script>
Swal.fire({
    icon: 'error',
    title: 'Error',
    text: '{{ $errors->first() }}'
});
</script>
@endif
@endsection

@section('js')
<script>
function cambiarEstado(id, id_estadousuario) {

    Swal.fire({
        title: '¿Cambiar estado?',
        text: "¿Estás seguro de modificar el estado de este usuario?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, cambiar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // --- Ejecutar el cambio solo si confirma ---

            var xhr = new XMLHttpRequest();
            xhr.open('POST', '{{ route('estado-usuario') }}', true);
            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.send('id=' + id + '&id_estadousuario=' + id_estadousuario);

            xhr.onload = function() {
                if (xhr.status === 200) {
                    var respuesta = JSON.parse(xhr.responseText);
                    var nuevoEstado = respuesta.estado;

                    // Actualizar el botón visualmente
                    var boton = document.querySelector('button[data-id="' + id + '"]');
                    boton.textContent = nuevoEstado;
                    boton.classList.remove('btn-primary', 'btn-danger');
                    if (nuevoEstado === 'ACTIVO') {
                        boton.classList.add('btn-primary');
                    } else if (nuevoEstado === 'INACTIVO') {
                        boton.classList.add('btn-danger');
                    }

                    // Mensaje de éxito
                    Swal.fire({
                        position: "top-center",
                        icon: "success",
                        title: "Estado actualizado correctamente",
                        showConfirmButton: false,
                        timer: 1800
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error al actualizar",
                        text: "Ocurrió un problema en la solicitud.",
                    });
                }
            };
        }
    });
}
</script>

<script>
    $(document).ready(function() {
    $('#ci').on('input', function() {
        $('#password').val($(this).val());
        $('#password_confirmation').val($(this).val());
    });
});
</script>


@stop
