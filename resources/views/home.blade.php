@include('header')
<!-- ============================================== HEADER : END ============================================== -->
<div class="body-content outer-top-xs" id="top-banner-and-menu">
    <div class="container">
        <div class="row">
            <!-- ============================================== SIDEBAR ============================================== -->
            <div class="col-xs-12 col-sm-12 col-md-3 sidebar">
                <!-- ================================== TOP NAVIGATION ================================== -->
                <div class="side-menu animate-dropdown outer-bottom-xs">
                    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
                    <nav class="yamm megamenu-horizontal">
                        <ul class="nav">
                            @foreach ($categories as $categoriesdata)
                                <li class="dropdown menu-item"> <a
                                        href="{{ route('showbyCategoryweb', $categoriesdata->id) }}">{{ $categoriesdata->name }}</a>
                            @endforeach
                            </li>
                        </ul>
                        <!-- /.nav -->
                    </nav>
                    <!-- /.megamenu-horizontal -->
                </div>
                <!-- /.side-menu -->
                <!-- ================================== TOP NAVIGATION : END ================================== -->
                <!-- ============================================== Giảm giá ============================================== -->
                <div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
                    <h3 class="section-title">Giảm giá</h3>
                    <div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss">
                        @foreach ($productsale as $sale)
                            <form action="{{ route('addCart') }}" method="post">
                                @csrf
                                <div class="item">
                                    <div class="products">
                                        <div class="hot-deal-wrapper">
                                            <div class="image"> <a href="{{ route('showProduct', $sale->id) }}"> <img
                                                        src="../images/{{ $sale->image }}"
                                                        alt=""> </a></div>
                                            <div class="sale-offer-tag">
                                                <span>{{ 100 - intdiv(intval($sale->price) * 100, intval($sale->old_price)) }}%<br>
                                                    off</span>
                                            </div>
                                        </div>
                                        <!-- /.hot-deal-wrapper -->
                                        <div class="product-info text-left m-t-20">
                                            <h3 class="name"><a
                                                    href="{{ route('showProduct', $sale->id) }}">{{ $sale->name }}</a>
                                            </h3>
                                            <div class="rating rateit-small"></div>
                                            <div class="product-price"> <span
                                                    class="price">{{ number_format($sale->price) }}đ </span> <span
                                                    class="price-before-discount">
                                                    @if ($sale->old_price != 0)
                                                        ${{ number_format($sale->old_price) }}đ
                                                    @endif
                                                </span> </div>
                                            <!-- /.product-price -->
                                        </div>
                                        <!-- /.product-info -->
                                        <div class="cart clearfix animate-effect">
                                            <div class="action">
                                                <div class="add-cart-button btn-group">
                                                    <button class="btn btn-primary icon"><i
                                                            class="fa fa-shopping-cart"></i></button>
                                                    <button class="btn btn-primary cart-btn">Thêm giỏ hàng</button>
                                                </div>
                                            </div>
                                            <!-- /.action -->
                                        </div>
                                        <!-- /.cart -->
                                    </div>
                                </div>
                                @if (isset(Auth::user()->id))
                                    <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                                    <input type="hidden" value="{{ $sale->id }}" name="product_id">
                                    <input type="hidden" value="1" name="quantity">
                                    <input type="hidden" value="{{ $sale->name }}" name="product_name">
                                    <input type="hidden" value="{{ $sale->image }}" name="product_image">
                                    <input type="hidden" value="{{ $sale->price }}" name="product_price">
                                @else
                                    <input type="hidden" value="{{ $sale->id }}" name="product_id">
                                    <input type="hidden" value="1" name="quantity">
                                    <input type="hidden" value="{{ $sale->name }}" name="product_name">
                                    <input type="hidden" value="{{ $sale->image }}" name="product_image">
                                    <input type="hidden" value="{{ $sale->price }}" name="product_price">
                                @endif
                            </form>
                        @endforeach
                    </div>
                    <!-- /.sidebar-widget -->
                </div>
                <!-- ============================================== Giảm giá: END ============================================== -->
                <!-- ============================================== SPECIAL OFFER ============================================== -->
                <div class="sidebar-widget outer-bottom-small wow fadeInUp">
                    <h3 class="section-title">Sản phẩm đặc biệt</h3>
                    <div class="sidebar-widget-body outer-top-xs">
                        <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
                            @foreach ($best_sell as $best)
                                <div class="item">
                                    <div class="products special-product">
                                        <div class="product">
                                            <div class="product-micro">
                                                @foreach ($best_sell as $best)
                                                    <div class="row product-micro-row">
                                                        <div class="col col-xs-5">
                                                            <div class="product-image">
                                                                <div class="image"> <a
                                                                        href="{{ route('showProduct', $best->id) }}">
                                                                        <img src="../images/{{ $best->image }}"
                                                                            alt=""> </a> </div>
                                                                <!-- /.image -->
                                                            </div>
                                                            <!-- /.product-image -->
                                                        </div>
                                                        <!-- /.col -->
                                                        <div class="col col-xs-7">
                                                            <div class="product-info">
                                                                <h3 class="name"><a
                                                                        href="{{ route('showProduct', $best->id) }}">{{ $best->name }}</a>
                                                                </h3>
                                                                <div class="rating rateit-small"></div>
                                                                <div class="product-price"> <span
                                                                        class="price">${{ number_format($best->price) }}
                                                                        @if ($best->old_price != 0)
                                                                            đ{{ number_format($best->old_price) }}
                                                                        @endif
                                                                    </span> </div>
                                                                <!-- /.product-price -->
                                                            </div>
                                                        </div>
                                                        <!-- /.col -->
                                                    </div>
                                                @endforeach
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- /.sidebar-widget-body -->
                </div>
            </div>
            <!-- /.sidemenu-holder -->
            <!-- ============================================== SIDEBAR : END ============================================== -->
            <!-- ============================================== CONTENT ============================================== -->
            <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
                <!-- ========================================== Banners ========================================= -->
                <div id="hero">
                    <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
                        @foreach ($banners as $bannerlist)
                            <div class="item" style="background-image: url(images/{{ $bannerlist->image_url }});">
                                <div class="container-fluid">
                                    <div class="caption bg-color vertical-center text-left">
                                        <div class="big-text fadeInDown-1"> {{ $bannerlist->title }} </div>
                                        <div class="excerpt fadeInDown-2 hidden-xs">
                                            <span>{{ $bannerlist->content }}</span>
                                        </div>
                                        <div class="button-holder fadeInDown-3"> <a href=""
                                                class="btn-lg btn btn-uppercase btn-primary shop-now-button">Shop
                                                Now</a> </div>
                                    </div>
                                    <!-- /.caption -->
                                </div>
                                <!-- /.container-fluid -->
                            </div>
                        @endforeach
                    </div>
                    <!-- /.owl-carousel -->
                </div>
                <!-- ========================================= Banners : END ========================================= -->
                <!-- ============================================== INFO BOXES ============================================== -->
                <div class="info-boxes wow fadeInUp">
                    <div class="info-boxes-inner">
                        <div class="row">
                            <div class="col-md-6 col-sm-4 col-lg-4">
                                <div class="info-box">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <h4 class="info-box-heading green">HOÀN LẠI TIỀN</h4>
                                        </div>
                                    </div>
                                    <h6 class="text">Đảm bảo hoàn tiền trong 30 ngày</h6>
                                </div>
                            </div>
                            <!-- .col -->
                            <div class="hidden-md col-sm-4 col-lg-4">
                                <div class="info-box">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <h4 class="info-box-heading green">MIỄN PHÍ VẬN CHUYỂN</h4>
                                        </div>
                                    </div>
                                    <h6 class="text">Vận chuyển cho đơn hàng trên 499đ</h6>
                                </div>
                            </div>
                            <!-- .col -->
                            <div class="col-md-6 col-sm-4 col-lg-4">
                                <div class="info-box">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <h4 class="info-box-heading green">GIẢM GIÁ ĐẶC BIỆT</h4>
                                        </div>
                                    </div>
                                    <h6 class="text">Giảm mạnh cho tất cả các mặt hàng</h6>
                                </div>
                            </div>
                            <!-- .col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.info-boxes-inner -->
                </div>
                <!-- /.info-boxes -->
                <!-- ============================================== INFO BOXES : END ============================================== -->
                <!-- ============================================== BLOG SLIDER ============================================== -->
                <div class="best-deal wow fadeInUp outer-bottom-xs">
                    <h3 class="section-title">Thương Hiệu</h3>
                    <div class="sidebar-widget-body outer-top-xs">
                        <div class="owl-carousel best-seller custom-carousel owl-theme outer-top-xs">
                            @foreach ($brands as $brandList)
                                <div class="item">
                                    <div class="products best-product">
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href=""> <img
                                                                        src="../images/{{ $brandList->image_url }}"
                                                                        alt=""> </a> </div>
                                                            <!-- /.image -->
                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- /.sidebar-widget-body -->
                </div>
                <!-- ============================================== SCROLL TABS ============================================== -->
                <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
                    <div class="more-info-tab clearfix ">
                        <h3 class="new-product-title pull-left">Sản phẩm mới</h3>
                        <!-- /.nav-tabs -->
                    </div>
                    <div class="tab-content outer-top-xs">
                        <div class="tab-pane in active" id="all">
                            <div class="product-slider">
                                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
                                    @foreach ($new as $newProduct)
                                        <form action="{{ route('addCart') }}" method="post">
                                            @csrf
                                            <div class="item item-carousel">
                                                <div class="products">
                                                    <div class="product">
                                                        <div class="product-image">
                                                            <div class="image"> <a
                                                                    href="{{ route('showProduct', $newProduct->id) }}"><img
                                                                        src="../images/{{ $newProduct->image }}"
                                                                        class="product-thumb" alt=""></a>
                                                            </div>
                                                            <!-- /.image -->
                                                            @if ($newProduct->old_price != 0)
                                                                <div class="tag sale"><span>sale</span></div>
                                                            @else
                                                                <div class="tag new"><span>new</span></div>
                                                            @endif
                                                        </div>
                                                        <!-- /.product-image -->
                                                        <div class="product-info text-left">
                                                            <h3 class="name"><a
                                                                    href="{{ route('showProduct', $newProduct->id) }}">{{ $newProduct->name }}</a>
                                                            </h3>
                                                            <div class="product-price"> <span
                                                                    class="price">{{ number_format($newProduct->price) }}đ
                                                                </span> <span class="price-before-discount">
                                                                    @if ($newProduct->old_price != 0)
                                                                        {{ number_format($newProduct->old_price) }}đ
                                                                    @endif
                                                                </span> </div>
                                                            <!-- /.product-price -->
                                                            <div style="display: flex">
                                                                <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                                                                    viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                                    <style>
                                                                        svg {
                                                                            fill: #099268
                                                                        }
                                                                    </style>
                                                                    <path
                                                                        d="M234.5 5.7c13.9-5 29.1-5 43.1 0l192 68.6C495 83.4 512 107.5 512 134.6V377.4c0 27-17 51.2-42.5 60.3l-192 68.6c-13.9 5-29.1 5-43.1 0l-192-68.6C17 428.6 0 404.5 0 377.4V134.6c0-27 17-51.2 42.5-60.3l192-68.6zM256 66L82.3 128 256 190l173.7-62L256 66zm32 368.6l160-57.1v-188L288 246.6v188z" />
                                                                </svg>
                                                                <span style="font-size: 1rem" style="color: #099268">
                                                                    @if ($newProduct->amount > 0)
                                                                        <b>&nbsp;Còn hàng</b>
                                                                    @else
                                                                        <b>&nbsp;Hết hàng</b>
                                                                    @endif
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <!-- /.product-info -->
                                                        <div class="cart clearfix animate-effect">
                                                            <div class="action">
                                                                <ul class="list-unstyled">
                                                                    <li class="add-cart-button btn-group">
                                                                        <button style="width: 116.08px"
                                                                            class="btn btn-primary icon"><i
                                                                                class="fa fa-shopping-cart"></i></button>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <!-- /.action -->
                                                        </div>
                                                        <!-- /.cart -->
                                                    </div>
                                                    <!-- /.product -->
                                                </div>
                                                <!-- /.products -->
                                            </div>
                                            @if (isset(Auth::user()->id))
                                                <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                                                <input type="hidden" value="{{ $newProduct->id }}"
                                                    name="product_id">
                                                <input type="hidden" value="1" name="quantity">
                                                <input type="hidden" value="{{ $newProduct->name }}"
                                                    name="product_name">
                                                <input type="hidden" value="{{ $newProduct->image }}"
                                                    name="product_image">
                                                <input type="hidden" value="{{ $newProduct->price }}"
                                                    name="product_price">
                                            @else
                                                <input type="hidden" value="{{ $newProduct->id }}"
                                                    name="product_id">
                                                <input type="hidden" value="1" name="quantity">
                                                <input type="hidden" value="{{ $newProduct->name }}"
                                                    name="product_name">
                                                <input type="hidden" value="{{ $newProduct->image }}"
                                                    name="product_image">
                                                <input type="hidden" value="{{ $newProduct->price }}"
                                                    name="product_price">
                                            @endif
                                        </form>
                                    @endforeach
                                    <!-- /.item -->
                                </div>
                                <!-- /.home-owl-carousel -->
                            </div>
                            <!-- /.product-slider -->
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.scroll-tabs -->
                <!-- ============================================== SCROLL TABS : END ============================================== -->
                <!-- ============================================== WIDE PRODUCTS ============================================== -->
                <div class="wide-banners wow fadeInUp outer-bottom-xs">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="wide-banner cnt-strip">
                                <div class="image"> <img class="img-responsive"
                                        src="assets\images\banners\home-banner.jpg" alt=""> </div>
                                <div class="strip strip-text">
                                    <div class="strip-inner">
                                        <h2 class="text-right">New Mens Fashion<br>
                                            <span class="shopping-needs">Save up to 40% off</span>
                                        </h2>
                                    </div>
                                </div>
                                <div class="new-label">
                                    <div class="text">NEW</div>
                                </div>
                                <!-- /.new-label -->
                            </div>
                            <!-- /.wide-banner -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.wide-banners -->
                <!-- ============================================== WIDE PRODUCTS : END ============================================== -->
                <!-- ============================================== BEST SELLER ============================================== -->
                <div class="best-deal wow fadeInUp outer-bottom-xs">
                    <h3 class="section-title">Sản phẩm bán chạy</h3>
                    <div class="sidebar-widget-body outer-top-xs">
                        <div class="owl-carousel best-seller custom-carousel owl-theme outer-top-xs">
                            @foreach ($productsell as $selllist)
                                <form action="{{ route('addCart') }}" method="post">
                                    @csrf
                                    <div class="item">
                                        <div class="products best-product">
                                            <div class="product">
                                                <div class="product-micro">
                                                    <div class="row product-micro-row">
                                                        <div class="col col-xs-5">
                                                            <div class="product-image">
                                                                <div class="image"> <a
                                                                        href="{{ route('showProduct', $selllist->product_id) }}">
                                                                        <img src="../images/{{ $selllist->image }}"
                                                                            alt=""> </a> </div>
                                                                <!-- /.image -->
                                                            </div>
                                                            <!-- /.product-image -->
                                                        </div>
                                                        <!-- /.col -->
                                                        <div class="col2 col-xs-7">
                                                            <div class="product-info">
                                                                <h3 class="name"><a
                                                                        href="{{ route('showProduct', $selllist->product_id) }}">{{ $selllist->name }}</a>
                                                                </h3>
                                                                <div class="product-price"> <span
                                                                        class="price">{{ number_format($selllist->price) }}đ
                                                                    </span> <span class="price-before-discount">
                                                                        @if ($selllist->old_price != 0)
                                                                            ${{ number_format($selllist->old_price) }}đ
                                                                        @endif
                                                                    </span> </div>
                                                                <!-- /.product-price -->
                                                                <div style="display: flex">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        height="1em"
                                                                        viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                                        <style>
                                                                            svg {
                                                                                fill: #099268
                                                                            }
                                                                        </style>
                                                                        <path
                                                                            d="M234.5 5.7c13.9-5 29.1-5 43.1 0l192 68.6C495 83.4 512 107.5 512 134.6V377.4c0 27-17 51.2-42.5 60.3l-192 68.6c-13.9 5-29.1 5-43.1 0l-192-68.6C17 428.6 0 404.5 0 377.4V134.6c0-27 17-51.2 42.5-60.3l192-68.6zM256 66L82.3 128 256 190l173.7-62L256 66zm32 368.6l160-57.1v-188L288 246.6v188z" />
                                                                    </svg>
                                                                    <span style="font-size: 1rem"
                                                                        style="color: #099268">
                                                                        @if ($selllist->amount > 0)
                                                                            <b>&nbsp;Còn hàng</b>
                                                                        @else
                                                                            <b>&nbsp;Hết hàng</b>
                                                                        @endif
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="cart clearfix animate-effect">
                                                            <div class="action">
                                                                <ul class="list-unstyled">
                                                                    <li class="add-cart-button btn-group">
                                                                        <button style="width: 116.08px"
                                                                            class="btn btn-primary icon"><i
                                                                                class="fa fa-shopping-cart"></i></button>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <!-- /.action -->
                                                        </div>
                                                        <!-- /.col -->
                                                    </div>
                                                    <!-- /.product-micro-row -->
                                                </div>
                                                <!-- /.product-micro -->
                                            </div>
                                        </div>
                                    </div>
                                    @if (isset(Auth::user()->id))
                                        <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                                        <input type="hidden" value="{{ $selllist->product_id }}" name="product_id">
                                        <input type="hidden" value="1" name="quantity">
                                        <input type="hidden" value="{{ $selllist->name }}" name="product_name">
                                        <input type="hidden" value="{{ $selllist->image }}" name="product_image">
                                        <input type="hidden" value="{{ $selllist->price }}" name="product_price">
                                    @else
                                        <input type="hidden" value="{{ $selllist->product_id }}" name="product_id">
                                        <input type="hidden" value="1" name="quantity">
                                        <input type="hidden" value="{{ $selllist->name }}" name="product_name">
                                        <input type="hidden" value="{{ $selllist->image }}" name="product_image">
                                        <input type="hidden" value="{{ $selllist->price }}" name="product_price">
                                    @endif
                                </form>
                            @endforeach
                        </div>
                    </div>
                    <!-- /.sidebar-widget-body -->
                </div>
                <!-- /.sidebar-widget -->
                <!-- ============================================== BEST SELLER : END ============================================== -->
                <!-- ============================================== FEATURED PRODUCTS ============================================== -->
                <section class="section wow fadeInUp new-arriavls">
                    <h3 class="section-title">sản phẩm </h3>
                    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                        @foreach ($products as $productData)
                            <form action="{{ route('addCart') }}" method="post">
                                @csrf
                                <div class="item item-carousel">
                                    <div class="products">
                                        <div class="product">
                                            <div class="product-image">
                                                <div class="image"> <a
                                                        href="{{ route('showProduct', $productData->id) }}"><img
                                                            src="../images/{{ $productData->image }}"
                                                            alt=""></a> </div>
                                                <!-- /.image -->
                                                @if ($productData->old_price != 0)
                                                    <div class="tag sale"><span>sale</span></div>
                                                @endif
                                            </div>
                                            <!-- /.product-image -->
                                            <div class="product-info text-left">
                                                <h3 class="name"><a
                                                        href="{{ route('showProduct', $productData->id) }}">{{ $productData->name }}</a>
                                                </h3>
                                                <div class="product-price"> <span
                                                        class="price">{{ number_format($productData->price) }}đ
                                                    </span> <span class="price-before-discount">
                                                        @if ($productData->old_price != 0)
                                                            ${{ number_format($productData->old_price) }}đ
                                                        @endif
                                                    </span> </div>
                                                <!-- /.product-price -->
                                                <div style="display: flex">
                                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                                                        viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                        <style>
                                                            svg {
                                                                fill: #099268
                                                            }
                                                        </style>
                                                        <path
                                                            d="M234.5 5.7c13.9-5 29.1-5 43.1 0l192 68.6C495 83.4 512 107.5 512 134.6V377.4c0 27-17 51.2-42.5 60.3l-192 68.6c-13.9 5-29.1 5-43.1 0l-192-68.6C17 428.6 0 404.5 0 377.4V134.6c0-27 17-51.2 42.5-60.3l192-68.6zM256 66L82.3 128 256 190l173.7-62L256 66zm32 368.6l160-57.1v-188L288 246.6v188z" />
                                                    </svg>
                                                    <span style="font-size: 1rem" style="color: #099268">
                                                        @if ($productData->amount > 0)
                                                            <b>&nbsp;Còn hàng</b>
                                                        @else
                                                            <b>&nbsp;Hết hàng</b>
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                            <!-- /.product-info -->
                                            <div class="cart clearfix animate-effect">
                                                <div class="action">
                                                    <ul class="list-unstyled">
                                                        <li class="add-cart-button btn-group">
                                                            <button style="width: 116.08px"
                                                                class="btn btn-primary icon"><i
                                                                    class="fa fa-shopping-cart"></i></button>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!-- /.action -->
                                            </div>

                                            <!-- /.cart -->
                                        </div>
                                        <!-- /.product -->
                                    </div>
                                    <!-- /.products -->
                                </div>
                                <!-- /.item -->
                                @if (isset(Auth::user()->id))
                                    <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                                    <input type="hidden" value="{{ $productData->id }}" name="product_id">
                                    <input type="hidden" value="1" name="quantity">
                                    <input type="hidden" value="{{ $productData->name }}" name="product_name">
                                    <input type="hidden" value="{{ $productData->image }}" name="product_image">
                                    <input type="hidden" value="{{ $productData->price }}" name="product_price">
                                @else
                                    <input type="hidden" value="{{ $productData->id }}" name="product_id">
                                    <input type="hidden" value="1" name="quantity">
                                    <input type="hidden" value="{{ $productData->name }}" name="product_name">
                                    <input type="hidden" value="{{ $productData->image }}" name="product_image">
                                    <input type="hidden" value="{{ $productData->price }}" name="product_price">
                                @endif
                            </form>
                        @endforeach
                    </div>
                    <!-- /.home-owl-carousel -->
                </section>
                <!-- /.section -->
                <!-- ============================================== FEATURED PRODUCTS : END ============================================== -->
            </div>
            <!-- /.homebanner-holder -->
            <!-- ============================================== CONTENT : END ============================================== -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</div>
<!-- /#top-banner-and-menu -->
<!-- ============================================================= FOOTER ============================================================= -->
@include('footer')
<!-- ============================================================= FOOTER : END============================================================= -->
</body>

</html>
