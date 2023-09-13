@extends('frontend.layouts.master')
@section('title')
    Login
@endsection
@section('links')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
@endsection
@section('content')
    <div class="container mb-5">
        <div class=" d-flex items-center justify-content-center ">
            <form class="w-50 p-5 my-5" style="border-radius:10px; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;"
                method="POST" action="{{ route('userLogin') }}">
                @csrf
                {{-- register error --}}
                @if (Session::has('msg'))
                    <div class="w-100 p-3 bg-success"
                        style="    margin-bottom: 20px;
                    border-radius: 10px;
                    color: white;">
                        {{ Session::get('msg') }}
                    </div>
                @endif
                {{-- login error --}}
                @if (Session::has('loginMsg'))
                    <div class="w-100 p-3 bg-red"
                        style="    margin-bottom: 20px;
                    border-radius: 10px;
                    color: white;">
                        {{ Session::get('loginMsg') }}
                    </div>
                @endif
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control @error('email') invalid @enderror" id="exampleInputEmail1"
                        aria-describedby="emailHelp" name="email" value="{{ old('email') }}">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    @error('email')
                        <div class="text-red">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control @error('email') invalid @enderror" id="exampleInputPassword1"
                        name="password" value="{{ old('password') }}">
                    @error('password')
                        <div class="text-red">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="d-flex items-center justify-content-center w-100">

                    <button type="submit" class="btn px-4" style="background: #ff6b6b;color:white">Sign In</button>
                </div>
                <div class="d-flex items-center justify-content-center w-100 mt-4">
                    Create new account? <a href="{{ route('registerPage') }}" class="mx-1" style="color: #ff6b6b">Sign
                        Up</a>
                </div>
            </form>
        </div>

    </div>
@endsection
