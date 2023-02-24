<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class Promocion extends Model{

    public function Vendor(){
        return $this->belongsTo('App\Models\Vendedores','Ruta','VENDEDOR');
    }
    public function Zona(){
        return $this->belongsTo('App\Models\Zona','Ruta','Ruta');
    }
    public function Detalles(){
        return $this->hasMany('App\Models\PromocionDetalle','id_promocion','id');
    }

    public function Estado(){
        return $this->belongsTo('App\Models\PromocionEstado','estado','id');
    }

    public static function getData()
    {
        return Promocion::all();

    }
}