<?php

namespace App\Http\Controllers;

use App\Models\CantidadRam;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CantidadRamRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CantidadRamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $cantidadRams = CantidadRam::paginate();

        return view('cantidad-ram.index', compact('cantidadRams'))
            ->with('i', ($request->input('page', 1) - 1) * $cantidadRams->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $cantidadRam = new CantidadRam();

        return view('cantidad-ram.create', compact('cantidadRam'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CantidadRamRequest $request): RedirectResponse
    {
        CantidadRam::create($request->validated());

        return Redirect::route('cantidad-rams.index')
        ->with('success', 'REGISTRADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $cantidadRam = CantidadRam::find($id);

        return view('cantidad-ram.show', compact('cantidadRam'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $cantidadRam = CantidadRam::find($id);

        return view('cantidad-ram.edit', compact('cantidadRam'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CantidadRamRequest $request, CantidadRam $cantidadRam): RedirectResponse
    {
        $cantidadRam->update($request->validated());

        return Redirect::route('cantidad-rams.index')
        ->with('success', 'ACTUALIZADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    public function destroy($id): RedirectResponse
    {
        CantidadRam::find($id)->delete();

        return Redirect::route('cantidad-rams.index')
            ->with('success', 'ELIMINADO CORRECTAMENTE')
            ->with('icono', 'success');
    }
}
