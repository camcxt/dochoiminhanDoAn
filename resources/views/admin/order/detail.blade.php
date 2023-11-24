@include ('admin.index')

<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="row">
                <div class="span12">
                    <div class="widget ">
                        <div class="widget-content">
                            <div class="detail">
                                <div class="col-sm-12">
                                    <div class="product-inner">
                                        <h2 class="product-name">{{ $order->customer_name }}</h2>
                                        <div style="display: flex;"><b>Số điện thoại:</b> &ensp; <p>{{ $order->customer_phone }}
                                            </p>
                                        </div>
                                        <div style="display: flex;"><b>Email:</b> &ensp; <p>{{ $order->customer_email }}
                                            </p>
                                        </div>
                                        <div style="display: flex;"><b>Thời gian:</b> &ensp; <p>{{ $order->created_date }}
                                            </p>
                                        </div>
                                        <div style="display: flex;"><b>Địa chỉ:</b> &ensp; <p>{{ $order->address }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- hết  -->
                        </div>

                        &emsp;

                        <div class="widget-content">
                            <div id="message">
                                @if (session()->has('message'))
                                    <div class="alert alert-success">
                                        {{ session('message') }}
                                    </div>
                                @endif

                                @if (session()->has('message-error'))
                                    <div class="alert alert-danger">
                                        {{ session('message-error') }}
                                    </div>
                                @endif
                            </div>

                            <div class="col-md-12">
                                <div class="container-fluid">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <div class="widget-content">
                                                    <table style="width:100%"
                                                        class="table table-striped table-bordered">

                                                        <thead>
                                                            <tr>
                                                                <th style="width:5%; text-align: center;">STT</th>
                                                                <th style="width:15%; text-align: center;">hình ảnh</th>
                                                                <th style="width:18%;">sản phẩm</th>
                                                                <th style="width:12%; text-align: center;">giá</th>
                                                                <th style="width:10%; text-align: center;">số lượng</th>
                                                                <th style="width:10%; text-align: center;">thành tiền</th>
                                                                <th style="width:10%; text-align: center;">trạng thái</th>
                                                                <th colspan="2" style="width:20%; text-align: center;">tác vụ</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            @foreach ($itemOrder as $key => $itemOrderData)
                                                                <tr>
                                                                    <td style="text-align: center;">{{ $key + 1 }}
                                                                    </td>
                                                                    <td style="text-align: center;"><img
                                                                            src="../images/{{ $itemOrderData->product_image }}"
                                                                            height="50px" width="150px"
                                                                            alt="Khong tai duoc"></td>
                                                                    <td>{{ $itemOrderData->product_name }}</td>
                                                                    <td style="text-align: right;">
                                                                        ${{ number_format($itemOrderData->product_price) }}
                                                                    </td>
                                                                    <td style="text-align: center;">
                                                                        {{ $itemOrderData->product_quantity }}</td>
                                                                    <td style="text-align: right;">
                                                                        ${{ number_format($itemOrderData->product_price * $itemOrderData->product_quantity) }}
                                                                    </td>
                                                                    <td style="text-align: center;">{{ App\Constants\Constants::STATUS_ORDER[$itemOrderData->status ?? 0] }}
                                                                    </td>
                                                                    <td style="text-align: center;">
                                                                        @if (($itemOrderData->status ?? 0) < App\Constants\Constants::PAID)
                                                                            <form
                                                                                action="{{ route('order.update', $itemOrderData->id) }}"
                                                                                method="post">
                                                                                @csrf
                                                                                <button
                                                                                    class="btn {{ \App\Constants\Constants::BUTTON_ORDER[$itemOrderData->status ?? 0] }}"
                                                                                    type="submit"><i class="icon-edit"></i></button>
                                                                            </form>
                                                                        @endif
                                                                    </td>
                                                                    <td style="text-align: center;">
                                                                        @if (($itemOrderData->status ?? 0) < App\Constants\Constants::PAID)
                                                                            <form
                                                                                action="{{ route('order.cancel', $itemOrderData->id) }}"
                                                                                method="post">
                                                                                @csrf
                                                                                <button class="btn btn-danger"
                                                                                    type="submit">Hủy</button>
                                                                            </form>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>

                                                    </table>

                                                    <div style="margin-left: 80%;">
                                                        <div style="display: flex;"><b>Total product:</b> &ensp; <p>
                                                                {{ $order->total_products }}</p>
                                                        </div>
                                                        <div style="display: flex;"><b>Total money:</b> &ensp; $<p>
                                                                {{ number_format($order->total_money) }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include ('admin.footer')
<!-- /footer -->
