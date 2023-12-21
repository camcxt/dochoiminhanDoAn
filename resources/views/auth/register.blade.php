<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Signup</title>

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

<body>

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
                            <a href="{{ route('login') }}" class="">
                                Bạn đã có tài khoản? Đăng nhập ngay bây giờ
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



    <div class="account-container register">

        <div class="content clearfix">

            <form action="{{ route('register') }}" method="post">
                @csrf
                <div style="text-align: center">
                    <h1>Cùng là một nhà</h1>
                </div>

                <div class="login-fields">

                    <p><br></p>

                    <div class="field">
                        <label for="firstname">First Name:</label>
                        <input type="text" id="firstname" name="firstname" value="" placeholder="nhập họ của bạn"
                            class="login" />
                            @error('firstname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- /field -->

                    <div class="field">
                        <label for="lastname">Name:</label>
                        <input type="text" id="lastname" name="name" value="" placeholder="Nhập tên của bạn"
                            class="login" />
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> <!-- /field -->

                    <div class="field">
                        <label for="phone">Phone:</label>
                        <input type="phone" id="phone" name="phone" value="" placeholder="Nhập số điện thoại"
                            class="login" />
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> <!-- /field -->


                    <div class="field">
                        <label for="email">Email Address:</label>
                        <input type="email" id="email" name="email" value="" placeholder="Nhập địa chỉ email"
                            class="login form-control @error('email') is-invalid @enderror" autocomplete="email" />
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> <!-- /field -->

                    <div class="field">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" value="" placeholder="Nhập password"
                            class="login" />
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> <!-- /field -->

                    <div class="field">
                        <label for="confirm_password">Confirm Password:</label>
                        <input type="password" id="confirm_password" name="password_confirmation" value=""
                            placeholder="Nhập lại password" autocomplete="new-password" class="login" />
                    </div> <!-- /field -->

                </div> <!-- /login-fields -->

                <div class="login-actions">

                    <span class="login-checkbox">
                        <input id="Field" name="Field" type="checkbox" class="field login-checkbox"
                            value="First Choice" tabindex="4" />
                        {{-- <label class="choice" for="Field">Agree with the Terms & Conditions.</label> --}}
                    </span>

                    <button class="button btn btn-primary btn-large">Đăng ký</button>

                </div> <!-- .actions -->

            </form>

        </div> <!-- /content -->

    </div> <!-- /account-container -->


    <!-- Text Under Box -->
    <div class="login-extra">
        Bạn đã có tài khoản?  <a href="{{ route('login') }}">Đăng nhập ngay bây giờ</a>
    </div> <!-- /login-extra -->


    <script src="js/jquery-1.7.2.min.js"></script>
    <script src="js/bootstrap.js"></script>

    <script src="js/signin.js"></script>

</body>

</html>
