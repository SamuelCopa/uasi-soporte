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

    <link rel="stylesheet" href="{{ asset('estilos/evaluacion.css') }}">  

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

            @if($asignacion->falla)

                <div class="dato">

                    <span class="dato-titulo">

                        <i class="fas fa-exclamation-triangle"></i>

                        Falla reportada

                    </span>

                    <span class="dato-valor">

                        {{ $asignacion->falla }}

                    </span>

                </div>

            @endif


        </div>


        {{-- FORMULARIO --}}

        <form action="{{ route('evaluacion.guardar') }}"
              method="POST">
            @csrf
            {{-- ID DE LA ASIGNACIÓN --}}
            <input type="hidden" name="asignacion_id" value="{{ $asignacion->id }}">

            {{-- DETALLE --}}

            <div class="campo-asistencia">
                <label for="servicio" class="label-evaluacion">
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