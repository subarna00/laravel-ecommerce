@extends('frontend.layouts.master')
@section('content')
    @include('frontend.template_parts.banner')

    @include('frontend.template_parts.brand')
    <!-- Brands -->
    @include('frontend.template_parts.offer')
    @include('frontend.template_parts.trending')
    <!-- trending -->

    @include('frontend.template_parts.featured')
    <!-- featured products -->

    <div class="banners">
        <div class="container">
            <div class="wrapper">
                <div class="column">
                    <div class="banner flexwrap">
                        <div class="row">
                            <div class="item">
                                <div class="image">
                                    <img src="/frontend/assets/banner/banner1.jpg" alt="">
                                </div>
                                <div class="text-content flexcol">
                                    <h3>Brutal Sale!</h3>
                                    <h4><span>Get the deal in here</span><br>Living Room Chair</h4>
                                    <a href="#" class="primary-button">Shop Now</a>
                                </div>
                                <a href="#" class="over-link"></a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="item get-gray">
                                <div class="image">
                                    <img src="frontend/assets/banner/banner2.jpg" alt="">
                                </div>
                                <div class="text-content flexcol">
                                    <h3>Brutal Sale!</h3>
                                    <h4><span>Discount everyday</span><br>Office Outfit</h4>
                                    <a href="#" class="primary-button">Shop Now</a>
                                </div>
                                <a href="#" class="over-link"></a>
                            </div>
                        </div>
                    </div>
                    <!-- banners -->


                </div>
            </div>
        </div>
    </div>
@endsection
