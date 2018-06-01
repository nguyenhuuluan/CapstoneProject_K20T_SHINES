@extends('layouts.admin')



@section('styles')
<link rel="stylesheet" href="{{asset('assets/vendors/modal-confirm/jquery-confirm.min.css')}}">
<link href="{{ asset('assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css') }} " rel="stylesheet">
<link href="{{asset('assets/vendors/summernote/summernote.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.min.css') }}">

<style type="text/css">
.btn-file {
    position: relative;
    overflow: hidden;
}

.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}

#img-upload {
    width: 30%;
}
</style>
@endsection

@section('body')

<div id="page-wrapper" style="margin-bottom: 100px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Đăng blog</h1>
            </div>
            <!-- /.col-lg-12 -->
            {!! Form::open(['method'=>'POST', 'route'=>'blogs.store', 'files'=>true]) !!}
            <div class="col-xs-12 col-md-9">
                <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="title">Tiêu đề Blog</label>
                    <input name="title" class="form-control" value="{{ old('title') }}" required placeholder="Nhập tiêu đề blog">
                    @if ($errors->has('title'))
                    <span class="help-block">
                        <strong>Tiêu đề không được bỏ trống!</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('imgInp') ? ' has-error' : '' }}">
                    <label>Ảnh đại diện</label>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <span class="btn btn-default btn-file">
                                Browse… <input type="file" required value="{{ old('imgInp') }}" id="imgInp" name="imgInp" accept=".png,.jpg, image/gif, image/jpeg">
                            </span>
                        </span>
                        <input type="text" class="form-control" readonly id="imgText">
                    </div>
                    @if ($errors->has('imgInp'))
                    <span class="help-block">
                        <strong>Vui lòng chọn ảnh đại diện cho bài BLOG!</strong>
                    </span>
                    @endif
                    <img id='img-upload' />
                </div>
                <div class="form-group {{ $errors->has('content') ? ' has-error' : '' }}">
                    <label>Nội dung</label>
                    {{-- <textarea id="summernote" class="form-control" name="content"></textarea> --}}
                    <textarea name="content" class="form-control " id="editor1">{{ old('content') }}</textarea>
                    
                    @if ($errors->has('content'))
                    <span class="help-block">
                        <strong>Vui lòng nhập nội dung!</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group">
                    <label>Tags</label>
                    <br>
                    <input name="tags" id="tags" type="text" class="tagsinput-typeahead form-control" placeholder="Nhập tags bài viết" value="{{ old('tags') }}" data-role="tagsinput">
                    <br>
                </div>
                <div class="form-group  {{ $errors->has('description') ? ' has-error' : '' }}">
                    <label>Mô tả tìm kiếm</label>
                    <textarea name="description" required class="form-control" rows="3" placeholder="Mô tả tiêu đề tìm kiếm (SEO)">{{ old('description') }}</textarea>
                    @if ($errors->has('description'))
                    <span class="help-block">
                        <strong>Vui lòng nhập nội dung!</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="col-xs-12 col-md-3">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Công cụ đăng
                    </div>
                    <div class="panel-body">
                        <p class="fa fa-calendar"></p> Ngày đăng: {{ date('d-m-Y H:i:s') }}
                        <br>
                        <p class="fa fa-gear"></p> Trạng thái: <strong style="color:red;">Nháp</strong>
                    </div>

                    <div class="panel-footer">
                        {!! Form::submit('Xem trước', ['class'=>'btn btn-default', 'name'=>'submitbutton' , 'formtarget'=>'_blank']) !!}
                        <button type="button" class="btn btn-warning">Hủy</button>
                        {!! Form::submit('Đăng bài', ['class'=>'btn btn-success', 'name'=>'submitbutton']) !!}
                        {{-- <input type="submit" style="position: absolute; left: -9999px"> --}}
                    </div>
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
<script type="text/javascript" src="{{ asset('assets/js/alert.js') }}"></script>


<script src="{{asset('assets/vendors/modal-confirm/jquery-confirm.min.js')}}"></script>

<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
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
    $(document).ready(function() {

        CKEDITOR.replace( 'editor1', {
            filebrowserImageBrowseUrl: '../../laravel-filemanager?type=Images',
            filebrowserBrowseUrl: '../../laravel-filemanager?type=Files',
        }); 

        $(window).keypress(function(event){
            if(event.keyCode == 13) {
              event.preventDefault();
              return false;
          }
      });

        $(document).on('change', '.btn-file :file', function() {
            var input = $(this),
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [label]);
        });

        $('.btn-file :file').on('fileselect', function(event, label) {

            var input = $(this).parents('.input-group').find(':text'),
            log = label;
            if (input.length) {
                input.val(log);
            } else {
                if (log) alert(log);
            }

        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#img-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imgInp").change(function() {
            if(validateSizeIMG(this) && validateImg(this)) {
                readURL(this);
            }else{
                alertError('Vui lòng chọn ảnh đúng định dạng và dung lượng tối đa 2 MB ...');
                $("#imgInp").val(null);
                $("#imgText").val(null);
                $('#img-upload').attr('src', '');
                return false;
            }
        });
    });
</script>
@endsection
