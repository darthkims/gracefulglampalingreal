<x-customer_header activePage="" bodyClass="g-sidenav-show bg-gray-200">
  <!-- Authenticated User Header Content Goes Here -->
</x-customer_header>

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Order History</h4>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <br>
    <!-- Breadcrumb Section End -->

<div class="container">
  <div class="checkout__form">
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
    </div>
    @endif

    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-4 col-sm-6">
          <div class="about__item">
            <h6 class="checkout__title">Order History</h6>
            
            <div class="table-responsive p-0">
            @if (count($orders) > 0)
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
                        Payment Status</th>
                      <th
                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Order Status</th>
                    <th
                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Store</th>
                    <th class="text-secondary opacity-7">
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
                              {{ $index + 1 }}. {{ $product->name }} (x{{ $product->pivot->quantity }})
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
                            <span class="badge bg-success" style="color: white;">Completed</span>
                          @endif
                      </td>
                      <td class="align-middle text-center">
                        @if ($order->order_status == 'To Pay' || $order->order_status == 'PREPARING')
                          <span class="badge bg-warning">{{$order->order_status}}</span>
                        @elseif ($order->order_status == 'To Ship' || $order->order_status == 'SHIPPED')
                          <span class="badge bg-info" style="color: white;">{{$order->order_status}}</span>
                        @elseif ($order->order_status == 'Delivered' || $order->order_status == 'DELIVERED')
                          <span class="badge bg-success" style="color: white;">{{$order->order_status }}</span>
                        @endif  
                      </td>
                      <td class="align-middle text-center text-sm">
                        @forelse ($order->products as $index => $product)
                          <p>
                              {{ $index + 1 }}. {{ $product->location->name ?? 'No store available' }}
                          </p>
                        @empty
                          <p>No store available</p>
                        @endforelse
                      </td>
                      <td class="align-middle">
                        @if ($order->status == 'pending')
                          <a href="{{ route('checkout', ['orderId' => $order->id]) }}" class="btn btn-info btn-sm text-sm">Pay Now</a>
                        @endif
                      </td>
                      <td class="align-middle">
                        @if ($order->status == 'completed')
                        <form action="{{ route('cust.orders.download', ['orderId' => $order->id]) }}" method="get">
                            <button type="submit" class="btn btn-warning btn-sm" name="download_pdf">Download PDF</button>
                        </form>                        
                        @endif
                      </td>
                      <td>
                      @if ($order->status == 'pending')
                      <form action="{{ route('deleteOrder', ['orderId' => $order->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" data-toggle="modal">Cancel Order</button>
                      </form>
                      @endif
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              @else
              <h4>No orders yet. Shop latest fashion <a href="{{ route('cust.products.index') }}">here</a>.</h4>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<x-customer_footer activePage="" bodyClass="g-sidenav-show bg-gray-200">
</x-customer_footer>