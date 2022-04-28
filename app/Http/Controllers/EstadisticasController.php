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

    public function getData(){
        $obj = Reporteria::getData();
        return response()->json($obj);
    }
}