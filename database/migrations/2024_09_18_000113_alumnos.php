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
        Schema::create('alumnos', function(Blueprint $table)
        {
            $table->id();                // Crea una columna de tipo BIGINT con auto-incremento como clave primaria
            $table->Integer('id_carrera');
            $table->integer('cuenta');
            $table->string('nombre');    // Crea una columna de tipo VARCHAR para el nombre
            $table->string('paterno');
            $table->string('materno');
            $table->string('telefono');    // Crea una columna de tipo VARCHAR para el correo
            $table->timestamps();        // Crea columnas created_at y updated_at
            // Definir la clave foránea
            $table->foreign('id_carrera')
            ->references('id')
            ->on('carreras');  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnos');
    }
};
