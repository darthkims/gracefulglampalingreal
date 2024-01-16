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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/brands.min.css" type="text/css">


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
            <p>Flat rate shipping, 30-day return or refund guarantee.</p>
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
                            <p>Flat rate shipping, 30-day return or refund guarantee.</p>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-5">
                        <div class="header__top__right">
                            <div class="header__top__links">                                
                            <form method="POST" action="{{ route('logout') }}" class="d-none" id="logout-form">
                                @csrf
                            </form>
                            <a href="javascript:;" class="offcanvas__links">
                                @php
                                    $user=Auth::user();
                                @endphp
                                <span class="d-sm-inline d-none">Welcome! {{$user->name}}</span>
                                <i class="fa fa-user me-sm-1"></i>
                                <span class="d-sm-inline d-none" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    SignOut</span>
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

                @php
                    use Illuminate\Support\Facades\Auth;

                    // Retrieve the currently logged-in user
                    $user = Auth::user();

                    // Check if the user is logged in
                    if ($user && $user->cart) {
                        // Access the user's cart and retrieve the products
                        $products = $user->cart->products;
                    
                        // Initialize the cart subtotal
                        $cartSubTotal = 0;
                    
                        // Iterate through each product in the cart and calculate the subtotal
                        foreach ($products as $product) {
                            $cartSubTotal += $product->price * $product->pivot->quantity;
                        }
                    
                        // Now $cartSubTotal contains the sum of all product totals in the user's cart
                        // You can use $cartSubTotal as needed
                    } else {
                        // Handle the case when the user is not logged in or has no cart
                        $products = collect(); // Create an empty collection if there is no user or cart
                        $cartSubTotal = 0; // Set the cart subtotal to 0                        
                    }
                @endphp

                
                <div class="col-lg-3 col-md-3">
                    <div class="header__nav__option">
                        <div class="dropdown">
                        <a class="btn dropdown-toggle" href="#" role="button" id="profileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa-regular fa-user fa-lg"></i>
                        </a>
                    <div class="dropdown-menu" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="{{ route('cust.edit')}}">Edit Profile</a>
                        <a class="dropdown-item" href="{{ route('cust.orders')}}">Order History</a>
                    </div>
                </div>
                    <a href="{{ route('cart.index') }}"><img src="{{ asset('customer')}}/img/icon/cart.png" alt="">
                        <span class="badge badge-pill badge-danger text-white">
                        @if ($products->count() > 0)
                            {{ $products->count() }}
                        @else
                            0
                        @endif
                        </span>
                    </a>
                    <div class="price">RM {{ number_format($cartSubTotal, 2) }}</div>
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