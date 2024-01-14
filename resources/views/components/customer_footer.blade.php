<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Graceful Glam</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
    rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('customer')}}/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('customer')}}/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('customer')}}/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('customer')}}/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('customer')}}/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('customer')}}/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('customer')}}/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('customer')}}/css/style.css" type="text/css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</head>

<!-- Footer Section Begin -->
<footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <a href="#"><img src="{{ asset('customer')}}/img/gg_full_white.png" alt=""></a>
                        </div>
                        <p>The customer is at the heart of our unique business model, which includes design.</p>
                        <a href="#"><img src="{{ asset('customer')}}/img/payment.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h6>Shopping</h6>
                        <ul>
                            <li><a href="{{ route('cust.products.index', ['category' => 6]) }}">Clothing Store</a></li>
                            <li><a href="{{ route('cust.products.index', ['category' => 4]) }}">Trending Shoes</a></li>
                            <li><a href="{{ route('cust.products.index', ['category' => 5]) }}">Accessories</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h6>Enquiry</h6>
                        <ul>
                            <li><a href="{{route('about')}}">About Us</a></li>
                            <li><a href="#">Delivery</a></li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="footer__copyright__text">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        <p>Copyright ©
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            All rights reserved | Graceful Glam founded by <a href="https://instagram.com/starwars" target="_blank">darthkims</a>
                        </p>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    
    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search End -->

    <!-- Js Plugins -->
    <script src="{{ asset('customer')}}/js/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('customer')}}/js/bootstrap.min.js"></script>
    <script src="{{ asset('customer')}}/js/jquery.nice-select.min.js"></script>
    <script src="{{ asset('customer')}}/js/jquery.nicescroll.min.js"></script>
    <script src="{{ asset('customer')}}/js/jquery.magnific-popup.min.js"></script>
    <script src="{{ asset('customer')}}/js/jquery.countdown.min.js"></script>
    <script src="{{ asset('customer')}}/js/jquery.slicknav.js"></script>
    <script src="{{ asset('customer')}}/js/mixitup.min.js"></script>
    <script src="{{ asset('customer')}}/js/owl.carousel.min.js"></script>
    <script src="{{ asset('customer')}}/js/main.js"></script>
</body>

</html>
