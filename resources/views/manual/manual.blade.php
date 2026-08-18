@extends('layouts.app')

@section('content')
<div class="card">
<div class="dashboard-container">

    <!-- Encabezado -->
    <div class="dashboard-header">
        <h2>📘 Manual de Usuario</h2>
    </div>


    <div class="manual-section">

    <!-- Tarjeta PDF -->
    <div class="pdf-card" onclick="abrirPDF()">
        <div class="pdf-icon">📄</div>
        <div class="pdf-info">
            <h4>Manual de Usuario</h4>
            <p>Ver documento</p>
        </div>
    </div>

    <!-- Visor oculto -->
    <div id="visorPDF" class="pdf-viewer hidden">

        <div class="viewer-header">
            <span>📘 Manual de Usuario</span>
            <div class="acciones">
                <a href="{{ asset('manual/manual.pdf') }}" target="_blank">⬇ Descargar</a>
                <button onclick="cerrarPDF()">✖</button>
            </div>
        </div>

        <iframe 
            src="{{ asset('manual/manual.pdf') }}" 
            width="100%" 
            height="600px">
        </iframe>

    </div>

</div>

<div class="videos-section">

    <!-- Encabezado -->
    <div class="section-header">
        <h3>🎬 VIDEOS DE CAPACITACIÓN</h3>
        <p>Material audiovisual</p>
    </div>

    <!-- Grid de videos -->
    <div class="videos-grid">
            <div class="video-card">
                <div class="video-wrapper">
                    <video controls preload="metadata">
                        <source src="{{asset('manual/2ingreso.mp4')}}" type="video/mp4">
                    </video>
                </div>
                <div class="video-info">
                    <h5></h5>
                    <span class="video-tag">Ingreso al sistema</span>
                </div>
            </div>
            <div class="video-card">
                <div class="video-wrapper">
                    <video controls preload="metadata">
                        <source src="{{asset('manual/3registroequipo.mp4')}}" type="video/mp4">
                    </video>
                </div>
                <div class="video-info">
                    <h5></h5>
                    <span class="video-tag">Registro nuevo</span>
                </div>
            </div>
            <div class="video-card">
                <div class="video-wrapper">
                    <video controls preload="metadata">
                        <source src="{{asset('manual/4formulario.mp4')}}" type="video/mp4">
                    </video>
                </div>
                <div class="video-info">
                    <h5></h5>
                    <span class="video-tag">Enviar formulario de recepción</span>
                </div>
            </div>
            
            <div class="video-card">
                <div class="video-wrapper">
                    <video controls preload="metadata">
                        <source src="{{asset('manual/5receptecnico.mp4')}}" type="video/mp4">
                    </video>
                </div>
                <div class="video-info">
                    <h5></h5>
                    <span class="video-tag">Registrar número de recepción</span>
                    <span class="video-tag">Asignar técnico</span>
                </div>
            </div>
            <div class="video-card">
                <div class="video-wrapper">
                    <video controls preload="metadata">
                        <source src="{{asset('manual/6estados.mp4')}}" type="video/mp4">
                    </video>
                </div>
                <div class="video-info">
                    <h5></h5>
                    <span class="video-tag">Cambio de estados</span>
                </div>
            </div>
            <div class="video-card">
                <div class="video-wrapper">
                    <video controls preload="metadata">
                        <source src="{{asset('manual/7informe.mp4')}}" type="video/mp4">
                    </video>
                </div>
                <div class="video-info">
                    <h5></h5>
                    <span class="video-tag">Informes</span>
                </div>
            </div>
            <div class="video-card">
                <div class="video-wrapper">
                    <video controls preload="metadata">
                        <source src="{{asset('manual/8seguimiento.mp4')}}" type="video/mp4">
                    </video>
                </div>
                <div class="video-info">
                    <h5></h5>
                    <span class="video-tag">Seguimiento</span>
                </div>
            </div>

            <div class="video-card">
                <div class="video-wrapper">
                    <video controls preload="metadata">
                        <source src="{{asset('manual/tecnicos.mp4')}}" type="video/mp4">
                    </video>
                </div>
                <div class="video-info">
                    <h5></h5>
                    <span class="video-tag">Registro técnicos</span>
                </div>
            </div>
            <div class="video-card">
                <div class="video-wrapper">
                    <video controls preload="metadata">
                        <source src="{{asset('manual/reportes.mp4')}}" type="video/mp4">
                    </video>
                </div>
                <div class="video-info">
                    <h5></h5>
                    <span class="video-tag">Generar reportes</span>
                </div>
            </div>
    </div>

</div>



</div>
</div>
<link rel="stylesheet" href="{{ asset('estilos/manual.css') }}">  
<script>
function abrirPDF() {
    document.getElementById('visorPDF').classList.remove('hidden');
}

function cerrarPDF() {
    document.getElementById('visorPDF').classList.add('hidden');
}
</script>
@endsection