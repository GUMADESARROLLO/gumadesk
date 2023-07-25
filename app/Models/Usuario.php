<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class Usuario extends Model {
    protected $table = "users";
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'usuario_rol', 'usuario_id', 'rol_id');
    }
   
}