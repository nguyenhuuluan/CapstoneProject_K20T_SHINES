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
{{-- @extends('layouts.masterlayout')
@section('content') --}}
<body class="nav-on-header smart-nav">

 <!-- Navigation bar -->
  @include('layouts.header')
<!-- END Navigation bar -->


<!-- Site header -->
<header class="site-header size-lg text-center" style="background-image: url({{ asset('assets/img/bg-banner1.jpg') }} )">
  <div class="container">
    <div class="col-xs-12">
      <br><br>
      <h2>Chúng tôi hiện có <mark>1,259</mark> công việc dành cho bạn!</h2>
      <h5 class="font-alt">Tìm công việc mơ ước của bạn ngay bây giờ</h5>
      <br><br><br>
      <form class="header-job-search">
        <div class="input-keyword">
          <input type="text" class="form-control" placeholder="Tìm công việc hoặc công ty yêu thích">
        </div>

        <div class="input-location">
          <input type="text" class="form-control" placeholder="Thành phố bạn muốn làm việc">

        </div>

        <div class="btn-search">
          <button class="btn btn-primary" type="submit">Tìm</button>
        </div>
      </form>
    </div>
  </div>
</header>
<!-- END Site header -->


<!-- Main container -->
<main>



  <!-- Recent jobs -->
  @yield('recentjobs')
  <!-- <section></section> -->
  <!-- END Recent jobs -->
  <section class="bg-img bg-repeat no-overlay section-sm" style="background-image: url({{ asset('assets/img/bg-pattern.png') }} )">
    <div class="container">

      <div class="row">
        <div class="counter col-md-3 col-sm-6">
          <p><span data-from="0" data-to="6890"></span>+</p>
          <h6>Việc làm</h6>
        </div>

        <div class="counter col-md-3 col-sm-6">
          <p><span data-from="0" data-to="1200"></span>+</p>
          <h6>Ứng viên</h6>
        </div>

        <div class="counter col-md-3 col-sm-6">
          <p><span data-from="0" data-to="36800"></span>+</p>
          <h6>Hồ sơ</h6>
        </div>

        <div class="counter col-md-3 col-sm-6">
          <p><span data-from="0" data-to="15400"></span>+</p>
          <h6>Công ty</h6>
        </div>
      </div>

    </div>
  </section>
  <!-- END Facts -->


  <!-- How it works -->
  <section>
   <div class="container">
    <header class="section-header">
      <h2>Nhà tuyển dụng</h2>
    </header>

    <div class="category-grid">
      <a href="job-list-1.html">
       <img src="assets/img/fpt.jpg" alt="">
       <h6>FPT</h6>
       <span>Hà Nội</span>
     </a>

     <a href="job-list-2.html">
       <img src="assets/img/globalcybersoft.jpg" alt="">
       <h6>Global Cybersoft</h6>
       <span>Hồ Chí Minh</span>
     </a>

     <a href="job-list-3.html">
      <img src="assets/img/logo-google.png" alt="">
      <h6>Facebook</h6>
      <span>Đà Nẵng</span>
    </a>

    <a href="job-list-1.html">
      <img src="assets/img/csc.jpg" alt="">
      <h6>CSC</h6>
      <span>Bình Dương</span>
    </a>

    <a href="job-list-2.html">
      <img src="assets/img/capgemini.jpeg" alt="">
      <h6>Capgemini</h6>
      <span>Đồng Nai</span>
    </a>

    <a href="job-list-3.html">
      <img src="assets/img/kms.png" alt="">
      <h6>KMS</h6>
      <span>Hồ Chí Minh</span>
    </a> 

    <a href="job-list-2.html">
      <img src="assets/img/capgemini.jpeg" alt="">
      <h6>Capgemini</h6>
      <span>Hà Nội</span>
    </a>

    <a href="job-list-2.html">
      <img src="assets/img/logo-google.png" alt="">
      <h6>Capgemini</h6>
      <span>Đà Nẵng</span>
    </a>

  </div>
</div>
</section>
<!-- END How it works -->


