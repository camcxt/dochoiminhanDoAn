@include('header')

<style>
    button,
    input,
    select,
    textarea {
        margin: 0;
        font-size: 100%;
        vertical-align: middle;
    }

    .cart-collaterals {
        padding: 2rem;
        padding-top: unset;
        margin-bottom: 4rem;
    }

    th,
    td {
        font-family: Arial;
        color: #b8bdc1;
        padding: 8px;
    }
</style>
<div class="body-content outer-top-xs" id="top-banner-and-menu">
    <div class="container">
        <div class="row">
            <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
                <div class="more-info-tab clearfix ">
                    <div></div>
                    <h3 class="new-product-title pull-left">Địa Chỉ Nhận Hàng</h3>
                    <!-- /.nav-tabs -->
                </div>
                <div class="tab-content outer-top-xs">
                    <div class="product-content-right">
                        <div class="woocommerce">
                            <div>
                                <h5><b>Họ và tên: </b><span>{{ $order->customer_name }}</span></h5>
                                <p><b>Số điện thoại: </b><span>{{ $order->customer_phone }}</span></p>
                                <p><b>Email: </b><span>{{ $order->customer_email }}</span></p>
                                <p><b>Địa chỉ: </b><span>{{ $order->address }}</span></p>
                            </div>
                            &emsp;
                            @foreach ($itemOrder as $orderItemList)
                                <div class="product-order">
                                    <div class="row" style="margin-right: 0px; margin-left:0px">
                                        <div class="col-xs-12 col-sm-12 col-md-3">
                                            <div style="padding-left: 50px" class="product-image">
                                                <a href="{{ route('showProduct', $orderItemList->product_id) }}"><img
                                                        width="145" height="145" alt="poster_1_up"
                                                        class="shop_thumbnail"
                                                        src="/dochoiminhan/public/images/{{ $orderItemList->product_image }}"></a>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-7 ">
                                            <div class="row">
                                                <div>
                                                    <div>
                                                        <h4>
                                                            <a
                                                                href="{{ route('showProduct', $orderItemList->product_id) }}">{{ $orderItemList->product_name }}</a>
                                                        </h4>
                                                    </div>
                                                    <div class="product-qty">
                                                        <span>x{{ $orderItemList->product_quantity }}</span>
                                                    </div>
                                                    <div>
                                                        <span
                                                            class="amount">${{ number_format($orderItemList->product_price) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" col-md-2 product-status">
                                            <div>
                                                <h4 style="color: red">
                                                    |{{ App\Constants\Constants::STATUS_ORDER[$orderItemList->status ?? 0] }}
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            @endforeach
                            <div class="cart-collaterals" style="margin-left: 70%;">
                                <table cellspacing="0">
                                    <tbody>
                                        <tr class="cart-subtotal">
                                            <th>số lượng: </th>
                                            <td><span class="total">{{ $order->total_products }}</span></td>
                                        </tr>
                                        <tr class="cart-subtotal">
                                            <th>Phí vận chuyển</th>
                                            <td><span class="amount totalCart">Tính
                                                    sau</span>
                                            </td>
                                        </tr>
                                        <tr class="order-total">
                                            <th>Thành tiền</th>
                                            <td style="color: red ;"><strong><span
                                                        class="amount totalCart">{{ number_format($order->total_money) }}
                                                        đ</span></strong>
                                            </td>
                                        </tr>
                                        <tr class="cart-subtotal">
                                            <th>Phương thức thanh toán:</th>
                                            <td><span class="amount totalCart">Thanh toán khi nhận hàng</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@include('footer')
