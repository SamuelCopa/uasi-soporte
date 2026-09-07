<?php

namespace App\Http\Controllers;

use App\Models\OtrosEquipo;
use App\Models\TiposEquipo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\equipoRequest;
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

class OtrosEquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
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
    $fechaFinPasada = Carbon::create($gestionPasada, 12, 31);
    $fechaInicioPasada = $fechaFinPasada->copy()->subDays(29);

    // Consulta base
    $query = OtrosEquipo::query();

    // Filtro de fechas
    $query->where(function ($query) use ($fechaInicioPasada, $fechaFinPasada) {
        $query->where(function ($q) use ($fechaInicioPasada, $fechaFinPasada) {
            $q->whereBetween('fecha', [
                $fechaInicioPasada,
                $fechaFinPasada
            ])
            ->where('estado_id', '!=', 5);
        })
        ->orWhereYear('fecha', date('Y'));
    });

    // FILTRO POR TIPO DE EQUIPO
    if ($request->filled('tipo_equipo_id')) {
        $query->where(
            'tipo_equipo_id',
            $request->tipo_equipo_id
        );
    }

    // Obtener registros
    $otrosEquipo = $query
        ->orderByDesc('fecha')
        ->paginate(20)
        ->withQueryString();

    // Datos para los formularios
    $tipoequipo = TiposEquipo::all();
    $estado = Estado::all();
    $dependencia = Dependencia::orderBy('dependencias', 'asc')->get();

    $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'Tecnico');
        })
        ->where('id_estadousuario', '1')
        ->orderBy('paterno', 'asc')
        ->get();

    return view('otros-equipo.index', compact('otrosEquipo','users', 'estado', 'dependencia', 'tipoequipo')
    )->with('i',
        ($request->input('page', 1) - 1)
        * $otrosEquipo->perPage()
    );
}


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $otrosEquipo = new OtrosEquipo();

        return view('otros-equipo.create', compact('otrosEquipo'));
    }

    /**
     * Store a newly created resource in storage.
     */


