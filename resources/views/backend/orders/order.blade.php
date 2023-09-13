@extends('backend.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Orders Table</h3>

                    <div class="card-tools d-flex items-center">
                        <form action="{{ route('filterOrder') }}" method="POST">
                            @csrf
                            <div class="input-group input-group-sm" style="display:flex;align-items:center;gap:10px">
                                {{-- <div class="d-flex  " style="align-items: center;gap:10px">
                                    <label for="">From</label>
                                    <input type="date" name="from" class="form-control">
                                    <label for="">To</label>

                                    <input type="date" name="to" class="form-control">
                                </div> --}}

                                <input type="text" name="search" class="form-control" placeholder="Search">

                                <button type="submit" class="btn btn-sm btn-secondary">Search</button>
                        </form>
                    </div>


                </div>
            </div>
            <!-- /.card-header -->
            <div class="bg-white p-3 mt-2"
                style="border-radius:10px; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">

                <div class="accordion  mb-2" id="accordionExample">
                    @foreach ($orders as $order)
                        <div class="accordion-item mb-3" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                            <h2 class="accordion-header" id="flush-headingOne{{ $order->id }}">
                                <div class="accordion-button w-100 p-4 d-flex align-items-center justify-content-between "
                                    type="button" data-toggle="collapse" data-target="#collapseOne{{ $order->id }}"
                                    aria-expanded="false" aria-controls="collapseOne{{ $order->id }}"
                                    style="text-align: left">
                                    <div class="d-flex">
                                        <div class="bg-danger text-white px-2 py-1 mx-2 " style="border-radius: 5px">
                                            {{ $order->id }}</div> - <div class="bg-secondary text-white px-2 py-1 mx-2 "
                                            style="border-radius: 5px">{{ $order->bname }}</div>
                                        <div class="bg-secondary text-white px-2 py-1 mx-2 " style="border-radius: 5px">
                                            {{ $order->bnumber }}</div>
                                        <div class="bg-secondary text-white px-2 py-1 mx-2 " style="border-radius: 5px">
                                            {{ $order->baddress }}</div>
                                    </div>
                                    <div class="d-flex">
                                        <form class="d-flex" action="{{ route('updateOrderAdmin') }}" method="POST">
                                            @csrf
                                            <input type="hidden" value="{{ $order->id }}" name="order_id">
                                            <select name="status" id="" class="form-control">
                                                <option value="Placed" @if ($order->status == 'Placed') selected @endif>
                                                    Placed</option>
                                                <option value="Processing"
                                                    @if ($order->status == 'Processing') selected @endif>
                                                    Processing</option>
                                                <option value="On the way"
                                                    @if ($order->status == 'On the way') selected @endif>
                                                    On the way</option>
                                                <option value="Delivered" @if ($order->status == 'Delivered') selected @endif>
                                                    Delivered</option>
                                                <option value="Canceled" @if ($order->status == 'Canceled') selected @endif>
                                                    Canceled</option>
                                            </select>
                                            <button class="btn btn-sm btn-success mx-1">Update</button>
                                        </form>
                                        <a href="{{ route('downloadBill', $order->id) }}"
                                            class="btn btn-sm btn-dark ml-2">Print Bill</a>
                                    </div>

                                </div>
                            </h2>
                            <div id="collapseOne{{ $order->id }}" class="accordion-collapse collapse "
                                aria-labelledby="headingOne{{ $order->id }}" data-parent="#accordionExample">
                                <div class="accordion-body px-4 pb-3">
                                    {{ $order->note }}
                                    @foreach ($order->orderProducts ?? [] as $op)
                                        <div class="my-2 p-2 d-flex align-items-center justify-content-between"
                                            style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">

                                            <img src="{{ showImage($op->product->images[0]['image'] ?? null) }} "
                                                alt="" height="" style="height: 50px">

                                            <div class="">{{ $op->product->name }}</div>
                                            <div class="">Qty: {{ $op->quantity }}</div>
                                            <div class="">Price: Rs. {{ $op->price }}</div>
                                            <div class="">Total: Rs. {{ $op->total }}</div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    </div>
@endsection
