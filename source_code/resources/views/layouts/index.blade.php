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
    <link href="assets/css/app.min.css" rel="stylesheet">
    <link href="assets/css/thejobs.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
    <link href="assets/css/alpha.css" rel="stylesheet" type="text/css"/>

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Oswald:100,300,400,500,600,800%7COpen+Sans:300,400,500,600,700,800%7CMontserrat:400,700' rel='stylesheet' type='text/css'>

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link rel="icon" href="assets/img/favicon.ico">
  </head>

  <body class="nav-on-header smart-nav">

   <!-- Navigation bar -->
    <nav class="navbar">
      <div class="container">

        <!-- Logo -->
        <div class="pull-left">
          <a class="navbar-toggle" href="#" data-toggle="offcanvas"><i class="ti-menu"></i></a>

          <div class="logo-wrapper">
            <a class="logo" href="index.html"><img src="assets/img/logo.png" alt="logo"></a>
            <a class="logo-alt" href="index.html"><img src="assets/img/logo-alt.png" alt="logo-alt"></a>
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
            <a class="active" href="{{ url('/home') }}">Trang chủ</a>
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


    <!-- Site header -->
    <header class="site-header size-lg text-center" style="background-image: url(assets/img/bg-banner1.jpg)">
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


      <!-- Facts -->
      <section class="bg-img bg-repeat no-overlay section-sm" style="background-image: url(assets/img/bg-pattern.png)">
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
             <img src="assets/img/logo-google.png" alt="">
              <h6>FPT</h6>
             <span>Hà Nội</span>
            </a>

            <a href="job-list-2.html">
             <img src="assets/img/logo-microsoft.jpg" alt="">
              <h6>Global Cybersoft</h6>
              <span>Hồ Chí Minh</span>
            </a>

            <a href="job-list-3.html">
              <img src="assets/img/logo-google.png" alt="">
              <h6>Facebook</h6>
              <span>Đà Nẵng</span>
            </a>

            <a href="job-list-1.html">
              <img src="assets/img/logo-google.png" alt="">
              <h6>CSC</h6>
             <span>Bình Dương</span>
            </a>

            <a href="job-list-2.html">
              <img src="assets/img/logo-google.png" alt="">
              <h6>Capgemini</h6>
             <span>Đồng Nai</span>
            </a>

            <a href="job-list-3.html">
              <img src="assets/img/logo-google.png" alt="">
              <h6>KMS</h6>
              <span>Hồ Chí Minh</span>
            </a> 

             <a href="job-list-2.html">
              <img src="assets/img/logo-envato.png" alt="">
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

          <div class="col-sm-12 col-md-3">
            <header class="section-header-blog text-left">
              <h4>21+ con đường sự nghiệp (career path) cho Developer</h4>
              <img class="center-block hidden-xs hidden-sm" src="assets/img/how-it-works.png" alt="how it works">
            </header>

            <p>Con đường sự nghiệp muôn lối, chọn lối đi nào sẽ giúp bạn nhanh chóng thành công? Đó là câu hỏi lớn cho tất cả mọi người, dù là cậu sinh viên IT sắp ra trường hay anh dev kì cựu.</p>
           
            <a class="btn btn-primary btn-round btn-sm btn-blog-bot" href="page-typography.html">Xem thêm</a>
          </div>

          <div class="col-sm-12 col-md-3">
            <header class="section-header-blog text-left">
              <h4>Làm Game Product Manager là làm gì? P/v Product Manager của FaceDance Challenge</h4>
              <img class="center-block hidden-xs hidden-sm" src="assets/img/how-it-works.png" alt="how it works">
            </header>

            <p>Làm Game Product Manager là làm gì? Có giống hay khác gì với công việc của Product Manager cho các sản phẩm phần mềm khác? Đọc ngay bài phỏng vấn của ITviec với anh Nguyễn Hoàng</p>
            
            <a class="btn btn-primary btn-round btn-sm btn-blog-bot" href="page-typography.html">Xem thêm</a>
          </div>

          <div class="col-sm-12 col-md-3">
            <header class="section-header-blog text-left">
              <h4>21+ con đường sự nghiệp (career path) cho Developer</h4>
              <img class="center-block hidden-xs hidden-sm" src="assets/img/how-it-works.png" alt="how it works">
            </header>

            <p>Con đường sự nghiệp muôn lối, chọn lối đi nào sẽ giúp bạn nhanh chóng thành công? Đó là câu hỏi lớn cho tất cả mọi người, dù là cậu sinh viên IT sắp ra trường hay anh dev kì cựu.</p>
            
            <a class="btn btn-primary btn-round btn-sm btn-blog-bot" href="page-typography.html">Xem thêm</a>
          </div>

          <div class="col-sm-12 col-md-3">
            <header class="section-header-blog text-left">
              <h4>21+ con đường sự nghiệp (career path) cho Developer</h4>
              <img class="center-block hidden-xs hidden-sm" src="assets/img/how-it-works.png" alt="how it works">
            </header>

            <p>Con đường sự nghiệp muôn lối, chọn lối đi nào sẽ giúp bạn nhanh chóng thành công? Đó là câu hỏi lớn cho tất cả mọi người, dù là cậu sinh viên IT sắp ra trường hay anh dev kì cựu.</p>
            
            <a class="btn btn-primary btn-round btn-sm btn-blog-bot" href="page-typography.html">Xem thêm</a>
          </div>
        </div>
      </section>
      <!-- END Categories -->


      <!-- START TESTIMONIAL -->
       <section id="testimonials">

            <div class="testim-ovl"></div>
            <div class="testimonials-wrapper">

             <ul class="testimonials-line">

               <li class="customer">

                   <div class="testimonial-bubble">
                       <p>Li Europan lingues es membres del sam familie. Lor separat existentie es un myth. Por scientie, musica, sport etc,</p>
                   </div>

                   <div class="cus-profile">
                      <span class="cus-image"><img src="assets/img/te1.jpg"></span>
                     <span class="cus-name">
                         Customer
                         <span class="cus-title">His title</span>
                      </span>  
                   </div>
                 
               </li>

               <li class="customer">

                   <div class="testimonial-bubble">
                       <p> Lor separat existentie es un myth. Por scientie, musica, sport etc,</p>
                   </div>

                   <div class="cus-profile">
                      <span class="cus-image"><img src="assets/img/te2.jpg"></span>
                      <span class="cus-name">
                         Customer
                         <span class="cus-title">His title</span>
                      </span>   
                   </div>
                 
               </li>

               <li class="customer">

                   <div class="testimonial-bubble">
                       <p>Li Europan lingues es membres del sam familie. Lor separat existentie es un myth. Por scientie, musica, sport etc,</p>
                   </div>

                   <div class="cus-profile">
                      <span class="cus-image"><img src="assets/img/te3.jpg"></span>
                      <span class="cus-name">
                         Customer
                         <span class="cus-title">His title</span>
                      </span>  
                   </div>
                 
               </li>

               <li class="customer">

                   <div class="testimonial-bubble">
                       <p>Li Europan lingues es membres del sam familie. Lor separat existentie es un myth. </p>
                   </div>

                   <div class="cus-profile">
                      <span class="cus-image"><img src="assets/img/te1.jpg"></span>
                      <span class="cus-name">
                         Customer
                         <span class="cus-title">His title</span>
                      </span>  
                 
               </li>

             <span id="prev"></span>
             <span id="next"></span>   

             </ul><!-- .testimonials-line -->
             </div><!-- .testimonials-wrapper -->
      </section><!-- .testimonials -->  
      <!-- END TESTIMONIAL -->


    </main>
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
    <script src="assets/js/app.min.js"></script>
    <script src="assets/js/thejobs.js"></script>
    <script src="assets/js/custom.js"></script>
    <script type="text/javascript" src="assets/js/alpha.js"></script>
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
