<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Alerta de Asignación</title>
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
                            <h2>Asignación de equipo</h2>
                            <p style="font-size: 14px;">Se ha realizado una nueva asignación:</p>
                            <ul>
                                <li>
                                    <p style="font-size: 14px;">
                                    🖥️ <strong>Tipo de equipo: </strong>
                                        {{ method_exists($equipo, 'getTipoEquipo') ? $equipo->getTipoEquipo() : 'Equipo' }}
                                    </p>
                                </li>
                                <li>
                                    <p style="font-size: 14px;">
                                    📄 <strong>Codigo GAMEA: </strong> {{ $equipo->cod_gamea }}
                                    </p>
                                </li>
                                <li>
                                    <p style="font-size: 14px;">
                                    📅 <strong>Fecha: </strong> {{ date('d-m-Y H:i',strtotime($equipo->fecha_asignacion)) }}
                                    </p>
                                </li>
                            </ul>
                            <p>Por favor, proceda con la revisión correspondiente.</p>
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