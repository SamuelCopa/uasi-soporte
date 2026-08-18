<?php

namespace App\Http\Controllers;

use App\Models\MarcaProcesador;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\MarcaProcesadorRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class MarcaProcesadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $marcaProcesadors = MarcaProcesador::paginate();

        return view('marca-procesador.index', compact('marcaProcesadors'))
            ->with('i', ($request->input('page', 1) - 1) * $marcaProcesadors->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $marcaProcesador = new MarcaProcesador();

        return view('marca-procesador.create', compact('marcaProcesador'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MarcaProcesadorRequest $request): RedirectResponse
    {
        MarcaProcesador::create($request->validated());

        return Redirect::route('marca-procesadors.index')
        ->with('success', 'REGISTRADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $marcaProcesador = MarcaProcesador::find($id);

        return view('marca-procesador.show', compact('marcaProcesador'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $marcaProcesador = MarcaProcesador::find($id);

        return view('marca-procesador.edit', compact('marcaProcesador'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MarcaProcesadorRequest $request, MarcaProcesador $marcaProcesador): RedirectResponse
    {
        $marcaProcesador->update($request->validated());

        return Redirect::route('marca-procesadors.index')
        ->with('success', 'ACTUALIZADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    public function destroy($id): RedirectResponse
    {
        MarcaProcesador::find($id)->delete();

        return Redirect::route('marca-procesadors.index')
        ->with('success', 'ELIMINADO CORRECTAMENTE')         
        ->with('icono', 'success');   
    }

    public function buscar(Request $request)
    {
        $buscar = $request->input('buscar');
        $resultados = MarcaProcesador::where('marca', 'like', '%' . $buscar . '%')->get();
        return response()->json($resultados);
    }
}
