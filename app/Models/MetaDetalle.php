<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class MetaDetalle extends Model
{
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    protected $table = "DESARROLLO.dbo.gn_cuota_x_productos";

    
    
}
