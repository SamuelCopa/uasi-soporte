<div class="modal fade" id="modalEstabilizador" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    
    <div class="modal-content border-0 shadow rounded-4">

      <!-- HEADER -->
      <div class="modal-header bg-institucional text-white">
        <h5 class="modal-title fw-semibold">
          <i class="fas fa-chart-bar me-2"></i> Módulo de Reportes
        </h5>
        <button type="button" class="btn-close btn-close-white" data-dismiss="modal"></button>
      </div>

      <!-- BODY -->
      <div class="modal-body p-4">

        <div class="row g-4">

          <!-- REPORTE POR AÑO -->
          <div class="col-md-4">
            <div class="card card-reporte h-100">
              <div class="card-body">
                <h6 class="titulo-seccion">Por Año</h6>

                <form action="{{ route('search.YearEstabilizador') }}" method="GET">
                  <div class="mb-3">
                    <label class="form-label">Año</label>
                    <input type="number" name="query" class="form-control" placeholder="Ej: 2026" required>
                  </div>

                  <button class="btn btn-institucional w-100">
                    <i class="fas fa-search me-1"></i> Consultar
                  </button>
                </form>
              </div>
            </div>
          </div>

          <!-- REPORTE POR FECHA -->
          <div class="col-md-4">
            <div class="card card-reporte h-100">
              <div class="card-body">
                <h6 class="titulo-seccion">Por Rango de Fechas</h6>

                <form action="{{ route('repFecha.estabilizador') }}" method="GET">
                  <div class="mb-2">
                    <label class="form-label">Inicio</label>
                    <input type="date" name="start_date" class="form-control" required>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Fin</label>
                    <input type="date" name="end_date" class="form-control" required>
                  </div>

                  <button class="btn btn-institucional w-100">
                    <i class="fas fa-search me-1"></i> Consultar
                  </button>
                </form>
              </div>
            </div>
          </div>

          <!-- REPORTE POR CODIGO -->
          <div class="col-md-4">
            <div class="card card-reporte h-100">
              <div class="card-body">
                <h6 class="titulo-seccion">Por Código GAMEA</h6>

                <form action="{{ route('search.Estabilizador') }}" method="GET">
                  <div class="mb-3">
                    <label class="form-label">Código</label>
                    <input type="number" name="query" class="form-control" placeholder="Ej: 12345" required>
                  </div>

                  <button class="btn btn-institucional w-100">
                    <i class="fas fa-search me-1"></i> Consultar
                  </button>
                </form>
              </div>
            </div>
          </div>

        </div>

      </div>

      <!-- FOOTER -->
      <div class="modal-footer bg-light border-0">
        <button class="btn btn-outline-secondary" data-dismiss="modal">
          <i class="fas fa-times me-1"></i> Cerrar
        </button>
      </div>

    </div>
  </div>
</div>
