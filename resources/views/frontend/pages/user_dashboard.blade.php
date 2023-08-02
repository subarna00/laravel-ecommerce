@extends('frontend.layouts.master')
@section('links')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
@endsection
@section('content')
    {{-- for active tab --}}
    @if (session()->has('order'))
        <div class="container">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('order') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif
    <?php
    $activeTab = 'home';
    if (session()->get('tab')) {
        $activeTab = session()->get('tab');
    }
    ?>

    <div class="container mb-5" style="min-height: 50vh">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link @if ($activeTab == 'home') active @endif" id="home-tab" data-bs-toggle="tab"
                    data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane"
                    aria-selected="true">Orders</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link @if ($activeTab == 'profile') active @endif" id="profile-tab"
                    data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab"
                    aria-controls="profile-tab-pane" aria-selected="false">Profile</button>
            </li>

        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade   @if ($activeTab == 'home') show active @endif" id="home-tab-pane"
                role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                <div class="bg-white p-3 mt-2"
                    style="border-radius:10px; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Product</th>
                                <th scope="col">Billing Name</th>
                                <th scope="col">Billing Number</th>
                                <th scope="col">Status</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($orders) > 0)
                                @foreach ($orders as $order)
                                    <tr>
                                        <th scope="row">{{ $order->id }}</th>
                                        <td>{{ $order->product->name }}</td>
                                        <td>{{ $order->bname }}</td>
                                        <td>{{ $order->bnumber }}</td>
                                        <td>
                                            @if ($order->status == 'Canceled')
                                                <span style="color: red">{{ $order->status }}</span>
                                            @elseif($order->status == 'Delivered')
                                                <span style="color: green">{{ $order->status }}</span>
                                            @else
                                                {{ $order->status }}
                                            @endif
                                        </td>
                                        <td><button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $order->id }}">
                                                View Detail
                                            </button>


                                        </td>
                                    </tr>
                                    <div class="modal fade" id="exampleModal{{ $order->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Order Detail
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Product: {{ $order->product->name }}</p>
                                                    <p>Name: {{ $order->bname }}</p>
                                                    <p>Email: {{ $order->bemail }}</p>
                                                    <p>Number: {{ $order->bnumber }}</p>
                                                    <p>Price: Rs. {{ $order->price }}</p>
                                                    <p>Quantity: {{ $order->quantity }}</p>
                                                    <p>Total: Rs. {{ $order->total }}</p>
                                                    <p>Status: @if ($order->status == 'Canceled')
                                                            <span style="color: red">{{ $order->status }}</span>
                                                        @elseif($order->status == 'Delivered')
                                                            <span style="color: green">{{ $order->status }}</span>
                                                        @else
                                                            {{ $order->status }}
                                                        @endif
                                                    </p>
                                                    <p>Note: {{ $order->note }}</p>
                                                </div>
                                                <div class="modal-footer d-flex justify-content-between">
                                                    <form action="{{ route('updateOrder') }}" method="POST"
                                                        class="mr-auto">
                                                        @csrf
                                                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                                                        <input type="hidden" name="status" value="Canceled">
                                                        @if ($order->status !== 'Canceled' && $order->status !== 'Delivered')
                                                            <button type="submit" class="btn btn-danger mr-auto"
                                                                style="margin-right: auto">Cancel
                                                                Order</button>
                                                        @endif
                                                    </form>
                                                    <button type="button" class="btn btn-secondary "
                                                        data-bs-dismiss="modal">Close</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <tr>
                                    <th scope="row"> No Orders Yet.</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="tab-pane fade @if ($activeTab == 'profile') show active @endif" id="profile-tab-pane"
                role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                <div class=" mt-2">
                    @if ($errors->any())
                        {!! implode('', $errors->all('<span class="text text-danger">:message</span>')) !!}
                    @endif
                    <div class=" d-flex items-center justify-content-center ">
                        <form class="w-100 p-5 "
                            style="border-radius:10px; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;"
                            action="{{ route('updateProfile') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (Session::has('userUpdate'))
                                <div class="w-100 p-3 bg-success"
                                    style="    margin-bottom: 20px;
                            border-radius: 10px;
                            color: white;">
                                    {{ Session::get('userUpdate') }}
                                </div>
                            @endif
                            <div class="d-flex">

                                <div class="w-50">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Full Name</label>
                                        <input type="text" class="form-control @error('name') invalid @enderror"
                                            name="name" value="{{ old('name') ?? auth()->user()->name }}" required>
                                        @error('name')
                                            <div class="text-red">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                                        <input type="email" class="form-control @error('email') invalid @enderror"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"name="email"
                                            value="{{ old('email') ?? auth()->user()->email }}" readonly>
                                        <div id="emailHelp" class="form-text">We'll never share your email with anyone
                                            else.
                                        </div>
                                        @error('email')
                                            <div class="text-red">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Phone Number</label>
                                        <input type="number"
                                            class="form-control @error('phone_number') invalid @enderror"
                                            name="phone_number"
                                            value="{{ old('phone_number') ?? auth()->user()->phone_number }}" required>
                                        @error('phone_number')
                                            <div class="text-red">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Address </label>
                                        <input type="text" class="form-control @error('address') invalid @enderror"
                                            name="address" value="{{ old('address') ?? auth()->user()->address }}"
                                            required>
                                        @error('address')
                                            <div class="text-red">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <input type="password" class="form-control @error('password') invalid @enderror"
                                            id="exampleInputPassword1" name="password" value="{{ old('password') }}">
                                        @error('password')
                                            <div class="text-red">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                                        <input type="password"
                                            class="form-control @error('confirm_password') invalid @enderror"
                                            id="exampleInputPassword1" name="confirm_password"
                                            value="{{ old('confirm_password') }}">
                                        @error('confirm_password')
                                            <div class="text-red">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end w-50">
                                    <div class="userImage">
                                        <div class="mb-3 col-md-12">
                                            <img class="imagePreview" id="output00" alt=""
                                                src="@if (auth()->user()->image) {{ asset('images/' . auth()->user()->image) }}  @else {{ asset('frontend/default/images/default_user.png') }} @endif"
                                                style="height:100%;object-fit:fill;width:100%;">
                                            <div class="">
                                                <label class="form-label">Profile Picture</label>
                                                <input type="file" name="image" onchange="loadFile9(event)"
                                                    class="form-control">
                                                @error('image')
                                                    <div class="text-red">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex items-center justify-content-center w-100 mt-3">

                                <button type="submit" class="btn px-4"
                                    style="background: #ff6b6b;color:white">Update</button>
                            </div>
                        </form>
                    </div>
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