public function store(Request $request, CorrelativoService $correlativoService)
{
    $request->validate([
        'ci' => 'required',
        'celular' => 'required|string',
        'email' => 'required|string',
        'cod_gamea' => 'required|integer',
        'marca' => 'required|string',
        'modelo' => 'required|string',
        'falla' => 'required|string',

        // IMPORTANTE
        'tipo_equipo_id' => 'required|exists:tipos_equipos,id',

        'dependencia_id' => 'nullable|exists:dependencias,id',
        'observaciones' => 'nullable|string',
    ]);

    /*
    |--------------------------------------------------------------------------
    | REGISTRAR / ACTUALIZAR FUNCIONARIO
    |--------------------------------------------------------------------------
    */

    $funcionario = Funcionario::firstOrNew([
        'ci' => $request->ci
    ]);

    if (!$funcionario->exists) {

        if (empty($request->cargo)) {
            $funcionario->cargo = null;
            $funcionario->dependencia_id = null;
        }

        $funcionario->celular = $request->celular;
        $funcionario->email = $request->email;

    } else {

        if ($funcionario->celular != $request->celular) {
            $funcionario->celular = $request->celular;
        }

        if ($funcionario->email != $request->email) {
            $funcionario->email = $request->email;
        }
    }

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

    $funcionario->save();


    /*
    |--------------------------------------------------------------------------
    | REGISTRAR OTRO EQUIPO
    |--------------------------------------------------------------------------
    */

    $equipo = DB::transaction(function () use (
        $request,
        $funcionario,
        $correlativoService
    ) {

        $equipo = new OtrosEquipo();

        // FUNCIONARIO
        $equipo->funcionario_id = $funcionario->id;

        // TIPO DE EQUIPO
        $equipo->tipo_equipo_id = $request->input('tipo_equipo_id');

        // DATOS DEL SOLICITANTE
        $equipo->cargo = $request->input('cargo');
        $equipo->dependencia_id = $request->input('dependencia_id');

        // DATOS DEL EQUIPO
        $equipo->cod_gamea = $request->input('cod_gamea');

        // GENERAR CORRELATIVO
        $equipo->cod_registro =
            $correlativoService->generarNumeroRecepcion();

        $equipo->fecha = $request->input('fecha');
        $equipo->marca = $request->input('marca');
        $equipo->modelo = $request->input('modelo');
        $equipo->falla = $request->input('falla');
        $equipo->observaciones = $request->input('observaciones');

        // ESTADO
        $equipo->funcionario_activo =
            $request->input('funcionario_activo');

        $equipo->estado_id =
            $request->input('estado_id');

        // USUARIO QUE REGISTRA
        $equipo->reguser_id = Auth::id();

        $equipo->save();

        return $equipo;
    });


    /*
    |--------------------------------------------------------------------------
    | REDIRECCIÓN
    |--------------------------------------------------------------------------
    */

    return redirect()
        ->route('otros-equipos.index')
        ->with('success', 'REGISTRADO CORRECTAMENTE')
        ->with(
            'text',
            'Número de recepción: ' . $equipo->cod_registro
        )
        ->with('icono', 'success');
}

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $otrosEquipo = OtrosEquipo::find($id);

        return view('otros-equipo.show', compact('otrosEquipo'));
    }

    /**
     * Show the form for editing the specified resource.
     * 
     */
    public function edit($id): View
    {
        $otrosEquipo = OtrosEquipo::find($id);

        return view('otros-equipo.edit', compact('otrosEquipo'));
    }

        public function update(Request $request,  $id): RedirectResponse
    {
        $equipo = OtrosEquipo::find($id);
        $funcionario = Funcionario::find($id);
        $funcionario = Funcionario::find($equipo->funcionario_id);

        $funcionarioExistente = Funcionario::where('ci', $request->input('ci'))->first();

        if ($funcionarioExistente && $funcionarioExistente->id != $funcionario->id) {
        // Si el funcionario ya existe y no es el mismo, asigna el ID existente
        $equipo->funcionario_id = $funcionarioExistente->id;
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
            $equipo->funcionario_id = $funcionario->id;
        }
            $equipo->cargo = $request->input('cargo');
            $equipo->dependencia_id = $request->input('dependencia_id');
            $equipo->cod_gamea = $request->input('cod_gamea');
            $equipo->cod_registro = $request->input('cod_registro');
            $equipo->marca = $request->input('marca');
            $equipo->fecha = $request->input('fecha');
            $equipo->fecha_asignacion = $request->input('fecha_asignacion');
            $equipo->fecha_inicio = $request->input('fecha_inicio');
            $equipo->modelo = $request->input('modelo');
            $equipo->falla = $request->input('falla');
            $equipo->observaciones = $request->input('observaciones');
            $equipo->funcionario_activo = $request->input('funcionario_activo');
            $equipo->estado_id = $request->input('estado_id');
            $equipo->user_id = $request->input('user_id') ?: null;
            $equipo->save();

        return Redirect::route('otros-equipos.index')
        ->with('success', 'ACTUALIZADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }


    public function destroy($id): RedirectResponse
    {
        OtrosEquipo::find($id)->delete();

        return Redirect::route('otros-equipos.index')
            ->with('success', 'OtrosEquipo deleted successfully');
    }

public function updateTecnico(Request $request, $id)
{
    $equipo = OtrosEquipo::with('tipoEquipo')->findOrFail($id);

    $equipo->user_id = $request->input('user_id');
    $equipo->fecha_asignacion = $request->input('fecha_asignacion');
    $equipo->save();

    // Obtener usuario (técnico)
    $user = $equipo->user;

    // Enviar correo
    if ($user?->email) {
        Mail::to($user->email)
            ->send(new TecnicoAsignado($equipo, $user));
    }

return back()
    ->with('success', 'ASIGNADO CORRECTAMENTE')
    ->with('text', 'Se ha enviado la notificación de asignación al técnico.')
    ->with('icono', 'success');
}


    public function generarPdf($id)
    {
         $equipo = OtrosEquipo::with('tipoEquipo')->findOrFail($id);
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LETTER', true, 'UTF-8', false);
        $pdf->SetTitle('Doc. ' . $equipo->funcionario?->ci);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->AddPage();
        $html = view('otros-equipo.pdf', compact('equipo'))->render();
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
if ($equipo->funcionario_activo == 1) {

    $datos = $equipo->funcionario?->grado_academico . ' ' .
             $equipo->funcionario?->nombre . ' ' .
             $equipo->funcionario?->paterno . ' ' .
             $equipo->funcionario?->materno .
             ' - ' .
             $equipo->funcionario?->ci . ' ' .
             $equipo->funcionario?->expedido .
             ' - ' .
             ($equipo->dependencia?->dependencias ?? 'SIN DEPENDENCIA') .
             ' - SOPORTE TECNICO-GAMEA';

} else {

    $datos = $equipo->funcionario?->grado_academico . ' ' .
             $equipo->funcionario?->nombre . ' ' .
             $equipo->funcionario?->paterno . ' ' .
             $equipo->funcionario?->materno .
             ' - ' .
             $equipo->funcionario?->ci . ' ' .
             $equipo->funcionario?->expedido .
             ' - ' .
             ($equipo->funcionario?->cargo ?? 'SIN CARGO') .
             ' - SOPORTE TECNICO-GAMEA';
}

$datos1 = trim(
    ($equipo->funcionario?->grado_academico ?? '') . ' ' .
    ($equipo->funcionario?->nombre ?? '') . ' ' .
    ($equipo->funcionario?->paterno ?? '') . ' ' .
    ($equipo->funcionario?->materno ?? '')
);

$datos2 = ($equipo->funcionario?->ci ?? '') . ' ' .
          ($equipo->funcionario?->expedido ?? '');

$datos3 = $equipo->funcionario?->cargo ?? 'SIN CARGO';

$datos4 = $equipo->dependencia?->dependencias ?? 'SIN DEPENDENCIA';

        $pdf->write2DBarcode($datos, 'QRCODE,H', 165, 210, 45, 45, $style, 'N');
        $pdf->Text(20, 205, '');
        $pdf->SetY(-70); // establece la posición del cursor en la parte inferior de la página
        $pdf->Cell(0, 5, $datos1, 0, 1, 'C');
        $pdf->Cell(0, 5, $datos2, 0, 1, 'C');
        $pdf->Cell(0, 5, $datos3, 0, 1, 'C');
        $pdf->MultiCell(0, 5, $datos4, 0, 'C', false, 1);

        $pdfContent = $pdf->Output('otros-equipo.pdf', 'S');

        // RESPUESTA CORRECTA PARA MODAL (iframe)
        return response($pdfContent)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="equipo.pdf"');
        
    }


    private function armarDataequipo($equipo)
{
    return [
        'equipo' => $equipo,
        'qr' => $this->armarQrequipo($equipo),
        'footer' => [
            $this->nombreCompleto($equipo),
            $this->ciCompleto($equipo),
            $equipo->funcionario?->cargo,
            $equipo->dependencia?->dependencias
        ]
    ];
}
private function armarQrequipo($equipo)
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
    $equipo = OtrosEquipo::with(['funcionario', 'dependencia'])->findOrFail($id);

    $data = $this->armarDataequipo($equipo);

    $pdf = $service->generar($data, 'equipo.pdf');

    return response($pdf)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'inline; filename="equipo.pdf"');
}
    /**
     * 2. DESCARGA (attachment)
     */
