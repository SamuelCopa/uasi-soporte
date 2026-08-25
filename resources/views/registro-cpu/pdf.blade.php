

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Doc. {{ $registroCpu->cod_gamea }}</title>
    <link rel="stylesheet" href="{{ public_path('estilos/pdf.css') }}">  
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
        <tr class="fila-dividida" >
            <td>                 
                <strong>NOMBRE:</strong>
                    {{ $registroCpu->funcionario->nombre }} {{ $registroCpu->funcionario->paterno }} {{ $registroCpu->funcionario->materno }}
            </td> 
         
            <td>
                <strong>C.I.:</strong>
                {{ $registroCpu->funcionario->ci }} {{ $registroCpu->funcionario->expedido }}
            </td>
         
        </tr>
        @if($registroCpu->funcionario_activo == 1)
        <tr class="fila-dividida2">
            <td>               
                <strong>CELULAR :</strong>
                {{ $registroCpu->funcionario->celular }}
            </td>
            <td>               
                <strong>CORREO ELECTRÓNICO :</strong>
                {{ $registroCpu->funcionario->email }}
            </td>
        </tr>
        <tr class="fila-dividida2">
            <td>
                <strong>CARGO:</strong>
                {{ $registroCpu->cargo }}
            </td>
            <td>
                <strong>FECHA DE RECEPCIÓN:</strong>
                @if($registroCpu->fecha)
                {{ date('d-m-Y H:i',strtotime($registroCpu?->fecha))}}
                @elseif(! $registroCpu->fecha)	
                {{ $registroCpu->fecha ?? ''}}
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
        <tr class="fila-dividida">
            <td>
                <strong>CELULAR :</strong>
                {{ $registroCpu->funcionario->celular }}
            </td>
            <td>
                <strong>FECHA DE RECEPCIÓN:</strong>
                @if($registroCpu->fecha)
                {{ date('d-m-Y H:i',strtotime($registroCpu?->fecha))}}
                @elseif(! $registroCpu->fecha)	
                {{ $registroCpu->fecha ?? ''}}
                @endif	
            </td>
        </tr>
        @endif
        <tr class="fila-dividida4">
        <td>
            <strong>DATOS DEL CPU</strong>                
        </td>
        </tr>
    
        <tr class="fila-dividida">
            <td>
                <strong>USUARIO:</strong>
                    {{ $registroCpu->usuario ?? '--------------' }}
            </td> 
            <td>                        
                <strong>CONTRASEÑA:</strong>
                {{ $registroCpu->contrasena ?? '--------------' }}
            </td>
           
        </tr>

        <tr class="fila-dividida5">
            <td>
                <strong>COD. GAMEA:</strong>
                    {{ $registroCpu->cod_gamea }}
            </td> 
        </tr>
        <tr class=" fila-dividida2">
            <td class="celda35">
                <strong>PIEZAS:</strong>
            </td> 
            <td class="celda65">                        
                <strong>DESCRIPCION :</strong>   
            </td>
           
        </tr>

        <tr class="fila-dividida1">
            <td class="celda35">
                <strong>CASE:</strong>                        
            </td> 
        
            <td class="celda65">                        
                {{ $registroCpu->Marcacase?->marca}} {{ $registroCpu->colorcase?->color }}
            </td> 
           

        </tr>
        <tr class="fila-dividida1">
            <td class="celda35">
                <strong>PROCESADOR:</strong>
            </td> 
            <td class="celda65">                        
                {{ $registroCpu->Marcaprocesador?->marca}}   {{ $registroCpu->Modeloprocesador?->modelo }}  {{ $registroCpu->Genprocesador?->generacion}}
            </td>
            
        </tr>
        <tr class="fila-dividida1">
            <td class="celda35">
                <strong>TARJETA MADRE :</strong>  
            </td> 
            <td class="celda65">                        
                {{ $registroCpu->Marcatmadre?->marca}}  {{ $registroCpu->ModeloTmadre?->modelo }} 
            </td> 
            
        </tr>
        <tr class="fila-dividida1">
            <td class="celda35">
                <strong>DISCO DURO :</strong>  
            </td> 
            <td class="celda65">                        
                {{ $registroCpu->Marcadisco?->marca }} {{ $registroCpu->CapacidadDisco?->capacidad }}  {{ $registroCpu->TipoDisco?->tipo }}  
            </td> 
        </tr>
        <tr class="fila-dividida1">
            <td class="celda35">
                <strong>MEMORIA RAM :</strong>    
            </td> 
            <td class="celda65">
                @if($registroCpu->DisipadorRam && $registroCpu->DisipadorRam->opcion)
                DISIPADOR {{ $registroCpu->DisipadorRam?->opcion }}, {{ $registroCpu->MarcaRam?->marca }}  {{ $registroCpu->TipoRam?->tipo }} {{ $registroCpu->CapacidadRam?->capacidad }} {{ $registroCpu->CantidadRam?->cantidad }}
                @endif
                @if($registroCpu->DisipadorRam2 && $registroCpu->DisipadorRam2->opcion)
                /DISIPADOR {{ $registroCpu->DisipadorRam2?->opcion }}, {{ $registroCpu->MarcaRam2?->marca }}  {{ $registroCpu->TipoRam2?->tipo }} {{ $registroCpu->CapacidadRam2?->capacidad }} {{ $registroCpu->CantidadRam2?->cantidad }}
                @endif
                @if($registroCpu->DisipadorRam3 && $registroCpu->DisipadorRam3->opcion)
                /DISIPADOR {{ $registroCpu->DisipadorRam3?->opcion }}, {{ $registroCpu->MarcaRam3?->marca }}  {{ $registroCpu->TipoRam3?->tipo }} {{ $registroCpu->CapacidadRam3?->capacidad }} {{ $registroCpu->CantidadRam3?->cantidad }}
                @endif
                @if($registroCpu->DisipadorRam4 && $registroCpu->DisipadorRam4->opcion)
                /DISIPADOR {{ $registroCpu->DisipadorRam4?->opcion }}, {{ $registroCpu->MarcaRam4?->marca }}  {{ $registroCpu->TipoRam4?->tipo }} {{ $registroCpu->CapacidadRam4?->capacidad }} {{ $registroCpu->CantidadRam4?->cantidad }}
                @endif                        
            </td>
        </tr>
        <tr class="fila-dividida1">
            <td class="celda35">
                <strong>TARJETA DE VIDEO :</strong> 
            </td> 
            <td class="celda65">                        
                {{ $registroCpu->MarcaTvideo->marca ?? 'INTEGRADO' }} {{ $registroCpu->CapacidadTvideo?->capacidad }} {{ $registroCpu->TipoTvideo?->tipo }}
            </td>
        </tr>
        <tr class="fila-dividida1">
            <td class="celda35">
                <strong>TARJETA DE RED :</strong>  
            </td> 
            <td class="celda65">                        
                {{ $registroCpu->MarcaTred->marca ?? 'NINGUNA' }}  {{ $registroCpu->ModeloTred?->modelo }}
            </td>
        </tr>
        <tr class="fila-dividida1">
            <td class="celda35">
                <strong>TARJETA WI-FI :</strong> 
            </td> 
            <td class="celda65">                        
                {{ $registroCpu->MarcaTwifi->marca ?? 'NINGUNA' }} {{ $registroCpu->modeloWifi?->modelo }} 
            </td>
        </tr>

        <tr class="fila-dividida1">
            <td class="celda35">
                <strong>FUENTE:</strong> 
            </td> 
            <td class="celda65">                        
                {{ $registroCpu->MarcaFuente?->marca }}  {{ $registroCpu->PotenciaFuente?->potencia }}
            </td>
            
        </tr>

        <tr class="fila-dividida1">
            <td class="celda35"> 
                <strong>LECTOR CD :</strong> 
            </td> 
            <td class="celda65">                        
                {{ $registroCpu->MarcaLectorcd->nombre ?? 'NO' }}
            </td>
        </tr>

        <tr class="fila-dividida">
            <td>
                <strong>TIPO DE FALLA:</strong> 
                {{ $registroCpu->falla }}

            </td> 
            <td >                     
                <strong>REQUIERE RESPALDO:</strong>  
                {{ $registroCpu->respaldo }}
            </td>
           
        </tr>
        <tr class="fila-dividida">
            <td>                     
                <strong>OTROS: </strong>  
                {{ $registroCpu->otro ?? '-------------'}}
            </td>
            <td>                     
                <strong>OBSERVACIONES: </strong>  
                {{ $registroCpu->observaciones ?? 'SIN OBSERVACIONES'}}
            </td>
            
        </tr>

    </table>
    <h5>El usuario acepta y garantiza que los datos proporcionados en el formulario son precisos, auténticos y verificables.</h5>

