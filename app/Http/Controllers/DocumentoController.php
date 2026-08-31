<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentoController extends Controller
{
    /**
     * Mostrar documentos.
     */
    public function index()
    {
        $documentos = Documento::latest()->get();

        return view(
            'documentos.index',
            compact('documentos')
        );
    }

    /**
     * Mostrar formulario de carga.
     */
    public function create()
    {
        return view('documentos.create');
    }

    /**
     * Guardar documento.
     */
public function store(Request $request)
{
    $request->validate([
        'titulo' => 'required|string|max:255',

        'archivo' => [
            'required',
            'file',
            'mimes:pdf,doc,docx',
            'max:10240',
        ],
    ]);

    $archivo = $request->file('archivo');

    $nombreOriginal = $archivo->getClientOriginalName();

    $ruta = $archivo->store(
        'documentos',
        'public'
    );

    Documento::create([
        'titulo' => $request->titulo,
        'archivo' => $ruta,
        'nombre_original' => $nombreOriginal,
        'tipo' => $archivo->getMimeType(),
        'tamanio' => $archivo->getSize(),
    ]);

    return redirect()
        ->route('documentos.index')
        ->with('icono', 'success')
        ->with('success', 'DOCUMENTO CARGADO CORRECTAMENTE');
}

    public function edit(Documento $documento)
{
    return view('documentos.edit', compact('documento'));
}

public function update(Request $request, Documento $documento)
{
    $request->validate([
        'titulo' => 'required|string|max:255',

        'archivo' => [
            'nullable',
            'file',
            'mimes:pdf,doc,docx',
            'max:10240',
        ],
    ]);

    $documento->titulo = $request->titulo;

    if ($request->hasFile('archivo')) {

        $archivo = $request->file('archivo');

        // Eliminar archivo anterior
        if (
            $documento->archivo &&
            Storage::disk('public')->exists($documento->archivo)
        ) {
            Storage::disk('public')->delete($documento->archivo);
        }

        // Guardar nuevo archivo
        $ruta = $archivo->store(
            'documentos',
            'public'
        );

        $documento->archivo = $ruta;
        $documento->nombre_original = $archivo->getClientOriginalName();
        $documento->tipo = $archivo->getMimeType();
        $documento->tamanio = $archivo->getSize();
    }

    $documento->save();

    return redirect()
        ->route('documentos.index')
        ->with('icono', 'success')
        ->with('success', 'DOCUMENTO ACTUALIZADO CORRECTAMENTE');
}

    /**
     * Descargar documento.
     */
    public function descargar(Documento $documento)
    {
        if (!Storage::disk('public')->exists($documento->archivo)) {
            abort(404);
        }

        return Storage::disk('public')->download(
            $documento->archivo,
            $documento->nombre_original
        );
    }

    /**
     * Eliminar documento.
     */
    public function destroy(Documento $documento)
    {
        if (
            Storage::disk('public')->exists(
                $documento->archivo
            )
        ) {
            Storage::disk('public')->delete(
                $documento->archivo
            );
        }

        $documento->delete();

        return redirect()
            ->route('documentos.index')
            ->with('icono', 'success')
            ->with(
                'success',
                'DOCUMENTO ELIMINADO CORRECTAMENTE'
            );
    }


}