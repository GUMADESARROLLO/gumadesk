<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class Proyeccion extends Model {
    protected $table = "tbl_proyecciones";
    protected $fillable = [];
    
    public static function getProyecciones(Request $request){
        $Mes     = $request->input('mes');
        $Annio  = $request->input('annio');
        return Proyeccion::all();
    }


}