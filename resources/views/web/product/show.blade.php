@include('header')

<style>
    label.error {
        color: red;
    }
</style>

<body class="cnt-home">
    <div class="body-content outer-top-xs">
        <div class="container">
            <div class="row single-product">
                <div class="col-md-3 sidebar">
                    <div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
                        <h3 class="section-title">Sale Off</h3>
                        <div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss">
                            @foreach ($productsale as $sale)
                                <form action="{{ route('addCart') }}" method="post">
                                    @csrf
                                    <div class="item">
                                        <div class="products">
                                            <div class="hot-deal-wrapper">
                                                <div class="image"> <a href="{{ route('showProduct', $sale->id) }}">
                                                        <img src="../images/{{ $sale->image }}"
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
                </div><!-- /.sidebar -->
                <div class='col-md-9'>
                    <div class="detail-block">
                        <div class="row  wow fadeInUp">
                            <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                                <div class="product-item-holder size-big single-product-gallery small-gallery">
                                    <div id="owl-single-product">
                                        <div id="largeImageContainer" class="single-product-gallery-item" id="slide1">
                                            <a  id="alargeImage" data-lightbox="image-1" data-title="Gallery" href="../images/{{ $product->image }}">
                                                <img  id="largeImage" width="100%" style="height: 319px" class="img-responsive" alt="" src="assets\images\blank.gif" data-echo="../images/{{ $product->image }}">
                                            </a>
                                        </div>
                                    </div><!-- /.single-product-slider -->
                                    <div class="single-product-gallery-thumbs gallery-thumbs">
                                        <div id="owl-single-product-thumbnails">
                                            <div id="productImages" class="item">
                                                <a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="1" href="#">
                                                    <img class="img-responsive"  alt="Thumbnail 1"
                                                    onclick="displayImage('../images/{{ $product->image }}')" src="assets\images\blank.gif" data-echo="../images/{{ $product->image }}">
                                                </a>
                                            </div>
                                            @isset($images)
                                                @foreach ($images as $key => $imageList)
                                                    @foreach (explode(', ', $imageList->image_url) as $imgUrl)
                                                        {{-- <div id="thumbnailImages">
                                                            <div id="productImages" class="item">
                                                                <img class="img-responsive" width="95" height="85"
                                                                    style="height: 85px"
                                                                    src="../images/{{ $imgUrl }}"
                                                                    alt="Thumbnail {{ $key++ + 1 }}"
                                                                    onclick="displayImage('../images/{{ $imgUrl }}')">
                                                            </div>
                                                        </div> --}}

                                                        <div id="productImages" class="item">
                                                            <a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="#slide{{ $key++ }}" href="#">
                                                                <img class="img-responsive"  style="height: 68px" alt="Thumbnail {{ $key++ + 1 }}"
                                                                onclick="displayImage('../images/{{ $imgUrl }}')" src="assets\images\blank.gif" data-echo="../images/{{ $imgUrl }}">
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                @endforeach
                                            @endisset

                                        </div><!-- /#owl-single-product-thumbnails -->
                                    </div><!-- /.gallery-thumbs -->
                                </div><!-- /.single-product-gallery -->
                            </div><!-- /.gallery-holder -->
                            <div class='col-sm-6 col-md-7 product-info-block'>
                                <div class="product-info">
                                    <h1 class="name">{{ $product->name }}</h1>
                                    <div class="stock-container info-container m-t-10">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <div class="stock-box">
                                                    <span class="label">Tình trạng: </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="stock-box">
                                                    <span class="value">
                                                        @if ($product->amount > 0)
                                                            Còn hàng
                                                        @else
                                                            Hết hàng
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- /.row -->
                                    </div><!-- /.stock-container -->
                                    <div class="stock-container info-container m-t-10">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <div class="stock-box">
                                                    <span class="label">Thương hiệu: </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="stock-box">
                                                    @foreach ($brand as $item)
                                                        <a href="{{ route('showbyBrandweb', $item->id) }}"><span
                                                                class="value">{{ $item->name }}</span></a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div><!-- /.row -->
                                    </div><!-- /.stock-container -->
                                    <div class="price-container info-container m-t-20">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="price-box">
                                                    <span class="price">{{ number_format($product->price) }}đ </span>
                                                    <span class="price-strike">
                                                        @if ($product->old_price != 0)
                                                            {{ number_format($product->old_price) }}đ
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- /.row -->
                                    </div><!-- /.price-container -->
                                    <div class="quantity-container info-container">
                                        <form action="{{ route('addCart') }}" method="post" class="cart">
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <span class="label">Qty :</span>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="cart-quantity">
                                                        <div class="quant-input">
                                                            <input type="number" size="4"
                                                                class="input-text qty text" title="Qty"
                                                                value="1" name="quantity" min="1"
                                                                step="1">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-7">
                                                    <input type="hidden" value="{{ $product->id }}"
                                                        name="product_id">
                                                    <input type="hidden" value="{{ $product->name }}"
                                                        name="product_name">
                                                    <input type="hidden" value="{{ $product->image }}"
                                                        name="product_image">
                                                    <input type="hidden" value="{{ $product->price }}"
                                                        name="product_price">

                                                    <div class="action">
                                                        <div class="add-cart-button btn-group">
                                                            <button class="btn btn-primary icon"><i
                                                                    class="fa fa-shopping-cart"></i></button>
                                                            <button class="btn btn-primary cart-btn">Thêm giỏ
                                                                hàng</button>
                                                        </div>
                                                    </div>
                                                    <!-- /.action -->
                                                </div>
                                            </div><!-- /.row -->
                                        </form>
                                    </div><!-- /.quantity-container -->
                                </div><!-- /.product-info -->
                            </div><!-- /.col-sm-6 -->
                        </div><!-- /.row -->
                    </div> <!-- detail-block -->
                    <div class="product-tabs inner-bottom-xs  wow fadeInUp">
                        <div class="row">
                            <div class="col-sm-3">
                                <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                                    <li class="active"><a data-toggle="tab" href="#description">Mô tả</a></li>
                                    {{-- <li><a data-toggle="tab" href="#review">REVIEW</a></li> --}}
                                </ul><!-- /.nav-tabs #product-tabs -->
                            </div>
                            <div class="col-sm-9">
                                <div class="tab-content">
                                    <div id="description" class="tab-pane in active">
                                        <div class="product-tab">
                                            <p class="text">{!! $product->description !!}</p>
                                        </div>
                                    </div><!-- /.tab-pane -->
                                    <div id="review" class="tab-pane">
                                        <div class="product-tab">
                                            <div class="product-reviews">
                                                <h4 class="title"></h4>
                                                <div class="reviews">
                                                    <div class="review">
                                                        <input type="hidden">
                                                        <textarea class="comments-add__form-field" name="" id="" cols="30" rows="10"
                                                            placeholder="Bất cứ điều gì bạn quan tâm, hãy viết ở đây..."></textarea>
                                                    </div>
                                                </div><!-- /.reviews -->
                                            </div><!-- /.product-reviews -->
                                        </div>
                                    </div>
                                </div><!-- /.tab-content -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.product-tabs -->
                    <section class="section wow fadeInUp new-arriavls">
                        <h3 class="section-title">Sản phẩm</h3>
                        <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                            @foreach ($products as $productData)
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
                                                @else
                                                    <div class="tag new"><span>new</span></div>
                                                @endif
                                            </div>
                                            <!-- /.product-image -->
                                            <div class="product-info text-left">
                                                <h3 class="name"><a
                                                        href="{{ route('showProduct', $productData->id) }}">{{ $productData->name }}</a>
                                                </h3>
                                                <div class="rating rateit-small"></div>
                                                <div class="description"></div>
                                                <div class="product-price"> <span
                                                        class="price">{{ number_format($productData->price) }}đ
                                                    </span> <span class="price-before-discount">
                                                        @if ($productData->old_price != 0)
                                                            ${{ number_format($productData->old_price) }}đ
                                                        @endif
                                                    </span> </div>
                                                <!-- /.product-price -->
                                            </div>
                                            <!-- /.product-info -->
                                            <div class="cart clearfix animate-effect">
                                                <div class="action">
                                                    <ul class="list-unstyled">
                                                        <li class="add-cart-button btn-group">
                                                            <form action="{{ route('addCart') }}" method="post">
                                                            </form>
                                                            @csrf
                                                            <button class="btn btn-primary icon"> <i
                                                                    class="fa fa-shopping-cart"></i> </button>
                                                            @if (isset(Auth::user()->id))
                                                                <input type="hidden" value="{{ Auth::user()->id }}"
                                                                    name="user_id">
                                                                <input type="hidden" value="{{ $productData->id }}"
                                                                    name="product_id">
                                                                <input type="hidden" value="1" name="quantity">
                                                                <input type="hidden"
                                                                    value="{{ $productData->name }}"
                                                                    name="product_name">
                                                                <input type="hidden"
                                                                    value="{{ $productData->image }}"
                                                                    name="product_image">
                                                                <input type="hidden"
                                                                    value="{{ $productData->price }}"
                                                                    name="product_price">
                                                            @else
                                                                <input type="hidden" value="{{ $productData->id }}"
                                                                    name="product_id">
                                                                <input type="hidden" value="1" name="quantity">
                                                                <input type="hidden"
                                                                    value="{{ $productData->name }}"
                                                                    name="product_name">
                                                                <input type="hidden"
                                                                    value="{{ $productData->image }}"
                                                                    name="product_image">
                                                                <input type="hidden"
                                                                    value="{{ $productData->price }}"
                                                                    name="product_price">
                                                            @endif
                                                        </li>
                                                        <li class="lnk wishlist"> <a class="add-to-cart"
                                                                href="detail.html" title="Wishlist"> <i
                                                                    class="icon fa fa-heart"></i> </a> </li>
                                                        <li class="lnk"> <a class="add-to-cart" href="detail.html"
                                                                title="Compare"> <i class="fa fa-signal"
                                                                    aria-hidden="true"></i> </a> </li>
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
                            @endforeach
                        </div>
                        <!-- /.home-owl-carousel -->
                    </section>
                </div><!-- /.col-sm-9 -->
            </div> <!-- /.row -->
        </div>
    </div>
    @include('footer')
</body>

</html>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $("#frmProductShow").validate({
            rules: {
                comments: "required",
            }
        });
    });

    function displayImage(largeImagePath) {
        const alargeImage = document.getElementById('alargeImage')
        const largeImage = document.getElementById('largeImage');
        alargeImage.href =largeImagePath;
        largeImage.src = largeImagePath;

    }
</script>
