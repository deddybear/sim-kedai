<?php

namespace App\Http\Controllers;
use App\Http\Requests\ValidationActivity;
use App\Models\Activity;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid as Generate;
use Illuminate\Support\Facades\Auth;

class UserActivityController extends Controller
{
    
    public function index(){
        return view('user-activity');
    }

    public function data() {

        $query = Activity::orderBy('created_at', 'asc');
        return DataTables::eloquent($query)
                          ->editColumn('created_at', function ($query) {
                              return Carbon::createFromFormat('Y-m-d H:i:s', $query->created_at, 'Asia/Jakarta')
                                             ->format('Y-m-d');
                          })
                          ->addColumn('Actions', function ($query) {
                            return '<a href="javascript:;" class="btn btn-xs btn-info detail" data="'.$query->id.'"><i class="fas fa-eye"></i> Lihat Selengkapnya</a>';
                          })
                          ->rawColumns(['Actions'])                          
                          ->toJson();
    }

    public static function create($user_id, $activity, $created_at) {

        $data = array(
            'id'         => Generate::uuid4(),
            'user_id'    => $user_id,
            'activity'   => $activity,
            'created_at' => $created_at
        );

        try {
            Activity::create($data);
        } catch (\Throwable $th) {
            return response()->json(['errors' => 'Internal Server Error'. $th], 500);
        }
    }

    public function show($id){

        Activity::with('user:id,name')->find($id);

        try {
            $query = Activity::with('user:id,name')->find($id);

            return response()->json($query, 200);
        } catch (\Throwable $th) {
            return response()->json(['errors' => 'Internal Server Error '], 500);
        }
    }

    public function delete(ValidationActivity $req) {

        try {

            if (Activity::whereDate('created_at', "$req->year-$req->month-$req->day")->delete()) {
                $this->create(Auth::user()->name, "Menghapus Data Periode $req->day-$req->month-$req->year", Carbon::now('Asia/Jakarta'));
                return response()->json(['success' => 'Berhasil Menghapuskan Data Periode']);
            }

            return response()->json(['info' => 'Periode yang dipilih tidak terdapat didatabase']);            
        } catch (\Throwable $th) {
            return response()->json(['errors' => 'Internal Server Error ' . $th], 500);
        }

    }
}
