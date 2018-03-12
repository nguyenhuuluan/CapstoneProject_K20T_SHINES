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
					<a class="logo" href="index.html"><img src="{{ asset('assets/img/logo.png') }} " alt="logo"></a>
					<a class="logo-alt" href="index.html"><img src="{{ asset('assets/img/logo-alt.png') }} " alt="logo-alt"></a>
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

	<form action="#">

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
			{!! Form::open(['method'=>'POST', 'action'=>'StudentController@updateProfile', 'files'=>true]) !!}
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-4">
						<div class="form-group">
							{!! Form::file('photo', ['class'=>'dropify', 'data-height'=>'300' ,'data-default-file'=> asset(Auth::user()->student->photo) ])!!}
							<span class="help-block">Xin vui lòng chọn ảnh 4:6</span>
							<center>
								<div class="button-group">
									<div class="action-buttons">
										<div class="upload-button">
											<button class="btn btn-block btn-primary">Tải lên CV</button>
											<input id="cover_img_file" type="file">
										</div>

									</div>
								</div>
							</center>
						</div>
					</div>

					<div class="col-xs-12 col-sm-8">
						<div class="form-group">
							{!! Form::text('name', null, ['class'=>'form-control input-lg', 'placeholder'=> 'Họ tên']) !!}
						</div>

						<div class="form-group">
							{!! Form::text('title', null, ['class'=>'form-control', 'placeholder'=> 'Tiêu đề (vd. Nhân viên bán hàng)']) !!}
						</div>

						<div class="form-group">
							{!! Form::textarea('description' , null,['class'=>'form-control', 'rows'=>3, 'placeholder'=>'Mô tả ngắn về bạn']) !!}
						</div>

						<hr class="hr-lg">

						<h6>Thông tin cơ bản</h6>
						<div class="row">

							<div class="form-group col-xs-12 col-sm-6">
								<div class="input-group input-group-sm">
									<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
									{!! Form::text('address', null, ['class'=>'form-control', 'placeholder'=> 'Địa chỉ']) !!}
								</div>
							</div>

							<div class="form-group col-xs-12 col-sm-6">
								<div class="input-group input-group-sm">
									<span class="input-group-addon"><i class="fa fa-graduation-cap"></i></span>
									<select class="form-control selectpicker">
										<option>CNTT</option>
										<option>Sinh Học</option>
										<option>Ngôn Ngữ Anh</option>
										<option>MTCN</option>
										<option>Kiến Xây</option>
										<option>Du lịch</option>
										<option>Tài chính - kế toán</option>
										<option>QTKD</option>
									</select>
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
							{!! Form::text('tags', 'HTML,CSS,JavaScript', ['data-role'=>'tagsinput', 'placeholder'=> 'Tên tag']) !!}
							<span class="help-block">Viết tag và nhấn enter</span>
						</div>
					</div>
				</div>
			</div>
			{!! Form::close() !!}

			<!-- Education -->
			<section class=" bg-alt">
				<div class="container">

					<header class="section-header">
						<br>
						<h2>Bằng cấp</h2>
					</header>

					<div class="row">

						<div class="col-xs-12">
							<div class="item-block">
								<div class="item-form">

									<button class="btn btn-danger btn-float btn-remove"><i class="ti-close"></i></button>

									<div class="row">
										<div class="col-xs-12 col-sm-12">
											<div class="form-group">
												<input type="text" class="form-control" placeholder="Cấp bậc, vd. Cử nhân">
											</div>

											<div class="form-group">
												<input type="text" class="form-control" placeholder="Chuyên Nghành, vd. CNTT">
											</div>
											<div class="form-group">
												<input type="text" class="form-control" placeholder="Tên trường, vd. Đại học Văn Lang">
											</div>

											<div class="form-group">
												<div class="input-group">
													<span class="input-group-addon">Từ</span>
													<input class="form-control" type="month" value="2011-08" id="example-month-input">
													<span class="input-group-addon">Đến</span>
													<input class="form-control" type="month" value="2011-08" id="example-month-input">
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
												<input type="text" class="form-control" placeholder="Cấp bậc, vd. Cử nhân">
											</div>

											<div class="form-group">
												<input type="text" class="form-control" placeholder="Chuyên Nghành, vd. CNTT">
											</div>
											<div class="form-group">
												<input type="text" class="form-control" placeholder="Tên trường, vd. Đại học Văn Lang">
											</div>

											<div class="form-group">
												<div class="input-group">
													<span class="input-group-addon">Từ</span>
													<input class="form-control" type="month" value="2011-08" id="example-month-input">
													<span class="input-group-addon">Đến</span>
													<input class="form-control" type="month" value="2011-08" id="example-month-input">
												</div>
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>

						<div class="col-xs-12 text-center">
							<br>
							<button class="btn btn-primary btn-duplicator">Thêm bằng cấp</button>
						</div>


					</div>
				</div>
			</section>
			<!-- END Education -->


			<!-- Work Experience -->
			<section>
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
												<input type="text" class="form-control" placeholder="Tên công ty, vd. KMS">
											</div>

											<div class="form-group">
												<input type="text" class="form-control" placeholder="Vị trí, vd. Tester">
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

						<div class="col-xs-12 text-center">
							<br>
							<button class="btn btn-primary btn-duplicator">Thêm kinh nghiệm làm việc</button>
						</div>


					</div>

				</div>
			</section>
			<!-- END Work Experience -->


			<!-- Skills -->
			<section class=" bg-alt">
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
			<!-- END Skills -->



			<!-- Submit -->
			<section class=" bg-img" style="background-image: url(assets/img/bg-facts.jpg);">
				<div class="container">
					<header class="section-header">
						<h2>Gửi hồ sơ</h2>
						<p>Xin vui lòng kiểm tra lại hồ sơ trước khi gửi</p>
					</header>

					<p class="text-center"><button class="btn btn-success btn-xl btn-round">Gửi</button></p>

				</div>
			</section>
			<!-- END Submit -->


		</main>
		<!-- END Main container -->

	</form>

	<!-- Site footer -->
	<footer class="site-footer">

		<!-- Top section -->
		<div class="container">
			<div class="row">

				<div class="col-xs-6 col-sm-6 col-md-3">
					<h6>Việc làm theo nghành nghề</h6>
					<ul class="footer-links">
						<li><a href="job-list.html">Việc làm Kế toán</a></li>
						<li><a href="job-list.html">Việc làm Ngân hàng</a></li>
						<li><a href="job-list.html">Việc làm IT - Phần mềm</a></li>
						<li><a href="job-list.html">Việc làm IT-Phần cứng/Mạng</a></li>
						<li><a href="job-list.html">Việc làm Xây dựng</a></li>
					</ul>
				</div>

				<div class="col-xs-6 col-sm-6 col-md-3">
					<ul class="footer-links">
						<br>
						<li><a href="job-list.html">Việc làm Quảng cáo/Khuyến mãi</a></li>
						<li><a href="job-list.html">Việc làm Hàng không/Du lịch</a></li>
						<li><a href="job-list.html">Việc làm Giáo dục/Đào tạo</a></li>
						<li><a href="job-list.html">Việc làm Điện/Điện tử</a></li>
						<li><a href="job-list.html">Việc làm Bán hàng</a></li>
					</ul>
				</div>

				<div class="col-xs-6 col-sm-6 col-md-3">
					<h6>Việc làm IT theo công ty</h6>
					<ul class="footer-links">
						<li><a href="page-about.html">Global CyberSoft</a></li>
						<li><a href="page-typography.html">Vingroup</a></li>
						<li><a href="page-faq.html">Capella Holding</a></li>
						<li><a href="page-typography.html">Vietjetair</a></li>
						<li><a href="page-contact.html">Standard Charter</a></li>
					</ul>
				</div>


				<div class="col-xs-6 col-sm-6 col-md-3">
					<h6>Việc làm IT theo thành phố</h6>
					<ul class="footer-links">
						<li><a href="job-list.html">Hồ Chí Minh</a></li>
						<li><a href="job-list.html">Hà Nội</a></li>
						<li><a href="job-list.html">Đà Nẵng</a></li>
						<li><a href="job-list.html">Thêm</a></li>
					</ul>
				</div>
			</div>

			<hr>
		</div>
		<!-- END Top section -->

		<!-- Bottom section -->
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-sm-6 col-xs-12">
					<p class="copyright-text">Copyrights &copy; 2017 All Rights Reserved by <a href="#">Shines Team</a>.</p>
				</div>

				<div class="col-md-4 col-sm-6 col-xs-12">
					<ul class="social-icons">
						<li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
						<li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
						<li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
						<li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
						<li><a class="instagram" href="#"><i class="fa fa-instagram"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
		<!-- END Bottom section -->

	</footer>
	<!-- END Site footer -->



	<!-- Back to top button -->
	<a id="scroll-up" href="#"><i class="ti-angle-up"></i></a>
	<!-- END Back to top button -->

	<!-- Scripts -->
	<script src="{{ asset('assets/js/app.min.js') }} "></script>
	<script src="{{ asset('assets/vendors/summernote/summernote.min.js') }} "></script>
	<script src="{{ asset('assets/js/thejobs.js') }} "></script>
	<script src="{{ asset('assets/js/custom.js') }} "></script>

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