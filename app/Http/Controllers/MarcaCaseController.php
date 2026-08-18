<?php

namespace App\Http\Controllers;

use App\Models\MarcaCase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\MarcaCaseRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class MarcaCaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $marcaCases = MarcaCase::paginate();

        return view('marca-case.index', compact('marcaCases'))
            ->with('i', ($request->input('page', 1) - 1) * $marcaCases->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $marcaCase = new MarcaCase();

        return view('marca-case.create', compact('marcaCase'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MarcaCaseRequest $request): RedirectResponse
    {
        MarcaCase::create($request->validated());

        return Redirect::route('marca-cases.index')
        ->with('success', 'REGISTRADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $marcaCase = MarcaCase::find($id);

        return view('marca-case.show', compact('marcaCase'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $marcaCase = MarcaCase::find($id);

        return view('marca-case.edit', compact('marcaCase'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MarcaCaseRequest $request, MarcaCase $marcaCase): RedirectResponse
    {
        $marcaCase->update($request->validated());

        return Redirect::route('marca-cases.index')
        ->with('success', 'ACTUALIZADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    public function destroy($id): RedirectResponse
    {
        MarcaCase::find($id)->delete();

        return Redirect::route('marca-cases.index')
        ->with('success', 'ELIMINADO CORRECTAMENTE')         
        ->with('icono', 'success');   
    }

    public function buscar(Request $request)
    {
        $buscar = $request->input('buscar');
        $resultados = MarcaCase::where('marca', 'like', '%' . $buscar . '%')->get();
        return response()->json($resultados);
    }
}
