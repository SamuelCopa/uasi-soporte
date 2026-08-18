<?php

namespace App\Http\Controllers;

use App\Models\ColorCase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ColorCaseRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;


class ColorCaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $colorCases = ColorCase::paginate();

        return view('color-case.index', compact('colorCases'))
            ->with('i', ($request->input('page', 1) - 1) * $colorCases->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $colorCase = new ColorCase();

        return view('color-case.create', compact('colorCase'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ColorCaseRequest $request): RedirectResponse
    {
        ColorCase::create($request->validated());

        return Redirect::route('color-cases.index')
           ->with('success', 'CREADO CORRECTAMENTE.')
           ->with('icono', 'success'); 
          
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $colorCase = ColorCase::find($id);

        return view('color-case.show', compact('colorCase'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $colorCase = ColorCase::find($id);

        return view('color-case.edit', compact('colorCase'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ColorCaseRequest $request, ColorCase $colorCase): RedirectResponse
    {
        $colorCase->update($request->validated());

        return Redirect::route('color-cases.index')
            ->with('success', 'ACTUALIZADO CORRECTAMENTE')         
            ->with('icono', 'success');           
    }

    public function destroy($id): RedirectResponse
    {
        ColorCase::find($id)->delete();
        
        return Redirect::route('color-cases.index')
        ->with('success', 'ELIMINADO CORRECTAMENTE')         
        ->with('icono', 'success');   
    }

    public function buscar(Request $request)
    {
        $buscar = $request->input('buscar');
        $resultados = ColorCase::where('color', 'like', '%' . $buscar . '%')->get();
        return response()->json($resultados);
    }

    public function getColorsByMarca(Request $request)
    {
    $marcaId = $request->input('marca_id');
    $colores = ColorCase::where('marca_id', $marcaId)->get();
    return response()->json($colores);
    }

    public function obtenerColores($marcaId)
{
  $colores = ColorCase::where('marca_id', $marcaId)->get();
  return response()->json($colores);
}


}
