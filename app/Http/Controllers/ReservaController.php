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
        $defaultEspacio = $espacios->first();
        // Si no existe un espacio predeterminado, se envía una colección vacía.
        $puestos = $defaultEspacio ? $defaultEspacio->puestos : collect();

        // Generar franjas horarias permitidas: de 08:00 a 20:00 (la reserva será de "hora_inicio" a "hora_inicio + 1 hora")
        $slots = [];
        for ($i = 8; $i <= 20; $i++) {
            $slots[] = sprintf('%02d:00', $i);
        }

        return view('reservas.create', compact('espacios', 'defaultEspacio', 'puestos', 'slots'));
    }



    public function store(Request $request)
    {
        // Generar la lista de franjas horarias permitidas
        $allowedSlots = [];
        for ($i = 8; $i <= 20; $i++) {
            $allowedSlots[] = sprintf('%02d:00', $i);
        }

        $validated = $request->validate([
            'espacio_id'  => 'required|exists:espacios,id',
            'fecha'       => 'required|date|after_or_equal:today',
            // Ahora se espera un valor entre 08:00 y 20:00
            'hora_inicio' => 'required|in:' . implode(',', $allowedSlots),
            'puestos'     => 'required|array',
            'puestos.*'   => 'exists:puestos,id',
        ]);

        $horaInicio = $validated['hora_inicio'];
        // Calcular la hora de fin sumando 1 hora
        $horaFin = date("H:i", strtotime($horaInicio . " +1 hour"));
        $usuario_id = Auth::id();

        // Para cada asiento (puesto) seleccionado, verificar disponibilidad y crear la reserva
        foreach ($validated['puestos'] as $puestoId) {
            $conflict = Reserva::where('puesto_id', $puestoId)
                ->where('fecha', $validated['fecha'])
                ->where(function ($query) use ($horaInicio, $horaFin) {
                    $query->whereBetween('hora_inicio', [$horaInicio, $horaFin])
                        ->orWhereBetween('hora_fin', [$horaInicio, $horaFin]);
                })->exists();

            if ($conflict) {
                return back()->withErrors(['error' => 'Uno o varios de los asientos seleccionados ya están reservados en ese horario.']);
            }
        }

        foreach ($validated['puestos'] as $puestoId) {
            Reserva::create([
                'usuario_id'  => $usuario_id,
                'espacio_id'  => $validated['espacio_id'],
                'puesto_id'   => $puestoId,
                'fecha'       => $validated['fecha'],
                'hora_inicio' => $horaInicio,
                'hora_fin'    => $horaFin,
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
        $espacios = \App\Models\Espacio::all();
        return view('admin.editReservas', compact('reserva', 'espacios'));
    }



    public function update(Request $request, Reserva $reserva)
    {
        // Generar las franjas horarias permitidas (de 08:00 a 20:00)
        $allowedSlots = [];
        for ($i = 8; $i <= 20; $i++) {
            $allowedSlots[] = sprintf('%02d:00', $i);
        }

        // Validar la petición
        $validated = $request->validate([
            'espacio_id'  => 'required|exists:espacios,id',
            'fecha'       => 'required|date',
            'hora_inicio' => 'required|in:' . implode(',', $allowedSlots),
        ]);

        $horaInicio = $validated['hora_inicio'];
        $horaFin = date("H:i", strtotime($horaInicio . " +1 hour"));

        // Actualizar la reserva
        $reserva->update([
            'espacio_id'  => $validated['espacio_id'],
            'fecha'       => $validated['fecha'],
            'hora_inicio' => $horaInicio,
            'hora_fin'    => $horaFin,
        ]);

        // Redirigir según el rol del usuario
        if (Auth::check() && Auth::user()->rol === 'Administrador') {
            return redirect()->route('admin.panel')->with('success', 'Reserva actualizada correctamente.');
        } else {
            return redirect()->route('reservas.index')->with('success', 'Reserva actualizada correctamente.');
        }
    }
}
