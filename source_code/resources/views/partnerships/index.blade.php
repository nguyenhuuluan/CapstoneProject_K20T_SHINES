@extends('layouts2.master-layout',['title' => 'Partnership', 'isDisplaySearchHeader' => false])
@section('content')
<section>
	<div class="container">
		<h3>Bạn muốn tìm những ứng viên tốt cho công ty của bạn?</h3>
		<h5>Cho chúng tôi thông tin của bạn và chúng tôi sẽ liên hệ với bạn!</h5>
		<br>
		<div class="pull-left">
			<a href="{{route('company.register.partnership.form')}}" type="button" class="btn btn-round btn-danger">Gửi thông tin</a>
		</div>
		{{-- <div class="pull-right">
			<strong>
				<p class="help-block">Bạn đã có tài khoản?</p>
			</strong>
			<strong><a href="{{ route('representative.login') }}" class="help-block" style="color: red;"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> Đăng nhập</a></strong>
		</div> --}}
	</div>
	
	</section>

	@endsection