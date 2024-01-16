<x-customer_header activePage="" bodyClass="g-sidenav-show bg-gray-200">
    <!-- Authenticated User Header Content Goes Here -->
</x-customer_header>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Account Details</h4>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <br>
    <!-- Breadcrumb Section End -->
<div class="container">
            <div class="checkout__form">
                @if (session('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('message') }}
                    </div>
                @endif

                <form  
                    action="{{ route('cust.update-profile', $users->id) }}"
                    method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <h6 class="checkout__title">Edit Account</h6>
                            <div class="checkout__input">
                                <p>Full Name<span>*</span></p>
                                <input name="name" style="color: black;" type="text" value="{{$users->name}}" required>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input name="location" type="text" style="color: black;" value="{{$users->location}}" required>
                                
                                @error('location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input name="phone" style="color: black;" type="text" value="{{$users->phone}}" required>

                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                         @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input name="email" style="color: black;" type="text" value="{{$users->email}}" required>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                         @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="{{ $users->id }}">
                    <button type="submit" class="site-btn">Update Account</button>
                    <br>
                    <br>
                </form>
            </div>
        </div>

<x-customer_footer activePage="" bodyClass="g-sidenav-show bg-gray-200">
</x-customer_footer>