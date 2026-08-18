<?php

namespace App\Http\Controllers;

use App\Models\MarcaTvideo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\MarcaTvideoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class MarcaTvideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $marcaTvideos = MarcaTvideo::paginate();

        return view('marca-tvideo.index', compact('marcaTvideos'))
            ->with('i', ($request->input('page', 1) - 1) * $marcaTvideos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $marcaTvideo = new MarcaTvideo();

        return view('marca-tvideo.create', compact('marcaTvideo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MarcaTvideoRequest $request): RedirectResponse
    {
        MarcaTvideo::create($request->validated());

        return Redirect::route('marca-tvideos.index')
        ->with('success', 'REGISTRADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $marcaTvideo = MarcaTvideo::find($id);

        return view('marca-tvideo.show', compact('marcaTvideo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $marcaTvideo = MarcaTvideo::find($id);

        return view('marca-tvideo.edit', compact('marcaTvideo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MarcaTvideoRequest $request, MarcaTvideo $marcaTvideo): RedirectResponse
    {
        $marcaTvideo->update($request->validated());

        return Redirect::route('marca-tvideos.index')
            ->with('success', 'ACTUALIZADO CORRECTAMENTE')         
            ->with('icono', 'success');
    }

    public function destroy($id): RedirectResponse
    {
        MarcaTvideo::find($id)->delete();

        return Redirect::route('marca-tvideos.index')
        ->with('success', 'ELIMINADO CORRECTAMENTE')         
        ->with('icono', 'success');   
    }

    public function buscar(Request $request)
    {
        $buscar = $request->input('buscar');
        $resultados = MarcaTvideo::where('marca', 'like', '%' . $buscar . '%')->get();
        return response()->json($resultados);
    }
}
