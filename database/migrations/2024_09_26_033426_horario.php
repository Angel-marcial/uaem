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
            $table->time('entrada_lunes');
            $table->time('salida_lunes');
            $table->time('entrada_martes');
            $table->time('salida_martes');
            $table->time('entrada_miercoles');
            $table->time('salida_miercoles');
            $table->time('entrada_jueves');
            $table->time('salida_jueves');
            $table->time('entrada_viernes');
            $table->time('salida_viernes');
            $table->time('entrada_sabado');
            $table->time('salida_sabado');
            $table->timestamps();        // Crea columnas created_at y updated_at
            // Definir la clave foránea
            $table->foreign('id_usuario')
            ->references('id')
            ->on('usuarios');  
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
