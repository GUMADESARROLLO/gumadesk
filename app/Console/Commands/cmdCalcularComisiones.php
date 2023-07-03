<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\ScheduleController;

class cmdCalcularComisiones extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:CalcularComiciones';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calcula el Cierre de comisiones de cada mes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $scheduleController = new ScheduleController();
        $scheduleController->RunCalcComisiones();

        $this->info('Tarea de Calculo de Comiciones ejecutada correctamente.');
    }
}
