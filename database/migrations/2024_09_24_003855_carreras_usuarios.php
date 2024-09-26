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
        Schema::create('carreras_usuarios', function(Blueprint $table)
        {
            $table->id();                // Crea una columna de tipo BIGINT con auto-incremento como clave primaria
            $table->bigInteger('id_usuario')->unique();
            $table->bigInteger('id_carrera');
            $table->timestamps();
            // Definir la clave foránea
            $table->foreign('id_usuario')
            ->references('id')
            ->on('usuarios')  
            ->onDelete('cascade');
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
        Schema::dropIfExists('carreras_usuarios');
    }
};
