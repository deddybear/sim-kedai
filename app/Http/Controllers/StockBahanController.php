<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;
use App\Http\Requests\ValidationStock;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid as Generate;
use Illuminate\Support\Facades\Auth;


class StockBahanController extends Controller
{
    public function index() {
        return view('stock');
    }

    public function data() {
        $query = Stock::orderBy('created_at', 'asc');

        return DataTables::eloquent($query)
                          ->addIndexColumn()
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

        $query = Stock::select($req->type)
                        ->whereRaw("LOWER($req->type) LIKE ?", ["%".strtolower($req->keyword)."%"])
                        ->distinct()
                        ->get();

        return $query;         
    }

    public function create(ValidationStock $req) {
        # code...
    }

    public function show($id) {
        try {
            $query = Stock::with('createdBy:id,name', 'updatedBy:id,name')
                                 ->find($id);
                                 
            return response()->json($query, 200);
         } catch (\Throwable $th) {
             return response()->json(['erros' => 'Internal Server Error ' . $th], 500);
         }
    }

    public function update($id, ValidationStock $req){
        # code...
    }

    public function delete($id){
        try {
            Stock::where('id', $id)->delete();
            return response()->json(['success' => 'Berhasil Menghapus Data Penjualan']);
       } catch (\Throwable $th) {
            return response()->json(['erros' => 'Internal Server Error'], 500);
       }
    }
}
