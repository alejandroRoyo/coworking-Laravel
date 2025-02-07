<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Verifica si ya existe un administrador antes de crearlo
        if (!User::where('email', 'admin@coworking.com')->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@coworking.com',
                'password' => Hash::make('admin123'), // Cambia la contraseña después de la instalación
                'rol' => 'Administrador',
            ]);
        }
    }
}
