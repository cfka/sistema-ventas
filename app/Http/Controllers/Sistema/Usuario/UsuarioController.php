<?php

namespace App\Http\Controllers\Sistema\Usuario;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sistema\Usuario\UsuarioRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('sistema.usuario.usuario.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usuario = new User();
        $users =  User::where('employeer', null)
                        ->where('id', '!=', $usuario->id)
                        ->get();
        $roles = Role::all();
        return view('sistema.usuario.usuario.create', compact('usuario','users', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UsuarioRequest $request)
    {

        try {
            $usuario = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'employeer' => $request->employeer,
                'password' => Hash::make(trim($request->password)),
            ]);
            $usuario->assignRole($request->rol);

            alert()->success('Éxito', 'Registro Guardado Exitosamente');
            return redirect()->route('usuarios.index');
        } catch (\Exception $e) {
            alert()->error('Error', 'Transacci&oacute;n Fallida');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $usuario)
    {
        $users =  User::where('employeer', null)
                        ->where('id', '!=', $usuario->id)
                        ->get();
        $roles = Role::all();
        return view('sistema.usuario.usuario.edit', compact('usuario','users', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UsuarioRequest $request, User $usuario)
    {

        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'employeer' => $request->employeer,
            ];

            if (!empty($request->password)) {
                $data['password'] = Hash::make(trim($request->password));
            }

            $usuario->update($data);
            $usuario->syncRoles($request->rol);
            alert()->success('Éxito', 'Registro Actualizado Exitosamente');
            return redirect()->route('usuarios.index');
        } catch (\Exception $e) {
            dd($e);
            alert()->error('Error', 'Transacci&oacute;n Fallida');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
