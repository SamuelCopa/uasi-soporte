<?php

namespace App\Http\Controllers;

use App\Models\Dependencia;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\DependenciaRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class DependenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $dependencias = Dependencia::paginate();

        return view('dependencia.index', compact('dependencias'))
            ->with('i', ($request->input('page', 1) - 1) * $dependencias->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $dependencia = new Dependencia();

        return view('dependencia.create', compact('dependencia'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DependenciaRequest $request): RedirectResponse
    {
        Dependencia::create($request->validated());

        return Redirect::route('dependencias.index')
        ->with('success', 'REGISTRADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $dependencia = Dependencia::find($id);

        return view('dependencia.show', compact('dependencia'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $dependencia = Dependencia::find($id);

        return view('dependencia.edit', compact('dependencia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DependenciaRequest $request, Dependencia $dependencia): RedirectResponse
    {
        $dependencia->update($request->validated());

        return Redirect::route('dependencias.index')
        ->with('success', 'ACTUALIZADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    public function destroy($id): RedirectResponse
    {
        Dependencia::find($id)->delete();

        return Redirect::route('dependencias.index')
        ->with('success', 'ELIMINADO CORRECTAMENTE')         
        ->with('icono', 'success');   
    }

    public function buscar(Request $request)
    {
        $buscar = $request->input('query');
        $resultados = Dependencia::where('dependencias', 'like', '%' . $buscar . '%')->get();
        return response()->json($resultados);
    }
}
