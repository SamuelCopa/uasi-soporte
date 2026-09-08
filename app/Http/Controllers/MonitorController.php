<?php

namespace App\Http\Controllers;

use App\Models\Monitor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\MonitorRequest;
use App\Models\Dependencia;
use App\Models\Estado;
use App\Models\Funcionario;
use App\Models\User;
use App\Services\TwilioService;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use TCPDF;
use Illuminate\Support\Facades\Mail;
use App\Mail\AlertaMantenimiento;
use App\Services\NotificacionService;
use App\Mail\TecnicoAsignado;
use App\Services\EquipoPdfService;
use Illuminate\Support\Facades\DB;
use App\Services\CorrelativoService;
use Illuminate\Support\Facades\Storage;
use App\Mail\EquipoPdfEnviado;

class MonitorController extends Controller
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
        $monitors = Monitor::where(function ($query) use ($fechaInicioPasada, $fechaFinPasada) {
            $query->whereBetween('fecha', [$fechaInicioPasada, $fechaFinPasada])
            ->where('estado_id', '!=', 5);
        })
        ->orWhereYear('fecha', date('Y'))
        ->orderByDesc('fecha')
        ->paginate();
        $estado=Estado::all();
        $dependencia = Dependencia::orderBy('dependencias', 'asc')->get();
        $users = User::whereHas('roles', function ($query) {$query->where('name', 'Tecnico');
        })->where('id_estadousuario', '1')->orderBy('paterno', 'asc')->get();

        return view('monitor.index', compact('monitors', 'users','estado','dependencia'))
            ->with('i', ($request->input('page', 1) - 1) * $monitors->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $monitor = new Monitor();
        $estado=Estado::all();
        $dependencia = Dependencia::orderBy('dependencias', 'asc')->get();
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'Tecnico');
        })->where('id_estadousuario', '1')->get(); 

        return view('monitor.create', compact('monitor','estado','dependencia', 'users'));
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
            'marca'     => 'required|string',
            'modelo'    => 'required|string',
            'falla'     => 'required|string',
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
        $funcionario->email = $request->input('email');
        $funcionario->cargo = $request->input('cargo');
        $funcionario->dependencia_id = $request->input('dependencia_id');
        // Guardar los cambios
        $funcionario->save();


    $monitor = DB::transaction(function () use (
        $request,
        $funcionario,
        $correlativoService
    ) {

        $monitor = new Monitor();

        $monitor->funcionario_id = $funcionario->id;
        $monitor->cargo = $request->input('cargo');
        $monitor->dependencia_id = $request->input('dependencia_id');
        $monitor->cod_gamea = $request->input('cod_gamea');
        // GENERAR CORRELATIVO
        $monitor->cod_registro = $correlativoService->generarNumeroRecepcion();

        $monitor->fecha = $request->input('fecha');
        $monitor->marca = $request->input('marca');
        $monitor->modelo = $request->input('modelo');
        $monitor->tamano = $request->input('tamano');
        $monitor->falla = $request->input('falla');
        $monitor->observaciones = $request->input('observaciones');
        $monitor->funcionario_activo = $request->input('funcionario_activo');
        $monitor->estado_id = $request->input('estado_id');
        $monitor->reguser_id = Auth::id();

        $monitor->save();

        return $monitor;
    });
    return redirect()
        ->route('monitors.index')
        ->with('success', 'REGISTRADO CORRECTAMENTE')
        ->with('text', 'Número de recepción: ' . $monitor->cod_registro)
        ->with('icono', 'success');

    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $monitor = Monitor::find($id);

        return view('monitor.show', compact('monitor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $monitor = Monitor::find($id);
        $estado=Estado::all();
        $dependencia = Dependencia::orderBy('dependencias', 'asc')->get();
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'Tecnico');
        })->where('id_estadousuario', '1')->orderBy('paterno', 'asc')->get();

        return view('monitor.edit', compact('monitor','estado','dependencia', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MonitorRequest $request,  $id): RedirectResponse
    {
        $monitor = Monitor::find($id);
        $funcionario = Funcionario::find($id);
        $funcionario = Funcionario::find($monitor->funcionario_id);

        $funcionarioExistente = Funcionario::where('ci', $request->input('ci'))->first();

        if ($funcionarioExistente && $funcionarioExistente->id != $funcionario->id) {
        // Si el funcionario ya existe y no es el mismo, asigna el ID existente
        $monitor->funcionario_id = $funcionarioExistente->id;
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
            $monitor->funcionario_id = $funcionario->id;
        }
            $monitor->cargo = $request->input('cargo');
            $monitor->dependencia_id = $request->input('dependencia_id');
            $monitor->cod_gamea = $request->input('cod_gamea');
            $monitor->cod_registro = $request->input('cod_registro');
            $monitor->marca = $request->input('marca');
            $monitor->fecha = $request->input('fecha');
            $monitor->fecha_asignacion = $request->input('fecha_asignacion');
            $monitor->fecha_inicio = $request->input('fecha_inicio');
            $monitor->modelo = $request->input('modelo');
            $monitor->tamano = $request->input('tamano');
            $monitor->falla = $request->input('falla');
            $monitor->observaciones = $request->input('observaciones');
            $monitor->funcionario_activo = $request->input('funcionario_activo');
            $monitor->estado_id = $request->input('estado_id');
            $monitor->user_id = $request->input('user_id') ?: null;
            $monitor->save();

        return Redirect::route('monitors.index')
        ->with('success', 'ACTUALIZADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    public function destroy($id): RedirectResponse
    {
        Monitor::find($id)->delete();

        return Redirect::route('monitors.index')
            ->with('success', 'ELIMINADO CON EXITO')
            ->with('icono', 'success');
    }

    public function generarPdf($id)
    {
        $monitor = Monitor::findOrFail($id);
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LETTER', true, 'UTF-8', false);
        $pdf->SetTitle('Doc. ' . $monitor->funcionario?->ci);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->AddPage();
        $html = view('monitor.pdf', compact('monitor'))->render();
        $pdf->writeHTML($html);

        // codigo qr
        $style = array(
            //'border' => 2,
            'vpadding' => 'auto',
            'hpadding' => 'auto',
            'fgcolor' => array(0,0,0),
            'bgcolor' => false, 
            'module_width' => 1, 
            'module_height' => 1 
        );
 if ($monitor->funcionario_activo == 1) {

    $datos = $monitor->funcionario?->grado_academico . ' ' .
             $monitor->funcionario?->nombre . ' ' .
             $monitor->funcionario?->paterno . ' ' .
             $monitor->funcionario?->materno .
             ' - ' .
             $monitor->funcionario?->ci . ' ' .
             $monitor->funcionario?->expedido .
             ' - ' .
             ($monitor->dependencia?->dependencias ?? 'SIN DEPENDENCIA') .
             ' - SOPORTE TECNICO-GAMEA';

} else {

    $datos = $monitor->funcionario?->grado_academico . ' ' .
             $monitor->funcionario?->nombre . ' ' .
             $monitor->funcionario?->paterno . ' ' .
             $monitor->funcionario?->materno .
             ' - ' .
             $monitor->funcionario?->ci . ' ' .
             $monitor->funcionario?->expedido .
             ' - ' .
             ($monitor->funcionario?->cargo ?? 'SIN CARGO') .
             ' - SOPORTE TECNICO-GAMEA';
}

$datos1 = trim(
    ($monitor->funcionario?->grado_academico ?? '') . ' ' .
    ($monitor->funcionario?->nombre ?? '') . ' ' .
    ($monitor->funcionario?->paterno ?? '') . ' ' .
    ($monitor->funcionario?->materno ?? '')
);

$datos2 = ($monitor->funcionario?->ci ?? '') . ' ' .
          ($monitor->funcionario?->expedido ?? '');

$datos3 = $monitor->funcionario?->cargo ?? 'SIN CARGO';

$datos4 = $monitor->dependencia?->dependencias ?? 'SIN DEPENDENCIA';

        $pdf->write2DBarcode($datos, 'QRCODE,H', 165, 210, 45, 45, $style, 'N');
        $pdf->Text(20, 205, '');
        $pdf->SetY(-70); // establece la posición del cursor en la parte inferior de la página
        $pdf->Cell(0, 5, $datos1, 0, 1, 'C');
        $pdf->Cell(0, 5, $datos2, 0, 1, 'C');
        $pdf->Cell(0, 5, $datos3, 0, 1, 'C');
        $pdf->MultiCell(0, 5, $datos4, 0, 'C', false, 1);

        $pdfContent = $pdf->Output('monitor.pdf', 'S');

        // RESPUESTA CORRECTA PARA MODAL (iframe)
        return response($pdfContent)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="monitor.pdf"');
        
    }


    private function armarDatamonitor($equipo)
{
    return [
        'monitor' => $equipo,
        'qr' => $this->armarQrmonitor($equipo),
        'footer' => [
            $this->nombreCompleto($equipo),
            $this->ciCompleto($equipo),
            $equipo->funcionario?->cargo,
            $equipo->dependencia?->dependencias
        ]
    ];
}
private function armarQrmonitor($equipo)
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
    $equipo = Monitor::with(['funcionario', 'dependencia'])->findOrFail($id);

    $data = $this->armarDatamonitor($equipo);

    $pdf = $service->generar($data, 'monitor.pdf');

    return response($pdf)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'inline; filename="monitor.pdf"');
}
    /**
     * 2. DESCARGA (attachment)
     */
public function descargar($id, EquipoPdfService $service)
{
    $equipo = Monitor::with(['funcionario', 'dependencia'])->findOrFail($id);

    $data = $this->armarDatamonitor($equipo);

    $pdf = $service->generar($data, 'monitor.pdf');

    return response($pdf)
        ->header('Content-Disposition', 'attachment; filename="monitor.pdf"');
}

    /**
     * 3. ENVÍO (correo con adjunto)
     */
public function enviar($id, EquipoPdfService $service)
{
    $equipo = Monitor::with([
        'funcionario',
        'dependencia'
    ])->findOrFail($id);

    $data = $this->armarDatamonitor($equipo);

    $pdf = $service->generar($data, 'monitor.pdf');

    $correo = $this->obtenerCorreoDestino($equipo);

    if (!$correo) {
        return response()->json([
            'success' => false,
            'message' => 'El funcionario no tiene correo registrado'
        ], 422);
    }

    // Nombre temporal del PDF
    $nombreArchivo = 'documentos/monitor_' . $equipo->id . '_' . time() . '.pdf';

    // Guardar PDF temporalmente
    Storage::disk('local')->put($nombreArchivo, $pdf);

    // Enviar a la cola solamente la ruta del archivo
    Mail::to($correo)
        ->queue(new EquipoPdfEnviado(
            Storage::disk('local')->path($nombreArchivo)
        ));

    return response()->json([
        'success' => true,
        'message' => 'Formulario enviado correctamente'
    ]);
}

    /**
     * Método auxiliar
     */
    private function obtenerCorreoDestino($monitor)
    {
        return $monitor->funcionario?->email;
    }

// ===========CAMBIAR ESTADO Y ENVIAR ALERTA==================
    public function cambiarEstado(Request $request)
    {
        $monitor = Monitor::findOrFail($request->id);

        $estadoId = (int) $request->input('estado_id');

        // =========================
        // ACTUALIZAR ESTADO
        // =========================
        $monitor->estado_id = $estadoId;

        // Mapeo de fechas por estado
        $fechas = [
            2 => 'fecha_inicio',
            5 => 'fecha_entrega',
        ];

        $monitor->estado_id = $estadoId;

        if (isset($fechas[$estadoId])) {

            $campoFecha = $fechas[$estadoId];

            // Controla la fecha, NO el estado
            if (empty($monitor->$campoFecha)) {
                $monitor->$campoFecha = now();
            }
        }

        $monitor->save();

        // =========================
        // ENVÍO DE NOTIFICACIÓN
        // =========================
        if (in_array($estadoId, [3, 4])) {

            $this->notificacionService->enviar(
                $monitor->funcionario,
                $estadoId,
                $monitor
            );
        }

        // =========================
        // RESPUESTA
        // =========================
        return response()->json([
            'estado' => $estadoId == 5
                ? $monitor->resultado?->nombre
                : $monitor->estado?->nombre
        ]);
    }


    public function updateTecnico(Request $request, $id){

    $equipo = Monitor::findOrFail($id);
    $equipo->user_id = $request->input('user_id');
    $equipo->fecha_asignacion = $request->input('fecha_asignacion');
    $equipo->save();

    //obtener usuario (técnico)
    $user = $equipo->user;

    // 📧 enviar correo
    if ($user?->email) {
        Mail::to($user->email)
            ->queue(new TecnicoAsignado($equipo, $user));
    }
    
    return Redirect::route('monitors.index')
        ->with('success', 'ASIGNADO CORRECTAMENTE') 
        ->with('text', 'Se ha enviado la notificación de asignación al técnico.')          
        ->with('icono', 'success');   
    }

    public function updateFecha(Request $request, $id){
        $monitor = Monitor::find($id);
        $monitor->fecha = $request->input('fecha');
        $monitor->boton_oculto = true;
        $monitor->update();
        return Redirect::route('monitors.index')
        ->with('success', 'FECHA ACTUALIZADA CORRECTAMENTE')         
        ->with('text', 'Se actualizo a la fecha de hoy')         
        ->with('icono', 'success');
    }

    public function search(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $monitor = Monitor::whereBetween('fecha', [$start_date, $end_date])->get();
        if ($monitor->isEmpty()) {
            return Redirect::route('reportes')
            ->with('success', 'ERROR')         
            ->with('icono', 'error')
            ->with('text', 'No se encontraron resultados');

        }else{
            return view('reportes.monitor.resFechaMonitor', compact('monitor', 'start_date', 'end_date'));
        }
    }

    public function fechaPdf(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $monitor = Monitor::whereBetween('fecha', [$start_date, $end_date])->get();
        $pdf = Pdf::setPaper('letter') ->loadView('reportes.monitor.pdfFechaMonitor', compact('monitor', 'start_date', 'end_date'));
        return $pdf->stream('monitor.pdf');
    }

    public function searchMonitor(Request $request)
    {
        $query = $request->input('query');
        
        $monitor = Monitor::where('cod_gamea', 'LIKE', "$query")
        ->get();
        if ($monitor->isEmpty()) {
            return Redirect::route('reportes')
            ->with('success', 'DATOS INCORRECTOS')         
            ->with('icono', 'error')
            ->with('text', 'No se encontraron resultados');

        }else{
            return view('reportes.monitor.resMonitor', compact('monitor','query'));
        }
    }

    public function pdfMonitor(Request $request)
    {
        $query = $request->input('query');
        $monitor = Monitor::where('cod_gamea', 'LIKE', $query )
        ->get();
        $pdf = Pdf::setPaper('letter') ->loadView('reportes.monitor.pdfMonitor', compact('monitor', 'query'));
        return $pdf->stream('monitor.pdf');
    }

    public function searchYearMonitor(Request $request)
    {
        $query = $request->input('query');
        
        $monitor = Monitor::whereYear('created_at', $query)->get();

        if ($monitor->isEmpty()) {
            return Redirect::route('reportes')
            ->with('success', 'DATOS INCORRECTOS')         
            ->with('icono', 'error')
            ->with('text', 'No se encontraron resultados');

        }else{
            return view('reportes.monitor.resYearMonitor', compact('monitor','query'));
        }
    }

    public function pdfYearMonitor(Request $request)
    {
        $query = $request->input('query');
        $monitor = Monitor::whereYear('created_at', $query)->get();

        $pdf = Pdf::setPaper('letter') ->loadView('reportes.monitor.pdfYearMonitor', compact('monitor', 'query'));
        return $pdf->stream('monitor.pdf');
    }

    public function buscaMonitor(Request $request)
    {
        $query = $request->input('query');
        $datos = Monitor::where('cod_gamea', 'LIKE', $query)
         ->orderBy('id', 'desc') // o created_at
        ->get();
        return response()->json($datos);
    }
}
