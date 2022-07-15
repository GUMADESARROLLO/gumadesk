<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Proyeccion;
use App\Models\Vendedores;

class VentasController extends Controller {
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getVentas()
    {
        $Vendedores = Vendedores::getVendedor();
        return view('Ventas.Home', compact('Vendedores'));      
    }
    public function getDataProyeccion(Request $request)
    {
        $Proyec[] = array(
            'data' => Proyeccion::getProyecciones($request)
        );

        return response()->json($Proyec);

    }

}