<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Expenditure;
use App\Http\Requests\ValidationLaporan;
use Barryvdh\DomPDF\Facade as PDF;

class LaporanController extends Controller
{
    
    public function index() {
        return view('laporan');
    }

    public function downloadReport(ValidationLaporan $req){
        
        $income = Income::select('name_product', 'nominal', 'amount', 'total', 'created_at')
                          ->whereMonth('created_at', $req->month)
                          ->whereYear('created_at', $req->year)
                          ->orderBy('created_at', 'asc')
                          ->get();
        
        $exp = Expenditure::select('description', 'nominal', 'unit', 'amount', 'total', 'created_at')
                            ->whereMonth('created_at', $req->month)
                            ->whereYear('created_at', $req->year)
                            ->orderBy('created_at', 'asc')
                            ->get();

        $totalIncome = collect($income)->sum('total');
        $totalExp    = collect($exp)->sum('total');
        
        $data = array(
            'incomes'       => $income,
            'exps'          => $exp,
            'total_income'  => $totalIncome,
            'total_exp'     => $totalExp
        );

        //return view('pdf.laporan', $data);

        //$pdf = New PDF();
        $pdf = PDF::loadView('pdf.laporan', $data)->setPaper('A4', 'potrait');
        return $pdf->stream();

        // dump("Pengeluaran : " . $totalExp);
        // dump("Pemasukan : " . $totalIncome);

        // dump($expenditure);
        // dd($income);

    }
}
