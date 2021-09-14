<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataPenjualanController extends Controller
{
    
    public function index() {
        return view('penjualan');
    }

}
