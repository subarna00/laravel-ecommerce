<div class="slider">
    <div class="container">
        <div class="wrapper">
            <div class="myslider swiper">
                <div class="swiper-wrapper">
                    @foreach (App\Models\Banner::where('status', 'active')->latest()->get() as $banner)
                        <div class="swiper-slide">
                            <a href="{{ $banner->link }}">
                                <div class="item">
                                    <div class="image object-cover">
                                        <img src="{{ asset('images/' . $banner->image) }}" alt="">
                                    </div>
                                    {{-- <div class="text-content flexcol">
                                    <h4>Shoes Fashion</h4>
                                    <h2><span>Come and Get it!</span><br><span>Brand New Shoes</span></h2>
                                    <a href="#" class="primary-button">Shop Now</a>
                                </div> --}}
                                </div>
                            </a>
                        </div>
                    @endforeach

                </div>
                <div class="swiper-pagination">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- slider -->
