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
        Schema::create('credenciales', function(Blueprint $table)
        {
            $table->id();                // Crea una columna de tipo BIGINT con auto-incremento como clave primaria
            $table->Integer('id_usuario');
            $table->integer('correo');
            $table->string('password');    // Crea una columna de tipo VARCHAR para el nombre
            $table->string('rol');
            $table->timestamps();        // Crea columnas created_at y updated_at
            // Definir la clave foránea
            $table->foreign('id_usuario')
            ->references('id')
            ->on('alumnos');  
            $table->foreign('id_usuario')
            ->references('id')
            ->on('maestros');  

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credenciales');
    }
};
