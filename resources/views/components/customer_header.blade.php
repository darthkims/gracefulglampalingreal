<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Graceful Glam</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
    rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('customer')}}/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('customer')}}/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('customer')}}/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('customer')}}/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('customer')}}/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('customer')}}/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('customer')}}/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('customer')}}/css/style.css" type="text/css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__option">
            <div class="offcanvas__links">
                <a href="{{ route('login') }}">Sign in</a>
                <a href="#">FAQs</a>
            </div>
            <div class="offcanvas__top__hover">
                <span>Usd <i class="arrow_carrot-down"></i></span>
                <ul>
                    <li>USD</li>
                    <li>EUR</li>
                    <li>USD</li>
                </ul>
            </div>
        </div>
        <div class="offcanvas__nav__option">
            <a href="#" class="search-switch"><img src="{{ asset('customer')}}/img/icon/search.png" alt=""></a>
            <a href="#"><img src="{{ asset('customer')}}/img/icon/heart.png" alt=""></a>
            <a href="#"><img src="{{ asset('customer')}}/img/icon/cart.png" alt=""></a>
            <div class="price">RM 0.00</div>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__text">
            <p>Free shipping, 30-day return or refund guarantee.</p>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-7">
                        <div class="header__top__left">
                            <p>Free shipping, 30-day return or refund guarantee.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5">
                        <div class="header__top__right">
                            <div class="header__top__links">
                            <form method="POST" action="{{ route('logout') }}" class="d-none" id="logout-form">
                                @csrf
                            </form>
                            <a href="javascript:;" class="offcanvas__links">
                                <i class="fa fa-user me-sm-1"></i>
                                <span class="d-sm-inline d-none"
                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">Sign
                                    Out</span>
                            </a>
                                <!-- <a href="{{ route('logout') }}">Sign out</a> -->
                                <!-- <a href="#">FAQs</a> -->
                            </div>
                            <!-- <div class="header__top__hover">
                                <span>Usd <i class="arrow_carrot-down"></i></span>
                                <ul>
                                    <li>MYR</li>
                                    <li>EUR</li>
                                    <li>USD</li>
                                </ul>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="header__logo">
                        <a href="{{route('main')}}"><img src="{{ asset('customer')}}/img/gg_full.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li class="{{ $activePage == 'main' ? ' active' : '' }}"> <a href="{{ route('main') }}" > Home</a></li>
                            <li class="{{ $activePage == 'shop' ? ' active' : '' }}"><a href="{{ route('cust.products.index') }}">Shop</a></li>
                            <li><a>Categories</a>
                            @php
                            $categories = App\Models\Category::all();
                            $brands = App\Models\Brand::all();
                            @endphp
                                <ul class="dropdown">
                                    @forelse($categories as $index => $category)
                                    <li>
                                        <a href="{{ route('cust.products.index', ['category' => $category->id]) }}">
                                            {{ $category->name }}
                                        </a>
                                    </li>
                                    @empty
                                        <li><a href="#">No categories found</a></li>
                                    @endforelse                                
                                </ul>
                            </li>
                            <li><a>Brands</a>
                                <ul class="dropdown">
                                    @forelse($brands as $index => $brand)
                                    <li>
                                        <a href="{{ route('cust.products.index', ['brand' => $brand->id]) }}">
                                            {{ $brand->name }}
                                        </a>
                                    </li>
                                    @empty
                                        <li><a href="#">No brands found</a></li>
                                    @endforelse                                
                                </ul>
                            </li>
                            <li class="{{ $activePage == 'about' ? ' active' : '' }}"><a href="{{ route('about') }}">About</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="header__nav__option">
                        <a href="#" class="search-switch"><img src="{{ asset('customer')}}/img/icon/search.png" alt=""></a>
                        <a href="#"><img src="{{ asset('customer')}}/img/icon/heart.png" alt=""></a>
                        <a href="{{ route('cart.index') }}"><img src="{{ asset('customer')}}/img/icon/cart.png" alt="">
                            <span class="badge badge-pill badge-danger text-white">
                                @if(session('cart.products'))
                                    {{ count(array_unique(session('cart.products')->pluck('id')->toArray())) }}
                                @else
                                    0
                                @endif
                            </span>
                        </a>
                        @php
                            $total = 0;
                            $cartProducts = session('cart.products');

                            if ($cartProducts) {
                                foreach ($cartProducts as $product) {
                                    $total += $product->price * $product->pivot->quantity;
                                }
                            }
                        @endphp

                        <div class="price">RM {{ number_format($total, 2) }}</div>
                    </div>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>
    <!-- Header Section End -->
    <div class="content">
        {{$slot}}
    </div>

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search End -->

        <!-- Js Plugins -->
        <script src="{{ asset('customer')}}/js/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('customer')}}/js/bootstrap.min.js"></script>
    <script src="{{ asset('customer')}}/js/jquery.nice-select.min.js"></script>
    <script src="{{ asset('customer')}}/js/jquery.nicescroll.min.js"></script>
    <script src="{{ asset('customer')}}/js/jquery.magnific-popup.min.js"></script>
    <script src="{{ asset('customer')}}/js/jquery.countdown.min.js"></script>
    <script src="{{ asset('customer')}}/js/jquery.slicknav.js"></script>
    <script src="{{ asset('customer')}}/js/mixitup.min.js"></script>
    <script src="{{ asset('customer')}}/js/owl.carousel.min.js"></script>
    <script src="{{ asset('customer')}}/js/main.js"></script>

    <!-- Js Plugins -->
    <script src="{{ asset('customer')}}/js/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('customer')}}/js/bootstrap.min.js"></script>
    <script src="{{ asset('customer')}}/js/jquery.nice-select.min.js"></script>
    <script src="{{ asset('customer')}}/js/jquery.nicescroll.min.js"></script>
    <script src="{{ asset('customer')}}/js/jquery.magnific-popup.min.js"></script>
    <script src="{{ asset('customer')}}/js/jquery.countdown.min.js"></script>
    <script src="{{ asset('customer')}}/js/jquery.slicknav.js"></script>
    <script src="{{ asset('customer')}}/js/mixitup.min.js"></script>
    <script src="{{ asset('customer')}}/js/owl.carousel.min.js"></script>
    <script src="{{ asset('customer')}}/js/main.js"></script>
</body>

</html>