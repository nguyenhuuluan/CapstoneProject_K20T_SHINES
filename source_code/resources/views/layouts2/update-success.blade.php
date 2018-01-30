<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="keywords" content="">

	<title>Jobee</title>

	<!-- Styles -->
	<link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/thejobs.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/alpha.css') }}" rel="stylesheet">

	<!-- Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Oswald:100,300,400,500,600,800%7COpen+Sans:300,400,500,600,700,800%7CMontserrat:400,700' rel='stylesheet' type='text/css'>

	<!-- Favicons -->
	<link rel="apple-touch-icon" href="{{ asset('/apple-touch-icon.png') }}">
	<link rel="icon" href="{{ asset('assets/img/favicon.ico') }} ">
</head>

<body class="nav-on-header smart-nav">

	<!-- Navigation bar -->
	<nav class="navbar">
		<div class="container">

			<!-- Logo -->
			<div class="pull-left">
				<a class="navbar-toggle" href="#" data-toggle="offcanvas"><i class="ti-menu"></i></a>

				<div class="logo-wrapper">
					<a class="logo" href="{{ route('home') }}"><img src="{{ asset('assets/img/logo.png') }}" alt="logo"></a>
					<a class="logo-alt" href="{{ route('home') }}"><img src="{{ asset('assets/img/logo-alt.png') }}" alt="logo-alt"></a>
				</div>

			</div>
			<!-- END Logo -->
		</div>
	</nav>
	<!-- END Navigation bar -->

	<form action="#">

		<!-- Page header -->
		<header class="page-header">
		</header>
		<!-- END Page header -->


		<!-- Main container -->
		<main>
			<section>
				<div class="container">
					<center><div class="alert alert-success">
						<strong>Cập nhật thành công!</strong> Giờ bạn có thể đăng nhập và sử dụng dịch vụ, cảm ơn.
						<br>
						Quay về trang chủ <a class="logo-alt" href="{{ route('home') }}"> <b>Trang chủ</b></a>
					</div></center>

				</div>
			</section>
		</main>
		<!-- END Main container -->

	</form>

	<!-- Back to top button -->
	<a id="scroll-up" href="#"><i class="ti-angle-up"></i></a>
	<!-- END Back to top button -->

	<!-- Scripts -->
	<script src="{{ asset('assets/js/app.min.js') }} "></script>
	<script src="{{ asset('assets/js/thejobs.js') }} "></script>
	<script src="{{ asset('assets/js/custom.js') }} "></script>


</body>
</html>