public function descargar($id, EquipoPdfService $service)
{
    $equipo = OtrosEquipo::with(['funcionario', 'dependencia'])->findOrFail($id);

    $data = $this->armarDataequipo($equipo);

    $pdf = $service->generar($data, 'otros-equipo.pdf');

    return response($pdf)
        ->header('Content-Disposition', 'attachment; filename="equipo.pdf"');
}

    /**
     * 3. ENVÍO (correo con adjunto)
     */
public function enviar($id, EquipoPdfService $service)
{
    $equipo = OtrosEquipo::with(['funcionario', 'dependencia'])->findOrFail($id);

    $data = $this->armarDataequipo($equipo);

    $pdf = $service->generar($data, 'otros-equipo.pdf');

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
    private function obtenerCorreoDestino($equipo)
    {
        return $equipo->funcionario?->email;
    }

// ===========CAMBIAR ESTADO Y ENVIAR ALERTA==================
    public function cambiarEstado(Request $request)
    {
        $equipo = OtrosEquipo::findOrFail($request->id);

        $estadoId = (int) $request->input('estado_id');

        // =========================
        // ACTUALIZAR ESTADO
        // =========================
        $equipo->estado_id = $estadoId;

        // Mapeo de fechas por estado
        $fechas = [
            2 => 'fecha_inicio',
            5 => 'fecha_entrega',
        ];

        $equipo->estado_id = $estadoId;

        if (isset($fechas[$estadoId])) {

            $campoFecha = $fechas[$estadoId];

            // Controla la fecha, NO el estado
            if (empty($equipo->$campoFecha)) {
                $equipo->$campoFecha = now();
            }
        }

        $equipo->save();

        // =========================
        // ENVÍO DE NOTIFICACIÓN
        // =========================
        if (in_array($estadoId, [3, 4])) {

            $this->notificacionService->enviar(
                $equipo->funcionario,
                $estadoId,
                $equipo
            );
        }

        // =========================
        // RESPUESTA
        // =========================
        return response()->json([
            'estado' => $estadoId == 5
                ? $equipo->resultado?->nombre
                : $equipo->estado?->nombre
        ]);
    }

public function filtrar(Request $request)
{
    $tipoEquipoId = $request->tipo_equipo_id;

    $equipos = OtrosEquipo::with([
        'tipoEquipo',
        'estado'
    ])
    ->when($tipoEquipoId, function ($query) use ($tipoEquipoId) {
        $query->where('tipo_equipo_id', $tipoEquipoId);
    })
    ->get();

    return response()->json($equipos);
}

public function porTipo($tipo)
{
    $equipos = OtrosEquipo::with([
        'tipoEquipo',
        'estado'
    ])
    ->where('tipo_equipo_id', $tipo)
    ->get();

    return response()->json($equipos);
}

    public function buscarEquipo(Request $request)
    {
        $query = $request->input('query');
        $datos = OtrosEquipo::where('cod_gamea', 'LIKE', $query)
         ->orderBy('id', 'desc') // o created_at
        ->get();
        return response()->json($datos);
    }

    public function search(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $equipos = OtrosEquipo::whereBetween('fecha', [$start_date, $end_date])->get();
        if ($equipos->isEmpty()) {
            return Redirect::route('reportes')
            ->with('success', 'ERROR')         
            ->with('icono', 'error')
            ->with('text', 'No se encontraron resultados');

        }else{
            return view('reportes.equipo.resFechaEquipo', compact('equipos', 'start_date', 'end_date'));
        }
    }

    public function fechaPdf(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $equipos = OtrosEquipo::whereBetween('fecha', [$start_date, $end_date])->get();
        $pdf = Pdf::setPaper('letter') ->loadView('reportes.equipo.pdfFechaEquipo', compact('equipos', 'start_date', 'end_date'));
        return $pdf->stream('equipo.pdf');
    }

    public function searchEquipo(Request $request)
    {
        $query = $request->input('query');
        
        $equipos = OtrosEquipo::where('cod_gamea', 'LIKE', "$query")
        ->get();
        if ($equipos->isEmpty()) {
            return Redirect::route('reportes')
            ->with('success', 'DATOS INCORRECTOS')         
            ->with('icono', 'error')
            ->with('text', 'No se encontraron resultados');

        }else{
            return view('reportes.equipo.resEquipo', compact('equipos','query'));
        }
    }

    public function pdfEquipo(Request $request)
    {
        $query = $request->input('query');
        $equipos = OtrosEquipo::where('cod_gamea', 'LIKE', $query )
        ->get();
        $pdf = Pdf::setPaper('letter') ->loadView('reportes.equipo.pdfEquipo', compact('equipos', 'query'));
        return $pdf->stream('equipo.pdf');
    }

    public function searchYearEquipo(Request $request)
    {
        $query = $request->input('query');
        
        $equipos = OtrosEquipo::whereYear('created_at', $query)->get();

        if ($equipos->isEmpty()) {
            return Redirect::route('reportes')
            ->with('success', 'DATOS INCORRECTOS')         
            ->with('icono', 'error')
            ->with('text', 'No se encontraron resultados');

        }else{
            return view('reportes.equipo.resYearEquipo', compact('equipos','query'));
        }
    }

    public function pdfYearEquipo(Request $request)
    {
        $query = $request->input('query');
        $equipos = OtrosEquipo::whereYear('created_at', $query)->get();

        $pdf = Pdf::setPaper('letter') ->loadView('reportes.equipo.pdfYearEquipo', compact('equipos', 'query'));
        return $pdf->stream('equipo.pdf');
    }

}
