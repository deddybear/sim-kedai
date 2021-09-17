<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserActivityController extends Controller
{
    
    public function index(){
        return view('user-activity');
    }

    public function dataActivity(Request $req){
        # code...
    }

    public function getActivity($id){
        # code...
    }
}
