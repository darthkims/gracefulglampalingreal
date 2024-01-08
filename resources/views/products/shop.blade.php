<x-head_header activePage="shop" bodyClass="g-sidenav-show  bg-gray-200">

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shop</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route('main')}}">Home</a>
                            <span>Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="shop__sidebar">
                        <div class="shop__sidebar__search">
                            <form action="#">
                                <input type="text" placeholder="Search...">
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
                        </div>
                        <div class="shop__sidebar__accordion">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseOne">Categories</a>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__categories">
                                                <ul class="nice-scroll">
                                                    @forelse($categories as $index => $category)
                                                        <li><a href="#">{{ $category->name }} ({{ $category->product_count }})</a></li>
                                                    @empty
                                                        <li><a href="#">No categories found</a></li>
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseFour">Size</a>
                                    </div>
                                    <div id="collapseFour" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__size">
                                                @forelse($sizes as $index => $size)
                                                    <label for="{{ $size->name }}">{{ $size->name }}
                                                        <input type="radio" id="{{ $size->name }}">
                                                    </label>
                                                @empty
                                                    <p>No sizes found</p>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="shop__product__option">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__left">
                                    <p>{{ count($products) }} results</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__right">
                                    <p>Sort by Price:</p>
                                    <select>
                                        <option value="">Low To High</option>
                                        <option value="">$0 - $55</option>
                                        <option value="">$55 - $100</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>                   
                    <div class="row">
                    @foreach ($products as $product)
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                @php 
                                    $imagePath = asset("customer/img/product/product-{$product->id}.jpg");
                                @endphp
                                <a href="{{ route('products.display',$product->id) }}">
                                    <div class="product__item__pic set-bg" data-setbg="{{ $imagePath }}">
                                        <!-- Additional product display elements can be added here -->
                                    </div>
                                </a>
                                <div class="product__item__text">
                                    <h6>{{ $product->name }}</h6>
                                    <a href="{{ route('login') . '?prev=shop' }}" class="add-cart">+ Add To Cart</a>
                                    <div class="rating">
                                        <!-- Display product rating here -->
                                    </div>
                                    <h5>RM{{ $product->price }}</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->

</x-head_header>