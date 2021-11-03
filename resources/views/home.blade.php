@extends('layouts.master')

@section('title', 'Halaman Utama Dashboard')
@section('title-header', 'Dashboard')

@section('script')
    <script src="{{ asset('/plugins/chartjs/chart.js') }}"></script>
    <script src="{{ asset('/pages/home/script.js') }}"></script>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <p style="font-size: 1.5em"><b id="inc_today"></b></p>   
                <p>Pemasukan Hari ini</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{ route('page-penjualan') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4 col-6">
        <div class="small-box bg-primary">
            <div class="inner">
                <p style="font-size: 1.5em"><b id="inc_month"></b></p>   
                <p>Pemasukan Bulan ini</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{ route('page-penjualan') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4 col-6">
        <div class="small-box bg-orange">
            <div class="inner">
                <p style="font-size: 1.5em"><b id="inc_year"></b></p>   
                <p>Pemasukan Tahun ini</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{ route('page-penjualan') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <p style="font-size: 1.5em"><b id="spe_today"></b></p>   
                <p>Pengeluaran Hari ini</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{ route('page-pembelian') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <p style="font-size: 1.5em"><b id="spe_month"></b></p>   
                <p>Pengeluaran Bulan ini</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{ route('page-pembelian') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <p style="font-size: 1.5em"><b id="spe_year"></b></p>   
                <p>Pengeluaran Tahun ini</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{ route('page-pembelian') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-9 col-12">
        <div class="card">
            <div class="card-header">Grafik Data</div>
            <div class="card-body">
                <canvas id="grafik"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection
