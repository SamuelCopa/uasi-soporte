<?php

namespace App\Http\Controllers;

use App\Models\Raton;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\RatonRequest;
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
class RatonController extends Controller
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
        $ratons = Raton::where(function ($query) use ($fechaInicioPasada, $fechaFinPasada) {
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

        return view('raton.index', compact('ratons','users','estado','dependencia'))
            ->with('i', ($request->input('page', 1) - 1) * $ratons->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $raton = new Raton();
        $estado=Estado::all();
        $dependencia = Dependencia::orderBy('dependencias', 'asc')->get();
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'Tecnico');
        })->where('id_estadousuario', '1')->get();  

        return view('raton.create', compact('raton','estado','dependencia','users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RatonRequest $request): RedirectResponse
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

        $raton = new Raton();
        $raton->funcionario_id = $funcionario->id;
        $raton->dependencia_id = $request->input('dependencia_id');
        $raton->cargo = $request->input('cargo');
        $raton->cod_gamea = $request->input('cod_gamea');
        $raton->cod_registro = $request->input('cod_registro');
        $raton->marca = $request->input('marca');
        $raton->fecha = $request->input('fecha');
        $raton->modelo = $request->input('modelo');
        $raton->falla = $request->input('falla');
        $raton->observaciones = $request->input('observaciones');
        $raton->estado_id = $request->input('estado_id');
        $raton->reguser_id = Auth::id();
        $raton->save();
        return Redirect::route('ratons.index')
        ->with('success', 'REGISTRADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $raton = Raton::find($id);

        return view('raton.show', compact('raton'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $raton = Raton::find($id);
        $estado=Estado::all();
        $dependencia = Dependencia::orderBy('dependencias', 'asc')->get();
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'Tecnico');
        })->where('id_estadousuario', '1')->orderBy('paterno', 'asc')->get();  

        return view('raton.edit', compact('raton','estado','dependencia','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RatonRequest $request,  $id): RedirectResponse
    {
        $raton = Raton::find($id);
        $funcionario = Funcionario::find($id);
        $funcionario = Funcionario::find($raton->funcionario_id);

        $funcionarioExistente = Funcionario::where('ci', $request->input('ci'))->first();

        if ($funcionarioExistente && $funcionarioExistente->id != $funcionario->id) {
        // Si el funcionario ya existe y no es el mismo, asigna el ID existente
        $raton->funcionario_id = $funcionarioExistente->id;
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
            $funcionario->cargo = $request->input('cargo');
            $funcionario->email = $request->input('email');
            $funcionario->celular = $request->input('celular');
            $funcionario->dependencia_id = $request->input('dependencia_id');
            $funcionario->save();
            $raton->funcionario_id = $funcionario->id;
        }
            $raton->dependencia_id = $request->input('dependencia_id');
            $raton->cargo = $request->input('cargo');
            $raton->cod_gamea = $request->input('cod_gamea');
            $raton->cod_registro = $request->input('cod_registro');
            $raton->marca = $request->input('marca');
            $raton->fecha = $request->input('fecha');
            $raton->fecha_asignacion = $request->input('fecha_asignacion');
            $raton->fecha_inicio = $request->input('fecha_inicio');
            $raton->modelo = $request->input('modelo');
            $raton->falla = $request->input('falla');
            $raton->observaciones = $request->input('observaciones');
            $raton->funcionario_activo = $request->input('funcionario_activo');
            $raton->estado_id = $request->input('estado_id');
            $raton->user_id = $request->input('user_id') ?: null;
            $raton->save();

        return Redirect::route('ratons.index')
        ->with('success', 'ACTUALIZADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    public function destroy($id): RedirectResponse
    {
        Raton::find($id)->delete();

        return Redirect::route('ratons.index')
        ->with('success', 'ELIMINADO CON EXITO')
        ->with('icono', 'success');
    }

    public function generarPdf($id)
    {
        $raton = Raton::findOrFail($id);
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LETTER', true, 'UTF-8', false);
        $pdf->SetTitle('Doc. ' . $raton->funcionario->ci);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->AddPage();
        $html = view('raton.pdf', compact('raton'))->render();
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
        if($raton->funcionario_activo == 1){
        $datos = $raton->funcionario?->grado_academico.' '.$raton->funcionario?->nombre.' '.$raton->funcionario?->paterno.' '.$raton->funcionario?->materno. ' - ' . $raton->funcionario?->ci.''. $raton->funcionario?->expedido . ' - ' . $raton->dependencia?->dependencias.' - SOPORTE TECNICO-GAMEA';
        }else{
        $datos = $raton->funcionario?->grado_academico.' '.$raton->funcionario?->nombre .' '.$raton->funcionario?->paterno.' '.$raton->funcionario?->materno. ' - ' . $raton->funcionario?->ci.''. $raton->funcionario?->expedido  . ' - ' .$raton->funcionario?->cargo.' - SOPORTE TECNICO-GAMEA';
        }
        $datos1 = $raton->funcionario?->grado_academico.' '.$raton->funcionario?->nombre.' '.$raton->funcionario?->paterno.' '.$raton->funcionario?->materno ;
        $datos2 = $raton->funcionario?->ci.' '.$raton->funcionario?->expedido ;
        $datos3 = $raton->funcionario?->cargo; 
        $datos4 = $raton->dependencia?->dependencias; 

        $pdf->write2DBarcode($datos, 'QRCODE,H', 165, 210, 45, 45, $style, 'N');
        $pdf->Text(20, 205, '');
        $pdf->SetY(-70); // establece la posición del cursor en la parte inferior de la página
        $pdf->Cell(0, 5, $datos1, 0, 1, 'C');
        $pdf->Cell(0, 5, $datos2, 0, 1, 'C');
        $pdf->Cell(0, 5, $datos3, 0, 1, 'C');
        $pdf->Cell(0, 5, $datos4, 0, 1, 'C');

        $pdfContent = $pdf->Output('raton.pdf', 'S');

        // RESPUESTA CORRECTA PARA MODAL (iframe)
        return response($pdfContent)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="raton.pdf"');
        
    }


    private function armarDataraton($equipo)
{
    return [
        'raton' => $equipo,
        'qr' => $this->armarQrraton($equipo),
        'footer' => [
            $this->nombreCompleto($equipo),
            $this->ciCompleto($equipo),
            $equipo->funcionario?->cargo,
            $equipo->dependencia?->dependencias
        ]
    ];
}
private function armarQrraton($equipo)
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
    $equipo = Raton::with(['funcionario', 'dependencia'])->findOrFail($id);

    $data = $this->armarDataraton($equipo);

    $pdf = $service->generar($data, 'raton.pdf');

    return response($pdf)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'inline; filename="raton.pdf"');
}
    /**
     * 2. DESCARGA (attachment)
     */
public function descargar($id, EquipoPdfService $service)
{
    $equipo = Raton::with(['funcionario', 'dependencia'])->findOrFail($id);

    $data = $this->armarDataraton($equipo);

    $pdf = $service->generar($data, 'raton.pdf');

    return response($pdf)
        ->header('Content-Disposition', 'attachment; filename="mouse.pdf"');
}

    /**
     * 3. ENVÍO (correo con adjunto)
     */
public function enviar($id, EquipoPdfService $service)
{
    $equipo = Raton::with(['funcionario', 'dependencia'])->findOrFail($id);

    $data = $this->armarDataraton($equipo);

    $pdf = $service->generar($data, 'raton.pdf');

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
    private function obtenerCorreoDestino($raton)
    {
        return $raton->funcionario?->email;
    }

// ===========CAMBIAR ESTADO Y ENVIAR ALERTA==================

    public function cambiarEstado(Request $request)
    {
        $mouse = Raton::findOrFail($request->id);

        $estadoId = (int) $request->input('estado_id');

        // =========================
        // ACTUALIZAR ESTADO
        // =========================
        $mouse->estado_id = $estadoId;

        // Mapeo de fechas por estado
        $fechas = [
            2 => 'fecha_inicio',
            5 => 'fecha_entrega',
        ];

        $mouse->estado_id = $estadoId;

        if (isset($fechas[$estadoId])) {

            $campoFecha = $fechas[$estadoId];

            // Controla la fecha, NO el estado
            if (empty($mouse->$campoFecha)) {
                $mouse->$campoFecha = now();
            }
        }

        $mouse->save();

        // =========================
        // ENVÍO DE NOTIFICACIÓN
        // =========================
        if (in_array($estadoId, [2, 3, 4])) {

            $this->notificacionService->enviar(
                $mouse->funcionario,
                $estadoId,
                $mouse
            );
        }

        // =========================
        // RESPUESTA
        // =========================
        return response()->json([
            'estado' => $estadoId == 5
                ? $mouse->resultado?->nombre
                : $mouse->estado?->nombre
        ]);
    }

    public function updateRecepcion(Request $request, $id){
    $request->validate([
        'cod_registro' => [
            'nullable',
            function ($attribute, $value, $fail) {

                if (empty($value)) {
                    return;
                }

                $anio = date('Y');

                $tablas = [
                    'registro_cpus'   => 'CPU',
                    'monitors'        => 'Monitor',
                    'impresoras'      => 'Impresora',
                    'laptops'         => 'Laptop',
                    'teclados'        => 'Teclado',
                    'ratons'          => 'Mouse',
                    'upeses'          => 'UPS',
                    'parlantes'       => 'Parlante',
                    'audifonos'       => 'Audífono',
                    'estabilizadors'  => 'Estabilizador',
                ];

                foreach ($tablas as $tabla => $nombre) {

                    $existe = DB::table($tabla)
                        ->where('cod_registro', $value)
                        ->whereYear('created_at', $anio)
                        ->exists();

                    if ($existe) {
                        $fail("El número de recepción ya está asignado a un {$nombre} en la gestión actual.");
                        return;
                    }
                }
            },
        ],
    ]);
        $mouse = Raton::find($id);
        $mouse->cod_registro = $request->input('cod_registro');
        $mouse->update();
        return Redirect::route('ratons.index')
        ->with('success', 'REGISTRADO CORRECTAMENTE') 
        ->with('text', 'Numero de recepción')          
        ->with('icono', 'success');
    }

    public function updateTecnico(Request $request, $id){

    $equipo = Raton::findOrFail($id);
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

    return Redirect::route('ratons.index')
        ->with('success', 'ASIGNADO CORRECTAMENTE') 
        ->with('text', 'Se ha enviado la notificación de asignación al técnico.')          
        ->with('icono', 'success');   
    }

    public function updateFecha(Request $request, $id){
        $mouse = Raton::find($id);
        $mouse->fecha = $request->input('fecha');
        $mouse->boton_oculto = true;
        $mouse->update();
        return Redirect::route('ratons.index')
        ->with('success', 'FECHA ACTUALIZADA CORRECTAMENTE')         
        ->with('text', 'Se actualizo a la fecha de hoy')         
        ->with('icono', 'success');
    }

    public function search(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $mouse = Raton::whereBetween('fecha', [$start_date, $end_date])->get();
        if ($mouse->isEmpty()) {
            return Redirect::route('reportes')
            ->with('success', 'ERROR')         
            ->with('icono', 'error')
            ->with('text', 'No se encontraron resultados');

        }else{
            return view('reportes.mouse.resFechaMouse', compact('mouse', 'start_date', 'end_date'));
        }
    }

    public function fechaPdf(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $mouse = Raton::whereBetween('fecha', [$start_date, $end_date])->get();
        $pdf = Pdf::setPaper('letter') ->loadView('reportes.mouse.pdfFechaMouse', compact('mouse', 'start_date', 'end_date'));
        return $pdf->stream('mouse.pdf');
    }

    public function searchMouse(Request $request)
    {
        $query = $request->input('query');
        
        $mouse = Raton::where('cod_gamea', 'LIKE', "$query")
        ->get();
        if ($mouse->isEmpty()) {
            return Redirect::route('reportes')
            ->with('success', 'DATOS INCORRECTOS')         
            ->with('icono', 'error')
            ->with('text', 'No se encontraron resultados');

        }else{
            return view('reportes.mouse.resMouse', compact('mouse','query'));
        }
    }

    public function pdfMouse(Request $request)
    {
        $query = $request->input('query');
        $mouse = Raton::where('cod_gamea', 'LIKE', $query )
        ->get();
        $pdf = Pdf::setPaper('letter') ->loadView('reportes.mouse.pdfMouse', compact('mouse', 'query'));
        return $pdf->stream('mouse.pdf');
    }

    public function searchYearMouse(Request $request)
    {
        $query = $request->input('query');
        
        $mouse = Raton::whereYear('created_at', $query)->get();

        if ($mouse->isEmpty()) {
            return Redirect::route('reportes')
            ->with('success', 'DATOS INCORRECTOS')         
            ->with('icono', 'error')
            ->with('text', 'No se encontraron resultados');

        }else{
            return view('reportes.mouse.resYearMouse', compact('mouse','query'));
        }
    }

    public function pdfYearMouse(Request $request)
    {
        $query = $request->input('query');
        $mouse = Raton::whereYear('created_at', $query)->get();

        $pdf = Pdf::setPaper('letter') ->loadView('reportes.mouse.pdfYearMouse', compact('mouse', 'query'));
        return $pdf->stream('mouse.pdf');
    }

    public function buscaMouse(Request $request)
    {
        $query = $request->input('query');
        $datos = Raton::where('cod_gamea', 'LIKE', $query)
         ->orderBy('id', 'desc') // o created_at
        ->get();
        return response()->json($datos);
    }
}
