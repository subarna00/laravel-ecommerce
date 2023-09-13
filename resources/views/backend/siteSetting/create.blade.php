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
                                <img class="imagePreview" id="output01" alt=""
                                    src="{{ asset('images/' . $siteSetting->favicon) }}"
                                    style="height:120px;object-fit:fill;width:130px;">
                                <label class="form-label">Fav Icon</label>
                                <input type="file" name="logo" onchange="loadFile10(event)" class="form-control"
                                    placeholder="logo">
                                @error('logo')
                                    <div class="text-red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <img class="imagePreview" id="output02" alt=""
                                    src="{{ asset('images/' . $siteSetting->qr) }}"
                                    style="height:120px;object-fit:fill;width:130px;">
                                <label class="form-label">QR Code</label>
                                <input type="file" name="qr" onchange="loadFile11(event)" class="form-control"
                                    placeholder="qr">
                                @error('qr')
                                    <div class="text-red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <img class="imagePreview" id="output03" alt=""
                                    src="{{ asset('images/' . $siteSetting->digital_s) }}"
                                    style="height:120px;object-fit:fill;width:130px;">
                                <label class="form-label">Digital Signature</label>
                                <input type="file" name="digital_s" onchange="loadFile12(event)" class="form-control"
                                    placeholder="digital_s">
                                @error('digital_s')
                                    <div class="text-red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Bill Text</label>
                                <input type="text" name="bill_text" class="form-control"
                                    value="{{ old('bill_text') ?? $siteSetting->bill_text }}" placeholder="Text below bill" >
                                @error('bill_text')
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
        var loadFile10 = function(event) {
            let image78 = document.getElementById('output01');
            image78.src = URL.createObjectURL(event.target.files[0]);
            image78.style.display = "block"
        };
        var loadFile11 = function(event) {
            let image9 = document.getElementById('output02');
            image9.src = URL.createObjectURL(event.target.files[0]);
            image9.style.display = "block"
        };
        var loadFile12 = function(event) {
            let image89 = document.getElementById('output03');
            image89.src = URL.createObjectURL(event.target.files[0]);
            image89.style.display = "block"
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
