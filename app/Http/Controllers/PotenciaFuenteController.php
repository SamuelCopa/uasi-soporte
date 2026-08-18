<?php

namespace App\Http\Controllers;

use App\Models\PotenciaFuente;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\PotenciaFuenteRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PotenciaFuenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $potenciaFuentes = PotenciaFuente::paginate();

        return view('potencia-fuente.index', compact('potenciaFuentes'))
            ->with('i', ($request->input('page', 1) - 1) * $potenciaFuentes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $potenciaFuente = new PotenciaFuente();

        return view('potencia-fuente.create', compact('potenciaFuente'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PotenciaFuenteRequest $request): RedirectResponse
    {
        PotenciaFuente::create($request->validated());

        return Redirect::route('potencia-fuentes.index')
        ->with('success', 'REGISTRADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $potenciaFuente = PotenciaFuente::find($id);

        return view('potencia-fuente.show', compact('potenciaFuente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $potenciaFuente = PotenciaFuente::find($id);

        return view('potencia-fuente.edit', compact('potenciaFuente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PotenciaFuenteRequest $request, PotenciaFuente $potenciaFuente): RedirectResponse
    {
        $potenciaFuente->update($request->validated());

        return Redirect::route('potencia-fuentes.index')
        ->with('success', 'ACTUALIZADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    public function destroy($id): RedirectResponse
    {
        PotenciaFuente::find($id)->delete();

        return Redirect::route('potencia-fuentes.index')
        ->with('success', 'ELIMINADO CORRECTAMENTE')         
        ->with('icono', 'success');   
    }

    public function buscar(Request $request)
    {
        $buscar = $request->input('buscar');
        $resultados = PotenciaFuente::where('potencia', 'like', '%' . $buscar . '%')->get();
        return response()->json($resultados);
    }
}
