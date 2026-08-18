<?php

namespace App\Http\Controllers;

use App\Models\CapacidadRam;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CapacidadRamRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CapacidadRamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $capacidadRams = CapacidadRam::paginate();

        return view('capacidad-ram.index', compact('capacidadRams'))
            ->with('i', ($request->input('page', 1) - 1) * $capacidadRams->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $capacidadRam = new CapacidadRam();

        return view('capacidad-ram.create', compact('capacidadRam'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CapacidadRamRequest $request): RedirectResponse
    {
        CapacidadRam::create($request->validated());

        return Redirect::route('capacidad-rams.index')
        ->with('success', 'REGISTRADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $capacidadRam = CapacidadRam::find($id);

        return view('capacidad-ram.show', compact('capacidadRam'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $capacidadRam = CapacidadRam::find($id);

        return view('capacidad-ram.edit', compact('capacidadRam'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CapacidadRamRequest $request, CapacidadRam $capacidadRam): RedirectResponse
    {
        $capacidadRam->update($request->validated());

        return Redirect::route('capacidad-rams.index')
        ->with('success', 'ACTUALIZADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    public function destroy($id): RedirectResponse
    {
        CapacidadRam::find($id)->delete();

        return Redirect::route('capacidad-rams.index')
            ->with('success', 'ELIMINADO CORRECTAMENTE')
            ->with('icono', 'success');
    }

    public function buscar(Request $request)
    {
        $buscar = $request->input('buscar');
        $resultados = CapacidadRam::where('capacidad', 'like', '%' . $buscar . '%')->get();
        return response()->json($resultados);
    }
}
