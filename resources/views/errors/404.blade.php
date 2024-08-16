{{-- resources/views/errors/404.blade.php --}}
@extends('layouts.errors')

@section('title', 'Page Not Found')

@section('content')
<div class="container text-center mt-5">
    <div class="section-inner">
        <img src="https://html.themewant.com/hostie/assets/images/error.png" alt="">
        <div class="wrapper-para mt--45">
            <h3 class="title">Page Not Found</h3>
            <p class="disc">
                We're sorry, the page you requested could not be found <br> please go back to the homepage
            </p>
            <a href="{{ url('/') }}" class="btn btn-primary">Back to Home</a>
        </div>
    </div>

</div>
@endsection