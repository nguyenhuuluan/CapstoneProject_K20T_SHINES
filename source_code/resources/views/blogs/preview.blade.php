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
  <!-- Fonts -->
  <link href='http://fonts.googleapis.com/css?family=Oswald:100,300,400,500,600,800%7COpen+Sans:300,400,500,600,700,800%7CMontserrat:400,700' rel='stylesheet' type='text/css'>
  <!-- Favicons -->
  <link rel="apple-touch-icon" href="{{ asset('/apple-touch-icon.png') }}">
  <link rel="icon" href="{{ asset('assets/img/favicon.ico') }}">
</head>

<body class="nav-on-header smart-nav preview">

  <!-- Navigation bar -->
  <nav class="navbar">
    <div class="container">
      <!-- Logo -->
      <div class="pull-left">
        <a class="navbar-toggle" href="#" data-toggle="offcanvas"><i class="ti-menu"></i></a>
        <div class="logo-wrapper">
          <a class="logo" href="#"><img src="{{ asset('assets/img/logo.png') }}" alt="logo" style="padding: 5px;"></a>
          <a class="logo-alt" href="#"><img src="{{ asset('assets/img/logo-alt.png') }}" alt="logo-alt"></a>
        </div>
      </div>
      <!-- END Logo -->

      <!-- SignUp/SignIn Candidate-->
      <div id="id02" class="modal fade">
        <form class="modal-content animate" action="#">
          <div class="login-block">
            <img src="{{ asset('assets/img/logo.png') }}" alt="">
            <br><br>
            <ul class="nav nav-tabs">
              <li class="active">
                <a data-toggle="tab" onclick="modalSignInOut('dangnhap')" href="#">Đăng nhập</a>
              </li>
              <li>
                <a data-toggle="tab" onclick="modalSignInOut('dangky')" href="#">Đăng ký</a>
              </li>
            </ul>

            <div id="dangnhap" class="modalinout">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="ti-email"></i></span>
                  <input type="text" class="form-control" placeholder="Email">
                </div>
              </div>
              <hr class="hr-xs">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="ti-unlock"></i></span>
                  <input type="password" class="form-control" placeholder="Mật khẩu">
                </div>
              </div>
              <button class="btn btn-primary btn-block" type="submit">Đăng Nhập</button>
              <div class="login-links">
                <center><a href="forget-password.html">Quên mật khẩu?</a></center>
              </div>
            </div>

            <div id="dangky" class="modalinout" style="display:none">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="ti-email"></i></span>
                  <input name="emailCompany" type="text" class="form-control" placeholder="Email">
                </div>
              </div>
              <button name="registerCandidate" class="btn btn-primary btn-block" type="submit">Đăng Ký</button><br>
            </div>
            
          </div>
        </form>
      </div>

      <!-- End SignUp/SignIn Candidate -->

      <!-- User account -->
      <div id="menu-desktop" class="pull-right user-login">
        <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#id02" href="#">Đăng nhập</a> | <a href="mn-login-register-intermediate-company.html">Nhà tuyển dụng</a>
      </div>
      <!-- END User account -->

      <!-- Navigation menu -->
      <ul class="nav-menu">
        <li>
          <a href="index.html">Trang chủ</a>
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
        <li>
          <div id="menu-mobile" class="user-login" hidden>
            <a style="font-weight:bold; color: red;" data-toggle="modal" data-target="#id02" href="#">Đăng nhập</a>
          </div>
        </li>
        <li>
          <div id="menu-mobile" class="user-login" hidden>
            <a style="font-weight:bold; color: red;" href="mn-login-register-intermediate-company.html">Nhà tuyển dụng</a>
          </div>
        </li>
      </ul>
      <!-- END Navigation menu -->
    </div>
  </nav>
  <!-- END Navigation bar -->


  <!-- Site header -->
  <header class="page-header bg-img size-lg overlay-light" style="background-image: url({{ asset('assets/img/O7MF5N0.jpg') }})">
    <div class="container no-shadow">
      <h1 class="text-center">{!! $data['title'] !!}</h1>
      <p class="lead text-center"><time datetime="2018-01-24 20:00">{{ date('d-m-Y') }}</time></p>
    </div>
  </header>
  <!-- END Site header -->
  <!-- Main container -->
  <main class="container blog-page">
  <div id="watermark">
    <p>Xem trước</p>
  </div>
    <div class="row">
      <div class="col-md-8 col-lg-9">

        <article class="post">

          <div class="blog-content" style="text-align: justify;">
            {!! $data['content'] !!}

          </div>

          <ul class="post-meta">
            <li>
              <strong>Đăng bởi: </strong>
              <a href="#">{!! Auth::user()->staff->name !!}</a>
            </li>

            <li>
              <strong>Tags: </strong>
              @foreach ($tags2 as $tag)
              <a href="#">{!! $tag !!}</a>, 
              @endforeach
            </li>
          </ul>

          <div id="comments">
            <header>
              <h3>Comments</h3>
            </header>
            <span><i>Chèn code comment facebook vào đây</i></span>
          </div>

        </article>

      </div>

      <div class="col-md-4 col-lg-3">

        <br><br>
        <div class="widget">
          <h6 class="widget-title">Bài liên quan</h6>
          <ul class="widget-body media-list">
            <li>
              <div class="thumb"><a href="page-post.html"><img src="{{ asset('assets/img/blog-1-thumb.jpg') }}" alt="..."></a></div>
              <div class="content">
                <h5><a href="page-post.html">Thăng tiến công việc nhờ chính sách luân chuyển nội bộ</a></h5>
                <time datetime="2018-04-14 20:00">14/4/2018</time>
              </div>
            </li>

            <li>
              <div class="thumb"><a href="page-post.html"><img src="{{ asset('assets/img/blog-2-thumb.jpg') }}" alt="..."></a></div>
              <div class="content">
                <h5><a href="page-post.html">Trở thành triệu phú sau 5 năm</a></h5>
                <time datetime="2018-04-14 20:00">14/4/2018</time>
              </div>
            </li>

            <li>
              <div class="thumb"><a href="page-post.html"><img src="{{ asset('assets/img/blog-3-thumb.jpg') }}" alt="..."></a></div>
              <div class="content">
                <h5><a href="page-post.html">Tại sao nên làm việc nhóm?</a></h5>
                <time datetime="2018-04-14 20:00">14/4/2018</time>
              </div>
            </li>
          </ul>
        </div>

        <div class="widget widget_tag_cloud">
            <h6 class="widget-title">Tags</h6>
            <div class="widget-body">
              <a href="#">Blog</a>
              <a href="#">New</a>
              <a href="#">Google</a>
              <a href="#">Position</a>
              <a href="#">Facebook</a>
              <a href="#">Hire</a>
              <a href="#">Chance</a>
              <a href="#">TopNew</a>
              <a href="#">Tips</a>
            </div>
          </div>

      </div>
    </div>

  </main>
  <!-- END Main container -->


  <!-- Site footer -->
  <footer class="site-footer">
    <!-- Top section -->
    <div class="container">
      <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-3">
          <h6>Việc làm theo nghành nghề</h6>
          <ul class="footer-links">
            <li><a href="job-list.html">Việc làm Kế toán</a></li>
            <li><a href="job-list.html">Việc làm Ngân hàng</a></li>
            <li><a href="job-list.html">Việc làm IT - Phần mềm</a></li>
            <li><a href="job-list.html">Việc làm IT-Phần cứng/Mạng</a></li>
            <li><a href="job-list.html">Việc làm Xây dựng</a></li>
          </ul>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-3">
          <ul class="footer-links">
            <br>
            <li><a href="job-list.html">Việc làm Quảng cáo/Khuyến mãi</a></li>
            <li><a href="job-list.html">Việc làm Hàng không/Du lịch</a></li>
            <li><a href="job-list.html">Việc làm Giáo dục/Đào tạo</a></li>
            <li><a href="job-list.html">Việc làm Điện/Điện tử</a></li>
            <li><a href="job-list.html">Việc làm Bán hàng</a></li>
          </ul>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-3">
          <h6>Việc làm IT theo công ty</h6>
          <ul class="footer-links">
            <li><a href="page-about.html">Global CyberSoft</a></li>
            <li><a href="page-typography.html">Vingroup</a></li>
            <li><a href="page-faq.html">Capella Holding</a></li>
            <li><a href="page-typography.html">Vietjetair</a></li>
            <li><a href="page-contact.html">Standard Charter</a></li>
          </ul>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-3">
          <h6>Việc làm IT theo thành phố</h6>
          <ul class="footer-links">
            <li><a href="job-list.html">Hồ Chí Minh</a></li>
            <li><a href="job-list.html">Hà Nội</a></li>
            <li><a href="job-list.html">Đà Nẵng</a></li>
            <li><a href="job-list.html">Thêm</a></li>
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
            <li>
              <p>Liên hệ với VLU Jobs <strong>(08) 123 4568</strong><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></p>
            </li>
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
  <script src="{{ asset('assets/js/app.min.js') }}"></script>
  <script src="{{ asset('assets/js/thejobs.js') }}"></script>
  <script src="{{ asset('assets/js/custom.js') }}"></script>


</body>
</html>
