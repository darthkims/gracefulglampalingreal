@auth
    <x-customer_header activePage="shop" bodyClass="g-sidenav-show bg-gray-200">
        <!-- Authenticated User Header Content Goes Here -->
    </x-customer_header>
@else
    <x-head_header activePage="shop" bodyClass="g-sidenav-show bg-gray-200">
        <!-- Guest Header Content Goes Here -->
    </x-head_header>
@endauth
    <!-- Shop Details Section Begin -->

    <section class="shop-details">
        <div class="product__details__pic">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__breadcrumb">
                            <a href="{{ route('main')}}">Home</a>
                            <a href="{{ route('cust.products.index')}}">Shop</a>
                            <span>Product Details</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">
                                    <div class="product__thumb__pic set-bg" data-setbg="{{ asset('customer/img/shop-details/thumb-1-' . $product-> id . '.jpg') }}">
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">
                                    <div class="product__thumb__pic set-bg" data-setbg="{{ asset('customer/img/shop-details/thumb-2-' . $product-> id . '.jpg') }}">
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">
                                    <div class="product__thumb__pic set-bg" data-setbg="{{ asset('customer/img/shop-details/thumb-3-' . $product-> id . '.jpg') }}">
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab">
                                    <div class="product__thumb__pic set-bg" data-setbg="{{ asset('customer/img/shop-details/thumb-4-' . $product-> id . '.jpg') }}">
                                    </div>
                                </a>
                            </li> 
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-9">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__pic__item">
                                <img src="{{ asset('customer/img/shop-details/thumb-1-' . $product-> id . '.jpg') }}" alt="Product Image">
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__pic__item">
                                <img src="{{ asset('customer/img/shop-details/thumb-2-' . $product-> id . '.jpg') }}" alt="Product Image">
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__pic__item">
                                <img src="{{ asset('customer/img/shop-details/thumb-3-' . $product-> id . '.jpg') }}" alt="Product Image">
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-4" role="tabpanel">
                                <div class="product__details__pic__item">
                                <img src="{{ asset('customer/img/shop-details/thumb-4-' . $product-> id . '.jpg') }}" alt="Product Image">
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product__details__content">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="product__details__text">
                            <h4>{{ $product->name }}</h4>
                            <h3>RM{{ $product-> price }}</h3>
                            <div class="product__details__option">
                                <div class="product__details__option__color">
                                    <span>Category: 
                                        @if ($product->categories)
                                            @forelse ($product->categories as $category)
                                                {{ $category->name }}
                                            @empty
                                                No categories
                                            @endforelse
                                        @else
                                            No categories
                                        @endif
                                    </span>
                                </div>
                                <div class="product__details__option__color">
                                    <span>Size: 
                                        @if ($product->sizes)
                                            @forelse ($product->sizes as $size)
                                                {{ $size->name }}
                                            @empty
                                                No sizes
                                            @endforelse
                                        @else
                                            No sizes
                                        @endif
                                    </span>
                                </div>
                                <br>
                                <div class="product__details__option__color">
                                    <span>Brand: 
                                        @if ($product->brands)
                                            @forelse ($product->brands as $brand)
                                                {{ $brand->name }}
                                            @empty
                                                No brands
                                            @endforelse
                                        @else
                                            No brands
                                        @endif
                                    </span>
                                </div>
                                <div class="product__details__option__color">
                                    <span>Color: 
                                        @if ($product->colors)
                                            @forelse ($product->colors as $color)
                                                {{ $color->name }}
                                            @empty
                                                No colors
                                            @endforelse
                                        @else
                                            No colors
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="product__details__cart__option">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" value="1">
                                    </div>
                                </div>
                                <a href="#" class="primary-btn">add to cart</a>
                            </div>
                            <br>
                            <div class="product__details__last__option">
                                <h5><span>Guaranteed Safe Checkout</span></h5>
                                <img src="{{ asset('customer')}}/img/shop-details/details-payment.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-5"
                                    role="tab">Description</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <p class="note">{{ $product-> description}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Details Section End -->

    <!-- Related Section Begin -->
    <section class="related spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="related-title">Something you might find amazing</h3>
                </div>
            </div>
            <div class="row">
                <div class="row">
                    @foreach($randomIds as $randomId)
                        <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                            <div class="product__item">
                                <?php
                                    $random = App\Models\Product::find($randomId);
                                ?>
                                <a href="{{ route('cust.products.display', $random ->id) }}"> <!-- Set your product details route -->
                                    <div class="product__item__pic set-bg" data-setbg="{{ asset('customer/img/shop-details/thumb-1-' . $random ->id . '.jpg') }}">
                                    </div>
                                    <div class="product__item__text">
                                        <a href="#" class="add-cart">+ Add To Cart</a>
                                        <h6>{{ $random ->name }}</h6>
                                        <h5>RM{{ $random ->price }}</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Related Section End -->
<x-customer_footer activePage="shop" bodyClass="g-sidenav-show bg-gray-200">
</x-customer_footer>