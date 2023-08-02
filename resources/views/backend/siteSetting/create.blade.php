@extends('backend.layouts.master')
@section('content')
    <style>
        .gmap_canvas {
            width: 100%;
        }

        .gmap_canvas iframe {
            width: 100%;
            height: 500px;
        }
    </style>
    <div class="col-xl-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Site Data</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <form action="{{ route('site-setting.update', $siteSetting->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PATCH') }}
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <img class="imagePreview" id="output00" alt=""
                                    src="{{ asset('images/' . $siteSetting->logo) }}"
                                    style="height:120px;object-fit:fill;width:130px;">
                                <label class="form-label">Logo</label>
                                <input type="file" name="logo" onchange="loadFile9(event)" class="form-control"
                                    placeholder="logo">
                                @error('logo')
                                    <div class="text-red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <img class="imagePreview" id="output00" alt=""
                                    src="{{ asset('images/' . $siteSetting->favicon) }}"
                                    style="height:120px;object-fit:fill;width:130px;">
                                <label class="form-label">Fav Icon</label>
                                <input type="file" name="logo" onchange="loadFile9(event)" class="form-control"
                                    placeholder="logo">
                                @error('logo')
                                    <div class="text-red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Site Name</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name') ?? $siteSetting->name }}" placeholder="name" required>
                                @error('name')
                                    <div class="text-red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Email</label>
                                <input type="text" name="email" class="form-control"
                                    value="{{ old('email') ?? $siteSetting->email }}" placeholder="email">
                                @error('email')
                                    <div class="text-red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Address</label>
                                <input type="text" name="address" value="{{ old('address') ?? $siteSetting->address }}"
                                    class="form-control" required>
                                @error('address')
                                    <div class="text-red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Contact Number</label>
                                <input type="text" name="number" class="form-control"
                                    value="{{ old('number') ?? $siteSetting->number }}" required>
                                @error('number')
                                    <div class="text-red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Facebook</label>
                                <input type="url" name="facebook" class="form-control"
                                    value="{{ old('facebook') ?? $siteSetting->facebook }}">
                                @error('facebook')
                                    <div class="text-red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Instagram</label>
                                <input type="url" name="instagram" class="form-control"
                                    value="{{ old('instagram') ?? $siteSetting->instagram }}">
                                @error('instagram')
                                    <div class="text-red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Youtube</label>
                                <input type="url" name="youtube" class="form-control"
                                    value="{{ old('youtube') ?? $siteSetting->youtube }}">
                                @error('youtube')
                                    <div class="text-red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Tiktok</label>
                                <input type="url" name="tiktok" class="form-control"
                                    value="{{ $siteSetting->tiktok }}">
                                @error('tiktok')
                                    <div class="text-red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Map</label>
                                <textarea name="map" id="" cols="30" rows="10" class="form-control"
                                    placeholder="Add your map iframe from google">{!! $siteSetting->map !!}</textarea>
                                @error('map')
                                    <div class="text-red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                {!! $siteSetting->map !!}

                            </div>
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        var loadFile9 = function(event) {
            let image77 = document.getElementById('output00');
            image77.src = URL.createObjectURL(event.target.files[0]);
            image77.style.display = "block"
        };
    </script>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
@endsection
