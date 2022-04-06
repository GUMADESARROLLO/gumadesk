<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consignados extends Model
{
    protected $table = "tbl_consignados";
    protected $fillable = ['id', 'Nombre'];

    public static function getConsignados()
    {

        return Consignados::all();
    }
}
