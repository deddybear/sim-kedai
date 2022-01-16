@extends('layouts.master')

@section('title', 'Halaman Stok Barang')
@section('title-header', 'Stok Barang')

@section('css')
    <link rel="stylesheet" href="{{ asset('/plugins/dataTables/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/sweetalert2/sweetalert2.css') }}">
@endsection

@section('script')
    <script src="{{ asset('/plugins/moment-with-locales.js') }}"></script>  
    <script src="{{ asset('/plugins/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('/plugins/dataTables/datatables.js') }}"></script>
    <script src="{{ asset('/pages/stock/script.js') }}"></script>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="pull-right my-3" style="float: right">
                    <a id="add" href="#" class="btn btn-sm btn-success" data-toggle="modal"
                        data-target="#modal_form">
                        <span class="fa fa-plus"></span> Tambahkan Data 
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover text-nowrap" id="dataTable">
                        <thead>
                            <tr>
                                <th>No. </th>
                                <th>Jenis</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Satuan</th>
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
                            <th></th>
                            <th></th>
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
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" id="form">
                    <div class="form-body p-3">

                        {{-- Nama Produk --}}
                        <div class="form-group">
                            <label class="control-label col-md-5">Nama Produk</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="name_product" id="name_product"
                                    placeholder="Nama Produk" required>
                            </div>
                        </div>

                        {{-- Jenis Barang --}}
                        <div class="form-group">
                            <label class="control-label col-md-5">Jenis Barang</label>
                            <div class="col-md-12">
                                <select class="form-control" name="category" required>
                                    <option value="" selected>Silahkan Dipilih</option>
                                    <option value="Bahan Baku">Bahan Baku</option>
                                    <option value="Tools/Peralatan">Tools/Peralatan</option>
                                    <option value="Lain-Lain">Lain - Lain</option>
                                </select>
                            </div>
                        </div>

                        {{-- Jumlah --}}
                        <div class="form-group">
                            <label class="control-label col-md-5">Jumlah</label>
                            <div class="col-md-12">
                                <input type="number" class="form-control" name="jumlah" id="jumlah" min="1" max="1000"
                                    placeholder="Jumlah" required>
                            </div>
                        </div>

                        {{-- Satuan --}}
                        <div class="form-group">
                            <label class="control-label col-md-5">Satuan</label>
                            <div class="col-md-12">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Satuan</span>
                                    <select name="satuan" id="satuan" class="form-control">
                                        <option value="Kg">Kg</option>
                                        <option value="Pcs">Pcs</option>
                                        <option value="Liter">Liter</option>
                                        <option value="Lain-Lain">Lain - Lain</option>
                                    </select>
                                </div>
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