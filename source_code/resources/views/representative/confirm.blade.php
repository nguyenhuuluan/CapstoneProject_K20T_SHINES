<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta name="description" content="Post a job position or create your online resume by TheJobs!">
 <meta name="keywords" content="">
 <title>Jobee</title>
 <!-- Styles -->
 <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet">
 <link href="{{ asset('assets/css/thejobs.css') }}" rel="stylesheet">

 <!-- Fonts -->
 <link href='http://fonts.googleapis.com/css?family=Oswald:100,300,400,500,600,800%7COpen+Sans:300,400,500,600,700,800%7CMontserrat:400,700' rel='stylesheet' type='text/css'>

 <!-- Favicons -->
 <link rel="apple-touch-icon" href="{{ asset('/apple-touch-icon.png') }}">
 <link rel="icon" href="{{ asset('assets/img/favicon.ico') }} ">
</head>
<body class="nav-on-header smart-nav">
 <header class="page-header">
  <div class="container page-name">
   <h1 class="text-center">Cập nhật mật khẩu</h1>
 </div>
</header>
<!-- Main container -->
<main>
  <section>
   <div class="container">
    <div class="row">
     <div class="form-group col-md-12 col-xs-12 col-sm-12">
      <h3 class="text-center">Xin chào <i>{{$acc->username}}</i>, vui lòng cập nhật thông tin của bạn tại đây!</h3>
      <br>
    </div>
  </div>
  {!! Form::open(['method' => 'POST', 'route' => 'representative.reset-password', 'class' => 'form-horizontal']) !!}
  <input type="hidden" name="account_id" value="{{$acc->id}}">
  <div class="row">
    <div class="form-group col-md-3 col-xs-12 col-sm-3">
     <h7>Email</h7>
   </div>
   <div class="form-group col-md-9 col-xs-12 col-sm-9">
     <input type="text" class="form-control" value="{{$acc->username}}" disabled>
   </div>
 </div>
 <div class="row">
  <div class="form-group col-md-3 col-xs-12 col-sm-3">
   <h7>Mật khẩu</h7>
 </div>
 <div class="form-group col-md-9 col-xs-12 col-sm-9 {{ $errors->has('password') ? ' has-error' : '' }}">
  <input type="password" class="form-control" value="{{old('password')}}" name="password" placeholder="ít nhất 10 kí tự">
  <small class="text-danger">{{ $errors->first('confirmpassword') }}</small>
</div>
</div>
<div class="row">
  <div class="form-group col-md-3 col-xs-12 col-sm-3">
   <h7>Nhập lại mật khẩu</h7>
 </div>
 <div class="form-group col-md-9 col-xs-12 col-sm-9{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
   <input type="password" class="form-control" name="password_confirmation" placeholder="ít nhất 10 kí tự">
   <small class="text-danger">{{ $errors->first('password') }}</small>
 </div>
</div>
<div class="row">
  <div class="form-group col-md-12 col-xs-12 col-sm-12">
    <button class="btn btn-primary btn-block" type="submit">Cập nhật</button>
 </div>
</div>


{!! Form::close() !!}
</div>
</div>
</section>


</main>
</body>
</html>