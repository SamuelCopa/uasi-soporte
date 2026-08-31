<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\EstadoUsuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rules\Password;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

        public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request): View                               
    {
        $users = User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['Administrador', 'SuperAdministrador']);
        })
        ->orderBy('paterno', 'asc')
        ->paginate();
        $roles = Role:: all();
        $estados = EstadoUsuario:: all();
        return view('user.index', compact('users', 'roles','estados'))
        ->with('i', ($request->input('page', 1) - 1) * $users->perPage());
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $user = new User();
        $roles = Role:: all();
        $estados = EstadoUsuario:: all();
        return view('user.create', compact('user', 'roles','estados'));
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(UserRequest $request): RedirectResponse
{
    $user = new User();

    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->ci = $request->input('ci');
    $user->expedido = $request->input('expedido');
    $user->celular = $request->input('celular');
    $user->paterno = $request->input('paterno');
    $user->materno = $request->input('materno');
    $user->id_estadousuario = $request->input('id_estadousuario');
    $user->password = Hash::make($request->input('password'));

    $user->save();

    // Asignar el rol seleccionado
    $user->assignRole($request->input('role'));

    return redirect()
        ->route('users.index')
        ->with('icono', 'success')
        ->with('success', 'USUARIO REGISTRADO CON EXITO');
}
    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $user = User::find($id);
        $impresoras = $user->impresoras;
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $user = User::find($id);
        $roles = Role::all();
        $estados = EstadoUsuario:: all();
        return view('user.edit', compact('user','roles', 'estados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request,  $id): RedirectResponse
    {
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->ci = $request->input('ci');
        $user->expedido = $request->input('expedido');
        $user->celular = $request->input('celular');
        $user->paterno = $request->input('paterno');
        $user->materno = $request->input('materno');
        $user->id_estadousuario = $request->input('id_estadousuario');
        $user->update();
        $user->roles()->sync($request->roles);

        return redirect()->route('users.index')
        ->with('success', 'REGISTRO ACTUALIZADO')
        ->with('icono', 'success');
    }

    public function destroy($id): RedirectResponse
    {
        User::find($id)->delete();
        return Redirect::route('users.index')
        ->with('success', 'ELIMINADO CORRECTAMENTE') 
        ->with('text', 'Registro eliminado')          
        ->with('icono', 'success');
    }

    public function updatePassword(Request $request, $id){
        $user = User::find($id);
        $user->password = Hash::make($request->input('password'));
        $user->update();
        return Redirect::route('users.index')
        ->with('success', 'ACTUALIZADO CORRECTAMENTE') 
        ->with('text', 'Se actualizo la contraseña')          
        ->with('icono', 'success');
    }
    
    public function cambiarEstado(Request $request)
    {
        $user = User::find($request->id);
        $estados = [1 => 2, 2 => 1] ;// Mapeo de estados
        $estadoSiguiente = $estados[$user->id_estadousuario];
        $user->id_estadousuario = $estadoSiguiente;
        $user->save();

        return response()->json(['estado' => $user->estadousuario->nombre]);
    }

// cambiar password desde el perfil-----------------------------
    public function cambiarPassword(Request $request)
    {
        $request->validate([
            'password_actual' => 'required',

            'password_nueva' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ],
        ]);

        $user = Auth::user();

        // Verificar contraseña actual
        if (!Hash::check($request->password_actual, $user->password)) {
            return back()->with('success', 'La contraseña actual no es correcta') 
            ->with('text', 'Error al actualizar la contraseña')          
            ->with('icono', 'error');
        }

        // Actualizar contraseña
        $user->password = Hash::make($request->password_nueva);
        $user->save();

        return back()->with('success', 'Contraseña actualizada correctamente') 
        ->with('text', 'Se actualizo la contraseña')          
        ->with('icono', 'success');
    }
}
