@extends('layouts2.master-layout',['title' => 'Cập nhật thông tin công ty', 'isDisplaySearchHeader' => false])

@section('stylesheet')

<link href="{{asset('assets/vendors/summernote/summernote.css')}}" rel="stylesheet">

@endsection

@section('content')

<section>
    <div class="container">
        <div class="col-md-3 col-sm-12 col-xs-12">
            <form enctype="multipart/form-data" id="upload-logo-form" role="form" method="POST" action="{{ route('company.updateImage') }}" >
                {{ csrf_field() }}
                <center>
                    <div class="form-group">
                        <input id="logoname" type="file" class="dropify" data-default-file="{{ asset($company->logo) }}" name="logo">
                        <span class="help-block">Logo công ty</span>
                    </div>
                </center>

            </form>

            <hr>
            <center>
                <p>Liên hệ với VLU Jobs</p>
                <strong>08 123 4568</strong><br><br>
                <a href="{{ route('company.details',['id' => $company->id]) }}" target="_blank" class="btn btn-warning">Xem công ty của bạn</a>
            </center>
            <br>
        </div>
        <div class="col-md-9 col-sm-12 col-xs-12">
         <div class="table-responsive">


            {!! Form::model($company, ['method' => 'POST', 'route' => ['company.edit', $company->id], 'class' => 'form-horizontal']) !!}

            <input id="companyID" type="hidden" name="id" value="{{$company->id}}">

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
                                {!! Form::text('name', $company->name, ['class' => 'form-control']) !!}
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
                                {!! Form::text('business_code', $company->business_code, ['class' => 'form-control']) !!}
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
                                {!! Form::email('email', $company->email, ['class' => 'form-control', 'required' => 'required']) !!}
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
                            {!! Form::text('website', $company->website, ['class' => 'form-control']) !!}
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
                        {!! Form::text('facebook', $company->socialNetworks()->where('name', 'facebook')->first()["url"], ['class' => 'form-control input-sm', 'placeholder' => 'Facebook']) !!}
                        <small class="text-danger">{{ $errors->first('facebook') }}</small>
                    </div>
                </div>
                <input type="hidden" name="socialnetworkfbID" value="{{$company->socialNetworks()->where('name', 'facebook')->first()["id"]}}">

                <div class="form-group{{ $errors->has('linkedin') ? ' has-error' : 'ERROR' }}">
                    <div class="col-sm-9" style="margin-top: 5px;">
                        {!! Form::text('linkedin', $company->socialNetworks()->where('name', 'linkedin')->first()["url"], ['class' => 'form-control input-sm', 'placeholder' => 'LinkedIn']) !!}
                        <small class="text-danger">{{ $errors->first('linkedin') }}</small>
                    </div>
                </div>
                <input type="hidden" name="socialnetworkinID" value="{{$company->socialNetworks()->where('name', 'linkedin')->first()["id"]}}">
            </td>
        </tr>

        <tr>
           <td>Số điện thoại</td>
           <td>
            <div class="form-group{{ $errors->has('phone') ? ' has-error' : 'ERROR' }}">
                <div class="col-sm-9">
                    {!! Form::text('phone', $company->phone, ['class' => 'form-control input-sm']) !!}
                    <small class="text-danger">{{ $errors->first('phone') }}</small>
                </div>
            </div>
        </td>
    </tr>
    <tr>
       <td>Địa chỉ</td>
       <td>
        <div class="form-group{{ $errors->has('address') ? ' has-error' : 'ERROR' }}">
            <div class="col-sm-6">
                {!! Form::text('address', count($company->address) == 0 ? "" : $company->address->address, ['class' => 'form-control input-sm', 'required' => 'required', 'placeholder' => '45 Nguyễn Khắc Nhu, Phường Cô Giang']) !!}
                <small class="text-danger">{{ $errors->first('address') }}</small>
            </div>

            <div class="col-sm-3">
                <select class="form-control input-sm" name="district" id="lst-district">
                    @foreach($districts as $district)
                    <option value="{{ $district->id }}" {{(count($company->address) == 0 ? $districts[0]->id : $company->address->district->id) == $district->id ? "selected" : "" }}>{{ $district->name}}</option>
                    @endforeach
                </select>
            </div>

            <input id="district-name" type="hidden" name="districtname" value="">

            <div class="col-sm-3">
                <select class="form-control input-sm" name="city" id="lst-cities">
                    @foreach($cities as $city)
                    <option value="{{ $city->id }}" {{(count($company->address) == 0 ? $cities[0]->id : $company->address->district->city->id) == $city->id ? "selected" : "" }}>{{ $city->name}}</option>
                    @endforeach
                </select>
            </div>

            <input id="city-name" type="hidden" name="cityname" value="">




        </div>
    </td>
