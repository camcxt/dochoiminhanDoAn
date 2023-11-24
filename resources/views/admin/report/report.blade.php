@include ('admin.index')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="row">

                <!-- /span6 -->
                <div class="span6">
                    <div class="widget-content">
                        <h3>Review</h3>
                        <!-- /widget-header -->
                        <div class="widget-content">
                            <ul class="messages_layout">
                                @foreach ($comment as $commentList)
                                <li class="from_user left">
                                    <a href="#" class="avatar"><img  style="width: 30%;" src="/phone/public/images/anhdaidien.jfif"/></a>
                                    <div class="message_wrap">
                                        <div class="info"> <a class="name">{{ $commentList->user_name }}</a> <span class="time">about: </span> &nbsp <span> <a href="{{ route('showProduct', $commentList->product_id) }}" target="_blank"><b>{{ $commentList->product_name }}</b></a></span>
                                            <div class="options_arrow">
                                                <div class="dropdown pull-right"> <a class="dropdown-toggle " id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="#"> <i class=" icon-caret-down"></i> </a>
                                                    <ul class="dropdown-menu " role="menu" aria-labelledby="dLabel">
                                                        <li><a href="#"><i class=" icon-share-alt icon-large"></i> Reply</a></li>
                                                        <li><a href="#"><i class=" icon-trash icon-large"></i> Delete</a></li>
                                                        <li><a href="#"><i class=" icon-share icon-large"></i> Share</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text">{{ $commentList->comments }} </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- /widget-content -->
                    </div>
                </div>

                <div class="span6">
                    <div class="widget">
                        <div class="widget-content">
                            <h3>TOP ORDER</h3>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 5%; text-align: center;">No</th>
                                        <th style="width: 50%; text-align: center;">Customer</th>
                                        <th style="width: 25%; text-align: center;">Total</th>
                                        <th style="width: 20%; text-align: center;">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orderData as $key => $orderListTop)
                                    <tr>
                                        <td style="text-align: center;">{{ $key+1 }}</td>
                                        <td style="text-align: left;"><a href="{{ route('showbyId', $orderListTop->id) }}">{{ $orderListTop->customer_name }}</a></td>
                                        <td style="text-align: right;">${{ number_format($orderListTop->total_money) }}</td>
                                        <td style="text-align: center;">{{ $orderListTop->created_date }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="widget-content">
                        <h3>BEST SELL</h3>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 5%; text-align: center;">No</th>
                                    <th style="width: 5%; text-align: center;">Product Name</th>
                                    <th style="width: 5%; text-align: center;">Image</th>
                                    <th style="width: 5%; text-align: center;">Total Order</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order as $key => $orderList)
                                <tr>
                                    <td style="text-align: center;">{{ $key+1 }}</td>
                                    <td style="text-align: center;"><a href="{{ route('showImage', $orderList->product_id) }}">{{ $orderList->product_name }}</a></td>
                                    <td style="text-align: center;"><img src="/phone/public/images/{{ $orderList->product_image }}" height="50px" width="200px" alt="Khong tai duoc"></td>
                                    <td style="text-align: center;">{{ $orderList->total }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
<!-- /footer -->

