<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;
use App\Http\Requests\ValidationStock;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\UserActivityController as Activity;
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

        $query = Stock::select($req->type)
                        ->whereRaw("LOWER($req->type) LIKE ?", ["%".strtolower($req->keyword)."%"])
                        ->distinct()
                        ->get();

        return $query;         
    }

    public function create(ValidationStock $req) {
        
        $data = array(
            'id'           => Generate::uuid4(),
            'created_by'   => Auth::id(),
            'updated_by'   => Auth::id(),
            'name_product' => $req->name_product,
            'category'     => $req->category,
            'amount'       => $req->jumlah,
            'unit'         => $req->satuan,
        );

        try {
            Stock::create($data);
            
            Activity::create(
                Auth::id(), 
                "Menambahkan Data Stock, 
                 Nama : $req->name_product  
                 Jenis :  $req->category  
                 Amount : $req->jumlah'
                ", 
                Carbon::now('Asia/Jakarta')
            );

            return response()->json(['success' => 'berhasil menambahkan data stock']);
        } catch (\Throwable $th) {
            return response()->json(['errors' => 'Internal Server Error'], 500);
        }
    }

    public function show($id) {
        try {
            $query = Stock::with('createdBy:id,name', 'updatedBy:id,name')
                                 ->find($id);
                                 
            return response()->json($query, 200);
         } catch (\Throwable $th) {
             return response()->json(['errors' => 'Internal Server Error ' . $th], 500);
         }
    }

    public function update($id, ValidationStock $req) {

        $data = array(
            'name_product' => $req->name_product,
            'category'     => $req->category,
            'amount'       => $req->jumlah,
            'unit'         => $req->satuan,
            'updated_by'   => Auth::id()
        );

        try {
            $query = Stock::find($id);
            $query->update($data);
            
            Activity::create(
                Auth::id(), 
                "Mengedit Data Stock '$query->name_product' => '$req->name_product', 
                 Jenis '$query->category' => '$req->category',
                 Jumlah '$query->amount'  => '$req->jumlah',
                 Satuan '$query->unit'    => '$req->satuan'
                ", 
                Carbon::now('Asia/Jakarta')
            );
            
            return response()->json(['success' => 'Berhasil Update Data Stock']);

        } catch (\Throwable $th) {
            return response()->json(['errors' => 'Internal Server Errors'], 500);
        }
    }

    public function delete($id) {

        try {
            $query = Stock::find($id)->first();
            $query->delete();

            Activity::create(
                Auth::id(), 
                "Menghapus Data Stock 
                 Nama : $query->name_product, 
                 Jenis : $query->category, 
                 Jumlah : $query->amount, 
                 Satuan : $query->unit
                ", 
                Carbon::now('Asia/Jakarta')
            );
            
            return response()->json(['success' => 'Berhasil Menghapus Data Penjualan']);
       } catch (\Throwable $th) {
            return response()->json(['errors' => 'Internal Server Error'], 500);
       }

    }
}
