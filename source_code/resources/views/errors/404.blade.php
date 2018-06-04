<!DOCTYPE html>
<html lang="en">
<head>
	<title>Jobee - Page Errors</title>

	@yield('meta-data')
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<meta name="keywords" content="">
	<meta name="csrf-token" content="{{ csrf_token() }}">


	<!-- Styles -->
	<link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/thejobs.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">

	<!-- Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Oswald:100,300,400,500,600,800%7COpen+Sans:300,400,500,600,700,800%7CMontserrat:400,700' rel='stylesheet' type='text/css'>

	<!-- Favicons -->
	<link rel="apple-touch-icon" href="{{ asset('/apple-touch-icon.png') }}">
	<link rel="icon" href="{{ asset('assets/img/favicon.ico') }} ">
	
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-116938224-1"></script>

	<script>  
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){ (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m) })(window,document,'script','//www.google-analytics.com/analytics.js','ga'); 
		ga('create', 'UA-116938224-1', 'auto'); 
		ga('require', 'linkid', 'linkid.js');
		ga('require', 'displayfeatures'); 
		ga('send', 'pageview');  
	</script>
	@yield('stylesheet')


</head>
{{-- @extends('layouts.masterlayout')
@section('content') --}}

<body class="nav-on-header smart-nav">
	

	<!-- Navigation bar -->
	<nav class="navbar">
		<div class="container">

			<!-- Logo -->
			<div class="pull-left">
				<a class="navbar-toggle" href="#" data-toggle="offcanvas"><i class="ti-menu"></i></a>

				<div class="logo-wrapper">
					<a class="logo" href="{{ route('home') }}"><img src="{{ asset('assets/img/logo.png') }}" alt="logo"  style="padding: 5px;"></a>
					<a class="logo-alt" href="{{ route('home') }}"><img src="{{ asset('assets/img/logo-alt.png') }}" alt="logo-alt"></a>
				</div>

			</div>
			<!-- END Logo -->
		</div>
	</nav>
	<!-- END Navigation bar -->


	<!-- Page header -->
	<header class="page-header">
	</header>
	<!-- END Page header -->


	<!-- Main container -->
	<main>
		<section>
			<div class="container">
				<center><i class="fa fa-exclamation-triangle fa-5x" aria-hidden="true"></i></center>
				<h1 class="text-center">Ối, lỗi rồi!</h1>
				<p class="lead text-center">Nội dung bạn truy cập hiện không tồn tại.</p>
				<hr>
			</div>
		</section>

	</main>
</body>
</html>
