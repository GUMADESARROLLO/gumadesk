<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacturaDetalle extends Model
{
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    protected $table = "PRODUCCION.dbo.UMK_DETALLES_FACTURAS";


    public static function getDetalles($ID)
    {  
        return FacturaDetalle::where('FACTURA',$ID)->get();
    }
}
