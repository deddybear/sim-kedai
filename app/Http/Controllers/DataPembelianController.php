<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataPembelianController extends Controller
{
    public function index(){
        return view('pembelian');
    }
}
