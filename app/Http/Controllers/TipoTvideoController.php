<?php

namespace App\Http\Controllers;

use App\Models\TipoTvideo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\TipoTvideoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class TipoTvideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $tipoTvideos = TipoTvideo::paginate();

        return view('tipo-tvideo.index', compact('tipoTvideos'))
            ->with('i', ($request->input('page', 1) - 1) * $tipoTvideos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $tipoTvideo = new TipoTvideo();

        return view('tipo-tvideo.create', compact('tipoTvideo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TipoTvideoRequest $request): RedirectResponse
    {
        TipoTvideo::create($request->validated());

        return Redirect::route('tipo-tvideos.index')
        ->with('success', 'REGISTRADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $tipoTvideo = TipoTvideo::find($id);

        return view('tipo-tvideo.show', compact('tipoTvideo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $tipoTvideo = TipoTvideo::find($id);

        return view('tipo-tvideo.edit', compact('tipoTvideo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TipoTvideoRequest $request, TipoTvideo $tipoTvideo): RedirectResponse
    {
        $tipoTvideo->update($request->validated());

        return Redirect::route('tipo-tvideos.index')
        ->with('success', 'ACTUALIZADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    public function destroy($id): RedirectResponse
    {
        TipoTvideo::find($id)->delete();

        return Redirect::route('tipo-tvideos.index')
        ->with('success', 'ELIMINADO CORRECTAMENTE')         
        ->with('icono', 'success');   
    }

    public function buscar(Request $request)
    {
        $buscar = $request->input('buscar');
        $resultados = TipoTvideo::where('tipo', 'like', '%' . $buscar . '%')->get();
        return response()->json($resultados);
    }
}
