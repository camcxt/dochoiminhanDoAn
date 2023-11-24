@include('header')
@section('title')
    {{ 'Page Title Goes Here' }}
@endsection
<style>
.alert-none {
        background: #f9f9f9;
        border-left: 6px solid #af1313;
        color: #000000;
        margin-bottom: 20px;
        padding: 15px;
        position: relative;
        width: 100%;
    }

    .alert-none p {
        text-decoration: none;
        line-height: 28px;
    }

</style>

<body style="background-color: #FFFFFF">
    <div class="mainmenu-area">
        <div class="container">
            <div class="row">
                <div class="navbar-collapse collapse">
                    <br>
                    {{-- <ul class="nav navbar-nav">
                        @if (isset(Auth::user()->id))
                            <li><a href="{{ route('home') }}">Home</a></li>
                        @else
                            <li><a href="{{ route('trangchu') }}">Home</a></li>
                        @endif
                        <li class="active"><a href="{{ route('shop') }}">Sản phẩm</a></li>
                    </ul> --}}
                </div>
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
                                                <div class="image"> <a href="{{ route('showProduct', $sale->id) }}">
                                                        <img src="/dochoiminhan/public/images/{{ $sale->image }}"
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
                </div>
                <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
                    @if (!empty($products->toArray()['data']))
                        @foreach ($products as $productList)
                            <form action="{{ route('addCart') }}" method="post">
                                @csrf
                                <div class=" col-md-3 col-sm-6 " style='height:311px;'>
                                    <div class="item item-carousel">
                                        <div class="products">
                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image"> <a
                                                            href="{{ route('showProduct', $productList->id) }}"><img
                                                                src="/dochoiminhan/public/images/{{ $productList->image }}"
                                                                class="product-thumb" alt=""></a> </div>
                                                    <!-- /.image -->
                                                    @if ($productList->old_price != 0)
                                                        <div class="tag sale"><span>sale</span></div>
                                                    @else
                                                        <div class="tag new"><span>new</span></div>
                                                    @endif
                                                </div>
                                                <!-- /.product-image -->
                                                <div class="product-info text-left">
                                                    <h3 class="name"><a
                                                            href="{{ route('showProduct', $productList->id) }}">{{ $productList->name }}</a>
                                                    </h3>
                                                    <div class="product-price"> <span
                                                            class="price">{{ number_format($productList->price) }}đ
                                                        </span> <span class="price-before-discount">
                                                            @if ($productList->old_price != 0)
                                                                ${{ number_format($productList->old_price) }}đ
                                                            @endif
                                                        </span> </div>
                                                    <!-- /.product-price -->
                                                </div>
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
                                                        @if ($productList->amount > 0)
                                                            <b>&nbsp;Còn hàng</b>
                                                        @else
                                                            <b>&nbsp;Hết hàng</b>
                                                        @endif
                                                    </span>
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
                                            </div>
                                            <!-- /.product -->
                                        </div>
                                        <!-- /.products -->
                                    </div>
                                </div>
                                @if (isset(Auth::user()->id))
                                    <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                                    <input type="hidden" value="{{ $productList->id }}" name="product_id">
                                    <input type="hidden" value="1" name="quantity">
                                    <input type="hidden" value="{{ $productList->name }}" name="product_name">
                                    <input type="hidden" value="{{ $productList->image }}" name="product_image">
                                    <input type="hidden" value="{{ $productList->price }}" name="product_price">
                                @else
                                    <input type="hidden" value="{{ $productList->id }}" name="product_id">
                                    <input type="hidden" value="1" name="quantity">
                                    <input type="hidden" value="{{ $productList->name }}" name="product_name">
                                    <input type="hidden" value="{{ $productList->image }}" name="product_image">
                                    <input type="hidden" value="{{ $productList->price }}" name="product_price">
                                @endif
                            </form>
                        @endforeach
                        @if (!empty($products->toArray()['data']))
                        <div class="row">
                            <div class="col-md-12">
                                <div class="product-pagination text-center">
                                    <nav>
                                        <ul class="pagination">
                                            <li class="page-item"><a class="page-link" href="{{ $products->appends(request()->except('page'))->previousPageUrl() }}">
                                                    << </a>
                                            </li>
                                            @foreach($products->links()->getData()["elements"][0] as $key => $item)
                                            <li class="page-item"><a class="page-link" href="{{$item}}">{{$key}}</a></li>
                                            @endforeach
                                            <li class="page-item"><a class="page-link" href="{{ $products->appends(request()->except('page'))->nextPageUrl() }}">>></a></li>
                                        </ul>
                                        {{-- <ul class="pagination">
                                            @if (Request::route()->getName() != 'showbyView')
                                                <li> {!! $products->links() !!}</li>
                                            @endif
                                        </ul> --}}
                                    </nav>
                                </div>
                            </div>
                        </div>
                        @endif
                    @else
                        <div class="alert-none w-100">
                            <p>
                                Hiện tại không có sản phẩm thương hiệu không có
                            </p>
                        </div>    
                    @endif
                    
                </div>
            </div>
        </div>
    </div>

</body>
@include('footer')
