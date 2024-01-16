<x-customer_header activePage="" bodyClass="g-sidenav-show bg-gray-200">
        <!-- Authenticated User Header Content Goes Here -->
</x-customer_header>

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form action="{{ route('session') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
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
                                    <li>Subtotal <span>RM{{number_format($order->sub_total, 2)}}</span></li>
                                    <li>Delivery <span>RM10.00</span></li>
                                    <li>Total (Service Fee 10%)<span>RM{{ number_format($order->grand_total, 2)}}</span></li>
                                </ul>
                                <input type="hidden" value="{{ $order->grand_total }}" name="total">
                                <input type="hidden" value="{{ request()->orderId }}" name="orderId">
                                <button type="submit" class="site-btn">PAY NOW</button>
                            </div>
                        </div>
                    </div>
                </form>
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