@extends('layouts.master')

@section('title', 'Halaman Laporan')
@section('title-header', 'Laporan per Bulan')

@section('css')
    <link rel="stylesheet" href="{{ asset('/plugins/dataTables/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.css') }}">
    <link rel="stylesheet" href="{{ asset('/pages/laporan/style.css') }}">
@endsection

@section('script')
    <script src="{{ asset('/plugins/dataTables/datatables.js') }}"></script>
    <script src="{{ asset('/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js') }}"></script>
    <script src="{{ asset('/pages/laporan/script.js') }}"></script>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <p>Laporan ini otomatis generate sesuai dengan transaksi yang telah dilakukan pada halaman data transaksi.</p>
                
                @if (count($errors) > 0)
                    <div class="my-3">
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div> 
                @endif
                
                <div class="mt-5">
                    <form action="{{ route('download-report') }}" method="POST" target="_blank">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-12 col-lg-4">
                                <label for="bulan">Bulan</label>
                                <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                                    <input name="month" type="number" min="1" max="12" class="form-control datetimepicker-input" data-target="#datetimepicker1"/>
                                    <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-12 col-lg-4">
                                <label for="tahun">Tahun</label>
                                <div class="input-group date" id="datetimepicker" data-target-input="nearest">
                                    <input name="year" type="number" min="1" class="form-control datetimepicker-input" data-target="#datetimepicker"/>
                                    <div class="input-group-append" data-target="#datetimepicker" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-12 col-lg-4">
                                <button type="submit" class="margin-button btn btn-success"><i class="fas fa-download"></i> Download Laporan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection