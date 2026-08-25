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

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request): View
{
    $servicios = Servicio::whereYear('created_at', date('Y'))
        ->orderByDesc('created_at')
        ->paginate();
    
        $users = User::whereHas('roles', function ($query) {$query->where('name', 'Tecnico');
        })->where('id_estadousuario', '1')->orderBy('paterno', 'asc')->get();

    $hayPendientes = Servicio::where('visto', 0)->exists();

    return view('servicio.index', compact('servicios', 'hayPendientes','users'))
        ->with('i', ($request->input('page', 1) - 1) * $servicios->perPage());
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

    public function updateTecnico(Request $request, $id){

    $equipo = Servicio::findOrFail($id);
    $equipo->user_id = $request->input('user_id');
    $equipo->fecha_asignacion = $request->input('fecha_asignacion');
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
