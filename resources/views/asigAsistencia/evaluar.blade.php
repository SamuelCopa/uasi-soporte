<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Evaluar atención técnica</title>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


    <style>

        * {
            box-sizing: border-box;
        }

        body {

            margin: 0;

            min-height: 100vh;

            padding: 35px 15px;

            font-family: Arial, sans-serif;

            background:
                linear-gradient(
                    135deg,
                    #0052cc,
                    #2684ff
                );

            display: flex;

            justify-content: center;

            align-items: center;
        }

        /* CONTENEDOR */

        .evaluacion-container {

            width: 100%;

            max-width: 850px;

            background: #ffffff;

            border-radius: 22px;

            overflow: hidden;

            box-shadow:
                0 20px 60px
                rgba(0, 0, 0, .25);
        }


        /* HEADER */

        .evaluacion-header {

            padding: 30px;

            color: white;

            background:
                linear-gradient(
                    135deg,
                    #0052cc,
                    #2684ff
                );

            display: flex;

            align-items: center;

            gap: 18px;
        }


        .icono-header {

            width: 65px;

            height: 65px;

            border-radius: 18px;

            display: flex;

            align-items: center;

            justify-content: center;

            background:
                rgba(255,255,255,.18);

            font-size: 30px;
        }


        .evaluacion-header h1 {

            margin: 0;

            font-size: 25px;

            font-weight: 700;
        }


        .evaluacion-header p {

            margin: 5px 0 0;

            font-size: 14px;

            opacity: .85;
        }


        /* BODY */

        .evaluacion-body {

            padding: 35px;
        }


        /* INFORMACIÓN */

        .informacion {

            display: grid;

            grid-template-columns:
                repeat(2, 1fr);

            gap: 15px;

            margin-bottom: 30px;
        }


        .dato {

            padding: 15px;

            border-radius: 12px;

            background: #f6f8fb;

            border: 1px solid #e4e9ef;
        }


        .dato-titulo {

            display: block;

            color: #7b8794;

            font-size: 12px;

            margin-bottom: 5px;

            text-transform: uppercase;

            font-weight: 700;
        }


        .dato-valor {

            color: #263238;

            font-size: 15px;

            font-weight: 600;
        }


        .dato i {

            color: #0052cc;

            margin-right: 6px;
        }


        /* DETALLE */

        .campo-asistencia {

            margin-bottom: 30px;
        }


        .label-evaluacion {

            display: block;

            color: #263238;

            font-weight: 700;

            margin-bottom: 10px;
        }


        .label-evaluacion i {

            color: #0052cc;

            margin-right: 6px;
        }


        .textarea-evaluacion {

            width: 100%;

            min-height: 120px;

            padding: 15px;

            border: 1px solid #d9e0e7;

            border-radius: 12px;

            resize: vertical;

            font-size: 14px;
        }


        .textarea-evaluacion:focus {

            outline: none;

            border-color: #2684ff;

            box-shadow:
                0 0 0 3px
                rgba(38,132,255,.12);
        }


        .ayuda-texto {

            display: block;

            margin-top: 7px;

            color: #7b8794;
        }


        /* PUNTUACIÓN */

        .seccion-puntuacion {

            border-top: 1px solid #e9ecef;

            padding-top: 30px;
        }


        .titulo-puntuacion {

            text-align: center;

            color: #263238;

            font-size: 20px;

            font-weight: 700;

            margin-bottom: 5px;
        }


        .subtitulo-puntuacion {

            text-align: center;

            color: #7b8794;

            font-size: 14px;

            margin-bottom: 25px;
        }


        /* EMOJIS */

        .emojis {

            display: flex;

            justify-content: center;

            align-items: center;

            gap: 15px;

            margin: 25px 0;
        }


        .emojis input {

            display: none;
        }


        .emoji-card {

            width: 125px;

            height: 135px;

            display: flex;

            flex-direction: column;

            justify-content: center;

            align-items: center;

            border: 2px solid #e0e5eb;

            border-radius: 18px;

            background: #ffffff;

            cursor: pointer;

            transition: all .25s ease;
        }


        .emoji-card span {

            font-size: 60px;

            line-height: 1;

            margin-bottom: 10px;

            filter: grayscale(100%);

            transition: all .25s ease;
        }


        .emoji-card strong {

            font-size: 13px;

            color: #59636e;

            text-align: center;
        }


        /* HOVER */

        .emoji-card:hover {

            transform: translateY(-6px);

            border-color: #2684ff;

            box-shadow:
                0 8px 20px
                rgba(0,82,204,.15);
        }


        .emoji-card:hover span {

            filter: grayscale(0%);

            transform: scale(1.1);
        }


        /* SELECCIONADO */

        .emojis input:checked + .emoji-card {

            background: #edf5ff;

            border-color: #0052cc;

            transform:
                translateY(-8px)
                scale(1.05);

            box-shadow:
                0 10px 25px
                rgba(0,82,204,.20);
        }


        .emojis input:checked + .emoji-card span {

            filter: grayscale(0%);

            transform: scale(1.18);
        }


        .emojis input:checked + .emoji-card strong {

            color: #0052cc;
        }


        /* MENSAJE */

        .mensaje-puntuacion {

            text-align: center;

            color: #0052cc;

            font-weight: 600;

            font-size: 14px;

            margin-top: 15px;
        }


        /* FOOTER */

        .acciones {

            display: flex;

            justify-content: center;

            gap: 10px;

            margin-top: 30px;

            padding-top: 25px;

            border-top: 1px solid #e9ecef;
        }


        .btn-cancelar {

            padding: 12px 22px;

            border-radius: 10px;

            color: #495057;

            background: #e9ecef;

            text-decoration: none;

            font-weight: 600;
        }


        .btn-cancelar:hover {

            color: #212529;

            text-decoration: none;

            background: #dee2e6;
        }


        .btn-confirmar {

            border: none;

            padding: 12px 25px;

            border-radius: 10px;

            color: white;

            background: #198754;

            font-weight: 700;

            cursor: pointer;

            transition: .2s;
        }


        .btn-confirmar:hover {

            background: #157347;

            transform: translateY(-2px);
        }


        /* RESPONSIVE */

        @media(max-width: 700px) {

            body {

                padding: 15px 10px;

                align-items: flex-start;
            }


            .evaluacion-header {

                padding: 22px 18px;
            }


            .evaluacion-header h1 {

                font-size: 20px;
            }


            .icono-header {

                width: 50px;

                height: 50px;

                font-size: 23px;
            }


            .evaluacion-body {

                padding: 22px 15px;
            }


            .informacion {

                grid-template-columns: 1fr;
            }


            .emojis {

                gap: 5px;
            }


            .emoji-card {

                width: 19%;

                height: 105px;

                border-radius: 12px;
            }


            .emoji-card span {

                font-size: 40px;
            }


            .emoji-card strong {

                font-size: 9px;
            }


            .acciones {

                flex-direction: column;
            }


            .btn-cancelar,
            .btn-confirmar {

                width: 100%;

                text-align: center;
            }

        }

    </style>

