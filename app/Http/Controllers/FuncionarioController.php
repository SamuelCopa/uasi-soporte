<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\FuncionarioRequest;
use App\Models\Dependencia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class FuncionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $funcionarios = Funcionario::paginate();
        $dependencia = Dependencia::orderBy('dependencias', 'asc')->get();

        return view('funcionario.index', compact('funcionarios', 'dependencia'))
            ->with('i', ($request->input('page', 1) - 1) * $funcionarios->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $funcionario = new Funcionario();
        $dependencia = Dependencia::orderBy('dependencias', 'asc')->get();

        return view('funcionario.create', compact('funcionario', 'dependencia'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $funcionario = new Funcionario();

        // Asignar los valores de los campos
        $funcionario->grado_academico = $request->input('grado_academico');
        $funcionario->paterno = $request->input('paterno');
        $funcionario->materno = $request->input('materno');
        $funcionario->nombre = $request->input('nombre');
        $funcionario->ci = $request->input('ci');
        $funcionario->expedido = $request->input('expedido');
        $funcionario->celular = $request->input('celular');
        $funcionario->email = $request->input('email');
        $funcionario->cargo = $request->input('cargo');
        $funcionario->dependencia_id = $request->input('dependencia_id');

        // Guardar los cambios
        $funcionario->save();

        return Redirect::route('funcionarios.index')
        ->with('success', 'REGISTRADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $funcionario = Funcionario::find($id);

        return view('funcionario.show', compact('funcionario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $funcionario = Funcionario::find($id);
            $dependencia = Dependencia::orderBy('dependencias', 'asc')->get();

        return view('funcionario.edit', compact('funcionario', 'dependencia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $funcionario = Funcionario::find($id);
                $funcionarioExistente = Funcionario::where('ci', $request->input('ci'))->first();
                if ($funcionarioExistente && $funcionarioExistente->id != $funcionario->id) {
        // Si el funcionario ya existe y no es el mismo, asigna el ID existente
        $funcionario->funcionario_id = $funcionarioExistente->id;
        } else {
            // Si no existe o es el mismo, actualiza el funcionario
            if(empty($request->input('cargo'))){
            $request->merge(['cargo' => 'EX FUNCIONARIO']);
            }
            $funcionario->grado_academico = $request->input('grado_academico');
            $funcionario->paterno = $request->input('paterno');
            $funcionario->materno = $request->input('materno');
            $funcionario->nombre = $request->input('nombre');
            $funcionario->ci = $request->input('ci');
            $funcionario->expedido = $request->input('expedido');
            $funcionario->celular = $request->input('celular');
            $funcionario->email = $request->input('email');
            $funcionario->cargo = $request->input('cargo');
            $funcionario->dependencia_id = $request->input('dependencia_id');
            $funcionario->save();

        }

        return Redirect::route('funcionarios.index')
        ->with('success', 'ACTUALIZADO CORRECTAMENTE')         
        ->with('icono', 'success');
    }

    public function destroy($id): RedirectResponse
    {
        Funcionario::find($id)->delete();

        return Redirect::route('funcionarios.index')
        ->with('success', 'ELIMINADO CORRECTAMENTE')         
        ->with('icono', 'success');   
    }

    public function buscarFuncionario(Request $request)
    {
        $query = $request->input('query');
        $datos = Funcionario::where('ci', 'LIKE', $query)
        ->with('dependencia')->get();
        return response()->json($datos);
    }

}
