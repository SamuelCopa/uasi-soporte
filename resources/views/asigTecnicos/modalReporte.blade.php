<div class="modal fade" id="modalReporte" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-file-pdf"></i>
                    Generar reporte PDF
                </h5>
                <button type="button"
                        class="close text-white"
                        data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.asignaciones2.pdf', $user->id) }}" method="GET" target="_blank">
                <div class="modal-body">
                    <!-- TIPO DE REPORTE -->
                    <div class="form-group">
                        <label>Tipo de reporte</label>
                        <select name="tipo" id="tipoReporte" class="form-control">
                            <option value="anio">
                                Por año
                            </option>
                            <option value="mes">
                                Por mes
                            </option>
                        </select>
                    </div>
                    <!-- AÑO -->
                   <div class="form-group">
                        <label>Año</label>
                        <select name="anio" class="form-control">
                            @for($i = date('Y'); $i >= 2024; $i--)
                                <option value="{{ $i }}" {{ $i == date('Y') ? 'selected' : '' }}>
                                    {{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <!-- MES -->
                    <div class="form-group" id="contenedorMes" style="display: none;">
                        <label>Mes</label>
                        <select name="mes" class="form-control">
                            <option value="1">Enero</option>
                            <option value="2">Febrero</option>
                            <option value="3">Marzo</option>
                            <option value="4">Abril</option>
                            <option value="5">Mayo</option>
                            <option value="6">Junio</option>
                            <option value="7">Julio</option>
                            <option value="8">Agosto</option>
                            <option value="9">Septiembre</option>
                            <option value="10">Octubre</option>
                            <option value="11">Noviembre</option>
                            <option value="12">Diciembre</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-file-pdf"></i>
                        Generar PDF
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>