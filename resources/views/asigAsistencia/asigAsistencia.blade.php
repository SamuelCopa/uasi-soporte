@extends('layouts.app')

@section('template_title')
    asignacions
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-header card-header--custom">
                </div>
                    <div class="header-panel">
                        <div class="header-left">
                            <h1 class="header-title">Requerimientos de asistencia técnica</h1>
                        </div>
                    </div>

                    <div class="card shadow-sm border-0 rounded-4">
                        <div class="table-responsive">
                            <table id="mitabla" class="table table-modern align-middle">
                                <thead class="thead">
                                    <tr>
                                    <th>No</th>                                        
									<th >FECHA</th>
									<th >NOMBRE</th>
									<th >DEPENDENCIA</th>
									<th >EQUIPO</th>
									<th >FALLA</th>
                                    <th >FECHA DE ASIGNACIÓN</th>
									<th >SERVICIO</th>
                                    <th >FECHA DE ATENCIÓN</th>
									<th >ESTADO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($asignaciones as $asignacion)
                                        <tr>
                                        <td>{{ $loop->index + 1 }}</td>
										<td >{{date('d-m-Y H:i',strtotime($asignacion->created_at ?? ''))}}</td>
                                        <td >{{$asignacion->funcionario?->nombre }} {{ $asignacion->funcionario?->paterno }} {{ $asignacion->funcionario?->materno }}</td>
										<td >{{ $asignacion->Dependencia?->dependencias }}</td>
										<td >{{ $asignacion->equipo ?? '' }}</td>
										<td >{{ $asignacion->falla ?? '' }}</td>
										<td >{{ $asignacion->fecha_asignacion ?? '' }}</td>
										<td >{{ $asignacion->servicio ?? '' }}</td>
                                        <td class="{{ empty($asignacion->fecha_atencion ) ? 'color1' : '' }}">
                                            @if($asignacion->fecha_atencion)
                                            {{ date('d-m-Y H:i',strtotime($asignacion->fecha_atencion ))}}
                                            @elseif(! $asignacion->fecha_atencion)	
                                            {{($asignacion->fecha_atencion ?? 'EN ESPERA ')}}                                                    
                                            @endif							
                                        </td>
                                        <td>
                                            @if(!$asignacion->visto == 1)
                                                <button type="button"
                                                        class="btn btn-danger btn-sm">
                                                    <i class="fas fa-star"></i>
                                                    PENDIENTE
                                                </button>
                                            @else
                                                <button type="button"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="fas fa-check-circle"></i>
                                                    ATENDIDO
                                                </button>
                                            @endif
                                        </td>
                                        </tr>
                                    @include('asigAsistencia.modalAsistencia')
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                  <th>No</th>                                        
									<th >FECHA</th>
									<th >NOMBRE</th>
									<th >DEPENDENCIA</th>
									<th >EQUIPO</th>
									<th >FALLA</th>
                                    <th >FECHA DE ASIGNACIÓN</th>
									<th >SERVICIO</th>
                                    <th >FECHA DE ATENCIÓN</th>
									<th >ESTADO</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <style>
.emojis {
    display: flex;
    justify-content: center;
    align-items: stretch;
    flex-wrap: wrap;
    gap: 12px;
    width: 100%;
    margin: 25px auto;
}

.emojis input {
    display: none;
}

.emojis label {
    flex: 1 1 100px;
    max-width: 120px;
    min-width: 80px;
    height: 120px;

    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;

    border: 2px solid #ddd;
    border-radius: 15px;
    background: #fff;

    cursor: pointer;
    text-align: center;

    transition: all 0.25s ease;
}

.emojis label span {
    font-size: clamp(40px, 7vw, 65px);
    line-height: 1;
    margin-bottom: 10px;

    filter: grayscale(100%);
    transition: all 0.25s ease;
}

.emojis label strong {
    font-size: clamp(10px, 2vw, 13px);
    color: #555;
}

/* Hover */
.emojis label:hover {
    transform: translateY(-5px);
    border-color: #007bff;
    box-shadow: 0 5px 15px rgba(0,0,0,.15);
}

.emojis label:hover span {
    filter: grayscale(0%);
    transform: scale(1.1);
}

