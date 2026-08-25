<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seguimiento</title>

    <link rel="icon" href="{{ asset('assets/assets/logogamea.ico') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="min-h-screen bg-cover bg-center flex items-center justify-center"
      style="background-image: url('{{ asset('assets/assets/img/jachauta.jpg') }}')">

@foreach ($resultados as $codigo)

<div class="bg-black/70 backdrop-blur-md w-full max-w-5xl rounded-2xl shadow-2xl p-6 md:p-10 text-white">

    <!-- HEADER -->
    <div class="text-center mb-6">
        <h1 class="text-2xl md:text-3xl font-bold">Sistema de Mantenimiento</h1>
        <p class="text-gray-300 text-sm">Seguimiento de Equipos</p>
    </div>

    <!-- IMAGEN -->
  

    <!-- NUMERO -->
    <div class="text-center mb-6">
        <p class="text-sm text-gray-300">NÚMERO DE RECEPCIÓN</p>
        <h2 class="text-2xl md:text-3xl font-bold tracking-wider">
            {{ $codigo->cod_registro }}
        </h2>
    </div>

    <!-- DATOS SOLICITANTE -->
    <div class="mb-6">
        <h3 class="text-lg font-semibold border-b border-gray-500 mb-2">Datos del Solicitante</h3>

        <div class="grid md:grid-cols-2 gap-2 text-sm">
            <p><strong>Nombre:</strong> {{ $codigo->funcionario->nombre }} {{ $codigo->funcionario->paterno }} {{ $codigo->funcionario->materno }}</p>
            <p><strong>C.I.:</strong> {{ $codigo->funcionario->ci }} {{ $codigo->funcionario->expedido }}</p>
            <p><strong>Cargo:</strong> {{ $codigo->funcionario->cargo }}</p>
            <p><strong>Dependencia:</strong> {{ $codigo->Dependencia?->dependencias }}</p>
        </div>
    </div>

    <!-- DATOS ACTIVO -->
    <div class="mb-6">
        <h3 class="text-lg font-semibold border-b border-gray-500 mb-2">Datos del Activo</h3>

        <div class="grid md:grid-cols-2 gap-2 text-sm">
            <p><strong>Código:</strong> {{ $codigo->cod_gamea }}</p>
            <p><strong>Fecha Recepción:</strong> {{ date('d-m-Y', strtotime($codigo->fecha)) }}</p>

            <p>
                <strong>Técnico:</strong>
                {{ $codigo->User?->name ?? 'NO ASIGNADO' }} {{ $codigo->User?->paterno ?? '' }} {{ $codigo->User?->materno ?? '' }}
            </p>

            <p>
                <strong>Inicio:</strong>
                {{ $codigo->fecha_inicio ? date('d-m-Y', strtotime($codigo->fecha_inicio)) : 'EN ESPERA' }}
            </p>
        </div>
    </div>

    <!-- ESTADO -->
    <div class="text-center p-4 rounded-xl
        @switch($codigo->estado_id)
            @case(1) bg-blue-600 @break
            @case(2) bg-blue-500 @break
            @case(3) bg-red-500 @break
            @case(4) bg-green-600 @break
        @endswitch
    ">

        @switch($codigo->estado_id)

            @case(1)
                <h2 class="text-xl font-bold">RECEPCIONADO</h2>
                <p>El equipo ha sido registrado. El mantenimiento iniciará en breve.</p>
                @break

            @case(2)
                <h2 class="text-xl font-bold">RECEPCIONADO</h2>
                <p>El mantenimiento de su equipo se encuentra en proceso..</p>
                <div class="mt-2 animate-pulse">⏳ Procesando...</div>
                @break

            @case(3)
                <h2 class="text-xl font-bold">REQUERIMIENTO DE PRESENCIA</h2>
                <p>Se solicita su presencia en la oficina para la revisión correspondiente a la brevedad posible.</p>
                @break

            @case(4)
                <h2 class="text-xl font-bold">CONCLUIDO</h2>
                <p>Se finalizo el mantenimiento de su equipo, puede pasar a recoger</p>
                @break

        @endswitch
    </div>

    <!-- BOTON -->
    <div class="text-center mt-6">
        <button onclick="location.href='/'"
            class="bg-sky-500 hover:bg-sky-600 px-6 py-2 rounded-lg shadow-md transition">
            ACEPTAR
        </button>
    </div>

</div>

<!-- ALERTA -->
<script>
Swal.fire({
    icon: "{{ [1=>'info',2=>'success',3=>'warning',4=>'success'][$codigo->estado_id] }}",
    title: "{{ ['RECEPCIONADO','EN PROCESO','APERSONARSE CON EL TÉCNICO','CONCLUIDO'][$codigo->estado_id - 1] }}",
    text: "{{ [
        'El equipo ha sido registrado correctamente.',
        'El mantenimiento de su equipo se encuentra en proceso.',
        'Se solicita su presencia en la oficina para la revisión correspondiente a la brevedad posible.',
        'Se finalizo el mantenimiento de su equipo, puede pasar a recoger.',
    ][$codigo->estado_id - 1] }}",
});
</script>

@endforeach

</body>
</html>