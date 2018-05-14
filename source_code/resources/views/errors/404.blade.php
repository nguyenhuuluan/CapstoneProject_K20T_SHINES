@extends('layouts.master-layout',['title' => 'Cập nhật hồ sơ sinh viên', 'isDisplaySearchHeader' => false])

@section('page-header')
<header class="page-header bg-img size-lg" style="background-image: url({{ asset('assets/img/O7MF5N0.jpg') }} )">
</header>
@endsection

@section('content')	
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
@endsection
