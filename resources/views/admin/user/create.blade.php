@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create User') }}</div>

                <div class="card-body">
                    <div class="container mb-4">
                      <div class="row">
                        <div class="col">
                          <a href="{{ route('users.index') }}" class="link-dark text-decoration-none">
                            <i class="fa-solid fa-arrow-left"></i>
                          </a>
                        </div>
                        <div class="col"></div>
                        <div class="col"></div>
                    </div>

                    <form class="my-4"
                      action="{{ route('users.store') }}"
                      method="POST">
                      @csrf

                      <div class="mb-3">
                        <label for="name" class="form-label">
                          Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name">

                          @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                      </div>

                      <div class="mb-3">
                        <label for="username" class="form-label">
                          Username <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control  @error('username') is-invalid @enderror" name="username">

                          @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                      </div>

                      <div class="mb-3">
                        <label for="email" class="form-label">
                          Email <span class="text-danger">*</span>
                        </label>
                        <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email">

                          @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                      </div>

                      <div class="mb-3">
                        <label for="role" class="form-label">
                          Password <span class="text-danger">*</span>
                        </label>
                        <br>
                        <input type="password" class="form-control  @error('password') is-invalid @enderror" name="password" >

                        @error('password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>

                      <div class="mb-3">
                        <label for="phone" class="form-label">
                          Phone No.
                        </label>
                        <input type="text" class="form-control  @error('phone') is-invalid @enderror" name="phone">

                          @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                      </div>

                      <div class="mb-3">
                        <label for="role" class="form-label">
                          Role <span class="text-danger">*</span>
                        </label>
                        <br>

                        @foreach ($roles as $role)
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="role" id="{{ $role->name }}" value="{{ $role->name }}">
                            <label class="form-check-label" for="{{ $role->name }}">{{ Str::ucfirst($role->name) }}</label>
                          </div>
                        @endforeach

                          @error('role')
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
