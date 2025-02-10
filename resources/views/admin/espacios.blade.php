{{-- @extends('layouts.app-master')

@section('content') --}}
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
        <tr id="row_{{ $espacio->id }}">
            <td class="nameCell" style="border: 1px solid #ccc; padding: 10px;">{{ $espacio->name }}</td>
            <td class="descriptionCell" style="border: 1px solid #ccc; padding: 10px;">{{ $espacio->description }}</td>
            <td class="capacityCell" style="border: 1px solid #ccc; padding: 10px;">{{ $espacio->capacity }}</td>
            <td class="priceCell" style="border: 1px solid #ccc; padding: 10px;">{{ $espacio->precio_por_hora }} €</td>
            <td class="actionsCell" style="border: 1px solid #ccc; padding: 10px;">
                <a href="javascript:void(0)" onclick="enableEdit({{ $espacio->id }})" 
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

<script>
function enableEdit(rowId) {
    var row = document.getElementById("row_" + rowId);
    // Obtener valores actuales de cada celda
    var nameCell = row.querySelector(".nameCell");
    var descriptionCell = row.querySelector(".descriptionCell");
    var capacityCell = row.querySelector(".capacityCell");
    var priceCell = row.querySelector(".priceCell");
    
    var currentName = nameCell.innerText;
    var currentDescription = descriptionCell.innerText;
    var currentCapacity = capacityCell.innerText;
    var currentPrice = priceCell.innerText.replace(" €", "");
    
    // Reemplazar celdas con campos de entrada
    nameCell.innerHTML = '<input type="text" value="'+ currentName +'" class="editName" style="width:100%;">';
    descriptionCell.innerHTML = '<input type="text" value="'+ currentDescription +'" class="editDescription" style="width:100%;">';
    capacityCell.innerHTML = '<input type="number" value="'+ currentCapacity +'" class="editCapacity" style="width:100%;">';
    priceCell.innerHTML = '<input type="number" step="0.01" value="'+ currentPrice +'" class="editPrice" style="width:100%;">';
    
    // Reemplazar celda de acciones con botones Guardar y Cancelar
    var actionsCell = row.querySelector(".actionsCell");
    actionsCell.innerHTML = 
        '<button onclick="saveEdit('+ rowId +')" style="padding:5px 10px; background:green; color:white; border:none; border-radius:5px; margin-right:5px;">Guardar</button>' +
        '<button onclick="cancelEdit('+ rowId +')" style="padding:5px 10px; background:gray; color:white; border:none; border-radius:5px;">Cancelar</button>';
}

function cancelEdit(rowId) {
    // Recargar la página para cancelar la edición (o implementar lógica para restaurar los datos originales)
    location.reload();
}

function saveEdit(rowId) {
    var row = document.getElementById("row_" + rowId);
    var name = row.querySelector(".editName").value;
    var description = row.querySelector(".editDescription").value;
    var capacity = row.querySelector(".editCapacity").value;
    var price = row.querySelector(".editPrice").value;
    
    // Obtener el token CSRF
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var url = '/espacios/' + rowId; // Se asume que la ruta de actualización es /espacios/{id}
    
    fetch(url, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            name: name,
            description: description,
            capacity: capacity,
            precio_por_hora: price
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error en la actualización');
        }
        return response.json();
    })
    .then(data => {
        // Actualizar la fila con los nuevos datos
        row.querySelector(".nameCell").innerText = data.name;
        row.querySelector(".descriptionCell").innerText = data.description;
        row.querySelector(".capacityCell").innerText = data.capacity;
        row.querySelector(".priceCell").innerText = data.precio_por_hora + ' €';
        // Restaurar la celda de acciones
        row.querySelector(".actionsCell").innerHTML = 
            '<a href="javascript:void(0)" onclick="enableEdit('+ rowId +')" style="padding: 5px 10px; background-color: #3182ce; color: white; text-decoration: none; border-radius: 5px; margin-right: 5px;">Editar</a>' +
            '<form action="/espacios/' + rowId + '" method="POST" style="display:inline;">' +
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