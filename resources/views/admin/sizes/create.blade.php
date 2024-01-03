@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Size') }}</div>

                <div class="card-body">
                    <div class="container mb-4">
                      <div class="row">
                        <div class="col">
                          <a href="{{ route('sizes.index') }}" class="link-dark text-decoration-none">
                            <i class="fa-solid fa-arrow-left"></i>
                          </a>
                        </div>
                        <div class="col"></div>
                        <div class="col"></div>
                    </div>

                    <form class="my-4"
                      action="{{ route('sizes.store') }}"
                      method="POST">
                      @csrf

                      <div class="mb-3">
                        <label for="name" class="form-label">
                          Size Name <span class="text-danger">*</span>
                        </label>
                        <input type="name" class="form-control  @error('name') is-invalid @enderror" name="name">

                          @error('name')
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
