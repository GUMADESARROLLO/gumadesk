<?php

namespace App\Http\Controllers;

use App\Models\Promocion;
use App\Models\Vendedores;
use App\Models\Articulos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PromocionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getPromocion()
    {  
        $Mes   = date('n');
        $Anno   = date('Y');

        $Promociones   = Promocion::getData();
        $Vendedores    = Vendedores::getVendedor();
        $Articulos     = Articulos::getArticulos();
        return view('Promocion.home',compact('Promociones','Vendedores','Articulos'));
    }

    public function SavePromo(Request $request)
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
}
