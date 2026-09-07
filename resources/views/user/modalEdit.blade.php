<!--ventana para Update--->
<div class="modal fade"
     id="editar{{ $user->id }}"
     tabindex="-1"
     role="dialog"
     aria-labelledby="editarModalLabel{{ $user->id }}"
     aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-centered">

        <div class="modal-content modal-password">

            {{-- CABECERA --}}
            <div class="modal-header modal-password-header">

                <div class="modal-title-container">

                    <div class="modal-password-icon">
                        <i class="fas fa-user-edit"></i>
                    </div>

                    <div>
                        <h4 class="modal-title">
                            ACTUALIZAR REGISTRO
                        </h4>

                        <small>
                            Modificación de los datos del usuario
                        </small>
                    </div>
                </div>

                <button type="button"
                        class="close modal-password-close"
                        data-dismiss="modal"
                        aria-label="Cerrar">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>


            {{-- FORMULARIO --}}
            <form method="POST" action="{{ route('users.update', $user->id) }}" role="form" enctype="multipart/form-data">
                {{ method_field('PATCH') }}
                @csrf
                {{-- CUERPO --}}
                <div class="modal-body modal-password-body">
                    {{-- DATOS DEL USUARIO --}}
                    <div class="registro-section">
                        <div class="registro-section-title">
                            <i class="fas fa-id-card"></i>
                            DATOS DEL USUARIO
                        </div>
                        @include('user.form')
                    </div>
                </div>
                {{-- FOOTER --}}
                <div class="modal-footer modal-password-footer">

                    <button type="submit"
                            class="btn btn-password-save">

                        <i class="fas fa-save"></i>

                        GUARDAR CAMBIOS

                    </button>


                    <button type="button"
                            class="btn btn-password-close"
                            data-dismiss="modal">

                        <i class="fas fa-times"></i>

                        CERRAR

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


<link rel="stylesheet" href="{{ asset('estilos/password.css') }}">  
  <!---fin ventana Update --->
