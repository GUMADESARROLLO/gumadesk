<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TicketsController extends Controller{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        return view('Tickets.dashboard');
    }
    public function getTickets()
    {
        return view('Tickets.OnlyTickets');
    }
    public function getTicketDetalles()
    {
        return view('Tickets.Detalles');
    }

    public function Nuevo()
    {
        return view('Tickets.Nuevo');
    }
    public function getcategorias()
    {
        return view('Tickets.Categorias');
    }
    public function getUsuarios()
    {
        return view('Tickets.Usuarios');
    }

    public function getDepartamentos()
    {
        return view('Tickets.Departamentos');
    }
    public function getUnidadNegocio()
    {
        return view('Tickets.UnidadNegocio');
    }

}