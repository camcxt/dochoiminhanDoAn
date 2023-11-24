@include ('admin.index')

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<link href="{{ asset('css/css/pages/reports.css') }}" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('css/statistics.css') }}">

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"
    integrity="sha512-F636MAkMAhtTplahL9F6KmTfxTmYcAcjcCkyu0f0voT3N/6vzAuJ4Num55a0gEJ+hRLHhdz3vDvZpf6kqgEa5w=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.css"
    integrity="sha512-9tISBnhZjiw7MV4a1gbemtB9tmPcoJ7ahj8QWIc0daBCdvlKjEA48oLlo6zALYm3037tPYYulT0YQyJIJJoyMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="row">
                <div class="span6">
                    <div class="widget widget-nopad">
                        <div class="widget-header"> <i class="icon-list-alt"></i>
                            <h3> Thống kê hôm nay</h3>
                        </div>
                        <!-- /widget-header -->
                        <div class="widget-content">
                            <div class="widget big-stats-container">
                                <div class="widget-content">
                                    <h6 ></h6>
                                    <div id="big_stats" class="cf">
                                        <div class="stat"> <i class="icon-shopping-cart"></i> <span class="value">{{$totalOrder}}</span>
                                        </div>
                                        <!-- .stat -->

                                        <div class="stat"> <i class="icon-user"></i> <span
                                                class="value">{{$totalUser}}</span> </div>
                                        <!-- .stat -->

                                        <div class="stat"> <i class="icon-inbox"></i> <span
                                                class="value"> {{$totalProduct}} </span> </div>
                                        <!-- .stat -->

                                        <div class="stat"> <i class="icon-bullhorn"></i> <span
                                                class="value">{{$totalOrderInactive}}</span> </div>
                                        <!-- .stat -->
                                    </div>
                                </div>
                                <!-- /widget-content -->

                            </div>
                        </div>
                    </div>
                    <!-- /widget -->
                    <div class="widget">
                        <div class="widget-header"> <i class="icon-signal"></i>
                            <h3> Số lượng sản phẩm tồn kho</h3>
                        </div>
                        <div class="widget-content">
                            <div class="widget-content">
                                <canvas id="productChart"></canvas>
                            </div>
                            <br>
                            <div>
                                <table>
                                    <thead>
                                        <tr>   
                                            <th>Tên sản phẩm</th>
                                            <th>Số lượng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($topProducts as $product)    
                                            <tr>    
                                                <td><a href="{{ route('showImage', $product->id) }}">{{ $product->name }}</a></td>
                                                <td>{{ $product->amount }}</td>
                                            </tr>    
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <br>
                        <div class="widget" >
                            <div class="widget-header"> <i class="icon-signal"></i>
                                <h3> Sản phẩm hết hàng</h3>
                            </div>
                            <div class="widget-content">
                                <table>
                                    <thead>
                                        <tr>   
                                            <th>Tên sản phẩm</th>
                                            <th>Số lượng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($outOfStockProduct as $product)    
                                            <tr>    
                                                <td><a href="{{ route('showImage', $product->id) }}">{{ $product->name }}</a></td>
                                                <td>{{ $product->amount }}</td>
                                            </tr>    
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div> 
                    </div>
                </div>
                <!-- /span6 -->
                <div class="span6">    
                    <!-- /widget -->
                    <div class="widget">
                        <div class="widget-header"> <i class="icon-signal"></i>
                            <h3> Doanh thu bán hàng</h3>
                        </div>
                        <!-- /widget-header --> 
                        <div class="widget-content">
                            <form action="{{ route('indexStatistic') }}" method="get">
                                @csrf
                                <label for="start_date">Từ ngày:</label>
                                <input value="{{request('start_date') ?? null}}" type="date" name="start_date">
                                <label for="end_date">Đến ngày:</label>
                                <input value="{{request('end_date') ?? null}}" type="date" name="end_date">
                                <p><button type="submit">Xem doanh thu</button></p>                                
                            </form>
                            <div class="widget-content">
                                <canvas id="revenueChart"></canvas>
                            </div>
                            <br>
                            <div >
                                <table>
                                    <thead>
                                        <tr>   
                                            <th>Ngày bán</th>
                                            <th>Số lượng</th>
                                            <th>Tổng tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sales as $sale)    
                                            <tr>    
                                                <td>{{ $sale->day }}</td>
                                                <td>{{ $sale->totalProducts }}</td>
                                                <td>{{ $sale->totalMoney }}</td>
                                            </tr>    
                                        @endforeach
                                        <tr>
                                            <td colspan="2">Tổng:</td>
                                            <td> {{ $totalMoneyProduct }} </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>       
                        <!-- /widget-content -->
                    </div>
                    <!-- /widget -->   
                </div>
                <!-- /span6 -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /main-inner -->
</div>  

@include ('admin.footer')
<!-- /footer -->
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
{{-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script> --}}
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script
src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
</script>
<script type="text/javascript">
    $(document).ready(function() {
    var ctx = document.getElementById('revenueChart').getContext('2d');
    var revenueData = {!! json_encode($revenueData) !!};
    var dates = Object.keys(revenueData);
    var revenues = Object.values(revenueData);
    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: dates,
            datasets: [{
                label: 'Doanh thu theo ngày',
                data: revenues,
                borderColor: 'rgb(48, 161, 161)',
                tension: 0.1,
            }],
        },
        options: {
            scales: {
                x: {
                    type: 'time',
                    time: {
                        unit: 'day',
                        tooltipFormat: 'll',   
                    },
                },
                y: {
                    beginAtZero: true,
                },
            },
        },
    }); 
    
    var ctx2 = document.getElementById('productChart').getContext('2d');
    var productCounts = {!! json_encode($productCounts) !!};
    var productNames = Object.keys(productCounts);
    var quantities = Object.values(productCounts);

    var productChart = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: productNames,
            datasets: [{
                label: 'Số lượng sản phẩm',
                data: quantities,
                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                borderColor: 'rgba(48, 161, 161, 1)',
                borderWidth: 1,
            }],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });

});
</script>

