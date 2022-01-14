<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('/plugins/adminlte/adminlte.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/fontawesome/all.css') }}">
    @yield('css')
</head>
<body >
    <div id="app">
        @yield('content')
    </div>
</body>
<script src="{{ asset('/plugins/jquery-3.5.1.js') }}"></script>
<script src="{{ asset('/plugins/adminlte/adminlte.js') }}"></script>
<script src="{{ asset('/plugins/fontawesome/all.js') }}"></script>
</html>
