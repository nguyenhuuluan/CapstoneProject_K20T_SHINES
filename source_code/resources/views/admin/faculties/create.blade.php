@extends('layouts.admin')

@section('styles')
<link href="{{ asset('assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css') }} " rel="stylesheet">
<link href="{{asset('assets/vendors/summernote/summernote.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.min.css') }}">

@endsection

@section('body')

<div id="page-wrapper" style="margin-bottom: 100px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tạo mới ngành nghề</h1>
            </div>
            <!-- /.col-lg-12 -->
            {!! Form::open(['method'=>'POST', 'route'=>'faculties.store']) !!}
            <div class="col-xs-12 col-md-12">
                @include('includes.errors')
                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name">Tên ngành nghề:</label>
                    <input name="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                    <label for="description">Mô tả:</label>
                    <input name="description" class="form-control" value="{{ old('description') }}" required>
                </div>

                <div class="form-group">
                    <label>Tags</label>
                    <br>
                    <input name="tags" id="tags" type="text" class="tagsinput-typeahead form-control" placeholder="Nhập tags ngành nghề" data-role="tagsinput" value="{{ old('tags') }}">
                    <br>
                </div>

                <div class="form-group">
                    <a href="{{ route('faculties.index') }}" class="btn btn-danger">Hủy</a>
                    {!! Form::submit('Tạo mới', ['class'=>'btn btn-success', 'name'=>'submitbutton']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>

@endsection

@section('scripts')
<script src="{{ asset('assets/vendors/summernote/summernote.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap-tagsinput/bootstrap3-typeahead.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>


<script> 
    $('.tagsinput-typeahead').tagsinput({
        typeahead: {
            source: $.get('{{ route('tags') }}'),
            afterSelect: function() {
                this.$element[0].value = '';    
            },
        },
        trimValue: true,
        freeInput: true,
        tagClass: 'label label-default',
    })
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $(window).keypress(function(event){
            if(event.keyCode == 13) {
              event.preventDefault();
              return false;
          }
      });
    });
</script>

@endsection
