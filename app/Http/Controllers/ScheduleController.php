<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ScheduleController extends Controller
{
    public function RunCalcComisiones()
    {
        //$url = route('Close');
        $url     = config('app.url').'/api/Close';
        $client = new Client(['verify' => false]);
        $client->get($url);
        \Log::channel('Schedule_calculo_comisiones')->info("Ejecucion de Tarea de Calculo de Comisiones ". $url);

        
    }
}
