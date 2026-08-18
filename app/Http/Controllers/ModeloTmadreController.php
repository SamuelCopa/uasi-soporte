<?php

namespace App\Http\Controllers;

use App\Models\ModeloTmadre;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ModeloTmadreRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ModeloTmadreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $modeloTmadres = ModeloTmadre::paginate();

        return view('modelo-tmadre.index', compact('modeloTmadres'))
            ->with('i', ($request->input('page', 1) - 1) * $modeloTmadres->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $modeloTmadre = new ModeloTmadre();

        return view('modelo-tmadre.create', compact('modeloTmadre'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ModeloTmadreRequest $request): RedirectResponse
    {
        ModeloTmadre::create($request->validated());

        return Redirect::route('modelo-tmadres.index')
        ->with('success', 'REGISTRADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $modeloTmadre = ModeloTmadre::find($id);

        return view('modelo-tmadre.show', compact('modeloTmadre'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $modeloTmadre = ModeloTmadre::find($id);

        return view('modelo-tmadre.edit', compact('modeloTmadre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ModeloTmadreRequest $request, ModeloTmadre $modeloTmadre): RedirectResponse
    {
        $modeloTmadre->update($request->validated());

        return Redirect::route('modelo-tmadres.index')
        ->with('success', 'ACTUALIZADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    public function destroy($id): RedirectResponse
    {
        ModeloTmadre::find($id)->delete();

        return Redirect::route('modelo-tmadres.index')
        ->with('success', 'ELIMINADO CORRECTAMENTE')         
        ->with('icono', 'success');   
    }

    public function buscar(Request $request)
    {
        $buscar = $request->input('buscar');
        $resultados = ModeloTmadre::where('modelo', 'like', '%' . $buscar . '%')->get();
        return response()->json($resultados);
    }
}
