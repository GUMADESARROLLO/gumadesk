<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacturasRutas extends Model
{
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    protected $table = "PRODUCCION.dbo.iweb4_facturas_por_rutas";
}
