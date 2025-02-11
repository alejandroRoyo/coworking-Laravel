{{-- @extends('layouts.app-master')

@section('content') --}}
<div style="max-width: 1200px; margin: 0 auto; padding: 20px;">
    <h2 style="font-size: 2rem; font-weight: 700; margin-bottom: 1rem; text-align: center;">Gestión de Reservas</h2>

    @if (session('success'))
        <div style="margin-bottom: 1rem; padding: 0.75rem; background-color: #d1fae5; color: #16a34a; border-radius: 0.375rem; text-align: center;">
            {{ session('success') }}
        </div>
    @endif

    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            <thead>
                <tr style="background-color: #f7fafc;">
                    <th style="border: 1px solid #e2e8f0; padding: 10px;">Usuario</th>
                    <th style="border: 1px solid #e2e8f0; padding: 10px;">Espacio</th>
                    <th style="border: 1px solid #e2e8f0; padding: 10px;">Fecha</th>
                    <th style="border: 1px solid #e2e8f0; padding: 10px;">Hora de Inicio</th>
                    <th style="border: 1px solid #e2e8f0; padding: 10px;">Hora de Fin</th>
                    <th style="border: 1px solid #e2e8f0; padding: 10px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservas as $reserva)
                    <tr style="background-color: #fff;">
                        <td style="border: 1px solid #e2e8f0; padding: 10px;">{{ $reserva->usuario->name }}</td>
                        <td style="border: 1px solid #e2e8f0; padding: 10px;">{{ $reserva->espacio->name }}</td>
                        <td style="border: 1px solid #e2e8f0; padding: 10px;">{{ $reserva->fecha }}</td>
                        <td style="border: 1px solid #e2e8f0; padding: 10px;">{{ $reserva->hora_inicio }}</td>
                        <td style="border: 1px solid #e2e8f0; padding: 10px;">{{ $reserva->hora_fin }}</td>
                        <td style="border: 1px solid #e2e8f0; padding: 10px; text-align: center;">
                            <!-- El botón 'Editar' redirige a la página de edición en el área de administración -->
                            <a href="{{ route('admin.editReservas', $reserva->id) }}"
                               style="display: inline-block; padding: 5px 10px; background-color: #3182ce; color: white; text-decoration: none; border-radius: 5px; margin-right: 5px;">
                                Editar
                            </a>
                            <form action="{{ route('reservas.destroy', $reserva->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        style="padding: 5px 10px; background-color: red; color: white; border: none; border-radius: 5px; cursor: pointer;">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Enlaces de paginación -->
    <div style="margin-top: 20px; text-align: center;">
        {{ $reservas->links() }}
    </div>
</div>
{{-- @endsection --}}
