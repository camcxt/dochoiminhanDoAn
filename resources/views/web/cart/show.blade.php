@include('header')

<style>
    .checkOut {
        background: none repeat scroll 0 0 #5a88ca;
        border: medium none;
        color: #fff;
        padding: 13.5px 22px;
        text-transform: uppercase;
        color: #FFFFFF;
        text-decoration: none;
    }
    a {
    outline: none!important;
}
    table {
        border-collapse: collapse;
        width: 100%;
        
    }
    
    th,
    td {
        font-family: Arial;
        color: #b8bdc1;
        padding: 8px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }
    
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }

    .cart-collaterals {
        border: 1px solid #dee2e6;
        border-radius: 6px;
        box-shadow: 1px 2px 4px rgba(33,37,41,.05);
        padding: 2rem;
        margin-top: 4rem;
    }
    
</style>

<body class="cnt-home" style="background-color: #FFFFFF">
    <div class="body-content outer-top-xs">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div>
                        @if (session()->has('messageCartEmpty'))
                            <div class="alert alert-danger">
                               
                                {{ session('messageCartEmpty') }}
                            </div>
                        @endif
                        @if (session()->has('messError'))
                            <div id class="alert alert-danger">
                                {{ session('messError') }}
                            </div>
                        @endif   
                        <div id="messError"></div>                     
                    </div>

                    <h4><b>Giỏ hàng</b></h4>
                    <div class="product-info">
                        <table style="width:100%" cellspacing="0" class="cart-table">
                            <thead class="info-container m-t-20">
                                <tr>
                                    <th style="width:5%" class="product-remove">&nbsp;</th>
                                    <th style="width:15%" class="product-thumbnail">&nbsp;</th>
                                    <th style="width:35%" class="product-name"></th>
                                    <th style="width:10%" class="product-price">Giá</th>
                                    <th style="width:20%" class="product-quantity">Số lượng</th>
                                    <th style="width:15%" class="product-subtotal">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($carts as $cartList)
                                    <tr class="cart_item">
                                        <td class="product-remove">
                                            <button title="Remove this item"
                                                data-url="{{ route('deleteCart', $cartList->rowId) }}"
                                                data-name="{{ $cartList->name }}" data-id="{{ $cartList->rowId }}"
                                                class="btn-delete btn "><i class="fa fa-trash-o"></i></button>
                                        </td>
                                        <td class="product-thumbnail">
                                            <a href="{{ route('showProduct', $cartList->id) }}"><img width="145"
                                                    height="145" alt="poster_1_up" class="shop_thumbnail"
                                                    src="/dochoiminhan/public/images/{{ $cartList->options->image }}"></a>
                                        </td>
                                        <td class="product-name" >
                                            <h4><a
                                                style="color: #000000" 
                                                href="{{ route('showProduct', $cartList->id) }}">{{ $cartList->name }}</a></h4>
                                        </td>
                                        <td class="product-price">
                                            <span class="amount">{{ number_format($cartList->price) }} đ</span>
                                        </td>
                                        <td class="product-quantity" style="color: #000000" >
                                            <div class="quantity buttons_added" style="display: flex">
                                                <div>
                                                    <button data-url="{{ route('quantityPlus') }}"
                                                        data-urlDelete="{{ route('deleteCart', $cartList->rowId) }}"
                                                        data-status="minusCart" data-id="{{ $cartList->rowId }}"
                                                        class="btn minus quantityUpdate"><i class="fa fa-minus"></i></button>
                                                </div>
                                                <div>
                                                    <input type="number" onchange="updateCart(this)"
                                                        style="text-align: center;width: 100%; height: 100%; "
                                                        data-urlupdate="{{ route('update_Cart') }}"
                                                        id="quantity-{{ $cartList->rowId }}"
                                                        class="input-text qty text" title="Qty"
                                                        data-urlDelete="{{ route('deleteCart', $cartList->rowId) }}"
                                                        data-qty="{{ $cartList->qty }}"
                                                        data-id="{{ $cartList->rowId }}"
                                                        data-product="{{ $cartList->id }}"
                                                        name="quantity[{{ $cartList->rowId }}]"
                                                        value="{{ $cartList->qty }}" min="1">
                                                </div>
                                                <div>
                                                    <button data-url="{{ route('quantityPlus') }}"
                                                        data-urlDelete="{{ route('deleteCart', $cartList->rowId) }}"
                                                        data-status="addCart" data-id="{{ $cartList->rowId }}"
                                                        class="btn plus quantityUpdate"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="product-subtotal" style="color: #000000" >
                                            <span id="cost-{{ $cartList->rowId }}"
                                                class="amount">{{ number_format($cartList->price * $cartList->qty) }} đ
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="cart-collaterals" >
                        <div class="cart_totals ">
                            <h4><i class="fa fa-list-alt" aria-hidden="true"></i> <b> Tóm tắt đơn hàng</b></h4>                                                       
                            <table cellspacing="0" >
                                <tbody>
                                    <tr class="cart-subtotal">
                                        <th style="text-align: left">số lượng</th>
                                        <td style="color: #000000" ><span class="total">{{ $quantity }}</span></td>
                                    </tr>
                                    <tr class="cart-subtotal">
                                        <th style="text-align: left">Tạm tính</th>
                                        <td style="color: #000000" ><span class="amount totalCart">{{ number_format($totalMoney) }} đ</span>
                                        </td>
                                    </tr>
                                    <tr class="order-total">
                                        <th style="text-align: left">Tổng cộng</th>
                                        <td style="color: #000000" ><strong><span
                                                    class="amount totalCart">{{ number_format($totalMoney) }} đ</span></strong>
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                            <div>
                                <div>
                                    <a class="btn btn-primary cart-btn" style="width: 100%" href="{{ route('createOrder') }}">Đặt hàng</a> 
                                </div>                              
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- /.row -->
        </div>
    </div>   
