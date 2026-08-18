<?php

namespace App\Http\Controllers;

use App\Models\TipoDisco;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\TipoDiscoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class TipoDiscoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $tipoDiscos = TipoDisco::paginate();

        return view('tipo-disco.index', compact('tipoDiscos'))
            ->with('i', ($request->input('page', 1) - 1) * $tipoDiscos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $tipoDisco = new TipoDisco();

        return view('tipo-disco.create', compact('tipoDisco'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TipoDiscoRequest $request): RedirectResponse
    {
        TipoDisco::create($request->validated());

        return Redirect::route('tipo-discos.index')
        ->with('success', 'REGISTRADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $tipoDisco = TipoDisco::find($id);

        return view('tipo-disco.show', compact('tipoDisco'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $tipoDisco = TipoDisco::find($id);

        return view('tipo-disco.edit', compact('tipoDisco'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TipoDiscoRequest $request, TipoDisco $tipoDisco): RedirectResponse
    {
        $tipoDisco->update($request->validated());

        return Redirect::route('tipo-discos.index')
        ->with('success', 'ACTUALIZADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    public function destroy($id): RedirectResponse
    {
        TipoDisco::find($id)->delete();

        return Redirect::route('tipo-discos.index')
        ->with('success', 'ELIMINADO CORRECTAMENTE')         
        ->with('icono', 'success');   
    }
    
    public function buscar(Request $request)
    {
        $buscar = $request->input('buscar');
        $resultados = TipoDisco::where('tipo', 'like', '%' . $buscar . '%')->get();
        return response()->json($resultados);
    }
}
