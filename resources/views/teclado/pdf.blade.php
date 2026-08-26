
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
                {{ $teclado->funcionario?->nombre }} {{ $teclado->funcionario?->paterno }} {{ $teclado->funcionario?->materno }}
            </td> 
            <td >
                <strong>C.I. :</strong>
                {{ $teclado->funcionario?->ci }} {{ $teclado->funcionario?->expedido }}
            </td>
        </tr>
        @if( $teclado->funcionario_activo == 1)
        <tr class="fila-dividida2">
            <td>               
                <strong>CELULAR :</strong>
                {{ $teclado->funcionario->celular }}
            </td>
            <td>               
                <strong>CORREO ELECTRÓNICO :</strong>
                {{ $teclado->funcionario->email }}
            </td>
        </tr>
        <tr class="fila-dividida2">
            <td>
                <strong>CARGO:</strong>
                {{ $teclado->cargo }}
            </td>
            <td>
                <strong>FECHA DE RECEPCIÓN:</strong>
                @if($teclado->fecha)
                {{ date('d-m-Y H:i',strtotime($teclado?->fecha))}}
                @elseif(! $teclado->fecha)	
                {{ $teclado->fecha ?? ''}}
                @endif	
            </td>
        </tr>
        <tr class="fila-dividida2">
            <td >
            <strong>DEPENDENCIA:</strong>
            {{ $teclado->Dependencia?->dependencias }}
            </td>
            <td >
            <strong>NÚMERO DE RECEPCIÓN:</strong>
            {{ $teclado->cod_registro }}
            </td>
        </tr>
        @else
        <tr class="fila-dividida2">
            <td>
                <strong>CELULAR :</strong>
                {{ $teclado->funcionario->celular }}
            </td>
            <td>
                <strong>FECHA DE RECEPCIÓN:</strong>
                @if($teclado->fecha)
                {{ date('d-m-Y H:i',strtotime($teclado?->fecha))}}
                @elseif(! $teclado->fecha)	
                {{ $teclado->fecha ?? ''}}
                @endif	
            </td>
        </tr>
        @endif
        <tr class="fila-dividida4" >
        <td>
            <strong>DATOS DEL TECLADO</strong>                
        </td>
        </tr>
        <tr class="fila-dividida5">
            <td >
                <strong>COD. GAMEA:</strong>
                    {{ $teclado->cod_gamea }}
            </td> 
        </tr>
        <tr class="fila-dividida2">
            <td >
                <strong>MARCA:</strong>
                    {{ $teclado->marca }}
            </td> 
            <td >                        
                <strong>MODELO:</strong>
                {{ $teclado->modelo }}
            </td>
            
        </tr>
        <tr class="fila-dividida5">
            <td>
                <strong>FALLA:</strong> 
                {{ $teclado->falla }} 
            </td> 
        </tr>
        <tr class="fila-dividida5">
            <td>                     
                <strong>OBSERVACIONES: </strong>  
                {{ $teclado->observaciones ?? 'SIN OBSERVACIONES'}}
            </td>
            
        </tr>
    </table>

</body>

</html>
<style>

.table {
        font-family: Arial, sans-serif;
        font-size: 12px;
        table-layout: fixed;
        width: 100%;
        page-break-before: avoid;
        page-break-after: avoid;
        margin-bottom: 100px;
        border-collapse: collapse;
        padding-top:10px;
        padding-bottom: 10px;

}
.table1 {
        font-family: Arial, sans-serif;
        font-size: 14px;
        table-layout: fixed;
        width: 100%;
        page-break-before: avoid;
        page-break-after: avoid;
        
}
.table2 {
        font-family: Arial, sans-serif;
        font-size: 14px;
        table-layout: fixed;
        width: 100%;
        page-break-before: avoid;
        page-break-after: avoid;
}

.p {
    text-align: center;
    font-size: 14px;
    color: #00698f;
    line-height: 1; /* reducir el interlineado */
    font-weight: bold; /* negrillas */
    /* font-style: italic; */

  }

  .imagen-titulo {
    display: flex;
    align-items: center;
  }
  
  .imagen-titulo img {
    width: 100px;
    height: 100px;
    margin-right: 80px;
  }
  

  .table4 {
    font-family: Arial, sans-serif;
    font-size: 11pt;
    table-layout: fixed;
    width: 100%;
    page-break-before: avoid;
    page-break-after: avoid;

}
/* PDF OTROS */
.fila-dividida2 td {
  width: 50%;
  border: 1px solid #070000;
  padding: 15px;
  /* text-align: ; */
  table-layout: fixed;

}
.fila-dividida4 td {
    width: 0%;
    border: 1px solid #070000;
    padding-top:510px;
    padding-bottom: 10px;
    padding-left: 20px;
    padding-right: 20px;
    text-align: center;
    table-layout: fixed;
}

.fila-dividida5 td {
  width: 0%;
  border: 1px solid #070000;
  padding: 5px;


  color: black;

  
}

.tr {
  padding: 10px;/* TABLAS */
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