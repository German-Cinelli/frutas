<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }


    /**
     * Método para el administrador del sistema
     */
    public function index(){
        return view('dashboard.index');
    }


    /**
     * Método para los clientes
     */
    public function cliente(){
        return view('dashboard_customer.index');
    }
}
