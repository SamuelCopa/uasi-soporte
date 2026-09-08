<?php

namespace App\Http\Controllers;

use App\Models\Laptop;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\LaptopRequest;
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

class LaptopController extends Controller
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
        $laptops = Laptop::where(function ($query) use ($fechaInicioPasada, $fechaFinPasada) {
            $query->whereBetween('fecha', [$fechaInicioPasada, $fechaFinPasada])
            ->where('estado_id', '!=', 5);
        })
        ->orWhereYear('fecha', date('Y'))
        ->orderByDesc('fecha')
        ->paginate();
        $dependencia = Dependencia::orderBy('dependencias', 'asc')->get();
        $estado=Estado::all();
        $funcionario=Funcionario::all();
        $users = User::whereHas('roles', function ($query) {$query->where('name', 'Tecnico');
        })->where('id_estadousuario', '1')->orderBy('paterno', 'asc')->get();

        return view('laptop.index', compact('laptops','users','estado','dependencia','funcionario'))
            ->with('i', ($request->input('page', 1) - 1) * $laptops->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $laptop = new Laptop();
        $estado=Estado::all()->except(6);
        $funcionario = Funcionario::all();
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'Tecnico');
        })->where('id_estadousuario', '1')->get();   
        $dependencia = Dependencia::orderBy('dependencias', 'asc')->get();

        return view('laptop.create', compact('laptop','estado','dependencia','users', 'funcionario'));
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

            $laptop = DB::transaction(function () use (
        $request,
        $funcionario,
        $correlativoService
    ) {

        $laptop = new Laptop();

        $laptop->funcionario_id = $funcionario->id;
        $laptop->cargo = $request->input('cargo');
        $laptop->dependencia_id = $request->input('dependencia_id');
        $laptop->cod_gamea = $request->input('cod_gamea');

        // GENERAR CORRELATIVO
        $laptop->cod_registro =$correlativoService->generarNumeroRecepcion();

        $laptop->fecha = $request->input('fecha');
                $laptop->usuario = $request->input('usuario');
        $laptop->contrasena = $request->input('contrasena');
        $laptop->marca = $request->input('marca');
        $laptop->modelo = $request->input('modelo');
        $laptop->falla = $request->input('falla');
        $laptop->observaciones = $request->input('observaciones');
        $laptop->funcionario_activo =$request->input('funcionario_activo');
        $laptop->estado_id = $request->input('estado_id');
        $laptop->reguser_id = Auth::id();

        $laptop->save();

        return $laptop;
    });

    return redirect()
        ->route('laptops.index')
        ->with('success', 'REGISTRADO CORRECTAMENTE')
        ->with('text', 'Número de recepción: ' . $laptop->cod_registro)
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $laptop = Laptop::find($id);

        return view('laptop.show', compact('laptop'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $laptop = Laptop::find($id);
        $funcionario = Funcionario::find($id);
        $estado=Estado::all();
        $users = User::whereHas('roles', function ($query) {
        $query->where('name', 'Tecnico');
        })->where('id_estadousuario', '1')->orderBy('paterno', 'asc')->get(); 
        $dependencia = Dependencia::orderBy('dependencias', 'asc')->get();
        return view('laptop.edit', compact('laptop','estado','dependencia','users', 'funcionario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $laptop=Laptop::find($id);
        $funcionario = Funcionario::find($id);
        $funcionario = Funcionario::find($laptop->funcionario_id);

        $funcionarioExistente = Funcionario::where('ci', $request->input('ci'))->first();

        if ($funcionarioExistente && $funcionarioExistente->id != $funcionario->id) {
        // Si el funcionario ya existe y no es el mismo, asigna el ID existente
        $laptop->funcionario_id = $funcionarioExistente->id;
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
            $laptop->funcionario_id = $funcionario->id;
        }
            $laptop->cargo = $request->input('cargo');
            $laptop->dependencia_id = $request->input('dependencia_id');
            $laptop->cod_gamea = $request->input('cod_gamea');
            $laptop->cod_registro = $request->input('cod_registro');
            $laptop->usuario = $request->input('usuario');
            $laptop->contrasena = $request->input('contrasena');
            $laptop->fecha = $request->input('fecha');
            $laptop->fecha_asignacion = $request->input('fecha_asignacion');
            $laptop->fecha_inicio = $request->input('fecha_inicio');
            $laptop->marca = $request->input('marca');
            $laptop->modelo = $request->input('modelo');
            $laptop->falla = $request->input('falla');
            $laptop->observaciones = $request->input('observaciones');
            $laptop->funcionario_activo = $request->input('funcionario_activo');
            $laptop->estado_id = $request->input('estado_id');
            $laptop->user_id = $request->input('user_id') ?: null;
            $laptop->save();

        return Redirect::route('laptops.index')
        ->with('success', 'ACTUALIZADO CORRECTAMENTE')         
        ->with('icono', 'success');   
    }

    public function destroy($id): RedirectResponse
    {
        Laptop::find($id)->delete();

        return Redirect::route('laptops.index')
        ->with('success', 'ELIMINADO CON EXITO')
        ->with('icono', 'success');
    }


        public function generarPdf($id)
    {
        $laptop = Laptop::findOrFail($id);
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LETTER', true, 'UTF-8', false);
        $pdf->SetTitle('Doc. ' . $laptop->funcionario->ci);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->AddPage();
        $html = view('laptop.pdf', compact('laptop'))->render();
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
 if ($laptop->funcionario_activo == 1) {

    $datos = $laptop->funcionario?->grado_academico . ' ' .
             $laptop->funcionario?->nombre . ' ' .
             $laptop->funcionario?->paterno . ' ' .
             $laptop->funcionario?->materno .
             ' - ' .
             $laptop->funcionario?->ci . ' ' .
             $laptop->funcionario?->expedido .
             ' - ' .
             ($laptop->dependencia?->dependencias ?? 'SIN DEPENDENCIA') .
             ' - SOPORTE TECNICO-GAMEA';

} else {

    $datos = $laptop->funcionario?->grado_academico . ' ' .
             $laptop->funcionario?->nombre . ' ' .
             $laptop->funcionario?->paterno . ' ' .
             $laptop->funcionario?->materno .
             ' - ' .
             $laptop->funcionario?->ci . ' ' .
             $laptop->funcionario?->expedido .
             ' - ' .
             ($laptop->funcionario?->cargo ?? 'SIN CARGO') .
             ' - SOPORTE TECNICO-GAMEA';
}

$datos1 = trim(
    ($laptop->funcionario?->grado_academico ?? '') . ' ' .
    ($laptop->funcionario?->nombre ?? '') . ' ' .
    ($laptop->funcionario?->paterno ?? '') . ' ' .
    ($laptop->funcionario?->materno ?? '')
);

$datos2 = ($laptop->funcionario?->ci ?? '') . ' ' .
          ($laptop->funcionario?->expedido ?? '');

$datos3 = $laptop->funcionario?->cargo ?? 'SIN CARGO';

$datos4 = $laptop->dependencia?->dependencias ?? 'SIN DEPENDENCIA';

        $pdf->write2DBarcode($datos, 'QRCODE,H', 165, 210, 45, 45, $style, 'N');
        $pdf->Text(20, 205, '');
        $pdf->SetY(-70); // establece la posición del cursor en la parte inferior de la página
        $pdf->Cell(0, 5, $datos1, 0, 1, 'C');
        $pdf->Cell(0, 5, $datos2, 0, 1, 'C');
        $pdf->Cell(0, 5, $datos3, 0, 1, 'C');
        $pdf->MultiCell(0, 5, $datos4, 0, 'C', false, 1);
        $pdfContent = $pdf->Output('laptop.pdf', 'S');

        // RESPUESTA CORRECTA PARA MODAL (iframe)
        return response($pdfContent)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="laptop.pdf"');
        
    }


    private function armarDatalaptop($equipo)
{
    return [
        'laptop' => $equipo,
        'qr' => $this->armarQrlaptop($equipo),
        'footer' => [
            $this->nombreCompleto($equipo),
            $this->ciCompleto($equipo),
            $equipo->funcionario?->cargo,
            $equipo->dependencia?->dependencias
        ]
    ];
}
private function armarQrlaptop($equipo)
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
    $equipo = Laptop::with(['funcionario', 'dependencia'])->findOrFail($id);

    $data = $this->armarDatalaptop($equipo);

    $pdf = $service->generar($data, 'laptop.pdf');

    return response($pdf)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'inline; filename="laptop.pdf"');
}
    /**
     * 2. DESCARGA (attachment)
     */
public function descargar($id, EquipoPdfService $service)
{
    $equipo = Laptop::with(['funcionario', 'dependencia'])->findOrFail($id);

    $data = $this->armarDatalaptop($equipo);

    $pdf = $service->generar($data, 'laptop.pdf');

    return response($pdf)
        ->header('Content-Disposition', 'attachment; filename="laptop.pdf"');
}

    /**
     * 3. ENVÍO (correo con adjunto)
     */
public function enviar($id, EquipoPdfService $service)
{
    $equipo = Laptop::with([
        'funcionario',
        'dependencia'
    ])->findOrFail($id);

    $data = $this->armarDatalaptop($equipo);

    $pdf = $service->generar($data, 'laptop.pdf');

    $correo = $this->obtenerCorreoDestino($equipo);

    if (!$correo) {
        return response()->json([
            'success' => false,
            'message' => 'El funcionario no tiene correo registrado'
        ], 422);
    }

    // Nombre temporal del PDF
    $nombreArchivo = 'documentos/laptop_' . $equipo->id . '_' . time() . '.pdf';

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
    private function obtenerCorreoDestino($laptop)
    {
        return $laptop->funcionario?->email;
    }

// ===========CAMBIAR ESTADO Y ENVIAR ALERTA==================
    public function cambiarEstado(Request $request)
    {
        $laptop = Laptop::findOrFail($request->id);

        $estadoId = (int) $request->input('estado_id');

        // =========================
        // ACTUALIZAR ESTADO
        // =========================
        $laptop->estado_id = $estadoId;

        // Mapeo de fechas por estado
        $fechas = [
            2 => 'fecha_inicio',
            5 => 'fecha_entrega',
        ];

        $laptop->estado_id = $estadoId;

        if (isset($fechas[$estadoId])) {

            $campoFecha = $fechas[$estadoId];

            // Controla la fecha, NO el estado
            if (empty($laptop->$campoFecha)) {
                $laptop->$campoFecha = now();
            }
        }

        $laptop->save();

        // =========================
        // ENVÍO DE NOTIFICACIÓN
        // =========================
        if (in_array($estadoId, [3, 4])) {

            $this->notificacionService->enviar(
                $laptop->funcionario,
                $estadoId,
                $laptop
            );
        }

        // =========================
        // RESPUESTA
        // =========================
        return response()->json([
            'estado' => $estadoId == 5
                ? $laptop->resultado?->nombre
                : $laptop->estado?->nombre
        ]);
    }

    public function updateTecnico(Request $request, $id){

    $equipo = Laptop::findOrFail($id);
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

    return Redirect::route('laptops.index')
        ->with('success', 'ASIGNADO CORRECTAMENTE') 
        ->with('text', 'Se ha enviado la notificación de asignación al técnico.')          
        ->with('icono', 'success');   
    }

    public function updateFecha(Request $request, $id){
        $laptop = Laptop::find($id);
        $laptop->fecha = $request->input('fecha');
        $laptop->boton_oculto = true;
        $laptop->update();
        return Redirect::route('laptops.index')
        ->with('success', 'FECHA ACTUALIZADA CORRECTAMENTE')         
        ->with('text', 'Se actualizo a la fecha de hoy')         
        ->with('icono', 'success');
    }

    public function search(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $laptop = Laptop::whereBetween('fecha', [$start_date, $end_date])->get();
        if ($laptop->isEmpty()) {
            return Redirect::route('reportes')
            ->with('success', 'ERROR')         
            ->with('icono', 'error')
            ->with('text', 'No se encontraron resultados');

        }else{
            return view('reportes.laptop.resFechaLaptop', compact('laptop', 'start_date', 'end_date'));
        }
    }

    public function fechaPdf(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $laptop = Laptop::whereBetween('fecha', [$start_date, $end_date])->get();
        $pdf = Pdf::setPaper('letter') ->loadView('reportes.laptop.pdfFechaLaptop', compact('laptop', 'start_date', 'end_date'));
        return $pdf->stream('laptop.pdf');
    }

    public function searchLaptop(Request $request)
    {
        $query = $request->input('query');
        
        $laptop = Laptop::where('cod_gamea', 'LIKE', "$query")
        ->get();
        if ($laptop->isEmpty()) {
            return Redirect::route('reportes')
            ->with('success', 'DATOS INCORRECTOS')         
            ->with('icono', 'error')
            ->with('text', 'No se encontraron resultados');

        }else{
            return view('reportes.laptop.resLaptop', compact('laptop','query'));
        }
    }

    public function pdfLaptop(Request $request)
    {
        $query = $request->input('query');
        $laptop = laptop::where('cod_gamea', 'LIKE', $query )
        ->get();
        $pdf = Pdf::setPaper('letter') ->loadView('reportes.laptop.pdfLaptop', compact('laptop', 'query'));
        return $pdf->stream('laptop.pdf');
    }

    public function searchYearLaptop(Request $request)
    {
        $query = $request->input('query');
        
        $laptop = Laptop::whereYear('created_at', $query)->get();

        if ($laptop->isEmpty()) {
            return Redirect::route('reportes')
            ->with('success', 'DATOS INCORRECTOS')         
            ->with('icono', 'error')
            ->with('text', 'No se encontraron resultados');

        }else{
            return view('reportes.laptop.resYearLaptop', compact('laptop','query'));
        }
    }

    public function pdfYearLaptop(Request $request)
    {
        $query = $request->input('query');
        $laptop = laptop::whereYear('created_at', $query)->get();

        $pdf = Pdf::setPaper('letter')->loadView('reportes.laptop.pdfYearLaptop', compact('laptop', 'query'));
        return $pdf->stream('laptop.pdf');
    }

    public function buscaLaptop(Request $request)
    {
        $query = $request->input('query');
        $datos = Laptop::where('cod_gamea', 'LIKE', $query)
         ->orderBy('id', 'desc') // o created_at
        ->get();
        return response()->json($datos);
    }

}
