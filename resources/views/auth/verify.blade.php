@extends('layouts.app')
@section('css')
    <style>
        body {
            background-color: #EEEEEE;
        }
    </style>
@endsection
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>

                    <div class="col-12 col-lg-2 mx-auto">
                        <a href="{{ route('logout') }}" class="btn btn-success" 
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                                <font>Logout</font>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
