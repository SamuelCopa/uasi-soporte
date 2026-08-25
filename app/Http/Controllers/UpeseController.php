<?php

namespace App\Http\Controllers;

use App\Models\Upese;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\UpeseRequest;
use App\Models\Dependencia;
use App\Models\Estado;
use App\Models\Funcionario;
use App\Models\Resultado;
use App\Models\User;
use App\Services\TwilioService;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use TCPDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\AlertaMantenimiento;
use App\Services\NotificacionService;
use App\Mail\TecnicoAsignado;
use App\Services\EquipoPdfService;
use Illuminate\Support\Facades\DB;
use App\Services\CorrelativoService;

class UpeseController extends Controller
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
    $upeses = Upese::where(function ($query) use ($fechaInicioPasada, $fechaFinPasada) {
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

    return view('upese.index', compact('upeses','users','estado','dependencia','resultado'))
        ->with('i', ($request->input('page', 1) - 1) * $upeses->perPage());
}


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $upese = new Upese();
        $estado=Estado::all();
        $dependencia = Dependencia::orderBy('dependencias', 'asc')->get();
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'Tecnico');
        })->where('id_estadousuario', '1')->get();
        return view('upese.create', compact('upese','estado','dependencia', 'users'));
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

    $upese = DB::transaction(function () use (
        $request,
        $funcionario,
        $correlativoService
    ) {

        $upese = new Upese();

        $upese->funcionario_id = $funcionario->id;
        $upese->cargo = $request->input('cargo');
        $upese->dependencia_id = $request->input('dependencia_id');
        $upese->cod_gamea = $request->input('cod_gamea');
        // GENERAR CORRELATIVO
        $upese->cod_registro = $correlativoService->generarNumeroRecepcion();

        $upese->fecha = $request->input('fecha');
        $upese->marca = $request->input('marca');
        $upese->modelo = $request->input('modelo');
        $upese->falla = $request->input('falla');
        $upese->observaciones = $request->input('observaciones');
        $upese->funcionario_activo = $request->input('funcionario_activo');
        $upese->estado_id = $request->input('estado_id');
        $upese->reguser_id = Auth::id();

        $upese->save();

        return $upese;
    });
    return redirect()
        ->route('upeses.index')
        ->with('success', 'REGISTRADO CORRECTAMENTE')
        ->with('text', 'Número de recepción: ' . $upese->cod_registro)
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $upese = Upese::find($id);

        return view('upese.show', compact('upese', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $upese = Upese::find($id);
        $estado=Estado::all();
        $dependencia = Dependencia::orderBy('dependencias', 'asc')->get();
        $users = User::whereHas('roles', function ($query) {$query->where('name', 'Tecnico');
        })->where('id_estadousuario', '1')->orderBy('paterno', 'asc')->get(); 

        return view('upese.edit', compact('upese','estado','dependencia', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpeseRequest $request,  $id): RedirectResponse
    {
        $upese = Upese::find($id);
        $funcionario = Funcionario::find($id);
        $funcionario = Funcionario::find($upese->funcionario_id);

        $funcionarioExistente = Funcionario::where('ci', $request->input('ci'))->first();

        if ($funcionarioExistente && $funcionarioExistente->id != $funcionario->id) {
        // Si el funcionario ya existe y no es el mismo, asigna el ID existente
        $upese->funcionario_id = $funcionarioExistente->id;
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
            $upese->funcionario_id = $funcionario->id;
        }
            $upese->cargo = $request->input('cargo');
            $upese->dependencia_id = $request->input('dependencia_id');
            $upese->cod_gamea = $request->input('cod_gamea');
            $upese->cod_registro = $request->input('cod_registro');
            $upese->marca = $request->input('marca');
            $upese->fecha = $request->input('fecha');
            $upese->fecha_asignacion = $request->input('fecha_asignacion');
            $upese->fecha_inicio = $request->input('fecha_inicio');
            $upese->modelo = $request->input('modelo');
            $upese->falla = $request->input('falla');
            $upese->observaciones = $request->input('observaciones');
            $upese->funcionario_activo = $request->input('funcionario_activo');
            $upese->estado_id = $request->input('estado_id');
            $upese->user_id = $request->input('user_id') ?: null;
            $upese->save();

        return Redirect::route('upeses.index')
        ->with('success', 'ACTUALIZADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    public function destroy($id): RedirectResponse
    {
        Upese::find($id)->delete();
        
        return Redirect::route('upeses.index')
        ->with('success', 'ELIMINADO CON EXITO')
        ->with('icono', 'success');
    }

    public function generarPdf($id)
    {
        $ups = Upese::findOrFail($id);
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LETTER', true, 'UTF-8', false);
        $pdf->SetTitle('Doc. ' . $ups->funcionario->ci);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->AddPage();
        $html = view('upese.pdf', compact('ups'))->render();
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
        if($ups->funcionario_activo == 1){
        $datos = $ups->funcionario?->grado_academico.' '.$ups->funcionario?->nombre.' '.$ups->funcionario?->paterno.' '.$ups->funcionario?->materno. ' - ' . $ups->funcionario?->ci.''.$ups->funcionario?->expedido  . ' - ' . $ups->dependencia->dependencias.' - SOPORTE TECNICO-GAMEA';
        }else{
        $datos = $ups->funcionario?->grado_academico.' '.$ups->funcionario?->nombre .' '.$ups->funcionario?->paterno.' '.$ups->funcionario?->materno. ' - ' . $ups->funcionario?->ci.''.$ups->funcionario?->expedido  . ' - ' .$ups->funcionario?->cargo.' - SOPORTE TECNICO-GAMEA';
        }
        $datos1 = $ups->funcionario?->grado_academico.' '.$ups->funcionario?->nombre.' '.$ups->funcionario?->paterno.' '.$ups->funcionario?->materno ;
        $datos2 = $ups->funcionario?->ci.' '.$ups->funcionario?->expedido ;
        $datos3 = $ups->funcionario?->cargo; 
        $datos4 = $ups->dependencia?->dependencias; 

        $pdf->write2DBarcode($datos, 'QRCODE,H', 165, 210, 45, 45, $style, 'N');
        $pdf->Text(20, 205, '');
        $pdf->SetY(-70); // establece la posición del cursor en la parte inferior de la página
        $pdf->Cell(0, 5, $datos1, 0, 1, 'C');
        $pdf->Cell(0, 5, $datos2, 0, 1, 'C');
        $pdf->Cell(0, 5, $datos3, 0, 1, 'C');
        $pdf->Cell(0, 5, $datos4, 0, 1, 'C');

        $pdfContent = $pdf->Output('ups.pdf', 'S');

        // RESPUESTA CORRECTA PARA MODAL (iframe)
        return response($pdfContent)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="ups.pdf"');
        
    }


    private function armarDataups($equipo)
{
    return [
        'ups' => $equipo,
        'qr' => $this->armarQrups($equipo),
        'footer' => [
            $this->nombreCompleto($equipo),
            $this->ciCompleto($equipo),
            $equipo->funcionario?->cargo,
            $equipo->dependencia?->dependencias
        ]
    ];
}
private function armarQrups($equipo)
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
    $equipo = Upese::with(['funcionario', 'dependencia'])->findOrFail($id);

    $data = $this->armarDataups($equipo);

    $pdf = $service->generar($data, 'ups.pdf');

    return response($pdf)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'inline; filename="ups.pdf"');
}
    /**
     * 2. DESCARGA (attachment)
     */
public function descargar($id, EquipoPdfService $service)
{
    $equipo = Upese::with(['funcionario', 'dependencia'])->findOrFail($id);

    $data = $this->armarDataups($equipo);

    $pdf = $service->generar($data, 'upese.pdf');

    return response($pdf)
        ->header('Content-Disposition', 'attachment; filename="ups.pdf"');
}

    /**
     * 3. ENVÍO (correo con adjunto)
     */
public function enviar($id, EquipoPdfService $service)
{
    $equipo = Upese::with(['funcionario', 'dependencia'])->findOrFail($id);

    $data = $this->armarDataups($equipo);

    $pdf = $service->generar($data, 'upese.pdf');

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
    private function obtenerCorreoDestino($ups)
    {
        return $ups->funcionario?->email;
    }

// ===========CAMBIAR ESTADO Y ENVIAR ALERTA==================
    public function cambiarEstado(Request $request)
    {
        $ups = Upese::findOrFail($request->id);

        $estadoId = (int) $request->input('estado_id');

        // =========================
        // ACTUALIZAR ESTADO
        // =========================
        $ups->estado_id = $estadoId;

        // Mapeo de fechas por estado
        $fechas = [
            2 => 'fecha_inicio',
            5 => 'fecha_entrega',
        ];

        $ups->estado_id = $estadoId;

        if (isset($fechas[$estadoId])) {

            $campoFecha = $fechas[$estadoId];

            // Controla la fecha, NO el estado
            if (empty($ups->$campoFecha)) {
                $ups->$campoFecha = now();
            }
        }

        $ups->save();
        // =========================
        // ENVÍO DE NOTIFICACIÓN
        // =========================
        if (in_array($estadoId, [3, 4])) {

            $this->notificacionService->enviar(
                $ups->funcionario,
                $estadoId,
                $ups
            );
        }

        // =========================
        // RESPUESTA
        // =========================
        return response()->json([
            'estado' => $estadoId == 5
                ? $ups->resultado?->nombre
                : $ups->estado?->nombre
        ]);
    }

    public function updateTecnico(Request $request, $id){

    $equipo = Upese::findOrFail($id);
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

    return Redirect::route('upeses.index')
        ->with('success', 'ASIGNADO CORRECTAMENTE') 
        ->with('text', 'Se ha enviado la notificación de asignación al técnico.')          
        ->with('icono', 'success');   
    }
    
    public function updateFecha(Request $request, $id){
        $ups = Upese::find($id);
        $ups->fecha = $request->input('fecha');
        $ups->boton_oculto = true;
        $ups->update();
        return Redirect::route('upeses.index')
        ->with('success', 'FECHA ACTUALIZADA CORRECTAMENTE')         
        ->with('text', 'Se actualizo a la fecha de hoy')         
        ->with('icono', 'success');
    }
    
    public function search(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $ups = Upese::whereBetween('fecha', [$start_date, $end_date])->get();
        if ($ups->isEmpty()) {
            return Redirect::route('reportes')
            ->with('success', 'ERROR')         
            ->with('icono', 'error')
            ->with('text', 'No se encontraron resultados');

        }else{
            return view('reportes.ups.resFechaUps', compact('ups', 'start_date', 'end_date'));
        }
    }

    public function fechaPdf(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $ups = Upese::whereBetween('fecha', [$start_date, $end_date])->get();
        $pdf = Pdf::setPaper('letter') ->loadView('reportes.ups.pdfFechaUps', compact('ups','start_date', 'end_date'));
        return $pdf->stream('ups.pdf');
    }

    public function searchUps(Request $request)
    {
        $query = $request->input('query');
        
        $ups = Upese::where('cod_gamea', 'LIKE', "$query")->get();
        if ($ups->isEmpty()) {
            return Redirect::route('reportes')
            ->with('success', 'DATOS INCORRECTOS')         
            ->with('icono', 'error')
            ->with('text', 'No se encontraron resultados');

        }else{
            return view('reportes.ups.resUps', compact('ups','query'));
        }
    
    }

    public function pdfUps(Request $request)
    {
        $query = $request->input('query');
        $ups = Upese::where('cod_gamea', 'LIKE', $query )->get();
        $pdf = Pdf::setPaper('letter') ->loadView('reportes.ups.pdfUps', compact('ups', 'query'));
        return $pdf->stream('ups.pdf');
    }

    public function searchYearUps(Request $request)
    {
        $query = $request->input('query');
        
        $ups = Upese::whereYear('created_at', $query)->get();
        if ($ups->isEmpty()) {
            return Redirect::route('reportes')
            ->with('success', 'DATOS INCORRECTOS')         
            ->with('icono', 'error')
            ->with('text', 'No se encontraron resultados');

        }else{
            return view('reportes.ups.resYearUps', compact('ups','query'));
        }
    
    }

    public function pdfYearUps(Request $request)
    {
        $query = $request->input('query');
        $ups = Upese::whereYear('created_at', $query)->get();
        $pdf = Pdf::setPaper('letter') ->loadView('reportes.ups.pdfYearUps', compact('ups', 'query'));
        return $pdf->stream('ups.pdf');
    }

    public function buscaUps(Request $request)
    {
        $query = $request->input('query');
        $datos = Upese::where('cod_gamea', 'LIKE', $query)
         ->orderBy('id', 'desc') // o created_at
        ->get();
        return response()->json($datos);
    }
}
