<?php
namespace App\Http\Controllers;
use App\Models\GmvApi;
use App\Models\Comision;
use GMP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller{
    public function CalcClose()
    {  
        $Comision = Comision::CalcClose();

    }
}