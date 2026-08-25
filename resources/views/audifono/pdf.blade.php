
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <table class="table1">
        <tr>
            <td colspan="2">
                <div class="imagen-titulo">
                    <img src="{{ public_path('img1/elalto.jpg') }}" >
                </div>
            </td>
            <td colspan="5" class="p">
                <p>UNIDAD DE ADMINISTRACIÓN </p>
                <p>DE SISTEMAS DE INFORMACIÓN</p>
                <p>FORMULARIO DE RECEPCIÓN DE EQUIPOS</p>
            </td>
            <td colspan="2">
                <div class="imagen-titulo">
                    <img src="{{ public_path('img1/sello1.jpg') }}" >
                </div>
            </td>
        </tr>
    </table> 
    <table class="table"> 
        <tr class="fila-dividida4">
            <td>                
                <strong>DATOS DEL SOLICITANTE</strong>           
            </td>
        </tr>
        <tr class="fila-dividida2">
            <td >                 
                <strong>NOMBRE :</strong>
                {{$audifono->funcionario?->nombre}} {{$audifono->funcionario?->paterno}} {{$audifono->funcionario?->materno}}
            </td> 
            <td >
                <strong>C.I. :</strong>
                {{ $audifono->funcionario?->ci}} {{ $audifono->funcionario?->expedido}}
            </td>
        </tr>
        @if($audifono->funcionario_activo == 1)
        <tr class="fila-dividida2">
            <td>               
                <strong>CELULAR :</strong>
                {{ $audifono->funcionario->celular }}
            </td>
            <td>               
                <strong>CORREO ELECTRÓNICO :</strong>
                {{ $audifono->funcionario->email }}
            </td>
        </tr>
        <tr class="fila-dividida2">
            <td>
                <strong>CARGO:</strong>
                {{ $audifono->cargo }}
            </td>
            <td>
                <strong>FECHA DE RECEPCIÓN:</strong>
                @if($audifono->fecha)
                {{ date('d-m-Y H:i',strtotime($audifono?->fecha))}}
                @elseif(! $audifono->fecha)	
                {{ $audifono->fecha ?? ''}}
                @endif	
            </td>
        </tr>
        <tr class="fila-dividida2">
            <td >
            <strong>DEPENDENCIA:</strong>
            {{ $audifono->Dependencia?->dependencias }}
            </td>
            <td >
            <strong>NÚMERO DE RECEPCIÓN:</strong>
            {{ $audifono->cod_registro }}
            </td>
        </tr>
        @else
        <tr class="fila-dividida2">
            <td>
                <strong>CELULAR :</strong>
                {{ $audifono->funcionario->celular }}
            </td>
            <td>
                <strong>FECHA DE RECEPCIÓN:</strong>
                @if($audifono->fecha)
                {{ date('d-m-Y H:i',strtotime($audifono?->fecha))}}
                @elseif(! $audifono->fecha)	
                {{ $audifono->fecha ?? ''}}
                @endif	
            </td>
        </tr>
        @endif

        <tr class="fila-dividida4" >
        <td>
            <strong>DATOS DEL AUDIFONO</strong>                
        </td>
        </tr>
        <tr class="fila-dividida5">
            <td >
                <strong>COD. GAMEA:</strong>
                    {{ $audifono->cod_gamea }}
            </td> 
        </tr>
        <tr class="fila-dividida2">
            <td >
                <strong>MARCA:</strong>
                    {{ $audifono->marca }}
            </td> 
            <td >                        
                <strong>MODELO:</strong>
                {{ $audifono->modelo }}
            </td>
            
        </tr>
        <tr class="fila-dividida5">
            <td>
                <strong>FALLA:</strong> 
                {{ $audifono->falla }} 
            </td> 
        </tr>
        <tr class="fila-dividida5">
            <td>                     
                <strong>OBSERVACIONES: </strong>  
                {{ $audifono->observaciones ?? 'SIN OBSERVACIONES'}}
            </td>
            
        </tr>
    </table>

</body>

</html>
<style>

/* TABLAS */
@page {
    margin: 25px;
    font-family: DejaVu Sans, Arial, sans-serif;
}

body {
    font-size: 11px;
    color: #1f2937;
}

/* TABLA PRINCIPAL (TARJETA) */
.table {
    width: 100%;
    table-layout: fixed;
    border-collapse: collapse;
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 10px;
    font-family: DejaVu Sans, Arial, sans-serif;

}

/* SECCIONES (ENCABEZADOS) */
.fila-dividida4 td {
    width: 0%;
    border: 1px solid #e5e7eb;

    text-align: center;
    table-layout: fixed;
}

/* CAMPOS DOBLES (INPUTS VISUALES) */
.fila-dividida2 td {
    width: 50%;
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    padding: 15px;
    vertical-align: top;
}
.fila-dividida3 td {
    width: 33.3%;
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    padding: 15px;
    vertical-align: top;
}

/* CAMPOS GRANDES (TEXTAREA VISUAL) */
.fila-dividida5 td {
    width: 100%;
    background: #ffffff;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    padding: 10px;
    min-height: 60px;
}

/* ETIQUETAS */
.fila-dividida2 strong,
.fila-dividida5 strong {
    display: block;
    font-size: 9px;
    color: #6b7280;
    margin-bottom: 4px;
    text-transform: uppercase;
}

/* HEADER SUPERIOR */
.table1 {
    width: 100%;
    margin-bottom: 18px;
}

.p {
    text-align: center;
    font-size: 14px;
    font-weight: 700;
    color: #2f80ed;
    line-height: 1;
}

/* IMÁGENES */
.imagen-titulo {
    text-align: center;
}

.imagen-titulo img {
    width: 90px;
    height: auto;
}
</style>