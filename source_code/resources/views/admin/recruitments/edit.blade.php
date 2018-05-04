@extends('layouts.admin')


@section('styles')
<link rel="stylesheet" href="{{asset('assets/vendors/modal-confirm/jquery-confirm.min.css')}}">


{{-- bootstrap switch --}}
<link href="{{asset('assets/vendors/bootstrap-switch/bootstrap-switch.css')}}" rel="stylesheet">
@endsection


@section('body')
<div id="page-wrapper">
    <div class="container-fluid">
        {!! Form::model($recruitment,['method'=>'POST', 'route'=>['admin.recruitments.update', $recruitment->id]]) !!}
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
<script src="{{ asset('assets/js/typeahead.bundle.js') }}" type="text/javascript" charset="utf-8"></script>
<script src="{{ asset('assets/vendors/summernote/summernote.min.js') }}"></script>
<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script type="text/javascript">


</script>
@endsection

