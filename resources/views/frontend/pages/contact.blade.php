@extends('frontend.layouts.master')
@section('links')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
@endsection
@section('content')
    <div class="contact-section my-5 py-5 reveal">
        <div class="container">
            <div class="row ">
                <div class="col-md-6">
                    <div class="contact-left " style="height: 100%">

                        <style>
                            .gmap_canvas {
                                width: 100%;
                            }

                            .gmap_canvas iframe {
                                width: 100%;
                                height: 550px;

                            }
                        </style>
                        <div class="gmap_canvas ">
                            {!! $siteSetting->map !!}

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    {{--
                    <div class="address-card w-100">
                        <div>
                            <p class="address-card-description my-1">Address : Sifal,Kathmandu
                            </p>
                            <p class="address-card-description mb-1">Phone : 9851122036
                            </p>
                            <p class="address-card-description mb-1">Email : swasthagharofficial@gmail.com
                            </p>
                        </div>
                    </div> --}}
                    <div class="form"
                        style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;border-radius:8px;padding:24px">
                        @if (Session::has('msg'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ Session::get('msg') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('storeContact') }}" method="POST">

                            @csrf
                            <div class="mb-4">
                                <label for="">Full Name</label>
                                <input type="text" name="name" placeholder="Enter your name" class="form-control"
                                    value="{{ old('name') }}" required>
                                @if ($errors->has('name'))
                                    <div class="error">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                            <div class="mb-4">
                                <label for="">Email</label>

                                <input type="email" name="email" placeholder="Enter your email" class="form-control"
                                    value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <div class="error">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                            <div class="mb-4">
                                <label for="">Contact Number</label>

                                <input type="number" name="number" placeholder="Enter your number" class="form-control"
                                    value="{{ old('number') }}" required>
                                @if ($errors->has('number'))
                                    <div class="error">{{ $errors->first('number') }}</div>
                                @endif
                            </div>
                            <div class="">
                                <label for="">Message</label>

                                <textarea name="message" id="" cols="30" rows="5" class="form-control" value="{{ old('message') }}"
                                    required> {{ old('message') }}</textarea>
                                @if ($errors->has('message'))
                                    <div class="error">{{ $errors->first('message') }}</div>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-secondary mt-3">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
