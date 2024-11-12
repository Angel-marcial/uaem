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
        Schema::create('ingresos', function (Blueprint $table) 
        {
            $table->id();
            $table->bigInteger('id_usuario');
            //$table->bigInteger('id_guardia');
            $table->date('fecha');
            $table->time('hora_ingreso');
            $table->string('dia');
            $table->timestamps();
            
            // Definir las claves foráneas
            $table->foreign('id_usuario')
                  ->references('id')->on('usuarios');

            //$table->foreign('id_guardia')
              //    ->references('id')->on('guardias')
                //  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP TABLE IF EXISTS ingresos CASCADE');
        /*
        Schema::table('ingresos', function (Blueprint $table) {
            $table->dropForeign(['id_usuario']);
            //$table->dropForeign(['id_guardia']);
        });
    
        Schema::dropIfExists('ingresos');
        */
    }
};
