<?php

namespace App\Http\Controllers;

use App\Models\DisipadorRam;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\DisipadorRamRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class DisipadorRamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $disipadorRams = DisipadorRam::paginate();

        return view('disipador-ram.index', compact('disipadorRams'))
            ->with('i', ($request->input('page', 1) - 1) * $disipadorRams->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $disipadorRam = new DisipadorRam();

        return view('disipador-ram.create', compact('disipadorRam'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DisipadorRamRequest $request): RedirectResponse
    {
        DisipadorRam::create($request->validated());

        return Redirect::route('disipador-rams.index')
        ->with('success', 'REGISTRADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $disipadorRam = DisipadorRam::find($id);

        return view('disipador-ram.show', compact('disipadorRam'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $disipadorRam = DisipadorRam::find($id);

        return view('disipador-ram.edit', compact('disipadorRam'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DisipadorRamRequest $request, DisipadorRam $disipadorRam): RedirectResponse
    {
        $disipadorRam->update($request->validated());

        return Redirect::route('disipador-rams.index')
        ->with('success', 'ACTUALIZADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    public function destroy($id): RedirectResponse
    {
        DisipadorRam::find($id)->delete();

        return Redirect::route('disipador-rams.index')
        ->with('success', 'ELIMINADO CORRECTAMENTE')         
        ->with('icono', 'success');   
    }
}
