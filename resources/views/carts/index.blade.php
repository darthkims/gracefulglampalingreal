<x-customer_header activePage="main" bodyClass="g-sidenav-show  bg-gray-200">
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shopping Cart</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.html">Home</a>
                            <a href="./shop.html">Shop</a>
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
                                @php
                                    $subtotal = 0;
                                    $cartProducts = session('cart.products');
                                @endphp
                                @if ($cartProducts)
                                    {{-- {{ dd(session('cart')->toArray()) }} --}}
                                    {{-- {{ dd($cartProducts->toArray()) }} --}}
                                    @foreach ($cartProducts as $product)
                                        <tr>
                                            <td class="product__cart__item">
                                                <div class="product__cart__item__pic">
                                                    <img src="img/shopping-cart/cart-1.jpg" alt="">
                                                </div>
                                                <div class="product__cart__item__text">
                                                    <h6>{{ $product->name }}</h6>
                                                    <h5>{{ number_format($product->price, 2) }}</h5>
                                                </div>
                                            </td>
                                            <td class="quantity__item">
                                                <div class="quantity">
                                                    <div class="pro-qty-2">
                                                        <input type="text" class="update-quantity" data-product-id="{{ $product->id }}" value="{{ $product->pivot->quantity }}" min="1">
                                                        {{-- <input type="text" value="{{ $product->pivot->quantity }}"> --}}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="cart__price">{{ number_format($product->price * $product->pivot->quantity, 2) }}</td>
                                            <td class="cart__close">
                                                <i class="fa fa-close" data-product-id="{{ $product->id }}" id="remove-from-cart-btn"></i>
                                            </td>
                                        </tr>
                                        @php
                                            $subtotal += $product->price * $product->pivot->quantity;
                                        @endphp
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">No products in cart.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="#">Continue Shopping</a>
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
                            <button type="submit" @if(empty(session('cart.products'))) disabled @endif>Apply</button>
                        </form>
                    </div>
                    <div class="cart__total">
                        <h6>Cart total</h6>
                        <ul>
                            @php
                                $total = 0;

                                if (session('cart')) {
                                    $cart = session('cart');
                                    $promoCode = $cart->promoCode;

                                    if ($promoCode) {
                                        $discount = $promoCode->discount / 100;
                                        $total = $subtotal - ($subtotal * $discount);
                                    } else {
                                        $total = $subtotal;
                                    }
                                }

                            @endphp
                            <li>Subtotal <span>RM {{ number_format($subtotal, 2) }}</span></li>
                            <li>Total <span>RM {{ number_format($total, 2) }}</span></li>
                        </ul>
                        <a href="#" class="primary-btn" @if(empty(session('cart.products'))) onclick="return false;" @endif>Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->

    <script>
        $(document).ready(function () {
            $('#update-cart-btn').on('click', function () {
                // Check if the cart is empty
                if ({{ empty(session('cart.products')) ? 'true' : 'false' }}) {
                    alert('Cart is empty. Update is disabled.');
                    return false;
                }

                let products = {};

                // Get updated quantities for each product in the cart modal
                $('.update-quantity').each(function () {
                    let productId = $(this).data('product-id');
                    let quantity = $(this).val();
                    products[productId] = quantity;
                });

                // Send Ajax request to update the cart
                $.ajax({
                    type: 'PATCH',
                    url: '/update-cart',
                    data: {
                        cart_id: '{{ $cart->id ?? 0 }}',
                        products: products,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function (response) {
                        alert(response.success);
                        // Reload the page after successful update
                        window.location.reload(true);
                    },
                    error: function (error) {
                        alert('Error updating cart. Please try again.');
                    },
                });
            });

            $('#apply-promo-form').submit(function (e) {
                e.preventDefault();

                let promoCode = $('#promo-code-input').val();

                $.ajax({
                    type: 'POST',
                    url: '/apply-promo', // Update this to match your Laravel route
                    data: {
                        cart_id: '{{ $cart->id ?? 0 }}',
                        promo_code: promoCode,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function (response) {
                        alert(response.success);
                        window.location.reload(true);
                    },
                    error: function (error) {
                        alert('Error applying promo code. Please try again.');
                    },
                });
            });

            $('#remove-from-cart-btn').on('click', function () {
                let productId = $(this).data('product-id');

                $.ajax({
                    type: 'DELETE',
                    url: '/remove-cart',
                    data: {
                        cart_id: '{{ $cart->id ?? 0 }}',
                        product_id: productId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        alert(response.success);
                        // Reload the page or update the cart display as needed
                        location.reload(true);
                    },
                    error: function (error) {
                        alert('Error removing product from cart. Please try again.');
                    },
                });
            });
        });
    </script>
</x-customer_header>