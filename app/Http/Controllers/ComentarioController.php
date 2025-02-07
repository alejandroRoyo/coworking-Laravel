<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comentario;

class ComentarioController extends Controller
{
    // Muestra el formulario para crear un comentario
    public function create()
    {
        return view('comentarios.create');
    }

    // Guarda el comentario en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'nombre'     => 'nullable|string|max:255',
            'comentario' => 'required|string',
        ]);

        Comentario::create($request->only('nombre', 'comentario'));

        return redirect()->route('home')->with('success', 'Comentario agregado correctamente.');
    }
}
