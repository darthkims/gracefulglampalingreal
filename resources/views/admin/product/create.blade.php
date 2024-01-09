<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="products"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Products"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-body px-4 pb-2">
                        <form class="my-4" action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                      @csrf

                      <!-- Add this code inside the <form> element -->
                      <div class="mb-3">
                        <label for="product_image" class="form-label">
                          Product Image</span>
                        </label>
                        <div class="input-group input-group-outline">
                            <input type="file" class="form-control" name="product_image" accept=".jpg">
                        </div>
                      </div>
                      
                      <div class="mb-3">
                        <label for="name" class="form-label">
                          Product Name <span class="text-danger">*</span>
                        </label>
                        <div class="input-group input-group-outline">
                                     <input type="text" class="form-control @error('name') is-invalid @enderror" name="name">
                                    </div>
                          @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                      </div>

                      <div class="mb-3">
                        <label for="price" class="form-label">
                          Price <span class="text-danger">*</span>
                        </label>
                        <div class="input-group input-group-outline">
                                     <input type="text" class="form-control  @error('price') is-invalid @enderror" name="price" step="0.01">
                                    </div>
                          @error('price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                      </div>

                      <div class="mb-3">
                        <label for="description" class="form-label">
                          Description <span class="text-danger">*</span>
                        </label>
                        <div class="input-group input-group-outline">
                        <textarea class="form-control @error('description') is-invalid @enderror" id="floatingTextarea2" name="description" rows="4" cols="50"></textarea>
                                    </div>
                          @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                      </div>

                      <div class="mb-3">
                        <label for="brand" class="form-label">
                          Brand <span class="text-danger">*</span>
                        </label>
                        <br>

                        <select class="form-select" name="brand">
                          <option selected>Select brand</option>
                            @foreach ($brands as $brand)
                              <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>

                          @error('brand')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                      </div>

                      <div class="mb-3">
                        <label for="categories" class="form-label">
                          Categories <span class="text-danger">*</span>
                        </label>
                        <br>

                        @foreach ($categories as $category)
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="categories[]" id="{{ $category->id }}" value="{{ $category->id }}">
                            <label class="form-check-label" for="{{ $category->name }}">{{ Str::ucfirst($category->name) }}</label>
                          </div>
                        @endforeach

                          @error('categories')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                      </div>

                      <div class="mb-3">
                        <label for="sizes" class="form-label">
                          Sizes <span class="text-danger">*</span>
                        </label>
                        <br>

                        @foreach ($sizes as $size)
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="sizes[]" id="{{ $size->id }}" value="{{ $size->id }}">
                            <label class="form-check-label" for="{{ $size->name }}">{{ Str::ucfirst($size->name) }}</label>
                          </div>
                        @endforeach

                          @error('sizes')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                      </div>

                      <div class="mb-3">
                        <label for="colors" class="form-label">
                          Colors <span class="text-danger">*</span>
                        </label>
                        <br>

                        @foreach ($colors as $color)
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="colors[]" id="{{ $color->id }}" value="{{ $color->id }}">
                            <label class="form-check-label" for="{{ $color->name }}">{{ Str::ucfirst($color->name) }}</label>
                          </div>
                        @endforeach

                          @error('colors')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                      </div>
                      
                      <div class="d-flex justify-content-end">
                      <a href="{{ route('admin.products.index') }}" class="btn btn-danger mr-2">Back</a>
                        <button type="submit" class="btn btn-success ms-2">Submit</button>
                      </div>
                    </form>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    <x-plugins></x-plugins>

</x-layout>
