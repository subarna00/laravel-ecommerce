<div class="header-top mobile-hide" style="    border-bottom: 1px solid lightgray;">
    <div class="container">
        <div class="wrapper flexitem">
            <div class="left">
                <ul class="flexitem main-links">
                    <li><a href="mailto:{{ $siteSetting->email }}">{{ $siteSetting->email }}</a></li>
                    <li><a href="tel:{{ $siteSetting->number }}">{{ $siteSetting->number }}</a></li>
                    <li><a href="#">{{ $siteSetting->address }}</a></li>
                </ul>
            </div>
            <div class="right">
                <ul class="flexitem main-links">
                    <li><a href="{{ route('userDashboard') }}">My Account</a></li>
                    @if (auth()->user())
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    style="border: 0;
                            background: white;
                            color: red;">Logout</button>
                            </form>
                        </li>
                    @endif
                    <li style="display: flex;gap:10px">
                        @if ($siteSetting->facebook)
                            <a href="{{ $siteSetting->facebook }}"><i class="ri-facebook-line top-icon"></i></a>
                        @endif
                        @if ($siteSetting->instagram)
                            <a href="{{ $siteSetting->instagram }}"><i class="ri-instagram-line top-icon"></i></a>
                        @endif

                        @if ($siteSetting->tiktok)
                            <a href="{{ $siteSetting->tiktok }}" class="tiktok">
                                <img src="{{ asset('frontend/default/images/tiktok-fill.svg') }}" alt=""
                                    srcset="" class="top-icon"></a>
                        @endif


                        @if ($siteSetting->youtube)
                            <a href="{{ $siteSetting->youtube }}"><i class="ri-youtube-line top-icon"></i></a>
                        @endif

                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>
<div class="header-nav">
    <div class="container">
        <div class="wrapper flexitem">
            <a href="#" class="trigger desktop-hide"><span class="i ri-menu-2-line"></span></a>
            <div class="left flexitem">
                <div class="logo"><a href="/"><img src="{{ asset('images/' . $siteSetting->logo) }}"
                            alt="" srcset=""
                            style="max-height:80px;max-width:150px;object-fit:contain"></a>
                </div>
                <nav class="mobile-hide">
                    <ul class="flexitem second-links">
                        <li><a href="/">Home</a></li>
                        <li><a href="{{ route('shop') }}">Shop</a></li>
                        <li><a href="{{ route('contactUsPage') }}">Contact Us</a></li>

                    </ul>
                </nav>
            </div>
            <div class="right">
                <ul class="flexitem second-links" id="render-nav-cart">
                    @if (!auth()->user())
                        <li class="mobile-hide"><a href="{{ route('loginPage') }}">
                                Sign In
                            </a></li>
                        <li class="mobile-hide"><a href="{{ route('registerPage') }}">
                                Sign Up
                            </a></li>
                    @endif
                    @if (auth()->user())
                        {{-- cart --}}
                        <?php
                        $carts = App\Models\Cart::where('user_id', auth()->user()->id)
                            ->latest()
                            ->get();
                        ?>
                        <li class="iscart"><a href="#">

                                <div class="icon-large">
                                    <i class="ri-shopping-cart-line"></i>
                                    <div class="fly-item"><span class="item-number"> {{ count($carts) }}</span></div>
                                </div>


                            </a>
                            @if (count($carts) > 0)
                                <div class="mini-cart">
                                    <div class="content">


                                        <div class="cart-head">
                                            {{ count($carts) }} items in cart
                                        </div>
                                        <div class="cart-body">
                                            <ul class="products mini">
                                                @foreach ($carts as $cart)
                                                    <li class="item">
                                                        <div class="thumbnail object-cover">
                                                            <a
                                                                href="{{ route('productDetailPage', $cart->product->slug) }}"><img
                                                                    src="{{ showImage($cart->product->images[0]['image'] ?? null) }}"
                                                                    alt=""></a>
                                                        </div>
                                                        <div class="item-content">
                                                            <p><a
                                                                    href="{{ $cart->product->slug }}">{{ $cart->product->name }}</a>
                                                            </p>
                                                            <span class="price">
                                                                @if ($cart->product->offer !== null)
                                                                    <span>Rs.
                                                                        {{ getDiscountPrice($cart->product->price, $cart->product->offer) }}</span>
                                                                @elseif ($cart->product->discount !== null)
                                                                    <span>Rs.
                                                                        {{ getDiscountPrice($cart->product->price, $cart->product->discount) }}</span>
                                                                @else
                                                                    <span>Rs. {{ $cart->product->price }}</span>
                                                                @endif
                                                                <span
                                                                    class="fly-item"><span>{{ $cart->quantity ?? 1 }}x</span></span>
                                                            </span>
                                                        </div>

                                                        <form action="{{ route('deleteFromCart', $cart->id) }}"
                                                            style="margin-left:auto" method="post">
                                                            @csrf
                                                            <button class="item-remove"
                                                                style="background:white;border:0px;cursor: pointer;"
                                                                type="submit"><i class="ri-close-line"></i></button>
                                                        </form>

                                                    </li>
                                                @endforeach


                                            </ul>
                                        </div>
                                        <div class="cart-footer">
                                            <div class="actions">
                                                {{-- <a href="/cart.html" class="primary-button">Checkout</a> --}}
                                                <a href="{{ route('cartPage') }}" class="secondary-button">View
                                                    Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- header-nav -->

<div class="header-main mobile-hide">
    <div class="container">
        <div class="wrapper flexitem">
            <div class="left">
                <div class="dpt-cat">
                    <div class="dpt-head">
                        <div class="main-text">All Categories</div>
                        <div class="mini-text mobile-hide">Total
                            {{ App\Models\Product::where('status', 'active')->count() }} Products</div>
                        <a href="#" class="dpt-trigger mobile-hide">
                            <i class="ri-menu-3-line ri-xl"></i>
                            <i class="ri-close-line ri-xl"></i>
                        </a>
                    </div>
                    <div class="dpt-menu">
                        <ul class="second-links">
                            @foreach (App\Models\Category::where('status', 'Active')->latest()->get() as $category)
                                <li class="has-child beauty">
                                    <a href="{{ route('productCategory', $category->slug) }}">
                                        <div class="icon-large">{!! $category->icon ?? '<i class="ri-bear-smile-line"></i>' !!}</div>
                                        {{ $category->title }}
                                        @if (count($category->subCategories) > 0)
                                            <div class="icon-small"><i class="ri-arrow-right-s-line"></i></div>
                                        @endif

                                    </a>
                                    <ul>
                                        @foreach ($category->subCategories as $subCat)
                                            <li><a
                                                    href="{{ route('productSubCategory', $subCat->slug) }}">{{ $subCat->title }}</a>
                                            </li>
                                        @endforeach

                                    </ul>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
            <div class="right">
                <div class="search-box">
                    <form action="{{ route('searchProduct') }}" class="search" method="POST">
                        @csrf
                        <span class="icon-large"><i class="ri-search-line"></i></span>
                        <input type="search" placeholder="Search for products" name="search" required>
                        <button type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- header-main -->
