{{-- @extends('layouts.app-master')

@section('content') --}}
    <h2 style="text-align: center; font-size: 2rem; font-weight: bold; margin-bottom: 15px;">Gestión de Reservas</h2>

    <table style="width: 100%; border-collapse: collapse; border: 1px solid #ccc;">
        <thead>
            <tr style="background: #f0f0f0;">
                <th style="border: 1px solid #ccc; padding: 10px;">Usuario</th>
                <th style="border: 1px solid #ccc; padding: 10px;">Espacio</th>
                <th style="border: 1px solid #ccc; padding: 10px;">Fecha</th>
                <th style="border: 1px solid #ccc; padding: 10px;">Hora de Inicio</th>
                <th style="border: 1px solid #ccc; padding: 10px;">Hora de Fin</th>
                <th style="border: 1px solid #ccc; padding: 10px;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservas as $reserva)
                <tr>
                    <td style="border: 1px solid #ccc; padding: 10px;">{{ $reserva->usuario->name }}</td>
                    <td style="border: 1px solid #ccc; padding: 10px;">{{ $reserva->espacio->name }}</td>
                    <td style="border: 1px solid #ccc; padding: 10px;">{{ $reserva->fecha }}</td>
                    <td style="border: 1px solid #ccc; padding: 10px;">{{ $reserva->hora_inicio }}</td>
                    <td style="border: 1px solid #ccc; padding: 10px;">{{ $reserva->hora_fin }}</td>
                    <td style="border: 1px solid #ccc; padding: 10px;">
                        <!-- El botón 'Editar' redirige a la página de edición -->
                        <a href="{{ route('admin.editReservas', $reserva->id) }}" 
                           style="padding: 5px 10px; background-color: #3182ce; color: white; text-decoration: none; border-radius: 5px; margin-right: 5px;">
                            Editar
                        </a>
                        <form action="{{ route('reservas.destroy', $reserva->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    style="background: red; color: white; padding: 5px 10px; border: none; border-radius: 5px; cursor: pointer;">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Enlaces de paginación -->
    <div style="margin-top: 20px; text-align: center;">
        {{ $reservas->links() }}
    </div>
{{-- @endsection --}}
