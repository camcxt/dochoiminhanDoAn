@include('header')

<style>
    button,
    input,
    select,
    textarea {
        margin: 0;
        font-size: 100%;
        vertical-align: middle;
        border: 1px solid rgb(206, 212, 218);
    }

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

    .checkOut {
        background: none repeat scroll 0 0 #5a88ca;
        border: medium none;
        color: #fff;
        padding: 13.5px 22px;
        text-transform: uppercase;
        color: #FFFFFF;
        text-decoration: none;
    }

    .table {
        border-collapse: collapse;
        width: 100%;

    }

    th,
    td {
        font-family: Arial;
        color: #b8bdc1;
        padding: 8px;
        border-bottom: 1px solid #ddd;

    }

    td {
        width: 100px;
    }

    .cart-collaterals {
        border: 1px solid #dee2e6;
        border-radius: 6px;
        box-shadow: 1px 2px 4px rgba(33, 37, 41, .05);
        padding: 2rem;
        margin-top: 4rem;
    }
</style>

<body class="cnt-home" style="background-color: #FFFFFF">
    <div class="body-content outer-top-xs">
        <div class="container">
            <div class="row ">
                <div class="shopping-cart">
                    @if (isset(Auth::user()->id))
                    @else
                        <div class="alert-none w-100">
                            <p>
                                Đăng nhập để nhận ưu đãi khi mua hàng! <a href="{{ route('login') }}">Đăng nhập</a>
                                <br>
                                Bạn chưa có tài khoản? <a href="{{ route('register') }}">Đăng ký</a>
                            </p>
                        </div>
                    @endif
                    <div class="row">
                        <form name="frmAddCart" method="post" action="{{ route('storeOrder') }}">
                            @csrf
                            <div class="col-md-4 col-sm-12 estimate-ship-tax">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>
                                                <span class="estimate-title">Thông tin liên hệ</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <!-- /thead -->
                                    <tbody>
                                        <tr>
                                            <td>
                                                @if (isset(Auth::user()->id))
                                                    <input type="hidden" value="{{ Auth::user()->id }}" placeholder=""
                                                        id="user_id" name="user_id" class="input-text">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Tên người nhận <abbr
                                                                title="required" class="required">*</abbr></label>
                                                        <input class="form-control unicase-form-control text-input"
                                                            required name="customer_name"
                                                            value="{{ Auth::user()->username }}" class="form-control"
                                                            placeholder="Tên người nhận">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Số điện thoại người nhận <abbr
                                                                title="required" class="required">*</abbr></label>
                                                        <input class="form-control unicase-form-control text-input"
                                                            required name="customer_phone" class="form-control"
                                                            value="{{ Auth::user()->phone }}"
                                                            placeholder="Số điện thoại người nhận">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Email người nhận <abbr
                                                                title="required" class="required">*</abbr></label>
                                                        <input class="form-control unicase-form-control text-input"
                                                            disabled value="{{ Auth::user()->email }}" required
                                                            class="form-control">
                                                        <input type="hidden" value="{{ Auth::user()->email }}" required
                                                            name="customer_email" class="form-control">
                                                    </div>

                                                    <input type="hidden" value="{{ Auth::user()->id }}" placeholder=""
                                                        id="user_id" name="user_id" class="input-text ">
                                                @else
                                                    <input type="hidden" placeholder="" id="user_id" name="user_id"
                                                        class="input-text">

                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Tên người nhận <abbr
                                                                title="required" class="required">*</abbr></label>
                                                        <input class="form-control unicase-form-control text-input"
                                                            required name="customer_name" class="form-control"
                                                            aria-describedby="emailHelp" placeholder="Tên người nhận">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Số điện thoại người nhận <abbr
                                                                title="required" class="required">*</abbr></label>
                                                        <input class="form-control unicase-form-control text-input"
                                                            required name="customer_phone" class="form-control"
                                                            aria-describedby="emailHelp"
                                                            placeholder="Số điện thoại người nhận">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Email người nhận <abbr
                                                                title="required" class="required">*</abbr></label>
                                                        <input class="form-control unicase-form-control text-input"
                                                            value="" required name="customer_email"
                                                            class="form-control" placeholder="Email người nhận">
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.estimate-ship-tax -->
                            <div class="col-md-4 col-sm-12 estimate-ship-tax">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>
                                                <span class="estimate-title">Địa chỉ</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <!-- /thead -->
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                                        <label class="info-title control-label">Tỉnh/ Thành
                                                            <span>*</span></label>
                                                        <select  name="provinces" id="provinces"
                                                            class="form-control country_to_state country_select choose provinces">
                                                            <option value="" >--Tỉnh/ Thành--</option>
                                                            @foreach ($provinces as $provinceData)
                                                                <option value="{{ $provinceData->id }}">{{ $provinceData->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </p>
                                                </div>
                                                <div class="form-group">
                                                    <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                                        <label class="info-title control-label">Quận/ Huyện
                                                            <span>*</span></label>
                                                        <select name="districts" id="districts"
                                                            class="form-control country_to_state country_select choose districts">
                                                            <option value="">--Quận/ Huyện--</option>
                                                        </select>
                                                    </p>
                                                </div>
                                                <div class="form-group">
                                                    <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                                        <label class="info-title control-label">Phường/ Xã
                                                            <span>*</span></label>
                                                        <select name="wards" id="wards"
                                                            class="form-control country_to_state country_select wards">
                                                            <option value="">--Phường/ Xã--</option>
                                                        </select>
                                                    </p>
                                                </div>
                                                <div class="form-group">
                                                    <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                                        <label class="info-title control-label">Địa chỉ
                                                            <span>*</span></label>
                                                        <input class="form-control unicase-form-control text-input" type="text" placeholder="Địa chỉ"  id="billing_address_1"
                                                            name="address" required class="input-text form-control">
                                                    </p>
                                                </div>
                                                
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.estimate-ship-tax -->
                            <div class="col-md-4 ">
                                <div class="cart-collaterals">
                                    <div class="cart_totals ">
                                        <h4><i class="fa fa-list-alt" aria-hidden="true"></i> <b> Tóm tắt đơn hàng</b>
                                        </h4>
                                        <table cellspacing="0">
                                            <tbody>
                                                <tr class="cart-subtotal">
                                                    <th >Sản phẩm</th>
                                                    <td><b>Thành tiền</b></td>
                                                </tr>
                                                @foreach ($carts as $cartList)
                                                    <tr class="cart-subtotal">
                                                        <th > <a style="color: #000000"
                                                                href="{{ route('showProduct', $cartList->id) }}">{{ $cartList->name }}
                                                                x {{ $cartList->qty }}</a></th>
                                                        <td style="color: #000000;"><span
                                                                class="amount totalCart">{{ number_format($cartList->price) }}
                                                                đ</span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr class="cart-subtotal">
                                                    <th >Số lượng</th>
                                                    <td  style="color: #000000; text-align: center"><span
                                                            class="total">{{ $quantity }}</span>
                                                    </td>
                                                    <input type="hidden" value="{{ $quantity }}" required
                                                        name="total_products" class="form-control">
                                                </tr>
                                                <tr class="cart-subtotal">
                                                    <th >Tạm tính</th>
                                                    <td style="color: #000000"><span
                                                            class="amount totalCart">{{ number_format($totalMoney) }}
                                                            đ</span>
                                                    </td>
                                                </tr>
                                                <tr class="order-total">
                                                    <th >Tổng cộng</th>
                                                    <td style="color: #000000"><strong><span
                                                                class="amount totalCart">{{ number_format($totalMoney) }}
                                                                đ</span></strong>
                                                    </td>
                                                    <input type="hidden" value="{{ $totalMoney }}" required
                                                        name="total_money" class="form-control">
                                                </tr>
                                            </tbody>
                                        </table>
                                        <br>
                                        <div>
                                            <div>
                                                <input style="width: 100%" type="submit" data-value="Place order"
                                                    value="Đặt hàng" id="place_order"
                                                    name="woocommerce_checkout_place_order"
                                                    class="btn btn-primary button alt">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<hr>
@include('footer')

<script type="text/javascript">
    $(document).ready(function() {
        $('.choose').on('change', function() {
            var action = $(this).attr('id');
            var id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = "";
            if (action == 'provinces') {
                result = 'districts';
            } else {
                result = 'wards';
            }
            $.ajax({
                url: "{{ route('select-delivery') }}",
                method: 'POST',
                data: {
                    action: action,
                    id: id,
                    _token: _token
                },
                success: function(data) {
                    $('#' + result).html(data);
                },
            });
        })
    });
</script>
