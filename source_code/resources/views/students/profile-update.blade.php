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
	<link href="{{ asset('assets/css/thejobs.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">

	
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
					</div>
				</div>



				<div>

					{!! Form::model( $student, ['method'=>'POST', 'action'=>['StudentController@editProfile', $student->id], 'files'=>true]) !!}

					<div class="col-xs-12 col-sm-8">
						<div class="form-group col-xs-12 col-sm-12">
							{!! Form::text('name', null, ['class'=>'form-control input-lg', 'placeholder'=> 'Họ tên', 'required']) !!}
						</div>
						<div class="form-group col-xs-12 col-sm-12">
							{!! Form::textarea('description' , null,['class'=>'form-control', 'rows'=>3, 'placeholder'=>'Mô tả ngắn về bạn']) !!}
						</div>
					</div>
					<div class="col-xs-12 col-sm-8">
						<h6 class="col-xs-12 col-sm-12">Thông tin cơ bản</h6>
						<div class="form-group col-xs-12 col-sm-6">
							<div class="input-group input-group-sm">
								<span class="input-group-addon"><i class="fa fa-birthday-cake"></i></span>
								{!! Form::date('dateofbirth', old('dateofbirth'), ['class'=>'form-control', 'required']) !!}
							</div>
						</div>

						<div class="form-group col-xs-12 col-sm-6">
							<div class="input-group input-group-sm">
								<span class="input-group-addon"><i class="fa fa-graduation-cap"></i></span>
								{!! Form::select('faculty_id', $faculties ,null, ['class'=>'form-control', 'title'=>'Chưa chọn Khoa']) !!}
							</div>
						</div>

						<div class="form-group col-xs-12 col-sm-6">
							<div class="input-group input-group-sm">
								<span class="input-group-addon"><i class="fa fa-phone"></i></span>
								{!! Form::text('phone', null, ['class'=>'form-control', 'placeholder'=> 'Số điện thoại', 'required']) !!}
							</div>
						</div>

						<div class="form-group col-xs-12 col-sm-6">
							<div class="input-group input-group-sm">
								<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
								{!! Form::text('email', null, ['class'=>'form-control', 'placeholder'=> 'Email', ' disabled']) !!}
							</div>
						</div>

