<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ListaArticulos;
use App\Models\VendedoresAsignados;
use App\Models\Vendedores;
use App\Models\Articulos;



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
            'lstArticulo'   => ListaArticulos::getProyecciones($request),
            'lstVinneta'    => ListaArticulos::getArticulosVinneta($request)
        );

        return response()->json($Proyec);

    }
    public function getVendedor()
    {
        $getVendedor = Vendedores::getVendedor();
        return response()->json($getVendedor);
    }
    public function getArticulos()
    {
        $Articulos = Articulos::getArticulos();
        return response()->json($Articulos);
    }
    public function getArticulosPOST(Request $request)
    {
        $Articulos = Articulos::getArticulosPOST($request);
        return response()->json($Articulos);
    }
    public function AddOneArticulo(Request $request)
    {
        $response = ListaArticulos::AddOneArticulo($request);
        return response()->json($response);
    }
    public function postGuardarListas(Request $request)
    {
        $response = ListaArticulos::GuardarListas($request);
        return response()->json($response);
    }
    public function GuardarAsignacion(Request $request)
    {
        $response = VendedoresAsignados::GuardarAsignacion($request);
        return response()->json($response);
    }
    public function CambiarDeLista(Request $request)
    {
        $response = ListaArticulos::CambiarDeLista($request);
        return response()->json($response);
    }



}