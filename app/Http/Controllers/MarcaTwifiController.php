<?php

namespace App\Http\Controllers;

use App\Models\MarcaTwifi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\MarcaTwifiRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class MarcaTwifiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $marcaTwifis = MarcaTwifi::paginate();

        return view('marca-twifi.index', compact('marcaTwifis'))
            ->with('i', ($request->input('page', 1) - 1) * $marcaTwifis->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $marcaTwifi = new MarcaTwifi();

        return view('marca-twifi.create', compact('marcaTwifi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MarcaTwifiRequest $request): RedirectResponse
    {
        MarcaTwifi::create($request->validated());

        return Redirect::route('marca-twifis.index')
        ->with('success', 'REGISTRADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $marcaTwifi = MarcaTwifi::find($id);

        return view('marca-twifi.show', compact('marcaTwifi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $marcaTwifi = MarcaTwifi::find($id);

        return view('marca-twifi.edit', compact('marcaTwifi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MarcaTwifiRequest $request, MarcaTwifi $marcaTwifi): RedirectResponse
    {
        $marcaTwifi->update($request->validated());

        return Redirect::route('marca-twifis.index')
        ->with('success', 'ACTUALIZADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    public function destroy($id): RedirectResponse
    {
        MarcaTwifi::find($id)->delete();

        return Redirect::route('marca-twifis.index')
        ->with('success', 'ELIMINADO CORRECTAMENTE')         
        ->with('icono', 'success');   
    }

    public function buscar(Request $request)
    {
        $buscar = $request->input('buscar');
        $resultados = MarcaTwifi::where('marca', 'like', '%' . $buscar . '%')->get();
        return response()->json($resultados);
    }
}
