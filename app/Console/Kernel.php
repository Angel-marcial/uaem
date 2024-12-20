<?php
/*
Codice
Nombre del Código: Kernel.php
Fecha de Creación: 01/11/2024 revisado por Angel Geovanni Marcial Morales

Modificaciones:

Descripción: Este archivo PHP es una parte esencial del framework de Laravel y se encuentra en el contexto del proyecto de control de accesos a la UAPT. Su función principal es manejar la programación de comandos y tareas en la aplicación mediante el uso del componente de programación de tareas de Laravel.

*/
namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
