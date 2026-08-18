<?php

namespace App\Http\Controllers;

use App\Models\CapacidadDisco;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CapacidadDiscoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CapacidadDiscoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $capacidadDiscos = CapacidadDisco::paginate();

        return view('capacidad-disco.index', compact('capacidadDiscos'))
            ->with('i', ($request->input('page', 1) - 1) * $capacidadDiscos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $capacidadDisco = new CapacidadDisco();

        return view('capacidad-disco.create', compact('capacidadDisco'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CapacidadDiscoRequest $request): RedirectResponse
    {
        CapacidadDisco::create($request->validated());

        return Redirect::route('capacidad-discos.index')
        ->with('success', 'REGISTRADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $capacidadDisco = CapacidadDisco::find($id);

        return view('capacidad-disco.show', compact('capacidadDisco'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $capacidadDisco = CapacidadDisco::find($id);

        return view('capacidad-disco.edit', compact('capacidadDisco'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CapacidadDiscoRequest $request, CapacidadDisco $capacidadDisco): RedirectResponse
    {
        $capacidadDisco->update($request->validated());

        return Redirect::route('capacidad-discos.index')
        ->with('success', 'ACTUALIZADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    public function destroy($id): RedirectResponse
    {
        CapacidadDisco::find($id)->delete();

        return Redirect::route('capacidad-discos.index')
        ->with('success', 'ELIMINADO CORRECTAMENTE')
        ->with('icono', 'success');
    }

    public function buscar(Request $request)
    {
        $buscar = $request->input('buscar');
        $resultados = CapacidadDisco::where('capacidad', 'like', '%' . $buscar . '%')->get();
        return response()->json($resultados);
    }
}
