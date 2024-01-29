<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="carts"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Category"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class=" me-3 my-3 d-flex justify-content-between align-items-center">
                            <h2 class="text-gradient text-dark mb-0 ms-3">Orders</h2>
                        </div>
                        <div class="card-body px-4 pb-2">
                            <div class="table-responsive p-0">
                                <a class="btn btn-warning"
                                    href="{{ route('export.orders') }}"> Export Orders
                                </a>
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                #
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                               ORDER NUMBER</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                               Username</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                PRODUCTS</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                TOTAL</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                STATUS</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                ORDER STATUS</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                VIEW
                                            </th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($carts as $index => $cart)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <p class="mb-0 text-sm">{{ $index + 1 }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <p class="mb-0 text-sm">{{ $cart->order_number }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <p class="mb-0 text-sm">{{ $cart->user->name }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <p class="text-xs text-secondary mb-0">
                                                    Total Items: {{ count($cart->products) }}
                                                </p>
                                            </td>

                                            <td class="align-middle text-center">
                                                <p class="text-xs text-secondary mb-0">
                                                RM {{ number_format($cart->total, 2) }}
                                                </p>
                                            </td>
                                            
                                            <td class="align-middle text-center">
                                                <p class="text-xs text-secondary mb-0">
                                                @if ($cart->status == 'pending')
                                                  <span class="badge bg-warning">Pending Payment</span>
                                                @elseif ($cart->status == 'processing')
                                                  <span class="badge bg-info">Processing</span>
                                                @elseif ($cart->status == 'completed')
                                                  <span class="badge bg-success">Completed</span>
                                                @endif
                                                </p>
                                            </td>
                                            
                                            <!-- ORDER STATUS -->
                                            <td class="align-middle text-center">
                                                <p class="text-xs text-secondary mb-0">
                                                @if ($cart->status == 'processing')
                                                  <span class="badge bg-warning">Processing</span>
                                                @elseif ($cart->status == 'Shipped')
                                                  <span class="badge bg-info">Shipped</span>
                                                @elseif ($cart->status == 'Delivered')
                                                  <span class="badge bg-success">Delivered</span>
                                                @else
                                                    <span class="badge bg-warning">Processing</span>
                                                @endif
                                                </p>
                                            </td>
                                            <td class="align-middle text-center">
                                            <a class="btn btn-success" href="{{ route('carts.show',$cart->id) }}"><i class="material-icons">visibility</i></a>
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
            <x-footers.auth></x-footers.auth>
        </div>
    </main>

</x-layout>