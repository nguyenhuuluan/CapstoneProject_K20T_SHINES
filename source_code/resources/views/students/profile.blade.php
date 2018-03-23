<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Post a job position or create your online resume by TheJobs!">
  <meta name="keywords" content="">

  <title>Jobee - Chi tiết hồ sơ</title>

  <!-- Styles -->
  <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/thejobs.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">

  <!-- Fonts -->
  <link href='http://fonts.googleapis.com/css?family=Oswald:100,300,400,500,600,800%7COpen+Sans:300,400,500,600,700,800%7CMontserrat:400,700' rel='stylesheet' type='text/css'>

  <!-- Favicons -->
  <link rel="apple-touch-icon" href="{{ asset('/apple-touch-icon.png') }}">
  <link rel="icon" href="{{ asset('assets/img/favicon.ico') }} ">
</head>

<body class="nav-on-header smart-nav">

  <!-- Navigation bar -->
  @include('layouts.header')
  <!-- END Navigation bar -->


  <!-- Page header -->
  <header class="page-header bg-img" style="background-image: url({{ asset('assets/img/bg-banner1.jpg')}} )">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 header-detail">
          <img class="logo" src="{{ asset($student->photo) }} " alt="">
          <div class="hgroup">
            <h1>{!! $student->name!!}</h1>
            {{-- <h3>Front-end developer</h3> --}}
          </div>
          <hr>
          <ul class="details cols-2">
            <li>
              <i class="fa fa-birthday-cake"></i>
              <span>{!! $student->dateofbirth!!}</span>
            </li>
            <li>
              <i class="fa fa-graduation-cap"></i>
              <span>{!! $student->faculty->name!!}</span>
            </li>
            <li>
              <i class="fa fa-phone"></i>
              <span>{!! $student->phone!!}</span>
            </li>
            <li>
              <i class="fa fa-envelope"></i>
              <a href="#">{!! $student->email!!}</a>
            </li>
          </ul>
            <div class="tag-list">
              <?php
              foreach ($student->tags as $tag) {
                echo '<span>'.$tag->name.'</span>';
              }
              ?>
            </div>
        </div>
      </div>

      <div class="button-group">
        <ul class="social-icons" style="align-items: center;">
          <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
          <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
          <li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
          <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
          <li><a class="instagram" href="#"><i class="fa fa-instagram"></i></a></li>
        </ul>
      </div>
    </div>
  </header>
  <!-- END Page header -->


  <!-- Main container -->
  <main>


    <!-- Education -->
    <section>
      <div class="container">
        <br>
        <p class="lead">{!! $student->description !!}.</p>
        <br>

        
        <header class="section-header">
          <h2>Kinh nghiệm làm việc</h2>
        </header>

        <div class="row">

          <!-- Work item -->
          @foreach ($exps as $exp)
            <div class="col-xs-12">
            <div class="item-block">
              <header>
                <div class="hgroup">
                  <h4>{!! $exp->title !!}</h4>
                  <h5>{!! $exp->role !!}</h5>
                </div>
                <h6 class="time">{!! $exp->from !!} --- {!! $exp->to !!}</h6>
              </header>
            </div>
          </div>
          @endforeach
          <!-- END Work item -->
        </div>



      </div>
    </section>
    <!-- END Education -->


    <!-- Work Experience -->
    <section class="bg-alt">
      <div class="container">
        <header class="section-header">
          <h2>Kĩ năng</h2>
        </header>
  
        <br>
        <ul class="skills cols-3">
          @foreach ($skills as $skill)
            <li>
            <div>
              <span class="skill-name">{!! $skill->name !!}</span>
              <span class="skill-value">{!! $skill->rating !!}</span>
            </div>
            <div class="progress">
              <div class="progress-bar" style="width: {!!$skill->rating !!}%;"></div>
            </div>
          </li>
          @endforeach
          
        </ul>
      </div>
    </section>
    <!-- END Work Experience -->
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


  <!-- Contact modal -->
  <div class="modal fade" id="modal-contact" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title" id="myModalLabel">Send message</h5>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="subject" class="control-label">Subject</label>
              <input type="text" class="form-control" id="subject">
            </div>
            <div class="form-group">
              <label for="message-text" class="control-label">Message</label>
              <textarea class="form-control" id="message-text"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-gray" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Send</button>
        </div>
      </div>
    </div>
  </div>


  <!-- Scripts -->
  <script src="{{ asset('assets/js/app.min.js') }} "></script>
  <script src="{{ asset('assets/js/thejobs.js') }} "></script>
  <script src="{{ asset('assets/js/custom.js') }} "></script>

</body>
</html>
