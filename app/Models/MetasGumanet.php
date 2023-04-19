<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class MetasGumanet extends Model
{
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    protected $table = "DESARROLLO.dbo.metacuota_GumaNet";
}