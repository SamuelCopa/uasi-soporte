<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Evaluar atención técnica</title>

    {{-- Font Awesome --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 20px;

            font-family: Arial, Helvetica, sans-serif;

            background:
                linear-gradient(
                    135deg,
                    #0052cc 0%,
                    #2684ff 100%
                );
        }


        /* CONTENEDOR PRINCIPAL */

        .container {

            width: 100%;
            max-width: 500px;

            background: #ffffff;

            border-radius: 22px;

            padding: 40px 35px;

            box-shadow:
                0 20px 50px
                rgba(0, 0, 0, 0.25);

            text-align: center;
        }


        /* ICONO */

        .icono-evaluacion {

            width: 85px;
            height: 85px;

            margin: 0 auto 20px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: #e8f1ff;

            color: #0052cc;

            font-size: 38px;

            box-shadow:
                0 8px 20px
                rgba(0, 82, 204, 0.15);
        }


        /* TITULO */

        h2 {

            margin: 0 0 12px;

            color: #263238;

            font-size: 28px;

            font-weight: 700;
        }


        /* DESCRIPCIÓN */

        .descripcion {

            margin: 0 auto 30px;

            max-width: 390px;

            color: #6c757d;

            font-size: 15px;

            line-height: 1.6;
        }


        /* FORMULARIO */

        form {

            text-align: left;
        }


        /* LABEL */

        label {

            display: block;

            margin-bottom: 8px;

            color: #263238;

            font-size: 14px;

            font-weight: 700;
        }


        label i {

            color: #0052cc;

            margin-right: 5px;
        }


        /* INPUT */

        .form-control {

            width: 100%;

            height: 50px;

            padding: 0 15px;

            border: 1px solid #d9e0e7;

            border-radius: 10px;

            background: #f9fafc;

            color: #263238;

            font-size: 15px;

            transition: all .2s ease;
        }


        .form-control::placeholder {

            color: #9aa4af;
        }


        .form-control:focus {

            outline: none;

            background: #ffffff;

            border-color: #2684ff;

            box-shadow:
                0 0 0 3px
                rgba(38, 132, 255, 0.12);
        }


        /* BOTÓN */

        .btn-primary {

            width: 100%;

            height: 50px;

            margin-top: 20px;

            border: none;

            border-radius: 10px;

            background:
                linear-gradient(
                    135deg,
                    #0052cc,
                    #2684ff
                );

            color: #ffffff;

            font-size: 15px;

            font-weight: 700;

            cursor: pointer;

            transition: all .25s ease;

            box-shadow:
                0 6px 15px
                rgba(0, 82, 204, 0.20);
        }


        .btn-primary i {

            margin-right: 7px;
        }


        .btn-primary:hover {

            transform: translateY(-2px);

            box-shadow:
                0 9px 20px
                rgba(0, 82, 204, 0.30);
        }


        .btn-primary:active {

            transform: translateY(0);
        }


        /* INFORMACIÓN */

        .informacion {

            margin-top: 25px;

            padding: 13px 15px;

            border-radius: 10px;

            background: #f5f8fc;

            border: 1px solid #e5eaf0;

            color: #7b8794;

            font-size: 12px;

            line-height: 1.5;

            text-align: center;
        }


        .informacion i {

            color: #0052cc;

            margin-right: 5px;
        }


        /* PIE */

        .footer {

            margin-top: 25px;

            padding-top: 20px;

            border-top: 1px solid #eeeeee;

            color: #8a959f;

            font-size: 12px;

            line-height: 1.5;
        }


        .footer strong {

            color: #59636e;
        }


        /* RESPONSIVE */

        @media (max-width: 600px) {

            body {

                padding: 15px;
            }

            .container {

                padding: 32px 22px;

                border-radius: 18px;
            }

            h2 {

                font-size: 23px;
            }

            .icono-evaluacion {

                width: 70px;
                height: 70px;

                font-size: 30px;
            }

        }

    </style>
    <style>

body {
    margin: 0;
    min-height: 100vh;

    background:
        linear-gradient(
            rgba(5, 75, 76, 0.85),
            rgba(75, 75, 76, 0.85)
        ),
        url("{{ asset('assets/assets/img/jachauta.jpg') }}");

    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
}

</style>

</head>


<body>


<div class="container">


    {{-- ICONO --}}

    <div class="icono-evaluacion">

        <i class="fas fa-star"></i>

    </div>


    {{-- TITULO --}}

    <h2>

        Evaluar atención técnica

    </h2>


    {{-- DESCRIPCIÓN --}}

    <p class="descripcion">

        Para consultar sus solicitudes pendientes de evaluación,
        ingrese su número de documento.

    </p>


    {{-- FORMULARIO --}}

    <form action="{{ route('evaluacion.mostrar') }}"
          method="POST">

        @csrf


        {{-- CI --}}

        <label for="ci">

            <i class="fas fa-id-card"></i>

            Número de documento

        </label>


        <input
            type="text"
            name="ci"
            id="ci"
            class="form-control"
            placeholder="Ingrese su número de documento"
            autocomplete="off"
            required>


        {{-- BOTÓN --}}

        <button
            type="submit"
            class="btn-primary">

            <i class="fas fa-search"></i>

            Buscar solicitud

        </button>
        <button
            type="button"
            class="btn-primary"
            onclick="window.location.href='{{ url('/') }}'">

            <i class="fas fa-arrow-left"></i>

            Regresar
        </button>

    </form>


    {{-- INFORMACIÓN --}}

    <div class="informacion">

        <i class="fas fa-info-circle"></i>

        Ingrese el número de documento utilizado
        al momento de registrar su solicitud de asistencia técnica.

    </div>


    {{-- FOOTER --}}

    <div class="footer">

        <strong>
            Gobierno Autónomo Municipal de El Alto
        </strong>

        <br>

        Unidad de Administración de Sistemas de Información

    </div>


</div>


</body>

</html>