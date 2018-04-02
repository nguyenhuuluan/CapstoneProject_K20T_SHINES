<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Post a job position or create your online resume by TheJobs!">
  <meta name="keywords" content="">

  <title>{{$title}}</title>

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
  @yield('stylesheet')
</head>
{{-- @extends('layouts.masterlayout')
@section('content') --}}

<body class="nav-on-header smart-nav">

 <!-- Navigation bar -->
 @include('layouts.header')
 <!-- END Navigation bar -->

@if ($isDisplaySearchHeader)
 @include('layouts.search-header')
@else

@yield('page-header')
{{-- <header class="page-header"></header> --}}
@endif


 <!-- Main container -->


  @yield('content')

  
<!-- END Main container -->


<!-- Site footer -->
@include('layouts.footer')



<!-- Scripts -->
<script type="text/javascript" src="{{ asset('assets/js/app.min.js') }} "></script>
<script type="text/javascript" src="{{ asset('assets/js/thejobs.js') }} "></script>
<script type="text/javascript" src="{{ asset('assets/js/custom.js') }} "></script>
<script type="text/javascript" src="{{ asset('assets/js/alpha.js') }} "></script>

<script type="text/javascript">
  
    $('#testimonials').alpha({
      layout: 'alt',
      delay : 5300
    });
  
</script>

@yield('scripts')

</body>
</html>