/* Seleccionada */
.emojis input:checked + label {
    background: #e8f1ff;
    border-color: #007bff;
    transform: scale(1.05);
    box-shadow: 0 5px 18px rgba(0,123,255,.30);
}

.emojis input:checked + label span {
    filter: grayscale(0%);
    transform: scale(1.15);
}

.emojis input:checked + label strong {
    color: #007bff;
}


/* ========================= */
/* CELULARES */
/* ========================= */

@media (max-width: 576px) {

    .emojis {
        gap: 8px;
    }

    .emojis label {
        flex: 1 1 80px;
        min-width: 70px;
        height: 105px;
        padding: 8px 4px;
    }

    .emojis label span {
        font-size: 42px;
    }

    .emojis label strong {
        font-size: 10px;
    }

}


/* ========================= */
/* CELULARES MUY PEQUEÑOS */
/* ========================= */

@media (max-width: 400px) {

    .emojis {
        gap: 6px;
    }

    .emojis label {
        flex: 1 1 65px;
        min-width: 60px;
        height: 95px;
    }

    .emojis label span {
        font-size: 35px;
    }

    .emojis label strong {
        font-size: 9px;
    }

}
.evaluacion {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-weight: 600;
}

.evaluacion .emoji {
    font-size: 30px;
    line-height: 1;
}

.textoSolicitud {
    text-align: center;
    color: #007bff;
    font-weight: 700;
}




/* =========================================
   MODAL DE EVALUACIÓN
========================================= */

.modal-evaluacion {
    border: none;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.30);
}


/* =========================================
   ENCABEZADO
========================================= */

