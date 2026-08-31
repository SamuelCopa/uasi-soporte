<?php

namespace App\Http\Controllers;

use App\Models\Termino;
use Illuminate\Http\Request;

class TerminoController extends Controller
{
    /**
     * Mostrar formulario para editar términos.
     */
    public function edit()
    {
        $termino = Termino::first();

        return view('terminos.edit', compact('termino'));
    }

    /**
     * Actualizar términos.
     */
    public function update(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required',
        ]);

        $termino = Termino::first();

        if (!$termino) {
            $termino = new Termino();
        }

        $termino->titulo = $request->titulo;
        $termino->contenido = $request->contenido;
        $termino->save();

        return redirect()
            ->route('terminos.edit')
            ->with('icono', 'success')
            ->with(
                'success',
                'TÉRMINOS Y CONDICIONES ACTUALIZADOS CORRECTAMENTE'
            );
    }
}