@auth
    <x-customer_header activePage="main" bodyClass="g-sidenav-show bg-gray-200">
        <!-- Authenticated User Header Content Goes Here -->
    </x-customer_header>
@else
    <x-head_header activePage="main" bodyClass="g-sidenav-show bg-gray-200">
        <!-- Guest Header Content Goes Here -->
    </x-head_header>
@endauth

    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="hero__slider owl-carousel">
            <div class="hero__items set-bg" data-setbg="{{ asset('customer')}}/img/hero/bannermenwomen.png">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 col-md-8">
                            <div class="hero__text">
                                <h6>Grand Opening</h6>
                                <h2 style="color: white;">Provide Personal Shopper Service</h2>
                                <p style="color: white;">
                                    We sell limited and authentic products from all range. 
                                    Discover unparalleled elegance and authenticity at our shop, where limited and 
                                    carefully curated products across a diverse range await to add a touch of 
                                    exclusivity to every facet of your life.
                                </p>
                                <a href="{{route('cust.products.index', ['category' => 7])}}" class="primary-btn" >SHOP MEN <span class="arrow_right"></span></a>
                                <a href="{{route('cust.products.index', ['category' => 8])}}" class="primary-btn" >SHOP WOMEN <span class="arrow_right"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero__items set-bg" data-setbg="{{ asset('customer')}}/img/hero/newjeans-levi.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 col-md-8">
                            <div class="hero__text">
                                <h6>Levi's Newjeans</h6>
                                <h2 style="color: white;">Grab your favourite idol jeans</h2>
                                <p style="color: white;">Elevate your style to K-pop chic with our fashion-forward jeans, the same iconic denim worn by your favorite idols, blending trendsetting designs with unparalleled comfort for an effortlessly cool look.</p>
                                <a href="{{route('cust.products.index', ['category' => 2])}}" class="primary-btn" >SHOP PANTS <span class="arrow_right"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero__items set-bg" data-setbg="{{ asset('customer')}}/img/hero/newjeans-2.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 col-md-8 text-right">
                            <div class="hero__text">
                            <h6>Elevate Your Style: Summer Edition</h6>
                            <h2>Unveiling Fall - Winter Collections 2024</h2>
                            <p>Discover an exclusive label dedicated to crafting luxury essentials. Our creations embody a steadfast commitment to exceptional quality and ethical craftsmanship.</p>

                                <a href="{{route('cust.products.index', ['category' => 6])}}" class="primary-btn" >SHOP SHIRTS <span class="arrow_right"></span></a>
                                <a href="{{route('cust.products.index', ['category' => 2])}}" class="primary-btn" >SHOP PANTS <span class="arrow_right"></span></a>
                              
                                        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <br>

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="filter__controls">
                        <li class="active" data-filter=".best-sellers">Best Selling</li>
                        <li data-filter=".new-arrivals">New Arrivals</li>
                        
                    </ul>
                </div>
            </div>
            <div id="top" class="row product__filter">
                @foreach($topProducts as $product)
                <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix best-sellers">
                    <div class="product__item">
                        <a href="{{ route('cust.products.display',$product->id) }}">
                            <div class="product__item__pic set-bg" data-setbg="{{ asset("storage/$product->productimg")}}">
                                <span class="label">BEST</span>
                            </div>
                        </a>
                        <div class="product__item__text">
                            <h6>{{ $product->name }}</h6>
                            <form method="POST" action="{{ route('addToCart', ['productId' => $product->id]) }}">
                                        @csrf
                                        <!-- Other form fields or data -->
                                        <button type="submit" class="add-cart" style="background-color: black; color: white; border-radius: 10px;">+ Add To Cart</button>
                                    </form>
                            <h5>RM{{ $product->price }}</h5>
                        </div>
                    </div>
                </div>
                @endforeach
                @foreach($newProducts as $product)
                <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">
                    <div class="product__item">
                        <a href="{{ route('cust.products.display',$product->id) }}">
                            <div class="product__item__pic set-bg" data-setbg="{{ asset("storage/$product->productimg")}}">
                                <span class="label">NEW</span>
                            </div>
                        </a>
                        <div class="product__item__text">
                            <h6>{{ $product->name }}</h6>
                            <form method="POST" action="{{ route('addToCart', ['productId' => $product->id]) }}">
                                        @csrf
                                        <!-- Other form fields or data -->
                                        <button type="submit" class="add-cart" style="background-color: black; color: white; border-radius: 10px;">+ Add To Cart</button>
                                    </form>
                            <h5>RM{{ $product->price }}</h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            
        </div>
    </section>
    <!-- Product Section End -->

    <!-- Categories Section Begin -->
    <section class="categories spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="categories__text">
                        <h2> <br /> <span>Limited Quantity</span> <br /> </h2>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="categories__hot__deal">
                    <img src="{{ asset("storage/$product->productimg") }}" alt="Product Image">
                        <div class="hot__deal__sticker">
                            <span>Sale Of</span>
                            <h5>RM{{$product->price}}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-1">
                    <div class="categories__deal__countdown">
                        <span>Deal Of The Month</span>
                        <h2>{{$product->name}}</h2>
                        <!-- <div class="categories__deal__countdown__timer" id="countdown">
                            
                        </div> -->
                        <a href={{route('cust.products.display', ['product' => $product->id])}} class="primary-btn">Shop now</a>
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    

    
<x-customer_footer activePage="main" bodyClass="g-sidenav-show bg-gray-200">
</x-customer_footer>