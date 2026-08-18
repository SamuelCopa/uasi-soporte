<?php

namespace App\Http\Controllers;

use App\Models\ModeloTvideo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ModeloTvideoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ModeloTvideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $modeloTvideos = ModeloTvideo::paginate();

        return view('modelo-tvideo.index', compact('modeloTvideos'))
            ->with('i', ($request->input('page', 1) - 1) * $modeloTvideos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $modeloTvideo = new ModeloTvideo();

        return view('modelo-tvideo.create', compact('modeloTvideo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ModeloTvideoRequest $request): RedirectResponse
    {
        ModeloTvideo::create($request->validated());

        return Redirect::route('modelo-tvideos.index')
        ->with('success', 'REGISTRADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $modeloTvideo = ModeloTvideo::find($id);

        return view('modelo-tvideo.show', compact('modeloTvideo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $modeloTvideo = ModeloTvideo::find($id);

        return view('modelo-tvideo.edit', compact('modeloTvideo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ModeloTvideoRequest $request, ModeloTvideo $modeloTvideo): RedirectResponse
    {
        $modeloTvideo->update($request->validated());

        return Redirect::route('modelo-tvideos.index')
        ->with('success', 'ACTUALIZADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    public function destroy($id): RedirectResponse
    {
        ModeloTvideo::find($id)->delete();

        return Redirect::route('modelo-tvideos.index')
        ->with('success', 'ELIMINADO CORRECTAMENTE')         
        ->with('icono', 'success');   
    }

    public function buscar(Request $request)
    {
        $buscar = $request->input('buscar');
        $resultados = ModeloTvideo::where('modelo', 'like', '%' . $buscar . '%')->get();
        return response()->json($resultados);
    }
}
