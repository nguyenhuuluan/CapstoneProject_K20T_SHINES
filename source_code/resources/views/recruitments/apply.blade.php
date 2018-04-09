@extends('layouts.master-layout', ['title' => 'Jobee - '.$recruitment->title,'isDisplaySearchHeader' => false])


@section('page-header')
<header class="page-header bg-img" style="background-image: url({{ asset('assets/img/O7MF5N0.jpg') }} );">
	<div class="container page-name">
		<h1 class="text-center">{!! $recruitment->title !!}</h1>
	</div>
</header>

@endsection

@section('content')
<main>
	@if (session('fail'))
	<div class="alert alert-danger">
		<center><strong>{{ session('fail') }}</strong></center>
	</div>
	@endif
	@if (session('success'))
	<div class="alert alert-success">
		<center><strong>{{ session('success') }}</strong></center>
	</div>
	@endif
	{!! Form::model($student, ['method'=>'POST', 'action'=>['Student\StudentRecruitmentController@store', $recruitment->slug]]) !!}

	<section>
		<div class="container">
			
			<div class="row">

				<div class="form-group ol-md-3 col-xs-12 col-sm-3">
					<h7>Tên của bạn</h7>
				</div>
				<div class="form-group col-md-9 col-xs-12 col-sm-9">
					<input type="text" class="form-control"  maxlength="40" value="{!! Auth::user()->student->name !!}" disabled>
				</div>
				<div class="form-group col-md-3 col-xs-12 col-sm-3">
					<h7>CV của bạn</h7>
				</div>
				<div class="form-group col-md-9 col-xs-12 col-sm-9 ">
					<p><i>Chọn cv để gây ấn tượng với nhà tuyển dụng</i></p>
					@foreach ($student->cvs as $cv)
					{!! Form::radio('mycv', $cv->id) !!}<i>{!! $cv->name !!}</i><br/>
					@endforeach
					@if ($errors->has('mycv'))
					<span class="help-block">
						<strong style="color: red;">Vui lòng chọn CV ứng tuyển</strong>
					</span>
					@endif
				</div>
				<div class="form-group col-md-3 col-xs-12 col-sm-3">
					<h7>Kĩ năng, thành tích nào bạn muốn gây ấn tượng với nhà tuyển dụng?</h7>
				</div>
				<div class="form-group col-md-9 col-xs-12 col-sm-9">
					{!! Form::textarea('description', '', ['class'=>'form-control', 'rows'=>'3', 'value'=> old('description')]) !!}
				</div>
			</div>
			
		</div>
	</section>
	<!-- Submit -->
	<div class="container">
		<p class="text-center">
			{!! Form::submit('Nộp hồ sơ', ['class'=>'btn btn-danger btn-xl btn-round']) !!}

			{{-- <a href="#" class="btn btn-danger btn-xl btn-round">Nộp hồ sơ</a> --}}
		</p>
		<br>
	</div>
	<!-- END Submit -->
	{!! Form::close() !!}

</main>
@endsection

