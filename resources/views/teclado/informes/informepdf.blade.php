{{-- <!DOCTYPE html>
<html>
<head>
    <title>Impresora</title>
    <style>
        /* Estilos CSS para el PDF */
        body {
            font-family: Arial, sans-serif;
        }
    </style>
</head>
<body>
    <h1>Impresora</h1>
    <p><strong>CITE ANTECEDENTES:</strong> {{ $citeAntecedentes }}</p>
    <p><strong>FECHA DE RECEPCIÓN:</strong> {{ $fecha }}</p>
    <p><strong>REFERENCIA:</strong> {{ $referencia }}</p>
    <p><strong>CODIGO GAMEA:</strong> {{ $codGamea }}</p>
    <p><strong>CARACTERISTICAS DEL ACTIVO SEGUN SISTEMA SICAF:</strong></p>
    {!! $caractSicaf !!}
    <p><strong>CARACTERISTICAS ACTUAL:</strong></p>
    {!! $caractActual !!}
</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <div style="width: 800px; height: 1100px; padding: 50px; border: 1px solid #ccc; font-family: Arial; font-size: 11pt;align:center;">

    <table class="table1">
        <tr>
            <td>
                <div class="imagen-titulo">
                    <img src="{{ public_path('img1/elalto.jpg') }}" >
                </div>
            </td>
            <td colspan="3" class="p">
                <div>
                    <p>GOBIERNO AUTONOMO MUNICIPAL DE EL ALTO</p>
                </div>
            </td>
            <td>
                <div class="imagen-titulo1 td">
                    <img src="{{ public_path('img1/logo-gamea.jpg') }}" >
                </div>
            </td>
        </tr>
    </table> 
    <div class="hr-container">
    <hr class="hr">
    <hr class="hr2">
    </div>
    <table class="table"> 
        <tr class="fila-dividida4">
            <td>                
                <strong>INFORME</strong>
                <p>CITE: SMAF/DA/UASI/{{ strtoupper($cite) }}/{{date('Y');}}</p>            
            </td>
        </tr>
    </table>
    
    <table class="table1" >
        <tr valign="top">
            <td class="td1 celda35 pinf" >
                <p>A:</p>
            </td>
            <td class="pinf celda65">
                <p>{{ $aquien }}</p>
                <p>{{ strtoupper($cargo1) }}</p>
                <p>GOBIERNO AUTONOMO MUNICIPAL DE EL ALTO</p>
            </td>
        </tr>
        <tr>
            <td class="td1 celda35 pinf">
                <p>VIA:</p>
            </td>
            <td class="pinf celda65">
                <p>{{ $aquien }}</p>
                <p>{{ strtoupper($cargo1) }}</p>
                <p>UNIDAD DE ADMINISTRACIÓN DE SISTEMAS DE INFORMACIÓN</p>
                <p>GOBIERNO AUTONOMO MUNICIPAL DE EL ALTO</p>
            </td>
        </tr>
        <tr>
            <td class="td1 celda35 pinf">
                <p>VIA:</p>
            </td>
            <td class="pinf celda65">
                <p>{{ $aquien }}</p>
                <p>{{ strtoupper($cargo1) }}</p>
                <p>UNIDAD DE ADMINISTRACIÓN DE SISTEMAS DE INFORMACIÓN</p>
                <p>GOBIERNO AUTONOMO MUNICIPAL DE EL ALTO</p>
            </td>
        </tr>
        <tr>
            <td class="td1 celda35 pinf">
                <p>DE:</p>
            </td>
            <td class="pinf celda65">
                <p>{{ $user }}</p>
                <p>TÉCNICO EN SOPORTE</p>
                <p>UNIDAD DE ADMINISTRACIÓN DE SISTEMAS DE INFORMACIÓN</p>
                <p>GOBIERNO AUTONOMO MUNICIPAL DE EL ALTO</p>
            </td>
        </tr>
        <tr>
            <td class="td1 celda35 pinf">
                <p>REFERENCIA:</p>
            </td>
            <td class="pinf celda65">
                <p>INFORME TÉCNICO</p>
            </td>
        </tr>
        <tr>
            <td class="td1 celda35 pinf">
                <p>FECHA:</p>
            </td>
            <td class="pinf celda65">
                <p>El Alto, {{  date('d \d\e F \d\e Y', strtotime($fecha_actual));}}</p>
            </td>
        </tr>
    </table>
    <hr class="hr3">

    <table class="table1" >
        <tr>
            <td class="" >
                <strong>I. ANTECEDENTES.</strong>
                <p class="">En atención a la nota con CITE: {{ $citeAntecedentes }} con Ref.: {{ $referencia }}, que llego a nuestra unidad, por lo que me remito a informar lo siguiente.
                </p>
                <strong>II. DESARROLLO.</strong>
                <p class="">
                Se procedió a la revisión técnica en general del equipo, el cual se detalla en la siguiente tabla comparativa.
                Se tiene el siguiente diagnóstico:
                </p>
            </td>
        </tr>
    </table>
        <table class="table1" border="1">
        <tr>
            <td class="" >
                <p>IMPRESORA</p>
                <p>{{ $codGamea }}</p>
            </td>
            <td class="" >
                <p>IMPRESORA</p>
                <p> {!! $caractActual !!}</p>
            </td>
            <td class="" >
                <p>IMPRESORA</p>
                <p>{{ $codGamea }}</p>
            </td>
            <td class="" >
                <p>IMPRESORA</p>
                <p>{{ $codGamea }}</p>
            </td>
        </tr>
    </table>
    </div>
</body>
</html>
<style>     

.table {
        font-family:'Times New Roman', Times, serif;
        font-size: 9pt;
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
        font-family:'Times New Roman', Times, serif;
        font-size: 9pt;
        padding-bottom: 3px;
                page-break-before: avoid;
        page-break-after: avoid;
    color:#f70330;

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
    font-size: 16px;
    color: #707375;
    line-height: 0.8; /* reducir el interlineado */
    font-weight: bold; /* negrillas */
    /* font-style: italic; */
  }

.pl {
        line-height: 1.5; /* establece el interlineado */
  }

.pinf {
    line-height: 0.5; /* reducir el interlineado */
  }

.palt {
    line-height: 0.5; /* reducir el interlineado */
  }

  .hr-container {
    display: flex;
}
.hr-item {
    width: 50%;
    margin: 0;
    border: 1px solid #ccc;
}


.hr {
    color: #c40f0f;
    line-height: 0.6; /* reducir el interlineado */

  }
.hr2 {
    color: #04691f;
    line-height: 0.6; /* reducir el interlineado */
  }
  
  .imagen-titulo img {
    width: 50px;
    height: 50px;
    margin-right: 80px;
  }

  
.imagen-titulo1 {
    display: flex;
    justify-content: flex-end;
}

.imagen-titulo1 img {
    width: 50px;
    height: 50px;
}
.td {
    text-align: right;
}
.td1 {
    text-align: right;
}

.imagen-titulo1 img {
    width: 50px;
    height: 50px;
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
    line-height: 0.8; /* reducir el interlineado */
    font-size: 10px;
    padding-top:5px;
    padding-bottom: 3px;
    text-align: center;
}

.fila-dividida5 td {
  width: 0%;
  border: 1px solid #070000;
  padding: 5px;
  color: black;
}

.tr {
  padding: 10px;
  border: 1px solid #ccc;
  padding: 10px;

}

    .celda35 {
    width: 35%;
    }

    .celda65 {
    width: 65%;
    }
</style>