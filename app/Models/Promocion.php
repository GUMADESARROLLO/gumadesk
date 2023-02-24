<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
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
        return Promocion::whereNotIn('estado',['0'])->get();

    }
    public static function rmPromocion(Request $request)
    {
        if ($request->ajax()) {
            try {

                $id     = $request->input('id');
                
                $response =   Promocion::where('id',  $id)->update([
                    "estado" => 0,
                ]);

                return response()->json($response);


            } catch (Exception $e) {
                $mensaje =  'Excepción capturada: ' . $e->getMessage() . "\n";
                return response()->json($mensaje);
            }
        }

    }
    public static function SavePromo(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {

                $Titulo     = $request->input('PromoName');
                $RutaCode   = $request->input('RutaCode');
                $PromoIni   = date('Y-m-d', strtotime($request->input('PromoIni')));
                $PromoEnd   = date('Y-m-d', strtotime($request->input('PromoEnd')));
                $Estado     = 1;


                $promo = new Promocion();
                    
                $promo->Titulo      =   $Titulo;
                $promo->fecha_ini   =   $PromoIni;
                $promo->fecha_end   =   $PromoEnd;  
                $promo->estado      =   $Estado;  
                $promo->Ruta        =   $RutaCode;       
                $promo->save();             
                
                return redirect()->to('Promocion')->send();
            });
        } catch (Exception $e) {
            $mensaje =  'Excepción capturada: ' . $e->getMessage() . "\n";

            return response()->json($mensaje);
        }
    }
    public static function updtFechas(Request $request)
    {
        if ($request->ajax()) {
            try {

                $id         = $request->input('id');
                $valor      = $request->input('valor');
                $Campo      = $request->input('Campo');

                $array_Campos =  array("fecha_ini", "fecha_end") ;
                

                $response =   Promocion::where('id',  $id)->update([
                    $array_Campos[$Campo] => $valor,
                ]);

                return response()->json($response);


            } catch (Exception $e) {
                $mensaje =  'Excepción capturada: ' . $e->getMessage() . "\n";
                return response()->json($mensaje);
            }
        }

    }
}