@extends('layouts.master-layout',['title' => 'Partnership', 'isDisplaySearchHeader' => false])
@section('page-header')
<header class="page-header bg-img size-lg" style="background-image: url({{ asset('assets/img/O7MF5N0.jpg') }} )">
</header>
@endsection
@section('content')
<main>
	<section>
		<div class="container">
			<h3>Bạn muốn tìm những ứng viên tốt cho công ty của bạn?</h3>
			<h5>Cho chúng tôi thông tin của bạn và chúng tôi sẽ liên hệ với bạn!</h5>
			<br>
			<div class="pull-left">
				<a href="{{route('company.register.partnership.form')}}" type="button" class="btn btn-round btn-danger">Gửi thông tin</a>
			</div>
	</div>
</section>
</main>
<br>
<br>	
<br>
<br>
<br>
<br>

@endsection