<?php

namespace App\Http\Controllers;

use App\Models\MarcaTred;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\MarcaTredRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class MarcaTredController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $marcaTreds = MarcaTred::paginate();

        return view('marca-tred.index', compact('marcaTreds'))
            ->with('i', ($request->input('page', 1) - 1) * $marcaTreds->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $marcaTred = new MarcaTred();

        return view('marca-tred.create', compact('marcaTred'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MarcaTredRequest $request): RedirectResponse
    {
        MarcaTred::create($request->validated());

        return Redirect::route('marca-treds.index')
        ->with('success', 'REGISTRADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $marcaTred = MarcaTred::find($id);

        return view('marca-tred.show', compact('marcaTred'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $marcaTred = MarcaTred::find($id);

        return view('marca-tred.edit', compact('marcaTred'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MarcaTredRequest $request, MarcaTred $marcaTred): RedirectResponse
    {
        $marcaTred->update($request->validated());

        return Redirect::route('marca-treds.index')
        ->with('success', 'ACTUALIZADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    public function destroy($id): RedirectResponse
    {
        MarcaTred::find($id)->delete();

        return Redirect::route('marca-treds.index')
        ->with('success', 'ELIMINADO CORRECTAMENTE')         
        ->with('icono', 'success');   
    }

    public function buscar(Request $request)
    {
        $buscar = $request->input('buscar');
        $resultados = MarcaTred::where('marca', 'like', '%' . $buscar . '%')->get();
        return response()->json($resultados);
    }
}
