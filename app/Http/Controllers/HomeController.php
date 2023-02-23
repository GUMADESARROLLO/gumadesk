<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;
use App\Models\pedido;
use App\Models\ArticulosUMK;
use App\Models\ArticulosGP;
use App\Models\Laboratorios;
use App\Models\Consignados;
use Illuminate\Support\Facades\DB;
use App\Models\Vendedores;
use App\Models\Comision;
use App\Models\FacturaDetalle;
use App\Models\FacturasRutas;
use App\Models\NotaCredito;
use Exception;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function getData()
    {
        $pedido = pedido::getPedidos();
        //$pedido = Articulos::getArticulos();
        return response()->json($pedido);
    }
    public function getArtiUMK()
    {
        $Articulos = ArticulosUMK::getArticulos();
        return response()->json($Articulos);
    }
    public function getArtiGP()
    {
        $Articulos = ArticulosUMK::getArticulos();
        return response()->json($Articulos);
    }
    public function getLab()
    {
        $Laboratorios = Laboratorios::getLaboratorios();
        return response()->json($Laboratorios);
    }
    public function getConsig()
    {
        $Consignados = Consignados::getConsignados();
        return response()->json($Consignados);
    }
    public function guardar(Request $request)
    {

        try {
            DB::transaction(function () use ($request) {
                $data = $request->input('data');
                $array = array();
                $i= 0;
                $pedido = new pedido();
                foreach ($data as $dataP) {
                    
                    $pedido->numOrden           =   $dataP['orden'];
                    $pedido->numFactura         =   $dataP['factura'];
                    $pedido->fecha_despacho     =   $dataP['fecha_despacho'];
                    $pedido->fecha_orden        =   $dataP['fecha_orden'];
                    $pedido->codigo             =   $dataP['codigo'];
                    $pedido->empresa            =   $dataP['empresa'];
                    $pedido->descripcion        =   $dataP['descripcion']  ;
                    $pedido->lab                =   $dataP['lab'];
                    $pedido->cantidad           =   $dataP['cantidad'];
                    $pedido->mific              =   $dataP['mific'];
                    $pedido->precio_farm        =   $dataP['precio_farm'];
                    $pedido->precio_publ        =   $dataP['precio_public'];
                    $pedido->precio_inst        =   $dataP['precio_institu'];
                    $pedido->permiso_necesario  =   $dataP['permiso_necesario'];
                    $pedido->consignado         =   $dataP['consignado'];
                    $pedido->tipo               =   $dataP['tipo'];
                    $pedido->comentarios        =   $dataP['comentarios'];
                    $pedido->estado             =   $dataP['estado'];                
                    $pedido->activo             =   "S";      
                    $pedido->nuevo              = $dataP['nuevo'];          
                    $pedido->save();             
                    
                };                
                return response()->json($pedido);
            });
        } catch (Exception $e) {
            $mensaje =  'Excepción capturada: ' . $e->getMessage() . "\n";

            return response()->json($mensaje);
        }
    }
    public function editar(Request $request)
    {

        try {
            DB::transaction(function () use ($request) {
                $data = $request->input('data');
                $array = array();
                $i= 0;

                foreach ($data as $dataP) {
                    
                    pedido::where('id', $dataP['id'])->update([
                        'numOrden' =>   $dataP['orden'],
                        'numFactura' => $dataP['factura'],
                        'fecha_despacho' => date("Y-m-d", strtotime($dataP['fecha_despacho'])),
                        'fecha_orden' => date("Y-m-d", strtotime($dataP['fecha_orden'])),
                        'codigo' => $dataP['codigo'],
                        'descripcion' => $dataP['descripcion'],
                        'lab' => $dataP['lab'],
                        'cantidad' => $dataP['cantidad'],
                        'mific' => $dataP['mific'],
                        'precio_farm' => $dataP['precio_farm'],
                        'precio_publ' => $dataP['precio_public'],
                        'permiso_necesario' => $dataP['permiso_necesario'],
                        'consignado' => $dataP['consignado'],
                        'tipo' => $dataP['tipo'],
                        'comentarios' => $dataP['comentarios'],
                        'estado' => $dataP['estado'],
                        'empresa' => $dataP['empresa'],
                        'nuevo' => $dataP['nuevo']
                        
                    ]);
                    
                };                
                return response()->json($pedido);
            });
        } catch (Exception $e) {
            $mensaje =  'Excepción capturada: ' . $e->getMessage() . "\n";

            return response()->json($mensaje);
        }
    }

    public function cambiarEstado(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $data = $request->input('data');
                $array = array();
                $i= 0;

                foreach ($data as $dataP) {
                    
                    pedido::where('id', $dataP['id'])->update([
                        'activo' => 'N',                        
                    ]);
                    
                };                
                return response()->json($pedido);
            });
        } catch (Exception $e) {
            $mensaje =  'Excepción capturada: ' . $e->getMessage() . "\n";

            return response()->json($mensaje);
        } 
    }
    public function Comiciones()
    {  
        $Mes   = date('n');
        $Anno   = date('Y');

        $Comision = Comision::getData($Mes,$Anno);
        return view('Ventas.Comiciones',compact('Comision'));
    }

    public function ComicionesConsulta(Request $request)
    {  
       

        $m           = $request->input('name_month');
        $y            = $request->input('name_year');
        
        $Comision = Comision::getData($m,$y);

        
        
        return view('Ventas.Comiciones',compact('Comision'));
    }

    public function CalcClose()
    {  
        $Comision = Comision::CalcClose();

    }

    public function getHistoryItems(Request $request)
    {
        $Ruta           = $request->input('ruta');
        $Mes            = $request->input('mes');
        $Anno           = $request->input('annio');

        $Comision = Comision::getHistoryItems($Ruta,$Mes,$Anno);
        return response()->json($Comision);
        
    }

    public function NotasCredito(){
        $Vendedores = Vendedores::getVendedor();
        return view('Ventas.NotasCredito',compact('Vendedores'));
    }

    public function getFacturasCreditos(Request $request){
        $mes = $request->input('mes');
        $anno = $request->input('anno');
        $ruta = $request->input('ruta');

        $query = "select * from PRODUCCION.dbo.iweb4_facturas_por_rutas where vendedor = '".$ruta."' and nYear = ".$anno." and nMes = ".$mes;
        
        $facturas = DB::connection('sqlsrv')->select($query);
        return response()->json($facturas);
    }

    public function getNotasCreditos(Request $request){
        $mes = $request->input('mes');
        $anno = $request->input('anno');
        $ruta = $request->input('ruta');

        $facturas = NotaCredito::where('MES', $mes)->where('ANNO', $anno)->where('RUTA', $ruta)->get();
        return response()->json($facturas);
    }

    public function getDetallesFactura(Request $request)
    {
        $Factura = $request->input('factura');

        $response = FacturaDetalle::getDetalles($Factura);
        return response()->json($response);
    }

    public function postNuevoNotaCredito(Request $request){
        try {
            
            $ruta = $request->input('ruta');
            $nota = $request->input('notaC');
            $factura = $request->input('factura');
            $articulo = $request->input('articulo');
            $tipo = 0;
            $resp = '';

            $sql = "SELECT Lista FROM PRODUCCION.dbo.table_articulo_comisiones WHERE VENDEDOR = '".$ruta."'"." AND ARTICULO = '".$articulo."'";
            $query = DB::connection('sqlsrv')->select($sql);

            if(count($query) > 0){
                $tipo = $query[0]->Lista;
            }
            
            $consult = NotaCredito::where('FACTURA', $factura)->where('ARTICULO', $articulo)->where('NOTACREDITO', $nota)->get();

            if(count($consult) > 0){
                $tipo = 1;
            }

            $nMonth = $request->input('fecha');

            $nYear = date('Y', strtotime($nMonth));
            $nMonth = date('n', strtotime($nMonth));

            $nCredito = new NotaCredito();

            $nCredito->RUTA         =   $ruta;
            $nCredito->NOTACREDITO  =   $nota;
            $nCredito->FACTURA      =   $factura;
            $nCredito->ARTICULO     =   $articulo;
            $nCredito->TIPO         =   $tipo;
            $nCredito->VALOR        =   $request->input('valor');
            $nCredito->MES          =   $nMonth;
            $nCredito->ANNO         =   $nYear;
            $nCredito->FECHAA       =   $request->input('fecha');

            if($tipo == 0){
                $resp = 'no';
                
             }else if($tipo == 80 || $tipo == 20){
                $nCredito->save();
                $resp = 'ok';
             }else if($tipo == 1){
                $resp = 'si';
             }
            return response()->json($resp);
        } catch (Exception $e) {
            $mensaje =  'Excepción capturada: ' . $e->getMessage() . "\n";

            return response()->json($mensaje);
        }
    }

    public function deleteNotaCredito(Request $request)
    {
        $articulo = $request->input('articulo');
        $nota     = $request->input('nota');
        try {

            $response =   NotaCredito::where('ARTICULO',  $articulo)->where('NOTACREDITO', $nota)->delete();

            return response()->json($response);


        } catch (Exception $e) {
            $mensaje =  'Excepción capturada: ' . $e->getMessage() . "\n";
            return response()->json($mensaje);
        }
    }
}
