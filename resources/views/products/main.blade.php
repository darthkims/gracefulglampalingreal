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
            <div class="hero__items set-bg" data-setbg="{{ asset('customer')}}/img/hero/hero-1.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 col-md-8">
                            <div class="hero__text">
                                <h6>Summer Collection</h6>
                                <h2>Fall - Winter Collections 2030</h2>
                                <p>A specialist label creating luxury essentials. Ethically crafted with an unwavering
                                commitment to exceptional quality.</p>
                                <a href="http://gracefulglampalingreal.test/gracefulglampalingreal/public/shop?category=7" class="primary-btn" >SHOP MEN <span class="arrow_right"></span></a>
                                <a href="http://gracefulglampalingreal.test/gracefulglampalingreal/public/shop?category=8" class="primary-btn" >SHOP WOMEN <span class="arrow_right"></span></a>
                                
                                        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
    <!-- Hero Section End -->

    

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="filter__controls">
                        <li class="active" data-filter=".best-sellers">Best Sellers</li>
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
                                        <button type="submit" class="add-cart">+ Add To Cart</button>
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
                                        <button type="submit" class="add-cart">+ Add To Cart</button>
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
                        <h2> <br /> <span>Shoe Collection</span> <br /> </h2>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="categories__hot__deal">
                    <img src="http://gracefulglampalingreal.test/gracefulglampalingreal/public/storage/thumb-1-1.jpg" alt="Product Image">
                        <div class="hot__deal__sticker">
                            <span>Sale Of</span>
                            <h5>RM479.00</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-1">
                    <div class="categories__deal__countdown">
                        <span>Deal Of The Month</span>
                        <h2>Nike Blazer Mid 77 Jumbo</h2>
                        <div class="categories__deal__countdown__timer" id="countdown">
                            
                        </div>
                        <a href="http://gracefulglampalingreal.test/gracefulglampalingreal/public/products/details/1" class="primary-btn">Shop now</a>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    

    
<x-customer_footer activePage="main" bodyClass="g-sidenav-show bg-gray-200">
</x-customer_footer>