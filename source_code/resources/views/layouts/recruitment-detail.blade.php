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
  <link rel="apple-touch-icon" href="../apple-touch-icon.png">
  <link rel="icon" href="../assets/img/favicon.ico">
</head>

<body class="nav-on-header smart-nav">

  <!-- Navigation bar -->
  <nav class="navbar">
    <div class="container">

      <!-- Logo -->
      <div class="pull-left">
        <a class="navbar-toggle" href="#" data-toggle="offcanvas"><i class="ti-menu"></i></a>

        <div class="logo-wrapper">
          <a class="logo" href="index.html"><img src="../assets/img/logo.png" alt="logo"></a>
          <a class="logo-alt" href="index.html"><img src="../assets/img/logo-alt.png" alt="logo-alt"></a>
        </div>

      </div>
      <!-- END Logo -->

      <!-- User account -->
      <div class="pull-right user-login">
        <a class="btn btn-sm btn-primary" href="user-login.html">Đăng kí</a> | <a href="user-register.html">Đăng nhập</a>
      </div>
      <!-- END User account -->

      <!-- Navigation menu -->
      <ul class="nav-menu">
        <li>
          <a class="active" href="index.html">Trang chủ</a>
        </li>
        <li>
          <a href="company-list.html">Công ty</a>
        </li>
        <li>
          <a href="job-list-1.html">Việc làm</a>
        </li>
        <li>
          <a href="#">Blog</a>
        </li>
        <li>
          <a href="#">Giới thiệu</a>
        </li>
      </ul>
      <!-- END Navigation menu -->

    </div>
  </nav>
  <!-- END Navigation bar -->

  @yield('page-header')
  <!-- Page header -->

  <!-- END Page header -->

  @yield('main-container')
  <!-- Main container -->
  
  <!-- END Main container -->


  <!-- Site footer -->
  <footer class="site-footer">

    <!-- Top section -->
    <div class="container">
      <div class="row">

        <div class="col-xs-6 col-sm-6 col-md-3">
          <h6>Trendeing jobs</h6>
          <ul class="footer-links">
            <li><a href="job-list.html">Front-end developer</a></li>
            <li><a href="job-list.html">Android developer</a></li>
            <li><a href="job-list.html">iOS developer</a></li>
            <li><a href="job-list.html">Full stack developer</a></li>
            <li><a href="job-list.html">Project administrator</a></li>
          </ul>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-3">
          <h6>Company</h6>
          <ul class="footer-links">
            <li><a href="page-about.html">About us</a></li>
            <li><a href="page-typography.html">How it works</a></li>
            <li><a href="page-faq.html">Help center</a></li>
            <li><a href="page-typography.html">Privacy policy</a></li>
            <li><a href="page-contact.html">Contact us</a></li>
          </ul>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-3">
          <h6>Company</h6>
          <ul class="footer-links">
            <li><a href="page-about.html">About us</a></li>
            <li><a href="page-typography.html">How it works</a></li>
            <li><a href="page-faq.html">Help center</a></li>
            <li><a href="page-typography.html">Privacy policy</a></li>
            <li><a href="page-contact.html">Contact us</a></li>
          </ul>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-3">
          <h6>Trending jobs</h6>
          <ul class="footer-links">
            <li><a href="job-list.html">Front-end developer</a></li>
            <li><a href="job-list.html">Android developer</a></li>
            <li><a href="job-list.html">iOS developer</a></li>
            <li><a href="job-list.html">Full stack developer</a></li>
            <li><a href="job-list.html">Project administrator</a></li>
          </ul>
        </div>
      </div>

      <hr>
    </div>
    <!-- END Top section -->

    <!-- Bottom section -->
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-sm-6 col-xs-12">
          <p class="copyright-text">Copyrights &copy; 2017 All Rights Reserved by <a href="#">Shines Team</a>.</p>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
          <ul class="social-icons">
            <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
            <li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
            <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
            <li><a class="instagram" href="#"><i class="fa fa-instagram"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
    <!-- END Bottom section -->

  </footer>
  <!-- END Site footer -->


  <!-- Back to top button -->
  <a id="scroll-up" href="#"><i class="ti-angle-up"></i></a>
  <!-- END Back to top button -->

  <!-- Scripts -->
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/js/thejobs.js"></script>
  <script src="../assets/js/custom.js"></script>

</body>
</html>
