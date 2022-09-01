@extends('layouts.app')
@section('css')
    @if ( env('APP_ENV') != 'local')
        <link rel="stylesheet" href="{{ secure_asset("css/login.css") }}">
    @else
        <link rel="stylesheet" href="{{ asset("css/login.css") }}">
    @endif
@endsection

@section('content')
    <div class="container" style="max-width: auto;">
        <div class="row justify-content-center " >
            <div class="col-lg-6 col-md-6 login-box">
                <div class="col-lg-12 login-title"> ADMIN PANEL </div>

                <div class="col-lg-12 login-form">
                    <div class="col-lg-12 login-form">
                        <form method="POST" action="{{ route('admin.login') }}">
                            @csrf
                            <div class="form-group">
                                <label class="form-control-label ">EMAIL</label>
                                <input type="email" name="email" id="email"  class="form-control" value="{{ old('email')}}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">PASSWORD</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <div class="col-md-11 login-btm login-button">
                                    <button type="submit" class="btn btn-primary btn-block">LOGIN</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col-md-2"></div>
            </div>
        </div>
    </div>
@endsection
