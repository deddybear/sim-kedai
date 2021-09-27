<?php

namespace App\Http\Controllers;
use App\Models\Expenditure;
use App\Http\Controllers\UserActivityController as Activity;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use App\Http\Requests\ValidationPembelian;
use Ramsey\Uuid\Uuid as Generate;
use Illuminate\Support\Facades\Auth;

class PembelianController extends Controller
{
    public function index(){
        return view('pembelian');
    }

    public function data() {
        $query = Expenditure::orderBy('created_at', 'asc');

        return DataTables::eloquent($query)
                         ->addIndexColumn()
                         ->editColumn('amount', function ($query) {
                            return $query->amount." ".$query->unit;
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
                             return '<a href="javascript:;" class="btn btn-xs btn-info detail" data="'.$query->id.'">Detail</a>
                             <a href="javascript:;" class="btn btn-xs btn-warning edit" data="'.$query->id.'">Edit</a>
                             <a href="javascript:;" class="btn btn-xs btn-danger delete" data="'.$query->id.'">Hapus</a>
                             ';
                         })
                         ->rawColumns(['Actions'])
                         ->toJson();
    }

    public function search(Request $req){
        
        $query = Expenditure::select($req->type)
                             ->whereRaw("LOWER($req->type) LIKE ?", ["%".strtolower($req->keyword)."%"])
                             ->distinct()
                             ->get();

        return $query;
    }

    public function create(ValidationPembelian $req) {

        $data = array(
            'id'         => Generate::uuid4(),
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
            'description'=> $req->description,
            'category'   => $req->category,
            'nominal'    => $req->harga_satuan,
            'amount'     => $req->jumlah,
            'total'      => $req->jumlah * $req->harga_satuan,
            'unit'       => $req->satuan
        );


        try {
            Expenditure::create($data);

            Activity::create(
                Auth::id(),
                "Menambahkan Data Pembelian
                 Kategori : $req->category |
                 Diskripsi : $req->description |
                 Nominal : $req->harga_satuan |
                 Jumlah : $req->jumlah $req->satuan |
                ",
                Carbon::now('Asia/Jakarta')
            );
            return response()->json(['success' => 'Berhasil Menambahkan Data Pembelian']);
        } catch (\Throwable $th) {
            return response()->json(['errors' => 'Internal Server Error'], 500);
        }
    }

    public function show($id) {
        try {
           $query = Expenditure::with('createdBy:id,name', 'updatedBy:id,name')
                                ->find($id);
                                
           return response()->json($query, 200);
        } catch (\Throwable $th) {
            return response()->json(['errors' => 'Internal Server Error ' . $th], 500);
        }
    }

    public function update($id, ValidationPembelian $req) {

        $data = array(
            'updated_by' => Auth::id(),
            'description'=> $req->description,
            'category'   => $req->category,
            'nominal'    => $req->harga_satuan,
            'amount'     => $req->jumlah,
            'total'      => $req->jumlah * $req->harga_satuan,
            'unit'       => $req->satuan
        );

        try {
            $exp = Expenditure::find($id);

            Expenditure::find($id)->update($data);
            Activity::create(
                Auth::id(),
                "Mengedit Data Pembelian | 
                 Kategori : $exp->category => $req->category |
                 Diskripsi : $exp->description => $req->description |
                 Nominal : $exp->nominal => $req->harga_satuan |
                 Jumlah : $exp->amount $exp->unit => $req->jumlah $req->satuan
                ",
                Carbon::now('Asia/Jakarta')
            );
            return response()->json(['success' => 'Berhasil Update Data Pembelian']);
        } catch (\Throwable $th) {
            return response()->json(['errors' => 'Internal Server Error'], 500);
        }
    }

    public function delete($id){
       try {
            $exp = Expenditure::find($id)->first();
            $exp->delete();

            Activity::create(
                Auth::id(), 
                "Menghapus Data Penjualan |
                 Kategori : $exp->category |
                 Diskripsi : $exp->description |
                 Nominal : $exp->nominal |
                 Jumlah : $exp->amount $exp->unit
                ", 
                Carbon::now('Asia/Jakarta')
            );
            
            return response()->json(['success' => 'Berhasil Menghapus Data Penjualan']);
       } catch (\Throwable $th) {
            return response()->json(['errors' => 'Internal Server Error'], 500);
       }
    }
}
