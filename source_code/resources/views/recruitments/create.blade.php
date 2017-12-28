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
	<link href="{{asset('assets/vendors/summernote/summernote.css')}}" rel="stylesheet">
	<link href="{{asset('assets/css/thejobs.css')}}" rel="stylesheet">
	<link href="{{asset('assets/css/custom.css')}}" rel="stylesheet">
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

		<<section>
			<div class="container">

				<div class="row">
					<div class="form-group col-xs-12 col-sm-12">
						<input type="text" class="form-control input-lg" placeholder="Tiêu đề việc làm">
					</div>

					<div class="form-group col-xs-12 col-sm-6 col-md-6">
						<div class="input-group input-group-sm">
							<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
							<input type="text" class="form-control" placeholder="Vị trí... Hồ Chí Minh">
						</div>
					</div>

					<div class="form-group col-xs-12 col-sm-6 col-md-6">
						<div class="input-group input-group-sm">
							<span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
							<select class="form-control selectpicker">
								<option>Full time</option>
								<option>Part time</option>
								<option>Internship</option>
								<option>Freelance</option>
								<option>Remote</option>
							</select>
						</div>
					</div>

					<div class="form-group col-xs-12 col-sm-6 col-md-6">
						<div class="input-group input-group-sm">
							<span class="input-group-addon"><i class="fa fa-money-recruitment"></i></span>
							<input type="text" class="form-control" placeholder="Lương">
						</div>
					</div>

					<div class="form-group col-xs-12 col-sm-6 col-md-6">
						<div class="input-group input-group-sm">
							<span class="input-group-addon"><i class="fa fa-tag"></i></span>										<input type="text" class="form-control" placeholder="PHP">
						</div>
					</div>

					<div class="form-group col-xs-12">
						<textarea class="form-control" rows="3" placeholder="Mô tả ngắn việc làm"></textarea>
					</div>

					<div class="form-group col-xs-12">
						<input type="text" class="form-control" placeholder="Website">
					</div>

				</div>

			</div>
		</section>

		<!-- Job detail -->
		<section>
			<div class="container">
				<header class="section-header">
					<h3>Mô tả</h3>
				</header>

				<textarea class="summernote-editor"></textarea>
			</div>

			<div class="container">
				<header class="section-header">
					<h3>Kĩ năng, công việc</h3>
				</header>
				<textarea class="summernote-editor"></textarea>
			</div>

			<div class="container">
				<header class="section-header">
					<h3>Phúc lợi</h3>
				</header>
				<textarea class="summernote-editor"></textarea>
			</div>
		</section>

		<div class="container">
			<header class="section-header">
				<h3>Tùy chọn</h3>
			</header>
			<textarea class="summernote-editor"></textarea>
		</div>
		<br>
	</section>

	<!-- END Job detail -->

	<!-- Submit -->

	<div class="container">
		<p class="text-center"><button class="btn btn-danger btn-xl btn-round">Xem trước</button> <button class="btn btn-success btn-xl btn-round">Đăng việc làm</button></p>
		<br>
	</div>
	<!-- END Submit -->


</main>
<!-- END Main container -->


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
<script src="{{ asset('assets/js/app.min.js') }}"></script>
<script src="{{ asset('assets/vendors/summernote/summernote.min.js') }}"></script>
<script src="{{ asset('assets/js/thejobs.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>

</body>
</html>
