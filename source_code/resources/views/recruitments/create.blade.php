<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Post a job position or create your online resume by TheJobs!">
	<meta name="keywords" content="">

	<title>Jobee</title>

	<!-- Styles -->
	<link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet">
	
	<link href="{{asset('assets/css/thejobs.css')}}" rel="stylesheet">
	<link href="{{asset('assets/css/custom.css')}}" rel="stylesheet">
	<link href="{{asset('assets/vendors/summernote/summernote.css')}}" rel="stylesheet">
	

	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/tagmanager/3.0.2/tagmanager.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
	

	<!-- Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Oswald:100,300,400,500,600,800%7COpen+Sans:300,400,500,600,700,800%7CMontserrat:400,700' rel='stylesheet' type='text/css'>

	<!-- Favicons -->
	<link rel="apple-touch-icon" href="/apple-touch-icon.png">
	<link rel="icon" href="{{ asset('assets/img/favicon.ico') }}">
</head>
<body class="nav-on-header smart-nav">

	<!-- Navigation bar -->
	<nav class="navbar">
		<div class="container">
			<!-- Logo -->
			<div class="pull-left">
				<a class="navbar-toggle" href="#" data-toggle="offcanvas"><i class="ti-menu"></i></a>

				<div class="logo-wrapper">
					<a class="logo" href="index.html"><img src="{{ asset('assets/img/logo.png') }}" alt="logo"></a>
					<a class="logo-alt" href="index.html"><img src="{{ asset('assets/img/logo-alt.png') }}" alt="logo-alt"></a>
				</div>
			</div>
			<!-- END Logo -->
			<!-- User account -->
			<div class="pull-right">
				<div class="dropdown user-account">
					<a class="user-account-text">Thành Huỳnh</a>
					<a class="dropdown-toggle" href="#" data-toggle="dropdown">
						<img src="{{ asset('assets/img/logo-envato.png') }}" alt="avatar">
					</a>

					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="user-login.html">Tài khoản</a></li>
						<li><a href="user-register.html">Hồ sơ</a></li>
						<li><a href="#">Đăng xuất</a></li>
					</ul>
				</div>
			</div>
			<!-- END User account -->
			
			<!-- Navigation menu -->
			<ul class="nav-menu">
				<li>
					<a class="active" href="index.html">Trang chủ</a>
				</li>
				<li>
					<a href="company-list.html">Công ty</a>
				</li>
				<li>
					<a href="job-list-1.html">Việc làm</a>
				</li>
				<li>
					<a href="#">Blog</a>
				</li>
				<li>
					<a href="#">Giới thiệu</a>
				</li>
			</ul>
			<!-- END Navigation menu -->

		</div>
	</nav>
	<!-- END Navigation bar -->


	<!-- Page header -->
	<header class="page-header">
		<div class="container page-name">
			<h1 class="text-center">Thêm việc làm</h1>
			<p class="lead text-center">Tìm kiếm những ứng viên yêu thích công việc của bạn</p>
		</div>
	</header>
	<!-- END Page header -->


	<!-- Main container -->
	<main>
		@if(Session::has('comment_message'))	
		{{ session('comment_message') }}
		@endif
		{!! Form::open(['method'=>'POST', 'action'=>'RecruitmentController@store', 'files'=>true]) !!}
		<section>
			<div class="container">
				<div class="row">
					<div class="form-group col-xs-12 col-sm-12">
						{!! Form::text('title', null,['class'=>'form-control', 'placeholder'=>'Tiêu đề tin tuyển dụng']) !!}
					</div>
					
					<div class="form-group col-xs-12 col-sm-6 col-md-6">
						<div class="input-group input-group-sm">
							<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
							{!! Form::text('date', null, ['class'=>'form-control', 'placeholder'=>'Ngày hết hạn' , 'id' => 'datepicker']) !!}
						</div>
					</div>

					<div class="form-group col-xs-12 col-sm-6 col-md-6">
						<div class="input-group input-group-sm">
							<span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
							{!! Form::select('category_id[]', $categories, null,['class'=>'form-control selectpicker', 'multiple'=>true,'title'=>'Chưa chọn vị trí tuyển dụng']) !!}
						</div>
					</div>

					<div class="form-group col-xs-12 col-sm-6 col-md-6">
						<div class="input-group input-group-sm">
							<span class="input-group-addon"><i class="fa fa-money-recruitment"></i></span>
							{!! Form::text('salary', null, ['class'=>'form-control', 'placeholder'=>'8.000.000 VNĐ - 15.000.000 VNĐ', 'autocomplete'=>'off']) !!}
						</div>
					</div>

					<div class="form-group col-xs-12 col-sm-6 col-md-6">
						<div class="input-group input-group-sm">
							<span class="input-group-addon"><i class="fa fa-tag"></i></span>
							{!! Form::text('tags', null, ['class'=>'typeahead tm-input form-control tm-input-info', 'id'=>'typeahead', 'placeholder'=>'Tags', 'autocomplete'=>'off']) !!}
						</div>
					</div>

					<div class="form-group col-xs-12 col-sm-12">
						
					</div>

				</div>
			</div>
			@foreach ($sections as $section)
			<div class="container">
				<header class="section-header">
					<h3>{!! $section->title !!}</h3>
				</header>
				{!! Form::textarea($section->id , null,['class'=>'summernote', 'rows'=>5]) !!}
			</div>
			<br>
			@endforeach
			<div class="container">
				<p class="text-center">
					{!! Form::submit('Xem trước', ['class'=>'btn btn-danger btn-xl btn-round', 'name'=>'submitbutton' , 'formtarget'=>'_blank']) !!}
					{!! Form::submit('Đăng tin', ['class'=>'btn btn-success btn-xl btn-round', 'name'=>'submitbutton']) !!}
				</p>				
				<br>
			</div>		
			
			
			<!-- END Submit -->		
		</section>

		{!! Form::close() !!}				
	</main>
	<!-- END Main container -->


	<!-- Site footer -->
	@include('layouts.footer')
	<!-- END Site footer -->


	<!-- Back to top button -->
	<a id="scroll-up" href="#"><i class="ti-angle-up"></i></a>
	<!-- END Back to top button -->

	<!-- Scripts -->
	<script src="{{ asset('assets/js/app.min.js') }}"></script>
	<script src="{{ asset('assets/vendors/summernote/summernote.min.js') }}"></script>
	<script src="{{ asset('assets/js/thejobs.js') }}"></script>
	<script src="{{ asset('assets/js/custom.js') }}"></script>
	
	{{-- <script src="//code.jquery.com/jquery-1.10.2.js"></script> --}}
	{{-- <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script> --}}
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tagmanager/3.0.2/tagmanager.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script> 

	<script>
		$(function() {
			$( "#datepicker" ).datepicker();
			$( "#datepicker" ).datepicker( "option", "dateFormat", 'dd/mm/yy');


			
		});
		$(".summernote").summernote({
			toolbar: [
		    // [groupName, [list of button]]
		    ['style', ['bold', 'italic']],
		    ['para', ['ul', 'ol']],
		    ],
		    height: 200
		});
		$(document).ready(function() {
			var tags = $(".tm-input").tagsManager();
			jQuery("#typeahead").typeahead({
				source: function (query, process) {
					return $.get('{!! URL::route('searchtag') !!}', { query: query }, function (data) {
						data = $.parseJSON(data);
						return process(data);
					});
				},
				afterSelect :function (item){
					tags.tagsManager("pushTag", item);
				}
			});
		});
	</script>
</body>
</html>
