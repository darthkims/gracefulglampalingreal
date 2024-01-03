@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Product') }}</div>

                <div class="card-body">
                    <div class="container mb-4">
                      <div class="row">
                        <div class="col">
                          <a href="{{ route('admin.products.index') }}" class="link-dark text-decoration-none">
                            <i class="fa-solid fa-arrow-left"></i>
                          </a>
                        </div>
                        <div class="col"></div>
                        <div class="col"></div>
                    </div>

                    <form class="my-4"
                      action="{{ route('admin.products.store') }}"
                      method="POST">
                      @csrf

                      <div class="mb-3">
                        <label for="name" class="form-label">
                          Product Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name">

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
                        <input type="number" class="form-control  @error('price') is-invalid @enderror" name="price" step="0.01">

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
                        <textarea name="description" id="" rows="4" class="form-control  @error('description') is-invalid @enderror" name="description"></textarea>
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
                        <button type="submit" class="btn btn-success">Submit</button>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