{{-- 		@if (count($errors))
		<ul class="alert alert-danger">
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
		@endif --}}
	</div>

	<div class="col-xs-12 col-sm-8">
		<h6 class="col-xs-12 col-sm-12">Danh sách tag</h6>
		<span class="col-xs-12 col-sm-12 help-block">Viết tag và nhấn enter</span>

		<div class="form-group col-xs-12 col-sm-12 {{ $errors->has('tags2.*') ? ' has-error' : '' }}">

			{!! Form::text('tags', $tags, ['class'=>'tagsinput 123input tm-input form-control tm-input-info tagsinput-typeahead','data-role'=>'tagsinput', 'placeholder'=> 'Nhập tag', 'value'=> old('tags')]) !!}

			@if ($errors->has('tags2.*'))
			<span class="help-block">
				<strong>Tồn tại TAG không có trong hệ thống!</strong>
			</span>
			@endif
		</div>
	</div>

	<div class="col-xs-12 col-sm-12">
		<hr class="hr-lg">
		<!-- Work Experience -->
		<section class="bg-alt">
			<div class="container">
				<header class="section-header">
					<br>
					<h2>Kinh nghiệm làm việc</h2>
				</header>

				<div class="row">
					@if(count($exps)>0)
					@foreach ($exps as $exp)
					<div class="col-xs-12" style="width: 97.5%;">
						<div class="item-block">
							<div class="item-form">
								<button class="btn btn-danger btn-float btn-remove"><i class="ti-close"></i></button>
								<div class="row">
									<div class="col-xs-12 col-sm-12">
										<div class="form-group">
											{!! Form::text('exTitle[]', $exp->title, ['class'=>'form-control', 'placeholder'=> 'Tên công ty / Đồ án đã làm']) !!}
											{!! Form::text('position[]', $exp->role, ['class'=>'form-control', 'placeholder'=> 'Vị trí / Vai trò']) !!}
											<div class="input-group">
												<span class="input-group-addon">Từ</span>
												{!! Form::date('datestart[]', $exp->from, ['class'=>'form-control']) !!}
												{{-- <input class="form-control" type="date" name="datestart[]" value="2011-08"> --}}
												<span class="input-group-addon">Đến</span>
												{!! Form::date('dateend[]', $exp->to, ['class'=>'form-control']) !!}
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					@endforeach
					@else
					<div class="col-xs-12" style="width: 97.5%;">
						<div class="item-block">
							<div class="item-form">
								<button class="btn btn-danger btn-float btn-remove"><i class="ti-close"></i></button>
								<div class="row">
									<div class="col-xs-12 col-sm-12">
										<div class="form-group">
											{!! Form::text('exTitle[]', null, ['class'=>'form-control', 'placeholder'		=> 'Tên công ty / Đồ án đã làm']) !!}
											{!! Form::text('position[]', null, ['class'=>'form-control', 'placeholder'=> 'Vị trí / Vai trò']) !!}
											<div class="input-group">
												<span class="input-group-addon">Từ</span>
												{!! Form::date('datestart[]', null, ['class'=>'form-control']) !!}
												<span class="input-group-addon">Đến</span>
												{!! Form::date('dateend[]', null, ['class'=>'form-control']) !!}
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					@endif


					<div class="col-xs-12 duplicateable-content" style="width: 97.5%;">
						<div class="item-block">
							<div class="item-form">
								<button class="btn btn-danger btn-float btn-remove"><i class="ti-close"></i></button>
								<div class="row">
									<div class="col-xs-12 col-sm-12">
										<div class="form-group">
											{!! Form::text('exTitle[]', null, ['class'=>'form-control', 'placeholder'		=> 'Tên công ty / Đồ án đã làm']) !!}
											{!! Form::text('position[]', null, ['class'=>'form-control', 'placeholder'=> 'Vị trí / Vai trò']) !!}
											<div class="input-group">
												<span class="input-group-addon">Từ</span>
												{!! Form::date('datestart[]', null, ['class'=>'form-control']) !!}
												<span class="input-group-addon">Đến</span>
												{!! Form::date('dateend[]', null, ['class'=>'form-control']) !!}
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
		<hr>
		<!-- Skills-->
		<section class="bg-alt">
			<div class="container">
				<header class="section-header">
					<br>
					<h2>Kĩ năng</h2>
				</header>
				<div class="row">

					@if(count($skills)>0)
					@foreach ($skills as $skill)
					<div class="col-xs-12" style="width: 97.5%">''
						<div class="item-block">
							<div class="item-form">
								<button class="btn btn-danger btn-float btn-remove"><i class="ti-close"></i></button>
								<div class="row">
									<div class="col-xs-12 col-sm-6">
										<div class="form-group">
											{!! Form::text('skills[]', $skill->name, ['class'=>'form-control', 'placeholder'=> 'Tên kĩ năng, vd. HTML']) !!}
										</div>
									</div>
									<div class="col-xs-12 col-sm-6">
										<div class="form-group">
											{{ Form::selectRangeWithInterval('rating[]', 0, 100, 5, $skill->rating, ['class' => 'form-control input-xs']) }}

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					@endforeach
					@else
					<div class="col-xs-12" style="width: 97.5%">''
						<div class="item-block">
							<div class="item-form">
								<button class="btn btn-danger btn-float btn-remove"><i class="ti-close"></i></button>
								<div class="row">
									<div class="col-xs-12 col-sm-6">
										<div class="form-group">
											{!! Form::text('skills[]', '', ['class'=>'form-control', 'placeholder'=> 'Tên kĩ năng, vd. HTML']) !!}
										</div>
									</div>
									<div class="col-xs-12 col-sm-6">
										<div class="form-group">
											{{ Form::selectRangeWithInterval('rating[]', 0, 100, 5, '50', ['class' => 'form-control input-xs']) }}

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					@endif
					<div class="col-xs-12 duplicateable-content" style="width: 97.5%">
						<div class="item-block">
							<div class="item-form">
								<button class="btn btn-danger btn-float btn-remove"><i class="ti-close"></i></button>
								<div class="row">
									<div class="col-xs-12 col-sm-6">
										<div class="form-group">
											{!! Form::text('skills[]', '', ['class'=>'form-control', 'placeholder'=> 'Tên kĩ năng, vd. HTML']) !!}
										</div>
									</div>
									<div class="col-xs-12 col-sm-6">
										<div class="form-group">
											{{ Form::selectRangeWithInterval('rating[]', 0, 100, 5, '50', ['class' => 'form-control input-xs']) }}

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
		<section class="bg-alt">
			<p class="text-center"><button class="btn btn-danger btn-xl btn-round">Cập nhật hồ sơ</button></p>
		</section>
		{!! Form::close() !!}
		<hr>
	</div>