</head>


<body>


<div class="evaluacion-container">


    {{-- HEADER --}}

    <div class="evaluacion-header">

        <div class="icono-header">

            <i class="fas fa-star"></i>

        </div>

        <div>

            <h1>
                Evaluar atención técnica
            </h1>

            <p>
                Gobierno Autónomo Municipal de El Alto
            </p>

        </div>

    </div>


    {{-- BODY --}}

    <div class="evaluacion-body">


        {{-- INFORMACIÓN DE LA SOLICITUD --}}

        <div class="informacion">


            <div class="dato">

                <span class="dato-titulo">

                    <i class="fas fa-hashtag"></i>

                    Solicitud

                </span>

                <span class="dato-valor">

                    #{{ $asignacion->id }}

                </span>

            </div>


            <div class="dato">

                <span class="dato-titulo">

                    <i class="fas fa-calendar"></i>

                    Fecha

                </span>

                <span class="dato-valor">

                    {{ $asignacion->created_at
                        ? $asignacion->created_at->format('d/m/Y H:i')
                        : 'Sin fecha'
                    }}

                </span>

            </div>


            @if($asignacion->tecnico)

                <div class="dato">

                    <span class="dato-titulo">

                        <i class="fas fa-user-cog"></i>

                        Técnico asignado

                    </span>

                    <span class="dato-valor">

                        {{ $asignacion->tecnico->name }} {{ $asignacion->tecnico->paterno }} {{ $asignacion->tecnico->materno }}

                    </span>

                </div>

            @endif


            @if($asignacion->funcionario)

                <div class="dato">

                    <span class="dato-titulo">

                        <i class="fas fa-user"></i>

                        Solicitante

                    </span>

                    <span class="dato-valor">

                        {{ $asignacion->funcionario->nombre }} {{ $asignacion->funcionario->paterno }} {{ $asignacion->funcionario->materno }}

                    </span>

                </div>

            @endif


        </div>


        {{-- FORMULARIO --}}

        <form action="{{ route(
                    'evaluacion.guardar'
                ) }}"
              method="POST">

            @csrf


            {{-- ID DE LA ASIGNACIÓN --}}

            <input type="hidden"
                   name="asignacion_id"
                   value="{{ $asignacion->id }}">


            {{-- DETALLE --}}

            <div class="campo-asistencia">

                <label
                    for="servicio"
                    class="label-evaluacion">

                    <i class="fas fa-tools"></i>

                    Breve detalle de la asistencia técnica

                </label>


                <textarea
                    name="servicio"
                    id="servicio"
                    class="textarea-evaluacion"
                    placeholder="Describa brevemente el trabajo realizado..."
                    required></textarea>


                <small class="ayuda-texto">

                    Indique brevemente qué trabajo fue realizado.

                </small>

            </div>


            {{-- PUNTUACIÓN --}}

            <div class="seccion-puntuacion">


                <h4 class="titulo-puntuacion">

                    <i class="fas fa-comment-alt"></i>

                    ¿Cómo califica la atención recibida?

                </h4>


                <p class="subtitulo-puntuacion">

                    Seleccione una de las siguientes opciones

                </p>


                <div class="emojis">


                    {{-- MUY MALO --}}

                    <input
                        type="radio"
                        name="puntuacion"
                        id="emoji1"
                        value="1"
                        required>

                    <label
                        for="emoji1"
                        class="emoji-card">

                        <span>😡</span>

                        <strong>
                            Muy malo
                        </strong>

                    </label>


                    {{-- MALO --}}

                    <input
                        type="radio"
                        name="puntuacion"
                        id="emoji2"
                        value="2">

                    <label
                        for="emoji2"
                        class="emoji-card">

                        <span>😞</span>

                        <strong>
                            Malo
                        </strong>

                    </label>


                    {{-- REGULAR --}}

                    <input
                        type="radio"
                        name="puntuacion"
                        id="emoji3"
                        value="3">

                    <label
                        for="emoji3"
                        class="emoji-card">

                        <span>😐</span>

                        <strong>
                            Regular
                        </strong>

                    </label>


                    {{-- BUENO --}}

                    <input
                        type="radio"
                        name="puntuacion"
                        id="emoji4"
                        value="4">

                    <label
                        for="emoji4"
                        class="emoji-card">

                        <span>🙂</span>

                        <strong>
                            Bueno
                        </strong>

                    </label>


                    {{-- EXCELENTE --}}

                    <input
                        type="radio"
                        name="puntuacion"
                        id="emoji5"
                        value="5">

                    <label
                        for="emoji5"
                        class="emoji-card">

                        <span>😄</span>

                        <strong>
                            Excelente
                        </strong>

                    </label>


                </div>


                {{-- MENSAJE DINÁMICO --}}

                <div id="mensajePuntuacion"
                     class="mensaje-puntuacion">

                    <i class="fas fa-hand-pointer"></i>

                    Seleccione una carita para evaluar la atención

                </div>


            </div>


            {{-- BOTONES --}}

            <div class="acciones">


                <a href="{{ url('/') }}"
                   class="btn-cancelar">

                    <i class="fas fa-arrow-left"></i>

                    Regresar

                </a>


                <button
                    type="submit"
                    class="btn-confirmar">

                    <i class="fas fa-check-circle"></i>

                    Confirmar evaluación

                </button>


            </div>


        </form>


    </div>

</div>


<script>

document.querySelectorAll(
    'input[name="puntuacion"]'
).forEach(function(input) {

    input.addEventListener('change', function() {

        const mensaje =
            document.getElementById(
                'mensajePuntuacion'
            );

        const mensajes = {

            1: 'Ha seleccionado: Muy malo 😡',

            2: 'Ha seleccionado: Malo 😞',

            3: 'Ha seleccionado: Regular 😐',

            4: 'Ha seleccionado: Bueno 🙂',

            5: 'Ha seleccionado: Excelente 😄'

        };

        mensaje.innerHTML =
            '<i class="fas fa-check-circle"></i> '
            + mensajes[this.value];

    });

});

</script>


</body>

</html>