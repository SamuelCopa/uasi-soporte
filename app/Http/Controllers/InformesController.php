<?php

namespace App\Http\Controllers;

use App\Models\Audifono;
use App\Models\CantidadRam;
use App\Models\CapacidadDisco;
use App\Models\CapacidadRam;
use App\Models\CapacidadTvideo;
use App\Models\ColorCase;
use App\Models\DisipadorRam;
use App\Models\Estabilizador;
use App\Models\Funcionario;
use App\Models\GenProcesador;
use App\Models\Impresora;
use App\Models\Laptop;
use App\Models\MarcaCase;
use App\Models\MarcaDisco;
use App\Models\MarcaFuente;
use App\Models\MarcaLectorcd;
use App\Models\MarcaProcesador;
use App\Models\MarcaRam;
use App\Models\MarcaTmadre;
use App\Models\MarcaTred;
use App\Models\MarcaTvideo;
use App\Models\MarcaTwifi;
use App\Models\ModeloProcesador;
use App\Models\ModeloTmadre;
use App\Models\ModeloTred;
use App\Models\ModeloWifi;
use App\Models\Monitor;
use App\Models\Parlante;
use App\Models\PotenciaFuente;
use App\Models\Raton;
use App\Models\RegistroCpu;
use App\Models\Responsable;
use App\Models\Resultado;
use App\Models\Teclado;
use App\Models\TipoDisco;
use App\Models\TipoRam;
use App\Models\TipoTvideo;
use App\Models\Upese;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpWord\Shared\Html;

class InformesController extends Controller
{
        public function crearInformeCpu($id)
        {
        // Obtener los datos necesarios para el informe
        $registroCpu = RegistroCpu::find($id);
        $user = Auth::user();
        $responsable = Responsable::all();
        $capdisco=CapacidadDisco::all();
        $capram=CapacidadRam::all();
        $captvideo=CapacidadTvideo::all();
        $colorcase=ColorCase::all();
        $genprocesador=GenProcesador::all();
        $marcacase=MarcaCase::all();
        $marcadisco=MarcaDisco::all();
        $marcafuente=MarcaFuente::all();
        $marcalectorcd=MarcaLectorcd::all();
        $marcaprocesador=MarcaProcesador::all();
        $marcaram=MarcaRam::all();
        $marcatmadre=MarcaTmadre::all();
        $modelotmadre=ModeloTmadre::all();
        $marcatred=MarcaTred::all();
        $marcatvideo=MarcaTvideo::all();
        $marcatwifi=MarcaTwifi::all();
        $modelowifi=ModeloWifi::all();
        $disipadorram=DisipadorRam::all();
        $modprocesador=ModeloProcesador::all();    
        $tiporam=TipoRam::all();
        $modelotred=ModeloTred::all();
        $cantidadram=CantidadRam::all();
        $potenciafuente=PotenciaFuente::all();
        $tipodisco=TipoDisco::all();
        $tipotvideo=TipoTvideo::all();
        $resultado = Resultado::all();
        $funcionario = Funcionario::all();

        return view('registro-cpu.informes.crearInforme', compact('registroCpu','user','responsable','capdisco','capram',
        'captvideo','colorcase','genprocesador','modelowifi','disipadorram','cantidadram',
        'marcacase','marcadisco','marcafuente','marcalectorcd','marcaprocesador','tiporam',
        'marcaram','marcatmadre','modelotmadre','marcatred','marcatvideo','marcatwifi',
        'modprocesador','modelotred','potenciafuente','tipodisco','tipotvideo','resultado', 'funcionario'));
    }
    public function crearInformeAudifono($id)
    {
        // Obtener los datos necesarios para el informe
        $audifono = Audifono::find($id);
        $user = Auth::user();
        $responsable = Responsable::all();
        $resultado = Resultado::all();
        $funcionario = Funcionario::all();

        return view('audifono.informes.crearInforme', compact('audifono','user','responsable', 'resultado'));
    }
    public function crearInformeImpresora($id)
    {
        // Obtener los datos necesarios para el informe
        $impresora = Impresora::find($id);
        $user = Auth::user();
        $responsable = Responsable::all();
        $resultado = Resultado::all();

        return view('impresora.informes.crearInforme', compact('impresora','user','responsable', 'resultado'));
    }
    public function crearInformeMouse($id)
    {
        // Obtener los datos necesarios para el informe
        $raton = Raton::find($id);
        $user = Auth::user();
        $responsable = Responsable::all();
        $resultado = Resultado::all();

        return view('raton.informes.crearInforme', compact('raton','user','responsable', 'resultado'));
    }
    public function crearInformeTeclado($id)
    {
        // Obtener los datos necesarios para el informe
        $teclado = Teclado::find($id);
        $user = Auth::user();
        $responsable = Responsable::all();
        $resultado = Resultado::all();

        return view('teclado.informes.crearInforme', compact('teclado','user','responsable', 'resultado'));
    }
    public function crearInformeParlante($id)
    {
        // Obtener los datos necesarios para el informe
        $parlante = Parlante::find($id);
        $user = Auth::user();
        $responsable = Responsable::all();
        $resultado = Resultado::all();

        return view('parlante.informes.crearInforme', compact('parlante','user','responsable', 'resultado'));
    }

