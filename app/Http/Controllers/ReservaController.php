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
        return view('reservas.create', compact('espacios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'espacio_id' => 'required|exists:espacios,id',
            'fecha' => 'required|date|after_or_equal:today',
            'hora_inicio' => 'required',
            'hora_fin' => 'required|after:hora_inicio',
        ]);

        // Obtener usuario autenticado
        $usuario_id = Auth::id();

        // Comprobar disponibilidad del espacio
        $existeReserva = Reserva::where('espacio_id', $request->espacio_id)
            ->where('fecha', $request->fecha)
            ->where(function ($query) use ($request) {
                $query->whereBetween('hora_inicio', [$request->hora_inicio, $request->hora_fin])
                    ->orWhereBetween('hora_fin', [$request->hora_inicio, $request->hora_fin]);
            })->exists();

        if ($existeReserva) {
            return back()->withErrors(['error' => 'El espacio ya está reservado en ese horario.']);
        }

        // Crear la reserva
        Reserva::create([
            'usuario_id' => $usuario_id,
            'espacio_id' => $request->espacio_id,
            'fecha' => $request->fecha,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
        ]);

        return redirect()->route('reservas.index')->with('success', 'Reserva creada correctamente');
    }


    public function destroy(Reserva $reserva)
    {
        $reserva->delete();
        return redirect()->route('reservas.index')->with('success', 'Reserva cancelada');
    }
    public function edit(Reserva $reserva)
    {
        // Opcional: pasar también los espacios si el usuario debe poder cambiar el espacio de la reserva
        $espacios = \App\Models\Espacio::all();
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
