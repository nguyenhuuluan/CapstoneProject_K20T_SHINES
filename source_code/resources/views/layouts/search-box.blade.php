 
{!! Form::open(['method'=>'GET', 'action'=>'RecruitmentController@search', 'class'=>'header-job-search' ]) !!}
<div class="input-keyword" style="text-align: left;">
	{!! Form::text('searchtext', null, ['class'=>'form-control tagsinput-typeahead', 'placeholder'=>'Tìm công việc hoặc công ty yêu thích', 'data-role'=>'tagsinput']) !!}
</div>


<div class="input-location">
		<select class="form-control" style="font-size: 16px;">
		<option>Hồ Chí Minh</option>
		<option>Hà Nội</option>
		<option>Đà Nẵng</option>
		<option>Cần Thơ</option>
	</select>
	{{-- {!! Form::text('city', null, ['class'=>'form-control', 'placeholder'=>'Thành phố bạn muốn làm việc']) !!} --}}
</div>

<div class="btn-search">
	{!! Form::submit('Tìm', ['class'=>'btn btn-primary']) !!}
</div>

{!! Form::close() !!}

