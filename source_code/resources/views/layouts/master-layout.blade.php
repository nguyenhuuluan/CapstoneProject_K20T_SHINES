<!DOCTYPE html>
<html lang="en">
<head>
 <title>{{$title}}</title>

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
 <link href="{{ asset('assets/css/alpha.css') }}" rel="stylesheet">

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
{{-- @extends('layouts.masterlayout')
@section('content') --}}

<body class="nav-on-header smart-nav">
  <div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.12&appId=415131908928137&autoLogAppEvents=1';
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>
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
