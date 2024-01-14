@auth
    <x-customer_header activePage="about" bodyClass="g-sidenav-show bg-gray-200">
        <!-- Authenticated User Header Content Goes Here -->
    </x-customer_header>
@else
    <x-head_header activePage="about" bodyClass="g-sidenav-show bg-gray-200">
        <!-- Guest Header Content Goes Here -->
    </x-head_header>
@endauth

<!-- Breadcrumb Section Begin -->
        <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>About Us</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route('main')}}">Home</a>
                            <span>About Us</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- About Section Begin -->
    <section class="about spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="about__pic">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4260.185238352985!2d102.2882252363596!3d2.2715004565219226!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d1e572dbf414d3%3A0xd901ef8b3710896f!2sMydin%20MITC%20Ayer%20Keroh!5e0!3m2!1sen!2sus!4v1705078045467!5m2!1sen!2sus" width="1200" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="about__item">
                        <h4>Who We Are ?</h4>
                        <p>GracefulGlamp is your go-to personal shopper website, dedicated to providing a seamless and personalized shopping experience. Our platform features a curated selection of the latest trends in fashion, beauty, and lifestyle. </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="about__item">
                        <h4>Who We Do ?</h4>
                        <p>With expert personal shoppers on hand, we offer tailored recommendations based on individual tastes. Our user-friendly interface, commitment to quality, and secure transactions ensure a worry-free and enjoyable shopping journey. </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="about__item">
                        <h4>Why Choose Us</h4>
                        <p>Quality is our priority. Each item featured on GracefulGlamp meets our high standards of excellence. Our user-friendly interface makes shopping enjoyable and efficient, and you can trust our secure platform for worry-free transactions.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section End -->

    <!-- Counter Section Begin -->
    <section class="counter spad">
        <div class="container">
            <div class="row">
                @php
                    $categories = App\Models\Category::all();
                    $products = App\Models\Product::all();
                    $users = App\Models\User::all();
                    $customerCount = $users->filter(function($user) {
                                    return $user->roles->first() && $user->roles->first()->name === 'customer';
                                })->count(); 
                @endphp
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="counter__item">
                        <div class="counter__item__number">
                            <h2 class="cn_num">{{$customerCount}}</h2>
                        </div>
                        <span>Our <br />Clients</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
    <div class="counter__item">
        <div class="counter__item__number">
            <h2 class="cn_num">{{ count($categories) }}</h2>
        </div>
        <span>Total <br />Categories</span>
    </div>
</div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="counter__item">
                        <div class="counter__item__number">
                            <h2 class="cn_num">{{count($products)}}</h2>
                        </div>
                        <span>Total <br />Products</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="counter__item">
                        <div class="counter__item__number">
                            <h2 class="cn_num">98</h2>
                        </div>
                        <span>Total <br />Orders</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Counter Section End -->

    <!-- Team Section Begin -->
    <section class="team spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Our Team</span>
                        <h2>Meet Our Team</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="team__item">
                        <img src="{{ asset('customer')}}/img/about/kims.jpeg" alt="">
                        <h4>Salehuddin</h4>
                        <span>Founder</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="team__item">
                        <img src="{{ asset('customer')}}/img/about/kims.jpeg" alt="">
                        <h4>Hakimi</h4>
                        <span>C.E.O</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="team__item">
                        <img src="{{ asset('customer')}}/img/about/kims.jpeg" alt="">
                        <h4>Haziq</h4>
                        <span>Manager</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="team__item">
                        <img src="{{ asset('customer')}}/img/about/kims.jpeg" alt="">
                        <h4>Arief</h4>
                        <span>Supervisor</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Team Section End -->

    <!-- Client Section Begin -->
    <section class="clients spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Partner</span>
                        <h2>Happy Clients</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                    <a href="#" class="client__item"><img src="{{ asset('customer')}}/img/clients/nike.png" alt=""></a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                    <a href="#" class="client__item"><img src="{{ asset('customer')}}/img/clients/h&m.png" alt=""></a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                    <a href="#" class="client__item"><img src="{{ asset('customer')}}/img/clients/yankees.png" alt=""></a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                    <a href="#" class="client__item"><img src="{{ asset('customer')}}/img/clients/levi.png" alt=""></a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                    <a href="#" class="client__item"><img src="{{ asset('customer')}}/img/clients/outlet.png" alt=""></a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                    <a href="#" class="client__item"><img src="{{ asset('customer')}}/img/clients/lauder.png" alt=""></a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                    <a href="#" class="client__item"><img src="{{ asset('customer')}}/img/clients/vans.png" alt=""></a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                    <a href="#" class="client__item"><img src="{{ asset('customer')}}/img/clients/ioi.png" alt=""></a>
                </div>
            </div>
        </div>
    </section>
    <!-- Client Section End -->
<x-customer_footer activePage="about" bodyClass="g-sidenav-show bg-gray-200">
</x-customer_footer>