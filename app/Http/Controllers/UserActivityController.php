<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class UserActivityController extends Controller
{
    
    public function index(){
        return view('user-activity');
    }

    public function data() {
        $query = Activity::with('user:id,name')->orderBy('created_at', 'asc');

        return DataTables::eloquent($query)
                          ->editColumn('created_at', function ($query) {
                              return Carbon::createFromFormat('Y-m-d H:i:s', $query->created_at, 'Asia/Jakarta')
                                             ->format('Y-m-d');
                          })
                          ->editColumn('user_id', function ($query) {
                              return $query->user[0]->name;
                          })
                          ->addColumn('Actions', function ($query) {
                            return '<a href="javascript:;" class="btn btn-xs btn-info detail" data="'.$query->id.'"><i class="fas fa-eye"></i> Lihat Selengkapnya</a>';
                          })
                          ->rawColumns(['Actions'])                          
                          ->toJson();
    }

    public static function create($id, $activity, $created_at) {

        $data = array(
            'id'         => $id,
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
}
