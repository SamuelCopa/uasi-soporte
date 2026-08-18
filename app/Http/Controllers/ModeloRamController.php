<?php

namespace App\Http\Controllers;

use App\Models\ModeloRam;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ModeloRamRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ModeloRamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $modeloRams = ModeloRam::paginate();

        return view('modelo-ram.index', compact('modeloRams'))
            ->with('i', ($request->input('page', 1) - 1) * $modeloRams->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $modeloRam = new ModeloRam();

        return view('modelo-ram.create', compact('modeloRam'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ModeloRamRequest $request): RedirectResponse
    {
        ModeloRam::create($request->validated());

        return Redirect::route('modelo-rams.index')
        ->with('success', 'REGISTRADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $modeloRam = ModeloRam::find($id);

        return view('modelo-ram.show', compact('modeloRam'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $modeloRam = ModeloRam::find($id);

        return view('modelo-ram.edit', compact('modeloRam'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ModeloRamRequest $request, ModeloRam $modeloRam): RedirectResponse
    {
        $modeloRam->update($request->validated());

        return Redirect::route('modelo-rams.index')
        ->with('success', 'ACTUALIZADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    public function destroy($id): RedirectResponse
    {
        ModeloRam::find($id)->delete();

        return Redirect::route('modelo-rams.index')
        ->with('success', 'ELIMINADO CORRECTAMENTE')         
        ->with('icono', 'success');   
    }

    public function buscar(Request $request)
    {
        $buscar = $request->input('buscar');
        $resultados = ModeloRam::where('modelo', 'like', '%' . $buscar . '%')->get();
        return response()->json($resultados);
    }
}
