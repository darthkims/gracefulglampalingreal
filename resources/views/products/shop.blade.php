@auth
    <x-customer_header activePage="shop" bodyClass="g-sidenav-show bg-gray-200">
        <!-- Authenticated User Header Content Goes Here -->
    </x-customer_header>
@else
    <x-head_header activePage="shop" bodyClass="g-sidenav-show bg-gray-200">
        <!-- Guest Header Content Goes Here -->
    </x-head_header>
@endauth

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
                        <div class="shop__sidebar__accordion">
                            <div class="accordion" id="accordionExample">
                                <!-- Categories Section -->
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseOne">Categories</a>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__categories">
                                                <ul class="nice-scroll">
                                                    <li>
                                                        <a href="{{ route('cust.products.index', ['brand' => $selectedBrand, 'size' => $selectedSize, 'sort' => request('sort')]) }}#lepassortpergisini">
                                                            All Categories
                                                        </a>
                                                    </li>
                                                    @forelse($categories as $index => $category)
                                                        <li>
                                                            <a href="{{ route('cust.products.index', ['category' => $category->id, 'brand' => $selectedBrand, 'size' => $selectedSize, 'sort' => request('sort')]) }}#lepassortpergisini"
                                                               style="{{ $category->id == $selectedCategory ? 'font-weight: bold;' : '' }}">
                                                                {{ $category->name }} ({{ $category->product_count }})
                                                            </a>
                                                        </li>
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
                                        <a data-toggle="collapse" data-target="#collapseTwo">Branding</a>
                                    </div>
                                    <div id="collapseTwo" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__categories">
                                                <ul class="nice-scroll">
                                                    <li>
                                                        <a href="{{ route('cust.products.index', ['category' => $selectedCategory, 'size' => $selectedSize, 'sort' => request('sort')]) }}#lepassortpergisini">
                                                            All Brands
                                                        </a>
                                                    </li>
                                                    @forelse($brands as $index => $brand)
                                                        <li>
                                                            <a href="{{ route('cust.products.index', ['category' => $selectedCategory, 'brand' => $brand->id, 'size' => $selectedSize, 'sort' => request('sort')]) }}#lepassortpergisini"
                                                            style="{{ $brand->id == $selectedBrand ? 'font-weight: bold;' : '' }}">
                                                                {{ $brand->name }} ({{ $brand->product_count }})
                                                            </a>
                                                        </li>
                                                    @empty
                                                        <li><a href="#">No brands found</a></li>
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseThree">Size</a>
                                    </div>
                                    <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__size">
                                                <label for="">
                                                    <a href="{{ route('cust.products.index', ['category' => $selectedCategory, 'brand' => $selectedBrand, 'sort' => request('sort')]) }}#lepassortpergisini"
                                                       style="color: black;"
                                                       class="">
                                                        All Size
                                                    </a>
                                                    <input type="radio" id="" name="" value=""
                                                           >
                                                </label>
                                                @forelse($sizes as $size)
                                                    <label for="size_{{ $size->id }}">
                                                        <a href="{{ route('cust.products.index', ['category' => $selectedCategory, 'brand' => $selectedBrand, 'size' => $size->id, 'sort' => request('sort')]) }}#lepassortpergisini"
                                                           style="color: black;"
                                                           class="{{ $size->id == $selectedSize ? 'active' : '' }}">
                                                            {{ $size->name }} ({{ optional($size->products)->count() ?? 0 }})
                                                        </a>
                                                        <input type="radio" id="size_{{ $size->id }}" name="size" value="{{ $size->id }}"
                                                               {{ $size->id == $selectedSize ? 'checked' : '' }}>
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
                    <div id="lepassortpergisini" class="shop__product__option">
                    <h2><b>Shop our freshest item!<b></h2>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__left">
                                    <p>{{ count($products) }} results</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__right">
                                    <p>Sort by Price:</p>
                                    <form action="{{ route('cust.products.index') }}#lepassortpergisini" method="GET">
                                        <input type="hidden" name="category" value="{{ $selectedCategory }}">
                                        <input type="hidden" name="brand" value="{{ $selectedBrand }}">
                                        <input type="hidden" name="size" value="{{ $selectedSize }}">
                                        
                                        <select name="sort" onchange="this.form.submit()">
                                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                                            <option value="low_to_high" {{ request('sort') == 'low_to_high' ? 'selected' : '' }}>Low To High</option>
                                            <option value="high_to_low" {{ request('sort') == 'high_to_low' ? 'selected' : '' }}>High To Low</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>                   
                    <div class="row">
                    @foreach ($products as $product)
                        @if (!$selectedCategory || $product->categories->contains('id', $selectedCategory))
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <a href="{{ route('cust.products.display',$product->id) }}">
                                    <div class="product__item__pic set-bg" data-setbg="{{ asset("storage/$product->productimg") }}">
                                        <!-- Additional product display elements can be added here -->
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
                                    <!-- Set default quantity to 1 -->
                                    <input type="number" id="quantityInput_{{ $product->id }}" value="1" style="display: none;">
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->

<script>
    $(document).ready(function () {
        $('.add-to-cart-btn').on('click', function () {
            let productId = $(this).data('product-id');
            let quantity = $('#quantityInput_' + productId).val();

            console.log(quantity);

            $.ajax({
                type: 'POST',
                url: '/add-to-cart',
                data: {
                    product_id: productId,
                    quantity: quantity,
                    _token: '{{ csrf_token() }}',
                },
                success: function (response) {
                    alert(response.success);
                },
                error: function (error) {
                    alert(error.responseJSON.error);
                },
            });
        });
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<x-customer_footer activePage="shop" bodyClass="g-sidenav-show bg-gray-200">
</x-customer_footer>