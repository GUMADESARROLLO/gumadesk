<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Meta extends Model
{
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    protected $table = "DESARROLLO.dbo.metacuota_GumaNet";

    public function detalles()
    {
        return $this->hasMany('App\Models\MetaDetalle', 'IdPeriodo', 'IdPeriodo');
    }

}
