@extends('layouts.app')

@section('template_title')
    Users
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class=" card-header--custom">
                </div>
                    <div class="header-panel">
                        <div class="header-left">
                            <h1 class="header-title">Registro de Técnicos</h1>
                        </div>
                        <div class="header-actions">
                        <!-- Botón -->
                        <button class="btn btn-primary"
                                data-toggle="modal"
                                data-target="#crear">
                            <i class="fa fa-plus me-1"></i> Nuevo
                        </button>
                        <button type="button" class="btn-header"" data-toggle="modal" data-target="#modalReporte">
                        <i class="fas fa-file-pdf"></i>REPORTE GENERAL
                        </button>
                        </div>
                    </div>
                    <!--Ventana Modal para Crear--->
                    @include('tecnico.modalCrear')
                    <!--Ventana Modal para Reporte--->
                    @include('tecnico.modalReporte')               
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
                                                                <td>{{ $loop->index + 1 }}</td>
                                                                <td>{{ $user->paterno }}</td>
                                                                <td>{{ $user->materno }}</td>
                                                                <td>{{ $user->name ?? ''}}</td>
                                                                <td>{{ $user->ci }} {{ $user->expedido }}</td>
                                                                <td>{{ $user->celular }}</td>
                                                                <td>{{ $user->email }}</td>
                                                                <td>{{ $user->roles->pluck('name')->implode(', ') ?? 'Sin rol' }}</td>
                                                                <td>
                                                                    @if($user->id_estadousuario== '1')
                                                                        <button type="submit" class="btn btn-primary btn-raised"@role('Administrador') title="Actualizar estado" data-id="{{ $user->id }}" onclick="cambiarEstado({{ $user->id }},{{ $user->id_estadousuario}} )"@endrole>ACTIVO</button>
                                                                    @elseif($user->id_estadousuario == '2')
                                                                        <button class="btn btn-danger btn-raised"@role('Administrador') title="Actualizar estado" data-id="{{ $user->id }}" onclick="cambiarEstado({{ $user->id }}, {{ $user->id_estadousuario }} )"@endrole>INACTIVO</button>
                                                                    @endif
                                                                    <form id="form-cambiar-estado" method="POST" action="{{ route('estado.tecnico') }}">
                                                                        @csrf
                                                                        <input type="hidden" name="id" id="id-user">
                                                                        <input type="hidden" name="id_estadousuario" id="id_estadousuario">
                                                                    </form> 
                                                                    </td>

                                                                <td>
                                                                    <div class="dropdown">
                                                                        <button class="btn btn-institucional dropdown-toggle" type="button" data-toggle="dropdown">
                                                                            <i class="fas fa-cog"></i> OPCIONES
                                                                        </button>
                                                                        <div class="dropdown-menu dropdown-menu-right p-2">
                                                                            <!-- VER -->
                                                                            <a href="{{ route('admin.verTecnico', $user->id) }}"
                                                                            class="dropdown-card card-primary">
                                                                                <i class="fa fa-eye"></i>
                                                                                VER ASIGNACIONES
                                                                            </a>
                                                                            <!-- EDITAR -->
                                                                            <button type="button" data-toggle="modal" data-target="#editar{{ $user->id }}"
                                                                                    class="dropdown-card card-success">
                                                                                <i class="fa fa-edit"></i> EDITAR
                                                                            </button>
                                                                            <!-- PASSWORD -->
                                                                            <button type="button" data-toggle="modal" data-target="#Password{{ $user->id }}"
                                                                                    class="dropdown-card card-secondary">
                                                                                <i class="fa fa-edit"></i> CAMBIAR CONTRASEÑA
                                                                            </button>
                                                                            <!-- ELIMINAR -->
                                                                            <form action="{{ route('tecnicos.destroy', $user->id) }}" method="POST" class="formEliminar">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit"
                                                                                        class="dropdown-card card-danger">
                                                                                    <i class="fa fa-trash"></i> ELIMINAR
                                                                                </button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            @include('tecnico.modalPassword')
                                                            <!--Ventana Modal para Actualizar--->
                                                            @include('tecnico.modalEdit')
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>No</th>
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
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- {!! $users->withQueryString()->links() !!} --}}
                                </div>
                            </div>
                        </div>
@endsection

@section('js')
    <script>
document.addEventListener('DOMContentLoaded', function () {

    const tipo = document.getElementById('tipoReporte');
    const contenedorMes = document.getElementById('contenedorMes');

    tipo.addEventListener('change', function () {

        if (this.value === 'mes') {
            contenedorMes.style.display = 'block';
        } else {
            contenedorMes.style.display = 'none';
        }

    });

});
</script>
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
            xhr.open('POST', '{{ route('estado.tecnico') }}', true);
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
            xhr.open('POST', '{{ route('estado.tecnico') }}', true);
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
