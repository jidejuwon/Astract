@extends('layouts.app')
@section('css')
   @production
        <link rel="stylesheet" href="{{ secure_asset("css/login.css") }}">
    @endproduction
    <link rel="stylesheet" href="{{ asset("css/login.css") }}">
@endsection

@section('content')
<div class="container " style="max-width: auto;">
    <div class="row justify-content-center " >
        <div class="col-lg-6 col-md-6 login-box">

            <div class="col-lg-12 login-title">
                <small> USER REGISTRATION FORM </small>
            </div>

            <div class="col-lg-12 login-form">
                <div class="col-lg-12 login-form">
                    <form method="POST" action="{{ route('create') }}" class="form-detail">
                        @csrf
                        <div class="form-group">
                            <label class="form-control-label">Full Name</label>
                            <input type="text" id="name" name='name' class="form-control" value="{{ old('name')}}" placeholder="John Doe" required>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Email</label>
                            <input type="email" id="email" name='email' class="form-control" value="{{ old('email') }}"placeholder="john@doe.org" required>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Phone</label>
                            <input type="number" id="phone" name='phone' class="form-control" value="{{ old('phone') }}"placeholder="08140035060" required>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Password</label>
                            <input type="password" id="password" name='password' class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Confirm Password</label>
                            <input type="password" id="password-confirm" name='password_confirmation' class="form-control" required>
                        </div>

                        <div class="col-md-12 loginbttm">
                            <div class="col-md-11 login-btm login-button">
                                <button type="submit" class="btn btn-primary btn-block">REGISTER</button>
                            </div>
                        </div>
                        <div class="col-md-12 loginbttm">
                            <div class="col-md-11 login-btm login-button">

                                <a class="btn btn-link" href="{{ route('auth') }}">
                                    {{ __("Already a user? ") }}Click here to login
                                </a>

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
