<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\UserActivityController as Activity;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function index() {
        return view('settings');
    }

    public function changeName($id, Request $req) {

        $req->validate([
            'nama_akun' => 'required|string|between:5,50'
        ]);
        
        if (User::where('id', $id)->update(['name' => $req->nama_akun])) {

            Activity::create(
                Auth::user()->name, 
                "Merubah Nama ", 
                Carbon::now('Asia/Jakarta')
            );

            Session::flash('sukses', 'Berhasil merubah nama akun anda');
            return redirect('/dashboard/settings');
        } else {
            Session::flash('gagal', 'Gagal merubah nama akun anda');
            return redirect('/dashboard/settings');
        }
    }

    public function changePassword($id, Request $req) {
        
        $req->validate([
            'password_sekarang' => 'required|string',
            'password'          => 'required|string|between:8,17|confirmed'
        ]);

        if ($oldPassword = User::select('password')->where('id', $id)->first()) {
            
            if (Hash::check($req->password_sekarang, $oldPassword->password)) {
                
                if (User::where('id', $id)->update(['password' => Hash::make($req->password)])) {

                    Activity::create(
                        Auth::user()->name, 
                        "Merubah Password", 
                        Carbon::now('Asia/Jakarta')
                    );
                    
                    $req->session()->flush();
                    return redirect('/login')->with('sukses', 'Berhasil merubah password akun anda');
                
                } else {
                    
                    return redirect('/dashboard/settings')->with('gagal', 'Gagal merubah password akun anda');
                }

            }

            return redirect('/dashboard/settings')->with('password_sekarang', 'Password Sekarang/Lama anda salah');
            
        }

        return redirect('/dashboard/settings')->with('gagal', 'Data User tidak diketahui coba sekali lagi');
    }

    public function changeEmail($id, Request $req) {

        $req->validate([
            'email' => 'required|email|max:40', Rule::unique('tbl_users', 'email')->ignore(Auth::id())
        ]);

        if (User::where('id', $id)->update(['email' => $req->email])) {
            
            Activity::create(
                Auth::user()->name, 
                "Merubah Email", 
                Carbon::now('Asia/Jakarta')
            );

            Session::flash('sukses', 'Berhasil merubah email akun anda');
            return redirect('/dashboard/settings');
        } else {
            Session::flash('gagal', 'Gagal merubah email akun anda');
            return redirect('/dashboard/settings');
        }
    }
}
