@extends('frontend.layouts.master')
@section('content')
    <div class="container">
        <div class="single-checkout">
            <div class="container">
                <div class="wrapper">
                    <div class="checkout flexwrap">
                        <div class="item left styled">
                            <h1>Delivery Address</h1>
                            @if ($errors->any())
                                {!! implode('', $errors->all('<span class="text text-danger" style="color: red">:message</span>')) !!}
                            @endif
                            <form action="{{ route('addOrder') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <p style="margin-bottom: 0px">
                                    <label for="email">Add Your Receipt <span></span></label>
                                </p>
                                <p>
                                    <label
                                        style="    font-weight: 400;
                                    font-size: 12px;">Scan
                                        and pay through the QR code and add the receipt
                                        here.</label>
                                    <input type="file" name="receipt" autocomplete="off" required>
                                </p>
                                <p>
                                    <label for="email">Email Address <span></span></label>
                                    <input type="email" name="bemail" id="email" autocomplete="off" required>
                                </p>
                                <p>
                                    <label for="fname">Billing Name <span></span></label>
                                    <input type="text" id="fname" name="bname" required>
                                </p>

                                <p>
                                    <label>Billing Address <span></span></label>
                                    <textarea cols="30" rows="10" name="baddress"></textarea>
                                </p>
                                <p>
                                    <label for="phone">Phone Number <span></span></label>
                                    <input type="number" id="phone" name="bnumber" required>
                                </p>
                                <p>
                                    <label>Order Notes (optional)</label>
                                    <textarea cols="30" rows="10" name="note"></textarea>
                                </p>
                                <div class="primary-checkout">
                                    <button type="submit" class="primary-button">Place Order</button>
                                </div>
                            </form>


                        </div>
                        <div class="item right">
                            <h2>Order Summary</h2>
                            <div class="summary-order is_sticky">
                                <div class="" style="display: grid">
                                    <ul class="products mini" style="order:2">
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
                                            <li class="item">
                                                <div class="thumbnail object-cover">
                                                    <img src="{{ showImage($cart->product->images[0]['image'] ?? null) }} "
                                                        alt="">
                                                </div>
                                                <div class="item-content">
                                                    <p>{{ $cart->product->name }}</p>
                                                    <span class="price">
                                                        <span>
                                                            @if ($cart->product->offer !== null)
                                                                <span>Rs.
                                                                    {{ getDiscountPrice($cart->product->price, $cart->product->offer) }}</span>
                                                            @elseif ($cart->product->discount !== null)
                                                                <span>Rs.
                                                                    {{ getDiscountPrice($cart->product->price, $cart->product->discount) }}</span>
                                                            @else
                                                                <span>Rs. {{ $cart->product->price }}</span>
                                                            @endif
                                                        </span>
                                                        <span>x {{ $cart->quantity }}</span>
                                                    </span>
                                                </div>
                                            </li>
                                        @endforeach

                                    </ul>
                                    <div class="summary-totals" style="order:1">
                                        <ul>
                                            <li style="margin-top: 0px">
                                                <span>Total</span>
                                                <strong>Rs. {{ $total }}</strong>
                                            </li>
                                        </ul>
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
