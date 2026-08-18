<?php

namespace App\Http\Controllers;

use App\Models\Responsable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ResponsableRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ResponsableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $responsables = Responsable::paginate();

        return view('responsable.index', compact('responsables'))
            ->with('i', ($request->input('page', 1) - 1) * $responsables->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $responsable = new Responsable();

        return view('responsable.create', compact('responsable'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ResponsableRequest $request): RedirectResponse
    {
        Responsable::create($request->validated());

        return Redirect::route('responsables.index')
        ->with('success', 'REGISTRADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $responsable = Responsable::find($id);

        return view('responsable.show', compact('responsable'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $responsable = Responsable::find($id);

        return view('responsable.edit', compact('responsable'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ResponsableRequest $request, Responsable $responsable): RedirectResponse
    {
        $responsable->update($request->validated());

        return Redirect::route('responsables.index')
        ->with('success', 'ACTUALIZADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    public function destroy($id): RedirectResponse
    {
        Responsable::find($id)->delete();

        return Redirect::route('responsables.index')
        ->with('success', 'ELIMINADO CORRECTAMENTE')         
        ->with('icono', 'success');   
    }
}
