@extends('frontend.layouts.master')
@section('title')
    {{ $product->name }}
@endsection
@section('content')
    <div class="single-product">
        <div class="container">
            <div class="wrapper">
                <div class="breadcrumb">
                    <ul class="flexitem">
                        <li><a href="/">Home</a></li>
                        <li><a href="{{ route('shop') }}">Shoes</a></li>
                        <li>{{ $product->name }}</li>
                    </ul>
                </div>
                <!-- breadcrumb -->

                <div class="column">
                    <div class="products one">
                        <div class="flexwrap">
                            <div class="row">
                                <div class="item is_sticky">
                                    <div class="price">
                                        @if ($product->offer !== null)
                                            <span class="discount " style="right: 12px">{{ $product->offer }}%<br>OFF</span>
                                        @elseif ($product->discount !== null)
                                            <span class="discount"
                                                style="right: 12px">{{ $product->discount }}%<br>OFF</span>
                                        @endif
                                    </div>
                                    <div class="big-image">
                                        <div class="big-image-wrapper swiper-wrapper">
                                            @if (count($product->images) > 0)
                                                @foreach ($product->images ?? [] as $image)
                                                    <div class="image-show swiper-slide">
                                                        <a data-fslightbox
                                                            href="{{ asset('images/' . $image->image) }}"><img
                                                                src="{{ asset('images/' . $image->image) }}"
                                                                alt=""></a>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="image-show swiper-slide">
                                                    <a data-fslightbox
                                                        href="{{ asset('frontend/default/images/default.jpeg') }}"><img
                                                            src="{{ asset('frontend/default/images/default.jpeg') }}"
                                                            alt=""></a>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="swiper-button-next"></div>
                                        <div class="swiper-button-prev"></div>
                                    </div>

                                    <div thumbSlider="" class="small-image">
                                        <ul class="small-image-wrapper flexitem swiper-wrapper">
                                            @foreach ($product->images ?? [] as $image)
                                                <li class="thumbnail-show swiper-slide">
                                                    <img src="{{ asset('images/' . $image->image) }}" alt="">
                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="item">
                                    <h1>{{ $product->name }}
                                    </h1>
                                    <div class="content mt-0">

                                        <div class="rating">

                                            @for ($i = 0; $i < $product->rating; $i++)
                                                <i class="ri-star-fill" style="color: orange"></i>
                                            @endfor
                                        </div>
                                        <div class="stock-sku">
                                            @if ($product->stock > 0)
                                                <span class="available">In Stock</span>
                                            @else
                                                <span class="available" style="color: red">Out of Stock</span>
                                            @endif
                                            <span class="sku mini-text">{{ $product->model }}</span>
                                        </div>
                                        <div class="price">
                                            @if ($product->offer !== null)
                                                <span class="current">Rs.
                                                    {{ getDiscountPrice($product->price, $product->offer) }}</span>
                                                <span class="normal">Rs. {{ $product->price }}</span>
                                            @elseif ($product->discount !== null)
                                                <span class="current">Rs.
                                                    {{ getDiscountPrice($product->price, $product->discount) }}</span>
                                                <span class="normal">Rs. {{ $product->price }}</span>
                                            @else
                                                <span class="normal">Rs. {{ $product->price }}</span>
                                            @endif

                                        </div>
                                        <form method="POST" action="{{ route('addToCart') }}">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            @if ($product->colors->count() > 0)
                                                <div class="colors">
                                                    <p style="margin-bottom:10px">Color</p>
                                                    <div class="color-box" style="margin-bottom:10px">
                                                        @foreach ($product->colors as $color)
                                                            <input type="radio" name="color" id="color"
                                                                class="color-radio"
                                                                style="margin:0px 5px;  box-shadow: 0 0 0 1px {{ $color->color }}; background:{{ $color->color }}">
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($product->sizes->count() > 0)
                                                <div class="sizes" style="margin-bottom:10px">
                                                    <p style="margin-bottom:10px">Size</p>
                                                    <div class="variant">
                                                        @foreach ($product->sizes as $key => $size)
                                                            <p>
                                                                <input type="radio" name="size"
                                                                    id="size-{{ $key }}">
                                                                <label for="size-40"
                                                                    class="circle"><span>{{ $size->size }}</span></label>
                                                            </p>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                            {{-- @if ($product->dimensions)
                                            <div class="dimensions">
                                                <p>Dime</p>
                                            </div>
                                        @endif --}}

                                            <div class="qty" style="display:flex;gap:10px;align-item:center;">
                                                <div class=""
                                                    style="width: 40px;height:40px;border-radius:1000px;background:lightgray;display:flex;align-items:center;justify-content:center"
                                                    onclick="increaseQuantity()">
                                                    +</div>
                                                <input type="number" value="1" id="quantity" name="quantity">
                                                <div class=""
                                                    style="width: 40px;height:40px;border-radius:1000px;background:lightgray;display:flex;align-items:center;justify-content:center"
                                                    onclick="decreaseQuantity()">
                                                    -</div>
                                            </div>
                                            <div class="actions">
                                                {{-- <div class="qty-control flexitem" style="margin-bottom:0px">
                                                    <button class="minus circle" type="button"
                                                        onclick="decreaseQuantity()">-</button>
                                                    <input type="text" value="1" id="quantity" id="quantity">
                                                    <button class="plus circle" type="button"
                                                        onclick="increaseQuantity()">+</button>
                                                </div> --}}
                                                <div class="button-cart"><button type="submit" class="primary-button">
                                                        @if (session()->has('cart'))
                                                            {{ session()->get('cart') }}
                                                        @else
                                                            Add
                                                            to cart
                                                        @endif
                                                    </button>
                                                </div>
                                        </form>

                                        {{-- <div class="wish-share">
                                                <ul class="flexitem second-links">
                                                    <li><a href="#">
                                                            <span class="icon-large"><i class="ri-heart-line"></i></span>
                                                            <span>Wishlist</span>
                                                        </a></li>
                                                    <li><a href="#">
                                                            <span class="icon-large"><i class="ri-share-line"></i></span>
                                                            <span>Share</span>
                                                        </a></li>
                                                </ul>
                                            </div> --}}
                                    </div>
                                    <div class="description collapse">
                                        <ul>
                                            <li class="has-child expand">
                                                <a href="javascript:void(0)" class="icon-small">Information</a>
                                                <ul class="content">
                                                    @if (isset($product->brand->name))
                                                        <li><span>Brands</span><span>{{ $product->brand->name }}</span>
                                                        </li>
                                                    @endif

                                                    @if (isset($product->category->title))
                                                        <li><span>Category</span><span>{{ $product->category->title }}</span>
                                                        </li>
                                                    @endif

                                                    @if (isset($product->subcategory->title))
                                                        <li><span>Sub Category</span><span
                                                                style="margin-left:10px">{{ $product->subcategory->title }}</span>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </li>
                                            <li class="has-child">
                                                <a href="javascript:void(0)" class="icon-small">Details</a>
                                                <div class="content">
                                                    <div class="">
                                                        {!! $product->sub_description !!}
                                                    </div>
                                                    <div class="">
                                                        {!! $product->description !!}
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="has-child">
                                                <a href="javascript:void(0)" class="icon-small">Policy</a>
                                                <div class="content">
                                                    {!! $product->policy !!}
                                                </div>
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
    </div>

    <div class="features">
        <div class="container">
            <div class="wrapper">
                <div class="column">
                    <div class="sectop flexitem">
                        <h2><span class="circle"></span><span>Related products</span></h2>
                        <div class="second-links">
                            {{-- <a href="#" class="view-all">View all<i class="ri-arrow-right-line"></i></a> --}}
                        </div>
                    </div>
                    <div class="products main flexwrap">
                        @foreach ($products as $product)
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
    <!-- featured products -->




@endsection
@section('scripts')
    <script>
        function increaseQuantity() {
            var qty = document.getElementById("quantity");
            qty.value = +qty.value + 1;
        }

        function decreaseQuantity() {
            var qty = document.getElementById("quantity");
            if (qty.value > 1) {

                qty.value = +qty.value - 1;
            }
        }
    </script>
@endsection
