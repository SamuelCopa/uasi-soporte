<?php

namespace App\Http\Controllers;

use App\Models\ModeloDisco;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ModeloDiscoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ModeloDiscoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $modeloDiscos = ModeloDisco::paginate();

        return view('modelo-disco.index', compact('modeloDiscos'))
            ->with('i', ($request->input('page', 1) - 1) * $modeloDiscos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $modeloDisco = new ModeloDisco();

        return view('modelo-disco.create', compact('modeloDisco'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ModeloDiscoRequest $request): RedirectResponse
    {
        ModeloDisco::create($request->validated());

        return Redirect::route('modelo-discos.index')
        ->with('success', 'REGISTRADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $modeloDisco = ModeloDisco::find($id);

        return view('modelo-disco.show', compact('modeloDisco'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $modeloDisco = ModeloDisco::find($id);

        return view('modelo-disco.edit', compact('modeloDisco'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ModeloDiscoRequest $request, ModeloDisco $modeloDisco): RedirectResponse
    {
        $modeloDisco->update($request->validated());

        return Redirect::route('modelo-discos.index')
        ->with('success', 'ACTUALIZADO CORRECTAMENTE')         
        ->with('icono', 'success');

    }

    public function destroy($id): RedirectResponse
    {
        ModeloDisco::find($id)->delete();

        return Redirect::route('modelo-discos.index')
        ->with('success', 'ELIMINADO CORRECTAMENTE')         
        ->with('icono', 'success');       
    }

    public function buscar(Request $request)
    {
        $buscar = $request->input('buscar');
        $resultados = ModeloDisco::where('modelo', 'like', '%' . $buscar . '%')->get();
        return response()->json($resultados);
    }
}
