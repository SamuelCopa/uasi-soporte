<?php

namespace App\Http\Controllers;

use App\Models\Audifono;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\AudifonoRequest;
use App\Models\Dependencia;
use App\Models\Estado;
use App\Models\Funcionario;
use App\Models\Resultado;
use App\Models\User;
use App\Services\TwilioService;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;
use Endroid\QrCode\QrCode;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use PhpOption\None;
use stdClass;
use TCPDF;
use Illuminate\Support\Facades\Mail;
use App\Mail\AlertaMantenimiento;
use App\Services\NotificacionService;
use App\Mail\TecnicoAsignado;
use App\Services\EquipoPdfService;
use Illuminate\Support\Facades\DB;
use App\Models\Correlativo;
use App\Services\CorrelativoService;

class AudifonoController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    protected $notificacionService;

    public function __construct(NotificacionService $notificacionService)
    {
        $this->notificacionService = $notificacionService;
    }

public function index(Request $request): View
{
    $gestionPasada = date('Y') - 1;

    // Últimos 30 días de la gestión pasada
    $fechaFinPasada = Carbon::create($gestionPasada, 12, 31); // 31 dic gestión pasada
    $fechaInicioPasada = $fechaFinPasada->copy()->subDays(29); // últimos 30 días exactos

    // Consulta: últimos 30 días gestión pasada OR registros de la gestión actual
    $audifonos = Audifono::where(function ($query) use ($fechaInicioPasada, $fechaFinPasada) {
            $query->whereBetween('fecha', [$fechaInicioPasada, $fechaFinPasada])
            ->where('estado_id', '!=', 5);
        })
        ->orWhereYear('fecha', date('Y'))
        ->orderByDesc('fecha')
        ->paginate();

    $estado = Estado::all();
    $resultado = Resultado::all();
    $dependencia = Dependencia::orderBy('dependencias', 'asc')->get();

    $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'Tecnico');
        })
        ->where('id_estadousuario', '1')
        ->orderBy('paterno', 'asc')
        ->get();

    return view('audifono.index', compact('audifonos','users','estado','dependencia','resultado'))
        ->with('i', ($request->input('page', 1) - 1) * $audifonos->perPage());
}


    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        $audifono = new Audifono();
        $estado=Estado::all();
        $dependencia = Dependencia::orderBy('dependencias', 'asc')->get();
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'Tecnico');
        })->where('id_estadousuario', '1')->get();  

        return view('audifono.create', compact('audifono','estado','dependencia','users'));
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request, CorrelativoService $correlativoService)
    {

        $request->validate([
            'ci'        => 'required',
            'celular'   => 'required|string',
            'email'   => 'required|string',
            'cod_gamea' => 'required|integer',
            'marca'     => 'required',
            'modelo'    => 'required',
            'falla'     => 'required',
        ]);

        $funcionario = Funcionario::firstOrNew(['ci' => $request->ci]);

        // Si es nuevo: asignar todos los campos desde el request
        if (!$funcionario->exists) {
            if (empty($request->cargo)) {
                $funcionario->cargo = null;
                $funcionario->dependencia_id = null;
            }
            // CELULAR, EMAIL para NUEVO registro
            $funcionario->celular = $request->celular;
            $funcionario->email = $request->email;
        } else {
            // Si existe: actualizar celular, email si es q cambio de numero
            if ($funcionario->celular != $request->celular) {
                $funcionario->celular = $request->celular;
            }
            if ($funcionario->email != $request->email) {
                $funcionario->email = $request->email;
            }
        }

        // Asignar los valores de los campos
        $funcionario->grado_academico = $request->input('grado_academico');
        $funcionario->paterno = $request->input('paterno');
        $funcionario->materno = $request->input('materno');
        $funcionario->nombre = $request->input('nombre');
        $funcionario->ci = $request->input('ci');
        $funcionario->expedido = $request->input('expedido');
        $funcionario->celular = $request->input('celular');
        $funcionario->cargo = $request->input('cargo');
        $funcionario->email = $request->input('email');
        $funcionario->dependencia_id = $request->input('dependencia_id');
        // Guardar los cambios
        $funcionario->save();

    $audifono = DB::transaction(function () use (
        $request,
        $funcionario,
        $correlativoService
    ) {

        $audifono = new Audifono();

        $audifono->funcionario_id = $funcionario->id;
        $audifono->cargo = $request->input('cargo');
        $audifono->dependencia_id = $request->input('dependencia_id');
        $audifono->cod_gamea = $request->input('cod_gamea');

        // GENERAR CORRELATIVO
        $audifono->cod_registro =
            $correlativoService->generarNumeroRecepcion();

        $audifono->fecha = $request->input('fecha');
        $audifono->marca = $request->input('marca');
        $audifono->modelo = $request->input('modelo');
        $audifono->falla = $request->input('falla');
        $audifono->observaciones = $request->input('observaciones');
        $audifono->funcionario_activo =
            $request->input('funcionario_activo');
        $audifono->estado_id = $request->input('estado_id');
        $audifono->reguser_id = Auth::id();

        $audifono->save();

        return $audifono;
    });

    return redirect()
        ->route('audifonos.index')
        ->with('success', 'REGISTRADO CORRECTAMENTE')
        ->with('text', 'Número de recepción: ' . $audifono->cod_registro)
        ->with('icono', 'success');
    }


    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $audifono = Audifono::find($id);

        return view('audifono.show', compact('audifono'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $audifono = Audifono::find($id);
        $estado=Estado::all();
        $dependencia = Dependencia::orderBy('dependencias', 'asc')->get();
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'Tecnico');
        })->where('id_estadousuario', '1')->orderBy('paterno', 'asc')->get();  
        return view('audifono.edit',compact('audifono','estado','dependencia','users' ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AudifonoRequest $request, $id): RedirectResponse
    {
        $audifono = Audifono::find($id);
        $funcionario = Funcionario::find($id);
        $funcionario = Funcionario::find($audifono->funcionario_id);

        $funcionarioExistente = Funcionario::where('ci', $request->input('ci'))->first();

        if ($funcionarioExistente && $funcionarioExistente->id != $funcionario->id) {
        // Si el funcionario ya existe y no es el mismo, asigna el ID existente
        $audifono->funcionario_id = $funcionarioExistente->id;
        } else {
            // Si no existe o es el mismo, actualiza el funcionario
            if(empty($request->input('cargo'))){
            $request->merge(['cargo' => 'EX FUNCIONARIO']);
            }
            $funcionario->grado_academico = $request->input('grado_academico');
            $funcionario->paterno = $request->input('paterno');
            $funcionario->materno = $request->input('materno');
            $funcionario->nombre = $request->input('nombre');
            $funcionario->ci = $request->input('ci');
            $funcionario->expedido = $request->input('expedido');
            $funcionario->celular = $request->input('celular');
            $funcionario->cargo = $request->input('cargo');
            $funcionario->email = $request->input('email');
            $funcionario->dependencia_id = $request->input('dependencia_id');
            $funcionario->save();
            $audifono->funcionario_id = $funcionario->id;
        }
            $audifono->cargo = $request->input('cargo');
            $audifono->dependencia_id = $request->input('dependencia_id');
            $audifono->cod_gamea = $request->input('cod_gamea');
            $audifono->cod_registro = $request->input('cod_registro');
            $audifono->marca = $request->input('marca');
            $audifono->fecha = $request->input('fecha');
            $audifono->fecha_inicio = $request->input('fecha_inicio');
            $audifono->fecha_asignacion = $request->input('fecha_asignacion');
            $audifono->modelo = $request->input('modelo');
            $audifono->falla = $request->input('falla');
            $audifono->observaciones = $request->input('observaciones');
            $audifono->funcionario_activo = $request->input('funcionario_activo');
            $audifono->estado_id = $request->input('estado_id');
            $audifono->user_id = $request->input('user_id') ?: null;
            $audifono->save();

        return Redirect::route('audifonos.index')
        ->with('success', 'ACTUALIZADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    public function destroy($id): RedirectResponse
    {
        Audifono::find($id)->delete();

        return Redirect::route('audifonos.index')
            ->with('success', 'ELIMINADO CORRECTAMENTE')
            ->with('icono', 'success');
    }

    public function generarPdf($id)
    {
        $audifono = Audifono::findOrFail($id);
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LETTER', true, 'UTF-8', false);
        $pdf->SetTitle('Doc. ' . $audifono->funcionario->ci);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->AddPage();
        $html = view('audifono.pdf', compact('audifono'))->render();
        $pdf->writeHTML($html);

        
         // set style for barcode
        $style = array(
            //'border' => 2,
            'vpadding' => 'auto',
            'hpadding' => 'auto',
            'fgcolor' => array(0,0,0),
            'bgcolor' => false, 
            'module_width' => 1, 
            'module_height' => 1 
        );
 if ($audifono->funcionario_activo == 1) {

    $datos = $audifono->funcionario?->grado_academico . ' ' .
             $audifono->funcionario?->nombre . ' ' .
             $audifono->funcionario?->paterno . ' ' .
             $audifono->funcionario?->materno .
             ' - ' .
             $audifono->funcionario?->ci . ' ' .
             $audifono->funcionario?->expedido .
             ' - ' .
             ($audifono->dependencia?->dependencias ?? 'SIN DEPENDENCIA') .
             ' - SOPORTE TECNICO-GAMEA';

} else {

    $datos = $audifono->funcionario?->grado_academico . ' ' .
             $audifono->funcionario?->nombre . ' ' .
             $audifono->funcionario?->paterno . ' ' .
             $audifono->funcionario?->materno .
             ' - ' .
             $audifono->funcionario?->ci . ' ' .
             $audifono->funcionario?->expedido .
             ' - ' .
             ($audifono->funcionario?->cargo ?? 'SIN CARGO') .
             ' - SOPORTE TECNICO-GAMEA';
}

$datos1 = trim(
    ($audifono->funcionario?->grado_academico ?? '') . ' ' .
    ($audifono->funcionario?->nombre ?? '') . ' ' .
    ($audifono->funcionario?->paterno ?? '') . ' ' .
    ($audifono->funcionario?->materno ?? '')
);

$datos2 = ($audifono->funcionario?->ci ?? '') . ' ' .
          ($audifono->funcionario?->expedido ?? '');

$datos3 = $audifono->funcionario?->cargo ?? 'SIN CARGO';

$datos4 = $audifono->dependencia?->dependencias ?? 'SIN DEPENDENCIA';

        $pdf->write2DBarcode($datos, 'QRCODE,H', 165, 210, 45, 45, $style, 'N');
        $pdf->Text(20, 205, '');
        $pdf->SetY(-70); // establece la posición del cursor en la parte inferior de la página
        $pdf->Cell(0, 5, $datos1, 0, 1, 'C');
        $pdf->Cell(0, 5, $datos2, 0, 1, 'C');
        $pdf->Cell(0, 5, $datos3, 0, 1, 'C');
        $pdf->MultiCell(0, 5, $datos4, 0, 'C', false, 1);

// GENERAR CONTENIDO
$pdfContent = $pdf->Output('audifono.pdf', 'S');

// RESPUESTA CORRECTA PARA MODAL (iframe)
return response($pdfContent)
    ->header('Content-Type', 'application/pdf')
    ->header('Content-Disposition', 'inline; filename="audifono.pdf"');
    }


private function armarDataAudifono($equipo)
{
    return [
        'audifono' => $equipo,
        'qr' => $this->armarQrAudifono($equipo),
        'footer' => [
            $this->nombreCompleto($equipo),
            $this->ciCompleto($equipo),
            $equipo->funcionario?->cargo,
            $equipo->dependencia?->dependencias
        ]
    ];
}
private function armarQrAudifono($equipo)
{
    if ($equipo->funcionario_activo == 1) {
        return $this->nombreCompleto($equipo) . ' - ' .
               $this->ciCompleto($equipo) . ' - ' .
               ($equipo->dependencia?->dependencias ?? '') .
               ' - SOPORTE TECNICO-GAMEA';
    }

    return $this->nombreCompleto($equipo) . ' - ' .
           $this->ciCompleto($equipo) . ' - ' .
           ($equipo->funcionario?->cargo ?? '') .
           ' - SOPORTE TECNICO-GAMEA';
}

private function nombreCompleto($equipo)
{
    return trim(
        ($equipo->funcionario?->grado_academico ?? '') . ' ' .
        ($equipo->funcionario?->nombre ?? '') . ' ' .
        ($equipo->funcionario?->paterno ?? '') . ' ' .
        ($equipo->funcionario?->materno ?? '')
    );
}

private function ciCompleto($equipo)
{
    return trim(
        ($equipo->funcionario?->ci ?? '') . ' ' .
        ($equipo->funcionario?->expedido ?? '')
    );
}
/**
     * 1. PREVIEW (inline)
     */
public function preview($id, EquipoPdfService $service)
{
    $equipo = Audifono::with(['funcionario', 'dependencia'])->findOrFail($id);

    $data = $this->armarDataAudifono($equipo);

    $pdf = $service->generar($data, 'audifono.pdf');

    return response($pdf)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'inline; filename="audifono.pdf"');
}
    /**
     * 2. DESCARGA (attachment)
     */
public function descargar($id, EquipoPdfService $service)
{
    $equipo = Audifono::with(['funcionario', 'dependencia'])->findOrFail($id);

    $data = $this->armarDataAudifono($equipo);

    $pdf = $service->generar($data, 'audifono.pdf');

    return response($pdf)
        ->header('Content-Disposition', 'attachment; filename="audifono.pdf"');
}

    /**
     * 3. ENVÍO (correo con adjunto)
     */
public function enviar($id, EquipoPdfService $service)
{
    $equipo = Audifono::with(['funcionario', 'dependencia'])->findOrFail($id);

    $data = $this->armarDataAudifono($equipo);

    $pdf = $service->generar($data, 'audifono.pdf');

    $correo = $this->obtenerCorreoDestino($equipo);

    if (!$correo) {
        return response()->json([
            'success' => false,
            'message' => 'El funcionario no tiene correo registrado'
        ], 422);
    }

    Mail::send('emails.equipo', [], function ($message) use ($pdf, $correo) {
        $message->to($correo)
            ->subject('Remisión del formulario de recepción correspondiente')
            ->attachData($pdf, 'documento.pdf', [
                'mime' => 'application/pdf',
            ]);
    });

    return response()->json([
        'success' => true,
        'message' => 'Formulario enviado correctamente'
    ]);
}

    /**
     * Método auxiliar
     */
    private function obtenerCorreoDestino($audifono)
    {
        return $audifono->funcionario?->email;
    }



    public function cambiarEstado(Request $request)
{
    $audifono = Audifono::findOrFail($request->id);

    $estadoId = (int) $request->input('estado_id');

    // Actualizar estado
    $audifono->estado_id = $estadoId;

    // Mapeo de fechas por estado
    $fechas = [
        2 => 'fecha_inicio',
        5 => 'fecha_entrega',
    ];

    if (isset($fechas[$estadoId])) {

        $campoFecha = $fechas[$estadoId];

        if (empty($audifono->$campoFecha)) {
            $audifono->$campoFecha = now();
        }
    }

    $audifono->save();

    // Notificación
    if (in_array($estadoId, [3, 4])) {

        $this->notificacionService->enviar(
            $audifono->funcionario,
            $estadoId,
            $audifono
        );
    }

    // Respuesta JSON
return response()->json([
    'success' => true,

    'estado' => $estadoId == 5
        ? $audifono->resultado?->nombre
        : $audifono->estado?->nombre,

]);
}


    public function updateTecnico(Request $request, $id){

    $equipo = Audifono::findOrFail($id);
    $equipo->user_id = $request->input('user_id');
    $equipo->fecha_asignacion = $request->input('fecha_asignacion');
    $equipo->save();

    //obtener usuario (técnico)
    $user = $equipo->user;

    // 📧 enviar correo
    if ($user?->email) {
        Mail::to($user->email)
            ->send(new TecnicoAsignado($equipo, $user));
    }

    return Redirect::route('audifonos.index')
        ->with('success', 'ASIGNADO CORRECTAMENTE') 
        ->with('text', 'Se ha enviado la notificación de asignación al técnico.')          
        ->with('icono', 'success');

    }

    public function updateFecha(Request $request, $id){
        $audifono = Audifono::find($id);
        $audifono->fecha = $request->input('fecha');
        $audifono->boton_oculto = true;
        $audifono->update();
        return Redirect::route('audifonos.index')
        ->with('success', 'FECHA ACTUALIZADA CORRECTAMENTE')         
        ->with('text', 'Se actualizo a la fecha de hoy')         
        ->with('icono', 'success');
    }

    public function search(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $audifonos = Audifono::whereBetween('fecha', [$start_date, $end_date])->get();
        if ($audifonos->isEmpty()) {
            return Redirect::route('reportes')
            ->with('success', 'ERROR')         
            ->with('icono', 'error')
            ->with('text', 'No se encontraron resultados');

        }else{
            return view('reportes.audifono.resFechaAudifono', compact('audifonos', 'start_date', 'end_date'));
        }
    }

    public function fechaPdf(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $audifonos = Audifono::whereBetween('fecha', [$start_date, $end_date])->get();
    $pdf = Pdf::setPaper('letter') ->loadView('reportes.audifono.pdfFechaAudifono', compact('audifonos','start_date','end_date'));
        return $pdf->stream('audifonos.pdf');

    }

    public function searchAudifono(Request $request)
    {
        $query = $request->input('query');
        
        $audifonos = Audifono::where('cod_gamea', 'LIKE', "$query")
        ->get();
        if ($audifonos->isEmpty()) {
            return Redirect::route('reportes')
            ->with('success', 'DATOS INCORRECTOS')         
            ->with('icono', 'error')
            ->with('text', 'No se encontraron resultados');

        }else{
            return view('reportes.audifono.resAudifono', compact('audifonos','query'));
        }
    
    }

    public function pdfAudifono(Request $request)
    {

        $query = $request->input('query');
        $audifonos = Audifono::where('cod_gamea', 'LIKE', $query )
        ->get();
        $pdf = Pdf::setPaper('letter') ->loadView('reportes.audifono.pdfAudifono', compact('audifonos','query'));
        return $pdf->stream('audifonos.pdf');

    }

    public function searchAudifonoYear(Request $request)
    {
        $query = $request->input('query');
        
        $audifonos = Audifono::whereYear('created_at', $query)->get();

        if ($audifonos->isEmpty()) {
            return Redirect::route('reportes')
            ->with('success', 'DATOS INCORRECTOS')         
            ->with('icono', 'error')
            ->with('text', 'No se encontraron resultados');

        }else{
            return view('reportes.audifono.resYearAudifono', compact('audifonos','query'));
        }
    
    }

    public function pdfAudifonoYear(Request $request)
    {

        $query = $request->input('query');
        $audifonos = Audifono::whereYear('created_at', $query)->get();

        $pdf = Pdf::setPaper('letter') ->loadView('reportes.audifono.pdfYearAudifono', compact('audifonos','query'));
        return $pdf->stream('audifonos.pdf');

    }

        public function buscaAudifono(Request $request)
    {
        $query = $request->input('query');
        $datos = Audifono::where('cod_gamea', 'LIKE', $query)
        ->orderBy('id', 'desc') // o created_at
        ->get();
        return response()->json($datos);
    }

}