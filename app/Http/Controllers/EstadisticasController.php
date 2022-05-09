<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Reporteria;

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
        $obj = Reporteria::getData($d1,$d2);
        return response()->json($obj);
    }
    public function ActualizarDiaHabiles($val)
    {
        $response = Reporteria::ActualizarDiaHabiles($val);
        return response()->json($response);
    }
   
}