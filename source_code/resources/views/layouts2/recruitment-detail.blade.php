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
  <link href="../assets/css/app.min.css" rel="stylesheet">
  <link href="../assets/css/thejobs.css" rel="stylesheet">
  <link href="../assets/css/custom.css" rel="stylesheet">

  <!-- Fonts -->
  <link href='http://fonts.googleapis.com/css?family=Oswald:100,300,400,500,600,800%7COpen+Sans:300,400,500,600,700,800%7CMontserrat:400,700' rel='stylesheet' type='text/css'>

  <!-- Favicons -->
  <link rel="apple-touch-icon" href="/apple-touch-icon.png">
  <link rel="icon" href="assets/img/favicon.ico">
</head>
{{-- @extends('layouts.masterlayout')
@section('content') --}}
<body class="nav-on-header smart-nav">

  <!-- Navigation bar -->
  @include('layouts.header')

   <!-- END Navigation bar -->

   @yield('page-header')
   <!-- Page header -->

   <!-- END Page header -->

   @yield('main-container')
   <!-- Main container -->

   <!-- END Main container -->

 <!-- Site footer -->
  @include('layouts.footer')
<!-- END Site footer -->




<!-- Scripts -->
<script src="../assets/js/app.min.js"></script>
<script src="../assets/js/thejobs.js"></script>
<script src="../assets/js/custom.js"></script>

</body>
{{-- @endsection --}}
</html>
