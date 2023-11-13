<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Reporteria;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class EstadisticasController extends Controller{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getStats()
    {
        return view('Estadisticas.index');
    }

    public function getData($d1,$d2){
        // $obj = Reporteria::getData($d1,$d2);
        // return response()->json($obj);

        $Key = 'stat_getData'.$d1."_".$d2;
        $cached = Redis::get($Key);
        if ($cached) {
            $obj = $cached;
        } else {
            $obj = json_encode(Reporteria::getData($d1,$d2));
            Redis::setex($Key, 900, $obj); 
    }
    return response()->json(json_decode($obj));
    }
    public function ActualizarDiaHabiles($val)
    {
        $response = Reporteria::ActualizarDiaHabiles($val);
        return response()->json($response);
    }
    public function get8020()
    {  
        $Ruta = 'F10';
        $d1   = '2022-09-01';
        $d2   = '2022-09-30';

        $obj = Reporteria::get8020($Ruta,$d1,$d2);
        
        return response()->json($obj);
    }
   
}