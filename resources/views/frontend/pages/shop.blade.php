@extends('frontend.layouts.master')
@section('content')
    <div class="single-category">
        <div class="container">
            <div class="wrapper">
                <div class="column">
                    <div class="holder">
                        <div class="row sidebar">
                            <div class="filter" style="padding: 0px">
                                <div class="filter-block">
                                    <h4>Category</h4>
                                    <ul>
                                        @foreach (App\Models\Category::latest()->inRandomOrder()->get() as $category)
                                            <li>
                                                <label for="bags">
                                                    <a href="{{ route('productCategory', $category->slug) }}">
                                                        <span>{{ $category->title }}</span></a>
                                                </label>
                                                <span class="count">{{ $category->subCategories->count() }}</span>
                                            </li>
                                        @endforeach


                                    </ul>
                                </div>

                                <div class="filter-block">
                                    <h4>Brands</h4>
                                    <ul>

                                        @foreach (App\Models\Brand::latest()->inRandomOrder()->get() as $brand)
                                            <li>
                                                <label for="bags">
                                                    <a href="{{ route('productBrand', $brand->id) }}">
                                                        <span>{{ $brand->name }}</span></a>
                                                </label>
                                                <span class="count">{{ $brand->products->count() }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>


                            </div>
                        </div>
                        <div class="section">
                            <div class="row">
                                <div class="cat-head">
                                    <div class="breadcrumb">
                                        <ul class="flexitem">
                                            <li><a href="/">Home</a></li>
                                            <li>{{ $title ?? 'Shop' }}</li>
                                        </ul>
                                    </div>
                                    {{-- <div class="page-title">
                                        <h1>Women</h1>
                                    </div>
                                    <div class="cat-description">
                                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Libero, hic odit quia,
                                            ducimus sint molestiae amet fuga, nulla similique excepturi veritatis
                                            consequuntur sed inventore nisi. Tenetur, ut nemo, et repellendus veniam
                                            eligendi minus velit aliquid, minima suscipit quos sequi. Voluptates pariatur
                                            totam magni eligendi illo asperiores perferendis ipsa? Tenetur aut placeat totam
                                            cupiditate. Possimus optio ut eveniet maiores ratione autem aliquid magni aut
                                            neque officiis impedit rerum quam, ducimus deserunt fugiat dolor perspiciatis
                                            alias ipsum!</p>
                                    </div> --}}
                                    {{-- <div class="cat-navigation flexitem">
                                        <div class="item-filter desktop-hide">
                                            <a href="#" class="filter-trigger label">
                                                <i class="ri-menu-2-line ri-2x"></i>
                                                <span>Filter</span>
                                            </a>
                                        </div>
                                        <div class="item-sortir">
                                            <div class="label">
                                                <span class="mobile-hide">Sort by default</span>
                                                <div class="desktop-hide">Default</div>
                                                <i class="ri-arrow-down-s-line"></i>
                                            </div>
                                            <ul>
                                                <li>Default</li>
                                                <li>Product Name</li>
                                                <li>Price</li>
                                                <li>Brand</li>
                                            </ul>
                                        </div>

                                    </div> --}}
                                </div>
                            </div>
                            <div class="products main flexwrap " style="margin-top: 40px">
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
                                                    <li class="active"><a href="#"><i class="ri-heart-line"></i></a>
                                                    </li>
                                                    <li><a href="{{ route('productDetailPage', $product->slug) }}"><i
                                                                class="ri-eye-line"></i></a></li>
                                                </ul>
                                            </div>
                                            @if ($product->discount !== null)
                                                <div class="discount circle flexcenter">
                                                    <span>{{ $product->discount }}%</span>
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
                            <div class=" flexcenter">
                                {{-- <a href="#" class="secondary-button">Load more</a> --}}
                                <div class="" style="display: flex">

                                    {{ $products->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
