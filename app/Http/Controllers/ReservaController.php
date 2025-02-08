<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\Espacio;
use Illuminate\Support\Facades\Auth;

class ReservaController extends Controller
{
    public function index()
    {
        $reservas = Reserva::where('usuario_id', Auth::id())->get();
        return view('reservas.index', compact('reservas'));
    }

    public function create()
    {
        $espacios = Espacio::all();
        // Se asume que en la vista 'reservas.create' se gestionará la carga del diagrama de asientos (puestos)
        return view('reservas.create', compact('espacios'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'espacio_id'  => 'required|exists:espacios,id',
            'fecha'       => 'required|date|after_or_equal:today',
            'hora_inicio' => 'required',
            'hora_fin'    => 'required|after:hora_inicio',
            'puestos'     => 'required|array',
            'puestos.*'   => 'exists:puestos,id',
        ]);

        $usuario_id = Auth::id();

        // Comprobar disponibilidad para cada asiento seleccionado
        foreach ($validated['puestos'] as $puestoId) {
            $conflict = Reserva::where('puesto_id', $puestoId)
                ->where('fecha', $validated['fecha'])
                ->where(function ($query) use ($validated) {
                    $query->whereBetween('hora_inicio', [$validated['hora_inicio'], $validated['hora_fin']])
                          ->orWhereBetween('hora_fin', [$validated['hora_inicio'], $validated['hora_fin']]);
                })->exists();

            if ($conflict) {
                return back()->withErrors(['error' => 'Uno o varios de los asientos seleccionados ya están reservados en ese horario.']);
            }
        }

        // Crear una reserva por cada asiento seleccionado
        foreach ($validated['puestos'] as $puestoId) {
            Reserva::create([
                'usuario_id'   => $usuario_id,
                'espacio_id'   => $validated['espacio_id'],
                'puesto_id'    => $puestoId,
                'fecha'        => $validated['fecha'],
                'hora_inicio'  => $validated['hora_inicio'],
                'hora_fin'     => $validated['hora_fin'],
            ]);
        }

        return redirect()->route('reservas.index')->with('success', 'Reserva(s) creada(s) correctamente.');
    }

    public function destroy(Reserva $reserva)
    {
        $reserva->delete();
        return redirect()->route('reservas.index')->with('success', 'Reserva cancelada');
    }

    public function edit(Reserva $reserva)
    {
        // Se cargan todos los espacios para permitir cambiar el asignado en la edición
        $espacios = Espacio::all();
        return view('reservas.edit', compact('reserva', 'espacios'));
    }

    public function update(Request $request, Reserva $reserva)
    {
        $request->validate([
            'espacio_id'  => 'required|exists:espacios,id',
            'fecha'       => 'required|date',
            'hora_inicio' => 'required',
            'hora_fin'    => 'required|after:hora_inicio',
        ]);

        $reserva->update($request->all());
        return redirect()->route('reservas.index')->with('success', 'Reserva actualizada correctamente');
    }
}
