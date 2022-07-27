<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ArticulosGROUPBY extends Model
{
    protected $table = "view_lista_articulos";
    protected $fillable = ['Ruta','Lista','Articulos'];
}
