 
{!! Form::open(['method'=>'GET', 'action'=>'RecruitmentController@search', 'class'=>'header-job-search' ]) !!}
<div class="input-keyword" style="text-align: left;">
	{!! Form::text('searchtext', null, ['class'=>'form-control tagsinput-typeahead', 'placeholder'=>'Tìm kiếm công việc yêu thích...', 'data-role'=>'tagsinput']) !!}
</div>
<div class="btn-search">
	{!! Form::submit('Tìm', ['class'=>'btn btn-primary']) !!}
</div>

{!! Form::close() !!}

