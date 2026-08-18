<?php

namespace App\Http\Controllers;

use App\Models\MarcaFuente;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\MarcaFuenteRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class MarcaFuenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $marcaFuentes = MarcaFuente::paginate();

        return view('marca-fuente.index', compact('marcaFuentes'))
            ->with('i', ($request->input('page', 1) - 1) * $marcaFuentes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $marcaFuente = new MarcaFuente();

        return view('marca-fuente.create', compact('marcaFuente'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MarcaFuenteRequest $request): RedirectResponse
    {
        MarcaFuente::create($request->validated());

        return Redirect::route('marca-fuentes.index')
        ->with('success', 'REGISTRADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $marcaFuente = MarcaFuente::find($id);

        return view('marca-fuente.show', compact('marcaFuente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $marcaFuente = MarcaFuente::find($id);

        return view('marca-fuente.edit', compact('marcaFuente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MarcaFuenteRequest $request, MarcaFuente $marcaFuente): RedirectResponse
    {
        $marcaFuente->update($request->validated());

        return Redirect::route('marca-fuentes.index')
        ->with('success', 'ACTUALIZADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    public function destroy($id): RedirectResponse
    {
        MarcaFuente::find($id)->delete();

        return Redirect::route('marca-fuentes.index')
        ->with('success', 'ELIMINADO CORRECTAMENTE')         
        ->with('icono', 'success');   
    }

    public function buscar(Request $request)
    {
        $buscar = $request->input('buscar');
        $resultados = MarcaFuente::where('marca', 'like', '%' . $buscar . '%')->get();
        return response()->json($resultados);
    }
}
