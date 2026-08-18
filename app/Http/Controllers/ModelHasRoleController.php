<?php

namespace App\Http\Controllers;

use App\Models\ModelHasRole;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ModelHasRoleRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ModelHasRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $modelHasRoles = ModelHasRole::paginate();

        return view('model-has-role.index', compact('modelHasRoles'))
            ->with('i', ($request->input('page', 1) - 1) * $modelHasRoles->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $modelHasRole = new ModelHasRole();

        return view('model-has-role.create', compact('modelHasRole'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ModelHasRoleRequest $request): RedirectResponse
    {
        ModelHasRole::create($request->validated());

        return Redirect::route('model-has-roles.index')
        ->with('success', 'REGISTRADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $modelHasRole = ModelHasRole::find($id);

        return view('model-has-role.show', compact('modelHasRole'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $modelHasRole = ModelHasRole::find($id);

        return view('model-has-role.edit', compact('modelHasRole'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ModelHasRoleRequest $request, ModelHasRole $modelHasRole): RedirectResponse
    {
        $modelHasRole->update($request->validated());

        return Redirect::route('model-has-roles.index')
            ->with('success', 'ModelHasRole updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        ModelHasRole::find($id)->delete();

        return Redirect::route('model-has-roles.index')
            ->with('success', 'ModelHasRole deleted successfully');
    }
}
