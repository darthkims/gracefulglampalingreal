<x-customer_header activePage="" bodyClass="g-sidenav-show  bg-gray-200">
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shopping Cart</h4>
                        <div class="breadcrumb__links">
                            <a href="{{route('main')}}">Home</a>
                            <a href="{{route('cust.products.index')}}">Shop</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            @if(session('success'))
                <div id="success-alert" class="alert alert-success fade show text-center">
                    {{ session('success') }}
                </div>

                <script>
                    // Add fade-out effect using Bootstrap's transition class
                    setTimeout(function(){
                        $("#success-alert").removeClass('show');
                    }, 5000); // Adjust the duration (in milliseconds) to fit your desired fade-out speed
                </script>
            @endif

            <div class="row">
                <div class="col-lg-8">
                    <div class="shopping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @if (count($products) > 0)
                            @foreach ($products as $product)
                                <tr>
                                    
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__pic">
                                            <img src="{{ asset("storage/$product->productimg") }}" alt="" style="width: 100px;"">
                                        </div>
                                        <div class="product__cart__item__text">
                                            <h6>{{ $product->name }}</h6>
                                            <h5>RM{{ $product->price }}</h5>
                                        </div>
                                    </td>
                                    <td class="quantity__item">
                                        <div class="quantity">
                                        <div class="pro-qty-2">
                                                <input type="text" value="{{ $product->pivot->quantity }}">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="cart__price">
                                    @php
                                        $productTotal = $product->price * $product->pivot->quantity;
                                    @endphp
                                    RM{{ number_format($productTotals[$product->id], 2) }}
                                    </td>
                                    <td class="cart__close">
                                        <form action="{{ route('cart.remove', ['productId' => $product->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="border: none; border-radius: 40%;"><i class="fa fa-close"></i></button>
                                        </form>
                                    </td>                                    
                                </tr>
                                @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">No products in the cart</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="{{route('cust.products.index')}}">Continue Shopping</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn update__btn">
                                <a href="#"  id="update-cart-btn"><i class="fa fa-spinner"></i> Update cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart__discount">
                        <h6>Discount codes</h6>
                        <form id="apply-promo-form" method="post">
                            @csrf
                            <input type="text" name="promo_code" placeholder="Coupon code" id="promo-code-input">
                            <button type="submit" @if(empty(session('cart.products'))) @endif>Apply</button>
                        </form>
                    </div>
                    <div class="cart__total">
                        <h6>Cart total</h6>
                        <ul>
                            <li>Subtotal<span>RM{{number_format($cartSubTotal, 2)}}</span></li>
                            <li>Total<span>Calculated In Checkout</span></li>
                        </ul>
                        <a href="{{ count($products) > 0 ? route('checkout') : '#' }}" class="primary-btn"
                            style="@if (count($products) == 0) background-color: #d3d3d3; color: #808080; cursor: not-allowed; pointer-events: none; @endif">
                            Proceed to checkout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->

</x-customer_header>