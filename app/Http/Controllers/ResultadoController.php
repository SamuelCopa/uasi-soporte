<?php

namespace App\Http\Controllers;

use App\Models\Resultado;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ResultadoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ResultadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $resultados = Resultado::paginate();

        return view('resultado.index', compact('resultados'))
            ->with('i', ($request->input('page', 1) - 1) * $resultados->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $resultado = new Resultado();

        return view('resultado.create', compact('resultado'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ResultadoRequest $request): RedirectResponse
    {
        Resultado::create($request->validated());

        return Redirect::route('resultados.index')
            ->with('success', 'Resultado created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $resultado = Resultado::find($id);

        return view('resultado.show', compact('resultado'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $resultado = Resultado::find($id);

        return view('resultado.edit', compact('resultado'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ResultadoRequest $request, Resultado $resultado): RedirectResponse
    {
        $resultado->update($request->validated());

        return Redirect::route('resultados.index')
            ->with('success', 'Resultado updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Resultado::find($id)->delete();

        return Redirect::route('resultados.index')
            ->with('success', 'Resultado deleted successfully');
    }
}
