<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('usuarios', function(Blueprint $table)
        {
            $table->id();                // Crea una columna de tipo BIGINT con auto-incremento como clave primaria
            $table->Integer('no_cuenta');
            $table->string('nombre');
            $table->string('apellido_paterno');    // Crea una columna de tipo VARCHAR para el nombre
            $table->string('apellido_materno');
            $table->string('telefono');
            $table->boolean('estatus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
