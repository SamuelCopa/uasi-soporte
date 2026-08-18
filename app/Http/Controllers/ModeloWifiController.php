<?php

namespace App\Http\Controllers;

use App\Models\ModeloWifi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ModeloWifiRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ModeloWifiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $modeloWifis = ModeloWifi::paginate();

        return view('modelo-wifi.index', compact('modeloWifis'))
            ->with('i', ($request->input('page', 1) - 1) * $modeloWifis->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $modeloWifi = new ModeloWifi();

        return view('modelo-wifi.create', compact('modeloWifi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ModeloWifiRequest $request): RedirectResponse
    {
        ModeloWifi::create($request->validated());

        return Redirect::route('modelo-wifis.index')
        ->with('success', 'REGISTRADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $modeloWifi = ModeloWifi::find($id);

        return view('modelo-wifi.show', compact('modeloWifi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $modeloWifi = ModeloWifi::find($id);

        return view('modelo-wifi.edit', compact('modeloWifi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ModeloWifiRequest $request, ModeloWifi $modeloWifi): RedirectResponse
    {
        $modeloWifi->update($request->validated());

        return Redirect::route('modelo-wifis.index')
        ->with('success', 'ACTUALIZADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    public function destroy($id): RedirectResponse
    {
        ModeloWifi::find($id)->delete();

        return Redirect::route('modelo-wifis.index')
        ->with('success', 'ELIMINADO CORRECTAMENTE')         
        ->with('icono', 'success');   
    }

    public function buscar(Request $request)
    {
        $buscar = $request->input('buscar');
        $resultados = ModeloWifi::where('modelo', 'like', '%' . $buscar . '%')->get();
        return response()->json($resultados);
    }
}
