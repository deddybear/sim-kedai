<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('/plugins/jquery-ui/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/ionicons/css/ionicons.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/bootstrap/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/adminlte/adminlte.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/fontawesome/all.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/sweetalert2/sweetalert2.css') }}">
    
    @yield('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item d-none d-sm-inline-block">
                    <p class="nav-link m-0" > Selamat datang, {{ Auth::user()->name }} </p>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="/" class="brand-link">
                <span class="brand-text font-weight-light">Lorem Ipsum</span>
            </a>
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="/dashboard" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item has-tree">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-chart-line"></i>
                                <p>
                                    Data Transaksi
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/dashboard/transaksi/penjualan" class="nav-link">
                                        <i class="fas fa-cash-register nav-icon"></i>
                                        <p>Data Penjualan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/dashboard/transaksi/pembelian" class="nav-link">
                                        <i class="fas fa-cart-arrow-down nav-icon"></i>
                                        <p>Data Pembelian</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="/dashboard/stock" class="nav-link">
                                <i class="nav-icon fas fa-box-open"></i>
                                <p>Stok Bahan Baku</p>
                            </a>
                        </li>
                        @if (Auth::user()->roles == 1)
                        <li class="nav-item">
                            <a href="/dashboard/laporan" class="nav-link">
                                <i class="fas fa-clipboard-list nav-icon"></i>
                                <p>Laporan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/dashboard/activity" class="nav-link">
                                <i class="nav-icon fas fa-chalkboard-teacher"></i>
                                <p>User Activity</p>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user-cog"></i>
                                <p>
                                    Pengaturan Akun
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if (Auth::user()->roles == 1)
                                <li class="nav-item">
                                    <a href="/dashboard/pegawai" class="nav-link">
                                        <i class="fas fa-user-edit nav-icon"></i>
                                        <p>Akun Pegawai</p>
                                    </a>
                                </li>
                                @endif
                                <li class="nav-item">
                                    <a href="/dashboard/settings" class="nav-link">
                                        <i class="fas fa-user-edit nav-icon"></i>
                                        <p>Edit Akun</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('password.request') }}" class="nav-link">
                                        <i class="fas fa-wrench nav-icon"></i>
                                        <p>Reset Password</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt nav-icon"></i>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                        <p>Logout</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">@yield('title-header')</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <?php 
                                    $link = '';
                                ?>
                                @for ($i = 1; $i <= count(Request::segments()); $i++)
                                    @if ($i < count(Request::segments()) & $i > 0)
                                        <?php $link .= "/" . Request::segment($i); ?>
                                        <li class="breadcrumb-item"><a href="{{ $link }}">{{ ucwords(str_replace('-', '', Request::segment($i))) }}</a></li>
                                    @else
                                        <li class="breadcrumb-item active">{{ ucwords(str_replace('-', '', Request::segment($i))) }}</li>
                                    @endif
                                @endfor
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
        </div>
        
    </div>
</body>
<script src="{{ asset('/plugins/jquery-3.5.1.js') }}"></script>
<script src="{{ asset('/plugins/jquery-ui/jquery-ui.js') }}"></script>
<script src="{{ asset('/plugins/bootstrap/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('/plugins/adminlte/adminlte.js') }}"></script>
<script src="{{ asset('/plugins/popper.min.js') }}"></script>
<script src="{{ asset('/plugins/fontawesome/all.js') }}"></script>
<script src="{{ asset('/plugins/sweetalert2/sweetalert2.all.js') }}"></script>
<script src="{{ asset('/plugins/moment-with-locales.js') }}"></script>
@yield('script')
</html>