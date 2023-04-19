<?php

namespace App\Http\Controllers;

use App\Models\Promocion;
use App\Models\PromocionDetalle;
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
        $Articulos     = Articulos::getArticulos();
        return view('Promocion.home',compact('Promociones','Articulos'));
    }

    public function SavePromo(Request $request)
    {   
        $response = Promocion::SavePromo($request);
        return response()->json($response);
    }

    public function SaveDetalles(Request $request)
    {
        $response = PromocionDetalle::SaveDetalles($request);
        return response()->json($response);
    }
    public function getDetalles(Request $request)
    {
        $Id = $request->input('IdPromo');

        $response = PromocionDetalle::getDetalles($Id);
        return response()->json($response);
    }
    public function DeleteItems(Request $request)
    {
        $response = PromocionDetalle::DeleteDetalle($request);
        return response()->json($response);
    }
    public function rmPromocion(Request $request)
    {
        $response = Promocion::rmPromocion($request);
        return response()->json($response);
    }
    public function updtFechas(Request $request)
    {
        $response = Promocion::updtFechas($request);
        return response()->json($response);
    }
    
}
