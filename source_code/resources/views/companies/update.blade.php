@extends('layouts2.master-layout',['title' => 'Cập nhật thông tin công ty', 'isDisplaySearchHeader' => false])

@section('stylesheet')

<link href="{{asset('assets/vendors/summernote/summernote.css')}}" rel="stylesheet">

@endsection

@section('content')

<section>
    <div class="container">
        <div class="col-md-3 col-sm-12 col-xs-12">
            <center>
                <div class="form-group">
                    <input type="file" class="dropify" data-default-file="assets/img/fpt.jpg">
                    <span class="help-block">Logo công ty của bạn</span>
                </div>
            </center>
            <hr>
            <center>
                <p>Liên hệ với VLU Jobs</p>
                <strong>08 123 4568</strong><br><br>
                <a href="company-detail-preview.html" target="_blank" class="btn btn-warning">Xem công ty của bạn</a>
            </center>
            <br>
        </div>
        <div class="col-md-9 col-sm-12 col-xs-12">
           <div class="table-responsive">


            {!! Form::model($company, ['method' => 'POST', 'route' => ['company.edit', $company->id], 'class' => 'form-horizontal']) !!}
            
            <table class="table">
             <thead>
                 <tr>
                   <h2>Cập nhật thông tin công ty</h2>
               </tr>
           </thead>
           <tbody>
            <tr>
                <td>Tên công ty</td>
                <td>
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : 'ERROR' }}">
                        <div class="col-sm-9">
                            {!! Form::text('name', $company->name, ['class' => 'form-control input-sm', 'required' => 'required']) !!}
                            <small class="text-danger">{{ $errors->first('name') }}</small>
                        </div>
                    </div>
                </td>

            </tr>
            <tr>
                <td>Mã số kinh doanh</td>
                <td>
                    <div class="form-group{{ $errors->has('business_code') ? ' has-error' : 'ERROR' }}">
                        <div class="col-sm-9">
                            {!! Form::text('business_code', $company->business_code, ['class' => 'form-control input-sm', 'required' => 'required']) !!}
                            <small class="text-danger">{{ $errors->first('business_code') }}</small>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Email</td>
                <td>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : 'ERROR' }}">
                        <div class="col-sm-9">
                            {!! Form::email('email', $company->email, ['class' => 'form-control input-sm', 'required' => 'required']) !!}
                            <small class="text-danger">{{ $errors->first('email') }}</small>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
              <td>Website</td>
              <td>
                <div class="form-group{{ $errors->has('website') ? ' has-error' : 'ERROR' }}">
                    <div class="col-sm-9">
                        {!! Form::text('website', $company->website, ['class' => 'form-control input-sm', 'required' => 'required email']) !!}
                        <small class="text-danger">{{ $errors->first('website') }}</small>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
          <td>Liên kết mạng xã hội</td>
          <td>
            <div class="form-group{{ $errors->has('facebook') ? ' has-error' : 'ERROR' }}">
                <div class="col-sm-9">
                    {!! Form::email('facebook', $company->socialNetworks()->where('name', 'facebook')->first()["url"], ['class' => 'form-control input-sm', 'required' => 'required', 'placeholder' => 'Facebook']) !!}
                    <small class="text-danger">{{ $errors->first('facebook') }}</small>
                </div>
            </div>

            <div class="form-group{{ $errors->has('linkedin') ? ' has-error' : 'ERROR' }}">
                <div class="col-sm-9" style="margin-top: 5px;">
                    {!! Form::email('linkedin', $company->socialNetworks()->where('name', 'linkedin')->first()["url"], ['class' => 'form-control input-sm', 'required' => 'required', 'placeholder' => 'LinkedIn']) !!}
                    <small class="text-danger">{{ $errors->first('linkedin') }}</small>
                </div>
            </div>
        </td>
    </tr>

    <tr>
     <td>Số điện thoại</td>
     <td>
        <div class="form-group{{ $errors->has('phone') ? ' has-error' : 'ERROR' }}">
            <div class="col-sm-9">
                {!! Form::text('phone', $company->phone, ['class' => 'form-control input-sm', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('phone') }}</small>
            </div>
        </div>
    </td>
</tr>
<tr>
 <td>Địa chỉ</td>
 <td><input type="text" class="form-control input-sm" value="45 Nguyễn Khắc Nhu"></td>
</tr>
<tr>
 <td>Quận/ Huyện</td>
 <td>
     <select class="form-control selectpicker">
         <option value="1">1</option>
         <option value="2">2</option>
         <option selected="selected" value="3">3</option>
         <option value="4">4</option>
     </select>
 </td>
</tr>
<tr>
    <td>Tỉnh/Thành Phố</td>
    <td>
        <select class="form-control selectpicker">
         <option selected="selected">Hồ Chí Minh</option>
         <option>Hà Nội</option>
         <option>Đà Nẵng</option>
         <option>Cần Thơ</option>
         <option>Hải Phòng</option>
     </select>
 </td>
</tr>
         {{-- <tr>
             <td>Quốc Gia</td>
             <td><input type="text" class="form-control input-sm" value="Việt Nam"></td>
         </tr> --}}

         <tr>
           <td>Thời gian làm việc</td>
           <td>
               <select class="form-control selectpicker" data-placeholder="Nhấn để chọn...">
                   <option>Thứ hai - thứ sáu</option>
                   <option>Thứ hai - thứ bảy</option>
                   <option>Thứ hai - chủ nhật</option>
               </select>
           </td>
       </tr>

       <tr>
        <td>Lĩnh vực công ty</td>
        <td><input type="text" class="form-control input-sm" value="Mạng và phần mềm"></td>
    </tr>

    <tr>
        <td>Giới thiệu</td>
        <td>
            <textarea class="summernote-editor"></textarea>
        </td>
    </tr>

    <tr>
        <td>TAG</td>
        <td>
            <input class="tagsinput" type="text" name="tags" class="123input tm-input form-control tm-input-info tagsinput-typeahead" data-role="tagsinput" placeholder="Nhập tag" value="PHP, HTML" />
        </td>
    </tr>
</tbody>
</table>

<div class="btn-group pull-right">
    {!! Form::reset("Reset", ['class' => 'btn btn-warning']) !!}
    {!! Form::submit("Add", ['class' => 'btn btn-Add']) !!}
</div>

{!! Form::close() !!}
</div>
</div>
</div>
</section>

@endsection

@section('scripts')

<script src="https://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js" type="text/javascript" charset="utf-8"></script>

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
           source: tagnames.ttAdapter()
       }
   });
</script>

@endsection