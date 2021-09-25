<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\UserActivityController as Activity;

class SettingsController extends Controller
{
    public function index() {
        return view('settings');
    }

    public function changeName($id, Request $req) {
        dd([$id, $req->nama_akun]);
    }

    public function changePassword($id, Request $req) {
        dd($id);
    }

    public function changeEmail($id, Request $req) {
        dd($id);
    }
}