</body>
<hr >
@include('footer')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"
    integrity="sha512-F636MAkMAhtTplahL9F6KmTfxTmYcAcjcCkyu0f0voT3N/6vzAuJ4Num55a0gEJ+hRLHhdz3vDvZpf6kqgEa5w=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.css"
    integrity="sha512-9tISBnhZjiw7MV4a1gbemtB9tmPcoJ7ahj8QWIc0daBCdvlKjEA48oLlo6zALYm3037tPYYulT0YQyJIJJoyMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="{{ asset('js/cartJS.js') }}"></script>
<script>
    $(document).ready(function() {
        // Tự động ẩn thông báo sau 5 giây
        setTimeout(function() {
            $('#messError').fadeOut('slow');
        }, 5000); // 5000 milliseconds = 5 seconds
    });  

    function updateCart(input) {
    var rowId = $(input).attr('data-id');
    var url = $(input).attr('data-urlupdate');
    var urlDelete = $(input).attr('data-urlDelete');
    var quantity = $(input).val();
    var _this = $(input);
    var total = 0;
    var amount = 0;
    if (quantity <= 0) {
        if (confirm('Bạn có muốn xóa sản phẩm ' + '?')) {
            $.ajax({
                method: 'GET',
                url: urlDelete,
                type: 'delete',
                success: function(response) {
                    $.each(response.carts, function(key, item) {
                        amount += parseInt(item.qty);
                        total += item.price * item.qty;
                        totalCost = '$' + total.toLocaleString('en-US');
                        totalItem = item.price * item.qty;
                    });
                    if (jQuery.isEmptyObject(response.carts)) {
                        $('#totalCost').text("0");
                        $('.totalCart').text("0");
                        $('.total').text("0");
                    } else {
                        $('#totalCost').text(totalCost);
                        $('.totalCart').text(totalCost);
                        $('.total').text(amount);
                    }
                    _this.parent().parent().parent().parent().remove()
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    //xử lý lỗi tại đây
                }
            })
        }
    } else {
        $.ajax({
            url: url,
            method: 'GET',
            dataType: 'json',
            data: {
                rowId: rowId,
                quantity: quantity,
            },
            success: function(response) {
                $.each(response.carts, function(key, item) {
                    
                    amount += parseInt(item.qty);
                    totalItem = '$' + (item.price * item.qty).toLocaleString('en-US');
                    total += item.price * item.qty;
                    totalCost = '$' + total.toLocaleString('en-US');
                    $('#cost-' + item.rowId).text(totalItem);
                    $('#quantity-' + item.rowId).val(item.qty);
                    $('#totalCost').text(totalCost);
                    $('.totalCart').text(totalCost);
                    $('.total').text(amount);

                });
                if (response.messError != "") {
                    $('#messError').html("<div class='alert alert-danger'>" + response.messError + "</div>");
                }
            }
        });
    }
};
</script>