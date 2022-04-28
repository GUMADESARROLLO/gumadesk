<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reporteria extends Model
{
    public function __construct() {
        $this->middleware('auth');
    }

    public static function getData(){
        $sql_server = new \sql_server();        
        $data = array();
        $i=0;
        $sql_exec = '';
        $request = Request();
        

        $sql_exec = 'SELECT * FROM rpt_informe_ventas_umk T0 ORDER BY T0.VENDEDOR ASC';

        /*$sql_dias_facturados = 'SELECT COUNT (*) as Dias from ( SELECT DAY( T1.FECHA_PEDIDO ) DiasFacturados 
        FROM view_master_pedidos_umk T1 WHERE T1.FECHA_PEDIDO 
        BETWEEN DATEADD( m, DATEDIFF( m, 0, GETDATE( ) ), 0 )  
        AND GETDATE( )  AND T1.Number_Week_Day NOT IN (7,1)  GROUP BY FECHA_PEDIDO ) as DiasFacturados';
        $rDias_Facturados = $sql_server->fetchArray($sql_dias_facturados, SQLSRV_FETCH_ASSOC);*/

        $sql_dias_habiles='SELECT T0.dias_facturados FROM DESARROLLO.dbo.metacuota_GumaNet T0 WHERE T0.ESTADO = 1';
        $rDiasHabiles = $sql_server->fetchArray($sql_dias_habiles, SQLSRV_FETCH_ASSOC);


      

       //$var_dias_habiles = floatval($rDias_Facturados[0]['Dias']);
       $var_dias_habiles = 16;
       $var_dias_factura = floatval($rDiasHabiles[0]['dias_facturados']);

       $porcen_dias = ($var_dias_habiles / $var_dias_factura) * 100 ;


        
        $data['Dias_Habiles'] = $var_dias_habiles;
        $data['Dias_Facturados'] = $var_dias_factura; 
        $data['Dias_porcent'] = number_format($porcen_dias,0) . " %"; 
        
        $data['isToDay'] = date( "d-M", strtotime( date('Y-m-d') . "-1 day"));



        $query = $sql_server->fetchArray($sql_exec, SQLSRV_FETCH_ASSOC);


        $sql_vendedor = "SELECT VENDEDOR, NOMBRE FROM Softland.umk.VENDEDOR WHERE ACTIVO='S' AND VENDEDOR != 'LPCM'";
        $rVendedor = $sql_server->fetchArray($sql_vendedor, SQLSRV_FETCH_ASSOC);

        $SAC_into_vendedor = array(
            ["RUTA" => "F03","SAC" => "ALEJANDRA"],
            ["RUTA" => "F06","SAC" => "NADIESKA"],
            ["RUTA" => "F07","SAC" => "YORLENI"],
            ["RUTA" => "F08","SAC" => "REYNA"],
            ["RUTA" => "F13","SAC" => "NADIESKA"],            
            ["RUTA" => "F14","SAC" => "NADIESKA"],
            ["RUTA" => "F05","SAC" => "MARISELA"],
            ["RUTA" => "F09","SAC" => "YORLENI"],
            ["RUTA" => "F10","SAC" => "REYNA"],
            ["RUTA" => "F11","SAC" => "YORLENI"],
            ["RUTA" => "F20","SAC" => "REYNA"],
            ["RUTA" => "F02","SAC" => "ESPERANZA CASTILLO"],
            ["RUTA" => "F04","SAC" => "FRANCISCO AVALOS"],
            ["RUTA" => "F15","SAC" => "FERNADO DELCARMEN"],
        );


        if( count($query)>0 ) {
            foreach ($query as $key) {

                $index_key = array_search($key['VENDEDOR'], array_column($rVendedor, 'VENDEDOR'));

                $in_key = array_search($key['VENDEDOR'], array_column($SAC_into_vendedor, 'RUTA'));
                

                $data[$i]['VENDEDOR']        = $key['VENDEDOR'];
                $data[$i]['NOMBRE']          = $rVendedor[$index_key]['NOMBRE'];
                $data[$i]['NOMBRE_SAC']      = $SAC_into_vendedor[$in_key]['SAC'];
                
                $data[$i]['META_RUTA']       = 'C$ ' . number_format($key['META_RUTA'],2);
                $data[$i]['MesActual']       = 'C$ ' . number_format($key['MesActual'], 2);


                $CUMPL_EJECT = ($key['META_RUTA']=='0.00') ? number_format($key['META_RUTA'],2) :  number_format(($key['MesActual'] / $key['META_RUTA']) * 100,0) ;
                $data[$i]['RUTA_CUMPLI']       = $CUMPL_EJECT.' %';
                

                $data[$i]['CLIENTE']       = $key['CLIENTE'];
                $data[$i]['META_CLIENTE']             = $key['META_CLIENTE'];

                
                $TENDENCIA = ($CUMPL_EJECT / $var_dias_habiles ) * $var_dias_factura ;
                $data[$i]['TENDENCIA']       = number_format($TENDENCIA,0) . " % ";

                

                if ($key['META_CLIENTE']=='0.00') {
                    $data[$i]['CLIENTE_COBERTURA']       =  number_format($key['META_CLIENTE'],2);
                } else {
                    
                    $data[$i]['CLIENTE_COBERTURA']       =  number_format(($key['CLIENTE'] / $key['META_CLIENTE']) * 100,0).' %';
                }

                $data[$i]['SKU']           = $key['SKU'];
                $data[$i]['DS']           = 'C$ ' . number_format($key['MesActual'] / $key['CLIENTE'],2);
                
                $data[$i]['DiaActual']       = 'C$ ' . number_format($key['DiaActual'], 2);
                
                $data[$i]['EJEC']             = 'C$ ' . number_format($key['EJEC'], 2);
                $data[$i]['SAC']           = 'C$ ' . number_format($key['SAC'], 2);
                
                $i++;
            }
            
        }

        $sql_server->close();
        return $data;
    }
}
