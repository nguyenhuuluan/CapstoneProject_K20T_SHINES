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
 <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
 <link href="{{ asset('assets/css/alpha.css') }}" rel="stylesheet">

 <!-- Fonts -->
 <link href='http://fonts.googleapis.com/css?family=Oswald:100,300,400,500,600,800%7COpen+Sans:300,400,500,600,700,800%7CMontserrat:400,700' rel='stylesheet' type='text/css'>

 <!-- Favicons -->
 <link rel="apple-touch-icon" href="{{ asset('/apple-touch-icon.png') }}">
 <link rel="icon" href="{{ asset('assets/img/favicon.ico') }} ">

</head>
<body class="nav-on-header smart-nav">
 <!-- Navigation bar -->

 <!-- END Navigation bar -->
 <!-- Page header -->
 <header class="page-header">
  <div class="container page-name">
   <h1 class="text-center">Quên mật khẩu</h1>
</div>
</header>
<!-- END Page header -->

<!-- Main container -->
<main>
  <section>
   <div class="container">
    <div class="row">

{{--            <div class="form-group col-md-12 col-xs-12 col-sm-12">
              <h3 class="text-center">Quên mật khẩu</h3>
              <br>
          </div> --}}

          {!! Form::open(['method' => 'POST', 'route' => 'send.forgot.password', 'class' => 'form-horizontal']) !!}

          {{-- <div class="form-group ol-md-3 col-xs-3 col-sm-3">

          </div> --}}

          {{-- <div class="form-group ol-md-3 col-xs-3 col-sm-3"> --}}

          {{-- </div> --}}
{{--   <div class="form-group col-md-5 col-xs-5 col-sm-5">

</div> --}}



@if(Session::has('email-not-found-error'))

    <div class="alert alert-danger">         
        <span>{!! session('email-not-found-error') !!}</span>
    </div>
    @endif

    @if(Session::has('send-email-success'))

    <div class="alert alert-success">         
        <span>{!! session('send-email-success') !!}</span>
    </div>
    @endif


    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <br>

<label for="email" class="col-md-2 control-label">Nhập Email:</label>

<div class="col-md-6">
    

    <input id="email" type="text" class="form-control" name="email" value="{{old('email')}}" placeholder="Email"  autofocus>  

    <br>



</div>
<div class="col-md-2">
    <button class="col-md- btn btn-primary btn-block" type="submit">Tìm kiếm</button>
</div>



{!! Form::close() !!}

</div>
</div>
</section>


</main>
<br>
<br>
<br>
<br>

<footer class="site-footer">
  <!-- Bottom section -->
  <div class="container">
   <div class="row">
    <div class="col-md-8 col-sm-6 col-xs-12">
     <p class="copyright-text">Copyrights &copy; 2017 All Rights Reserved by <a href="#">Shines Team</a>.</p>
 </div>
</div>
</div>

<!-- END Bottom section -->
</footer>
<a id="scroll-up" href="#"><i class="ti-angle-up"></i></a>


<script src="{{ asset('assets/js/app.min.js') }} "></script>
<script src="{{ asset('assets/js/thejobs.js') }} "></script>
<script src="{{ asset('assets/js/custom.js') }} "></script>

</body>
</html>