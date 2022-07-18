<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class VendedoresAsignados extends Model {
    protected $table = "tlb_rutas_asignadas";
    protected $fillable = ['id','Ruta','Ruta_asignada','created_at','updated_at'];

    public static function GuardarAsignacion(Request $request)
    {
        if ($request->ajax()) {
            try {

                $Ruta     = $request->input('Ruta');
                $Asign     = $request->input('Asign');
                
                $response =   VendedoresAsignados::where('Ruta',  $Ruta)->update([
                    "Ruta_asignada" => $Asign,
                ]);

                return response()->json($response);


            } catch (Exception $e) {
                $mensaje =  'Excepción capturada: ' . $e->getMessage() . "\n";
                return response()->json($mensaje);
            }
        }

    }
 
}