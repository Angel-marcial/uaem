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
        Schema::create('horario', function(Blueprint $table)
        {
            $table->id();                // Crea una columna de tipo BIGINT con auto-incremento como clave primaria
            $table->Integer('id_usuario')->unique();
            $table->time('entrada_lunes')->nullable();
            $table->time('salida_lunes')->nullable();
            $table->time('entrada_martes')->nullable();
            $table->time('salida_martes')->nullable();
            $table->time('entrada_miercoles')->nullable();
            $table->time('salida_miercoles')->nullable();
            $table->time('entrada_jueves')->nullable();
            $table->time('salida_jueves')->nullable();
            $table->time('entrada_viernes')->nullable();
            $table->time('salida_viernes')->nullable();
            $table->time('entrada_sabado')->nullable();
            $table->time('salida_sabado')->nullable();
            $table->timestamps();        // Crea columnas created_at y updated_at
            // Definir la clave foránea
            $table->foreign('id_usuario')
            ->references('id')
            ->on('usuarios')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horario');
    }
};
