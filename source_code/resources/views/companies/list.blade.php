@extends('layouts.master-layout',['title' => 'Tuyển dụng Văn Lang - Danh sách Công ty', 'isDisplaySearchHeader' => false])

@section('stylesheet')
<link href="{{ asset('assets/css/bootstrap-tagsinput.css') }}" rel="stylesheet">
@endsection

@section('page-header')
<!-- Page header -->
<header class="page-header bg-img size-lg" style="background-image: url({{ asset('assets/img/bg-banner1.jpg') }} )">
	<div class="container page-name" style="padding-bottom: 100px">
		@include('layouts.search-box')
	</div>
</header>
<!-- END Page header -->
@endsection

@section('content')
<main>
	<section class="bg-alt-company">
		<div class="container">

			<div class="searchcontentcompany col-xs-12">
				<br>
				<h5>Chúng tôi đã tìm thấy <strong>30</strong> công ty cho <strong>@Tìm kiếm</strong> </h5>
			</div>

			<div class="category-grid-company">
				<a href="company-detail.html">
					<img src="assets/img/logo-google.png" alt="">
					<h6>FPT</h6>
					<span>Designer, Developer, IT Service, Front-end developer, Project management</span>
				</a>

				<a href="company-detail.html">
					<img src="assets/img/logo-microsoft.jpg" alt="">
					<h6>Global Cybersoft</h6>
					<span>Designer, Developer, IT Service, Front-end developer, Project management</span>
				</a>

				<a href="company-detail.html">
					<img src="assets/img/logo-google.png" alt="">
					<h6>Facebook</h6>
					<span>Designer, Developer, IT Service, Front-end developer, Project management</span>
				</a>

				<a href="company-detail.html">
					<img src="assets/img/logo-google.png" alt="">
					<h6>CSC</h6>
					<span>Designer, Developer, IT Service, Front-end developer, Project management</span>
				</a>

				<a href="company-detail.html">
					<img src="assets/img/logo-google.png" alt="">
					<h6>Capgemini</h6>
					<span>Designer, Developer, IT Service, Front-end developer, Project management</span>
				</a>

				<a href="job-list-3.html">
					<img src="assets/img/logo-google.png" alt="">
					<h6>KMS</h6>
					<span>Designer, Developer, IT Service, Front-end developer, Project management</span>
				</a> 

				<a href="company-detail.html">
					<img src="assets/img/logo-envato.png" alt="">
					<h6>Capgemini</h6>
					<span>Designer, Developer, IT Service, Front-end developer, Project management</span>
				</a>

				<a href="company-detail.html">
					<img src="assets/img/logo-google.png" alt="">
					<h6>Capgemini</h6>
					<span>Designer, Developer, IT Service, Front-end developer, Project management</span>
				</a>

			</div>
		</div>
	</section>

</main>
@endsection
