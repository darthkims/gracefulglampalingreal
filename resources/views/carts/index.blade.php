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
    <form id="update-cart-form" action="{{ route('cart.update') }}" method="POST">
    @csrf
    @method('PATCH')


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
            
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="continue__btn update__btn">
                <a type="button" id="update-cart-btn" style="@if (count($products) == 0) background-color: #d3d3d3; color: #808080; cursor: not-allowed; pointer-events: none; @endif">
                    <i class="fa fa-spinner"></i> Update cart</a>
                </div>
            </div>

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
                                            <a href="{{ route('cust.products.display', $product->id) }}" class="product__cart__item__link">
                                            <img src="{{ asset("storage/$product->productimg") }}" style="width: 100px;">
                                            </a>

                                        </div>
                                        <div class="product__cart__item__text">
                                            <h6>{{ $product->name }}</h6>
                                            <h5>RM{{ $product->price }}</h5>
                                        </div>
                                </td>
                                    <td class="quantity__item">
                                        <div class="quantity">
                                            <div>
                                            <span class="qty-btn qty-dec" onclick="updateQuantity(this, -1, '{{ $product->id }}')"><i class="fa fa-minus"></i></span>
<input type="text" value="{{ $product->pivot->quantity }}" style="width: 50px; text-align: center; border-radius: 10px;" id="quantityInput_{{ $product->id }}">
<span class="qty-btn qty-inc" onclick="updateQuantity(this, 1, '{{ $product->id }}')"><i class="fa fa-plus"></i></span>

                                            </div>
                                        </div>
                                    </td>
                                    </form>
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
                        <!-- <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn update__btn">
                            <button type="button" id="update-cart-btn"><i class="fa fa-spinner"></i> Update cart</button>
                            </div>
                        </div> -->
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Add event listener to the "Update Cart" button
        document.getElementById('update-cart-btn').addEventListener('click', function () {
            // Gather updated quantities and submit the form
            updateCart();
        });
    });

    function updateQuantity(element, value, productId) {
        // Get the input field using the product id
        var inputField = document.getElementById('quantityInput_' + productId);

        // Get the current quantity value
        var currentValue = parseInt(inputField.value);

        // Update the quantity value based on the button clicked
        var newValue = currentValue + value;

        // Ensure the quantity doesn't go below 0
        newValue = Math.max(0, newValue);

        // Update the input field value
        inputField.value = newValue;
    }

    function updateCart() {
    // Remove existing hidden input fields
    var existingHiddenInputs = document.querySelectorAll('input[name^="quantities["]');
    existingHiddenInputs.forEach(function (input) {
        input.remove();
    });

    // Iterate through each product row and add the quantity to the form
    @foreach ($products as $product)
        var productId = '{{ $product->id }}';
        var inputField = document.getElementById('quantityInput_' + productId);
        var quantity = inputField.value;

        // Create a hidden input field dynamically
        var hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'quantities[' + productId + ']';
        hiddenInput.value = quantity;

        // Append the hidden input to the form
        document.getElementById('update-cart-form').appendChild(hiddenInput);
    @endforeach

    // Temporarily disable the delete buttons
    var deleteButtons = document.querySelectorAll('button[name^="deleteProduct"]');
    deleteButtons.forEach(function (button) {
        button.disabled = true;
    });

    // Submit the form
    document.getElementById('update-cart-form').submit();

    // Enable the delete buttons after form submission
    setTimeout(function () {
        deleteButtons.forEach(function (button) {
            button.disabled = false;
        });
    }, 500); // Adjust the duration (in milliseconds) based on your needs
}


</script>


<x-customer_footer activePage="" bodyClass="g-sidenav-show bg-gray-200">
</x-customer_footer>