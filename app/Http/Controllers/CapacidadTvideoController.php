<?php

namespace App\Http\Controllers;

use App\Models\CapacidadTvideo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CapacidadTvideoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CapacidadTvideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $capacidadTvideos = CapacidadTvideo::paginate();

        return view('capacidad-tvideo.index', compact('capacidadTvideos'))
            ->with('i', ($request->input('page', 1) - 1) * $capacidadTvideos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $capacidadTvideo = new CapacidadTvideo();

        return view('capacidad-tvideo.create', compact('capacidadTvideo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CapacidadTvideoRequest $request): RedirectResponse
    {
        CapacidadTvideo::create($request->validated());

        return Redirect::route('capacidad-tvideos.index')
        ->with('success', 'REGISTRADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $capacidadTvideo = CapacidadTvideo::find($id);

        return view('capacidad-tvideo.show', compact('capacidadTvideo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $capacidadTvideo = CapacidadTvideo::find($id);

        return view('capacidad-tvideo.edit', compact('capacidadTvideo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CapacidadTvideoRequest $request, CapacidadTvideo $capacidadTvideo): RedirectResponse
    {
        $capacidadTvideo->update($request->validated());

        return Redirect::route('capacidad-tvideos.index')
        ->with('success', 'ACTUALIZADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    public function destroy($id): RedirectResponse
    {
        CapacidadTvideo::find($id)->delete();

        return Redirect::route('capacidad-tvideos.index')
            ->with('success', 'ELIMINADO CORRECTAMENTE')
            ->with('icono', 'success');
    }

    public function buscar(Request $request)
    {
        $buscar = $request->input('buscar');
        $resultados = CapacidadTvideo::where('capacidad', 'like', '%' . $buscar . '%')->get();
        return response()->json($resultados);
    }
}
