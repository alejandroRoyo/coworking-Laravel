{{-- @extends('layouts.app-master')

@section('content') --}}
<h2 style="font-size: 2rem; font-weight: bold; margin-bottom: 15px;">Gestión de Reservas</h2>

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
            <tr id="row_{{ $reserva->id }}">
                <td class="usuarioCell" style="border: 1px solid #ccc; padding: 10px;">{{ $reserva->usuario->name }}</td>
                <td class="espacioCell" style="border: 1px solid #ccc; padding: 10px;">{{ $reserva->espacio->name }}</td>
                <td class="fechaCell" style="border: 1px solid #ccc; padding: 10px;">{{ $reserva->fecha }}</td>
                <td class="horaInicioCell" style="border: 1px solid #ccc; padding: 10px;">{{ $reserva->hora_inicio }}</td>
                <td class="horaFinCell" style="border: 1px solid #ccc; padding: 10px;">{{ $reserva->hora_fin }}</td>
                <td class="actionsCell" style="border: 1px solid #ccc; padding: 10px;">
                    <a href="javascript:void(0)" onclick="enableEditReservation({{ $reserva->id }})" 
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

<!-- Paginación -->
<div style="margin-top: 20px; text-align: center;">
    {{ $reservas->links() }}
</div>

<!-- Inyectar la lista de espacios disponibles para la edición inline -->
<script>
    var availableEspacios = @json($allEspacios);
</script>

<script>
function enableEditReservation(reservaId) {
    var row = document.getElementById("row_" + reservaId);
    
    // Obtener celdas de edición
    var espacioCell = row.querySelector(".espacioCell");
    var fechaCell = row.querySelector(".fechaCell");
    var horaInicioCell = row.querySelector(".horaInicioCell");
    var horaFinCell = row.querySelector(".horaFinCell");
    
    var currentEspacioName = espacioCell.innerText.trim();
    var currentFecha = fechaCell.innerText.trim();
    var currentHoraInicio = horaInicioCell.innerText.trim();
    var currentHoraFin = horaFinCell.innerText.trim();
    
    // Reemplazar celda "Espacio" con un select
    var selectHtml = '<select class="editEspacio" style="width:100%; padding:0.5rem;">';
    availableEspacios.forEach(function(espacio) {
        var selected = (espacio.name === currentEspacioName) ? 'selected' : '';
        selectHtml += '<option value="'+ espacio.id +'" '+ selected +'>' + espacio.name + '</option>';
    });
    selectHtml += '</select>';
    espacioCell.innerHTML = selectHtml;
    
    // Reemplazar "Fecha" con input date
    fechaCell.innerHTML = '<input type="date" class="editFecha" value="'+ currentFecha +'" style="width:100%; padding:0.5rem;">';
    // Reemplazar "Hora de Inicio" con input time
    horaInicioCell.innerHTML = '<input type="time" class="editHoraInicio" value="'+ currentHoraInicio +'" style="width:100%; padding:0.5rem;">';
    // Reemplazar "Hora de Fin" con input time
    horaFinCell.innerHTML = '<input type="time" class="editHoraFin" value="'+ currentHoraFin +'" style="width:100%; padding:0.5rem;">';
    
    // Reemplazar celda de acciones con botones Guardar y Cancelar
    var actionsCell = row.querySelector(".actionsCell");
    actionsCell.innerHTML = 
        '<button onclick="saveEditReservation('+ reservaId +')" style="padding:5px 10px; background:green; color:white; border:none; border-radius:5px; margin-right:5px;">Guardar</button>' +
        '<button onclick="cancelEditReservation('+ reservaId +')" style="padding:5px 10px; background:gray; color:white; border:none; border-radius:5px;">Cancelar</button>';
}

function cancelEditReservation(reservaId) {
    // Recargar la página para descartar la edición (puedes implementar una restauración sin recarga si lo prefieres)
    location.reload();
}

function saveEditReservation(reservaId) {
    var row = document.getElementById("row_" + reservaId);
    var newEspacioId = row.querySelector(".editEspacio").value;
    var newFecha = row.querySelector(".editFecha").value;
    var newHoraInicio = row.querySelector(".editHoraInicio").value;
    // Eliminar la línea que obtiene newHoraFin, ya que no se enviará
    // var newHoraFin = row.querySelector(".editHoraFin").value;
    
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var url = '/reservas/' + reservaId; // Ruta para actualizar la reserva
    
    fetch(url, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            espacio_id: newEspacioId,
            fecha: newFecha,
            hora_inicio: newHoraInicio
            // No se envía hora_fin, ya que el controlador la calcula automáticamente
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
        var espacioNombre = '';
        availableEspacios.forEach(function(espacio) {
            if (espacio.id == data.espacio_id) {
                espacioNombre = espacio.name;
            }
        });
        row.querySelector(".espacioCell").innerText = espacioNombre;
        row.querySelector(".fechaCell").innerText = data.fecha;
        row.querySelector(".horaInicioCell").innerText = data.hora_inicio;
        row.querySelector(".horaFinCell").innerText = data.hora_fin;
        // Restaurar la celda de acciones
        row.querySelector(".actionsCell").innerHTML = 
            '<a href="javascript:void(0)" onclick="enableEditReservation('+ reservaId +')" style="padding:5px 10px; background-color: #3182ce; color:white; text-decoration:none; border-radius:5px; margin-right:5px;">Editar</a>' +
            '<form action="/reservas/' + reservaId + '" method="POST" style="display:inline;">' +
                '<input type="hidden" name="_token" value="'+ token +'">' +
                '<input type="hidden" name="_method" value="DELETE">' +
                '<button type="submit" style="background:red; color:white; padding:5px 10px; border:none; border-radius:5px; cursor:pointer;">Eliminar</button>' +
            '</form>';
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error al actualizar. Por favor, inténtelo nuevamente.');
    });
}

</script>
{{-- @endsection --}}
