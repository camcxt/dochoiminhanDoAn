<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Login</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">

	<link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('css/bootstrap-responsive.min.css')}}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.css') }}">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">

	<link href="{{ asset('css/style.css')}}" rel="stylesheet" type="text/css">
	<link href="{{ asset('css/pages/signin.css')}}" rel="stylesheet" type="text/css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

</head>

<body >
	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="{{ route('trangchu') }}">
					ĐỒ CHƠI MINH AN
				</a>
				<div class="nav-collapse">
					<ul class="nav pull-right">
						<li class="">
							<a href="{{ route('register') }}" class="">
								Bạn chưa có tài khoản ?
							</a>
						</li>
						<li class="">
							<a href="{{ route('trangchu') }}" class="">
								<i class="icon fa fa-home"></i>
								Quay lại trang chủ
							</a>
						</li>
					</ul>
				</div>
				<!--/.nav-collapse -->
			</div> <!-- /container -->
		</div> <!-- /navbar-inner -->
	</div> <!-- /navbar -->
	<div class="account-container">
		<div class="content clearfix">
			<form action="{{ route('login') }}" method="post">
				@csrf
				<div style="text-align: center">
					<h1>Chào mừng trở lại</h1>
				</div>
				<div class="login-fields">
					<p><br></p>
					<div class="field">
						<label for="username">Username</label>
						<input type="email" id="username" name="email" value="" placeholder="Username" class="login username-field form-control @error('email') is-invalid @enderror" required autocomplete="email" autofocus />
						@error('email')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div> <!-- /field -->
					<div class="field">
						<label for="password">Password:</label>
						<input type="password" id="password" name="password" value="" placeholder="Password" class="login password-field form-control @error('password') is-invalid @enderror" required autocomplete="current-password" />
						@error('password')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div> <!-- /password -->
					@if (isset($note))
					<span class="invalid-feedback" role="alert">
						<strong>{{ $note }}</strong>
					</span>
					@endif
				</div> <!-- /login-fields -->
				<div>
					@if (session()->has('messageLoginError'))
					<div class="alert alert-danger">
						{{ session('messageLoginError') }}
					</div>
					@endif
				</div>
				<div  class="login-actions">
					<span class="login-checkbox">
						<input id="Field" name="Field" type="checkbox" class="field login-checkbox" value="First Choice" tabindex="4" />
					</span>
					<button class="button btn btn-success btn-large">Đăng Nhập</button>
				</div> <!-- .actions -->
			</form>
		</div> <!-- /content -->
	</div> <!-- /account-container -->
	<div class="login-extra">
		@if (Route::has('forget.password.get'))
		<a href="{{ route('forget.password.get') }}">
			{{ __('Quên mật khẩu ?') }}
		</a>
		@endif
	</div> <!-- /login-extra -->
	<script src="{{ asset('js/jsbe/jquery-1.7.2.min.js')}}"></script>
	<script src="{{ asset('js/jsbe/bootstrap.js')}}"></script>
	<script src="{{ asset('js/jsbe/signin.js')}}"></script>
</body>
</html>