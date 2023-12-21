<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">
    <link href="{{ asset('css/invoice-css.css') }}" rel="stylesheet">
    <!-- Fonts -->

</head>

<body style="font-family: 'DejaVu Sans'">
    <div>ĐỒ CHƠI THÔNG MINH AN</div>
    <div class="page">
        
        <br />
        <div class="title">
            HÓA ĐƠN THANH TOÁN
            <br />
            -------oOo-------
        </div>
        <br />
        <br />
        <div class="product-inner" >
            <div>
                <p>Hóa đơn: #MA{{ $order->id }}</p>
                <p>Ngày: {{ $currentDateTime }}</p>
            </div>
            <div style="display: flex;">
                <h3 class=" product-name">Họ và tên: {{ $order->customer_name }}</h3>
                <p>Số điện thoại: {{ $order->customer_phone }}</p> 
                <p>Email: {{ $order->customer_email }}</p> 
                <p>Thời gian mua hàng: {{ $order->created_date }}</p> 
                <p>Địa chỉ: {{ $order->address }}</p>
            </div>
        </div>
        <table class="TableData">
            <thead>
                <tr>
                    <th style="width:5%; text-align: center;">STT</th>
                    <th style="width:55%;">Sản phẩm</th>
                    <th style="width:15%; text-align: center;">Giá</th>
                    <th style="width:10%; text-align: center;">Số lượng</th>
                    <th style="width:15%; text-align: center;">Thành tiền</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($itemOrder as $key => $itemOrderData)
                    <tr>
                        <td style="text-align: center;">{{ $key + 1 }}
                        </td>
                        <td>{{ $itemOrderData->product_name }}</td>
                        <td style="text-align: right;">
                            {{ number_format($itemOrderData->product_price) }}đ
                        </td>
                        <td style="text-align: center;">
                            {{ $itemOrderData->product_quantity }}</td>
                        <td style="text-align: right;">
                            {{ number_format($itemOrderData->product_price * $itemOrderData->product_quantity) }}đ
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3" style="text-align: center">Tổng</td>
                    <td style="text-align: center;">{{ $order->total_products }}</td>
                    <td style="text-align: right;">{{ number_format($order->total_money) }}đ</td>
                </tr>
            </tbody>
        </table>
        <br>
        <div class="footer-left"> <br />
            Khách hàng </div>
        <div class="footer-right"> <br />
            Nhân viên </div>
    </div>
</body>
