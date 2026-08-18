<?php

namespace App\Http\Controllers;

use App\Models\MarcaTmadre;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\MarcaTmadreRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class MarcaTmadreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $marcaTmadres = MarcaTmadre::paginate();

        return view('marca-tmadre.index', compact('marcaTmadres'))
            ->with('i', ($request->input('page', 1) - 1) * $marcaTmadres->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $marcaTmadre = new MarcaTmadre();

        return view('marca-tmadre.create', compact('marcaTmadre'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MarcaTmadreRequest $request): RedirectResponse
    {
        MarcaTmadre::create($request->validated());

        return Redirect::route('marca-tmadres.index')
        ->with('success', 'REGISTRADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $marcaTmadre = MarcaTmadre::find($id);

        return view('marca-tmadre.show', compact('marcaTmadre'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $marcaTmadre = MarcaTmadre::find($id);

        return view('marca-tmadre.edit', compact('marcaTmadre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MarcaTmadreRequest $request, MarcaTmadre $marcaTmadre): RedirectResponse
    {
        $marcaTmadre->update($request->validated());

        return Redirect::route('marca-tmadres.index')
        ->with('success', 'ACTUALIZADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    public function destroy($id): RedirectResponse
    {
        MarcaTmadre::find($id)->delete();

        return Redirect::route('marca-tmadres.index')
        ->with('success', 'ELIMINADO CORRECTAMENTE')         
        ->with('icono', 'success');   
    }

    public function buscar(Request $request)
    {
        $buscar = $request->input('buscar');
        $resultados = MarcaTmadre::where('marca', 'like', '%' . $buscar . '%')->get();
        return response()->json($resultados);
    }
}
