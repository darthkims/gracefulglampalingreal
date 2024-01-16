<x-customer_header activePage="" bodyClass="g-sidenav-show bg-gray-200">
        <!-- Authenticated User Header Content Goes Here -->
</x-customer_header>

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <!-- <h6 class="coupon__code"><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click
                            here</a> to enter your code</h6> -->
                            <h6 class="checkout__title">Billing Details</h6>
                            <div class="checkout__input">
                                <p>Full Name<span>*</span></p>
                                <input style="color: black;" type="text" value="{{$user->name}}" required>
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" style="color: black;" value="{{$user->location}}" required>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input style="color: black;" type="text" value="{{$user->phone}}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input style="color: black;" type="text" value="{{$user->email}}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title">Your order</h4>
                                <div class="checkout__order__products">Product <span>Total</span></div>
                                <ul class="checkout__total__products">
                                @if (count($products) > 0)
                                    @foreach ($products as $product)
                                    <li>{{ $loop->iteration }}. {{ $product->name }} (x{{$product->pivot->quantity}})<span>RM{{ number_format($product->price * $product->pivot->quantity, 2) }}</span></li>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">No products in the cart</td>
                                    </tr>
                                @endif
                                </ul>
                                <ul class="checkout__total__all">
                                    <li>Subtotal <span>RM{{number_format($cartSubTotal, 2)}}</span></li>
                                    <li>Delivery <span>RM10.00</span></li>
                                    <li>Total (Service Fee 10%)<span>RM{{ number_format($cartTotal, 2)}}</span></li>
                                </ul>
                                <a href="{{ count($products) > 0 ? route('checkout.redirect') : '#' }}" class="primary-btn">PLACE ORDER</a>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

    <script>
        function validateForm() {
            var inputs = document.getElementsByTagName("input");

            for (var i = 0; i < inputs.length; i++) {
                if (inputs[i].hasAttribute("required") && inputs[i].value.trim() === "") {
                    alert("Please fill in all the required fields.");
                    return false;
                }
            }

            return true;
        }
    </script>

<x-customer_footer activePage="" bodyClass="g-sidenav-show bg-gray-200">
</x-customer_footer>