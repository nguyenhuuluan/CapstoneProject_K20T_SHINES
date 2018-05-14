@extends('layouts2.master-layout',['title' => 'Cập nhật thông tin công ty', 'isDisplaySearchHeader' => false])

@section('stylesheet')

<link href="{{asset('assets/vendors/summernote/summernote.css')}}" rel="stylesheet">
<link href="{{asset('assets/css/imageuploadify.min.css')}}" rel="stylesheet">

@endsection

@section('content')

<section>
    <div class="container">
        <div class="col-md-3 col-sm-12 col-xs-12">
            <form enctype="multipart/form-data" id="upload-logo-form" role="form" method="POST" action="{{ route('company.updateLogo') }}" >
                {{ csrf_field() }}
                <center>
                    <div class="form-group">
                        <input id="logoname" type="file" class="dropify" accept="image/x-png,image/gif,image/jpeg" data-default-file="{{ asset($company->logo) }}" name="logo">
                        <span class="help-block">Logo công ty</span>
                        <small class="text-success update-logo-noti" style="display: none;">Đã cập nhật logo</small>
                    </div>
                </center>

            </form>

            <hr>
            <center>
                <p>Liên hệ với VLU Jobs</p>
                <strong>08 123 4568</strong><br><br>
                <a href="{{ route('company.details', $company->slug) }}" target="_blank" class="btn btn-warning">Xem công ty của bạn</a>
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
                            {!! Form::text('email', $company->email, ['class' => 'form-control']) !!}
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

    <div class="form-group{{ ($errors->has('address') || Session::has('address-invalid'))  ? ' has-error' : 'ERROR' }}">
        <div class="col-sm-6">
            {!! Form::text('address', count($company->address) == 0 ? "" : $company->address->address, ['class' => 'form-control input-sm', 'required' => 'required', 'placeholder' => '45 Nguyễn Khắc Nhu, Phường Cô Giang']) !!}
            <small class="text-danger">{{ $errors->first('address') }}</small>

            @if(Session::has('address-invalid'))
            <small class="text-danger">{!! session('address-invalid') !!}</small>
            @endif
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
            {!! Form::text('working_day', $company->working_day, ['class' => 'form-control input-sm']) !!}
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
                {!! Form::text('field', $company->field, ['class' => 'form-control input-sm']) !!}
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
<tr>
    <td>Hình ảnh</td>
    <td>

        <form id="FormUpLoadImages" method="post" enctype="multipart/form-data"  action="{{ route('company.updateImages') }}" >
            {{ csrf_field() }}
            <label><b>Chọn 1 hoặc nhiều hình ảnh: </b></label>
            <input class="btn btn-default" type="file" title="search" multiple="" accept="image/x-png,image/gif,image/jpeg" id="InputImages" name="Images" />
        </form>

        <div id="UploadImages" class="" style="margin-top: 10px;">
            <ul class="list-group col-sm-6">
                @foreach ($company->photos()->pluck('name')->toArray() as $photoname)
                <li class="list-group-item" style="margin-bottom:4px;"><img src="{{ asset('images/companies/'.$photoname) }}" width="150px" height="150px"/> <span><button type="button" class = "btn btn-danger";" href="#" id="DeleteImage" data-imagename="{{$photoname}}">Xóa</button></span></li>
                @endforeach
            </ul>
        </div>

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
<script src="{{ asset('assets/js/imageuploadify.min.js') }}"></script>

<script type="text/javascript">

    $('.images').imageuploadify();

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


    $('#InputImages').on("change", function () {
        AutoUpLoadImages();
    });

    $('#UploadImages').on('click', '#DeleteImage', function () {

       // var ImageID = $(this).attr("data-imageid");
       var ImageName = $(this).attr("data-imagename");

       DeleteImage(ImageName);

       $(this).closest('li').remove();
       $("input[value='" + ImageName + "']").remove();
   });

    function AutoUpLoadImages(e) {

        var data = new FormData();
        var totalImages = document.getElementById("InputImages").files.length;
        var route = '{{ route('company.updateImages') }}';
        var companyID = $('#companyID').val();

        data.append('id',companyID);

        for (var i = 0; i < totalImages; i++) {
            var Image = document.getElementById("InputImages").files[i];
            data.append("Images[]", Image);
        }

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: route,
            contentType: false,
            processData: false,
            cache:false,
            data: data,
            success: function (ImageNames) {
             PreviewImages(ImageNames);
             // RenderInputHiddenImageName(ImageNames);                
         },
         error: function () {
            alert('Hình ảnh phải dưới 2.0 Mb');
        }
    });

        // e.preventDefault();

        // $('#FormUpLoadImages').submit();
    }

    function PreviewImages(ImageNames) {
        var html = '';
        var $domainURL = '{{ asset('') }}';

        for (var i = 0; i < ImageNames.length; i++) {

            var imgURL = $domainURL + 'images/companies/' + ImageNames[i];
            

            html += '<li class="list-group-item" style="margin-bottom:4px;"><img src="'+ imgURL + '" width="150px" height="150px"/> <span><button type="button" class = "btn btn-danger";" href="#" id="DeleteImage" data-imagename="' + ImageNames[i] + '">Xóa</button></span></li>';
        }
        $('#UploadImages ul').append(html);
    }

    function DeleteImage(ImageName) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            url: '../company/deleteImage/' + ImageName,
            // data: {ImageName: ImageName },
            success: function () {

            },
            error: function () {
                alert('error');
            }
        });

    }

    // function RenderInputHiddenImageName(ImageNames) {
    //     var html = '';
    //     for (var i = 0; i < ImageNames.length; i++) {
    //         html += '<input type="hidden" name="ImageNames" value="' + ImageNames[i] + '"></input>'
    //     }
    //     $('#form-create-product').append(html);
    // }



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
  var urlImg = '{{ route('company.updateLogo') }}';
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

         $( ".update-logo-noti" ).fadeIn( 300 ).delay( 2000 ).fadeOut( 00 );
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