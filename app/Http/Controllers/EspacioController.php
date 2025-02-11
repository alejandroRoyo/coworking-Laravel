<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Espacio;

class EspacioController extends Controller
{
    public function index()
    {
        // Esta acción se utiliza para el listado general (por ejemplo, en el front o en el panel de administración si así lo deseas)
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
            'name'             => 'required',
            'description'      => 'required',
            'capacity'         => 'required|integer|min:1',
            'precio_por_hora'  => 'required|numeric|min:0',
        ]);

        Espacio::create($request->all());
        return redirect()->route('espacios.index')->with('success', 'Espacio creado correctamente');
    }

    // Se redirige a una página de edición separada para el área de administración
    public function edit(Espacio $espacio)
    {
        return view('admin.editEspacios', compact('espacio'));
    }
    
    
    public function update(Request $request, Espacio $espacio)
    {
        $validated = $request->validate([
            'name'             => 'required|string|max:255',
            'description'      => 'required|string',
            'capacity'         => 'required|integer|min:1',
            'precio_por_hora'  => 'required|numeric|min:0',
        ]);

        $espacio->update($validated);

        return redirect()->route('admin.panel')->with('success', 'Espacio actualizado correctamente.');
    }

    public function destroy(Espacio $espacio)
    {
        $espacio->delete();
        return redirect()->route('espacios.index')->with('success', 'Espacio eliminado');
    }
}
