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
        Schema::create('registro_invitados', function(Blueprint $table)
        {
            $table->id();
            $table->bigInteger('id_invitado');
            $table->time('hora_ingreso')->nullable();
            $table->time('hora_salida')->nullable();
            $table->timestamps(); 
            
            $table->foreign('id_invitado')
            ->references('id')
            ->on('invitados');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP TABLE IF EXISTS registro_invitados CASCADE');
    }
};
