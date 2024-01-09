<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="products"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Products"></x-navbars.navs.auth>
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
                            <h2 class="mb-4">Show Product Details 
                                <a rel="tooltip" class="btn btn-secondary btn-link"
                                href="{{ route('admin.products.edit',$product->id) }}" data-original-title=""
                                title="">
                                <i class="material-icons">edit</i>
                                <div class="ripple-container"></div>
                                </a>
                            </h2>

                            <div class="d-flex justify-content-center mb-4"> <!-- Center the content -->
                                <img src="{{ asset('customer/img/product/product-' . $product->id . '.jpg') }}" alt="Product Image" style="width: 200px; height: auto;">
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>ID:</strong>
                                        {{ $product->id }}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Product Name:</strong>
                                        {{ $product->name }}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Description:</strong>
                                        {{ $product->description }}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Price: RM</strong>
                                        {{ $product->price }}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                        <strong>Categories: </strong>
                                        @forelse ($product->sizes as $size)
                                        {{ $size->name }}</a>
                                        @empty
                                            No categories associated with this product
                                        @endforelse
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Sizes: </strong>
                                        @forelse ($product->categories as $category)
                                        {{ $category->name }}</a>
                                        @empty
                                            No sizes associated with this product
                                        @endforelse
                                    </div>
                                </div>

                                <div class="form-group">
                                        <strong>Brands: </strong>
                                        @forelse ($product->brands as $brand)
                                        {{ $brand->name }}</a>
                                        @empty
                                            No brands associated with this product
                                        @endforelse
                                    </div>
                                    <div class="form-group">
                                        <strong>Colors: </strong>
                                        @forelse ($product->colors as $color)
                                        {{ $color->name }}</a>
                                        @empty
                                            No colors associated with this product
                                        @endforelse
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Created At:</strong>
                                        {{ $product->created_at->format('F j, Y, g:i A') }}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Updated At:</strong>
                                        {{ $product->updated_at->format('F j, Y, g:i A') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <a class="btn btn-primary" href="{{ route('admin.products.index') }}"> Back</a>
                        </div>
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
