<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ServicioRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Models\Funcionario;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Dependencia;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request): View
{
    $query = Servicio::query()
        ->with([
            'funcionario',
            'Dependencia',
            'user'
        ]);

    $year = $request->input('year', date('Y'));

    if ($year !== 'todos') {
        $query->whereYear('created_at', $year);
    }

    if ($request->filled('estado')) {

        if ($request->estado == 'pendiente') {

            $query->where(function ($q) {
                $q->whereNull('user_id')
                  ->orWhere('visto', 0);
            });

        } elseif ($request->estado == 'atendido') {

            $query->whereNotNull('user_id')
                  ->where('visto', 1);
        }
    }

    if ($request->filled('tecnico')) {
        $query->where('user_id', $request->tecnico);
    }

    if ($request->filled('dependencia')) {
        $query->where(
            'dependencia_id',
            $request->dependencia
        );
    }

    if ($request->filled('fecha_desde')) {
        $query->whereDate(
            'created_at',
            '>=',
            $request->fecha_desde
        );
    }

    if ($request->filled('fecha_hasta')) {
        $query->whereDate(
            'created_at',
            '<=',
            $request->fecha_hasta
        );
    }

    $servicios = $query
        ->orderByDesc('created_at')
        ->paginate(15)
        ->withQueryString();

    // Técnicos
    $users = User::whereHas('roles', function ($query) {
        $query->where('name', 'Tecnico');
    })
    ->where('id_estadousuario', '1')
    ->orderBy('paterno', 'asc')
    ->get();

    // Dependencias
    $dependencias = Dependencia::orderBy(
        'dependencias',
        'asc'
    )->get();

    // Hay pendientes
    $hayPendientes = Servicio::where('visto', 0)
        ->exists();

    return view(
        'servicio.index',
        compact(
            'servicios',
            'hayPendientes',
            'users',
            'dependencias',
            'year'
        )
    )->with(
        'i',
        ($request->input('page', 1) - 1) * $servicios->perPage()
    );
}


public function reporteServicioPdf(Request $request)
{
    $query = Servicio::with([
        'funcionario',
        'Dependencia',
        'user'
    ]);

    if ($request->filled('year')) {
        $query->whereYear(
            'created_at',
            $request->year
        );
    }

    if ($request->filled('estado')) {

        if ($request->estado == 'pendiente') {

            $query->where(function ($q) {

                $q->whereNull('user_id')
                  ->orWhere('visto', 0);

            });
        }

        if ($request->estado == 'atendido') {

            $query->whereNotNull('user_id')
                  ->where('visto', 1);

        }
    }

    if ($request->filled('tecnico')) {

        $query->where(
            'user_id',
            $request->tecnico
        );

    }

    if ($request->filled('dependencia')) {

        $query->where(
            'dependencia_id',
            $request->dependencia
        );

    }

    if ($request->filled('fecha_desde')) {

        $query->whereDate(
            'created_at',
            '>=',
            $request->fecha_desde
        );

    }

    if ($request->filled('fecha_hasta')) {

        $query->whereDate(
            'created_at',
            '<=',
            $request->fecha_hasta
        );

    }

    $servicios = $query
        ->orderBy('created_at', 'desc')
        ->get();

    $pdf = Pdf::loadView(
        'servicio.reporte-pdf',
        compact('servicios')
    )->setPaper('letter');

    return $pdf->stream('reporte-servicios.pdf');
}
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $servicio = new Servicio();

        return view('servicio.create', compact('servicio'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $request->validate([
            'equipo' => 'required',
            'falla' => 'required',
        ]);

        Servicio::create([
        'equipo' => $request->equipo,
        'falla' => $request->falla,
        'visto' => false,
        'dependencia_id' => $request->dependencia_id,
        'funcionario_id' => $request->funcionario_id,
        ]);

   
        return redirect()->back()
        ->with('icono', 'success')
        ->with('success', 'LA SOLICITUD SE REGISTRO CON EXITO')
        ->with('text', 'EN BREVE LO ATENDEREMOS');
    }


    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $servicio = Servicio::find($id);

        return view('servicio.show', compact('servicio'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $servicio = Servicio::find($id);

        return view('servicio.edit', compact('servicio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServicioRequest $request, Servicio $servicio): RedirectResponse
    {
        $servicio->update($request->validated());

        return Redirect::route('servicios.index')
            ->with('success', 'Servicio updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Servicio::find($id)->delete();

        return Redirect::route('servicios.index')
            ->with('success', 'Servicio deleted successfully');
    }



    public function marcarVisto(Request $request)
    {
        $servicio = Servicio::find($request->id);

        if (!$servicio) {
            return response()->json([
                'success' => false
            ], 404);
        }

        $servicio->visto = !$servicio->visto;
        $servicio->save();

        return response()->json([
            'success' => true,
            'visto' => $servicio->visto
        ]);
    }

public function updateTecnico(Request $request, $id)
{
    $equipo = Servicio::findOrFail($id);

    // Técnico asignado
    $equipo->user_id = $request->input('user_id');

    // Fecha de asignación
    $equipo->fecha_asignacion = $request->input('fecha_asignacion');

    // Usuario que realizó la asignación
    $equipo->asignado_por = auth()->id();

    $equipo->save();

    return Redirect::route('servicios.index')
        ->with('success', 'ASIGNADO CORRECTAMENTE')
        ->with('icono', 'success');
}

public function atender(Request $request, $id)
{
    $request->validate([
        'puntuacion' => 'required|integer|min:1|max:5',
    ]);

    $servicio = Servicio::findOrFail($id);
    $servicio -> servicio = $request->servicio;
    $servicio->puntuacion = $request->puntuacion;
    $servicio->visto = 1;
    $servicio->fecha_atencion = now();

    $servicio->save();

return redirect()->back()
    ->with('success', 'La solicitud fue atendida correctamente')
    ->with('text', 'Gracias por su opinión')
    ->with('icono', 'success');
}


public function evaluar($id)
{
    $asignacion = Servicio::findOrFail($id);

    return view('asigTecnico.evaluar', compact('asignacion'));
}


}
