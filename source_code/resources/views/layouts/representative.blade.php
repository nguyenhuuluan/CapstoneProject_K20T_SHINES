<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="description" content="Post a job position or create your online resume by TheJobs!">
   <meta name="keywords" content="">
   <title>Jobee</title>
   <!-- Styles -->
   <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet">   
   <link href="{{asset('assets/css/thejobs.css')}}" rel="stylesheet">
   <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet">
  
    @yield('styles')

   <!-- Fonts -->
   <link href='http://fonts.googleapis.com/css?family=Oswald:100,300,400,500,600,800%7COpen+Sans:300,400,500,600,700,800%7CMontserrat:400,700' rel='stylesheet' type='text/css'>
   <!-- Favicons -->
   <link rel="icon" href="{{ asset('assets/img/favicon.ico') }} ">
</head>
<body class="nav-on-header smart-nav">
   <!-- Navigation bar -->
   @include('layouts.header-representative')
   <!-- END Navigation bar -->
   <!-- Page header -->
   <header class="page-header">
      <div class="container page-name">
         <h1 class="text-center">Danh sách tin tuyển dụng của bạn</h1>
      </div>
   </header>
   <!-- END Page header -->
   <!-- Main container -->
    @yield('body')
<!-- END Main container -->
<!-- Site footer -->
@include('layouts.footer')
<!-- END Site footer -->
<!-- Back to top button -->
<a id="scroll-up" href="#"><i class="ti-angle-up"></i></a>
<!-- END Back to top button -->
<!-- Scripts -->
<script src="{{ asset('assets/js/app.min.js') }}"></script>
<script src="{{ asset('assets/js/thejobs.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
@yield('scripts')

</body>
</html>