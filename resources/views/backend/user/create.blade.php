@extends('backend.layouts.master')
@section('content')
<div class="container mb-5">
    @if ($errors->any())
        {!! implode('', $errors->all('<span class="text text-danger">:message</span>')) !!}
    @endif
    <div class=" d-flex items-center justify-content-center ">
        <form class="w-50 p-5 my-5" style="border-radius:10px; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;"
            action="{{ route('userRegistrationAdmin') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 col-md-12">
                <img class="imagePreview" id="output00" alt=""
                    style="height:120px;object-fit:fill;width:130px;display:none">
                <label class="form-label">Image</label>
                <input type="file" name="image" onchange="loadFile9(event)" class="form-control"
                    placeholder="Images" required>
                @error('image')
                    <div class="text-red">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Select Role</label>
                <select name="type" id="" class="form-control" required>
                    <option value="admin">Admin</option>
                    <option value="sub_admin">Sub Admin</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Full Name</label>
                <input type="text" class="form-control @error('name') invalid @enderror" name="name"
                    value="{{ old('name') }}" required>
                @error('name')
                    <div class="text-red">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control @error('email') invalid @enderror" id="exampleInputEmail1"
                    aria-describedby="emailHelp"name="email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="text-red">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Phone Number</label>
                <input type="number" class="form-control @error('phone_number') invalid @enderror" name="phone_number"
                    value="{{ old('phone_number') }}" required>
                @error('phone_number')
                    <div class="text-red">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Address </label>
                <input type="text" class="form-control @error('address') invalid @enderror" name="address"
                    value="{{ old('address') }}" required>
                @error('address')
                    <div class="text-red">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') invalid @enderror"
                    id="exampleInputPassword1" name="password" value="{{ old('password') }}" required>
                @error('password')
                    <div class="text-red">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                <input type="password" class="form-control @error('confirm_password') invalid @enderror"
                    id="exampleInputPassword1" name="confirm_password" value="{{ old('confirm_password') }}" required>
                @error('confirm_password')
                    <div class="text-red">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="d-flex items-center justify-content-center w-100">

                <button type="submit" class="btn px-4" style="background: #ff6b6b;color:white">Add User</button>
            </div>

        </form>
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
