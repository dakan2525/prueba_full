<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view("users.index", compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|string',
            'email' => 'required|unique:users,email',
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ], [
            'email.unique' => 'Este correo electronico ya existe'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 'Activo'
        ]);

        if ($user) {
            return redirect()->back()->with('success', 'Su usuario ha sido creado con éxito');
        } else {
            return redirect()->back()->with('fail', 'Tu usuario no ha sido creado');
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
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {


        if ($request->password === null) {
            $request->validate([
                'name' => 'required|max:255|string',
            ]);

            $user->update([
                'name' => $request->name,
                'password' => $user->password,
                'status' => 'Activo'
            ]);
        } else {
            $request->validate([
                'name' => 'required|max:255|string',
                'password' => ['required', 'string', 'min:8', 'confirmed']
            ]);

            $user->update([
                'name' => $request->name,
                'password' => Hash::make($request->password),
                'status' => 'Activo'
            ]);
        }

        // dd($user);

        if ($user) {
            return redirect()->route("users.index")->with('success', 'Su usuario ha sido actualizado con éxito');
        } else {
            return redirect()->back()->with('fail', 'Tu usuario no ha sido actualizado');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->back()->with('success', 'Usuario eliminado correctamente');
    }

    public function changeStatus(User $user)
    {

        $user->status === "Activo" ? $user->status = "Inactivo" : $user->status = "Activo";
        $user->save();
        if ($user) {
            return redirect()->back()->with('success', 'Estado actualizado');
        } else {
            return redirect()->back()->with('fail', 'Error al actualizar el usuario');
        }
    }
}
