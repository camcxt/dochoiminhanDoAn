@include ('admin.index')
<style>
    .search-element {
        display: flex;
        justify-content: flex-start;
        width: 100%;
    }

    .search {
        display: flex;
        flex-direction: column;
        align-content: space-between;
        height: 15%;
        width: 100%;
        margin-left: 6%;
    }

    .detail {
        display: flex;
        align-items: center;
    }

    th {
        text-align: center;
    }

    .detail-left {
        width: 30%;
    }

    .detail-right {
        width: 60%;
    }
</style>
<div class="main">
    <div class="main-inner">
        <div class="container-fluid">
            <div class="row" style="margin-left: 0px">
                <div class="widget ">
                    <div class="widget-header">
                        <i class="icon-shopping-cart"></i>
                        <h3>ĐƠN HÀNG</h3>
                    </div> <!-- /widget-header -->
                    <div class="widget-content">
                        <form action=" {{ route('statisticOrder') }} " method="get">
                            <div class="search"> &emsp;
                                <div class="search-element">
                                    <div class="control-group detail" style="width: 30%;">
                                        <label class="form-control detail-left">Trạng thái:</label>
                                        <select class="detail-right" style="height: 28px;" name="status">
                                            
                                            <option value="">-----</option>
                                            <option value="0">Chưa xác nhận</option>
                                            <option value="1">Đã xác nhận</option>
                                            <option value="2">Đang giao</option>
                                            <option value="3">Đã thanh toán</option>
                                            <option value="4">Đã hủy</option>
                                            
                                        </select>                                                            
                                    </div>
                                    <div class="control-group" style="width: 10%; height: 90%;">
                                        <button class="btn btn-secondary" 
                                            type="submit"
                                            style="color: black ;border-radius: 20px; height: 90%;"><i
                                                class="icon-search"></i></button>
                                        &emsp;
                                        <a href="{{ route('statisticOrder') }}"
                                            class="btn btn-secondary"
                                            style="color: black ;border-radius: 20px; height: 70%;"><i
                                                class="icon-retweet"></i></a>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <table style="width:100%" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width:2%; text-align: center;">STT</th>
                                    <th style="width:15%; text-align: left;">Tên khách hàng</th>
                                    <th style="width:10%; text-align: left;">Email</th>
                                    <th style="width:5%; text-align: center;">Số điện thoại</th>
                                    <th style="width:5%; text-align: center;">Thành tiền</th>
                                    <th style="width:10%; text-align: center;">Thời gian</th>
                                    <th style="width:25%; text-align: center;">Sản phẩm</th>
                                    <th style="width:7%; text-align: center;">Trạng thái</th>
                                    <th style="width:10%; text-align: center;">Tác vụ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $key=> $orderList)
                                    @if (isset($orderList->user_id))
                                    @foreach ($itemOrder as  $key=> $items)
                                        @if ($orderList->id == $items->order_id)
                                            <tr>
                                                <td style="text-align: center;">{{ $key + 1 }}</td>
                                                <td style="text-align: left;">
                                                    {{ $orderList->customer_name }}</td>
                                                <td style="text-align: left;">
                                                    {{ $orderList->customer_email }}</td>
                                                <td style="text-align: center;">
                                                    {{ $orderList->customer_phone }}</td>
                                                <td style="text-align: right;">
                                                    {{ number_format($items->product_price*$items->product_quantity) }}đ
                                                </td>
                                                <td style="text-align: center;">
                                                    {{ $orderList->created_date }}</td>
                                                <td style="text-align: left;">                                                    
                                                    <p>- {{ $items->product_name }}
                                                        (<span>{{ $items->product_quantity }}</span>)
                                                    </p>                                                        
                                                </td>
                                                <td>                                                    
                                                    @if ($orderList->id == $items->order_id)
                                                    @if ($items->status==0)
                                                    <p>Chưa xác nhận</p>
                                                    @elseif($items->status==1)
                                                    <p>Đã xác nhận</p>
                                                    @elseif($items->status==2)
                                                    <p>Đang giao</p>
                                                    @elseif($items->status==3)
                                                    <p>Đã thanh toán</p>
                                                    @elseif($items->status==4)
                                                    <p>Đã hủy</p>
                                                    @endif       
                                                    @endif                                                   
                                                </td>
                                                <td style="text-align: center;">
                                                    <a href="{{ route('showbyId', $orderList->id) }}"
                                                        class="btn btn-primary"><i
                                                            class="icon-eye-open"></i></a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div> 
                </div> <!-- /widget -->
            </div> <!-- /row -->
        </div> <!-- /container -->
    </div> <!-- /main-inner -->
</div> <!-- /main -->

@include ('admin.footer')
<!-- /footer -->