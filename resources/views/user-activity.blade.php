@extends('layouts.master')

@section('title', 'Halaman User Activity')
@section('title-header', 'User Activity')

@section('css')
    
@endsection

@section('script')
    
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
                            <tr>
                                <th>1</th>
                                <th>isi</th>
                                <th>isi</th>
                                <th>
                                    <a href="javascript:;" class="btn btn-xs btn-success show_data"><i class="fas fa-eye"></i> Lihat Selengkapnya</a>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection