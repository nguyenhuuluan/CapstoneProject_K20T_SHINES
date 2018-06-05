@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="{{asset('assets/vendors/modal-confirm/jquery-confirm.min.css')}}">
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
    width: 100%;
}
</style>

@endsection

@section('body')

<div id="page-wrapper" style="margin-bottom: 100px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Cập nhật ảnh bìa</h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-xs-12 col-md-12">
                @include('includes.message')
                {!! Form::open(['method'=>'POST', 'route'=>'admin.background.update','id'=>'frmBckgrd', 'files'=>true]) !!}
                <div class="form-group {{ $errors->has('imgBckgrd') ? ' has-error' : '' }}">
                    <label>Tải ảnh lên</label>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <span class="btn btn-default btn-file">
                                Browse… <input type="file" required id="imgBckgrd" name="imgBckgrd" accept=".png,.jpg, image/gif, image/jpeg">
                            </span>
                        </span>
                        <input type="text" class="form-control" readonly id="imgText">
                    </div>
                    @if ($errors->has('imgBckgrd'))
                    <span class="help-block">
                        <strong>{{ $errors->first('imgBckgrd') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <input type="submit" value="Cập nhật" class="btn btn-success">
                </div>
                <hr>
                <div class="form-group">
                    <img id='img-upload' src="{{ asset('images/background/background.jpg') }}" />
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>

@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('assets/js/alert.js') }}"></script>
<script src="{{asset('assets/vendors/modal-confirm/jquery-confirm.min.js')}}"></script>


<script type="text/javascript">
    $(document).ready(function() {

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
        function validateImg(input){
            var ext = input.value.match(/\.([^\.]+)$/)[1];
            switch(ext.toLowerCase())
            {
                case 'jpg':
                case 'png':
                case 'gif':
                case 'bmp':
                case 'jpeg':
                return true;
                break;
                default:
                return false;
            }
        }
        function validateSizeIMG(input){
            var file_size = input.files[0].size;
            if(file_size>1048576){
                return false;
            } else{ return true;}
        }
        $("#imgBckgrd").change(function() {
            if(validateSizeIMG(this) && validateImg(this)) {
                readURL(this);
            }else{
                alertError('Vui lòng chọn ảnh đúng định dạng và dung lượng tối đa 1 MB !!');
                $("#imgBckgrd").val(null);
                $("#imgText").val(null);
                $('#img-upload').attr('src', '');
                return false;
            }
        });

        $('#frmBckgrd').submit(function(event){
            if(!$("#imgText").val()){
                alertError('Vui lòng chọn ảnh trước khi upload!')
                event.preventDefault();
            }
            return true;
        });
    });
</script>
@endsection
