<x-customer_header activePage="" bodyClass="g-sidenav-show bg-gray-200">
  <!-- Authenticated User Header Content Goes Here -->
</x-customer_header>

<div class="container">
  <div class="checkout__form">
    @if (session('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('message') }}
    </div>
    @endif

    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-4 col-sm-6">
          <div class="about__item">
            <h6 class="checkout__title">Order History</h6>
            
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th
                      class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                      #
                    </th>
                    <th
                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Order Number</th>
                    <th
                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                        Products</th>
                    <th
                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Total</th>
                    <th
                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Status</th>
                    <th class="text-secondary opacity-7">

                    </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($orders as $index => $order)
                    <tr>
                      <td>
                        {{ $index + 1 }}
                      </td>
                      <td>
                          <p class="text-xs font-weight-bold mb-0">{{ $order->order_number }}</p>
                      </td>
                      <td>
                          @foreach ($order->products as $index => $product )
                            <p>
                              {{ $index + 1 }}. {{ $product->name }} ({{ $product->pivot->quantity }})
                            </p>
                          @endforeach
                      </td>
                      <td class="align-middle text-center text-sm">
                          RM {{ number_format($order->productTotal, 2) }}
                      </td>
                      <td class="align-middle text-center">
                          @if ($order->status == 'pending')
                            <span class="badge bg-warning">Pending Payment</span>
                          @elseif ($order->status == 'processing')
                            <span class="badge bg-info">Processing</span>
                          @elseif ($order->status == 'completed')
                            <span class="badge bg-success">Completed</span>
                          @endif
                      </td>
                      <td class="align-middle">
                        <a href="{{ route('checkout') }}" class="btn btn-danger btn-sm">Pay Now</a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<x-customer_footer activePage="" bodyClass="g-sidenav-show bg-gray-200">
</x-customer_footer>