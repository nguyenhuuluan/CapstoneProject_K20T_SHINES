 
 {!! Form::open(['method'=>'GET', 'action'=>'RecruitmentController@search', 'class'=>'header-job-search' ]) !!}
 <div class="input-keyword">
  {!! Form::text('searchtext', null, ['class'=>'form-control tagsinput-typeahead', 'placeholder'=>'Tìm công việc hoặc công ty yêu thích', 'data-role'=>'tagsinput']) !!}
</div>

<div class="input-location">
  {!! Form::text('city', null, ['class'=>'form-control', 'placeholder'=>'Thành phố bạn muốn làm việc']) !!}
</div>

<div class="btn-search">
  {!! Form::submit('Tìm', ['class'=>'btn btn-primary']) !!}
</div>

{!! Form::close() !!}

