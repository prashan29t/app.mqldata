<!-- resources/views/auth/register.blade.php -->
@extends('layouts.auth-layout')

@section('title', 'Register | MQL Data')

@section('content')
<div class="row justify-content-center align-items-center vh-100">
    <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>

                            <!-- Laravel Registration Form -->
                            <form method="POST" action="{{ route('register') }}" class="user xneeds-validation"
                                novalidate>
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text"
                                            class="form-control form-control-user @error('first_name') is-invalid @enderror"
                                            id="firstName" name="first_name" placeholder="First Name"
                                            value="{{ old('first_name') }}" required autofocus>
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please enter First Name!</div>
                                        @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text"
                                            class="form-control form-control-user @error('last_name') is-invalid @enderror"
                                            id="lastName" name="last_name" placeholder="Last Name"
                                            value="{{ old('last_name') }}" required>
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please enter Last Name!</div>
                                        @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email"
                                        class="form-control form-control-user @error('email') is-invalid @enderror"
                                        id="inputEmail" name="email" placeholder="Email Address"
                                        value="{{ old('email') }}" required>
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please enter email address!</div>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password"
                                            class="form-control form-control-user @error('password') is-invalid @enderror"
                                            id="inputPassword" name="password" placeholder="Password" required>
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please enter your password</div>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="repeatPassword" name="password_confirmation"
                                            placeholder="Repeat Password" required>
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please enter your password</div>
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-user btn-block" type="submit">Register
                                    Account</button>
                                <hr />
                                <a href="#" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Register with Google
                                </a>
                                <a href="#" class="btn btn-linkedin btn-user btn-block">
                                    <i class="fab fa-linkedin-in fa-fw"></i> Register with LinkedIn
                                </a>
                            </form>
                            <hr />
                            <div class="text-center">
                                <a class="small" href="{{ route('login') }}">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection