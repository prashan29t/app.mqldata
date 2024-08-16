<!-- resources/views/auth/login.blade.php -->
@extends('layouts.auth-layout')

@section('title', 'Login | MQL Data')

@section('content')
<div class="row justify-content-center align-items-center vh-100">
    <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                            </div>
                            @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                            @endif

                            <!-- Laravel Login Form -->
                            <form method="POST" action="{{ route('login') }}" class="user needs-validation" novalidate>
                                @csrf
                                <div class="form-group">
                                    <input type="email"
                                        class="form-control form-control-user @error('email') is-invalid @enderror"
                                        id="email" name="email" aria-describedby="emailHelp"
                                        placeholder="Enter Email Address..." value="{{ old('email') }}" required
                                        autofocus>
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please enter email address!</div>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password"
                                        class="form-control form-control-user @error('password') is-invalid @enderror"
                                        id="password" name="password" placeholder="Password" required>
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please enter your password</div>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <div class="custom-control custom-checkbox small d-inline">
                                                <input type="checkbox" class="custom-control-input" id="customCheck"
                                                    name="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            @if (Route::has('password.request'))
                                            <a class="small float-right" href="{{ route('password.request') }}">Forgot
                                                Password?</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-user btn-block" type="submit">Login</button>
                                <hr>
                                <a href="#" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Login with Google
                                </a>
                                <a href="#" class="btn btn-linkedin btn-user btn-block">
                                    <i class="fab fa-linkedin-in fa-fw"></i> Login with LinkedIn
                                </a>
                            </form>
                            <hr>
                            <div class="text-center">
                                <small>Don't have an Account?</small> <a class="small"
                                    href="{{ route('register') }}">Create an Account!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection