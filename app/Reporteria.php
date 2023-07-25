<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Vendedores;
use App\Models\MetasGumanet;

class Reporteria extends Model
{
    public function __construct() {
        $this->middleware('auth');
    }
    public static function get_rutas_group($Id)
    {
        
        $UsrName = DB::table('users')->where('id', $Id)->pluck('username');

        $datos_rutas = DB::table('sac_app.view_rutas')->where('id', $UsrName)->get();

        $json = array();
        $i = 0;

        if (count($datos_rutas) > 0) {
            foreach ($datos_rutas as $key => $value) {

                $json['id']     = $value->id;
                $json['ruta']   = $value->RUTA;
                

                $i++;
            }
        }

        return $json;
    }
    public static function ActualizarDiaHabiles($val)
    {
    
        $sql_exec = '';
        $request = Request();        

        //$sql_exec = "SET NOCOUNT ON ; UPDATE DESARROLLO.dbo.metacuota_GumaNet set dias_habiles = ".$val." WHERE Estado= 1 ";
        //DB::connection('sqlsrv')->select($sql_exec);
        try {

            
            $response =   MetasGumanet::where('Estado',  1)->update([
                "dias_habiles" => $val,
            ]);


        } catch (Exception $e) {
            $mensaje =  'Excepción capturada: ' . $e->getMessage() . "\n";
            return response()->json($mensaje);
        }

    }
    public static function get8020($Ruta,$d1,$d2)
    {
        $Vendedores = Vendedores::getVendedor();
        $data  = array();
        $cArti = array();
        $c=0;
        $Clasi = 0;
       
        
        
        

        $c=0;

        foreach ($Vendedores as $Vendedor ) {
            $data[$c]['VENDEDOR']           = $Vendedor['VENDEDOR'];

            for ($i=1; $i <= 12; $i++) { 

                $sql = "SELECT T0.VENDEDOR,T0.ARTICULO,CONVERT(DECIMAL(7,2),COUNT(T0.ARTICULO)) cArticulo,CONVERT(DECIMAL(7,2),COUNT(COUNT(T0.ARTICULO)) over ()) cttArticulo,
                ((CONVERT(DECIMAL(7,2),COUNT(T0.ARTICULO)) /  CONVERT(DECIMAL(7,2),COUNT(COUNT(T0.ARTICULO)) over ()) ) * 100 ) Aporte
                FROM Softland.dbo.ANA_VentasTotales_MOD_Contabilidad_UMK T0 
                WHERE T0.VENDEDOR = '".$Vendedor['VENDEDOR']."' AND YEAR ( T0.Fecha_de_factura ) = '2022' AND MONTH ( T0.Fecha_de_factura ) = '".$i."' 
                AND t0.VENTA_NETA  > 0 AND t0.ARTICULO NOT LIKE 'VU%' GROUP BY  T0.VENDEDOR,T0.ARTICULO ORDER BY  T0.VENDEDOR,COUNT(T0.ARTICULO) DESC";  
                $query = DB::connection('sqlsrv')->select($sql);
                
                $Clasi = 0;                
                $cArti = array();

                foreach ($query as $key) {
                    $Clasi   += $key->Aporte;
                    $setList =  ($Clasi<=80) ? 80 : 20 ;
                    if($setList == 80){
                        $cArti[] =$key->ARTICULO;
                    }      
                }



                $data[$c]['ARTICULOS'][$i]['NUM_MOTH']           = $i;
                $data[$c]['ARTICULOS'][$i]['TOTAL_SKU']           = count($query) ;
                $data[$c]['ARTICULOS'][$i]['TOTAL_P8020']           =count($cArti) ;
                $data[$c]['ARTICULOS'][$i]['TOTAL_CLIENTE']           = count($query) ;
                $data[$c]['ARTICULOS'][$i]['TOTAL_C8020']           =count($cArti) ;
            }
            $c++;
            
        }
        
        
        return $data;
    }
    public static function getData($d1,$d2){

        // rol de usuario
        $role       = Auth::User()->activeRole();
        $Rutas      = '';
        $id_user    = Auth::id();
        
        
        if($role==1){
            
            if($id_user==10){            
                $Rutas = " AND VENDEDOR IN ( 'F02','F14','F08','F06','F07','F13' ) ";
            }
    
            if($id_user==16){            
                $Rutas = " AND VENDEDOR IN ( 'F04','F10','F09','F05','F19','F20','F03','F11' ) ";
            } 
        }else{            
            $data_ruta = Reporteria::get_rutas_group($id_user);
            $Rutas = " AND VENDEDOR IN ( ".$data_ruta['ruta']." ) ";
        }
        
        
      
        $data = array();
        $i=0;
        $sql_exec = '';
        $request = Request();
        

        $sql_exec = "SELECT
        T0.VENDEDOR,
        ISNULL((SELECT META_RUTA FROM PRODUCCION.dbo.rpt_informe_ventas_metas_rutas T2 WHERE T2.RUTA = T0.VENDEDOR),0) META_RUTA,
        ISNULL((SELECT COUNT(DISTINCT T1.CLIENTE) FROM Softland.UMK.PEDIDO AS T1 WHERE T1.ESTADO= 'F'AND T1.FECHA_PEDIDO BETWEEN '".$d1."'  AND '".$d2."' AND T1.VENDEDOR = T0.VENDEDOR ), 0) AS CLIENTE,
        ISNULL((SELECT T3.META_CLIENTE FROM PRODUCCION.dbo.tbl_meta_cliente_rutas T3 WHERE T3.RUTA = T0.VENDEDOR AND T3.MES = MONTH( '".$d1."') AND T3.ANNIO= YEAR( '".$d1."')),0) AS META_CLIENTE,
        SUM(T0.TOTAL_LINEA) as MesActual,
        ISNULL((SELECT  sum(T4.VENTA_NETA) Venta FROM Softland.dbo.ANA_VentasTotales_MOD_Contabilidad_UMK T4  WHERE T4.Fecha_de_factura = '".$d2."' AND T4.VENDEDOR=	 T0.VENDEDOR    ), 0) AS DiaActual,	
        ISNULL((SELECT COUNT(DISTINCT T1.ARTICULO) FROM PRODUCCION.dbo.view_master_pedidos_umk_v2 AS T1 WHERE T1.FECHA_PEDIDO BETWEEN '".$d1."' AND '".$d2."'AND T1.VENDEDOR = T0.VENDEDOR ), 0) AS SKU,	
        ISNULL((SELECT SUM(T1.TOTAL_LINEA) AS NoV FROM PRODUCCION.dbo.view_master_pedidos_umk_v2 AS T1 WHERE T1.FECHA_PEDIDO BETWEEN '".$d1."'  AND '".$d2."' AND T1.VENDEDOR = T0.VENDEDOR and   T1.PEDIDO NOT LIKE 'PT%'  ), 0) AS EJEC,
        ISNULL((SELECT SUM(T1.TOTAL_LINEA) AS NoV FROM PRODUCCION.dbo.view_master_pedidos_umk_v2 AS T1 WHERE T1.FECHA_PEDIDO BETWEEN '".$d1."'  AND '".$d2."' AND T1.VENDEDOR = T0.VENDEDOR and   T1.PEDIDO LIKE 'PT%'    ), 0) AS SAC
    
    FROM
        PRODUCCION.dbo.view_master_pedidos_umk_v2 T0 	
        
    WHERE
        T0.FECHA_PEDIDO BETWEEN '".$d1."' AND '".$d2."'  AND T0.VENDEDOR NOT IN ( 'F01', 'F12' ) ".$Rutas."
    GROUP BY T0.VENDEDOR";


        $sql_skus = "SELECT 	( 
            SELECT COUNT(DISTINCT T0.ARTICULO) FROM	PRODUCCION.dbo.view_master_pedidos_umk_v2 T0 
            WHERE T0.FECHA_PEDIDO BETWEEN DATEADD( m, DATEDIFF( m, 0, '".$d1."' ), 0 ) AND dateadd( DD, - 1, CAST ( '".$d2."'AS DATE ) ) 
            AND T0.VENDEDOR NOT IN ( 'F01','F02', 'F04','F15','F12' ) 
            ) SKU_Farmacia,
            ( 
                SELECT COUNT(DISTINCT T0.ARTICULO) FROM	PRODUCCION.dbo.view_master_pedidos_umk_v2 T0
                WHERE T0.FECHA_PEDIDO BETWEEN DATEADD( m, DATEDIFF( m, 0, '".$d1."' ), 0 ) AND dateadd( DD, - 1, CAST ( '".$d2."'AS DATE ) ) 
                AND T0.VENDEDOR IN ( 'F02', 'F04' ) 
            ) SKU_Proyect02,
            COUNT(DISTINCT T0.ARTICULO) SKU_TODOS
            FROM
            PRODUCCION.dbo.view_master_pedidos_umk_v2 T0
            WHERE
            T0.FECHA_PEDIDO BETWEEN '".$d1."' AND '".$d2."' AND T0.VENDEDOR NOT IN ( 'F01', 'F12' ) ";
            
            

        $rSKU_Facturados      = DB::connection('sqlsrv')->select($sql_skus);

        $Fecha_Periodo  = date('Y-m',strtotime($d1))."-01";

        

        

        $sql_dias_habiles="SELECT T0.dias_facturados,T0.dias_habiles FROM DESARROLLO.dbo.metacuota_GumaNet T0 WHERE T0.Fecha = '".$Fecha_Periodo."'";

   

        $rDiasHabiles      = DB::connection('sqlsrv')->select($sql_dias_habiles);

        $data['SKU_Farmacia'] = floatval($rSKU_Facturados[0]->SKU_Farmacia);
        $data['SKU_Proyect02'] = floatval($rSKU_Facturados[0]->SKU_Proyect02);
        $data['SKU_TODOS'] = floatval($rSKU_Facturados[0]->SKU_TODOS);

        $var_dias_habiles = (!isset($rDiasHabiles[0]->dias_habiles)) ? 1 : floatval($rDiasHabiles[0]->dias_habiles) ; 
        $var_dias_factura =  (!isset($rDiasHabiles[0]->dias_facturados)) ? 1 : floatval($rDiasHabiles[0]->dias_facturados) ; 
        
        $porcen_dias = ($var_dias_habiles / $var_dias_factura) * 100 ;


        
        $data['Dias_Habiles'] = $var_dias_habiles;
        $data['Dias_Facturados'] = $var_dias_factura; 
        $data['Dias_porcent'] = number_format($porcen_dias,0) . " %"; 
        
