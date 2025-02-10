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
        $allEspacios = \App\Models\Espacio::all(); // Agrega esta línea para obtener todos los espacios

        return view('admin.panel', compact('usuarios', 'espacios', 'reservas', 'allEspacios'));
    }

    public function updateUser(Request $request, $id)
    {
        // Buscar el usuario o lanzar un error 404
        $user = \App\Models\User::findOrFail($id);

        // Validar los datos recibidos
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'rol'   => 'required|in:Usuario,Administrador',
        ]);

        // Actualizar el usuario con los datos validados
        $user->update($validated);

        // Devolver la información actualizada en formato JSON
        return response()->json($user);
    }



    public function deleteUser($id)
    {
        $usuario = \App\Models\User::findOrFail($id);
        $usuario->delete();
        return redirect()->route('admin.panel')->with('success', 'Usuario eliminado correctamente.');
    }
}
