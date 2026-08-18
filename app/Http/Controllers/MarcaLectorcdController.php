<?php

namespace App\Http\Controllers;

use App\Models\MarcaLectorcd;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\MarcaLectorcdRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class MarcaLectorcdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $marcaLectorcds = MarcaLectorcd::paginate();

        return view('marca-lectorcd.index', compact('marcaLectorcds'))
            ->with('i', ($request->input('page', 1) - 1) * $marcaLectorcds->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $marcaLectorcd = new MarcaLectorcd();

        return view('marca-lectorcd.create', compact('marcaLectorcd'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MarcaLectorcdRequest $request): RedirectResponse
    {
        MarcaLectorcd::create($request->validated());

        return Redirect::route('marca-lectorcds.index')
        ->with('success', 'REGISTRADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $marcaLectorcd = MarcaLectorcd::find($id);

        return view('marca-lectorcd.show', compact('marcaLectorcd'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $marcaLectorcd = MarcaLectorcd::find($id);

        return view('marca-lectorcd.edit', compact('marcaLectorcd'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MarcaLectorcdRequest $request, MarcaLectorcd $marcaLectorcd): RedirectResponse
    {
        $marcaLectorcd->update($request->validated());

        return Redirect::route('marca-lectorcds.index')
        ->with('success', 'ACTUALIZADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    public function destroy($id): RedirectResponse
    {
        MarcaLectorcd::find($id)->delete();

        return Redirect::route('marca-lectorcds.index')
        ->with('success', 'ELIMINADO CORRECTAMENTE')         
        ->with('icono', 'success');   
    }

    public function buscar(Request $request)
    {
        $buscar = $request->input('buscar');
        $resultados = MarcaLectorcd::where('nombre', 'like', '%' . $buscar . '%')->get();
        return response()->json($resultados);
    }
}