        $data['isToDay'] = date( "d-M", strtotime( date('Y-m-d') . "-1 day"));

        $query      = DB::connection('sqlsrv')->select($sql_exec);



        $sql_vendedor = "SELECT VENDEDOR, NOMBRE FROM Softland.umk.VENDEDOR WHERE ACTIVO='S' AND VENDEDOR != 'LPCM'";
      
        $rVendedor      = DB::connection('sqlsrv')->select($sql_vendedor);

        $SAC_into_vendedor = array(
            ["RUTA" => "F03","SAC" => "AURA","ZONA" => "MGA ABAJO"],
            ["RUTA" => "F05","SAC" => "AURA","ZONA" => "MGA ARRIBA"],            
            ["RUTA" => "F21","SAC" => "AURA","ZONA" => "N/D"],   
        
            ["RUTA" => "F19","SAC" => "NADIESKA","ZONA" => "Santo Tomas - RAAS"],
            ["RUTA" => "F06","SAC" => "NADIESKA","ZONA" => "LEON"],
            ["RUTA" => "F14","SAC" => "NADIESKA","ZONA" => "CHINANDEGA"],
            ["RUTA" => "F13","SAC" => "NADIESKA","ZONA" => "MGA ABAJO SUR"],            
           
            ["RUTA" => "F07","SAC" => "YESSICA","ZONA" => "MYA-GDA"],
            ["RUTA" => "F23","SAC" => "YESSICA","ZONA" => "SUR ORIENTE"],
        
            ["RUTA" => "F09","SAC" => "REYNA","ZONA" => "Esteli - Somoto"],
            ["RUTA" => "F10","SAC" => "REYNA","ZONA" => "MAT-JIN"],
            ["RUTA" => "F22","SAC" => "REYNA","ZONA" => "N/D"],
            ["RUTA" => "F08","SAC" => "REYNA","ZONA" => "CAR-RIV"],
            
            
            ["RUTA" => "F11","SAC" => "YORLENI","ZONA" => "Boaco - Juigalpa"],
            ["RUTA" => "F20","SAC" => "YORLENI","ZONA" => "Río Blanco - RAAN."],           
        
            ["RUTA" => "F02","SAC" => "ALEJANDRA","ZONA" => "INSTIT"],
            ["RUTA" => "F04","SAC" => "ALEJANDRA","ZONA" => "MCDO/MAYORISTAS"],
            ["RUTA" => "F15","SAC" => "","ZONA" => "VENTAS GERENCIA"],            
            ["RUTA" => "F18","SAC" => "","ZONA" => ""],             
        );


