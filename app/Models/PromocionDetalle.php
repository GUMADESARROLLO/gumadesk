<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class PromocionDetalle extends Model{

    public static function getDetalles($ID)
    {  
        $i      = 0;
        $json   = array();
        $Rows       = PromocionDetalle::where('id_promocion',$ID)->get();

        $iPromo     = Promocion::where('id',$ID)->get();
        $fecha_ini  = $iPromo[0]->original['fecha_ini'];
        $fecha_end  = $iPromo[0]->original['fecha_end'];

        foreach($Rows as $r){


            $strQuery   = 'EXEC PRODUCCION.dbo.fn_promocion_venta_item "'.$fecha_ini.'","'.$fecha_end.'","'.$r->Articulo.'" ';            
            $query      = DB::connection('sqlsrv')->select($strQuery);

            $Venta          = 0;
            $PromVenta      = 0;
            $VentaUND       = 0;
            $PromVentaUND   = 0;

            if (count($query )>0) {
                $Venta          = number_format($query[0]->VAL,2,'.','');
                $VentaUND       = number_format($query[0]->UND,2,'.','');
            }

            $PromVenta      = ( $Venta !=0 ) ? ( $Venta / $r->ValMeta  ) * 100 : 0;
            $PromVentaUND   = ( $VentaUND !=0 ) ? ( $VentaUND / $r->MetaUnd  ) * 100 : 0;



            $json[$i]['id']                 = $r->id;
            $json[$i]['id_promocion']       = $r->id_promocion;
            $json[$i]['Articulo']           = $r->Articulo;
            $json[$i]['Descripcion']        = $r->Descripcion;
            $json[$i]['Precio']             = $r->Precio;
            $json[$i]['NuevaBonificacion']  = $r->NuevaBonificacion;
            $json[$i]['ValorVinneta']       = $r->ValorVinneta;
            $json[$i]['ValMeta']            = $r->ValMeta;
            $json[$i]['MetaUnd']            = $r->MetaUnd;
            $json[$i]['Promedio_VAL']       = $r->Promedio_VAL;
            $json[$i]['Promedio_UND']       = $r->Promedio_UND;
            $json[$i]['RangeProme']         = $r->RangeProme;
            $json[$i]['Venta']              = $Venta;
            $json[$i]['PromVenta']          = $PromVenta;
            $json[$i]['VentaUND']           = $VentaUND;
            $json[$i]['PromVentaUND']       = $PromVentaUND;
            $i++;

        }
        return  $json;
    }
    public static function DeleteDetalle(Request $request)
    {
        if ($request->ajax()) {
            try {

                $id     = $request->input('id');
                
                $response =   PromocionDetalle::where('id',  $id)->delete();

                return response()->json($response);


            } catch (Exception $e) {
                $mensaje =  'Excepción capturada: ' . $e->getMessage() . "\n";
                return response()->json($mensaje);
            }
        }

    }
    public static function SaveDetalles(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {

                $Descripcion = 'N/D';
                $Promedio_VAL = 0;
                $Promedio_UND = 0;

            

                $IdPromo        = $request->input('IdPromo');
                $Articulos      = $request->input('Articulos');
                $Periodo        = 12;
                $Precio         = $request->input('Precio');
                $Vinneta        = $request->input('Vinneta');
                $Bonificado     = $request->input('Bonificado');
                $MetaUnidades   = $request->input('MetaUnidades');
                $MetaValor      = $request->input('MetaValor');

                $Articulos_info = 'EXEC PRODUCCION.dbo.fn_promocion_promedios "'.$Periodo.'","'.$Articulos.'" ';
                $query          = DB::connection('sqlsrv')->select($Articulos_info);

                if (count($query )>0) {
                    $Descripcion    = $query[0]->DESCRIPCION;
                    $Promedio_VAL   = $query[0]->Promedio_VAL;
                    $Promedio_UND   = $query[0]->Promedio_UND;
                }


                $promo = new PromocionDetalle();
                    
                $promo->Articulo            =   $Articulos;
                $promo->Descripcion         =   $Descripcion;
                $promo->id_promocion        =   $IdPromo;
                $promo->Precio              =   $Precio;
                $promo->ValorVinneta        =   $Vinneta;
                $promo->NuevaBonificacion   =   $Bonificado;  
                $promo->MetaUnd             =   $MetaUnidades;  
                $promo->ValMeta             =   $MetaValor;
                $promo->RangeProme          =   $Periodo;  
                $promo->Promedio_VAL        =   $Promedio_VAL;  
                $promo->Promedio_UND        =   $Promedio_UND;
                $response = $promo->save();

                return $response;

            });
        } catch (Exception $e) {
            $mensaje =  'Excepción capturada: ' . $e->getMessage() . "\n";

            return response()->json($mensaje);
        }
    }
}