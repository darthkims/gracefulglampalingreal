<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="user-management"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="User Management"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                    <div class="card-body px-0 pb-2 mb-4">
                            <div class="me-3 my-3">
                                <h2>Product MANAGEMENT</h2>
                            </div>

                            
                        <!-- Form -->
                        <form method="POST" action="{{ route('products.store') }}">
                            @csrf

                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-12 mb-3">
                                    <div class="input-group input-group-outline">
                                        <strong>Name: </strong>
                                        <input type="text" class="form-control" name="product_name" placeholder="Name" required>
                                    </div>
                                </div>

                                <div class="col-xs-6 col-sm-6 col-md-12 mb-3">
                                    <div class="input-group input-group-outline">
                                        <strong>Description: </strong>
                                        <input type="text" class="form-control" name="product_desc" placeholder="Description" required>
                                    </div>
                                </div>

                                <div class="col-xs-6 col-sm-6 col-md-12 mb-3">
                                    <div class="input-group input-group-outline">
                                        <strong>Price: RM</strong>
                                        <input type="number" step="0.01" class="form-control" name="price" placeholder="Price" required>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
                                </div>
                            </div>
                        </form>
                        <!-- End Form -->
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    <x-plugins></x-plugins>

</x-layout>