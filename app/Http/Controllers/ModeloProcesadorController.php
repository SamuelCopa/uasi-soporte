<?php

namespace App\Http\Controllers;

use App\Models\ModeloProcesador;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ModeloProcesadorRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ModeloProcesadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $modeloProcesadors = ModeloProcesador::paginate();

        return view('modelo-procesador.index', compact('modeloProcesadors'))
            ->with('i', ($request->input('page', 1) - 1) * $modeloProcesadors->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $modeloProcesador = new ModeloProcesador();

        return view('modelo-procesador.create', compact('modeloProcesador'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ModeloProcesadorRequest $request): RedirectResponse
    {
        ModeloProcesador::create($request->validated());

        return Redirect::route('modelo-procesadors.index')
        ->with('success', 'REGISTRADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $modeloProcesador = ModeloProcesador::find($id);

        return view('modelo-procesador.show', compact('modeloProcesador'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $modeloProcesador = ModeloProcesador::find($id);

        return view('modelo-procesador.edit', compact('modeloProcesador'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ModeloProcesadorRequest $request, ModeloProcesador $modeloProcesador): RedirectResponse
    {
        $modeloProcesador->update($request->validated());

        return Redirect::route('modelo-procesadors.index')
        ->with('success', 'ACTUALIZADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    public function destroy($id): RedirectResponse
    {
        ModeloProcesador::find($id)->delete();

        return Redirect::route('modelo-procesadors.index')
        ->with('success', 'ELIMINADO CORRECTAMENTE')         
        ->with('icono', 'success');   
    }

    public function buscar(Request $request)
    {
        $buscar = $request->input('buscar');
        $resultados = ModeloProcesador::where('modelo', 'like', '%' . $buscar . '%')->get();
        return response()->json($resultados);
    }
}
