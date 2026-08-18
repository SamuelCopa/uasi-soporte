<?php

namespace App\Http\Controllers;

use App\Models\Impresora;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ImpresoraRequest;
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
class ImpresoraController extends Controller
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
        $impresoras = Impresora::where(function ($query) use ($fechaInicioPasada, $fechaFinPasada) {
            $query->whereBetween('fecha', [$fechaInicioPasada, $fechaFinPasada])
            ->where('estado_id', '!=', 5);
        })
        ->orWhereYear('fecha', date('Y'))
        ->orderByDesc('fecha')
        ->paginate();
        $dependencia = Dependencia::orderBy('dependencias', 'asc')->get();
        $estado=Estado::all()->except(6);
        $funcionario=Funcionario::all();
        $users = User::whereHas('roles', function ($query) {$query->where('name', 'Tecnico');
        })->where('id_estadousuario', '1')->orderBy('paterno', 'asc')->get();

        return view('impresora.index', compact('impresoras','users','estado','dependencia','funcionario'))
            ->with('i', ($request->input('page', 1) - 1) * $impresoras->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $impresora = new Impresora();
        $estado=Estado::all()->except(6);
        $funcionario = Funcionario::all();
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'Tecnico');
        })->where('id_estadousuario', '1')->get();   
        $dependencia = Dependencia::orderBy('dependencias', 'asc')->get();
        return view('impresora.create', compact('impresora','estado','dependencia','users', 'funcionario'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ImpresoraRequest $request)
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

        $impresora = new Impresora();
        $impresora->funcionario_id = $funcionario->id;
        $impresora->dependencia_id = $request->input('dependencia_id');
        $impresora->cargo = $request->input('cargo');
        $impresora->cod_gamea = $request->input('cod_gamea');
        $impresora->marca = $request->input('marca');
        $impresora->fecha = $request->input('fecha');
        $impresora->modelo = $request->input('modelo');
        $impresora->falla = $request->input('falla');
        $impresora->observaciones = $request->input('observaciones');
        $impresora->estado_id = $request->input('estado_id');
        $impresora->funcionario_activo = $request->input('funcionario_activo');
        $impresora->reguser_id = Auth::id();
        $impresora->save();
        return Redirect::route('impresoras.index')
        ->with('success', 'CREADO CORRECTAMENTE.')
        ->with('icono', 'success'); 

    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $impresora = Impresora::find($id);
        return view('impresora.show', compact('impresora','users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $impresora = Impresora::find($id);
        $funcionario = Funcionario::find($id);
        $estado=Estado::all()->except(6);
        $users = User::whereHas('roles', function ($query) {
        $query->where('name', 'Tecnico');
        })->where('id_estadousuario', '1')->orderBy('paterno', 'asc')->get(); 
        $dependencia = Dependencia::orderBy('dependencias', 'asc')->get();

        return view('impresora.edit', compact('impresora','estado','dependencia','users', 'funcionario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {   
        $impresora = Impresora::find($id);
        $funcionario = Funcionario::find($id);
        $funcionario = Funcionario::find($impresora->funcionario_id);

        $funcionarioExistente = Funcionario::where('ci', $request->input('ci'))->first();

        if ($funcionarioExistente && $funcionarioExistente->id != $funcionario->id) {
        // Si el funcionario ya existe y no es el mismo, asigna el ID existente
        $impresora->funcionario_id = $funcionarioExistente->id;
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
            $impresora->funcionario_id = $funcionario->id;
        }
            $impresora->dependencia_id = $request->input('dependencia_id');
            $impresora->cargo = $request->input('cargo');
            $impresora->cod_gamea = $request->input('cod_gamea');
            $impresora->cod_registro = $request->input('cod_registro');
            $impresora->marca = $request->input('marca');
            $impresora->fecha = $request->input('fecha');
            $impresora->fecha_asignacion = $request->input('fecha_asignacion');
            $impresora->fecha_inicio = $request->input('fecha_inicio');
            $impresora->modelo = $request->input('modelo');
            $impresora->falla = $request->input('falla');
            $impresora->observaciones = $request->input('observaciones');
            $impresora->funcionario_activo = $request->input('funcionario_activo');
            $impresora->estado_id = $request->input('estado_id');
            $impresora->user_id = $request->input('user_id') ?: null;
            $impresora->save();

        return Redirect::route('impresoras.index')
        ->with('success', 'ACTUALIZADO CORRECTAMENTE')         
        ->with('icono', 'success');      
    }

    public function destroy($id): RedirectResponse
    {
        Impresora::find($id)->delete();
        
        return Redirect::route('impresoras.index')
            ->with('success', 'ELIMINADO CON EXITO')
            ->with('icono', 'success');
    }

    public function generarPdf($id)
    {
        $impresora = Impresora::findOrFail($id);
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LETTER', true, 'UTF-8', false);
        $pdf->SetTitle('Doc. ' . $impresora->funcionario->ci);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->AddPage();
        $html = view('impresora.pdf', compact('impresora'))->render();
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
        if($impresora->funcionario_activo == 1){
        $datos = $impresora->funcionario?->nombre.' '.$impresora->funcionario?->paterno.' '.$impresora->funcionario?->materno. ' - ' . $impresora->funcionario?->ci.''.$impresora->funcionario?->expedido  . ' - ' . $impresora->dependencia->dependencias.' - SOPORTE TECNICO-GAMEA';
        }else{
        $datos = $impresora->funcionario?->nombre .' '.$impresora->funcionario?->paterno.' '.$impresora->funcionario?->materno. ' - ' . $impresora->funcionario?->ci.''.$impresora->funcionario?->expedido  . ' - ' .$impresora->funcionario?->cargo.' - SOPORTE TECNICO-GAMEA';
        }
        $datos1 = $impresora->funcionario?->nombre.' '.$impresora->funcionario?->paterno.' '.$impresora->funcionario?->materno ;
        $datos2 = $impresora->funcionario?->ci.' '.$impresora->funcionario?->expedido ;
        $datos3 = $impresora->funcionario?->cargo; 
        $datos4 = $impresora->dependencia?->dependencias; 

        $pdf->write2DBarcode($datos, 'QRCODE,H', 165, 210, 45, 45, $style, 'N');
        $pdf->Text(20, 205, '');
        $pdf->SetY(-70); // establece la posición del cursor en la parte inferior de la página
        $pdf->Cell(0, 5, $datos1, 0, 1, 'C');
        $pdf->Cell(0, 5, $datos2, 0, 1, 'C');
        $pdf->Cell(0, 5, $datos3, 0, 1, 'C');
        if($impresora->funcionario_activo == 1){
        $pdf->Cell(0, 5, $datos4, 0, 1, 'C');
        }

        $pdfContent = $pdf->Output('impresora.pdf', 'S');

        // RESPUESTA CORRECTA PARA MODAL (iframe)
        return response($pdfContent)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="impresora.pdf"');
        
    }


    private function armarDataimpresora($equipo)
{
    return [
        'impresora' => $equipo,
        'qr' => $this->armarQrimpresora($equipo),
        'footer' => [
            $this->nombreCompleto($equipo),
            $this->ciCompleto($equipo),
            $equipo->funcionario?->cargo,
            $equipo->dependencia?->dependencias
        ]
    ];
}
private function armarQrimpresora($equipo)
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
    $equipo = Impresora::with(['funcionario', 'dependencia'])->findOrFail($id);

    $data = $this->armarDataimpresora($equipo);

    $pdf = $service->generar($data, 'impresora.pdf');

    return response($pdf)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'inline; filename="impresora.pdf"');
}
    /**
     * 2. DESCARGA (attachment)
     */
public function descargar($id, EquipoPdfService $service)
{
    $equipo = Impresora::with(['funcionario', 'dependencia'])->findOrFail($id);

    $data = $this->armarDataimpresora($equipo);

    $pdf = $service->generar($data, 'impresora.pdf');

    return response($pdf)
        ->header('Content-Disposition', 'attachment; filename="impresora.pdf"');
}

    /**
     * 3. ENVÍO (correo con adjunto)
     */
public function enviar($id, EquipoPdfService $service)
{
    $equipo = Impresora::with(['funcionario', 'dependencia'])->findOrFail($id);

    $data = $this->armarDataimpresora($equipo);

    $pdf = $service->generar($data, 'impresora.pdf');

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
    private function obtenerCorreoDestino($impresora)
    {
        return $impresora->funcionario?->email;
    }

// ===========CAMBIAR ESTADO Y ENVIAR ALERTA==================
    public function cambiarEstado(Request $request)
    {
        $impresora = Impresora::findOrFail($request->id);

        $estadoId = (int) $request->input('estado_id');

        // =========================
        // ACTUALIZAR ESTADO
        // =========================
        $impresora->estado_id = $estadoId;

        // Mapeo de fechas por estado
        $fechas = [
            2 => 'fecha_inicio',
            5 => 'fecha_entrega',
        ];

        $impresora->estado_id = $estadoId;

        if (isset($fechas[$estadoId])) {

            $campoFecha = $fechas[$estadoId];

            // Controla la fecha, NO el estado
            if (empty($impresora->$campoFecha)) {
                $impresora->$campoFecha = now();
            }
        }

        $impresora->save();

        // =========================
        // ENVÍO DE NOTIFICACIÓN
        // =========================
        if (in_array($estadoId, [2, 3, 4])) {

            $this->notificacionService->enviar(
                $impresora->funcionario,
                $estadoId,
                $impresora
            );
        }

        // =========================
        // RESPUESTA
        // =========================
        return response()->json([
            'estado' => $estadoId == 5
                ? $impresora->resultado?->nombre
                : $impresora->estado?->nombre
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
        $impresora = Impresora::find($id);
        $impresora->cod_registro = $request->input('cod_registro');
        $impresora->update();
        return Redirect::route('impresoras.index')
        ->with('success', 'REGISTRADO CORRECTAMENTE') 
        ->with('text', 'Numero de recepción')          
        ->with('icono', 'success');
    }

    public function updateTecnico(Request $request, $id){

    $equipo = Impresora::findOrFail($id);
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

    return Redirect::route('impresoras.index')
        ->with('success', 'ASIGNADO CORRECTAMENTE') 
        ->with('text', 'Se ha enviado la notificación de asignación al técnico.')          
        ->with('icono', 'success');   
    }
    public function updateFecha(Request $request, $id){
        $impresora = Impresora::find($id);
        $impresora->fecha = $request->input('fecha');
        $impresora->boton_oculto = true;
        $impresora->update();
        return Redirect::route('impresoras.index')
        ->with('success', 'FECHA ACTUALIZADA CORRECTAMENTE')         
        ->with('text', 'Se actualizo a la fecha de hoy')         
        ->with('icono', 'success');
    }

    public function search(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $impresora = Impresora::whereBetween('fecha', [$start_date, $end_date])->get();
        if ($impresora->isEmpty()) {
            return Redirect::route('reportes')
            ->with('success', 'ERROR')         
            ->with('icono', 'error')
            ->with('text', 'No se encontraron resultados');

        }else{
            return view('reportes.impresora.resFechaImpresora', compact('impresora', 'start_date', 'end_date'));
        }
    }

    public function fechaPdf(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $impresora = Impresora::whereBetween('fecha', [$start_date, $end_date])->get();
        $pdf = Pdf::setPaper('letter') ->loadView('reportes.impresora.pdfFechaImpresora', compact('impresora', 'start_date', 'end_date'));
        return $pdf->stream('impresora.pdf');
    }

    public function searchImpresora(Request $request)
    {
        $query = $request->input('query');
        
        $impresora = Impresora::where('cod_gamea', 'LIKE', "$query")
        ->get();
        if ($impresora->isEmpty()) {
            return Redirect::route('reportes')
            ->with('success', 'DATOS INCORRECTOS')         
            ->with('icono', 'error')
            ->with('text', 'No se encontraron resultados');

        }else{
            return view('reportes.impresora.resImpresora', compact('impresora','query'));
        }
    
    }

    public function pdfImpresora(Request $request)
    {
        $query = $request->input('query');
        $impresora = Impresora::where('cod_gamea', 'LIKE', $query )
        ->get();
        $pdf = Pdf::setPaper('letter') ->loadView('reportes.impresora.pdfImpresora', compact('impresora', 'query'));
        return $pdf->stream('impresora.pdf');
    }

    public function searchYearImpresora(Request $request)
    {
        $query = $request->input('query');
        
        $impresora = Impresora::whereYear('created_at', $query)->get();

        if ($impresora->isEmpty()) {
            return Redirect::route('reportes')
            ->with('success', 'DATOS INCORRECTOS')         
            ->with('icono', 'error')
            ->with('text', 'No se encontraron resultados');

        }else{
            return view('reportes.impresora.resYearImpresora', compact('impresora','query'));
        }
    
    }

    public function pdfYearImpresora(Request $request)
    {
        $query = $request->input('query');
        $impresora = Impresora::whereYear('created_at', $query)->get();

        $pdf = Pdf::setPaper('letter') ->loadView('reportes.impresora.pdfYearImpresora', compact('impresora', 'query'));
        return $pdf->stream('impresora.pdf');
    }

    public function crearInforme($id)
    {
        // Obtener los datos necesarios para el informe
        $impresora = Impresora::find($id);
        $user = Auth::user();

        return view('impresora.informes.crearInforme', compact('impresora','user'));
    }

        public function buscaImpresora(Request $request)
    {
        $query = $request->input('query');
        $datos = Impresora::where('cod_gamea', 'LIKE', $query)
         ->orderBy('id', 'desc') // o created_at
        ->get();
        return response()->json($datos);
    }

}
