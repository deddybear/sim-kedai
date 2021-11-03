@extends('layouts.master')

@section('title', 'Halaman Akun Pegawai')
@section('title-header', 'Akun Pegawai')

@section('css')
    <link rel="stylesheet" href="{{ asset('/plugins/dataTables/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/sweetalert2/sweetalert2.css') }}">
    <link rel="stylesheet" href="{{ asset('/pages/akun-pegawai/styles.css') }}">
@endsection

@section('script')
    <script src="{{ asset('/plugins/moment-with-locales.js') }}"></script>  
    <script src="{{ asset('/plugins/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('/plugins/dataTables/datatables.js') }}"></script>
    <script src="{{ asset('/pages/akun-pegawai/script.js') }}"></script>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="pull-right my-3" style="float: right">
                    <a id="add" href="#" class="btn btn-sm btn-success" data-toggle="modal"
                        data-target="#modal_form">
                        <span class="fa fa-plus"></span> Tambahkan User Pegawai
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover text-nowrap" id="dataTable">
                        <thead>
                            <tr>
                                <th>No. </th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Tanggal Verifikasi</th>
                                <th>Tanggal Dibuat</th>
                                <th>Tanggal Diupdate</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <th></th>
                            <th class="search"></th>
                            <th class="search"></th>
                            <th><input type="text" class="date text-sm form-control" placeholder="Search Date"></th>
                            <th><input type="text" class="date text-sm form-control" placeholder="Search Date"></th>
                            <th><input type="text" class="date text-sm form-control" placeholder="Search Date"></th>
                            <th></th>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modal_form" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document" style="max-width: 500px !important">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Menambah Akun Pegawai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="form">
                    <div class="form-body p-3">

                        {{-- Nama Akun--}}
                        <div class="form-group">
                            <label class="control-label col-md-5">Nama Pegawai</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="name_account" id="name_account"
                                    placeholder="Nama Akun" required>
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="form-group">
                            <label class="control-label col-md-5">Email</label>
                            <div class="col-md-12">
                                <input type="email" class="form-control" name="email" id="email" 
                                    placeholder="Alamat E-mail Aktif" required>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="ok">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection