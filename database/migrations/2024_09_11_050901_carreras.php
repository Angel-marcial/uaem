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
        Schema::create('carreras', function(Blueprint $table)
        {
            $table->id();                  // Crea una columna de tipo BIGINT con auto-incremento como clave primaria
            $table->string('nombre');      // Crea una columna de tipo VARCHAR para el nombre
            $table->timestamps();          // Crea columnas created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP TABLE IF EXISTS carreras CASCADE');
    }
};
