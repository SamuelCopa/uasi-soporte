<?php

namespace App\Http\Controllers;

use App\Models\Estabilizador;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\EstabilizadorRequest;
use App\Models\Dependencia;
use App\Models\Estado;
use App\Models\Funcionario;
use App\Models\Resultado;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use TCPDF;
use App\Services\TwilioService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\AlertaMantenimiento;
use App\Services\NotificacionService;
use App\Mail\TecnicoAsignado;
use App\Services\EquipoPdfService;
use Illuminate\Support\Facades\DB;
use App\Models\Correlativo;
use App\Services\CorrelativoService;

class EstabilizadorController extends Controller
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
    $estabilizadors = Estabilizador::where(function ($query) use ($fechaInicioPasada, $fechaFinPasada) {
            $query->whereBetween('fecha', [$fechaInicioPasada, $fechaFinPasada])
            ->where('estado_id', '!=', 5);
        })
        ->orWhereYear('fecha', date('Y'))
        ->orderByDesc('fecha')
        ->paginate();

    $estado = Estado::all();
    $dependencia = Dependencia::orderBy('dependencias', 'asc')->get();
    $resultado = Resultado::all();

    $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'Tecnico');
        })
        ->where('id_estadousuario', '1')
        ->orderBy('paterno', 'asc')
        ->get();

        return view('estabilizador.index', compact('estabilizadors','users','estado','dependencia','resultado'))
            ->with('i', ($request->input('page', 1) - 1) * $estabilizadors->perPage());
}
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $estabilizador = new Estabilizador();
        $estado=Estado::all()->except(6);
        $dependencia = Dependencia::orderBy('dependencias', 'asc')->get();
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'Tecnico');
        })->where('id_estadousuario', '1')->get();  

        return view('estabilizador.create', compact('estabilizador','estado','dependencia','users'));
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
        
    $estabilizador = DB::transaction(function () use (
        $request,
        $funcionario,
        $correlativoService
    ) {

        $estabilizador = new Estabilizador();

        $estabilizador->funcionario_id = $funcionario->id;
        $estabilizador->cargo = $request->input('cargo');
        $estabilizador->dependencia_id = $request->input('dependencia_id');
        $estabilizador->cod_gamea = $request->input('cod_gamea');

        // GENERAR CORRELATIVO
        $estabilizador->cod_registro =
            $correlativoService->generarNumeroRecepcion();

        $estabilizador->fecha = $request->input('fecha');
        $estabilizador->marca = $request->input('marca');
        $estabilizador->modelo = $request->input('modelo');
        $estabilizador->falla = $request->input('falla');
        $estabilizador->observaciones = $request->input('observaciones');
        $estabilizador->funcionario_activo =
        $request->input('funcionario_activo');
        $estabilizador->estado_id = $request->input('estado_id');
        $estabilizador->reguser_id = Auth::id();

        $estabilizador->save();

        return $estabilizador;
    });

    return redirect()
        ->route('estabilizadors.index')
        ->with('success', 'REGISTRADO CORRECTAMENTE')
        ->with('text', 'Número de recepción: ' . $estabilizador->cod_registro)
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $estabilizador = Estabilizador::find($id);

        return view('estabilizador.show', compact('estabilizador','users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $estabilizador = Estabilizador::find($id);
        $estado=Estado::all()->except(6);
        $dependencia = Dependencia::orderBy('dependencias', 'asc')->get();
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'Tecnico');
        })->where('id_estadousuario', '1')->orderBy('paterno', 'asc')->get();

        return view('estabilizador.edit', compact('estabilizador','estado','dependencia','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EstabilizadorRequest $request,  $id): RedirectResponse
    {
        $estabilizador = Estabilizador::find($id);
        $funcionario = Funcionario::find($id);
        $funcionario = Funcionario::find($estabilizador->funcionario_id);

        $funcionarioExistente = Funcionario::where('ci', $request->input('ci'))->first();

        if ($funcionarioExistente && $funcionarioExistente->id != $funcionario->id) {
        // Si el funcionario ya existe y no es el mismo, asigna el ID existente
        $estabilizador->funcionario_id = $funcionarioExistente->id;
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
            $estabilizador->funcionario_id = $funcionario->id;
        }
            $estabilizador->cargo = $request->input('cargo');
            $estabilizador->dependencia_id = $request->input('dependencia_id');
            $estabilizador->cod_gamea = $request->input('cod_gamea');
            $estabilizador->cod_registro = $request->input('cod_registro');
            $estabilizador->marca = $request->input('marca');
            $estabilizador->fecha = $request->input('fecha');
            $estabilizador->fecha_inicio = $request->input('fecha_inicio');
            $estabilizador->fecha_asignacion = $request->input('fecha_asignacion');
            $estabilizador->modelo = $request->input('modelo');
            $estabilizador->falla = $request->input('falla');
            $estabilizador->observaciones = $request->input('observaciones');
            $estabilizador->funcionario_activo = $request->input('funcionario_activo');
            $estabilizador->estado_id = $request->input('estado_id');
            $estabilizador->user_id = $request->input('user_id') ?: null;
            $estabilizador->save();

        return Redirect::route('estabilizadors.index')
        ->with('success', 'ACTUALIZADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    public function destroy($id): RedirectResponse
{
        Estabilizador::find($id)->delete();

    return Redirect::route('estabilizadors.index')
        ->with('success', 'ELIMINADO CON EXITO')
        ->with('icono', 'success');
}


     public function generarPdf($id)
    {
        $estabilizador = Estabilizador::findOrFail($id);
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LETTER', true, 'UTF-8', false);
        $pdf->SetTitle('Doc. ' . $estabilizador->funcionario?->ci);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->AddPage();
        $html = view('estabilizador.pdf', compact('estabilizador'))->render();
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
        if($estabilizador->funcionario_activo == 1){
        $datos = $estabilizador->funcionario?->grado_academico.' '.$estabilizador->funcionario?->nombre.' '. $estabilizador->funcionario?->paterno.' '.$estabilizador->funcionario?->materno . ' - ' . $estabilizador->funcionario?->ci.''.$estabilizador->funcionario?->expedido . ' - ' . $estabilizador->dependencia?->dependencias.' - SOPORTE TECNICO-GAMEA';
        }else{
        $datos = $estabilizador->funcionario?->grado_academico.' '.$estabilizador->funcionario?->nombre.' '. $estabilizador->funcionario?->paterno.' '.$estabilizador->funcionario?->materno . ' - ' . $estabilizador->funcionario?->ci.''.$estabilizador->funcionario?->expedido . ' - ' . $estabilizador->funcionario?->cargo.' - SOPORTE TECNICO-GAMEA';
        }
        $datos1 = $estabilizador->funcionario?->grado_academico.' '.$estabilizador->funcionario?->nombre.' '.$estabilizador->funcionario?->paterno.' '.$estabilizador->funcionario?->materno ;
        $datos2 = $estabilizador->funcionario?->ci.' '.$estabilizador->funcionario?->expedido ;
        $datos3 = $estabilizador->funcionario?->cargo; 
        $datos4 = $estabilizador->dependencia?->dependencias; 

        $pdf->write2DBarcode($datos, 'QRCODE,H', 165, 210, 45, 45, $style, 'N');
        $pdf->Text(20, 205, '');
        $pdf->SetY(-70); // establece la posición del cursor en la parte inferior de la página
        $pdf->Cell(0, 5, $datos1, 0, 1, 'C');
        $pdf->Cell(0, 5, $datos2, 0, 1, 'C');
        $pdf->Cell(0, 5, $datos3, 0, 1, 'C');
        $pdf->Cell(0, 5, $datos4, 0, 1, 'C');

        // GENERAR CONTENIDO
        $pdfContent = $pdf->Output('estabilizador.pdf', 'S');

        // RESPUESTA CORRECTA PARA MODAL (iframe)
        return response($pdfContent)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="estabilizador.pdf"');
        
    }


    private function armarDataestabilizador($equipo)
{
    return [
        'estabilizador' => $equipo,
        'qr' => $this->armarQrestabilizador($equipo),
        'footer' => [
            $this->nombreCompleto($equipo),
            $this->ciCompleto($equipo),
            $equipo->funcionario?->cargo,
            $equipo->dependencia?->dependencias
        ]
    ];
}
private function armarQrestabilizador($equipo)
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
    $equipo = Estabilizador::with(['funcionario', 'dependencia'])->findOrFail($id);

    $data = $this->armarDataestabilizador($equipo);

    $pdf = $service->generar($data, 'estabilizador.pdf');

    return response($pdf)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'inline; filename="estabilizador.pdf"');
}
    /**
     * 2. DESCARGA (attachment)
     */
public function descargar($id, EquipoPdfService $service)
{
    $equipo = Estabilizador::with(['funcionario', 'dependencia'])->findOrFail($id);

    $data = $this->armarDataestabilizador($equipo);

    $pdf = $service->generar($data, 'estabilizador.pdf');

    return response($pdf)
        ->header('Content-Disposition', 'attachment; filename="estabilizador.pdf"');
}

    /**
     * 3. ENVÍO (correo con adjunto)
     */
public function enviar($id, EquipoPdfService $service)
{
    $equipo = Estabilizador::with(['funcionario', 'dependencia'])->findOrFail($id);

    $data = $this->armarDataestabilizador($equipo);

    $pdf = $service->generar($data, 'estabilizador.pdf');

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
    private function obtenerCorreoDestino($estabilizador)
    {
        return $estabilizador->funcionario?->email;
    }


     // =========================
    // CCAMBIAR ESTADO Y ENVIAR ALERTA
    // =========================
    public function cambiarEstado(Request $request)
    {
        $estabilizador = Estabilizador::findOrFail($request->id);

        $estadoId = (int) $request->input('estado_id');

        // =========================
        // ACTUALIZAR ESTADO
        // =========================
        $estabilizador->estado_id = $estadoId;

        // Mapeo de fechas por estado
        $fechas = [
            2 => 'fecha_inicio',
            5 => 'fecha_entrega',
        ];

        $estabilizador->estado_id = $estadoId;

        if (isset($fechas[$estadoId])) {

            $campoFecha = $fechas[$estadoId];

            // Controla la fecha, NO el estado
            if (empty($estabilizador->$campoFecha)) {
                $estabilizador->$campoFecha = now();
            }
        }

        $estabilizador->save();

        // =========================
        // ENVÍO DE NOTIFICACIÓN
        // =========================
        if (in_array($estadoId, [3, 4])) {

            $this->notificacionService->enviar(
                $estabilizador->funcionario,
                $estadoId,
                $estabilizador
            );
        }

        // =========================
        // RESPUESTA
        // =========================
        return response()->json([
            'estado' => $estadoId == 5
                ? $estabilizador->resultado?->nombre
                : $estabilizador->estado?->nombre
        ]);
    }

    public function updateTecnico(Request $request, $id){

    $equipo = Estabilizador::findOrFail($id);
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

    return Redirect::route('estabilizadors.index')
        ->with('success', 'ASIGNADO CORRECTAMENTE') 
        ->with('text', 'Se ha enviado la notificación de asignación al técnico.')          
        ->with('icono', 'success');     
    }

    public function updateFecha(Request $request, $id){
        $estabilizador = Estabilizador::find($id);
        $estabilizador->fecha = $request->input('fecha');
        $estabilizador->boton_oculto = true;
        $estabilizador->update();
        return Redirect::route('estabilizadors.index')
        ->with('success', 'FECHA ACTUALIZADA CORRECTAMENTE')         
        ->with('text', 'Se actualizo a la fecha de hoy')         
        ->with('icono', 'success');
    }

    public function search(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $estabilizador = Estabilizador::whereBetween('fecha', [$start_date, $end_date])->get();
        if ($estabilizador->isEmpty()) {
            return Redirect::route('reportes')
            ->with('success', 'ERROR')         
            ->with('icono', 'error')
            ->with('text', 'No se encontraron resultados');

        }else{
            return view('reportes.estabilizador.resFechaEstabilizador', compact('estabilizador', 'start_date', 'end_date'));
        }
    }

    public function fechaPdf(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $estabilizador = Estabilizador::whereBetween('fecha', [$start_date, $end_date])->get();
        $pdf = Pdf::setPaper('letter') ->loadView('reportes.estabilizador.pdfFechaEstabilizador', compact('estabilizador', 'start_date', 'end_date'));
        return $pdf->stream('estabilizador.pdf');
    }

    public function searchEstabilizador(Request $request)
    {
        $query = $request->input('query');
        
        $estabilizador = Estabilizador::where('cod_gamea', 'LIKE', "$query")->get();
        if ($estabilizador->isEmpty()) {
            return Redirect::route('reportes')
            ->with('success', 'DATOS INCORRECTOS')         
            ->with('icono', 'error')
            ->with('text', 'No se encontraron resultados');

        }else{
            return view('reportes.estabilizador.resEstabilizador', compact('estabilizador','query'));
        }
    
    }

    public function pdfEstabilizador(Request $request)
    {
        $query = $request->input('query');
        $estabilizador = Estabilizador::where('cod_gamea', 'LIKE', $query )
        ->get();
        $pdf = Pdf::setPaper('letter') ->loadView('reportes.estabilizador.pdfEstabilizador', compact('estabilizador', 'query'));
        return $pdf->stream('ReporteEstabilizador.pdf');
    }

    public function searchYearEstabilizador(Request $request)
    {
        $query = $request->input('query');
        
        $estabilizador = Estabilizador::whereYear('created_at', $query)->get();
        if ($estabilizador->isEmpty()) {
            return Redirect::route('reportes')
            ->with('success', 'DATOS INCORRECTOS')         
            ->with('icono', 'error')
            ->with('text', 'No se encontraron resultados');

        }else{
            return view('reportes.estabilizador.resYearEstabilizador', compact('estabilizador','query'));
        }
    
    }

    public function pdfYearEstabilizador(Request $request)
    {
        $query = $request->input('query');
        $estabilizador = Estabilizador::whereYear('created_at', $query)->get();

        $pdf = Pdf::setPaper('letter') ->loadView('reportes.estabilizador.pdfYearEstabilizador', compact('estabilizador', 'query'));
        return $pdf->stream('ReporteEstabilizador.pdf');
    }

    public function buscaEstabilizador(Request $request)
    {
        $query = $request->input('query');
        $datos = Estabilizador::where('cod_gamea', 'LIKE', $query)
         ->orderBy('id', 'desc') // o created_at
        ->get();
        return response()->json($datos);
    }

    public function resultadoEstabilizador(Request $request, $id)
    {
        $estabilizador = Estabilizador::find($id);
        $estabilizador->resultado_id = $request->input('tipo_informe');
        $estabilizador->update();

    }
}
