<h2 style="font-size: 2rem; font-weight: bold; margin-bottom: 15px;">Gestión de Usuarios</h2>

<table style="width: 100%; border-collapse: collapse; border: 1px solid #ccc;">
    <thead>
        <tr style="background: #f0f0f0;">
            <th style="border: 1px solid #ccc; padding: 10px;">Nombre</th>
            <th style="border: 1px solid #ccc; padding: 10px;">Email</th>
            <th style="border: 1px solid #ccc; padding: 10px;">Rol</th>
            <th style="border: 1px solid #ccc; padding: 10px;">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($usuarios as $usuario)
            <tr>
                <td style="border: 1px solid #ccc; padding: 10px;">{{ $usuario->name }}</td>
                <td style="border: 1px solid #ccc; padding: 10px;">{{ $usuario->email }}</td>
                <td style="border: 1px solid #ccc; padding: 10px;">{{ $usuario->rol }}</td>
                <td style="border: 1px solid #ccc; padding: 10px;">
                    <a href="{{ route('admin.editUser', $usuario->id) }}" 
                       style="padding: 5px 10px; background-color: #3182ce; color: white; text-decoration: none; border-radius: 5px; margin-right: 5px;">
                        Editar
                    </a>
                    <form action="{{ route('admin.deleteUser', $usuario->id) }}" method="POST" style="display:inline;">
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
    {{ $usuarios->links() }}
</div>
