@extends('layouts.representative')

@section('styles')
<link href="{{asset('assets/vendors/summernote/summernote.css')}}" rel="stylesheet">


<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/tagmanager/3.0.2/tagmanager.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
@endsection

@section('body')
<main>

{{-- 		@if (count($errors))
		<ul class="alert alert-danger">
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
		@endif --}}

		{!! Form::open(['method'=>'POST', 'action'=>'Representative\RepresentativeRecruitmentController@store']) !!}
		<section>
			<div class="container">
				<div class="row">
					<div class="row">
						<div class="form-group col-xs-12 col-sm-12 {{ $errors->has('title') ? ' has-error' : '' }}">
							{!! Form::text('title', null,['class'=>'form-control', 'placeholder'=>'Tiêu đề tin tuyển dụng', 'value'=> old('title') ]) !!}
							@if ($errors->has('title'))
							<span class="help-block">
								<strong>Tiêu đề không được bỏ trống!</strong>
							</span>
							@endif
						</div>
					</div>

					<div class="row">

						<div class="form-group col-xs-12 col-sm-6 col-md-6 {{ $errors->has('expire_date') ? ' has-error' : '' }}">
							<div class="input-group input-group-sm">
								<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
								{!! Form::text('expire_date', old('expire_date'), ['class'=>'form-control', 'placeholder'=>'Ngày hết hạn' , 'id' => 'datepicker']) !!}
							</div>
							@if ($errors->has('expire_date'))
							<span class="help-block">
								<strong>Ngày hết hạn không được bỏ trống!</strong>
							</span>
							@endif
						</div>

						<div class="form-group col-xs-12 col-sm-6 col-md-6 {{ $errors->has('category_id') ? ' has-error' : '' }}">
							<div class="input-group input-group-sm">
								<span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
								{!! Form::select('category_id[]', $categories, old('category_id'),['class'=>'form-control selectpicker', 'multiple'=>true,'title'=>'Chưa chọn vị trí tuyển dụng']) !!}
							</div>
							@if ($errors->has('category_id'))
							<span class="help-block">
								<strong>Vui lòng chọn vị trí tuyển dụng!</strong>
							</span>
							@endif
						</div>
					</div>

					<div class="row">
						
						<div class="form-group col-xs-12 col-sm-6 col-md-6 {{ $errors->has('salary') ? ' has-error' : '' }}">
							<div class="input-group input-group-sm">
								<span class="input-group-addon"><i class="fa fa-money-recruitment"></i></span>
								{!! Form::text('salary', null, ['class'=>'form-control', 'placeholder'=>'8.000.000 VNĐ - 15.000.000 VNĐ', 'autocomplete'=>'off', 'value'=> old('salary')]) !!}
							</div>
							@if ($errors->has('salary'))
							<span class="help-block">
								<strong>Vui lòng nhập lương!</strong>
							</span>
							@endif
						</div>

						<div class="form-group col-xs-12 col-sm-6 col-md-6 {{ $errors->has('tags.*') ? ' has-error' : '' }}">
							<div class="input-group input-group-sm">
								<span class="input-group-addon"><i class="fa fa-tag"></i></span>
								{!! Form::text('tags', null, ['class'=>'typeahead tm-input form-control tm-input-info', 'id'=>'typeahead', 'placeholder'=>'Tags', 'autocomplete'=>'off', 'value'=> old('hidden-tags')]) !!}
							</div>
							@if ($errors->has('tags.*'))
							<span class="help-block">
								<strong>TAG không hợp lệ!</strong>
							</span>
							@endif
						</div>
					</div>


				</div>
			</div>
			@foreach ($sections as $section)
			<div class="container">
				<header class="section-header">
					<h3>{!! $section->title !!}</h3>
				</header>
				{!! Form::textarea('sections['.$section->id.']' , null,['class'=>'summernote', 'rows'=>5]) !!}
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
	@endsection

	@section('scripts')

	<script src="{{ asset('assets/vendors/summernote/summernote.min.js') }}"></script>

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
			// toolbar: [
		 //    // [groupName, [list of button]]
		 //    ['style', ['bold', 'italic']],
		 //    ['para', ['ul', 'ol']],
		 //    ],
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
	@endsection