{{-- @extends('layouts.app-master')

@section('content') --}}
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
            <tr id="row_{{ $usuario->id }}">
                <td class="nameCell" style="border: 1px solid #ccc; padding: 10px;">{{ $usuario->name }}</td>
                <td class="emailCell" style="border: 1px solid #ccc; padding: 10px;">{{ $usuario->email }}</td>
                <td class="roleCell" style="border: 1px solid #ccc; padding: 10px;">{{ $usuario->rol }}</td>
                <td class="actionsCell" style="border: 1px solid #ccc; padding: 10px;">
                    <a href="javascript:void(0)" onclick="enableEdit({{ $usuario->id }})" 
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

<script>
function enableEdit(userId) {
    var row = document.getElementById("row_" + userId);
    // Obtener valores actuales de cada celda
    var nameCell = row.querySelector(".nameCell");
    var emailCell = row.querySelector(".emailCell");
    var roleCell = row.querySelector(".roleCell");
    
    var currentName = nameCell.innerText;
    var currentEmail = emailCell.innerText;
    var currentRole = roleCell.innerText.trim();
    
    // Reemplazar celdas con campos de entrada
    nameCell.innerHTML = '<input type="text" value="'+ currentName +'" class="editName" style="width:100%;">';
    emailCell.innerHTML = '<input type="email" value="'+ currentEmail +'" class="editEmail" style="width:100%;">';
    roleCell.innerHTML = '<select class="editRole" style="width:100%; padding:0.5rem;">' +
                         '<option value="Usuario" ' + (currentRole === 'Usuario' ? 'selected' : '') + '>Usuario</option>' +
                         '<option value="Administrador" ' + (currentRole === 'Administrador' ? 'selected' : '') + '>Administrador</option>' +
                         '</select>';
    
    // Reemplazar celda de acciones con botones Guardar y Cancelar
    var actionsCell = row.querySelector(".actionsCell");
    actionsCell.innerHTML = 
        '<button onclick="saveEdit('+ userId +')" style="padding:5px 10px; background:green; color:white; border:none; border-radius:5px; margin-right:5px;">Guardar</button>' +
        '<button onclick="cancelEdit('+ userId +')" style="padding:5px 10px; background:gray; color:white; border:none; border-radius:5px;">Cancelar</button>';
}

function cancelEdit(userId) {
    // Para cancelar la edición, recargamos la página (o podrías implementar lógica para restaurar los valores originales sin recargar)
    location.reload();
}

function saveEdit(userId) {
    var row = document.getElementById("row_" + userId);
    var newName = row.querySelector(".editName").value;
    var newEmail = row.querySelector(".editEmail").value;
    var newRole = row.querySelector(".editRole").value;
    
    // Obtener el token CSRF
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var url = '/admin/users/' + userId; // Asumiendo que la ruta para actualizar es PUT /admin/users/{id}
    
    fetch(url, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            name: newName,
            email: newEmail,
            rol: newRole
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error al actualizar');
        }
        return response.json();
    })
    .then(data => {
        // Actualizar la fila con los nuevos datos
        row.querySelector(".nameCell").innerText = data.name;
        row.querySelector(".emailCell").innerText = data.email;
        row.querySelector(".roleCell").innerText = data.rol;
        // Restaurar la celda de acciones
        row.querySelector(".actionsCell").innerHTML = 
            '<a href="javascript:void(0)" onclick="enableEdit('+ userId +')" style="padding: 5px 10px; background-color: #3182ce; color: white; text-decoration: none; border-radius: 5px; margin-right: 5px;">Editar</a>' +
            '<form action="/admin/user/' + userId + '" method="POST" style="display:inline;">' +
                '<input type="hidden" name="_token" value="'+ token +'">' +
                '<input type="hidden" name="_method" value="DELETE">' +
                '<button type="submit" style="background: red; color: white; padding: 5px 10px; border: none; border-radius: 5px; cursor: pointer;">Eliminar</button>' +
            '</form>';
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error al actualizar. Por favor, inténtelo nuevamente.');
    });
}
</script>
{{-- @endsection --}}
