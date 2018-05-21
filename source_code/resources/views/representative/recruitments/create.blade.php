@extends('layouts.master-layout',['title' => 'Jobee - Đăng tin tuyển dụng', 'isDisplaySearchHeader' => false])
{{-- @extends('layouts.representative') --}}



@section('stylesheet')
<link href="{{asset('assets/vendors/summernote/summernote.css')}}" rel="stylesheet">


{{-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/tagmanager/3.0.2/tagmanager.min.css"> --}}
<link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.min.css') }}">
@endsection

@section('page-header')
<header class="page-header">
	<div class="container page-name">
		<h1 class="text-center">Đăng tin tuyển dụng</h1>
	</div>
</header>
@endsection

@section('content')
<main>

	{!! Form::open(['method'=>'POST', 'action'=>'Representative\RepresentativeRecruitmentController@store']) !!}
	<section>
		<div class="container">
			<div class="row">
				<div class="row">
					<div class="form-group col-xs-6 col-sm-6 {{ $errors->has('title') ? ' has-error' : '' }}">
						<div class="input-group input-group-sm">
							<span class="input-group-addon"><i class="fa fa-newspaper-o"></i></span>
							{!! Form::text('title', null,['class'=>'form-control', 'placeholder'=>'Tiêu đề tin tuyển dụng', 'value'=> old('title') ]) !!}
						</div>
						@if ($errors->has('title'))
						<span class="help-block">
							<strong>Tiêu đề không được bỏ trống!</strong>
						</span>
						@endif
					</div>

					<div class="form-group col-xs-3 col-sm-3">
						<div class="input-group input-group-sm">
							<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
							<select class="form-control" name="district" id="lst-district">
								@foreach($cities[0]->districts as $district)
								<option value="{{ $district->id }}">{{ $district->name}}</option>
								@endforeach
							</select>
							<input id="district-name" type="hidden" name="districtname" value="">
						</div>
					</div>

					<div class="form-group col-xs-3 col-sm-3">
						<div class="input-group input-group-sm">
							<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

							<select class="form-control" name="city" id="lst-cities">
								@foreach($cities as $city)
								<option value="{{ $city->id }}">{{ $city->name}}</option>
								@endforeach
							</select>
							<input id="city-name" type="hidden" name="cityname" value="">
						</div>
					</div>
					

				</div>

				<div class="row">

					<div class="form-group col-xs-12 col-sm-6 col-md-6 {{ $errors->has('expire_date') ? ' has-error' : '' }}">
						<div class="input-group input-group-sm">
							<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							{!! Form::date('expire_date', old('expire_date'), ['class'=>'form-control', 'placeholder'=>'Ngày hết hạn' , 'id' => 'datepicker']) !!}
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

							{{-- {!! Form::text('tags', null, ['class'=>'typeahead tm-input form-control tm-input-info', 'id'=>'typeahead', 'placeholder'=>'Tags', 'autocomplete'=>'off', 'value'=> old('hidden-tags')]) !!} --}}

							{!! Form::text('tags', null, ['class'=>'tagsinput 123input tm-input form-control tm-input-info tagsinput-typeahead','data-role'=>'tagsinput', 'placeholder'=> 'Nhập tag', 'value'=> old('tags')]) !!}

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
			{!! Form::textarea('sections['.$section->id.']' , null,['class'=>'summernote-editor', 'rows'=>5]) !!}
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

<script src="{{ asset('assets/js/jquery-ui.js') }}"></script>


<script src="{{ asset('assets/js/typeahead.bundle.js') }}" type="text/javascript" charset="utf-8"></script>
<script src="{{ asset('assets/vendors/summernote/summernote.min.js') }}"></script>



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
	$('#district-name').val($('#lst-district option:selected').text());
	$('#city-name').val($('#lst-cities option:selected').text());
	var data = {!! $cities !!};
	// // GetDistrict(data);

	$('#lst-cities').on("change", function(){
		GetDistrict(data);
		$('#city-name').val($('#lst-cities option:selected').text());
	});	
	$('#district-name').on("change", function(){
		$('#district-name').val($('#lst-district option:selected').text());
	});

	function GetDistrict(data) {

		var tmp = $('#lst-cities').val();
		for (var i = 0; i < data.length; i++) {

			//Nếu đúng select đang chọn
			if(data[i].id==tmp){
				var tmpData = data[i].districts;
				$('#lst-district').removeClass("selectpicker");
				$('#lst-district').empty();
				$.each(tmpData, function (k, tmpData) {
					$('#lst-district').append(new Option(tmpData.name, tmpData.id));
				});
				return false;
			}
		}


		$('#lst-district').empty();
		$.each(response, function (i, response) {
			$('#lst-district').append(new Option(response.name, response.id));
		});
		$('#district-name').val($('#lst-district option:selected').text());


	};



	// $(".summernote-editor").summernote({
	// 	toolbar: [
	// 	    // [groupName, [list of button]]
	// 	    ['style', ['bold', 'italic']],
	// 	    ['para', ['ul', 'ol']],
	// 	    ['insert', ['link', 'picture', 'hr']],
	// 	    ],
	// 	    height: 200
	// 	});

	$('.summernote-editor').summernote({
		toolbar: [
    // [groupName, [list of button]]
    ['style', ['bold', 'italic']],
    ['para', ['ul', 'ol']],
    ['insert', ['hr']],
    ['height', ['height']]
    ],
    dialogsInBody: true,
    dialogsFade: true,
    disableDragAndDrop: false,
    height: 200,
    maximumImageFileSize: 5242880,


});
</script>
@endsection