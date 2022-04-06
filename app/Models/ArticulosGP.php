<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticulosGP extends Model
{
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    protected $table = "PRODUCCION.dbo.GP_GMV_mstr_articulos";

    public static function getArticulos()
    {

        return ArticulosGP::all();
    }
}
