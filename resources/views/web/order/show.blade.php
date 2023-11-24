@include('header')
<link rel="stylesheet" href="{{ asset('css/order.css') }}">

<body class="cnt-home">
    <div class="body-content outer-top-xs">
        <div class="container">
            <div class="single-product-area">
                <div class="container">
                    <div class="row">
                        <div>
                            <ul style="display: flex;
                            justify-content: space-between;"
                                id="product-tabs" class="nav nav-tabs nav-tab-cell">
                                <li class="active"><a data-toggle="tab" href="#all">Tất cả</a></li>
                                <li><a data-toggle="tab" href="#unconfimred">Chờ xác nhận</a></li>
                                <li><a data-toggle="tab" href="#confirlmed">Đã xác nhận</a></li>
                                <li><a data-toggle="tab" href="#toreceive">Đang giao</a></li>
                                <li><a data-toggle="tab" href="#completed">Hoàn thành</a></li>
                                <li><a data-toggle="tab" href="#cancelled">Đã hủy</a></li>
                            </ul><!-- /.nav-tabs #product-tabs -->
                        </div>
                        <br>
                        <div>
                            <div class="tab-content">
                                <div id="all" class="tab-pane in active">
                                    <div class="product-tab">
                                        @foreach ($orders as $orderList)
                                            <div style="margin-bottom: 10px">
                                                @if (isset($orderList->user_id))
                                                    <div class="row" style="background: white">
                                                        @foreach ($orderItem as $items)
                                                            @if ($orderList->id == $items->order_id)
                                                                <div class="product-order">
                                                                    <div class="row"
                                                                        style="margin-right: 0px; margin-left:0px">
                                                                        <div class="col-xs-12 col-sm-12 col-md-3">
                                                                            <div style="padding-left: 50px ;"
                                                                                class="product-image">
                                                                                <a
                                                                                    href="{{ route('showItem', $items->order_id) }}"><img
                                                                                        style="width: 100px; height: 100px"
                                                                                        src="../images/{{ $items->product_image }}"
                                                                                        alt=""></a>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="col-xs-12 col-sm-12 col-md-6 product-details">
                                                                            <div>
                                                                                <h4>
                                                                                    <a
                                                                                        href="{{ route('showItem', $items->order_id) }}">{{ $items->product_name }}</a>
                                                                                </h4>
                                                                            </div>
                                                                            <div class="product-qty">
                                                                                <span>
                                                                                    x{{ $items->product_quantity }}
                                                                                </span>
                                                                            </div>
                                                                            <div>
                                                                                <span>
                                                                                    {{ $items->product_price }}
                                                                                    đ
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                        <div class=" col-md-3 product-status">
                                                                            <div>
                                                                                <h4>{{ App\Constants\Constants::STATUS_ORDER[$items->status ?? 0] }}
                                                                                </h4>
                                                                                <div>
                                                                                    @if (($items->status ?? 0) < App\Constants\Constants::DELIVERY)
                                                                                        <form
                                                                                            action="{{ route('order.cancel', $items->id) }}"
                                                                                            method="post">
                                                                                            @csrf
                                                                                            <button style="width: 100%"
                                                                                                class="btn btn-cancel"
                                                                                                type="submit">Hủy</button>
                                                                                        </form>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                        <hr>
                                                        <div class="product-total">
                                                            <p>
                                                                Thành tiền: <span>
                                                                    {{ number_format($orderList->total_money) }} đ
                                                                </span>
                                                            </p>
                                                        </div>
                                                        {{-- </div> --}}
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div><!-- /.tab-pane -->
                                <div id="unconfimred" class="tab-pane">
                                    <div class="product-tab">
                                        @foreach ($orders as $orderList)
                                            @if (isset($orderList->user_id))
                                                @foreach ($orderStatus as $items)
                                                    @if ($orderList->id == $items->order_id)
                                                        <div style="margin-bottom: 10px">
                                                            <div class="row" style="background: white">
                                                                <div class="product-order">
                                                                    <div class="row"
                                                                        style="margin-right: 0px; margin-left:0px">
                                                                        <div class="col-xs-12 col-sm-12 col-md-3">
                                                                            <div style="padding-left: 50px"
                                                                                class="product-image">
                                                                                <a
                                                                                    href="{{ route('showItem', $items->order_id) }}"><img
                                                                                        style="width: 100px; height: 100px"
                                                                                        src="../images/{{ $items->product_image }}"
                                                                                        alt=""></a>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="col-xs-12 col-sm-12 col-md-6 product-details">

                                                                            <div>
                                                                                <h4>
                                                                                    <a
                                                                                        href="{{ route('showItem', $items->order_id) }}">{{ $items->product_name }}</a>
                                                                                </h4>
                                                                            </div>
                                                                            <div class="product-qty">
                                                                                <span>
                                                                                    x{{ $items->product_quantity }}
                                                                                </span>
                                                                            </div>
                                                                            <div>
                                                                                <span>
                                                                                    {{ $items->product_price }}
                                                                                    đ
                                                                                </span>
                                                                            </div>

                                                                        </div>
                                                                        <div class=" col-md-3 product-status">
                                                                            <div>
                                                                                <h4>{{ App\Constants\Constants::STATUS_ORDER[$items->status ?? 0] }}
                                                                                </h4>
                                                                                <div>
                                                                                    @if (($items->status ?? 0) < App\Constants\Constants::DELIVERY)
                                                                                        <form
                                                                                            action="{{ route('order.cancel', $items->id) }}"
                                                                                            method="post">
                                                                                            @csrf
                                                                                            <button
                                                                                                style="width: 100%"
                                                                                                class="btn btn-cancel"
                                                                                                type="submit">Hủy
                                                                                            </button>
                                                                                        </form>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr>

                                                                <div class="product-total">
                                                                    <p>
                                                                        Thành tiền: <span>
                                                                            {{ number_format($orderList->total_money) }}
                                                                            đ
                                                                        </span>
                                                                    </p>

                                                                </div>

                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div id="confirlmed" class="tab-pane">
                                    <div class="product-tab">
                                        @foreach ($orders as $orderList)
                                            @if (isset($orderList->user_id))
                                                @foreach ($orderStatus1 as $items)
                                                    @if ($orderList->id == $items->order_id)
                                                        <div style="margin-bottom: 10px">
                                                            <div class="row" style="background: white">
                                                                <div class="product-order">
                                                                    <div class="row"
                                                                        style="margin-right: 0px; margin-left:0px">
                                                                        <div class="col-xs-12 col-sm-12 col-md-3">
                                                                            <div style="padding-left: 50px"
                                                                                class="product-image">
                                                                                <a
                                                                                    href="{{ route('showItem', $items->order_id) }}"><img
                                                                                        style="width: 100px; height: 100px"
                                                                                        src="../images/{{ $items->product_image }}"
                                                                                        alt=""></a>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="col-xs-12 col-sm-12 col-md-6 product-details">

                                                                            <div>
                                                                                <h4>
                                                                                    <a
                                                                                        href="{{ route('showItem', $items->order_id) }}">{{ $items->product_name }}</a>
                                                                                </h4>
                                                                            </div>
                                                                            <div class="product-qty">
                                                                                <span>
                                                                                    x{{ $items->product_quantity }}
                                                                                </span>
                                                                            </div>
                                                                            <div>
                                                                                <span>
                                                                                    {{ $items->product_price }}
                                                                                    đ
                                                                                </span>
                                                                            </div>

                                                                        </div>
                                                                        <div class=" col-md-3 product-status">
                                                                            <div>
                                                                                <h4>{{ App\Constants\Constants::STATUS_ORDER[$items->status ?? 0] }}
                                                                                </h4>
                                                                                <div>
                                                                                    @if (($items->status ?? 0) < App\Constants\Constants::DELIVERY)
                                                                                        <form
                                                                                            action="{{ route('order.cancel', $items->id) }}"
                                                                                            method="post">
                                                                                            @csrf
                                                                                            <button
                                                                                                style="width: 100%"
                                                                                                class="btn btn-cancel"
                                                                                                type="submit">Hủy
                                                                                            </button>
                                                                                        </form>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr>

                                                                <div class="product-total">
                                                                    <p>
                                                                        Thành tiền: <span>
                                                                            {{ number_format($orderList->total_money) }}
                                                                            đ
                                                                        </span>
                                                                    </p>

                                                                </div>

                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div id="toreceive" class="tab-pane">
                                    <div class="product-tab">
                                        @foreach ($orders as $orderList)
                                            @if (isset($orderList->user_id))
                                                @foreach ($orderStatus2 as $items)
                                                    @if ($orderList->id == $items->order_id)
                                                        <div style="margin-bottom: 10px">
                                                            <div class="row" style="background: white">
                                                                <div class="product-order">
                                                                    <div class="row"
                                                                        style="margin-right: 0px; margin-left:0px">
                                                                        <div class="col-xs-12 col-sm-12 col-md-3">
                                                                            <div style="padding-left: 50px"
                                                                                class="product-image">
                                                                                <a
                                                                                    href="{{ route('showItem', $items->order_id) }}"><img
                                                                                        style="width: 100px; height: 100px"
                                                                                        src="../images/{{ $items->product_image }}"
                                                                                        alt=""></a>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="col-xs-12 col-sm-12 col-md-6 product-details">

                                                                            <div>
                                                                                <h4>
                                                                                    <a
                                                                                        href="{{ route('showItem', $items->order_id) }}">{{ $items->product_name }}</a>
                                                                                </h4>
                                                                            </div>
                                                                            <div class="product-qty">
                                                                                <span>
                                                                                    x{{ $items->product_quantity }}
                                                                                </span>
                                                                            </div>
                                                                            <div>
                                                                                <span>
                                                                                    {{ $items->product_price }}
                                                                                    đ
                                                                                </span>
                                                                            </div>

                                                                        </div>
                                                                        <div class=" col-md-3 product-status">
                                                                            <div>
                                                                                <h4>{{ App\Constants\Constants::STATUS_ORDER[$items->status ?? 0] }}
                                                                                </h4>
                                                                                <div>
                                                                                    @if (($items->status ?? 0) < App\Constants\Constants::DELIVERY)
                                                                                        <form
                                                                                            action="{{ route('order.cancel', $items->id) }}"
                                                                                            method="post">
                                                                                            @csrf
                                                                                            <button
                                                                                                style="width: 100%"
                                                                                                class="btn btn-cancel"
                                                                                                type="submit">Hủy
                                                                                            </button>
                                                                                        </form>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr>

                                                                <div class="product-total">
                                                                    <p>
                                                                        Thành tiền: <span>
                                                                            {{ number_format($orderList->total_money) }}
                                                                            đ
                                                                        </span>
                                                                    </p>

                                                                </div>

                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div id="completed" class="tab-pane">
                                    <div class="product-tab">
                                        @foreach ($orders as $orderList)
                                            @if (isset($orderList->user_id))
                                                @foreach ($orderStatus3 as $items)
                                                    @if ($orderList->id == $items->order_id)
                                                        <div style="margin-bottom: 10px">
                                                            <div class="row" style="background: white">
                                                                <div class="product-order">
                                                                    <div class="row"
                                                                        style="margin-right: 0px; margin-left:0px">
                                                                        <div class="col-xs-12 col-sm-12 col-md-3">
                                                                            <div style="padding-left: 50px"
                                                                                class="product-image">
                                                                                <a
                                                                                    href="{{ route('showItem', $items->order_id) }}"><img
                                                                                        style="width: 100px; height: 100px"
                                                                                        src="../images/{{ $items->product_image }}"
                                                                                        alt=""></a>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="col-xs-12 col-sm-12 col-md-6 product-details">

                                                                            <div>
                                                                                <h4>
                                                                                    <a
                                                                                        href="{{ route('showItem', $items->order_id) }}">{{ $items->product_name }}</a>
                                                                                </h4>
                                                                            </div>
                                                                            <div class="product-qty">
                                                                                <span>
                                                                                    x{{ $items->product_quantity }}
                                                                                </span>
                                                                            </div>
                                                                            <div>
                                                                                <span>
                                                                                    {{ $items->product_price }}
                                                                                    đ
                                                                                </span>
                                                                            </div>

                                                                        </div>
                                                                        <div class=" col-md-3 product-status">
                                                                            <div>
                                                                                <h4>{{ App\Constants\Constants::STATUS_ORDER[$items->status ?? 0] }}
                                                                                </h4>
                                                                                <div>
                                                                                    @if (($items->status ?? 0) < App\Constants\Constants::DELIVERY)
                                                                                        <form
                                                                                            action="{{ route('order.cancel', $items->id) }}"
                                                                                            method="post">
                                                                                            @csrf
                                                                                            <button
                                                                                                style="width: 100%"
                                                                                                class="btn btn-cancel"
                                                                                                type="submit">Hủy
                                                                                            </button>
                                                                                        </form>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr>

                                                                <div class="product-total">
                                                                    <p>
                                                                        Thành tiền: <span>
                                                                            {{ number_format($orderList->total_money) }}
                                                                            đ
                                                                        </span>
                                                                    </p>

                                                                </div>

                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div id="cancelled" class="tab-pane">
                                    <div class="product-tab">
                                        @foreach ($orders as $orderList)
                                            @if (isset($orderList->user_id))
                                                @foreach ($orderStatus4 as $items)
                                                    @if ($orderList->id == $items->order_id)
                                                        <div style="margin-bottom: 10px">
                                                            <div class="row" style="background: white">
                                                                <div class="product-order">
                                                                    <div class="row"
                                                                        style="margin-right: 0px; margin-left:0px">
                                                                        <div class="col-xs-12 col-sm-12 col-md-3">
                                                                            <div style="padding-left: 50px"
                                                                                class="product-image">
                                                                                <a
                                                                                    href="{{ route('showItem', $items->order_id) }}"><img
                                                                                        style="width: 100px; height: 100px"
                                                                                        src="../images/{{ $items->product_image }}"
                                                                                        alt=""></a>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="col-xs-12 col-sm-12 col-md-6 product-details">

                                                                            <div>
                                                                                <h4>
                                                                                    <a
                                                                                        href="{{ route('showItem', $items->order_id) }}">{{ $items->product_name }}</a>
                                                                                </h4>
                                                                            </div>
                                                                            <div class="product-qty">
                                                                                <span>
                                                                                    x{{ $items->product_quantity }}
                                                                                </span>
                                                                            </div>
                                                                            <div>
                                                                                <span>
                                                                                    {{ $items->product_price }}
                                                                                    đ
                                                                                </span>
                                                                            </div>

                                                                        </div>
                                                                        <div class=" col-md-3 product-status">
                                                                            <div>
                                                                                <h4>{{ App\Constants\Constants::STATUS_ORDER[$items->status ?? 0] }}
                                                                                </h4>
                                                                                <div>
                                                                                    @if (($items->status ?? 0) < App\Constants\Constants::DELIVERY)
                                                                                        <form
                                                                                            action="{{ route('order.cancel', $items->id) }}"
                                                                                            method="post">
                                                                                            @csrf
                                                                                            <button
                                                                                                style="width: 100%"
                                                                                                class="btn btn-cancel"
                                                                                                type="submit">Hủy
                                                                                            </button>
                                                                                        </form>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr>

                                                                <div class="product-total">
                                                                    <p>
                                                                        Thành tiền: <span>
                                                                            {{ number_format($orderList->total_money) }}
                                                                            đ
                                                                        </span>
                                                                    </p>

                                                                </div>

                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.tab-content -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<hr>
@include('footer')
