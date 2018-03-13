<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Post a job position or create your online resume by TheJobs!">
	<meta name="keywords" content="">

	<title>Jobee - Cập nhật hồ sơ sinh viên</title>

	<!-- Styles -->

	<link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/vendors/summernote/summernote.css') }} " rel="stylesheet">
	<link href="{{ asset('assets/css/thejobs.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/bootstrap-datetimepicker.min.css')}} " rel="stylesheet">


	<link href="{{ asset('assets/jquery.typeahead.min.css')}} " rel="stylesheet">
	<script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>

	<link href="{{ asset('assets/jquery.typeahead.min.js')}} " rel="stylesheet">
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
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
					<a class="logo" href="{{ route('home') }}"><img src="{{ asset('assets/img/logo.png') }} " alt="logo"></a>
					<a class="logo-alt" href="{{ route('home') }}"><img src="{{ asset('assets/img/logo-alt.png') }} " alt="logo-alt"></a>
				</div>

			</div>
			<!-- END Logo -->

			<!-- User account -->
			<div class="pull-right">
				<div class="dropdown user-account">
					<a class="user-account-text"> {!! Auth::user()->student->name!!}</a>
					<a class="dropdown-toggle" href="#" data-toggle="dropdown">
						<img src={{ asset('assets/img/logo-envato.png') }} alt="avatar">
					</a>
					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="{{ route('student.profile.update') }}">Tài khoản</a></li>
						<li><a href="{{ route('student.profile') }}">Hồ sơ</a></li> 
						<li>
							<a href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();">Đăng xuất</a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								{{ csrf_field() }}
							</form>
						</li>
					</ul>
				</div>
			</div>
			<!-- END User account -->

			<!-- Navigation menu -->
			<ul class="nav-menu">
				<li>
					<a class="active" href="{{ route('home') }}">Trang chủ</a>
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
			<h1 class="text-center">Thêm hồ sơ của bạn</h1>
			<p class="lead text-center">Tạo hồ sơ của bạn và cho nhà tuyển dụng nhìn thấy nó.</p>
		</div>
	</header>
	<!-- END Page header -->


	<!-- Main container -->
	<main>
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-4">
					<div class="form-group">
						{!! Form::file('photo', ['class'=>'dropify', 'data-height'=>'300' ,'data-default-file'=> asset(Auth::user()->student->photo) ])!!}
						<span class="help-block">Xin vui lòng chọn ảnh 4:6</span>
						<center>
							<div style="position:relative;">
								<a class='btn btn-primary' href='javascript:;'>
									Tải lên CV...
									<input type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="file_source" size="40"  onchange='$("#upload-file-info").html($(this).val());'>
								</a>
								&nbsp;
								<span class='label label-info' id="upload-file-info"></span>
							</div>
						</center>
					</div>
				</div>

				{!! Form::model( $student, ['method'=>'POST', 'action'=>'StudentController@updateProfile', $student->id, 'files'=>true]) !!}

				<div class="col-xs-12 col-sm-8">
					<div class="form-group">
						{!! Form::text('name', null, ['class'=>'form-control input-lg', 'placeholder'=> 'Họ tên']) !!}
					</div>

					<div class="form-group">
						{!! Form::textarea('description' , null,['class'=>'form-control', 'rows'=>3, 'placeholder'=>'Mô tả ngắn về bạn']) !!}
					</div>

					<hr class="hr-lg">

					<h6>Thông tin cơ bản</h6>
					<div class="row">

						<div class="form-group col-xs-12 col-sm-6">
							<div class="input-group input-group-sm">
								<span class="input-group-addon"><i class="fa fa-birthday-cake"></i></span>

								<div class="controls input-append date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">

									{!! Form::text('dateofbirth', old('dateofbirth'), ['readonly', 'style'=>'width:90%']) !!}

									<span class="add-on" style="width: 15%;"><i class="fa fa-calendar"></i></span>
								</div>

							</div>
						</div>

						<div class="form-group col-xs-12 col-sm-6">
							<div class="input-group input-group-sm">
								<span class="input-group-addon"><i class="fa fa-graduation-cap"></i></span>
								{!! Form::select('faculty_id', $faculties ,null, ['class'=>'form-control', 'title'=>'Chưa Khoa']) !!}

							</div>
						</div>

						<div class="form-group col-xs-12 col-sm-6">
							<div class="input-group input-group-sm">
								<span class="input-group-addon"><i class="fa fa-phone"></i></span>
								{!! Form::text('phone', null, ['class'=>'form-control', 'placeholder'=> 'Số điện thoại']) !!}
							</div>
						</div>

						<div class="form-group col-xs-12 col-sm-6">
							<div class="input-group input-group-sm">
								<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
								{!! Form::text('email', null, ['class'=>'form-control', 'placeholder'=> 'Email']) !!}
							</div>
						</div>

					</div>

					<hr class="hr-lg">

					<h6>Danh sách tag</h6>
					<div class="form-group">
						{!! Form::text('tags', $tags, ['data-role'=>'tagsinput', 'placeholder'=> 'Tên tag']) !!}
						<span class="help-block">Viết tag và nhấn enter</span>

						<form class="form-inline typeahead">search-input
							<div class="form-group">
								<input type="name" class="form-control search-input" id="name" autocomplete="off" placeholder="Nhập tên khách hàng">
							</div>
							<button type="submit" class="btn btn-default">Tìm kiếm</button>
						</form>


					</div>
				</div>
			</div>
		</div>

		<!-- Work Experience -->
		<section class="bg-alt">
			<div class="container">
				<header class="section-header">
					<br>
					<h2>Kinh nghiệm làm việc</h2>
				</header>

				<div class="row">

					<div class="col-xs-12">
						<div class="item-block">
							<div class="item-form">

								<button class="btn btn-danger btn-float btn-remove"><i class="ti-close"></i></button>

								<div class="row">
									<div class="col-xs-12 col-sm-12">
										<div class="form-group">
											{!! Form::text('exTitle', null, ['class'=>'form-control', 'placeholder'=> 'Tên công ty / Đồ án đã làm']) !!}
										</div>

										<div class="form-group">
											{!! Form::text('exTitle', null, ['class'=>'form-control', 'placeholder'=> 'Vị trí / Vai trò']) !!}
										</div>

										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">Từ</span>
												<input class="form-control" type="month" value="2011-08">
												<span class="input-group-addon">Đến</span>
												<input class="form-control" type="month" value="2011-08">
											</div>
										</div>

									</div>
								</div>

							</div>
						</div>
					</div>

					<div class="col-xs-12 duplicateable-content">
						<div class="item-block">
							<div class="item-form">

								<button class="btn btn-danger btn-float btn-remove"><i class="ti-close"></i></button>

								<div class="row">
									<div class="col-xs-12 col-sm-12">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="Tên công ty, vd. KMS">
										</div>

										<div class="form-group">
											<input type="text" class="form-control" placeholder="Vị trí, vd. Tester">
										</div>

										<div class="form-group">
											<div class="input-group col-xs-12 col-sm-12">
												<span class="input-group-addon">Từ</span>
												<input class="form-control" type="date" value="2011-08">
												<span class="input-group-addon">Đến</span>
												<input class="form-control" type="month" value="2011-08">
											</div>
										</div>

									</div>
								</div>

							</div>
						</div>
					</div>

					<div class="col-xs-12 text-center">
						<br>
						<button class="btn btn-primary btn-duplicator">Thêm kinh nghiệm làm việc</button>
					</div>
				</div>
			</div>
		</section>
		<!-- END Work Experience -->


		<!-- Skills-->
		<section>
			<div class="container">

				<header class="section-header">
					<br>
					<h2>Kĩ năng</h2>
				</header>

				<div class="row">

					<div class="col-xs-12">
						<div class="item-block">
							<div class="item-form">

								<button class="btn btn-danger btn-float btn-remove"><i class="ti-close"></i></button>

								<div class="row">
									<div class="col-xs-12 col-sm-6">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="Tên kĩ năng, vd. HTML">
										</div>
									</div>

									<div class="col-xs-12 col-sm-6">

										<div class="form-group">
											<div class="input-group">
												<input type="text" class="form-control" placeholder="Mức độ thông thạo, vd. 90">
												<span class="input-group-addon">%</span>
											</div>
										</div>

									</div>
								</div>

							</div>
						</div>
					</div>

					<div class="col-xs-12 duplicateable-content">
						<div class="item-block">
							<div class="item-form">

								<button class="btn btn-danger btn-float btn-remove"><i class="ti-close"></i></button>

								<div class="row">
									<div class="col-xs-12 col-sm-6">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="Tên kĩ năng, vd. HTML">
										</div>
									</div>

									<div class="col-xs-12 col-sm-6">

										<div class="form-group">
											<div class="input-group">
												<input type="text" class="form-control" placeholder="Mức độ thông thạo, vd. 90">
												<span class="input-group-addon">%</span>
											</div>
										</div>

									</div>
								</div>

							</div>
						</div>
					</div>

					<div class="col-xs-12 text-center">
						<br>
						<button class="btn btn-primary btn-duplicator">Thêm kĩ năng</button>
					</div>
				</div>
			</div>
		</section>
		<!-- END Skills-->



		<!-- Submit -->
		<section class="bg-alt">
			<p class="text-center"><button class="btn btn-danger btn-xl btn-round">Cập nhật hồ sơ</button></p>
		</section>
		<!-- END Submit -->



		{!! Form::close() !!}


	</main>
	<!-- END Main container -->

	
	<form class="form-inline typeahead">
		<div class="form-group">
			<input type="name" class="form-control search-input" id="name" autocomplete="off" placeholder="Nhập tên khách hàng">
		</div>
		<button type="submit" class="btn btn-default">Tìm kiếm</button>
	</form>


	<script>
	// var a = $(".search-input").text();
	// alert(a);

	// 		function abc(){
	// 			$(".search-input").change(
	// 				alert('111');
	// 				);
	// 		}

	// 		abc();

	jQuery(document).ready(function($) {
		var engine = new Bloodhound({
			remote: {
				url: 'api/find?q=%QUERY%',
				wildcard: '%QUERY%'
			},
			datumTokenizer: Bloodhound.tokenizers.whitespace('q'),
			queryTokenizer: Bloodhound.tokenizers.whitespace
		});

		$(".search-input").typeahead({
			hint: true,
			highlight: true,
			minLength: 1
		}, {
			source: engine.ttAdapter(),
			name: 'usersList',
			templates: {
				empty: [
				'<div class="list-group search-results-dropdown"><div class="list-group-item">Không có kết quả phù hợp.</div></div>'
				],
				header: [
				'<div class="list-group search-results-dropdown">'
				],
				suggestion: function (data) {
					return '<a href="customer/' + data.id + '" class="list-group-item">' + data.name + '</a>'
				}
			}
		});
	});
