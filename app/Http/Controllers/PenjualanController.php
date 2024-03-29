<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Http\Controllers\UserActivityController as Activity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\ValidationPenjualan;
use Ramsey\Uuid\Uuid as Generate;
use Illuminate\Support\Facades\Auth;

class PenjualanController extends Controller
{
    public function index() {
        return view('penjualan');
    }

    public function data() {

        $query = Income::orderBy('created_at', 'asc');

        return DataTables::eloquent($query)
                          ->addIndexColumn()
                          ->editColumn('created_at', function ($query) {
                                return Carbon::createFromFormat('Y-m-d H:i:s', $query->created_at, 'Asia/Jakarta')
                                               ->format('Y-m-d');
                          })
                          ->editColumn('updated_at', function ($query) {
                                return Carbon::createFromFormat('Y-m-d H:i:s', $query->updated_at, 'Asia/Jakarta')
                                                ->format('Y-m-d');
                          })
                          ->addColumn('Actions', function($query) {
                              return '<a href="javascript:;" class="btn btn-xs btn-info detail" data="'.$query->id.'">Detail</a>
                              <a href="javascript:;" class="btn btn-xs btn-warning edit" data="'.$query->id.'">Edit</a>
                              <a href="javascript:;" class="btn btn-xs btn-danger delete" data="'.$query->id.'">Hapus</a>
                              ';
                          })
                          ->rawColumns(['Actions'])
                          ->toJson();
    }

    public function search(Request $req) {

        //2021-09-17 17:06:40

        $query = Income::select($req->type)
                        ->whereRaw("LOWER($req->type) LIKE ?", ["%".strtolower($req->keyword)."%"])
                        ->distinct()
                        ->get();

        return $query;
    }

    public function create(ValidationPenjualan $req) {
        
        $data = array(
            'id'          => Generate::uuid4(),
            'created_by'  => Auth::id(),
            'updated_by'  => Auth::id(),
            'name_product'=> $req->name_product,
            'category'    => $req->category,
            'nominal'     => $req->harga_satuan,
            'amount'      => $req->jumlah,
            'total'       => $req->jumlah * $req->harga_satuan
        );
        
        try {
            Income::create($data);

            Activity::create(
                Auth::user()->name, 
                "Menambahkan Data Penjualan
                 Nama  : $req->name_product  
                 Jenis : $req->category  
                 Nominal : $req->harga_satuan
                 Jumlah : $req->jumlah
                ", 
                Carbon::now('Asia/Jakarta')
            );
            return response()->json(['success' => 'Berhasil Menambahkan Data Penjualan']);
        } catch (\Throwable $th) {
            return response()->json(['erros' => 'Internal Server Error'], 500);
        }

    }

    public function show($id) {
        try {
            $query = Income::with('createdBy:id,name', 'updatedBy:id,name')
                            ->where('id', $id)->first();
            return response()->json($query, 200);
        } catch (\Throwable $th) {
            return response()->json(['erros' => 'Internal Server Error'], 500);
        }
    }

    public function update($id, ValidationPenjualan $req) {

        $data = array(
            'updated_by'  => Auth::id(),
            'name_product'=> $req->name_product,
            'category'    => $req->category,
            'nominal'     => $req->harga_satuan,
            'amount'      => $req->jumlah,
            'total'       => $req->jumlah * $req->harga_satuan
        );

        try {
            $income = Income::where('id', $id)->first();
            Income::where('id', $id)->update($data);

            Activity::create(
                Auth::user()->name,
                "Mengedit Data Penjualan '$income->name_product' => '$req->name_product'  
                 Jenis '$income->category' => '$req->category' 
                 Jumlah '$income->amount'  => '$req->jumlah'
                 Nominal '$income->nominal' => $req->harga_satuan
                ",
                Carbon::now('Asia/Jakarta')
            );
            return response()->json(['success' => 'Berhasil Update Data Penjualan']);
        } catch (\Throwable $th) {
            return response()->json(['erros' => "Internal Server Error $th"], 500);
        }
    }

    public function delete($id){
        try {
            $income = Income::where('id', $id)->first();
            $income->delete();

            Activity::create(
                Auth::user()->name, 
                "Menghapus Data Penjualan
                 Nama : $income->name_product 
                 Jenis : $income->category 
                 Jumlah : $income->amount 
                 Nominal : $income->nominal
                ", 
                Carbon::now('Asia/Jakarta')
            );

            return response()->json(['success' => 'Berhasil Menghapus Data Penjualan']);
        } catch (\Throwable $th) {
            return response()->json(['erros' => 'Internal Server Error'], 500);
        }
    }
}
