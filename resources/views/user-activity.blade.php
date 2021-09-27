@extends('layouts.master')

@section('title', 'Halaman User Activity')
@section('title-header', 'User Activity')

@section('css')
    <link rel="stylesheet" href="{{ asset('/plugins/dataTables/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/sweetalert2/sweetalert2.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.css') }}">
    <link rel="stylesheet" href="{{ asset('/pages/activity/styles.css') }}">
@endsection

@section('script')
    <script src="{{ asset('/plugins/moment-with-locales.js') }}"></script>  
    <script src="{{ asset('/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js') }}"></script>
    <script src="{{ asset('/plugins/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('/plugins/dataTables/datatables.js') }}"></script>
    <script src="{{ asset('/pages/activity/script.js') }}"></script>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover text-nowrap" id="dataTable">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Deskripsi</th>
                                <th>Nama</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <th><input type="text" class="date text-sm form-control" placeholder="Search Date"></th>
                            <th><input type="text" class="text-sm form-control" placeholder="Search Description"></th>
                            <th><input type="text" class="text-sm form-control" placeholder="Search Name"></th>
                            <th></th>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5>Hapus Periode Data Akitivitas</h5>
                <div class="mt-5">
                    <form id="form" method="POST">
                        @csrf
                        @method('delete')
                        <div class="form-row">
                            <div class="form-group col-12 col-lg-3">
                                <label for="tanggal">Tanggal</label>
                                <div class="input-group">
                                    <input name="day" type="number" min="1" max="32" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group col-12 col-lg-3">
                                <label for="bulan">Bulan</label>
                                <div class="input-group" id="bulan" data-target-input="nearest">
                                    <input name="month" type="number" class="form-control datetimepicker-input" data-target="#bulan"/>
                                    <div class="input-group-append" data-target="#bulan" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-12 col-lg-3">
                                <label for="tahun">Tahun</label>
                                <div class="input-group" id="tahun" data-target-input="nearest">
                                    <input name="year" type="number" class="form-control datetimepicker-input" data-target="#tahun"/>
                                    <div class="input-group-append" data-target="#tahun" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-12 col-lg-3">
                                <button type="submit" class="margin-button btn btn-danger">Hapus Periode Laporan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection