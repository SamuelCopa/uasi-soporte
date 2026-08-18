<?php

namespace App\Http\Controllers;

use App\Models\TipoRam;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\TipoRamRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class TipoRamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $tipoRams = TipoRam::paginate();

        return view('tipo-ram.index', compact('tipoRams'))
            ->with('i', ($request->input('page', 1) - 1) * $tipoRams->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $tipoRam = new TipoRam();

        return view('tipo-ram.create', compact('tipoRam'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TipoRamRequest $request): RedirectResponse
    {
        TipoRam::create($request->validated());

        return Redirect::route('tipo-rams.index')
        ->with('success', 'REGISTRADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $tipoRam = TipoRam::find($id);

        return view('tipo-ram.show', compact('tipoRam'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $tipoRam = TipoRam::find($id);

        return view('tipo-ram.edit', compact('tipoRam'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TipoRamRequest $request, TipoRam $tipoRam): RedirectResponse
    {
        $tipoRam->update($request->validated());

        return Redirect::route('tipo-rams.index')
        ->with('success', 'ACTUALIZADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    public function destroy($id): RedirectResponse
    {
        TipoRam::find($id)->delete();

        return Redirect::route('tipo-rams.index')
        ->with('success', 'ELIMINADO CORRECTAMENTE')         
        ->with('icono', 'success');   
    }




    //     public function buscar(Request $request)
    // {
    //     $response = Http::get('https://www.googleapis.com/customsearch/v1', [
    //         'key' => env('GOOGLE_API_KEY'),
    //         'cx' => env('GOOGLE_CX'),
    //         'q' => $request->input('query'),
    //     ]);

    //     $resultados = $response->json()['items'] ?? [];

    //     return view('busqueda.resultados', compact('resultados'));
    // }

    // public function guardarSeleccion(Request $request)
    // {
    //     foreach ($request->input('seleccionados', []) as $item) {
    //         TipoRam::create([
    //             'titulo' => $item['titulo'],
    //             'url' => $item['url'],
    //             'descripcion' => $item['descripcion'] ?? '',
    //         ]);
    //     }

    //     return redirect()->route('busqueda.formulario')->with('success', 'Resultados guardados.');
    // }
}
