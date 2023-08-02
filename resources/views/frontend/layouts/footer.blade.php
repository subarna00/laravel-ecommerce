<footer>

    {{--
    <div class="widgets pb-0" style="background-color: #0a021c;">
        <div class="container">
            <div class="wrapper">
                <div class="flexwrap">
                    <div class="row">
                        <div class="item mini-links">
                            <h4>Help & Contact</h4>
                            <ul class="flexcol">
                                <li><a href="#">Your Account</a></li>
                                <li><a href="#">Your Orders</a></li>
                                <li><a href="#">Shipping Rates</a></li>
                                <li><a href="#">Returns</a></li>
                                <li><a href="#">Assistant</a></li>
                                <li><a href="#">Help</a></li>
                                <li><a href="#">Contact us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="item mini-links">
                            <h4>Product Categories</h4>
                            <ul class="flexcol">
                                <li><a href="#">Beauty</a></li>
                                <li><a href="#">Electronic</a></li>
                                <li><a href="#">Women's Fashion</a></li>
                                <li><a href="#">Men's Fashion</a></li>
                                <li><a href="#">Girl's Fashion</a></li>
                                <li><a href="#">Boy's Fashion</a></li>
                                <li><a href="#">Health & Household</a></li>
                                <li><a href="#">Home & Kitchen</a></li>
                                <li><a href="#">Pet Supplies</a></li>
                                <li><a href="#">Sports</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="item mini-links">
                            <h4>Payment Info</h4>
                            <ul class="flexcol">
                                <li><a href="#">Bussiness Card</a></li>
                                <li><a href="#">Shop with Points</a></li>
                                <li><a href="#">Reload Your Balance</a></li>
                                <li><a href="#">Paypal</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="item mini-links">
                            <h4>About Us</h4>
                            <ul class="flexcol">
                                <li><a href="">Company Info</a></li>
                                <li><a href="">News</a></li>
                                <li><a href="">Investors</a></li>
                                <li><a href="">Careers</a></li>
                                <li><a href="">Policies</a></li>
                                <li><a href="">Customer reviews</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- widgets-->

    <div class="footer-info py-5" style="background-color: #0a021c;">
        <div class="container">
            <div class="wrapper">
                <div class="flexcol">
                    <div class="logo">
                    </div>
                    <div class="socials">
                        <ul class="flexitem " style="padding: 0;gap:16px">
                            @if ($siteSetting->facebook)
                                <a href="{{ $siteSetting->facebook }}" class="tiktok"><i
                                        class="ri-facebook-line "></i></a>
                            @endif
                            @if ($siteSetting->instagram)
                                <a href="{{ $siteSetting->instagram }}" class="tiktok"><i
                                        class="ri-instagram-line "></i></a>
                            @endif

                            @if ($siteSetting->tiktok)
                                <a href="{{ $siteSetting->tiktok }}" class="tiktok">
                                    <img src="{{ asset('frontend/default/images/tiktok-fill.svg') }}" alt=""
                                        srcset="" class=""></a>
                            @endif


                            @if ($siteSetting->youtube)
                                <a href="{{ $siteSetting->youtube }}" class="tiktok"><i
                                        class="ri-youtube-line "></i></a>
                            @endif

                        </ul>
                    </div>
                </div>
                <p class="mini-text my-0">Copyright {{ now()->year }} © {{ $siteSetting->name }} All right reserved.
                </p>
            </div>
        </div>
    </div>
</footer>
<!-- Footer -->

<div class="menu-bottom desktop-hide">
    <div class="container">
        <div class="wrapper">
            <nav>
                <ul class="flexitem">
                    <li>
                        <a href="#">
                            <i class="ri-bar-chart-line"></i>
                            <span>Trending</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="ri-user-6-line"></i>
                            <span>Account</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="ri-heart-line"></i>
                            <span>Wishlist</span>
                        </a>
                    </li>
                    <li>
                        <a href="#0" class="t-search">
                            <i class="ri-search-line"></i>
                            <span>Search</span>
                        </a>
                    </li>
                    <li>
                        <a href="#0" class="cart-trigger">
                            <i class="ri-shopping-cart-line"></i>
                            <span>Cart</span>
                            <div class="fly-item">
                                <span class="item-number">0</span>
                            </div>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<!-- menu bottom -->

{{-- <div class="search-bottom desktop-hide">
    <div class="container">
        <div class="wrapper">
            <form action="" class="search">
                <a href="#" class="t-close search-close flexcenter"><i class="ri-close-line"></i></a>
                <span class="icon-large"><i class="ri-search-line"></i></span>
                <input type="search" placeholder="Search" required>
                <button type="submit">Search</button>
            </form>
        </div>
    </div>
</div> --}}
<!-- search bottom -->
