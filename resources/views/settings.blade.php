@php
$dataAkun = Auth::user();
@endphp

@extends('layouts.master')

@section('title', 'Halaman Settings')
@section('title-header', 'Settings Account')

@section('css')
    <link rel="stylesheet" href="{{ asset('/pages/settings/styles.css') }}">
@endsection

@section('script')
    <script src="{{ asset('/pages/settings/script.js') }}"></script>
@endsection

@section('content')
<div class="container">
    @if ($pesan = Session::get('sukses'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ $pesan }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @elseif ($pesan = Session::get('gagal'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ $pesan }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @elseif ($pesan = Session::get('password_sekarang'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ $pesan }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="mx-3">
        <ul class="list-group list-group-flush">
            @if ($dataAkun)
            <li class="list-group-item hover">
                <a href="javascript:;" id="panelNama" class="no-decoration">
                    <div class="row">
                        <div class="col-3">
                            <strong>Nama Akun</strong>
                        </div>
                        <div class="col-8">
                            <span class="text_panelNama"> {{ $dataAkun->name }} </span>
                            <div id="setting-nama" style="display: none">
                                <div class="col-8 p-0">
                                    <form action=" {{ route('change-name', ['id' => Auth::id()]) }}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <div class="form-group row">
                                            <label for="namaakun"
                                                class="col-sm-4 col-form-label col-form-label-sm py-2">Nama
                                                Lengkap</label>
                                            <div class="col-sm-8 py-2">
                                                <input type="text"
                                                    class="form-control form-control-sm @error('nama_akun') is-invalid @enderror"
                                                    name="nama_akun" placeholder="Nama Lengkap Asli Anda">
                                                @error('nama_akun')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <p class="alert alert-secondary" role="alert">
                                            Notice : isikan dengan nama lengkap anda !
                                        </p>
                                        <div class="dropdown-divider"></div>
                                        <div class="row">
                                            <button type="button" id="cancelPanelNama"
                                                class="btn btn-sm btn-primary mr-1">Tutup</button>
                                            <button class="btn btn-xs btn-success ml-1" type="submit">Ubah Nama</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-1 text-right">
                            Edit
                        </div>
                    </div>
                </a>
            </li>
            <li class="list-group-item hover">
                <a href="javascript:;" id="panelPassword" class="no-decoration">
                    <div class="row">
                        <div class="col-3">
                            <strong>Ganti Password</strong>
                        </div>
                        <div class="col-8">
                            <div id="setting-password" style="display: none">
                                <div class="col-8 p-0">
                                    <form action="{{ route('change-password', ['id' => Auth::id()]) }}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label col-form-label-sm py-2">Password
                                                Sekarang</label>
                                            <div class="col-sm-8 py-2">
                                                <input type="password"
                                                    class="form-control form-control-sm @if(Session::get('password_sekarang')) is-invalid @endif"
                                                    name="password_sekarang" placeholder="Password Baru">
                                                @if($message = Session::get('password_sekarang'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label col-form-label-sm py-2">Password
                                                Baru</label>
                                            <div class="col-sm-8 py-2">
                                                <input type="password"
                                                    class="form-control form-control-sm @error('password') is-invalid @enderror"
                                                    name="password" placeholder="Password Baru">
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label col-form-label-sm py-2">Konfrimasi
                                                Password</label>
                                            <div class="col-sm-8 py-2">
                                                <input type="password"
                                                    class="form-control form-control-sm @error('password_confirmation') is-invalid @enderror"
                                                    name="password_confirmation" placeholder="Ulangi Password Baru">
                                                @error('password_confirmation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <p class="alert alert-secondary" role="alert">
                                            Notice : Selalu Jaga Kerahasiaan password anda !
                                        </p>
                                        <div class="dropdown-divider"></div>
                                        <div class="row">
                                            <button type="button" id="cancelPanelPassword"
                                                class="btn btn-sm btn-primary mr-1">Tutup</button>
                                            <button class="btn btn-xs btn-success ml-1" type="submit">Ubah Password</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-1 text-right">
                            Edit
                        </div>
                    </div>
                </a>
            </li>
            <li class="list-group-item hover">
                <a href="javascript:;" id="panelEmail" class="no-decoration">
                    <div class="row">
                        <div class="col-3">
                            <strong>Email</strong>
                        </div>
                        <div class="col-8">
                            <span class="text_panelEmail"> {{ $dataAkun->email }} </span>
                            <div id="setting-email" style="display: none">
                                <div class="col-8 p-0">
                                    <form action="{{ route('change-email', ['id' => Auth::id()]) }}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <div class="form-group row">
                                            <label for="namaakun"
                                                class="col-sm-4 col-form-label col-form-label-sm py-2">Email
                                                Baru</label>
                                            <div class="col-sm-8 py-2">
                                                <input type="email"
                                                    class="form-control form-control-sm @error('email') is-invalid @enderror"
                                                    name="email" placeholder="Nama Lengkap Asli Anda">
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <p class="alert alert-secondary" role="alert">
                                            Notice : Email tidak boleh sama !
                                        </p>
                                        <div class="dropdown-divider"></div>
                                        <div class="row">
                                            <button type="button" id="cancelPanelEmail"
                                                class="btn btn-sm btn-primary mr-1">Tutup</button>
                                            <button class="btn btn-xs btn-success ml-1" type="submit">Ubah Email</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-1 text-right">
                            Edit
                        </div>
                    </div>
                </a>
            </li>
            <li class="list-group-item hover">
                <a href="#" class="no-decoration">
                    <div class="row">
                        <div class="col-3">
                            <strong>Tanggal Pendaftaran</strong>
                        </div>
                        <div class="col-9">
                            {{ $dataAkun->created_at }}
                        </div>

                    </div>
                </a>
            </li>
            <li class="list-group-item hover">
                <a href="#" class="no-decoration">
                    <div class="row">
                        <div class="col-3">
                            <strong>Terakhir diperbarui</strong>
                        </div>
                        <div class="col-9">
                            {{ $dataAkun->updated_at }}
                        </div>
                    </div>
                </a>
            </li>
            @endif
        </ul>
    </div>
</div>
@endsection

{{-- 
    <li class="list-group-item hover">
                <a href="#" class="no-decoration">
                    <div >
                       
                    </div>
                </a>
                
            </li>
    
    
    <form action="seeting" method="get">
    <div class="form-group">
        <label for="namalengkap">Nama Akun</label>
        <input type="text" class="form-control" id="namalengkap" placeholder="Nama Akun" required>
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" placeholder="Username" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" placeholder="Password" required>
    </div>
    <div class="form-group">
        <label for="konfrimasi_password">Konfrimasi Password</label>
        <input type="password" class="form-control" id="konfrimasi_password" placeholder="Ulangi Password Anda" required>
    </div>
    <button type="submit" class="btn btn-primary">Update Akun</button>
</form> --}}