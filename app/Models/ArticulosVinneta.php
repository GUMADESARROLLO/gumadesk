<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticulosVinneta extends Model
{
    protected $connection = 'sqlsrv';
    //public $timestamps = false;
    protected $table = "DESARROLLO.dbo.tlb_master_articulo_vinneta";
    protected $fillable = ['ARTICULO','VALOR','NMES','ANNIO','created_at','updated_at'];
}