</div>
</div>
<div class="row">
	
	<section class="bg-alt">
		
		<div class="container">

			<header class="section-header">
				<br>
				<h2>Quản lý CV</h2>
			</header>

			<div class="row">
				<div class="col-xs-12">
					
					<div class="table-responsive">
						<table class="table table-striped table-bordered-company">
							<thead>
								<tr>
									<th>Tên CV</th>
									<th>Ngảy tải lên</th>
									<th>Thao tác</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><a href="#" target="_blank">GlobalCyberSoft.pdf</a></td>
									<td>22/3/2018</td>
									<td>
										<a href="#"><abbr title="Xóa"><i class="fa fa-trash" aria-hidden="true"></i></abbr></a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<h4>Tải lên CV</h4>
					<form method="POST" action="#" enctype="multipart/form-data">
						<!-- COMPONENT START -->
						<div class="form-group">
							<div class="input-group input-file" name="Fichier1">
								<input type="text" class="form-control" placeholder='Chọn CV của bạn...' />			
								<span class="input-group-btn">
									<button class="btn btn-success btn-choose" type="button">Chọn</button>
								</span>
							</div>
						</div>
						<!-- COMPONENT END -->
						<div class="form-group">
							<button type="submit" class="btn btn-primary pull-right">Tải lên</button>
							<button type="reset" class="btn btn-danger">Xóa</button>
						</div>
					</form>

				</div>
			</div>
		</div>
	</section>
</div>


</main>
<!-- END Main container -->
<!-- Site footer -->
@include('layouts.footer')

<!-- END Site footer -->



<!-- Back to top button -->
<a id="scroll-up" href="#"><i class="ti-angle-up"></i></a>
<!-- END Back to top button -->

<!-- Scripts -->
<script src="{{ asset('assets/js/app.min.js') }} "></script>
<script src="{{ asset('assets/js/thejobs.js') }} "></script>
<script src="{{ asset('assets/js/custom.js') }} "></script>
<script src="https://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
	var tagnames = new Bloodhound({
		datumTokenizer: Bloodhound.tokenizers.obj.whitespace("name"),
		queryTokenizer: Bloodhound.tokenizers.whitespace,
		prefetch: {
			url:'../../tags',
			filter: function(list) {
				return $.map(list, function(tagname) {
					return { name: tagname }; });
			}
		}
	});
	tagnames.initialize();
	$('.tagsinput').tagsinput({
		typeaheadjs: {
			name: 'tags',
			displayKey: 'name',
			valueKey: 'name',
			source: tagnames.ttAdapter(),
			templates: {
				empty: [
				'<div class="list-group search-results-dropdown"><div class="list-group-item">Không có kết quả phù hợp.</div></div>'
				],
				header: [
				'<div class="list-group search-results-dropdown">'
				],
				suggestion: function (data) {
					return '<p class="list-group-item">' + data.name + '</p>'
				}
			}
		}
	});
</script>

<script>

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
</body>
</html>