</body>
</html>
<style>
@page {
    margin: 25px;
    font-family: DejaVu Sans, Arial, sans-serif;
}

body {
    font-size: 10px;
    color: #1f2937;
}

/* TABLA PRINCIPAL */
.table {
    width: 100%;
    table-layout: fixed;
    border-collapse: collapse;
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 2px;
    font-family: DejaVu Sans, Arial, sans-serif;

}

/* TABLA HEADER */
.table1 {
    width: 100%;
    margin-bottom: 18px;
}

/* TÍTULO */
.p {
    text-align: center;
    font-size: 14px;
    color: #2f80ed;
    font-weight: 700;
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

/* FILAS DOBLES (CAMPOS) */
.fila-dividida td,
 {
    width: 50%;
    background: #ffffff;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    padding: 8px 10px;
    vertical-align: top;
}

.fila-dividida1 td {
    background: #ffffff;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    padding: 8px 10px;
    vertical-align: top;
}

/* FILAS CENTRADAS */
.fila-dividida2 td {
    background: #f9fafb;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    padding: 10px;
    text-align: top;
}

/* TÍTULOS DE SECCIÓN */
.fila-dividida4 td {
    width: 0%;
    border: 1px solid #e5e7eb;
    text-align: center;
    table-layout: fixed;
    font-size: 14px;
}

/* CAMPOS GRANDES */
.fila-dividida5 td {
    background: #ffffff;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    padding: 10px;
    min-height: 60px;
}

/* TEXTO */
strong {
    display: block;
    font-size: 10px;
    color: #6b7280;
    margin-bottom: 4px;
    text-transform: uppercase;
}

/* CELDAS PERSONALIZADAS */
.celda35 { width: 35%; }
.celda65 { width: 65%; }

.tr {
    border-collapse: separate;
}
</style>