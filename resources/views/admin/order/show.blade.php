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
                <div class="widget">
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item" style="width: 90%;"><i
                                class="icon-shopping-cart"></i>
                            &emsp;ĐƠN HÀNG &emsp;</li>
                        <li>
                            &emsp14;
                            <div>
                                <form action="{{ route('exportOrder') }}" method="get">
                                    <input type="hidden" name="name"
                                        value="{{ $dataSearch['name'] }}">
                                    <input type="hidden" name="phone"
                                        value="{{ $dataSearch['phone'] }}">
                                    <input type="hidden" name="email"
                                        value="{{ $dataSearch['email'] }}">
                                    <input type="hidden" name="status"
                                        value="{{ $dataSearch['status'] }}">
                                    <a href="{{ route('statisticOrder') }}" class="btn btn-primary"><i class="icon-bar-chart"></i></a>
                                    <button type="submit" class="btn btn-primary">Export</button>
                                   
                                </form>
                            </div>
                        </li>
                    </ol>
                    <div class="widget-content">
                        <form action=" {{ route('indexOrder') }} " method="get">
                            <div class="search"> &emsp;
                                <div class="search-element">
                                    <div class="control-group detail" style="width: 30%;">
                                        <label class="form-control detail-left">Tên khách hàng</label>
                                        <input id='searchInput' style="width: 57%;"
                                            class="form-control" name="inputName" type='text'
                                            placeholder="Tên khách hàng" />
                                    </div>
                                    <div class="control-group detail" style="width: 25%;">
                                        <label class="form-control detail-left">Số điện thoại</label>
                                        <input style="width: 57%;" class="form-control"
                                            name="inputPhone" type='text' placeholder='Số điện thoại' />
                                    </div>
                                    <div class="control-group detail" style="width: 25%;">
                                        <label class="form-control detail-left">Email</label>
                                        <input style="width: 57%;" class="form-control"
                                            name="inputEmail" type='text' placeholder='Email' />
                                    </div>
                                    <div class="control-group" style="width: 10%; height: 90%;">
                                        <button class="btn btn-secondary" name="btnSearch"
                                            value="btnSearch"
                                            style="color: black ;border-radius: 20px; height: 90%;"><i
                                                class="icon-search"></i></button>
                                        &emsp;
                                        <a href="{{ route('indexOrder') }}"
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
                                    <th style="width:5%; text-align: center;">STT</th>
                                    <th style="width:15%; text-align: left;">Tên khách hàng</th>
                                    <th style="width:10%; text-align: left;">Email</th>
                                    <th style="width:5%; text-align: center;">số điện thoại</th>
                                    <th style="width:10%; text-align: center;">thành tiền</th>
                                    <th style="width:10%; text-align: center;">thời gian</th>
                                    <th style="width:25%; text-align: center;">sản phẩm</th>
                                    <th style="width:10%; text-align: center;">tác vụ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $key => $orderList)
                                    <tr>
                                        <td style="text-align: center;">{{ $key + 1 }}</td>
                                        <td style="text-align: left;">
                                            {{ $orderList->customer_name }}</td>
                                        <td style="text-align: left;">
                                            {{ $orderList->customer_email }}</td>
                                        <td style="text-align: center;">
                                            {{ $orderList->customer_phone }}</td>
                                        <td style="text-align: right;">
                                            ${{ number_format($orderList->total_money) }}
                                        </td>
                                        <td style="text-align: center;">
                                            {{ $orderList->created_date }}</td>
                                        <td style="text-align: left;">
                                            @foreach ($itemOrder as $items)
                                                @if ($orderList->id == $items->order_id)
                                                    <p>- {{ $items->product_name }}
                                                        (<span>{{ $items->product_quantity }}</span>)
                                                    </p>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td style="text-align: center;">
                                            <a href="{{ route('showbyId', $orderList->id) }}"
                                                class="btn btn-primary"><i
                                                    class="icon-eye-open"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- /row -->
        </div> <!-- /container -->
    </div> <!-- /main-inner -->
</div> <!-- /main -->

@include ('admin.footer')
<!-- /footer -->
