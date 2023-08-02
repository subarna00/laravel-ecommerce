<?php
$offerProducts = App\Models\Product::where(['status' => 'active'])
    ->whereNotNull('offer')
    ->latest()
    ->inRandomOrder()
    ->take(8)
    ->get();
?>
@if (count($offerProducts) > 0)
    <div class="features">
        <div class="container">
            <div class="wrapper">
                <div class="column">
                    <div class="sectop flexitem">
                        <h2><span class="circle"></span><span>Offer Products</span></h2>
                        <div class="second-links">
                            <a href="#" class="view-all">View all<i class="ri-arrow-right-line"></i></a>
                        </div>
                    </div>

                    <div class="products main flexwrap">
                        @foreach ($offerProducts as $product)
                            <div class="item">
                                <div class="media">
                                    <div class="thumbnail object-cover">
                                        <a href="{{ route('productDetailPage', $product->slug) }}">
                                            <img src="{{ showImage($product->images[0]['image'] ?? null) }}"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="hoverable">
                                        <ul>
                                            <li><a href="{{ route('productDetailPage', $product->slug) }}"><i
                                                        class="ri-eye-line"></i></a></li>
                                        </ul>
                                    </div>
                                    @if ($product->discount !== null)
                                        <div class="discount circle flexcenter"><span>{{ $product->discount }}%</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="content">
                                    <div class="rating">

                                        @for ($i = 0; $i < $product->rating; $i++)
                                            <i class="ri-star-fill" style="color: orange"></i>
                                        @endfor
                                    </div>
                                    <h3><a
                                            href="{{ route('productDetailPage', $product->slug) }}">{{ $product->name }}</a>
                                    </h3>
                                    <div class="price">
                                        @if ($product->discount !== null)
                                            <span class="current">Rs.
                                                {{ getDiscountPrice($product->price, $product->discount) }}</span>
                                            <br>
                                            <span class="normal mini-text">Rs. {{ $product->price }}</span>
                                        @else
                                            <span class="current">Rs. {{ $product->price }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