<!-- Categories -->
<section class="bg-alt">
 <div class="container">
   <header class="section-header">
    <h3>Tin tức</h3>
  </header>

  <!-- blog -->
  <div class="col-md-4">
    <div class="blog">
      <div class="blog-img">
        <img class="img-responsive" src="assets/img/how-it-works.png" alt="">
      </div>
      <div class="blog-content">
        <ul class="blog-meta">
          <li><i class="fa fa-user"></i>Thanh Huynh</li>
          <li><i class="fa fa-clock-o"></i>18/12/2017</li>
          <li><i class="fa fa-comments"></i>57</li>
        </ul>
        <h3>20 IT Blogger Việt bạn không nên bỏ qua</h3>
        <p>30% Developer đọc blog để tìm câu trả lời khi ăn “bí” – Đó là kết quả mà ITviec đã khảo sát được. Do đó, ITviec đã tổng hợp và cập nhật 20 IT blogger Việt Nam “chất” nhất để giúp bạn</p>
        <a href="blog-single.html">Xem thêm</a>
      </div>
    </div>
  </div>
  <!-- /blog -->

  <!-- blog -->
  <div class="col-md-4">
    <div class="blog">
      <div class="blog-img">
        <img class="img-responsive" src="assets/img/how-it-works.png" alt="">
      </div>
      <div class="blog-content">
        <ul class="blog-meta">
          <li><i class="fa fa-user"></i>Thanh Huynh</li>
          <li><i class="fa fa-clock-o"></i>18/12/2017</li>
          <li><i class="fa fa-comments"></i>57</li>
        </ul>
        <h3>20 IT Blogger Việt bạn không nên bỏ qua</h3>
        <p>30% Developer đọc blog để tìm câu trả lời khi ăn “bí” – Đó là kết quả mà ITviec đã khảo sát được. Do đó, ITviec đã tổng hợp và cập nhật 20 IT blogger Việt Nam “chất” nhất để giúp bạn</p>
        <a href="blog-single.html">Xem thêm</a>
      </div>
    </div>
  </div>
  <!-- /blog -->

  <!-- blog -->
  <div class="col-md-4">
    <div class="blog">
      <div class="blog-img">
        <img class="img-responsive" src="assets/img/how-it-works.png" alt="">
      </div>
      <div class="blog-content">
        <ul class="blog-meta">
          <li><i class="fa fa-user"></i>Thanh Huynh</li>
          <li><i class="fa fa-clock-o"></i>18/12/2017</li>
          <li><i class="fa fa-comments"></i>57</li>
        </ul>
        <h3>20 IT Blogger Việt bạn không nên bỏ qua</h3>
        <p>30% Developer đọc blog để tìm câu trả lời khi ăn “bí” – Đó là kết quả mà ITviec đã khảo sát được. Do đó, ITviec đã tổng hợp và cập nhật 20 IT blogger Việt Nam “chất” nhất để giúp bạn</p>
        <a href="blog-single.html">Xem thêm</a>
      </div>
    </div>
  </div>
  <!-- /blog -->
</section>
<!-- END Categories -->

<!-- START TESTIMONIAL -->
@include('layouts.testimonial')
<!-- END TESTIMONIAL -->
</main>
<!-- END Main container -->


<!-- Site footer -->
@include('layouts.footer')

<!-- Facts -->



<!-- Back to top button -->
<a id="scroll-up" href="#"><i class="ti-angle-up"></i></a>
<!-- END Back to top button -->

<!-- Scripts -->
<script src="{{ asset('assets/js/app.min.js') }} "></script>
<script src="{{ asset('assets/js/thejobs.js') }} "></script>
<script src="{{ asset('assets/js/custom.js') }} "></script>
<script type="text/javascript" src="{{ asset('assets/js/alpha.js') }} "></script>

@if(Session::has('resigter-success') || Session::has('email-invalid') || Session::has('email-exist'))

<script type="text/javascript" charset="utf-8">
  $("#id02").modal("show");

  $('.nav-tabs li:first-child').removeClass('active');
  $('.nav-tabs li:last-child').addClass('active');
  modalSignInOut('dangky');


  // $('.nav-tabs li:last-child a').attr("aria-expanded", true);
  //$('.login-block').css( "display", "none");
  

</script>
@endif

<script type="text/javascript">
  $(document).ready(function(){
    $('#testimonials').alpha({
      layout: 'alt',
      delay : 5300
    });
  })
</script>

</body>
</html>