        if( count($query)>0 ) {
            foreach ($query as $key) {

                $index_key = array_search($key->VENDEDOR, array_column($rVendedor, 'VENDEDOR'));

                $in_key = array_search($key->VENDEDOR, array_column($SAC_into_vendedor, 'RUTA'));                

                $data[$i]['VENDEDOR']           = $key->VENDEDOR;
                $data[$i]['NOMBRE']             = $rVendedor[$index_key]->NOMBRE;
                $data[$i]['NOMBRE_SAC']         = $SAC_into_vendedor[$in_key]['SAC'];
                $data[$i]['RUTA_ZONA']          = $SAC_into_vendedor[$in_key]['ZONA'];                
                $data[$i]['META_RUTA']          = 'C$ ' . number_format($key->META_RUTA,2);
                $data[$i]['MesActual']          = 'C$ ' . number_format($key->MesActual, 2);
                $CUMPL_EJECT = ($key->META_RUTA=='0.00') ? number_format($key->META_RUTA,2) :  number_format(($key->MesActual/ $key->META_RUTA) * 100,0) ;
                $data[$i]['RUTA_CUMPLI']        = $CUMPL_EJECT.' %';
                $data[$i]['CLIENTE']            = $key->CLIENTE;
                $data[$i]['META_CLIENTE']       = $key->META_CLIENTE;                
                $TENDENCIA = ($CUMPL_EJECT / $var_dias_habiles ) * $var_dias_factura ;
                $data[$i]['TENDENCIA']          = number_format($TENDENCIA,0) . " % ";
                $data[$i]['CLIENTE_COBERTURA']  = ($key->META_CLIENTE=='0.00') ? number_format($key->META_CLIENTE,2) : number_format(($key->CLIENTE / $key->META_CLIENTE) * 100,0).' %' ;
                $data[$i]['SKU']                = $key->SKU;
                $data[$i]['DS']                 = 'C$ ' . number_format($key->MesActual / $key->CLIENTE,2);                
                $data[$i]['DiaActual']          = 'C$ ' . number_format($key->DiaActual, 2);                
                $data[$i]['EJEC']               = 'C$ ' . number_format($key->EJEC, 2);
                $data[$i]['SAC']                = 'C$ ' . number_format($key->SAC, 2);
                
                $i++;
            }
            
        }

        return $data;
    }
}
