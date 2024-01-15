<x-customer_header activePage="" bodyClass="g-sidenav-show bg-gray-200">
    <!-- Authenticated User Header Content Goes Here -->
</x-customer_header>

<div class="container">
            <div class="checkout__form">
                <form action="#" onsubmit="return validateForm()">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <h6 class="checkout__title">Account Details</h6>
                            <div class="checkout__input">
                                <p>Full Name<span>*</span></p>
                                <input style="color: black;" type="text" value="{{$users->name}}" required>
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" style="color: black;" value="{{$users->location}}" required>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input style="color: black;" type="text" value="{{$users->phone}}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input style="color: black;" type="text" value="{{$users->email}}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="site-btn">Update Account</button>
                    <br>
                    <br>
                </form>
            </div>
        </div>

<x-customer_footer activePage="" bodyClass="g-sidenav-show bg-gray-200">
</x-customer_footer>