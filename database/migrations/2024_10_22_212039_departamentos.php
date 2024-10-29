<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('departamentos', function(Blueprint $table)
        {
            $table->id();                  // Crea una columna de tipo BIGINT con auto-incremento como clave primaria
            $table->bigInteger('id_usuario')->unique();
            $table->string('nombre_departamento');      // Crea una columna de tipo VARCHAR para el nombre
            $table->string('edificio');
            $table->string('aula');
            $table->timestamps();          // Crea columnas created_at y updated_at
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
        DB::statement('DROP TABLE IF EXISTS departamentos CASCADE');
    }
};
