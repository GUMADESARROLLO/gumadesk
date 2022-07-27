<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class ListaArticulos extends Model {
    protected $table = "tbl_listas_articulos_rutas";
    protected $fillable = ['id','Articulo','Ruta','Lista','Activo','created_at','updated_at'];

    public static function getProyecciones(Request $request){
        $ruta     = $request->input('ruta');        
        return ListaArticulos::where('Ruta',$ruta)->get();
    }
    public static function getArticulosVinneta(Request $request){
        $nMes   = $request->input('nMes');        
        $annio  = $request->input('annio');        
        
        return ArticulosVinneta::where('NMES',$nMes)->where('ANNIO',$annio)->get();
    }

    public static function GuardarListas(Request $request) {
        if ($request->ajax()) {
            try {
                $datos_a_insertar = array();      
                $mdl = $request->input('mdl');

                //$isExit = ListaArticulos::getProyecciones($request);

                if($mdl =="item_vinneta" ){
                    foreach ($request->input('datos') as $key => $val) {
                        $datos_a_insertar[$key]['ARTICULO']         = $val['Articulos'];
                        $datos_a_insertar[$key]['VALOR']            = $val['Valor'];
                        $datos_a_insertar[$key]['NMES']             = $val['nMes'];
                        $datos_a_insertar[$key]['ANNIO']            = $val['annio'];
                        $datos_a_insertar[$key]['created_at']       = date('Y-m-d H:i:s');
                        $datos_a_insertar[$key]['updated_at']       = date('Y-m-d H:i:s');
                    }
                    $response = ArticulosVinneta::insert($datos_a_insertar); 

                }else{
                    ListaArticulos::where('Activo', 'S')->delete();
                    foreach ($request->input('datos') as $key => $val) {
                        $datos_a_insertar[$key]['Articulo']        = $val['Articulos'];
                        $datos_a_insertar[$key]['Ruta']             = $val['Ruta'];
                        $datos_a_insertar[$key]['Lista']            = $val['Lista'];
                        $datos_a_insertar[$key]['Activo']           = 'S';
                        $datos_a_insertar[$key]['created_at']       = date('Y-m-d H:i:s');
                        $datos_a_insertar[$key]['updated_at']       = date('Y-m-d H:i:s');
                        
                    }
                    $response = ListaArticulos::insert($datos_a_insertar); 
                }

                
                
                return $response;
                
            } catch (Exception $e) {
                $mensaje =  'Excepción capturada: ' . $e->getMessage() . "\n";
                return response()->json($mensaje);
            }
        }
    }

    public static function AddOneArticulo(Request $request) {
        if ($request->ajax()) {
            try {

                $Articulo = $request->input('Articulos');
                $Ruta = $request->input('Ruta');
                $Lista = $request->input('Lista');
              
                $obj_Productos = new ListaArticulos();   
                $obj_Productos->Articulo        = $Articulo;                
                $obj_Productos->Ruta       = $Ruta;                    
                $obj_Productos->Lista       = $Lista;
                $obj_Productos->Activo                  = 'S';                 
                $response = $obj_Productos->save();
            
                
                return $response;
                
            } catch (Exception $e) {
                $mensaje =  'Excepción capturada: ' . $e->getMessage() . "\n";
                return response()->json($mensaje);
            }
        }
    }

    public static function CambiarDeLista(Request $request)
    {
        if ($request->ajax()) {
            try {

                $valor   = $request->input('valor');
                $id      = $request->input('id');
                
                $response =   ListaArticulos::where('id',  $id)->update([
                    "Lista" => $valor,
                ]);

                return response()->json($response);


            } catch (Exception $e) {
                $mensaje =  'Excepción capturada: ' . $e->getMessage() . "\n";
                return response()->json($mensaje);
            }
        }

    }
    


}