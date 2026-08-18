<?php

namespace App\Http\Controllers;

use App\Models\EstadoUsuario;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\EstadoUsuarioRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class EstadoUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $estadoUsuarios = EstadoUsuario::paginate();

        return view('estado-usuario.index', compact('estadoUsuarios'))
            ->with('i', ($request->input('page', 1) - 1) * $estadoUsuarios->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $estadoUsuario = new EstadoUsuario();

        return view('estado-usuario.create', compact('estadoUsuario'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EstadoUsuarioRequest $request): RedirectResponse
    {
        EstadoUsuario::create($request->validated());

        return Redirect::route('estado-usuarios.index')
            ->with('success', 'EstadoUsuario created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $estadoUsuario = EstadoUsuario::find($id);

        return view('estado-usuario.show', compact('estadoUsuario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $estadoUsuario = EstadoUsuario::find($id);

        return view('estado-usuario.edit', compact('estadoUsuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EstadoUsuarioRequest $request, EstadoUsuario $estadoUsuario): RedirectResponse
    {
        $estadoUsuario->update($request->validated());

        return Redirect::route('estado-usuarios.index')
            ->with('success', 'EstadoUsuario updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        EstadoUsuario::find($id)->delete();

        return Redirect::route('estado-usuarios.index')
            ->with('success', 'EstadoUsuario deleted successfully');
    }
}
