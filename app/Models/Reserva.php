<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario_id',
        'espacio_id',
        'fecha',
        'hora_inicio',
        'hora_fin',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function espacio()
    {
        return $this->belongsTo(Espacio::class);
    }

    // Relación muchos a muchos con el modelo Puesto
    public function puestos()
    {
        return $this->belongsToMany(Puesto::class, 'reserva_puesto', 'reserva_id', 'puesto_id');
    }
}
