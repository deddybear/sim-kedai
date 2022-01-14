<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Income;
use App\Models\Expenditure;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

//dashboard

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {

        $data = array();
        return view('home');
    }

    public function income($type, $value) { // data pemasukan 
    
        $income = DB::table('tbl_income');
        $income->select('total');

        if ($type == 'date') {
            $income->whereDate('created_at', $value);
        } else if ($type == 'month') {
            $income->whereMonth('created_at', $value);
        } else if ($type == 'year') {
            $income->whereYear('created_at', $value);
        } else {
            return response()->json(['erros' => 'Internal Server Error'], 500);
        }
        
        $data = number_format($income->sum('total'), 0, ',', '.');

        return response()->json(['value' => "Rp. $data,-"]);
    }

    public function spending($type, $value) { // data pengeluaran

        $spending = DB::table('tbl_expenditure');
        $spending->select('total');

        if ($type == 'date') {
            $spending->whereDate('created_at', $value);
        } else if ($type == 'month') {
            $spending->whereMonth('created_at', $value);
        } else if ($type == 'year') {
            $spending->whereYear('created_at', $value);
        } else {
            return response()->json(['erros' => 'Internal Server Error'], 500);
        }
        
        $data = number_format($spending->sum('total'), 0, ',', '.');

        return response()->json(['value' => "Rp. $data,-"]);
    }

    public function history($year) { //data untuk chart

        $data = [];

        $incomes = Income::select(
                              DB::raw("(DATE_FORMAT(created_at, '%m')) as month"),
                              DB::raw("(sum(total)) as total")
                          )
                          ->whereYear('created_at', $year)
                          ->orderBy('month')
                          ->groupBy(
                              DB::raw("DATE_FORMAT(created_at, '%m')")
                          )
                          ->get();

        $spendings = Expenditure::select(
                                    DB::raw("(DATE_FORMAT(created_at, '%m')) as month"),
                                    DB::raw("(sum(total)) as total")
                                )
                                ->whereYear('created_at', $year)
                                ->orderBy('month')
                                ->groupBy(
                                    DB::raw("DATE_FORMAT(created_at, '%m')")
                                )
                                ->get();
        
        

        array_push($data, $this->push($incomes));
        array_push($data, $this->push($spendings));
        return response()->json($data);
    }

    public function push($data) {
        $array = array();
        
        foreach ($data as $key => $value) {
            $array[Carbon::create()->month($value->month)->format('F')] = $value->total;
        }

        return $array;
    }
}
