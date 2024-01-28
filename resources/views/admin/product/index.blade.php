<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="products"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Products"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    
                @if (session('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" style="color: white;">
                            {{ session('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card my-4">
                    <div class=" me-3 my-3 d-flex justify-content-between align-items-center">
                            <h2 class="text-gradient text-dark mb-0 ms-3">Products</h2>
                            <a class="btn bg-gradient-dark mb-0" href="{{ route('admin.products.create') }}">
                                <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New Product
                            </a>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                ID
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                NAME</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                PRICE</th>
                                            <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                LOCATION</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                BRAND</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                COLOR</th>    
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                ACTION
                                            </th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <p class="mb-0 text-sm">{{ $product->id }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <p class="mb-0 text-sm"><b>{{ $product->name }}</b></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <p class="mb-0 text-sm">RM{{ $product->price }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center text-left">
                                                        <p class="mb-0 text-sm">
                                                            @forelse ($product->locations as $index => $location)
                                                                {{ $index + 1 }}. {{ $location->name }}<br>
                                                            @empty
                                                                No location.
                                                            @endforelse
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center text-center">
                                                        <p class="mb-0 text-sm">
                                                            @forelse ($product->brands as $brand)
                                                                {{ $brand->name }}
                                                            @empty
                                                                No brand.
                                                            @endforelse
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <p class="mb-0 text-sm">
                                                        @forelse ($product->colors as $color)
                                                        {{ $color->name }}</a>
                                                        @empty
                                                            No colors.
                                                        @endforelse
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <form action="{{ route('admin.products.destroy',$product->id) }}" method="POST">
                                                   <a class="btn btn-secondary" href="{{ route('admin.products.edit',$product->id) }}"><i class="material-icons">edit</i></a>
                                                   <a class="btn btn-success" href="{{ route('admin.products.show',$product->id) }}"><i class="material-icons">visibility</i></a>
                                                   @csrf
                                                   @method('DELETE')
                                                   <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">
                                                        <i class="material-icons">close</i>
                                                  </button>
                                                </form>
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
    <x-plugins></x-plugins>

</x-layout>
