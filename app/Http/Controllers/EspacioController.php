<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Espacio;

class EspacioController extends Controller
{
    public function index()
    {
        $espacios = Espacio::all();
        return view('espacios.index', compact('espacios'));
    }

    public function create()
    {
        return view('espacios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'capacity' => 'required|integer|min:1',
            'precio_por_hora' => 'required|numeric|min:0',
        ]);

        Espacio::create($request->all());
        return redirect()->route('espacios.index')->with('success', 'Espacio creado correctamente');
    }

    public function edit(Espacio $espacio)
    {
        return view('espacios.edit', compact('espacio'));
    }

    public function update(Request $request, Espacio $espacio)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'capacity' => 'required|integer|min:1',
            'precio_por_hora' => 'required|numeric|min:0',
        ]);

        $espacio->update($request->all());
        return redirect()->route('espacios.index')->with('success', 'Espacio actualizado');
    }

    public function destroy(Espacio $espacio)
    {
        $espacio->delete();
        return redirect()->route('espacios.index')->with('success', 'Espacio eliminado');
    }
}
