<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Ramsey\Uuid\Uuid as Generate;
use App\Models\User;
use App\Http\Controllers\UserActivityController as Activity;
use App\Http\Requests\ValidationPegawai;
use App\Mail\RegisterMail;


class PegawaiController extends Controller
{
    public function index(){
        return view('user-pegawai');
    }

    public function data() {
        
        $query = User::select('id', 'email', 'name', 'email_verified_at', 'created_at', 'updated_at')
                    ->where('roles', '0')
                    ->orderBy('created_at', 'asc');

        return DataTables::eloquent($query)
                          ->addIndexColumn()
                          ->editColumn('email_verified_at', function ($query) {
                            if ($query->email_verified_at) {
                                return Carbon::createFromFormat('Y-m-d H:i:s', $query->email_verified_at, 'Asia/Jakarta')
                                           ->format('Y-m-d');
                            }

                            return 'Belum Verifikasi';
                          })
                          ->editColumn('created_at', function ($query) {
                            return Carbon::createFromFormat('Y-m-d H:i:s', $query->created_at, 'Asia/Jakarta')
                                           ->format('Y-m-d');
                          })
                          ->editColumn('updated_at', function ($query) {
                            return Carbon::createFromFormat('Y-m-d H:i:s', $query->updated_at, 'Asia/Jakarta')
                                           ->format('Y-m-d');
                          })
                          ->addColumn('Actions', function($query) {
                            return '
                            <a href="javascript:;" class="btn btn-xs btn-danger delete" data="'.$query->id.'">Hapus</a>
                            ';
                          })
                          ->rawColumns(['Actions'])
                          ->toJson();
    }

    public function search(Request $req) {

        $query = User::select($req->type)
                        ->where('roles', '0')
                        ->whereRaw("LOWER($req->type) LIKE ?", ["%".strtolower($req->keyword)."%"])
                        ->distinct()
                        ->get();

        return $query;         
    }

    public function create(ValidationPegawai $req){

        $password = Str::random(10);

        $data = array(
            'id'             => Generate::uuid4(),
            'name'           => $req->name_account,
            'email'          => $req->email,
            'password'       => Hash::make($password),
            'remember_token' => Str::random(10),
            'roles'          => 0,
        );

        try {
            User::create($data);

            Activity::create(
                Auth::user()->name,
                "Mendaftarkan $req->name_account Akun Pegawai",
                Carbon::now('Asia/Jakarta')
            );

            Mail::to($req->email)->send(new RegisterMail([
                'name'     => $req->name_account,
                'email'    => $req->email,
                'password' => $password
            ]));

            return response()->json(['success' => "Berhasil menambahkan $req->name_account pada akun pegawai, silahkan check email yang sudah didaftarkan"]);
        } catch (\Throwable $th) {
            return response()->json(['errors' => 'Internal Server Error'], 500);
        }
    }

    public function delete($id) {

        try {

            $user = User::where([
                ['id', $id],
                ['roles', '0']
            ])->first(); 

            $user->delete();

            Activity::create(
                Auth::user()->name, 
                "Menghapus Data Stock 
                 Akun Pegawai $user->name
                ", 
                Carbon::now('Asia/Jakarta')
            );

            return response()->json(['success' => 'Berhasil Menghapus Data Penjualan']);
        } catch (\Throwable $th) {

            return response()->json(['errors' => 'Internal Server Error'], 500);
        }
    }

}
