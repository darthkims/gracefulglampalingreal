<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="categories"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Categories"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
   
    <div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-body"> <!-- Center the content -->
                <h2 class="mb-4">Show Category Details</h2>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>ID:</strong>
                            {{ $category->id }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Category Name:</strong>
                            {{ $category->category_name }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Created At:</strong>
                            {{ $category->created_at->format('F j, Y, g:i A') }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Updated At:</strong>
                            {{ $category->updated_at->format('F j, Y, g:i A') }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Products in {{ $category->category_name }}:</strong>
                            @foreach ($products as $key => $product)
                                <div>
                                <a href="{{ route('products.show', $product) }}">{{ $key + 1 }}. {{ $product->product_name }}</a>
                                </div>
                            @endforeach
                        </div>
                    </div>


                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <a class="btn btn-primary" href="{{ route('categories.index') }}"> Back</a>
            </div>
        </div>
    </div>
            <x-footers.auth></x-footers.auth>
        </div>    
    </main>
    <x-plugins></x-plugins></x-layout>