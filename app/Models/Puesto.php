<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puesto extends Model
{
    use HasFactory;

    protected $fillable = [
        'espacio_id',
        'label',
    ];

    // Relación opcional: cada puesto pertenece a un espacio.
    public function espacio()
    {
        return $this->belongsTo(Espacio::class);
    }
}
