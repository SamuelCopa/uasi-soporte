<?php

namespace App\Http\Controllers;

use App\Models\MarcaDisco;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\MarcaDiscoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class MarcaDiscoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $marcaDiscos = MarcaDisco::paginate();

        return view('marca-disco.index', compact('marcaDiscos'))
            ->with('i', ($request->input('page', 1) - 1) * $marcaDiscos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $marcaDisco = new MarcaDisco();

        return view('marca-disco.create', compact('marcaDisco'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MarcaDiscoRequest $request): RedirectResponse
    {
        MarcaDisco::create($request->validated());

        return Redirect::route('marca-discos.index')
        ->with('success', 'REGISTRADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $marcaDisco = MarcaDisco::find($id);

        return view('marca-disco.show', compact('marcaDisco'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $marcaDisco = MarcaDisco::find($id);

        return view('marca-disco.edit', compact('marcaDisco'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MarcaDiscoRequest $request, MarcaDisco $marcaDisco): RedirectResponse
    {
        $marcaDisco->update($request->validated());

        return Redirect::route('marca-discos.index')
        ->with('success', 'ACTUALIZADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    public function destroy($id): RedirectResponse
    {
        MarcaDisco::find($id)->delete();

        return Redirect::route('marca-discos.index')
        ->with('success', 'ELIMINADO CORRECTAMENTE')         
        ->with('icono', 'success');   
    }

    public function buscar(Request $request)
    {
        $buscar = $request->input('buscar');
        $resultados = MarcaDisco::where('marca', 'like', '%' . $buscar . '%')->get();
        return response()->json($resultados);
    }
}
