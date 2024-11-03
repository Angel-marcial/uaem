<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            CREATE VIEW ingreso_salida AS
            SELECT
                a.id,
                a.no_cuenta,
                CONCAT(a.nombre, ' ', a.apellido_paterno, ' ', a.apellido_materno) AS nombre,
                a.telefono,
                b.fecha,
                b.hora_salida AS \"Hora de entrada\",
                c.hora_salida AS \"Hora de salida\",
                c.dia
            FROM usuarios a
            INNER JOIN ingresos b ON a.id = b.id_usuario
            INNER JOIN salidas c ON a.id = c.id_usuario
            WHERE b.fecha = c.fecha;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS horario_completo");
    }
};