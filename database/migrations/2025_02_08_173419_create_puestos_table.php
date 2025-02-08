<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePuestosTable extends Migration
{
    public function up(): void
    {
        Schema::create('puestos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('espacio_id')->constrained('espacios')->onDelete('cascade');
            $table->string('label');  // Ejemplo: "A1", "A2", etc.
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('puestos');
    }
}
