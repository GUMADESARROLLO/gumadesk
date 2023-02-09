<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;


class Vendedores extends Model
{
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    protected $table = "PRODUCCION.dbo.vtVS2_Vendedores";


    public static function getVendedor()
    {
        $i = 0;
        $json = array();

        $Rutas = Vendedores::whereNotIn('VENDEDOR',['F01','F02','F04','F24'])->get();
        
        foreach($Rutas as $ruta){

            $rw = VendedoresAsignados::where('Ruta',$ruta->VENDEDOR)->get()[0]->original;

            $json[$i]['VENDEDOR']   = $ruta->VENDEDOR;
            $json[$i]['NOMBRE']     = $ruta->NOMBRE;
            $json[$i]['ASIGNADA']   = $rw['Ruta_asignada'];
            $i++;

        }
        return  $json;
    }
    public static function getVendedorComision()
    {  
        $i = 0;
        $json = array();

        $Rutas = Vendedores::whereNotIn('VENDEDOR',['F01','F12','F02','F18',"F15","F04",'F24',"F21","F23","F22","F19"])->get();
        //$Rutas = Vendedores::whereIn('VENDEDOR',['F06'])->get();

        foreach($Rutas as $ruta){

            $rw = VendedoresAsignados::where('Ruta',$ruta->VENDEDOR)->get()[0]->original;

            $json[$i]['VENDEDOR']   = $ruta->VENDEDOR;
            $json[$i]['NOMBRE']     = $ruta->NOMBRE;
            $json[$i]['ASIGNADA']   = Vendedores::getZone($ruta->VENDEDOR);
            $i++;

        }
        return  $json;
    }

    public static function getZone($Ruta)
    {

        $rZona = Zona::where('Ruta', $Ruta)->first();
        return $rZona->Zona; 
    
    }
}
