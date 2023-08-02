@extends('frontend.layouts.master')
@section('content')
    <div class="container">
        <div class="single-cart">
            <div class="container">
                <div class="wrapper">
                    <div class="breadcrumb">
                        <ul class="flexitem">
                            <li><a href="#">Home</a></li>
                            <li>Cart</li>
                        </ul>
                    </div>
                    <div class="page-title">
                        <h1>Shopping Cart</h1>
                    </div>
                    <div class="products one cart">
                        <div class="flexwrap" id="render-cart">
                            <div class="form-cart">
                                <div class="item">
                                    <table id="cart-table">
                                        <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th>Price</th>
                                                <th>Qty</th>
                                                <th>Subtotal</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $carts = App\Models\Cart::where('user_id', auth()->user()->id)->get();
                                            $total = 0;
                                            ?>
                                            @foreach ($carts as $cart)
                                                <?php
                                                $p = 0;
                                                if ($cart->product->offer) {
                                                    $p = getDiscountPrice($cart->product->price, $cart->product->offer);
                                                } elseif ($cart->product->discount) {
                                                    $p = getDiscountPrice($cart->product->price, $cart->product->discount);
                                                } else {
                                                    $p = $cart->product->price;
                                                }
                                                $total += $p * $cart->quantity;
                                                ?>
                                                <tr>
                                                    <td class="flexitem">
                                                        <div class="thumbnail object-cover">
                                                            <a href="{{ $cart->product->slug }}"><img
                                                                    src="{{ showImage($cart->product->images[0]['image'] ?? null) }}"
                                                                    alt=""></a>
                                                        </div>
                                                        <div class="content">
                                                            <strong><a
                                                                    href="{{ $cart->product->slug }}">{{ $cart->product->name }}</a></strong>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @if ($cart->product->offer !== null)
                                                            <span>Rs.
                                                                {{ getDiscountPrice($cart->product->price, $cart->product->offer) }}</span>
                                                        @elseif ($cart->product->discount !== null)
                                                            <span>Rs.
                                                                {{ getDiscountPrice($cart->product->price, $cart->product->discount) }}</span>
                                                        @else
                                                            <span>Rs. {{ $cart->product->price }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="qty-control flexitem qty-cart">
                                                            {{-- <button class="minus">-</button> --}}
                                                            <input type="number" value="{{ $cart->quantity }}"
                                                                min="1"
                                                                onkeydown="updateQuantity(event,'{{ $cart->id }}')"
                                                                onchange="updateQuantity(event,'{{ $cart->id }}')">
                                                            {{-- <button class="plus">+</button> --}}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @if ($cart->product->offer !== null)
                                                            <span>Rs.
                                                                {{ getDiscountPrice($cart->product->price, $cart->product->offer) * $cart->quantity }}</span>
                                                        @elseif ($cart->product->discount !== null)
                                                            <span>Rs.
                                                                {{ getDiscountPrice($cart->product->price, $cart->product->discount) * $cart->quantity }}</span>
                                                        @else
                                                            <span>Rs. {{ $cart->product->price * $cart->quantity }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('deleteFromCart', $cart->id) }}"
                                                            style="margin-left:auto" method="post">
                                                            @csrf
                                                            <button class="item-remove"
                                                                style="background:white;border:0px;cursor: pointer;"
                                                                type="submit"><i class="ri-close-line"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="cart-summary styled">
                                <div class="item">
                                    <div class="cart-total">
                                        <table>
                                            <tbody>
                                                {{-- <tr>
                                                    <th>Delivery <span class="mini-text">(Flat)</span></th>
                                                    <td>$10.00</td>
                                                </tr> --}}
                                                <tr class="grand-total">
                                                    <th>TOTAL</th>
                                                    <td><strong>Rs. {{ $total }}</strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <a href="{{ route('checkoutPage') }}" class="secondary-button">Place Order</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('btheme/plugins/jquery/jquery.min.js') }}"></script>

    <script>
        function updateQuantity(e, id) {
            if (id)
                var quantity = e.target.value
            $.ajax({
                method: "POST",
                url: "/update-cart/" + id,
                data: {
                    id: id,
                    quantity: quantity,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(res) {
                    $("#render-cart").load(location.href + " #render-cart");
                    $("#render-nav-cart").load(location.href + " #render-nav-cart");
                }
            })
        }
    </script>
@endsection
