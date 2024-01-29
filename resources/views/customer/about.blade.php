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


    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    
    <!-- About Section Begin -->
    <section class="about spad">
        <div class="container">
                <div class="row mt-5">
                    <div class="col-lg-12">
                        <div class="about__item">
                            <h2 class="mb-4"><strong>Where We Bought the Item</strong></h2>
                            <p class="lead">
                                We carefully source our products from various locations to provide you with the best quality and selection. Here are some of the places where we bought the items featured on GracefulGlam.
                            </p>
                            <!-- You can add more details or customize the text as needed -->
                        </div>
                    </div>
                </div>
            <div class="row">
            
                <div class="col-lg-12">
                <div class="about__pic">
                    <div id="map" style="height: 400px;"></div>

                    <script>
                        var map = L.map('map').setView([3.1499, 101.6945], 10); // Centered on Malaysia with zoom level 6

                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '&copy; OpenStreetMap contributors'
                        }).addTo(map);

                        @foreach($locations as $location)
                            L.marker([{{ $location->latitude }}, {{ $location->longitude }}])
                                .addTo(map)
                                .bindPopup('{{ $location->name }}');
                        @endforeach
                    </script>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="about__item">
                        <h4>Who We Are ?</h4>
                        <p>GracefulGlam is your go-to personal shopper website, dedicated to providing a seamless and personalized shopping experience. Our platform features a curated selection of the latest trends in fashion, beauty, and lifestyle. </p>
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
                        <p>Quality is our priority. Each item featured on GracefulGlam meets our high standards of excellence. Our user-friendly interface makes shopping enjoyable and efficient, and you can trust our secure platform for worry-free transactions.</p>
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
                    $orders = App\Models\Order::all();
                    $customerCount = $users->filter(function($user) {
                                    return $user->roles->first() && $user->roles->first()->name === 'customer';
                                })->count();
                                
                                $count = 0;
                                
                                @foreach ($orders as $order)
                                @if ($order->status == 'completed')
                                    @php
                                    $count += $order->total;
                                    @endphp
                                @endif
                            @endforeach
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
                            <h2 class="cn_num">{{ $count }}</h2>
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
                        <img src="{{ asset('customer')}}/img/about/alphaxan.jpg" alt="">
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
                        <img src="{{ asset('customer')}}/img/about/xan.jpg" alt="">
                        <h4>Haziq</h4>
                        <span>Manager</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="team__item">
                        <img src="{{ asset('customer')}}/img/about/xankim.jpg" alt="">
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