    public function crearInformeEstabilizador($id)
    {
        // Obtener los datos necesarios para el informe
        $estabilizador = Estabilizador::find($id);
        $user = Auth::user();
        $responsable = Responsable::all();
        $resultado = Resultado::all();

        return view('estabilizador.informes.crearInforme', compact('estabilizador','user','responsable', 'resultado'));
    }
    public function crearInformeMonitor($id)
    {
        // Obtener los datos necesarios para el informe
        $monitor = Monitor::find($id);
        $user = Auth::user();
        $responsable = Responsable::all();
        $resultado = Resultado::all();

        return view('monitor.informes.crearInforme', compact('monitor','user','responsable', 'resultado'));
    }
    public function crearInformeUps($id)
    {
        // Obtener los datos necesarios para el informe
        $upese = Upese::find($id);
        $user = Auth::user();
        $responsable = Responsable::all();
        $resultado = Resultado::all();

        return view('upese.informes.crearInforme', compact('upese','user','responsable', 'resultado'));
    }
    public function crearInformeLaptop($id)
    {
        // Obtener los datos necesarios para el informe
        $laptop = Laptop::find($id);
        $user = Auth::user();
        $responsable = Responsable::all();
        $resultado = Resultado::all();

        return view('laptop.informes.crearInforme', compact('laptop','user','responsable', 'resultado'));
    }
    public function descargarInforme(Request $request, $id)
    {

        $phpWord = new PhpWord();
        // Configura el locale
        Carbon::setLocale('es');
        $fechaActual = Carbon::now()->translatedFormat('d \\d\\e F \\d\\e Y');

$section = $phpWord->addSection([
    'pageSizeW' => 12240, // Ancho oficio
    'pageSizeH' => 18720, // Alto oficio
    // Opcional: márgenes
    'marginTop'    => 1440,  // 1 pulgada
    'marginRight'  => 1440,
    'marginBottom' => 1440,
    'marginLeft'   => 1440,
]);


        $activo = $request->input('activo');
        $valor = $request->input('valor');
        $resultado_id = $request->input('resultado_id');
        $cite = $request->input('cite');
        $aquien = $request->input('aquien');
        $cargo1 = $request->input('cargo1');
        $via1 = $request->input('via1');
        $cargo2 = $request->input('cargo2');
        $via2 = $request->input('via2');
        $cargo3 = $request->input('cargo3');
        $user = $request->input('user');
        $citeAntecedentes = $request->input('cite_antecedentes');
        $fecha_recepcion = $request->input('fecha_recepcion');
        $referencia = $request->input('referencia');
        $desc_nota = $request->input('desc_nota');
        $falla_antecedentes = $request->input('falla_antecedentes');
        $codGamea = $request->input('cod_gamea');
        $caractSicaf = $request->input('caract_sicaf');
        $datosactivo = $request->input('datosactivo');
        $desc_trabajo = $request->input('desc_trabajo');
        $cumplecaract = $request->input('cumplecaract');
        $nombre_func = $request->input('nombre_func');
        $cargo_func = $request->input('cargo_func');
        $ci = $request->input('ci');
        $detalle = $request->input('detalle');
        $falla_encontrada = $request->input('falla_encontrada');
        $fechaRecepcion = Carbon::parse($fecha_recepcion)->translatedFormat('d \\d\\e F \\d\\e Y');

//-------------------------ACTUALIZAR RESULTADO DE INFORME-------------------------------------
        if($activo === 'audifono'){
                $audifono = Audifono::find($id);
                $audifono->resultado_id = $request->input('resultado_id');
                $audifono->save();
        }
        if($activo === 'estabilizador'){
                $estabilizador = Estabilizador::find($id);
                $estabilizador->resultado_id = $request->input('resultado_id');
                $estabilizador->save();
        }
        if($activo === 'impresora'){
                $impresora = Impresora::find($id);
                $impresora->resultado_id = $request->input('resultado_id');
                $impresora->save();
        }
        if($activo === 'laptop'){
                $laptop = Laptop::find($id);
                $laptop->resultado_id = $request->input('resultado_id');
                $laptop->save();
        }
        if($activo === 'monitor'){
                $monitor = Monitor::find($id);
                $monitor->resultado_id = $request->input('resultado_id');
                $monitor->save();
        }
        if($activo === 'parlante'){
                $parlante = Parlante::find($id);
                $parlante->resultado_id = $request->input('resultado_id');
                $parlante->save();
        }
        if($activo === 'mouse'){
                $mouse = Raton::find($id);
                $mouse->resultado_id = $request->input('resultado_id');
                $mouse->save();
        }
        if($activo === 'CPU'){
                $cpu = RegistroCpu::find($id);
                $cpu->resultado_id = $request->input('resultado_id');
                $cpu->save();
        }
        if($activo === 'teclado'){
                $teclado = Teclado::find($id);
                $teclado->resultado_id = $request->input('resultado_id');
                $teclado->save();
        }
        if($activo === 'UPS'){
                $ups = Upese::find($id);
                $ups->resultado_id = $request->input('resultado_id');
                $ups->save();
        }

        // -------------------ENCABEZADO---------------------------------
        $header = $section->addHeader();
        //$header->firstPage();
        $sectionStyle = $section->getStyle();
       $sectionStyle->setHeaderHeight(720); // 2 cm = 720 twips

        $fontStyle = array('name' => 'Calibri', 'size' => 16, 'bold' => true,  'alignment' => 'center');
        $fontStyleUnderline = array('underline' => 'double','underlineColor' => '800000','name' => 'Calibri', 'size' => 14, 'bold' => true,  'alignment' => 'center');

        $fontStyle100 = array('name' => 'Times New Roman', 'size' => 9, 'bold' => true);
        $fontStyle = array('name' => 'Times New Roman', 'size' => 9);
        $paragraphStyle = array('alignment' => 'center');
        $table = $header->addTable(array('alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER));

        $table->addRow();
        $table->addCell(2500, array('valign' => 'center'))->addImage(public_path('img1/elalto.jpg'), array('width' => 60, 'height' => 60));
        $table->addCell(500, array('valign' => 'center'))->addText(str_repeat(' ', 1)); // 5 espacios
        $table->addCell(10000, array('valign' => 'center','alignment' => 'center'))->addText('GOBIERNO AUTONOMO MUNICIPAL DE EL ALTO',$fontStyleUnderline,$paragraphStyle, array('bold' => true));
        $table->addCell(500, array('valign' => 'center'))->addText(str_repeat(' ', 1)); // 5 espacios
        $table->addCell(2500, array('valign' => 'center'))->addImage(public_path('img1/logo-gamea.jpg'), array('width' => 60, 'height' => 60));

        // -------------INFORME-------------------------------------------------------------------------------
        $fontStyle100 = array('name' => 'Times New Roman', 'size' => 11, 'bold' => true);
        $fontStyle = array('name' => 'Times New Roman', 'size' => 9);
        $paragraphStyle = array('alignment' => 'center');
        $section->addText('INFORME', $fontStyle100, $paragraphStyle);

        $section->addText('CITE: SMAF/DA/UASI/'.strtoupper($cite).'/'.date('Y'), $fontStyle, $paragraphStyle);
        //$section->addText('', null, array('spaceAfter' => 100)); // Agrega un espaciado después

        // -------------CUERPO-------------------------------------------------------------------------------
        $tableStyle = array('alignment' => 'center');
        $table = $section->addTable($tableStyle);
        $fontStyle = array('name' => 'Times New Roman', 'size' => 9);
        $cellStyle = array('alignment' => 'center');

        $table->addRow();
        $paragraphStyle1 = array('spaceAfter' => 500,'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::END);
        $table->addCell(null, $cellStyle)->addText('A: ', $fontStyle, $paragraphStyle1);
        $cell = $table->addCell(null, $cellStyle);
        $paragraphStyle = array('spaceAfter' => 0, 'lineHeight' => 1);
        $cell->addText("\n" .ucwords(strtolower($aquien)) , $fontStyle, $paragraphStyle);
        if($resultado_id == 3 || $resultado_id == 4 || $resultado_id == 5){
        $cell->addText("\n" .'JEFE DE UNIDAD DE ACTIVOS FIJOS', $fontStyle, $paragraphStyle);
        }else{
        $cell->addText("\n" . strtoupper($cargo1), $fontStyle, $paragraphStyle);
        }
        $cell->addText("\n" . 'GOBIERNO AUTONOMO MUNICIPAL DE EL ALTO', $fontStyle, $paragraphStyle);

        $table->addRow();
        $paragraphStyle1 = array('spaceAfter' => 700,'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::END);
        $table->addCell(null, $cellStyle)->addText('VIA: ', $fontStyle, $paragraphStyle1);
        $cell = $table->addCell(null, $cellStyle);
        $paragraphStyle = array('spaceAfter' => 0, 'lineHeight' => 1);
        $cell->addText("\n" .$via1, $fontStyle, $paragraphStyle);
        $cell->addText("\n" . strtoupper($cargo2), $fontStyle, $paragraphStyle);
        $cell->addText("\n" . 'UNIDAD DE ADMINISTRACIÓN DE SISTEMAS DE INFORMACIÓN', $fontStyle, $paragraphStyle);
        $cell->addText("\n" . 'GOBIERNO AUTONOMO MUNICIPAL DE EL ALTO', $fontStyle, $paragraphStyle);

        $table->addRow();
        $paragraphStyle1 = array('spaceAfter' => 700,'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::END);
        $table->addCell(null, $cellStyle)->addText('', $fontStyle, $paragraphStyle1);
        $cell = $table->addCell(null, $cellStyle);
        $paragraphStyle = array('spaceAfter' => 0, 'lineHeight' => 1);
        $cell->addText("\n" .$via2, $fontStyle, $paragraphStyle);
        $cell->addText("\n" . strtoupper($cargo3), $fontStyle, $paragraphStyle);
        $cell->addText("\n" . 'UNIDAD DE ADMINISTRACIÓN DE SISTEMAS DE INFORMACIÓN', $fontStyle, $paragraphStyle);
        $cell->addText("\n" . 'GOBIERNO AUTONOMO MUNICIPAL DE EL ALTO', $fontStyle, $paragraphStyle);

        $table->addRow();
        $paragraphStyle1 = array('spaceAfter' => 700,'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::END);
        $table->addCell(null, $cellStyle)->addText('DE: ', $fontStyle, $paragraphStyle1);
        $cell = $table->addCell(null, $cellStyle);
        $paragraphStyle = array('spaceAfter' => 0, 'lineHeight' => 1);
        $cell->addText("\n" . ucwords(strtolower($user)), $fontStyle, $paragraphStyle);
        $cell->addText("\n" . 'TÉCNICO EN SOPORTE', $fontStyle, $paragraphStyle);
        $cell->addText("\n" . 'UNIDAD DE ADMINISTRACIÓN DE SISTEMAS DE INFORMACIÓN', $fontStyle, $paragraphStyle);
        $cell->addText("\n" . 'GOBIERNO AUTONOMO MUNICIPAL DE EL ALTO', $fontStyle, $paragraphStyle);

        $table->addRow();
        $paragraphStyle11 = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::END);
        $table->addCell(null, $cellStyle)->addText('REF.:', $fontStyle,$paragraphStyle11 );
        $table->addCell(null, $cellStyle)->addText("\n" .'INFORME TÉCNICO', $fontStyle );

        $table->addRow();
        $paragraphStyle1 = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::END);
        $table->addCell(null, $cellStyle)->addText('FECHA: ', $fontStyle , $paragraphStyle);
        $table->addCell(null, $cellStyle)->addText("\n" . $fechaActual , $fontStyle );

        $lineStyle1 = array('width' => 450, 'height' =>1, 'color' => 'FF0000'); // Rojo
        $section->addLine($lineStyle1);

       // -------------------ANTECEDENTES DEVOLUCION--------------------------------------------------------------------------
       if($resultado_id == 1){
        $fontStyle100 = array('name' => 'Times New Roman', 'size' => 9, 'bold' => true);
        $fontStyle = array('name' => 'Times New Roman', 'size' => 9);
        $paragraphStyle30 = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH,);
        $section->addText('I. ANTECEDENTES.', $fontStyle100);
        $section->addText('En atención a la nota con CITE: '.$citeAntecedentes.' con Ref.: '.strtoupper($referencia).', 
que llego a nuestra unidad, por lo que me remito a informar lo siguiente.', $fontStyle, $paragraphStyle30);
        // -------------------DESARROLLO-----------------------------------------------------------------------------------------
        $fontStyle100 = array('name' => 'Times New Roman', 'size' => 9, 'bold' => true);
        $fontStyle = array('name' => 'Times New Roman', 'size' => 9);
        $paragraphStyle = array('alignment' => 'center');
        $section->addText('II. DESARROLLO.', $fontStyle100);
        $section->addText('Se procedió a la revisión técnica en general del equipo, el cual se detalla en la siguiente tabla comparativa.
Se tiene el siguiente diagnóstico:', $fontStyle);
       }
       // -------------------ANTECEDENTES REPOSICION-------------------------------------------------------------------------------
       if($resultado_id == 2){
        $fontStyle100 = array('name' => 'Times New Roman', 'size' => 9, 'bold' => true);
        $fontStyle = array('name' => 'Times New Roman', 'size' => 9);
        $paragraphStyle30 = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH,);
        $section->addText('I. ANTECEDENTES.', $fontStyle100);
        $section->addText('En atención a la nota en fecha de recepción '. $fechaRecepcion.' por la unidad 
con Ref. '.strtoupper($referencia).', que llego a nuestra Unidad, por lo que me remito a informar lo siguiente.', $fontStyle, $paragraphStyle30);
        // -------------------DESARROLLO--------------------------------------------------------------------------------------------------
        $fontStyle100 = array('name' => 'Times New Roman', 'size' => 9, 'bold' => true);
        $fontStyle = array('name' => 'Times New Roman', 'size' => 9);
        $paragraphStyle = array('alignment' => 'center');
        $section->addText('II. DESARROLLO.', $fontStyle100);
        $section->addText('Se procedió a la revisión técnica del equipo '.$activo.' y su funcionalidad, el cual se detalla en la siguiente tabla comparativa', $fontStyle);
       }

       // -------------------ANTECEDENTES REPLIEGUE-------------------------
       if($resultado_id == 3){
        $fontStyle100 = array('name' => 'Times New Roman', 'size' => 9, 'bold' => true);
        $fontStyle = array('name' => 'Times New Roman', 'size' => 9);
        $paragraphStyle30 = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH,);
        $section->addText('I. ANTECEDENTES.', $fontStyle100);
        $section->addText('En atención a nota con CITE: '.$citeAntecedentes.' en fecha de recepción '. $fechaRecepcion.',
con Ref.: '.strtoupper($referencia).', que llego a nuestra Unidad en el que describe en su nota “'.$desc_nota.'”, el cual me remito a informar lo siguiente.', $fontStyle, $paragraphStyle30);
        // -------------------DESARROLLO-------------------------
        $fontStyle100 = array('name' => 'Times New Roman', 'size' => 9, 'bold' => true);
        $fontStyle = array('name' => 'Times New Roman', 'size' => 9);
        $paragraphStyle = array('alignment' => 'center');
        $section->addText('II. DESARROLLO.', $fontStyle100);
        $section->addText('Se procedió a la revisión técnica del activo '.$activo.' el cual se detalla en la siguiente tabla comparativa.
Se tiene el siguiente diagnóstico:
', $fontStyle);
       }
       // -------------------ANTECEDENTES CUSTODIO Y BAJA-------------------------
       if($resultado_id == 4 || $resultado_id == 5){
        $fontStyle100 = array('name' => 'Times New Roman', 'size' => 9, 'bold' => true);
        $fontStyle = array('name' => 'Times New Roman', 'size' => 9);
        $paragraphStyle30 = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH,);
        $section->addText('I. ANTECEDENTES.', $fontStyle100);
        $section->addText('En atención a la nota con CITE: '.$citeAntecedentes.', con Ref.: '.strtoupper($referencia).', que llego a nuestra Unidad
para la revisión en el cual detalla en su nota “'.$desc_nota.'”, por lo que me remito a informar
lo siguiente.', $fontStyle, $paragraphStyle30);
        // -------------------DESARROLLO-------------------------
        $fontStyle100 = array('name' => 'Times New Roman', 'size' => 9, 'bold' => true);
        $fontStyle = array('name' => 'Times New Roman', 'size' => 9);
        $paragraphStyle = array('alignment' => 'center');
        $section->addText('II. DESARROLLO.', $fontStyle100);
        $section->addText('Se procedió a la revisión técnica del activo debido que presenta '.$falla_antecedentes.', por lo cual se detalla en la siguiente tabla comparativa.
Se tiene el siguiente diagnóstico:', $fontStyle, $paragraphStyle30);
       }

//----------------------TABLA DEVOLUCION, REPLIEGUE, CUSTODIO, BAJA-----------------------
       if($resultado_id == 1 || $resultado_id == 3 || $resultado_id == 4 || $resultado_id == 5){
        // $tableStyle = array('alignment' => 'center');
                $tableStyle = array(
            'borderSize' => 1,
            'borderColor' => '000000',
            'cellMargin' => 80,
        );
        $table = $section->addTable($tableStyle);
        $fontStyle = array('name' => 'Times New Roman', 'size' => 7);
        $cellStyle = array('alignment' => 'center');
        $cellStyle2 = array('valign' => 'center','alignment' => 'center');
        $cellStyle3 = array('alignment' => 'center','bgColor' => '619acd');

        $table->addRow();
        $table->addCell(1500, $cellStyle3)->addText('CODIGO GAMEA', $fontStyle );
        $table->addCell(3000, $cellStyle3)->addText('CARACTERÍSTICA TÉCNICAS DEL EQUIPO ACTUAL', $fontStyle );
        $table->addCell(3000, $cellStyle3)->addText('CARACTERÍSTICA DEL ACTIVO SEGÚN SISTEMA (SICAF)', $fontStyle );
        $table->addCell(3000, $cellStyle3)->addText('TRABAJO REALIZADO: ', $fontStyle );

        $table->addRow();
        $cell = $table->addCell(1200, $cellStyle2);
        $paragraphStyle = array('spaceAfter' => 0, 'lineHeight' => 1,);
        $cell->addText("\n" . strtoupper($activo), $fontStyle, $paragraphStyle);
        $cell->addText("\n" . $codGamea, $fontStyle, $paragraphStyle);
        $table->addCell(3000, $cellStyle)->addText($datosactivo, $fontStyle);
        $table->addCell(3000, $cellStyle)->addText($caractSicaf, $fontStyle);
        $table->addCell(3000, $cellStyle)->addText($desc_trabajo, $fontStyle);
    }

//----------------------TABLA REPOSICION-----------------------
        if($resultado_id == 2){
        // $tableStyle = array('alignment' => 'center');
                $tableStyle = array(
            'borderSize' => 1,
            'borderColor' => '000000',
            'cellMargin' => 80
        );
        $cellStyle20 = array(
            'borderSize' => 1,
            'borderColor' => '000000',
        );

        $table = $section->addTable($tableStyle);
        $fontStyle = array('name' => 'Times New Roman', 'size' => 7);
        $cellStyle = array('alignment' => 'center');
        $table->addRow();
        $table->addCell(2000, $cellStyle)->addText('ACTIVO', $fontStyle );
        $table->addCell(2000, $cellStyle)->addText('CODIGO GAMEA: ', $fontStyle );
        $table->addCell(3000, $cellStyle)->addText('CARACTERÍSTICA DEL ACTIVO SEGÚN SISTEMA (SICAF)', $fontStyle );
        $table->addCell(3000, $cellStyle)->addText('CARACTERÍSTICAS TÉCNICAS DEL EQUIPO DE REPOSICIÓN', $fontStyle );

        $table->addRow();
        $table->addCell(2000, $cellStyle)->addText(strtoupper($activo), $fontStyle );
        $table->addCell(2000, $cellStyle)->addText($codGamea, $fontStyle );
        $table->addCell(3000, $cellStyle)->addText($caractSicaf, $fontStyle);
        $table->addCell(3000, $cellStyle)->addText($desc_trabajo, $fontStyle);

        $table->addRow();
        $table->addCell(2000);
        $table->addCell(2000);
        $table->addCell(3000);
        $table->addCell(3000, $cellStyle)->addText($cumplecaract, $fontStyle);
    }

//-------------------------CONCLUSION DEVOLUCION--------------------------
        if($resultado_id == 1){
        $fontStyle100 = array('name' => 'Times New Roman', 'size' => 9, 'bold' => true);
        $fontStyle = array('name' => 'Times New Roman', 'size' => 9);
        $section->addTextBreak(1); //salto de línea
        $section->addText('III. CONCLUSIÓN.', $fontStyle100);
        $paragraphStyle30 = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH,);
        $section->addText('Por todo lo detallado anteriormente se informa que el activo mencionado en la tabla comparativa con su respectivo código que ingreso
a nuestra unidad por parte de '.$nombre_func.' ('. $cargo_func.'), el cual llego con el detalle de "'.$detalle.'", donde se realizó la revisión y la reparación
del mismo como se indica en el cuadro descriptivo, además de un mantenimiento preventivo y correctivo en general '.$valor.' '.$activo.' se encuentra en funcionamiento por
lo cual se hace la DEVOLUCIÓN de dicho activo al custodio para su uso correspondiente.', $fontStyle, $paragraphStyle30);
        $section->addText('Es cuanto se puede informar para fines consiguientes.', $fontStyle);
        }
//-------------------------CONCLUSION REPOSICION--------------------------
        if($resultado_id == 2){
        $fontStyle100 = array('name' => 'Times New Roman', 'size' => 9, 'bold' => true);
        $fontStyle = array('name' => 'Times New Roman', 'size' => 9);
        $section->addTextBreak(1); //salto de línea
        $section->addText('III. CONCLUSIÓN.', $fontStyle100);
        $paragraphStyle30 = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH,);
        $section->addText('La Unidad de Administración de Sistemas de Información informa que se verificó '.$valor.' '.$activo.' de reposición mencionada en la tabla comparativa
y tiene características técnicas similares y/o superiores, además se encuentra en funcionamiento correcto y fue presentado en calidad de REPOSICIÓN por parte de
'.$nombre_func.' con C.I. '.$ci.'.,  ('. $cargo_func.'), como se puede observar en la tabla comparativa '.$valor.' '.$activo.' presentada '.$cumplecaract.' con las características
técnicas requeridas por la Unidad de Activos Fijos, por lo que se sugiere proseguir con el trámite administrativo correspondiente.', $fontStyle, $paragraphStyle30);
        $section->addText('Es cuanto se puede informar para fines consiguientes.', $fontStyle,);
        }
//-------------------------CONCLUSION REPLIEGUE--------------------------
        if($resultado_id == 3){
        $fontStyle100 = array('name' => 'Times New Roman', 'size' => 9, 'bold' => true);
        $fontStyle = array('name' => 'Times New Roman', 'size' => 9);
        $section->addTextBreak(1); //salto de línea
        $section->addText('III. CONCLUSIÓN.', $fontStyle100);
        $paragraphStyle30 = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH,);
        $section->addText('Por todo lo detallado anteriormente se informa que el activo mencionado en la tabla comparativa con su respectivo código que ingreso
a nuestra unidad para su REPLIEGUE O BAJA por parte de '.$nombre_func.' ('. $cargo_func.'), el equipo se encuentra en funcionamiento correcto,
por lo que se sugiere el REPLIEGUE de dicho equipo a la Unidad de Activos Fijos.', $fontStyle,$paragraphStyle30);
        $section->addText('Es cuanto se puede informar para fines consiguientes.', $fontStyle);
        }
//-------------------------CONCLUSION CUSTODIO--------------------------
        if($resultado_id == 4){
        $fontStyle100 = array('name' => 'Times New Roman', 'size' => 9, 'bold' => true);
        $fontStyle = array('name' => 'Times New Roman', 'size' => 9);
        $section->addTextBreak(1); //salto de línea
        $section->addText('III. CONCLUSIÓN.', $fontStyle100);
        $paragraphStyle30 = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH,);
        $section->addText('Por todo lo detallado anteriormente se informa que el activo mencionado en la tabla comparativa con su respectivo código
que ingreso a nuestra unidad, el cual llego con el detalle de “'.strtoupper($detalle).'”, donde se realizó la revisión de '.$valor.' '.$activo.'
y presenta '.$falla_encontrada.' como se describe en dicha tabla, por el momento la Unidad de Administración de Sistemas de Información
no cuenta con las piezas o repuestos de reemplazo requerido para la reparación del mismo por lo que se sugiere que el responsable del activo
lo tenga en CUSTODIO hasta que se tengan los repuestos o piezas de reemplazo requeridos.', $fontStyle,$paragraphStyle30);
        $section->addText('Es cuanto se puede informar para fines consiguientes.', $fontStyle);
        }
//-------------------------CONCLUSION BAJA--------------------------
        if($resultado_id == 5){
        $fontStyle100 = array('name' => 'Times New Roman', 'size' => 9, 'bold' => true);
        $fontStyle = array('name' => 'Times New Roman', 'size' => 9);
        $section->addTextBreak(1); //salto de línea
        $section->addText('III. CONCLUSIÓN.', $fontStyle100);
        $paragraphStyle30 = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH,);
        $section->addText('Por todo lo detallado anteriormente se informa que el activo mencionado en la tabla comparativa con sus respectivo código,
que ingreso a nuestra unidad por parte de '.$nombre_func.' ('. $cargo_func.') el equipo presenta '.$falla_encontrada.' como
se describe en la tabla mencionada, por lo cual su reparación y el cambio o actualización de sus piezas implicaría el costo de uno nuevo, razón por la cual la Unidad
de administración de Sistemas de Información, sugiere la BAJA del activo debido a que ya cumplió con su tiempo de vida útil.', $fontStyle,$paragraphStyle30);
        $paragraphStyle90 = array(
        'spaceAfter' => 0, // elimina el espaciado después del párrafo
        'spaceBefore' => 0, // elimina el espaciado antes del párrafo
        'spacing' => 0, // elimina el espaciado entre líneas
        );

        $listStyle = array('listType' => \PhpOffice\PhpWord\Style\ListItem::TYPE_BULLET_FILLED);
        $textos = array(
        'En estricto cumplimiento a la disposición legal de la Norma Básica para la Administración de bienes y Servicios D.S. Nº 181, en donde el Sub Sistema disposición de bienes señala:',
        'Que el art. 235 en el punto (causales), la baja de bienes procederá a las siguientes causales en sus incisos.',
        );
                foreach ($textos as $texto) {
        $section->addListItem($texto, 0, $fontStyle, $listStyle, $paragraphStyle90);
        }

        $paragraphStyle91 = array('indentation' => array('left' => 1800),'spaceAfter' => 0,'spaceBefore' => 1); // 720 twips = 0.5 pulgadas
        $letras = array('e', 'f');
        $incisos = array('Señala "Inutilización"', 'Señala "Obsolencia"');

        foreach ($incisos as $i => $inciso) {
        $section->addText($letras[$i] . ') ' . $inciso, $fontStyle, $paragraphStyle91);
        }

$section->addText('Es cuanto se puede informar para fines consiguientes.', $fontStyle);
}

//-------------------------PIE DE PAGINA-------------------------
        $paragraphStyleFooter = array(
        'spaceAfter' => 0,
        'spaceBefore' => 0, 
        );

        $fontStyleFooter = array('alignment' => 'center', // Centrar el texto
        'name' => 'Calibri',
        'size' => 6,
        'bold' => false,
        'spaceAfter' => 0, // Quitar espacio después del párrafo
        'spaceBefore' => 0, // Quitar espacio antes del párrafo
        );

        $section->getStyle()->setFooterHeight(100); // Establece la altura del footer en 500 twips
        $paragraphStyle300 = array('alignment' => 'center',
        'name' => 'Calibri',
        'size' => 6,
        'bold' => false);
        $footer = $section->addFooter();
        $footer->addtext('_________________________________________________________________________________',$paragraphStyleFooter,$paragraphStyle300);
        $footer->addText('Avenida Costanera, Nro: 5022 Urbanización Libertad, entre calle J.J. Torrez y calle Hernan Siles Zuaso',$paragraphStyle300, $fontStyleFooter, $paragraphStyleFooter);
        $footer->addText('(Jacha Uta – Piso Planta Baja), a media cuadra de la estación de bomberos El Alto)',$paragraphStyle300, $fontStyleFooter, $paragraphStyleFooter);
        
        // $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        // $objWriter->save('Informe '.$activo.''. $codGamea.'.docx');
        $filename = 'Informe '.$activo.''. $codGamea.'.docx';

                try {
                $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
                $objWriter->save($filename);
                return response()->download($filename);
                } catch (\Exception $e) {
                // Manejar la excepción
                }
    }
}