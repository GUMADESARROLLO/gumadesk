<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class pedido extends Model
{

    protected $table = 'view_master_pedidos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 
        'numOrden',
        'numFactura', 
        'fecha_despacho', 
        'fecha_orden', 
        'codigo', 
        'descripcion', 
        'lab', 
        'cantidad', 
        'mific', 
        'precio_farm', 
        'precio_publ', 
        'precio_inst', 
        'permiso_necesario', 
        'consignado', 
        'nombre',
        'tipo', 
        'comentarios', 
        'estado',
        'empresa',
        'nuevo'
    ];
    public $timestamps = false;


    public static function getPedidos()
    {
        return pedido::where('activo', 'S')->get();
    }
}
