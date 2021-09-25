@extends('layouts.master')

@section('title', 'Halaman User Activity')
@section('title-header', 'User Activity')

@section('css')
    <link rel="stylesheet" href="{{ asset('/plugins/dataTables/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/sweetalert2/sweetalert2.css') }}">
@endsection

@section('script')
    <script src="{{ asset('/plugins/moment-with-locales.js') }}"></script>  
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
    </div>
</div>
@endsection