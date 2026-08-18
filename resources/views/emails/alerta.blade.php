<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Alerta de Mantenimiento</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">

    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">

                <!-- CONTENEDOR -->
                <table width="600" cellpadding="20" cellspacing="0" style="background-color: #ffffff; border-radius: 8px;">

                    <!-- HEADER -->
                    <tr>
                        <td style="background-color: #0d6efd; color: white; text-align: center; border-radius: 8px 8px 0 0;">
                            <h2 style="margin: 0;">🔧 GAMEA - SOPORTE TÉCNICO</h2>
                        </td>
                    </tr>

                    <!-- CONTENIDO -->
                    <tr>
                        <td>
                            @switch($estadoId)
                                @case(2)
                                    <p style="font-family: Arial; font-size: 14px;">⚙️ <strong>*EN PROCESO*</strong><br>
                                        El mantenimiento de su equipo se encuentra en proceso.</p>
                                    @break
                                @case(3)
                                    <p style="font-family: Arial; font-size: 14px;">📍 <strong>*APERSONARSE CON EL TÉCNICO*</strong><br>
                                        Se solicita su presencia en la oficina a la brevedad posible.</p>
                                    @break

                                @case(4)
                                    <p style="font-family: Arial; font-size: 14px;">✅ <strong>*CONCLUIDO*</strong><br>
                                        El mantenimiento ha finalizado. Puede pasar a recoger su equipo por secretaría.</p>
                                    @break
                                @default
                                    <p>El estado de su equipo ha sido actualizado.</p>
                            @endswitch
                            @if($equipo)
                            <ul>
                                <li>
                                <p style="font-size: 14px;">
                                    🖥️ <strong>Tipo de equipo: </strong>
                                    {{ method_exists($equipo, 'getTipoEquipo') ? $equipo->getTipoEquipo() : 'Equipo' }}
                                </p>
                                </li>
                                <li>
                                <p style="font-size: 14px;">
                                    📄 <strong>Codigo GAMEA:</strong>
                                    {{ $equipo->cod_gamea ?? 'N/A' }}
                                </p>
                                </li>
                                <li>
                                <p style="font-size: 14px;">
                                    📄 <strong>Número de recepción: </strong>
                                    {{ $equipo->cod_registro ?? 'N/A' }}
                                </p>
                                </li>
                                <li>
                                <p style="font-size: 14px;">
                                    🔧 <strong>Técnico a cargo: </strong>
                                    {{ $equipo->user->name ?? 'N/A' }} {{ $equipo->user->paterno ?? 'N/A' }} {{ $equipo->user->materno ?? 'N/A' }}
                                </p>
                                </li>
                            </ul>
                            @endif
                            <ul>
                                <li>
                                    <p style="font-size: 14px;">
                                        📍 <strong>Seguimiento:</strong>
                                        <a href="{{ config('app.url') }}">
                                            {{ config('app.url') }}
                                        </a>
                                    </p>
                                </li>
                            </ul>
                            <p style="font-size: 13px;">
                                No responda a este correo electrónico.
                            </p>
                        </td>
                    </tr>
                    <!-- FOOTER -->
                    <tr>
                        <td style="background-color: #f1f1f1; text-align: center; font-size: 12px; color: #777; border-radius: 0 0 8px 8px;">
                            GAMEA<br>
                            Unidad de Administración de Sistemas de Información<br>
                            {{ date('Y') }} © S@mmy
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>