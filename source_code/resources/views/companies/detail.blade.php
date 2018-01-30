<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Post a job position or create your online resume by TheJobs!">
  <meta name="keywords" content="">

  <title>Chi tiết công ty</title>

  <!-- Styles -->
  <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/thejobs.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">

  <!-- Fonts -->
  <link href='http://fonts.googleapis.com/css?family=Oswald:100,300,400,500,600,800%7COpen+Sans:300,400,500,600,700,800%7CMontserrat:400,700' rel='stylesheet' type='text/css'>

  <!-- Favicons -->
  <link rel="icon" href="{{ asset('assets/img/favicon.ico') }} ">
</head>
{{-- @extends('layouts.masterlayout')
@section('content') --}}
<body class="nav-on-header smart-nav preview">

  <!-- Navigation bar -->
  @include('layouts.header')

  <!-- END Navigation bar -->

  {{--  @yield('page-header') --}}
  <!-- Page header -->
  <header class="page-header bg-img size-lg" style="background-image: url(assets/img/bg-banner1.jpg)">
    <div class="container">
      <div class="header-detail">
        <img class="logo" src="assets/img/logo-google.png" alt="">
        <div class="hgroup">
          <h1>{!! $comp->name !!}</h1>
          {{-- <h3>Mạng và phần mềm</h3> --}}
        </div>
        <hr>

        <ul class="details cols-3">
          <li>
            <i class="fa fa-map-marker"></i>
            <span>N/A</span>
          </li>

          <li>
            <i class="fa fa-globe"></i>
            <a href="#">{!! $comp->website !!}</a>
          </li>

          <li>
            <i class="fa fa-users"></i>
            <span>N/A</span>
          </li>

          <li>
            <i class="fa fa-birthday-cake"></i>
            <span>N/A</span>
          </li>

          <li>
            <i class="fa fa-phone"></i>
            <span>{!! $comp->phone !!}</span>
          </li>

          <li>
            <i class="fa fa-envelope"></i>
            <a href="#">N/A</a>
          </li>
        </ul>

        <div class="button-group">
          <ul class="social-icons">
            <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
            <li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
            <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
            <li><a class="instagram" href="#"><i class="fa fa-instagram"></i></a></li>
          </ul>

          <div class="action-buttons">
            <a class="btn btn-success" href="#">Liên hệ</a>
          </div>
        </div>

      </div>
    </div>
  </header>
  <!-- END Page header -->

  {{--  @yield('main-container') --}}
  <!-- Main container -->
  
  
<!-- END Main container -->

<!-- Site footer -->
@include('layouts.footer')
<!-- END Site footer -->
<!-- Scripts -->
<script src="{{ asset('assets/js/app.min.js') }}"></script>
<script src="{{ asset('assets/js/thejobs.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>

</body>
{{-- @endsection --}}
</html>
