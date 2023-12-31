<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Order success</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">

	<link href="/dochoiminhan/resources/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="/dochoiminhan/resources/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/3.2.1/css/font-awesome.css" integrity="sha512-mNBK16eobgxYTbRSQhlXA6hEVqfO+o31KEctFCjcn1FytkihWQGCAB4ktjdt/NiGE6q6b09aosY0det7YQa8AA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link href="/dochoiminhan/resources/css/font-awesome.css" rel="stylesheet">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">

	<link href="/dochoiminhan/resources/css/style.css" rel="stylesheet" type="text/css" />

</head>

<body>

	<div class="container">

		<div class="row">

			<div class="span12">

				
				<div class="error-container">
				<h2 style="color: black;">Bạn đã đặt hàng thành công</h2>
					@if (isset(Auth::user()->id))
						@if (isset($idOrder))
							<a href="{{ route('showItem', $idOrder) }}">Đơn hàng của bạn</a>
						@endif
					@endif
					
					@if (isset($customerName))
					<div>
						<p>{{ $customerName }}</p>
						<p>{{ $totalMoney }}</p>
					</div>
					@endif

				</div> <!-- /error-container -->

			</div> <!-- /span12 -->

		</div> <!-- /row -->

	</div> <!-- /container -->


	<script src="/dochoiminhan/resources/css/js/jquery-1.7.2.min.js"></script>
	<script src="/dochoiminhan/resources/css/js/bootstrap.js"></script>

</body>

</html>