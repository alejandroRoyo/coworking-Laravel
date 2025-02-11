<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $usuarios = \App\Models\User::paginate(10);
        $espacios = \App\Models\Espacio::paginate(10);
        $reservas = \App\Models\Reserva::with(['usuario', 'espacio'])->paginate(10);
        $allEspacios = \App\Models\Espacio::all(); // Para otras operaciones

        return view('admin.panel', compact('usuarios', 'espacios', 'reservas', 'allEspacios'));
    }


    public function editUser($id)
    {
        $user = \App\Models\User::findOrFail($id);
        return view('admin.editUser', compact('user'));
    }


    public function updateUser(Request $request, $id)
    {
        $user = \App\Models\User::findOrFail($id);

        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'rol'   => 'required|in:Usuario,Administrador',
        ]);

        $user->update($validated);

        return redirect()->route('admin.panel')->with('success', 'Usuario actualizado correctamente.');
    }




    public function deleteUser($id)
    {
        $usuario = \App\Models\User::findOrFail($id);
        $usuario->delete();
        return redirect()->route('admin.panel')->with('success', 'Usuario eliminado correctamente.');
    }
}
