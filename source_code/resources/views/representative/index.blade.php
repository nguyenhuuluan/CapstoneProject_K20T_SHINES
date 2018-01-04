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
   <link href="{{ asset('assets/css/app.min.css') }} " rel="stylesheet">
   <link href="{{ asset('assets/vendors/summernote/summernote.css') }} " rel="stylesheet">
   <link href="{{ asset('assets/css/thejobs.css') }} " rel="stylesheet">
   <link href="{{ asset('assets/css/custom.css') }} " rel="stylesheet">
   <link href="{{ asset('assets/css/bootstrap-tagsinput.css') }} " rel="stylesheet">
   <!-- Fonts -->
   <link href='http://fonts.googleapis.com/css?family=Oswald:100,300,400,500,600,800%7COpen+Sans:300,400,500,600,700,800%7CMontserrat:400,700' rel='stylesheet' type='text/css'>
   <!-- Favicons -->
   <link rel="apple-touch-icon" href="{{ asset('/apple-touch-icon.png') }}">
   <link rel="icon" href="{{ asset('assets/img/favicon.ico') }} ">
</head>
<body class="nav-on-header smart-nav">
   <!-- Navigation bar -->
   <nav class="navbar">
      <div class="container">
         <!-- Logo -->
         <div class="pull-left">
            <a class="navbar-toggle" href="#" data-toggle="offcanvas"><i class="ti-menu"></i></a>
            <div class="logo-wrapper">
               <a class="logo" href="index.html"><img src="{{ asset('assets/img/logo.png') }} " alt="logo">
               </a>
               <a class="logo-alt" href="index.html"><img src="{{ asset('assets/img/logo-alt.png') }} " alt="logo-alt">
               </a>
            </div>
         </div>
         <!-- END Logo -->
         <!-- User account -->
         <div class="pull-right">
            <div class="dropdown user-account">
               <a class="user-account-text">Thành Huỳnh</a>
               <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                  <img src="assets/img/logo-envato.png" alt="avatar">
               </a>
               <ul class="dropdown-menu dropdown-menu-right">
                  <li><a href="user-login.html">Tài khoản</a>
                  </li>
                  <li><a href="user-register.html">Hồ sơ</a>
                  </li>
                  <li><a href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();">Đăng xuất</a>
                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                   </form>
                </li>
             </ul>
          </div>
       </div>
       <!-- END User account -->
       <!-- Navigation menu -->
       <ul class="nav-menu">
         <li>
            <a class="active" href="#">Trang chủ</a>
         </li>
         <li>
            <a href="#">Công ty</a>
         </li>
         <li>
            <a href="#">Việc làm</a>
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
<!-- Page header -->
<header class="page-header">
   <div class="container page-name">
      <h1 class="text-center">Bảng Điều Khiển</h1>
   </div>
</header>
<!-- END Page header -->
<!-- Main container -->
<main>
  <center><h5>"The most important job is recruiting." - Steve Jobs</h5></center>
  <section>
   <div class="container">
      <div class="row">
         <h6>Trang báo cáo công ty</h6>
         <div class="table-responsive">
            <table class="table table-striped table-bordered-company">
               <thead>
                  <tr>
                     <th>Tổng số lượt xem</th>
                     <th>Lượt xem trong 30 ngày</th>
                     <th>Lượt xem trong 7 ngày</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>4500 (0.5 / ngày)</td>
                     <td>300 (1.2 / ngày)</td>
                     <td>50 (0.7 / ngày)</td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
      
   </div>
</section>
</main>
<!-- END Main container -->
<!-- Site footer -->
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
<!-- END Site footer -->
<!-- Back to top button -->
<a id="scroll-up" href="#"><i class="ti-angle-up"></i></a>
<!-- END Back to top button -->
<!-- Scripts -->
<script src="{{ asset('assets/js/app.min.js') }} "></script>
<script src="{{ asset('assets/vendors/summernote/summernote.min.js') }} "></script>
<script src="{{ asset('assets/js/thejobs.js') }} "></script>
<script src="{{ asset('assets/js/custom.js') }} "></script>
<script src="{{ asset('assets/js/bootstrap3-typeahead.js') }} "></script>
<script src="{{ asset('assets/js/cbootstrap-tagsinput.js') }} "></script>
<!-- Gợi ý tag -->
<script>
   var places = [{
     name: "PHP"
  }, {
     name: "JavaScript"
  }, {
     name: "BIM"
  }, {
     name: "HTML"
  }, {
     name: "CSS"
  }];
  
  $('.tagsinput-typeahead').tagsinput({
     typeahead: {
       source: places.map(function(item) {
         return item.name
      }),
       afterSelect: function() {
         this.$element[0].value = '';
      }
   }
})
</script>
</body>
</html>