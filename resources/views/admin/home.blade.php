@include ('admin.index')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="row">

                <!-- /span6 -->
                <div class="span6">
                    <div class="widget">
                        <div class="widget-header"> <i class="icon-bookmark"></i>
                            <h3></h3>
                        </div>
                        <!-- /widget-header -->
                        <div class="widget-content">
                            <div class="shortcuts"> <a href="{{ route('showCate') }}" class="shortcut"><i
                                        class="shortcut-icon icon-list-alt"></i><span class="shortcut-label"> Danh mục
                                    </span> </a><a href="{{ route('showBrand') }}" class="shortcut"><i
                                        class="shortcut-icon icon-bookmark"></i><span
                                        class="shortcut-label">Thương hiệu</span>
                                </a><a href="{{ route('indexProduct') }}" class="shortcut"><i
                                        class="shortcut-icon icon-inbox"></i> <span class="shortcut-label">Sản phẩm
                                    </span> </a><a href="{{ route('indexBanners') }}" class="shortcut"> <i
                                        class="shortcut-icon icon-align-justify"></i><span
                                        class="shortcut-label">Quảng cáo
                                    </span> </a><a href="{{ route('indexUser') }}" class="shortcut"><i
                                        class="shortcut-icon icon-user"></i><span class="shortcut-label">Tài khoản
                                    </span> </a>
                                {{-- <a href="{{ route('indexReport') }}" class="shortcut"><i
                                        class="shortcut-icon icon-bullhorn"></i><span
                                        class="shortcut-label">Report</span>
                                    </a> --}}
                                <a href="{{ route('indexOrder') }}" class="shortcut"><i
                                        class="shortcut-icon icon-shopping-cart"></i>
                                    <span class="shortcut-label">Đơn hàng</span> </a>
                                <a href="{{ route('indexStatistic') }}" class="shortcut"><i
                                        class="shortcut-icon icon-bar-chart"></i>
                                    <span class="shortcut-label">Thống kê</span> </a>
                            </div>
                            <!-- /widget-content -->
                        </div><!-- /widget -->
                    </div>
                    <!-- /span12 -->
                    <div class="widget-content">
                        <div class="widget-header"> 
                            <h3> Top sản phẩm bán chạy</h3>
                        </div>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 5%; text-align: center;">STT</th>
                                    <th style="width: 50%; text-align: center;">Tên sản phẩm</th>
                                    <th style="width: 25%; text-align: center;">hình ảnh</th>
                                    <th style="width: 20%; text-align: center;">Số lượng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order as $key => $orderList)
                                    <tr>
                                        <td style="text-align: center;">{{ $key + 1 }}</td>
                                        <td style="text-align: center;"><a
                                                href="{{ route('showImage', $orderList->product_id) }}">{{ $orderList->product_name }}</a>
                                        </td>
                                        <td style="text-align: center;"><img
                                                src="/dochoiminhan/public/images/{{ $orderList->product_image }}"
                                                width="100px" alt="Khong tai duoc"></td>
                                        <td style="text-align: center;">{{ $orderList->total }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="span6">
                    <div class="widget widget-nopad">
                        <div class="widget-header"> <i class="icon-list-alt"></i>
                            <h3> Thống kê hôm nay</h3>
                        </div>
                        <!-- /widget-header -->
                        <div class="widget-content">
                            <div class="widget big-stats-container">
                                <div class="widget-content">
                                    <h6></h6>
                                    <div id="big_stats" class="cf">
                                        <div class="stat"> <a style="text-decoration: none"
                                                href="{{ route('indexOrder') }}"><i class="icon-shopping-cart"></i></a>
                                            <span class="value">{{ $totalOrder }}</span>
                                        </div>
                                        <!-- .stat -->
                                        <div class="stat"><a style="text-decoration: none"
                                                href="{{ route('indexUser') }}"><i class="icon-user"></i></a>
                                            <span class="value">{{ $totalUser }}</span>
                                        </div>
                                        <!-- .stat -->

                                        <div class="stat"> <a style="text-decoration: none"
                                                href="{{ route('indexProduct') }}"><i class="icon-inbox"></i></a> <span
                                                class="value"> {{ $totalProduct }} </span> </div>
                                        <!-- .stat -->

                                        <div class="stat"> <a style="text-decoration: none"
                                                href="{{ route('indexOrder') }}"><i class="icon-bullhorn"></i></a><span
                                                class="value">{{ $totalOrderInactive }}</span>
                                            <!-- .stat -->
                                        </div>
                                    </div>
                                    <!-- /widget-content -->
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="widget">
                            <div class="widget-content">
                                <div class="widget-header"> 
                                    <h3> Top đơn hàng</h3>
                                </div>
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%; text-align: center;"> stt </th>
                                            <th style="width: 50%; text-align: left;"> tên khách hàng </th>
                                            <th style="width: 15%; text-align: center;"> thành tiền </th>
                                            <th style="width: 30%; text-align: center;"> Ngày </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orderData as $key => $orderListTop)
                                            <tr>
                                                <td style="text-align: center;">{{ $key + 1 }}</td>
                                                <td style="text-align: left;"><a
                                                        href="{{ route('showbyId', $orderListTop->id) }}">{{ $orderListTop->customer_name }}</a>
                                                </td>
                                                <td style="text-align: right;">
                                                    ${{ number_format($orderListTop->total_money) }}</td>
                                                <td style="text-align: center;">{{ $orderListTop->created_date }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /row -->
                </div>
                <!-- /container -->
            </div>
            <!-- /main-inner -->
        </div>
    </div>
@include ('admin.footer')
