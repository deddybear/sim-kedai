@extends('layouts.master')

@section('title', 'Halaman Pembelian')
@section('title-header', 'Transaksi Pembelian')

@section('css')
    
@endsection

@section('script')
    
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="pull-right my-3" style="float: right">
                    <a id="tambahdata" href="#" class="btn btn-sm btn-success" data-toggle="modal"
                        data-target="#modal_form">
                        <span class="fa fa-plus"></span> Tambahkan Data 
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover text-nowrap" id="dataTable">
                        <thead>
                            <tr>
                                <th>No. </th>
                                <th>Kolom 1</th>
                                <th>Kolom 2</th>
                                <th>Kolom 3</th>
                                <th>Kolom 4</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>1</th>
                                <th>isi</th>
                                <th>isi</th>
                                <th>isi</th>
                                <th>isi</th>
                                <th>
                                    <a href="javascript:;" class="btn btn-xs btn-warning show_data">Edit</a>
                                    <a href="javascript:;" class="btn btn-xs btn-danger show_data">Hapus</a>
                                </th>
                            </tr>
                        </tbody>
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
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="pesan_sistem my-2">
                <span id="result"></span>
            </div>
            <div class="modal-body">
                <span id="result"></span>
                <form class="form-horizontal" method="post" id="form">
                    <div class="form-body p-3">
                        <div class="pesan_sistem my-2">
                            <span id="result"></span>
                        </div>
                        {{-- form-judul --}}
                        <div class="form-group">
                            <label class="control-label col-md-5"></label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="nama" id="nama"
                                    placeholder="" required>
                            </div>
                        </div>
            
                        <div class="form-group">
                            <label class="control-label col-md-5"></label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="kelas" id="kelas"
                                    placeholder="" required>
                            </div>
                        </div>
                        {{-- NIS --}}
                        <div class="form-group">
                            <label class="control-label col-md-5"></label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="nis" id="nis"
                                    placeholder="" required>
                            </div>
                        </div>
    
                        {{-- NISN --}}
                        <div class="form-group">
                            <label class="control-label col-md-5"></label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="nisn" id="nisn"
                                    placeholder="" required>
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