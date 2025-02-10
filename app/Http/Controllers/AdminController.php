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
        return view('admin.panel', compact('usuarios', 'espacios', 'reservas'));
    }



    public function updateUser(Request $request, $id)
    {
        $usuario = \App\Models\User::findOrFail($id);
        $usuario->update(['rol' => $request->rol]);
        return redirect()->route('admin.panel')->with('success', 'Rol actualizado correctamente.');
    }

    public function deleteUser($id)
    {
        $usuario = \App\Models\User::findOrFail($id);
        $usuario->delete();
        return redirect()->route('admin.panel')->with('success', 'Usuario eliminado correctamente.');
    }

//     public function editUser($id)
// {
//     // Busca el usuario por ID o lanza un error 404 si no se encuentra
//     $user = \App\Models\User::findOrFail($id);
//     // Retorna la vista de edición pasando el usuario encontrado
//     return view('admin.editUser', compact('user'));
// }

}
