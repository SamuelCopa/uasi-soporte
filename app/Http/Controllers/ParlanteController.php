<?php

namespace App\Http\Controllers;

use App\Models\Parlante;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ParlanteRequest;
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
class ParlanteController extends Controller
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
        $parlantes = Parlante::where(function ($query) use ($fechaInicioPasada, $fechaFinPasada) {
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

        return view('parlante.index', compact('parlantes','users','estado','dependencia'))
            ->with('i', ($request->input('page', 1) - 1) * $parlantes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $parlante = new Parlante();
        $estado=Estado::all();
        $dependencia = Dependencia::orderBy('dependencias', 'asc')->get();
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'Tecnico');
        })->where('id_estadousuario', '1')->get(); 

        return view('parlante.create', compact('parlante','estado','dependencia','users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ParlanteRequest $request): RedirectResponse
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

        $parlante = new Parlante();
        $parlante->funcionario_id = $funcionario->id;
        $parlante->dependencia_id = $request->input('dependencia_id');
        $parlante->cargo = $request->input('cargo');
        $parlante->cod_gamea = $request->input('cod_gamea');
        $parlante->cod_registro = $request->input('cod_registro');
        $parlante->marca = $request->input('marca');
        $parlante->fecha = $request->input('fecha');
        $parlante->modelo = $request->input('modelo');
        $parlante->falla = $request->input('falla');
        $parlante->observaciones = $request->input('observaciones');
        $parlante->funcionario_activo = $request->input('funcionario_activo');
        $parlante->estado_id = $request->input('estado_id');
        $parlante->reguser_id = Auth::id();
        $parlante->save();

        return Redirect::route('parlantes.index')
        ->with('success', 'REGISTRADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $parlante = Parlante::find($id);

        return view('parlante.show', compact('parlante'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $parlante = Parlante::find($id);
        $estado=Estado::all();
        $dependencia = Dependencia::orderBy('dependencias', 'asc')->get();
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'Tecnico');
        })->where('id_estadousuario', '1')->orderBy('paterno', 'asc')->get(); 

        return view('parlante.edit', compact('parlante','estado','dependencia','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ParlanteRequest $request,  $id): RedirectResponse
    {
        $parlante = Parlante::find($id);
        $funcionario = Funcionario::find($id);
        $funcionario = Funcionario::find($parlante->funcionario_id);

        $funcionarioExistente = Funcionario::where('ci', $request->input('ci'))->first();

        if ($funcionarioExistente && $funcionarioExistente->id != $funcionario->id) {
        // Si el funcionario ya existe y no es el mismo, asigna el ID existente
        $parlante->funcionario_id = $funcionarioExistente->id;
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
            $parlante->funcionario_id = $funcionario->id;
        }
            $parlante->dependencia_id = $request->input('dependencia_id');
            $parlante->cargo = $request->input('cargo');
            $parlante->cod_gamea = $request->input('cod_gamea');
            $parlante->cod_registro = $request->input('cod_registro');
            $parlante->marca = $request->input('marca');
            $parlante->fecha = $request->input('fecha');
            $parlante->fecha_asignacion = $request->input('fecha_asignacion');
            $parlante->fecha_inicio = $request->input('fecha_inicio');
            $parlante->modelo = $request->input('modelo');
            $parlante->falla = $request->input('falla');
            $parlante->observaciones = $request->input('observaciones');
            $parlante->funcionario_activo = $request->input('funcionario_activo');
            $parlante->estado_id = $request->input('estado_id');
            $parlante->user_id = $request->input('user_id') ?: null;
            $parlante->save();

        return Redirect::route('parlantes.index')
        ->with('success', 'ACTUALIZADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    public function destroy($id): RedirectResponse
    {
        Parlante::find($id)->delete();

        return Redirect::route('parlantes.index')
        ->with('success', 'ELIMINADO CON EXITO')
        ->with('icono', 'success');
    }
    public function generarPdf($id)
    {
        $parlante = Parlante::findOrFail($id);
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LETTER', true, 'UTF-8', false);
        $pdf->SetTitle('Doc. ' . $parlante->funcionario->ci);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->AddPage();
        $html = view('parlante.pdf', compact('parlante'))->render();
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
        if($parlante->funcionario_activo == 1){
        $datos = $parlante->funcionario?->grado_academico.' '.$parlante->funcionario?->nombre.' '.$parlante->funcionario?->paterno.' '.$parlante->funcionario?->materno. ' - ' . $parlante->funcionario?->ci.''. $parlante->funcionario?->expedido . ' - ' . $parlante->dependencia->dependencias.' - SOPORTE TECNICO-GAMEA';
        }else{
        $datos = $parlante->funcionario?->grado_academico.' '.$parlante->funcionario?->nombre .' '.$parlante->funcionario?->paterno.' '.$parlante->funcionario?->materno. ' - ' . $parlante->funcionario?->ci.''. $parlante->funcionario?->expedido  . ' - ' .$parlante->funcionario?->cargo.' - SOPORTE TECNICO-GAMEA';
        }
        $datos1 = $parlante->funcionario?->grado_academico.' '.$parlante->funcionario?->nombre.' '.$parlante->funcionario?->paterno.' '.$parlante->funcionario?->materno ;
        $datos2 = $parlante->funcionario?->ci.' '.$parlante->funcionario?->expedido ;
        $datos3 = $parlante->funcionario?->cargo; 
        $datos4 = $parlante->dependencia?->dependencias; 

        $pdf->write2DBarcode($datos, 'QRCODE,H', 165, 210, 45, 45, $style, 'N');
        $pdf->Text(20, 205, '');
        $pdf->SetY(-70); // establece la posición del cursor en la parte inferior de la página
        $pdf->Cell(0, 5, $datos1, 0, 1, 'C');
        $pdf->Cell(0, 5, $datos2, 0, 1, 'C');
        $pdf->Cell(0, 5, $datos3, 0, 1, 'C');
        $pdf->Cell(0, 5, $datos4, 0, 1, 'C');

        $pdfContent = $pdf->Output('parlante.pdf', 'S');

        // RESPUESTA CORRECTA PARA MODAL (iframe)
        return response($pdfContent)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="parlante.pdf"');
        
    }


    private function armarDataparlante($equipo)
{
    return [
        'parlante' => $equipo,
        'qr' => $this->armarQrparlante($equipo),
        'footer' => [
            $this->nombreCompleto($equipo),
            $this->ciCompleto($equipo),
            $equipo->funcionario?->cargo,
            $equipo->dependencia?->dependencias
        ]
    ];
}
private function armarQrparlante($equipo)
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
    $equipo = Parlante::with(['funcionario', 'dependencia'])->findOrFail($id);

    $data = $this->armarDataparlante($equipo);

    $pdf = $service->generar($data, 'parlante.pdf');

    return response($pdf)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'inline; filename="parlante.pdf"');
}
    /**
     * 2. DESCARGA (attachment)
     */
public function descargar($id, EquipoPdfService $service)
{
    $equipo = Parlante::with(['funcionario', 'dependencia'])->findOrFail($id);

    $data = $this->armarDataparlante($equipo);

    $pdf = $service->generar($data, 'parlante.pdf');

    return response($pdf)
        ->header('Content-Disposition', 'attachment; filename="parlante.pdf"');
}

    /**
     * 3. ENVÍO (correo con adjunto)
     */
public function enviar($id, EquipoPdfService $service)
{
    $equipo = Parlante::with(['funcionario', 'dependencia'])->findOrFail($id);

    $data = $this->armarDataparlante($equipo);

    $pdf = $service->generar($data, 'parlante.pdf');

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
    private function obtenerCorreoDestino($parlante)
    {
        return $parlante->funcionario?->email;
    }

// ===========CAMBIAR ESTADO Y ENVIAR ALERTA================================
    public function cambiarEstado(Request $request)
    {
        $parlante = Parlante::findOrFail($request->id);

        $estadoId = (int) $request->input('estado_id');

        // =========================
        // ACTUALIZAR ESTADO
        // =========================
        $parlante->estado_id = $estadoId;

        // Mapeo de fechas por estado
        $fechas = [
            2 => 'fecha_inicio',
            5 => 'fecha_entrega',
        ];

        $parlante->estado_id = $estadoId;

        if (isset($fechas[$estadoId])) {

            $campoFecha = $fechas[$estadoId];

            // Controla la fecha, NO el estado
            if (empty($parlante->$campoFecha)) {
                $parlante->$campoFecha = now();
            }
        }

        $parlante->save();

        // =========================
        // ENVÍO DE NOTIFICACIÓN
        // =========================
        if (in_array($estadoId, [2, 3, 4])) {

            $this->notificacionService->enviar(
                $parlante->funcionario,
                $estadoId,
                $parlante
            );
        }

        // =========================
        // RESPUESTA
        // =========================
        return response()->json([
            'estado' => $estadoId == 5
                ? $parlante->resultado?->nombre
                : $parlante->estado?->nombre
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
        $parlante = Parlante::find($id);
        $parlante->cod_registro = $request->input('cod_registro');
        $parlante->update();
        return Redirect::route('parlantes.index')
        ->with('success', 'REGISTRADO CORRECTAMENTE') 
        ->with('text', 'Numero de recepción')          
        ->with('icono', 'success');
    }

    public function updateTecnico(Request $request, $id){

    $equipo = Parlante::findOrFail($id);
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
    
    return Redirect::route('parlantes.index')
        ->with('success', 'ASIGNADO CORRECTAMENTE') 
        ->with('text', 'Se ha enviado la notificación de asignación al técnico.')          
        ->with('icono', 'success');   

    }

    public function updateFecha(Request $request, $id){
        $parlante = Parlante::find($id);
        $parlante->fecha = $request->input('fecha');
        $parlante->boton_oculto = true;
        $parlante->update();
        return Redirect::route('parlantes.index')
        ->with('success', 'FECHA ACTUALIZADA CORRECTAMENTE')         
        ->with('text', 'Se actualizo a la fecha de hoy')         
        ->with('icono', 'success');
    }

    public function search(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $parlante = Parlante::whereBetween('fecha', [$start_date, $end_date])->get();
        if ($parlante->isEmpty()) {
            return Redirect::route('reportes')
            ->with('success', 'ERROR')         
            ->with('icono', 'error')
            ->with('text', 'No se encontraron resultados');

        }else{
            return view('reportes.parlante.resFechaParlante', compact('parlante', 'start_date', 'end_date'));
        }
    }

    public function fechaPdf(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $parlante = Parlante::whereBetween('fecha', [$start_date, $end_date])->get();
        $pdf = Pdf::setPaper('letter') ->loadView('reportes.parlante.pdfFechaParlante', compact('parlante', 'start_date', 'end_date'));
        return $pdf->stream('parlante.pdf');
    }

    public function searchParlante(Request $request)
    {
        $query = $request->input('query');
        
        $parlante = Parlante::where('cod_gamea', 'LIKE', "$query")
        ->get();
        if ($parlante->isEmpty()) {
            return Redirect::route('reportes')
            ->with('success', 'DATOS INCORRECTOS')         
            ->with('icono', 'error')
            ->with('text', 'No se encontraron resultados');

        }else{
            return view('reportes.parlante.resParlante', compact('parlante','query'));
        }
    }

    public function pdfParlante(Request $request)
    {
        $query = $request->input('query');
        $parlante = Parlante::where('cod_gamea', 'LIKE', $query )
        ->get();
        $pdf = Pdf::setPaper('letter') ->loadView('reportes.parlante.pdfParlante', compact('parlante', 'query'));
        return $pdf->stream('parlante.pdf');
    }

    public function searchYearParlante(Request $request)
    {
        $query = $request->input('query');
        
        $parlante = Parlante::whereYear('created_at', $query)->get();

        if ($parlante->isEmpty()) {
            return Redirect::route('reportes')
            ->with('success', 'DATOS INCORRECTOS')         
            ->with('icono', 'error')
            ->with('text', 'No se encontraron resultados');

        }else{
            return view('reportes.parlante.resYearParlante', compact('parlante','query'));
        }
    }

    public function pdfYearParlante(Request $request)
    {
        $query = $request->input('query');
        $parlante = Parlante::whereYear('created_at', $query)->get();

        $pdf = Pdf::setPaper('letter') ->loadView('reportes.parlante.pdfYearParlante', compact('parlante', 'query'));
        return $pdf->stream('parlante.pdf');
    }

    public function buscaParlante(Request $request)
    {
        $query = $request->input('query');
        $datos = Parlante::where('cod_gamea', 'LIKE', $query)
         ->orderBy('id', 'desc') // o created_at
        ->get();
        return response()->json($datos);
    }
}
