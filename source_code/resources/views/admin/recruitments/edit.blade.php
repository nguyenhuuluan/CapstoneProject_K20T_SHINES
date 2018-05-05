@extends('layouts.admin')


@section('styles')
<link rel="stylesheet" href="{{asset('assets/vendors/modal-confirm/jquery-confirm.min.css')}}">
<link href="{{asset('assets/vendors/summernote/summernote.css')}}" rel="stylesheet">
<link href="{{ asset('assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css') }} " rel="stylesheet">


{{-- bootstrap switch --}}
<link href="{{asset('assets/vendors/bootstrap-switch/bootstrap-switch.css')}}" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('vendor/multiselect/dist/css/bootstrap-select.css') }}">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="{{ asset('vendor/multiselect/dist/js/bootstrap-select.js') }}"></script>
@endsection


@section('body')
<div id="page-wrapper">
    <div class="container-fluid">
        {!! Form::model($recruitment,['method'=>'PATCH', 'route'=>['admin.recruitments.update', $recruitment->id]]) !!}
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Quản lý tin tuyển dụng </h1>
            </div>

            <div class="form-group col-xs-9 col-sm-9">
                <div class="row">
                    <div class="form-group col-xs-6 col-sm-6 {{ $errors->has('title') ? ' has-error' : '' }}">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon"><i class="fa fa-newspaper-o"></i></span>
                            {!! Form::text('title', null,['class'=>'form-control', 'placeholder'=>'Tiêu đề tin tuyển dụng', 'value'=> old('title') ]) !!}
                        </div>
                        @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>Tiêu đề không được bỏ trống! </strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group col-xs-3 col-sm-3">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>     
                            <select class="form-control" name="district" id="lst-district">
                                @foreach($cities[0]->districts as $district)
                                <option value="{{ $district->id }}" {!! $recruitment->location[0] == $district->name ? 'selected' : '' !!}>
                                 {!! $district->name !!}  
                             </option>
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
                            <option value="{{ $city->id }}" {!! $recruitment->location[1] == $city->name ? 'selected' : '' !!}>{{ $city->name}}</option>
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
                        {!! Form::select('category_id[]', $categories, old('category_id') ? old('category_id') : $recruitment->categories->pluck('id') ,['class'=>'form-control selectpicker', 'multiple'=>'multiple','title'=>'Chưa chọn vị trí tuyển dụng', 'id'=>'category_id']) !!}
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
                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
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
                        {!! Form::text('tags', $tags, ['class'=>'tagsinput-typeahead form-control','data-role'=>'tagsinput', 'placeholder'=> 'Nhập tag', 'value'=> old('tags')]) !!}
                    </div>
                    @if ($errors->has('tags.*'))
                    <span class="help-block">
                        <strong>TAG không hợp lệ!</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>


        <div class="col-xs-12 col-md-3 float-lg-right" >
            <div class="panel panel-info">
                <div class="panel-heading">
                    Công cụ đăng
                </div>
                <div class="panel-body">
                    <p class="fa fa-calendar"></p> Ngày đăng: {!! date_format($recruitment->created_at, 'd-m-Y H:i:s') !!}
                    <br>
                    <p class="fa fa-gear"></p> Trạng thái: 
                    <strong style="color:red;">
                        @if ($recruitment->status->id == 8)
                        Chưa xác thực ... 
                        @else
                        Đã xác thực ... 
                        @endif
                    </strong>
                </div>

                <div class="panel-footer">
                    {!! Form::submit('Xem trước', ['class'=>'btn btn-default', 'name'=>'submitbutton' , 'formtarget'=>'_blank']) !!}
                    <button type="button" class="btn btn-warning">Hủy</button>
                    {!! Form::submit('Đăng bài', ['class'=>'btn btn-success', 'name'=>'submitbutton']) !!}
                    {{-- <input type="submit" style="position: absolute; left: -9999px"> --}}
                </div>
            </div>
        </div>


        <div class="form-group col-xs-9 col-sm-9">
           @foreach ($sections as $section)
           <header class="section-header">
            <h3>{!! $section->title !!}</h3>
        </header>
        {{-- {!! $recruitment->sections->where('id', $section->id)->first() ? 1 :2 !!} --}}
        {{-- {!! $recruitment->sections->where('id', $section->id)->first()['pivot']['content'] !!} --}}
        {!! Form::textarea('sections['.$section->id.']',
           $recruitment->sections->where('id', $section->id)->first() ? $recruitment->sections->where('id', $section->id)->first()->pivot->content : null,
           ['class'=>'summernote-editor', 'rows'=>5]) !!}
           <br>
           @endforeach

       </div>
   </div>
   {!! Form::close()  !!}
</div>
<!-- /.container-fluid -->
</div>



@endsection

@section('scripts')


<script src="{{asset('assets/vendors/bootstrap-switch/bootstrap-switch.js')}}"></script>
{{-- using jquery modal confirm JS --}}
<script src="{{asset('assets/vendors/modal-confirm/jquery-confirm.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/alert.js') }}"></script>

<script src="{{ asset('assets/js/jquery-ui.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap-tagsinput/bootstrap3-typeahead.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
<script src="{{ asset('assets/vendors/summernote/summernote.js') }}"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->

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
        // tagClass: 'label label-success',
    })
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


    $('.summernote-editor').summernote({
        toolbar: [
    // [groupName, [list of button]]
    ['style', ['bold', 'italic']],
    ['para', ['ul', 'ol']],
    ['insert', ['picture', 'hr']],
    ['height', ['height']]
    ],
    dialogsInBody: true,
    dialogsFade: true,
    disableDragAndDrop: false,
    height: 200,
    maximumImageFileSize: 5242880,


});
</script>

<script type="text/javascript">

</script>
@endsection

