<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\ArticulosGROUPBY;

class Articulos extends Model
{
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    protected $table = "PRODUCCION.dbo.iweb_articulos";

    public static function getArticulos()
    {
        return Articulos::all();
    }
    public static function getArticulosPOST(Request $request)
    {

        if ($request->ajax()) {
            try {
                
                $Ruta = $request->input('Ruta');
                $Articulos_Ruta =  ArticulosGROUPBY::where('Ruta',$Ruta)->get();
                
                $response =  Articulos::whereNotIn('ARTICULO',[$Articulos_Ruta[0]['Articulos']])->get();
                
                return $response;
                
            } catch (Exception $e) {
                $mensaje =  'Excepción capturada: ' . $e->getMessage() . "\n";
                return response()->json($mensaje);
            }
        }
        
    }
}
