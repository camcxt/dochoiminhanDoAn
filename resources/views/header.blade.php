<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">

    @if (Request::route()->getName() == 'shop')
        <title>Minh An | Đồ chơi thông minh</title>
    @elseif (Request::route()->getName() == 'showbyView')
        @if (url()->full() == 'http://localhost:7882/dochoiminhan/public/showbyView/1')
            <title>Minh An | Top Sellers </title>
        @elseif (url()->full() == 'http://localhost:7882/dochoiminhan/public/showbyView/2')
            <title>Minh An | Recently Viewed </title>
        @elseif (url()->full() == 'http://localhost:7882/dochoiminhan/public/showbyView/3')
            <title>Minh An | Top New </title>
        @endif
    @elseif (Request::route()->getName() == 'show_Cart')
        <title>Minh An | Giỏ hàng</title>
    @elseif (Request::route()->getName() == 'showOrder')
        <title>Minh An | Đơn hàng</title>
    @elseif (Request::route()->getName() == 'showItem')
        <title>Minh An | Order</title>
    @elseif (Request::route()->getName() == 'createOrder')
        <title>Minh An | Check Out</title>
    @else
        <title>Minh An | Đồ chơi thông minh</title>
    @endif
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <!-- Customizable CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.transitions.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/rateit.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-select.min.css') }}">
    <link href="{{ asset('assets/css/lightbox.css') }}" rel="stylesheet">
    <!-- Icons/Glyphs -->
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.css') }}">

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800'
        rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <style>
        h3 {
            height: 46.17px;
        }
    </style>
</head>

