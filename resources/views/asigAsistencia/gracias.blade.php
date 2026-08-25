<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Evaluación registrada</title>

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

            padding: 20px;

            font-family: Arial, sans-serif;

            display: flex;

            align-items: center;

            justify-content: center;

            background:
                linear-gradient(
                    135deg,
                    #0052cc,
                    #2684ff
                );
        }


        .gracias-container {

            width: 100%;

            max-width: 600px;

            background: #ffffff;

            border-radius: 24px;

            padding: 45px 35px;

            text-align: center;

            box-shadow:
                0 20px 60px
                rgba(0, 0, 0, .25);
        }


        /* ICONO */

        .icono-exito {

            width: 100px;

            height: 100px;

            margin: 0 auto 25px;

            border-radius: 50%;

            display: flex;

            align-items: center;

            justify-content: center;

            background: #e8f7ef;

            color: #198754;

            font-size: 50px;

            animation: aparecer .6s ease;
        }


        @keyframes aparecer {

            from {

                transform: scale(.5);

                opacity: 0;

            }

            to {

                transform: scale(1);

                opacity: 1;

            }

        }


        h1 {

            margin-bottom: 12px;

            color: #198754;

            font-size: 28px;

            font-weight: 700;
        }


        .mensaje {

            color: #59636e;

            font-size: 16px;

            line-height: 1.6;

            margin-bottom: 25px;
        }


        /* SEPARADOR */

        .separador {

            width: 60px;

            height: 4px;

            margin: 20px auto;

            border-radius: 10px;

            background:
                linear-gradient(
                    90deg,
                    #0052cc,
                    #2684ff
                );
        }


        .agradecimiento {

            color: #263238;

            font-size: 17px;

            font-weight: 600;

            margin-bottom: 10px;
        }


        .detalle {

            color: #7b8794;

            font-size: 14px;

            margin-bottom: 30px;
        }


        /* BOTÓN */

        .btn-inicio {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 8px;

            padding: 12px 25px;

            border-radius: 10px;

            background:
                linear-gradient(
                    135deg,
                    #0052cc,
                    #2684ff
                );

            color: white;

            font-weight: 700;

            text-decoration: none;

            transition: all .2s ease;
        }


        .btn-inicio:hover {

            color: white;

            text-decoration: none;

            transform: translateY(-2px);

            box-shadow:
                0 7px 18px
                rgba(0,82,204,.25);
        }


        /* PIE */

        .pie {

            margin-top: 30px;

            padding-top: 20px;

            border-top: 1px solid #e9ecef;

            color: #7b8794;

            font-size: 12px;
        }


        .pie i {

            margin-right: 5px;

            color: #0052cc;
        }


        /* RESPONSIVE */

        @media(max-width: 500px) {

            body {

                padding: 15px;
            }


            .gracias-container {

                padding: 35px 20px;

                border-radius: 20px;
            }


            .icono-exito {

                width: 80px;

                height: 80px;

                font-size: 40px;
            }


            h1 {

                font-size: 24px;
            }


            .mensaje {

                font-size: 14px;
            }


            .btn-inicio {

                width: 100%;
            }

        }

    </style>

</head>


<body>


<div class="gracias-container">


    {{-- ICONO --}}

    <div class="icono-exito">

        <i class="fas fa-check"></i>

    </div>


    {{-- TÍTULO --}}

    <h1>

        ¡Gracias por su opinión!

    </h1>


    <div class="separador"></div>


    {{-- MENSAJE --}}

    <p class="mensaje">

        Su evaluación fue registrada
        correctamente.

    </p>


    <p class="agradecimiento">

        Su opinión es muy importante para nosotros.

    </p>


    <p class="detalle">

        La información proporcionada nos permitirá
        mejorar continuamente la calidad de la
        atención y asistencia técnica.

    </p>


    {{-- BOTÓN --}}

    <a href="{{ url('/') }}"
       class="btn-inicio">

        <i class="fas fa-home"></i>

        Volver al inicio

    </a>


    {{-- PIE --}}

    <div class="pie">

        <i class="fas fa-building"></i>

        Gobierno Autónomo Municipal de El Alto

        <br>

        Unidad de Administración de Sistemas de Información

    </div>


</div>


</body>

</html>