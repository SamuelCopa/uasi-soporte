<?php

namespace App\Http\Controllers;

use App\Models\ModeloTred;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ModeloTredRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ModeloTredController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $modeloTreds = ModeloTred::paginate();

        return view('modelo-tred.index', compact('modeloTreds'))
            ->with('i', ($request->input('page', 1) - 1) * $modeloTreds->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $modeloTred = new ModeloTred();

        return view('modelo-tred.create', compact('modeloTred'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ModeloTredRequest $request): RedirectResponse
    {
        ModeloTred::create($request->validated());

        return Redirect::route('modelo-treds.index')
        ->with('success', 'REGISTRADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $modeloTred = ModeloTred::find($id);

        return view('modelo-tred.show', compact('modeloTred'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $modeloTred = ModeloTred::find($id);

        return view('modelo-tred.edit', compact('modeloTred'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ModeloTredRequest $request, ModeloTred $modeloTred): RedirectResponse
    {
        $modeloTred->update($request->validated());

        return Redirect::route('modelo-treds.index')
        ->with('success', 'ACTUALIZADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    public function destroy($id): RedirectResponse
    {
        ModeloTred::find($id)->delete();

        return Redirect::route('modelo-treds.index')
        ->with('success', 'ELIMINADO CORRECTAMENTE')         
        ->with('icono', 'success');   
    }

    public function buscar(Request $request)
    {
        $buscar = $request->input('buscar');
        $resultados = ModeloTred::where('modelo', 'like', '%' . $buscar . '%')->get();
        return response()->json($resultados);
    }
}
