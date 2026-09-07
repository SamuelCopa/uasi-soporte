<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use Illuminate\Http\Request;

class EspecialidadController extends Controller
{
    /**
     * Mostrar listado de especialidades.
     */
    public function index()
    {
        $especialidades = Especialidad::withCount('usuarios')
            ->orderBy('nombre', 'asc')
            ->get();

        return view('especialidad.index', compact('especialidades'));
    }

    /**
     * Guardar nueva especialidad.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100|unique:especialidades,nombre',
            'codigo' => 'required|string|max:50|unique:especialidades,codigo',
            'descripcion' => 'nullable|string|max:500',
            'activo' => 'nullable|boolean',
        ], [
            'nombre.required' => 'El nombre de la especialidad es obligatorio.',
            'nombre.unique' => 'La especialidad ya está registrada.',
            'codigo.required' => 'El código es obligatorio.',
            'codigo.unique' => 'El código ya está registrado.',
        ]);

        Especialidad::create([
            'nombre' => strtoupper(trim($request->nombre)),
            'codigo' => strtoupper(trim($request->codigo)),
            'descripcion' => $request->descripcion,
            'activo' => $request->has('activo'),
        ]);

        return redirect()
            ->route('especialidades.index')
            ->with('success', 'ESPECIALIDAD REGISTRADA CON ÉXITO')
            ->with('icono', 'success');
    }

    /**
     * Actualizar especialidad.
     */
    public function update(Request $request, $id)
    {
        $especialidad = Especialidad::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:100|unique:especialidades,nombre,' . $id,
            'codigo' => 'required|string|max:50|unique:especialidades,codigo,' . $id,
            'descripcion' => 'nullable|string|max:500',
            'activo' => 'nullable|boolean',
        ], [
            'nombre.required' => 'El nombre de la especialidad es obligatorio.',
            'nombre.unique' => 'La especialidad ya está registrada.',
            'codigo.required' => 'El código es obligatorio.',
            'codigo.unique' => 'El código ya está registrado.',
        ]);

        $especialidad->update([
            'nombre' => strtoupper(trim($request->nombre)),
            'codigo' => strtoupper(trim($request->codigo)),
            'descripcion' => $request->descripcion,
            'activo' => $request->has('activo'),
        ]);

        return redirect()
            ->route('especialidades.index')
            ->with('success', 'ESPECIALIDAD ACTUALIZADA CON ÉXITO')
            ->with('icono', 'success');
    }

    /**
     * Eliminar especialidad.
     */
    public function destroy($id)
    {
        $especialidad = Especialidad::findOrFail($id);

        // No permitir eliminar si tiene técnicos asignados.
        if ($especialidad->usuarios()->exists()) {
            return redirect()
                ->route('especialidades.index')
                ->with('success', 'NO SE PUEDE ELIMINAR LA ESPECIALIDAD PORQUE TIENE TÉCNICOS ASIGNADOS')
                ->with('icono', 'warning');
        }

        $especialidad->delete();

        return redirect()
            ->route('especialidades.index')
            ->with('success', 'ESPECIALIDAD ELIMINADA CON ÉXITO')
            ->with('icono', 'success');
    }
}