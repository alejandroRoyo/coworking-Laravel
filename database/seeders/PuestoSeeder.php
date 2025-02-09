<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Espacio;
use App\Models\Puesto;

class PuestoSeeder extends Seeder
{
    public function run(): void
    {
        // Para cada espacio, creamos 20 puestos de ejemplo.
        $espacios = Espacio::all();
        foreach ($espacios as $espacio) {
            for ($i = 1; $i <= 20; $i++) {
                Puesto::create([
                    'espacio_id' => $espacio->id,
                    'label' => 'Puesto ' . $i,
                ]);
            }
        }
    }
}