</script>


<!-- Site footer -->
@include('layouts.footer')

<!-- END Site footer -->



<!-- Back to top button -->
<a id="scroll-up" href="#"><i class="ti-angle-up"></i></a>
<!-- END Back to top button -->

<!-- Scripts -->
<script src="{{ asset('assets/js/app.min.js') }} "></script>
<script src="{{ asset('assets/vendors/summernote/summernote.min.js') }} "></script>
<script src="{{ asset('assets/js/thejobs.js') }} "></script>
<script src="{{ asset('assets/js/custom.js') }} "></script>

<script src="{{ asset('assets/js/bootstrap-datetimepicker.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap-datetimepicker.vi.js') }} " charset="UTF-8"></script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>


<script>






	$('.form_datetime').datetimepicker({
        //language:  'vie',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1
    });
	$('.form_date').datetimepicker({
		language:  'vie',
		weekStart: 1,
		todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
	});
	$('.form_time').datetimepicker({
		language:  'vie',
		weekStart: 1,
		todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 1,
		minView: 0,
		maxView: 1,
		forceParse: 0
	});

	$('.dropify').dropify({
		error: {
			'fileSize': 'The file size is too big (30 max).',
			'minWidth': 'The image width is too small (30 px min).',
			'maxWidth': 'The image width is too big (30 px max).',
			'minHeight': 'The image height is too small (30 px min).',
			'maxHeight': 'The image height is too big (30 x max).',
			'imageFormat': 'The image format is not allowed (30 only).'
		}
	});
</script>

<script type="text/javascript">

	searchtags();

	function searchtags(){
		jQuery(document).ready(function($) {
			var engine = new Bloodhound({
				remote: {
					url: '../../api/find?q=%QUERY%',
					wildcard: '%QUERY%'
				},
				datumTokenizer: Bloodhound.tokenizers.whitespace('q'),
				queryTokenizer: Bloodhound.tokenizers.whitespace
			});

			$(".search-input").typeahead({
				hint: true,
				highlight: true,
				minLength: 1
			}, {
				source: engine.ttAdapter(),
				name: 'usersList',
				templates: {
					empty: [
					'<div class="list-group search-results-dropdown"><div class="list-group-item">Không có kết quả phù hợp.</div></div>'
					],
					header: [
					'<div class="list-group search-results-dropdown">'
					],
					suggestion: function (data) {
						return '<a href="customer/' + data.id + '" class="list-group-item">' + data.name + '</a>'
					}
				}
			});
		});

	}



</script>

</body>
</html>
