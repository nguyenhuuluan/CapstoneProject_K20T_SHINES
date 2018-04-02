@extends('layouts.master-layout',['title' => 'Jobee - Trang chủ', 'isDisplaySearchHeader' => true])


@section('content')
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

  @yield('topcompany')
  


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
</div>
</section>
<!-- END Categories -->

<!-- START TESTIMONIAL -->
@include('layouts.testimonial')
<!-- END TESTIMONIAL -->

</main>

@endsection

