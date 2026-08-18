<?php

namespace App\Http\Controllers;

use App\Models\GenProcesador;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\GenProcesadorRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class GenProcesadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $genProcesadors = GenProcesador::paginate();

        return view('gen-procesador.index', compact('genProcesadors'))
            ->with('i', ($request->input('page', 1) - 1) * $genProcesadors->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $genProcesador = new GenProcesador();

        return view('gen-procesador.create', compact('genProcesador'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GenProcesadorRequest $request): RedirectResponse
    {
        GenProcesador::create($request->validated());

        return Redirect::route('gen-procesadors.index')
        ->with('success', 'REGISTRADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $genProcesador = GenProcesador::find($id);

        return view('gen-procesador.show', compact('genProcesador'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $genProcesador = GenProcesador::find($id);

        return view('gen-procesador.edit', compact('genProcesador'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GenProcesadorRequest $request, GenProcesador $genProcesador): RedirectResponse
    {
        $genProcesador->update($request->validated());

        return Redirect::route('gen-procesadors.index')
        ->with('success', 'ACTUALIZADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    public function destroy($id): RedirectResponse
    {
        GenProcesador::find($id)->delete();

        return Redirect::route('gen-procesadors.index')
        ->with('success', 'ELIMINADO CORRECTAMENTE')         
        ->with('icono', 'success');   
    }

    public function buscar(Request $request)
    {
        $buscar = $request->input('buscar');
        $resultados = GenProcesador::where('generacion', 'like', '%' . $buscar . '%')->get();
        return response()->json($resultados);
    }
}
