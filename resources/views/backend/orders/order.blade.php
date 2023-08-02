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
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
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
                        @foreach ($orders as $key => $order)
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
                                <td><button type="button" class="btn btn-sm btn-secondary" data-toggle="modal"
                                        data-target="#exampleModal{{ $order->id }}">
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
                                            <button type="button" class="btn-close" data-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="{{ asset('receipts/' . $order->receipt) }}" alt="">
                                            <a href="{{ asset('receipts/' . $order->receipt) }}"
                                                class="btn btn-sm btn-secondary my-2" download>Download Receipt</a>
                                            <p>Product: {{ $order->product->name }}</p>
                                            <p>Name: {{ $order->bname }}</p>
                                            <p>Email: {{ $order->bemail }}</p>
                                            <p>Number: {{ $order->bnumber }}</p>
                                            <p>Price: Rs. {{ $order->price }}</p>
                                            <p>Quantity: {{ $order->quantity }}</p>
                                            <p>Total: Rs. {{ $order->total }}</p>
                                            <p>Status: @if ($order->status == 'Canceled')
                                                    <span style="color: red !important">{{ $order->status }}
                                                    </span>
                                                @else
                                                    {{ $order->status }}
                                                @endif
                                            </p>
                                            <p>Note: {{ $order->note }}</p>
                                        </div>
                                        <div class="modal-footer d-flex w-100 justify-content-between">
                                            <form action="{{ route('updateOrder') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                                {{-- <input type="hidden" name="status" value="Canceled"> --}}
                                                <select name="status" class="form-control mb-2">
                                                    <option value="" selected disabled>Update Status</option>
                                                    <option value="Placed"
                                                        @if ($order->status == 'Placed') selected @endif>Placed</option>
                                                    <option value="Processing"
                                                        @if ($order->status == 'Processing') selected @endif>Processing
                                                    </option>
                                                    <option value="On the way"
                                                        @if ($order->status == 'On the way') selected @endif>On the way
                                                    </option>
                                                    <option value="Delivered"
                                                        @if ($order->status == 'Delivered') selected @endif>Delivered</option>
                                                    <option value="Canceled"
                                                        @if ($order->status == 'Canceled') selected @endif>Canceled</option>
                                                </select>
                                                <button type="submit" class="btn btn-primary">Update
                                                    Order</button>

                                            </form>

                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </tbody>
                </table>
                <hr>
                <div class="my-3 mx-2 d-flex justify-content-end">

                    {{ $orders->links('pagination::bootstrap-4') }}
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    </div>
@endsection