.modal-header-evaluacion {
    background: linear-gradient(135deg, #0052cc, #2684ff);
    color: white;
    border: none;
    padding: 22px 28px;
}

.titulo-modal {
    display: flex;
    align-items: center;
    gap: 15px;
}

.icono-evaluacion {
    width: 48px;
    height: 48px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 14px;

    background: rgba(255, 255, 255, 0.18);

    font-size: 22px;
}

.modal-title {
    font-size: 21px;
    font-weight: 700;
    margin: 0;
}

.titulo-modal small {
    display: block;
    margin-top: 3px;
    font-size: 13px;
    opacity: 0.85;
}

.btn-cerrar {
    color: white !important;
    opacity: 0.9;
    font-size: 30px;
    outline: none !important;
}

.btn-cerrar:hover {
    opacity: 1;
}


/* =========================================
   CUERPO
========================================= */

.modal-body-evaluacion {
    padding: 30px;
    background: #f8fafc;
}


/* =========================================
   CAMPO DE ASISTENCIA
========================================= */

.campo-asistencia {
    margin-bottom: 30px;
}

.label-evaluacion {
    display: block;

    font-size: 15px;
    font-weight: 700;

    color: #263238;

    margin-bottom: 10px;
}

.label-evaluacion i {
    color: #0052cc;
    margin-right: 6px;
}

.textarea-evaluacion {
    width: 100%;
    min-height: 100px;

    padding: 13px 16px;

    border: 1px solid #d7dee8;
    border-radius: 12px;

    background: white;

    font-size: 14px;

    resize: vertical;

    transition: all 0.25s ease;
}

.textarea-evaluacion:focus {
    outline: none;

    border-color: #2684ff;

    box-shadow: 0 0 0 3px rgba(38, 132, 255, 0.12);
}

.ayuda-texto {
    display: block;

    margin-top: 7px;

    color: #7b8794;

    font-size: 12px;
}


/* =========================================
   PUNTUACIÓN
========================================= */

.seccion-puntuacion {
    text-align: center;

    padding-top: 5px;
}

.titulo-puntuacion {
    color: #263238;

    font-size: 17px;
    font-weight: 700;

    margin-bottom: 5px;
}

.titulo-puntuacion i {
    color: #f5b301;
    margin-right: 5px;
}

.subtitulo-puntuacion {
    color: #7b8794;
    font-size: 13px;

    margin-bottom: 20px;
}


/* =========================================
   EMOJIS
========================================= */

.emojis {
    display: flex;

    justify-content: center;
    align-items: stretch;

    gap: 12px;

    margin: 20px 0;
}

.emojis input {
    display: none;
}

.emoji-card {
    width: 115px;
    min-height: 125px;

    display: flex;

    flex-direction: column;

    justify-content: center;

    align-items: center;

    border: 2px solid #e1e6ed;

    border-radius: 16px;

    background: white;

    cursor: pointer;

    transition:
        transform 0.25s ease,
        box-shadow 0.25s ease,
        border-color 0.25s ease,
        background 0.25s ease;
}

.emoji-card span {
    font-size: 58px;

    line-height: 1;

    margin-bottom: 10px;

    filter: grayscale(100%);

    transition:
        transform 0.25s ease,
        filter 0.25s ease;
}

.emoji-card strong {
    font-size: 13px;

    color: #59636e;

    transition: color 0.25s ease;
}


/* Hover */

.emoji-card:hover {
    transform: translateY(-6px);

    border-color: #2684ff;

    box-shadow: 0 10px 25px rgba(0, 82, 204, 0.15);
}

.emoji-card:hover span {
    filter: grayscale(0%);

    transform: scale(1.12);
}


/* Seleccionado */

.emojis input:checked + .emoji-card {
    background: #edf5ff;

    border-color: #0052cc;

    transform: translateY(-7px) scale(1.04);

    box-shadow:
        0 10px 28px rgba(0, 82, 204, 0.22);
}

.emojis input:checked + .emoji-card span {
    filter: grayscale(0%);

    transform: scale(1.18);
}

.emojis input:checked + .emoji-card strong {
    color: #0052cc;
}


/* =========================================
   MENSAJE
========================================= */

.mensaje-puntuacion {
    display: inline-block;

    margin-top: 5px;

    padding: 9px 16px;

    border-radius: 20px;

    background: #eef5ff;

    color: #0052cc;

    font-size: 13px;

    font-weight: 600;
}


/* =========================================
   FOOTER
========================================= */

.footer-evaluacion {
    background: white;

    border-top: 1px solid #edf0f4;

    padding: 18px 25px;
}

.btn-cancelar {
    border: none;

    border-radius: 10px;

    padding: 10px 18px;

    font-weight: 600;

    color: #59636e;

    background: #eef1f4;
}

.btn-cancelar:hover {
    background: #e1e5e9;
}

.btn-confirmar {
    border: none;

    border-radius: 10px;

    padding: 10px 20px;

    font-weight: 600;

    background: #198754;

    color: white;

    box-shadow: 0 4px 12px rgba(25, 135, 84, 0.20);

    transition: all 0.2s ease;
}

.btn-confirmar:hover {
    transform: translateY(-2px);

    box-shadow: 0 7px 18px rgba(25, 135, 84, 0.30);

    color: white;
}


/* =========================================
   FONDO DETRÁS DEL MODAL
========================================= */

.modal-backdrop.show {
    background-color: #000;

    opacity: 0.78;
}


/* =========================================
   RESPONSIVE
========================================= */

@media (max-width: 768px) {

    .modal-dialog {
        margin: 10px;
    }

    .modal-body-evaluacion {
        padding: 20px 15px;
    }

    .emojis {
        gap: 7px;
    }

    .emoji-card {
        width: 18%;
        min-height: 105px;
    }

    .emoji-card span {
        font-size: 42px;
    }

    .emoji-card strong {
        font-size: 11px;
    }

}


@media (max-width: 480px) {

    .modal-header-evaluacion {
        padding: 18px;
    }

    .modal-title {
        font-size: 18px;
    }

    .icono-evaluacion {
        width: 42px;
        height: 42px;
    }

    .emojis {
        gap: 4px;
    }

    .emoji-card {
        width: 19%;

        min-height: 90px;

        border-radius: 11px;
    }

    .emoji-card span {
        font-size: 32px;

        margin-bottom: 6px;
    }

    .emoji-card strong {
        font-size: 9px;
    }

    .footer-evaluacion {
        flex-direction: column-reverse;
        gap: 8px;
    }

    .footer-evaluacion button {
        width: 100%;
    }

}
</style>
@endsection