<body class="cnt-home">
    <!-- ============================================== HEADER ============================================== -->
    <header class="header-style-1">
        <!-- ============================================== TOP MENU ============================================== -->
        <div class="top-bar animate-dropdown">
            <div class="container">
                <div class="header-top-inner">
                    <div class="cnt-account">
                        <ul class="list-unstyled">
                            @if (isset(Auth::user()->username))
                                <li><a href="#"><i class="icon fa fa-user"></i>{{ Auth::user()->username }}</a>
                                </li>
                                <li><a href="{{ route('showOrder', Auth::user()->email) }}"><i
                                            class="icon fa fa-suitcase"></i> Đơn hàng</a></li>
                                <li><a href="{{ route('show_Cart') }}"><i class="icon fa fa-shopping-cart"></i>Giỏ hàng</a></li>
                            @else
                                <li><a href="#"><i class="icon fa fa-user"></i>Tài khoản</a></li>
                            @endif
                            @if (isset(Auth::user()->username))
                                <li><a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
                                            class="icon fa fa-check"></i>{{ __('Logout') }}</a></li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            @else
                                <li><a href="{{ route('show_Cart') }}"><i class="icon fa fa-shopping-cart"></i>Giỏ hàng</a></li>
                                <li><a href="{{ route('login') }}"><i class="icon fa fa-lock"></i>Đăng nhập</a></li>
                            @endif
                        </ul>
                    </div>
                    <!-- /.cnt-account -->
                    <div class="clearfix"></div>
                </div>
                <!-- /.header-top-inner -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /.header-top -->
        <!-- ============================================== TOP MENU : END ============================================== -->
        <div class="main-header">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
                        <!-- ============================================================= LOGO ============================================================= -->
                        @if (isset(Auth::user()->username))
                            <div class="logo"> <a href="{{ route('home') }}"> <img style="height: 100px;"
                                        src="\dochoiminhan\public\images\logo\dochoiminhan2.png" alt="logo"> </a>
                            </div>
                        @else
                            <div class="logo"> <a href="{{ route('trangchu') }}"> <img style="height: 100px;"
                                        src="\dochoiminhan\public\images\logo\dochoiminhan2.png" alt="logo"> </a>
                            </div>
                        @endif
                        <!-- /.logo -->
                        <!-- ============================================================= LOGO : END ============================================================= -->
                    </div>
                    <!-- /.logo-holder -->
                    <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder">
                        <!-- /.contact-row -->
                        <!-- ============================================================= SEARCH AREA ============================================================= -->
                        <div class="search-area">
                            <form action="{{ route('searchName') }}" method="get">
                                <div class="control-group" style="display: flex">
                                    <input autocomplete="off" style="width: 100%;outline: none" name="searchInput" class="search-field" placeholder="Tìm kiếm sản phẩm...">
                                    <button class="search-button" type="submit"></button>
                                </div>
                            </form>
                        </div>
                        <!-- /.search-area -->
                        <!-- ============================================================= SEARCH AREA : END ============================================================= -->
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /.main-header -->

        <!-- ============================================== NAVBAR ============================================== -->
        <div class="header-nav animate-dropdown">
            <div class="container">
                <div class="yamm navbar navbar-default" role="navigation">
                    <div class="navbar-header">
                        <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse"
                            class="navbar-toggle collapsed" type="button">
                            <span class="sr-only"></span> <span class="icon-bar"></span> <span
                                class="icon-bar"></span> <span class="icon-bar"></span> </button>
                    </div>
                    <div class="nav-bg-class">
                        <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
                            <div class="nav-outer">
                                <ul class="nav navbar-nav">
                                    @if (isset(Auth::user()->username))
                                        <li class="dropdown"> <a href="{{ route('home') }}">Trang chủ</a> </li>
                                    @else
                                        <li class="dropdown"> <a href="{{ route('trangchu') }}">Trang chủ</a> </li>
                                    @endif
                                    <li class="dropdown"> <a href="{{ route('shop') }}">Sản phẩm</a> </li>
                                    <li class="dropdown"> <a href="#" class="dropdown-toggle"
                                            data-hover="dropdown" data-toggle="dropdown">Thương hiệu</a>
                                        <ul class="dropdown-menu brand">
                                            <li>
                                                <div class="yamm-content">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-menu">
                                                            @foreach ($brands as $brandList)
                                                                <ul class="links">
                                                                    <li><a
                                                                            href="{{ route('showbyBrandweb', $brandList->id) }}">{{ $brandList->name }}</a>
                                                                    </li>
                                                                </ul>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown hidden-sm"> <a
                                            href="{{ route('showbyCategoryweb', 23) }}">Thể
                                            thao & Giải trí</a>
                                    </li>
                                    <li class="dropdown"> <a href="{{ route('showbyCategoryweb', 6) }}">Khoa học &
                                            Công Nghệ</a> </li>
                                    <li class="dropdown"> <a href="{{ route('showbyCategoryweb', 5) }}">Trò chơi &
                                            Giải đố</a> </li>
                                    <li class="dropdown  navbar-right special-menu"> <a href="#">Về chúng
                                            tôi</a> </li>
                                </ul>
                                <!-- /.navbar-nav -->
                                <div class="clearfix"></div>
                            </div>
                            <!-- /.nav-outer -->
                        </div>
                        <!-- /.navbar-collapse -->

                    </div>
                    <!-- /.nav-bg-class -->
                </div>
                <!-- /.navbar-default -->
            </div>
            <!-- /.container-class -->

        </div>
        <!-- /.header-nav -->
        <!-- ============================================== NAVBAR : END ============================================== -->
    </header>
    <div class="alertInfo">
        <div class="alertInfo-content">
            @if (session('success'))
                <div style="text-align: center" id="notification" class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('messError'))
                <div style="text-align: center" id="notification" class="alert alert-success">
                    {{ session('messError') }}
                </div>
            @endif
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('assets\js\jquery-1.11.1.min.js')}}"></script> 
<script src="{{ asset('assets\js\bootstrap.min.js')}}"></script> 
<script src="{{ asset('assets\js\bootstrap-hover-dropdown.min.js')}}"></script> 
<script src="{{ asset('assets\js\owl.carousel.min.js')}}"></script> 
<script src="{{ asset('assets\js\echo.min.js')}}"></script> 
<script src="{{ asset('assets\js\jquery.easing-1.3.min.js')}}"></script> 
<script src="{{ asset('assets\js\bootstrap-slider.min.js')}}"></script> 
<script src="{{ asset('assets\js\jquery.rateit.min.js')}}"></script> 
<script src="{{ asset('assets\js\bootstrap-select.min.js')}}"></script> 
<script src="{{ asset('assets\js\wow.min.js')}}"></script> 
<script src="{{ asset('assets\js\scripts.js')}}"></script>

<script>
    $(document).ready(function() {
        // Tự động ẩn thông báo sau 5 giây
        setTimeout(function() {
            $('#notification').fadeOut('slow');
        }, 5000); // 5000 milliseconds = 5 seconds
    });   
</script>
