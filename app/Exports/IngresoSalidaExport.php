<?php
/*
Codice
Nombre del Código: IngresoSalidaExport.php
Fecha de Creación: 01/11/2024 revisado por Angel Geovanni Marcial Morales

Modificaciones:

Descripción: Este archivo PHP contiene las dependencias, fuentes y links que usuara la interfaz maestros

*/

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class IngresoSalidaExport implements FromCollection, WithHeadings
{
    private $id;
    private $option;
    private $day;
    private $startDate;
    private $endDate;

    public function __construct($id, $option = null, $day = null, $startDate = null, $endDate = null)
    {
        $this->id = $id;
        $this->option = $option;
        $this->day = $day;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        $query = DB::table('ingreso_salida')
            ->select('no_cuenta', 'nombre', 'telefono', 'fecha', DB::raw('"Hora de entrada" AS hora_entrada'), DB::raw('"Hora de salida" AS hora_salida'), 'dia')
            ->where('id', $this->id);

        // Aplicar filtros según la opción seleccionada
        if ($this->option == '1' && $this->day) {
            // Filtro por día específico
            $query->whereDate('fecha', $this->day);
        } elseif ($this->option == '2' && $this->startDate && $this->endDate) {
            // Filtro por rango de fechas
            $query->whereBetween('fecha', [$this->startDate, $this->endDate]);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'Numero de Cuenta',
            'Nombre',
            'Telefono',
            'Fecha',
            'Hora de Entrada',
            'Hora de Salida',
            'Dia',
        ];
    }
}
