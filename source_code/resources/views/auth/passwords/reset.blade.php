<!DOCTYPE html>
<html lang="en">
<head>
  <title>Jobee - Page Errors</title>

  @yield('meta-data')
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <meta name="keywords" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">


  <!-- Styles -->
  <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/thejobs.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
  <script src="https://www.google.com/recaptcha/api.js?render=6LdY8lwUAAAAAGprXsePTCCasbYtCqLuiueeOhsO"></script>


  <!-- Fonts -->
  <link href='http://fonts.googleapis.com/css?family=Oswald:100,300,400,500,600,800%7COpen+Sans:300,400,500,600,700,800%7CMontserrat:400,700' rel='stylesheet' type='text/css'>

  <!-- Favicons -->
  <link rel="apple-touch-icon" href="{{ asset('/apple-touch-icon.png') }}">
  <link rel="icon" href="{{ asset('assets/img/favicon.ico') }} ">
  
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-116938224-1"></script>

  <script>  
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){ (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m) })(window,document,'script','//www.google-analytics.com/analytics.js','ga'); 
    ga('create', 'UA-116938224-1', 'auto'); 
    ga('require', 'linkid', 'linkid.js');
    ga('require', 'displayfeatures'); 
    ga('send', 'pageview');  
  </script>
  @yield('stylesheet')


</head>

<body class="nav-on-header smart-nav">
  <div id="fb-root"></div>

  @include('layouts.header')
  <header class="page-header">
    <div class="container page-name">
     <h1 class="text-center">Quên mật khẩu</h1>
   </div>
 </header>

 <!-- Main container -->
 <main>
  <section>
   <div class="container">
    <div class="row">
      {!! Form::open(['method' => 'POST', 'route' => 'send.forgot.password', 'class' => 'form-horizontal']) !!}
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
      <br>
      <label for="account" class="col-md-2 control-label">Nhập Email:</label>
      <div class="col-md-6">
        <input id="account" type="text" class="form-control" name="account" value="{{old('email')}}" placeholder="Email"  autofocus>  
        <br>
      </div>
      <div class="col-md-2">
        <button class="col-md- btn btn-primary btn-block" type="submit">Tìm kiếm</button>
      </div>
      <input id="g-recaptcha-response" type="hidden" name="g-recaptcha-response">
      {!! Form::close() !!}
    </div>
    @include('includes.errors')
  </div>
</section>
</main>
<br>
<br>
<br>
<!-- END Main container -->
@include('layouts.footer')


<!-- Scripts -->
<script src="{{ asset('assets/js/app.min.js') }}"></script>
<script src="{{ asset('assets/js/thejobs.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script>
  grecaptcha.ready(function() {
    grecaptcha.execute('6LdY8lwUAAAAAGprXsePTCCasbYtCqLuiueeOhsO', {action: 'post'}).then(function(token) {
     $('#g-recaptcha-response').val(token);
   });
  });
</script>



</body>
</html>
