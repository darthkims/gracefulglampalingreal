<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
                        <form class="my-4" action="{{ route('admin.products.update', $product->id) }}" method="POST">
                    @csrf
                    @method('PATCH')


                    <!-- Add this code inside the <form> element -->
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">
                        Product Name <span class="text-danger">*</span>
                        </label>
                        <div class="input-group input-group-outline">
                                    <input type="text" value="{{ $product->name }}" class="form-control @error('name') is-invalid @enderror" name="name">
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
                                    <input type="text" value="{{ $product->price }}" class="form-control  @error('price') is-invalid @enderror" name="price" step="0.01">
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
                            <textarea class="form-control @error('description') is-invalid @enderror" id="floatingTextarea2" name="description" rows="4" cols="50">{{ $product->description }}</textarea>
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
                            <option disabled>Select brand</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" {{ $brand->id == $product->brand_id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('brand')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="location" class="form-label">
                            Location <span class="text-danger">*</span>
                        </label>
                        <br>
                    
                        <select class="form-select" name="locations[]" multiple="multiple" id="locationOptions">
                            @foreach ($locations as $location)
                                <option value="{{ $location->id }}" {{ in_array($location->id, $product->locations->pluck('id')->toArray()) ? 'selected' : '' }}>
                                    {{ $location->name }}
                                </option>
                            @endforeach
                        </select>
                    
                        @error('locations')
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
                            <input 
                            class="form-check-input" 
                            type="checkbox" 
                            name="categories[]" 
                            id="{{ $category->id }}" 
                            value="{{ $category->id }}"
                            {{ in_array($category->id, $product->categories->pluck('id')->toArray()) ? 'checked' : '' }}
                            >
                            <label class="form-check-label" for="{{ $category->name }}">
                            {{ Str::ucfirst($category->name) }}
                            </label>
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
                                <input class="form-check-input" type="checkbox" name="sizes[]" id="{{ $size->id }}" value="{{ $size->id }}" 
                                        {{ in_array($size->id, $product->sizes->pluck('id')->toArray()) ? 'checked' : '' }}>
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
                                <input class="form-check-input" type="checkbox" name="colors[]" id="{{ $color->id }}" value="{{ $color->id }}" 
                                        {{ in_array($color->id, $product->colors->pluck('id')->toArray()) ? 'checked' : '' }}>
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
                        <button type="submit" class="btn btn-success ms-2">Update</button>
                    </div>
                    </form>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
        $(document).ready(function() {
            $('#locationOptions').select2();
        });
        </script>
    </main>
</x-layout>
