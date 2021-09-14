<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StockBahanController extends Controller
{
    public function index(){
        return view('stock');
    }

}
