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
        Schema::create('invitados', function(Blueprint $table)
        {
            $table->id();
            $table->string('nombre_completo');      // Crea una columna de tipo VARCHAR para el nombre
            $table->string('correo');
            $table->string('telefono');        
            $table->integer('area_visita');        
            $table->time('hora_visita');
            $table->date('fecha_visita');
            $table->string('motivo');  
            $table->integer('estatus');
            $table->timestamps(); 
            
            $table->foreign('area_visita')
            ->references('id')
            ->on('departamentos')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitados');
    }
};
