<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Puesto;

class Espacio extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'capacity',
        'precio_por_hora',
    ];

    public function puestos()
    {
        return $this->hasMany(\App\Models\Puesto::class);
    }
}
