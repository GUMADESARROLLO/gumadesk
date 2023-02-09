<?php

namespace App\Models;

use Exception;
use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Model;

class NotaCredito extends Model
{
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    protected $table = "PRODUCCION.dbo.tbl_notas_creditos";
}
