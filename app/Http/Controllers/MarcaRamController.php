<?php

namespace App\Http\Controllers;

use App\Models\MarcaRam;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\MarcaRamRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class MarcaRamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $marcaRams = MarcaRam::paginate();

        return view('marca-ram.index', compact('marcaRams'))
            ->with('i', ($request->input('page', 1) - 1) * $marcaRams->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $marcaRam = new MarcaRam();

        return view('marca-ram.create', compact('marcaRam'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MarcaRamRequest $request): RedirectResponse
    {
        MarcaRam::create($request->validated());

        return Redirect::route('marca-rams.index')
        ->with('success', 'REGISTRADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $marcaRam = MarcaRam::find($id);

        return view('marca-ram.show', compact('marcaRam'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $marcaRam = MarcaRam::find($id);

        return view('marca-ram.edit', compact('marcaRam'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MarcaRamRequest $request, MarcaRam $marcaRam): RedirectResponse
    {
        $marcaRam->update($request->validated());

        return Redirect::route('marca-rams.index')
        ->with('success', 'ACTUALIZADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    public function destroy($id): RedirectResponse
    {
        MarcaRam::find($id)->delete();

        return Redirect::route('marca-rams.index')
        ->with('success', 'ELIMINADO CORRECTAMENTE')         
        ->with('icono', 'success');   
    }

    public function buscar(Request $request)
    {
        $buscar = $request->input('buscar');
        $resultados = MarcaRam::where('marca', 'like', '%' . $buscar . '%')->get();
        return response()->json($resultados);
    }
}
