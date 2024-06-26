<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="carts"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Orders"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class=" me-3 my-3 d-flex justify-content-between align-items-center">
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                            <div class="card my-4">
                        <div class="card-body">
                            <h2 class="mb-4">Order Details 
                            </h2>

                            <form action="{{ route('carts.update', $order->id) }}" method="POST">
                                @csrf
                                @method('PATCH')

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>ID:</strong>
                                        {{ $order->order_number }}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Customer Name:</strong>
                                        {{ $order->user->name }}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Product ordered:</strong>
                                        @foreach ($order->products as $index => $product )
                                        <p class=" text-secondary mb-0">
                                            {{ $index + 1 }}. {{ $product->name }} (x{{ $product->pivot->quantity }}) <b>(Store location: {{$product->pivot->location->name}})</b>
                                        </p>
                                        @endforeach                                    
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Price: RM</strong>
                                        
                                        {{ number_format($order->total, 2) }}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                        <strong>Payment Status: </strong>
                                        @if ($order->status == 'pending')
                                          <span class="badge bg-warning">Pending Payment</span>
                                        @elseif ($order->status == 'processing')
                                          <span class="badge bg-info">Processing</span>
                                        @elseif ($order->status == 'completed')
                                          <span class="badge bg-success">Completed</span>
                                        @endif
                                    </div>
                                </div>
                                {{-- <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Order Status: </strong>
                                        @if ($order->order_status == 'To Pay')
                                          <span class="badge bg-warning">{{$order->order_status}}</span>
                                        @elseif ($order->order_status == 'To Ship')
                                          <span class="badge bg-info">{{$order->order_status}}</span>
                                        @elseif ($order->order_status == 'Delivered')
                                          <span class="badge bg-success">{{$order->order_status }}</span>
                                        @endif
                                    </div>
                                </div> --}}
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Order Status:</strong>
                                        @if ($order->order_status == 'To Pay')
                                          <span class="badge bg-warning">{{$order->order_status}}</span>
                                        @else
                                            <select name="order_status" class="form-select">
                                                <option value="PREPARING" {{ $order->order_status === 'PREPARING' ? 'selected' : '' }}>Preparing</option>
                                                <option value="SHIPPED" {{ $order->order_status === 'SHIPPED' ? 'selected' : '' }}>Shipped</option>
                                                <option value="DELIVERED" {{ $order->order_status === 'DELIVERED' ? 'selected' : '' }}>Delivered</option>
                                            </select>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Date Ordered: </strong>
                                        {{ $order->created_at->format('j F Y, g:i A') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Update Order</button>
                        </div>
                        </form>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <a class="btn btn-primary" href="{{ route('carts.index') }}"> Back</a>
                        </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
    </main>

</x-layout>
