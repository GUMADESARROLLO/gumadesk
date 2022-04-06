<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laboratorios extends Model
{
    protected $table = "tbl_laboratorios";
    protected $fillable = ['id_lab', 'nombre_lab'];

    public static function getLaboratorios()
    {

        return Laboratorios::all();
    }
}
