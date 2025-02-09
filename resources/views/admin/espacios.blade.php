<h2 style="font-size: 2rem; font-weight: bold; margin-bottom: 15px;">Gestión de Espacios</h2>

<table style="width: 100%; border-collapse: collapse; border: 1px solid #ccc;">
    <thead>
        <tr style="background: #f0f0f0;">
            <th style="border: 1px solid #ccc; padding: 10px;">Nombre</th>
            <th style="border: 1px solid #ccc; padding: 10px;">Descripción</th>
            <th style="border: 1px solid #ccc; padding: 10px;">Capacidad</th>
            <th style="border: 1px solid #ccc; padding: 10px;">Precio por Hora</th>
            <th style="border: 1px solid #ccc; padding: 10px;">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($espacios as $espacio)
            <tr>
                <td style="border: 1px solid #ccc; padding: 10px;">{{ $espacio->name }}</td>
                <td style="border: 1px solid #ccc; padding: 10px;">{{ $espacio->description }}</td>
                <td style="border: 1px solid #ccc; padding: 10px;">{{ $espacio->capacity }}</td>
                <td style="border: 1px solid #ccc; padding: 10px;">{{ $espacio->precio_por_hora }} €</td>
                <td style="border: 1px solid #ccc; padding: 10px;">
                    <a href="{{ route('espacios.edit', $espacio->id) }}" 
                       style="padding: 5px 10px; background-color: #3182ce; color: white; text-decoration: none; border-radius: 5px; margin-right: 5px;">
                        Editar
                    </a>
                    <form action="{{ route('espacios.destroy', $espacio->id) }}" method="POST" style="display:inline;">
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

<!-- Paginación -->
<div style="margin-top: 20px; text-align: center;">
    {{ $espacios->links() }}
</div>