</tr>

<tr>
 <td>Thời gian làm việc</td>
 <td>
    <div class="form-group{{ $errors->has('working_day') ? ' has-error' : 'ERROR' }}">
        <div class="col-sm-9">
            {!! Form::text('working_day', $company->working_day, ['class' => 'form-control input-sm', 'required' => 'required']) !!}
            <small class="text-danger">{{ $errors->first('working_day') }}</small>
        </div>
    </div>
</td>
</tr>

<tr>
    <td>Lĩnh vực công ty</td>
    <td>
        <div class="form-group{{ $errors->has('field') ? ' has-error' : 'ERROR' }}">
            <div class="col-sm-9">
                {!! Form::text('field', $company->field, ['class' => 'form-control input-sm', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('field') }}</small>
            </div>
        </div>
    </td>
</tr>

<tr>
    <td>Giới thiệu</td>
    <td>
        <div class="form-group{{ $errors->has('introduce') ? ' has-error' : 'ERROR' }}">
            <div class="col-sm-9">
                <textarea width: 440px;" class="form-control" rows="3" name="introduce">{{$company->introduce}}</textarea>
                <small class="text-danger">{{ $errors->first('introduce') }}</small>
            </div>
        </div>
        
    </td>
</tr>

<tr>
    <td>TAG</td>
    <td>

        <input class="tagsinput" type="text" name="tags" class="123input tm-input form-control tm-input-info tagsinput-typeahead" data-role="tagsinput" placeholder="Nhập tag" value="{{implode(",",$tags)}}" />
        
    </td>
</tr>
</tbody>
</table>


<p class="text-center">
  {!! Form::submit("Cập nhật", ['class' => 'btn btn-success btn-xl btn-round']) !!}
</p>
<br>


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

    $('#district-name').val($('#lst-district option:selected').text());
    $('#city-name').val($('#lst-cities option:selected').text());

    $('#lst-cities').bind("change", function () {
        var cityID = $(this).val();     
        GetDistrict(cityID);

        $('#city-name').val($('#lst-cities option:selected').text());
        
    });

    $('#lst-district').bind('change', function() {
        $('#district-name').val($('#lst-district option:selected').text());
    });

    $('#logoname').bind("change", function () {
        updateLogo();
    });





    function GetDistrict(cityID) {
       var urlDistrict = '{{ route("address.districts", ":id") }}';
       urlDistrict = urlDistrict.replace(':id', cityID);
       $.ajax({
        url: urlDistrict,
        type: 'GET',
        success: function (response) {


            $('#lst-district').empty();
            $.each(response, function (i, response) {
                $('#lst-district').append(new Option(response.name, response.id));
            });
            $('#district-name').val($('#lst-district option:selected').text());
        },
        error: function () {
            alert('error');
        }
    });
   }

   function updateLogo(){
    
      var id = $('#companyID').val();
      var imagefile = document.getElementById("logoname").files[0];
      var urlImg = '{{ route('company.updateImage') }}';
      var data = new FormData();
      data.append("id", id);
      data.append("imagefile", imagefile);

      $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        url: urlImg,
        contentType: false,
        processData: false,
        cache:false,
        data: data,
        success: function (response) {
           if (response == 200) {
            alert("Cập nhật logo thành công");
        }
    },
    error: function () {
        alert('Đã có lỗi xảy ra');
    }
});

      // e.preventDefault();

      // $('#upload-logo-form').submit();
  }


  var urlTag = '{{ route('tags') }}';
  var tagnames = new Bloodhound({
     datumTokenizer: Bloodhound.tokenizers.obj.whitespace("name"),
     queryTokenizer: Bloodhound.tokenizers.whitespace,
     prefetch: {
         url: urlTag,
         cache: false,
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