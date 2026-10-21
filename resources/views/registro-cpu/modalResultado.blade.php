
{{-- MODAL: REGISTRAR DETALLE DEL TRABAJO REALIZADO --}}
<div class="modal fade" id="modalResultado{{ $registroCpu->id }}" tabindex="-1" role="dialog">

    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg">

            {{-- ENCABEZADO --}}
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title font-weight-bold"
                    id="tituloModalResultado{{ $registroCpu->id }}">
                    <i class="fas fa-tools mr-2"></i>
                    Registrar trabajo realizado
                </h5>

                <button type="button"
                        class="close text-white"
                        data-dismiss="modal"
                        aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            {{-- FORMULARIO --}}
            <form method="POST" action="{{ route('equipos.guardarResultado', ['tipo' => 'cpu','id' => $registroCpu->id]) }}" id="formResultado{{ $registroCpu->id }}">
                @csrf

                <div class="modal-body">

                    {{-- DETALLE DEL TRABAJO --}}
                    <div class="form-group">
                        <label for="detalle_trabajo{{ $registroCpu->id }}">
                            Detalle del trabajo realizado
                            <span class="text-danger">*</span>
                        </label>

                        <textarea
                            class="form-control"
                            id="detalle_trabajo{{ $registroCpu->id }}"
                            name="detalle_trabajo"
                            rows="4"
                            placeholder="Describe el diagnóstico, las acciones realizadas y las observaciones..."
                            required></textarea>

                        <small class="form-text text-muted">
                            Describe brevemente las tareas realizadas
                            durante la atención.
                        </small>
                    </div>

                    {{-- RESULTADO --}}
                    <div class="form-group mb-0">
                        <label for="resultado_id{{ $registroCpu->id }}">
                            Resultado de la atención
                            <span class="text-danger">*</span>
                        </label>

                        <select class="form-control"
                                id="resultado_id{{ $registroCpu->id }}"
                                name="resultado_id"
                                required>
                            <option value="">Seleccione un resultado</option>
                            <option value="1">DEVOLUCIÓN</option>
                            <option value="2">REPOSICIÓN</option>
                            <option value="3">REPLIEGUE</option>
                            <option value="4">CUSTODIO</option>
                            <option value="5">BAJA</option>
                        </select>
                    </div>

                </div>

                {{-- PIE DEL MODAL --}}
                <div class="modal-footer bg-light">
                    <button type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i>
                        Cancelar
                    </button>

                    <button type="submit"
                            class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i>
                        Guardar y finalizar
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>