@extends('layouts.master-layout',['title' => 'Jobee - Dashboard', 'isDisplaySearchHeader' => false])
{{-- @extends('layouts.representative') --}}

@section('page-header')
<header class="page-header">
  <div class="container page-name">
   <h1 class="text-center">Thông tin tài khoản</h1>
 </div>
</header>
@endsection

@section('content')
<main>
 <section>
  <div class="container">
 


     {!! Form::open(['method' => 'POST', 'route' => 'representative.update.profile', 'class' => 'form-horizontal']) !!}

      @if(Session::has('update-success'))
      <br>
      <div class="alert alert-success">         
        <span>{!! session('update-success') !!}</span>
      </div>
      @endif


     <div class="form-group col-md-3 col-xs-12 col-sm-3">
       <h6>Đại diện công ty</h6>
     </div>
     <div class="form-group col-md-9 col-xs-12 col-sm-9">
       <input type="text" class="form-control" value="{{$representative->company->name}}" disabled>
     </div>
     <div class="form-group col-md-3 col-xs-12 col-sm-3">
       <h6>Tên đầy đủ</h6>
     </div>

     <div class="form-group col-md-9 col-xs-12 col-sm-9{{ $errors->has('name') ? ' has-error' : 'ERROR' }}">
      {!! Form::text('name', $representative->name, ['class' => 'form-control']) !!}
      <small class="text-danger">{{ $errors->first('name') }}</small>
    </div>  

    <div class="form-group col-md-3 col-xs-12 col-sm-3">
     <h6>Số điện thoại</h6>
   </div>
   <div class="form-group col-md-9 col-xs-12 col-sm-9{{ $errors->has('phone') ? ' has-error' : 'ERROR' }}">
    {!! Form::text('phone', $representative->phone, ['class' => 'form-control']) !!}
    <small class="text-danger">{{ $errors->first('phone') }}</small>
  </div>  
  <div class="form-group col-md-3 col-xs-12 col-sm-3">
   <h6>Chức vụ</h6>
 </div>
 <div class="form-group col-md-9 col-xs-12 col-sm-9{{ $errors->has('position') ? ' has-error' : 'ERROR' }}">
  {!! Form::text('position', $representative->position, ['class' => 'form-control']) !!}
  <small class="text-danger">{{ $errors->first('position') }}</small>
</div> 
<div class="form-group col-md-3 col-xs-12 col-sm-3">
 <h6>Email</h6>
</div>
<div class="form-group col-md-9 col-xs-12 col-sm-9">
 <input type="text" class="form-control" value="{{$representative->email}}" disabled>
</div>


{{-- 
<div class="form-group col-md-3 col-xs-12 col-sm-3" style="margin-top: 50px;">
 <h6>Username</h6>
</div>
<div class="form-group col-md-9 col-xs-12 col-sm-9"  style="margin-top: 50px;">
 <input type="text" class="form-control" value="{{ $representative->account->username }}" disabled="">
</div>


<div class="form-group col-md-3 col-xs-12 col-sm-3">
 <h6>Mật khẩu</h6>
</div>
<div class="form-group col-md-9 col-xs-12 col-sm-9{{ $errors->has('password') ? ' has-error' : 'ERROR' }}">
    <input type="password" class="form-control psw1" name="password" value="{{ old('confirmpassword') }}">
  <small class="text-danger">{{ $errors->first('password') }}</small>
</div>

<div class="form-group col-md-3 col-xs-12 col-sm-3">
 <h6>Nhập lại mật khẩu</h6>
</div>
<div class="form-group col-md-9 col-xs-12 col-sm-9{{ $errors->has('password') ? ' has-error' : 'ERROR' }}">
    <input type="password" class="form-control psw" name="confirmpassword" value="{{ old('confirmpassword') }}">
  <small class="text-danger">{{ $errors->first('password') }}</small>
</div> --}}


</section>

<!-- Submit -->
<div class="container">
  <p class="text-center">
   <button class="btn btn-danger btn-xl btn-round" type="submit">Cập nhật</button>
 </p>
 <br>
</div>
{!! Form::close() !!}
<!-- END Submit -->
</main>
@endsection

@section('scripts')
<script type="text/javascript">
  
  var a = $('.psw1').val();
  console.log(a);

</script>
@endsection