<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>JAMBIPETSHOP</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('ogani') }}/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('ogani') }}/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('ogani') }}/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('ogani') }}/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('ogani') }}/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('ogani') }}/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('ogani') }}/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('ogani') }}/css/style.css" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="./index.html" class="h1 font-weight-bold text-dark">PETSHOP</a>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="{{ Request::is('') ? 'active' : '' }}"><a href="./index.html">Home</a></li>
                <li class="{{ Request::is('shop*') ? 'active' : '' }}"><a href="./shop-grid.html">Shop</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
                <li>Free Shipping for all Order of $99</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        {{-- <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
                                <li>Free Shipping for all Order of $99</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-pinterest-p"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="./index.html" class="h1 font-weight-bold text-dark">JPS</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{ url('/') }}">Home</a></li>
                            <li class=" {{ Request::is('shop*') ? 'active' : '' }} "><a
                                    href="{{ url('shop') }}">Shop</a></li>
                            <li class="{{ Request::is('pelanggan/pesan/hasil*') ? 'active' : '' }}"><a
                                    href="{{ url('pelanggan/pesan/hasil') }}">Cart</a></li>
                            <li class="{{ Request::is('pelanggan/transaksi*') ? 'active' : '' }}"><a
                                    href="{{ url('pelanggan/transaksi') }}">Transaksi</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 text-center">
                    <div class="header__menu">
                        <ul>
                            @if(auth()->guard('pelanggan')->check())
                            <li><a href="#">{{ auth()->guard('pelanggan')->user()->nama }}</a>
                                <ul class="header__menu__dropdown text-left">
                                    <li><a href="{{ url('pelanggan/profile') }}">Profile</a></li>
                                    <li><a href="{{ url('logout') }}">Logout</a></li>
                                </ul>
                            </li>
                            @else
                            <li><a href="{{ url('form-login') }}">Login</a></li>
                            <li><a href="{{ url('form-daftar') }}">Register</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    @if (session('pesan'))
    <div class="alert alert-{{session('type')}} alert-dismissible fade show m-4" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        {{ session('pesan') }}
    </div>
    @endif

    @yield('content')

    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text">
                            <p>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;
                                <script>
                                    document.write(new Date().getFullYear());
                                </script> Zakharias Priya<i class="fas fa-globe-asia" aria-hidden="true"></i> 
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </p>
                        </div>
                        {{-- <div class="footer__copyright__payment"><img src="{{ asset('ogani') }}/img/payment-item.png"
                                alt=""></div> --}}
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="{{ asset('ogani') }}/js/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('ogani') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('ogani') }}/js/jquery.nice-select.min.js"></script>
    <script src="{{ asset('ogani') }}/js/jquery-ui.min.js"></script>
    <script src="{{ asset('ogani') }}/js/jquery.slicknav.js"></script>
    <script src="{{ asset('ogani') }}/js/mixitup.min.js"></script>
    <script src="{{ asset('ogani') }}/js/owl.carousel.min.js"></script>
    <script src="{{ asset('ogani') }}/js/main.js"></script>

    @yield('script')

</body>

</html>