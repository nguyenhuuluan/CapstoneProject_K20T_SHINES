@extends('layouts2.master-layout',['title' => 'Thông tin công ty', 'isDisplaySearchHeader' => false])

@section('sub-header')
<header class="page-header bg-img size-lg" style="background-image: url(assets/img/bg-banner1.jpg)">
    <div class="container">
      <div class="header-detail">
        <img class="logo" src="{{ asset($company->logo) }}" alt="">
        <div class="hgroup">
          <h1>{{$company->name}}</h1>
          <h3>{{$company->field}}</h3>
      </div>
      <hr>

      <ul class="details cols-3">
          <li>
            <i class="fa fa-map-marker"></i>
            <span>{{$company->address->address}}, {{$company->address->district->name}}, {{ $company->address->district->city->name}}</span>
        </li>

        <li>

        </li>

        <li>
            <i class="fa fa-globe"></i>
            <a href="#">{{$company->website}}</a>
        </li>


        <li>
            <i class="fa fa-phone"></i>
            <span>{{$company->phone}}</span>
        </li>

        <li>
            <i class="fa fa-envelope"></i>
            <a href="#">{{$company->email}}</a>
        </li>
        <li>
            <i class="fa fa-calendar"></i>
            <span>{{$company->working_day}}</span>
        </li>
    </ul>

    <div class="button-group">
      <ul class="social-icons">

        @if ($socials[0]->name === 'Facebook')
        <li><a class="facebook" href="{{$socials[0]->url}}"><i class="fa fa-facebook"></i></a></li>
        @endif  

        @if ($socials[1]->name === 'Facebook')
        <li><a class="facebook" href="{{$socials[0]->url}}"><i class="fa fa-facebook"></i></a></li>
        @endif  

        @if($socials[0]->name === 'LinkedIn')
        <li><a class="facebook" href="{{$socials[0]->url}}"><i class="fa fa-linkedin"></i></a></li>
        @endif

        @if($socials[1]->name === 'LinkedIn')
        <li><a class="facebook" href="{{$socials[0]->url}}"><i class="fa fa-linkedin"></i></a></li>
        @endif      

    </ul>

    <div class="action-buttons">
        <a class="btn btn-success" href="#">Liên hệ</a>
    </div>
</div>

</div>

</div>
</header>
<br>
<br>

<div class="widget widget_tag_cloud" style="margin-left: 10%;">
    <div class="widget-body">


     @foreach ($company->tags()->get() as $tag)
     <a href="#">{{$tag->name}}</a>
     @endforeach
 </div>
</div>

@endsection


@section('content')
<section>
  <div class="container">
    <br>
    <br>
    <header class="section-header">
      <h2>Giới thiệu</h2>
  </header>

  <p>{{$company->introduce}}</p>

</div>
</section>
<!-- END Company detail -->


<!-- Open positions -->
<section id="open-positions" class="bg-alt">
  <div class="container">
    <header class="section-header">
      <h2>Vị trí đang tuyển</h2>
  </header>

  <div class="row">

      <!-- Job item -->
      <div class="col-xs-12">
        <a class="item-block" href="job-detail.html">
          <header>
            <img src="assets/img/logo-google.jpg" alt="">
            <div class="hgroup">
              <h4>Senior front-end developer</h4>
              <h5>Google <span class="label label-danger">Full-time</span></h5>
          </div>
          <time datetime="2016-03-10 20:00">32 phút trước</time>
      </header>

      <div class="item-body">
        <p>Tham gia phát triển các dự án trên nền tảng C# của khách hàng, tham gia vào tất cả các giai đoạn của 1 dự án như: lập kế hoạch, phân tích, thiết kế, thực thi, kiểm thử, và triển khai cũng như bảo trì.</p>
    </div>

    <footer>
        <ul class="details cols-3">
          <li>
            <i class="fa fa-map-marker"></i>
            <span>Hồ Chí Minh</span>
        </li>

        <li>
            <i class="fa fa-money"></i>
            <span class="salary">$90,000 - $110,000 / năm</span>
        </li>

        <li>
            <i class="fa fa-tag"></i>
            <span>Master or Bachelor</span>
        </li>
    </ul>
</footer>
</a>
</div>
<!-- END Job item -->
<!-- Job item -->
<div class="col-xs-12">
    <a class="item-block" href="job-detail.html">
      <header>
        <img src="assets/img/logo-google.jpg" alt="">
        <div class="hgroup">
          <h4>Senior front-end developer</h4>
          <h5>Google <span class="label label-danger">Full-time</span></h5>
      </div>
      <time datetime="2016-03-10 20:00">34 phút trước</time>
  </header>

  <div class="item-body">
    <p>Tham gia phát triển các dự án trên nền tảng C# của khách hàng, tham gia vào tất cả các giai đoạn của 1 dự án như: lập kế hoạch, phân tích, thiết kế, thực thi, kiểm thử, và triển khai cũng như bảo trì.</p>
</div>

<footer>
    <ul class="details cols-3">
      <li>
        <i class="fa fa-map-marker"></i>
        <span>Hồ Chí Minh</span>
    </li>

    <li>
        <i class="fa fa-money"></i>
        <span class="salary">$90,000 - $110,000 / năm</span>
    </li>

    <li>
        <i class="fa fa-tag"></i>
        <span>HTML, CSS, JavaScript</span>
    </li>
</ul>
</footer>
</a>
</div>
<!-- END Job item -->
<!-- Job item -->
<div class="col-xs-12">
    <a class="item-block" href="job-detail.html">
      <header>
        <img src="assets/img/logo-google.jpg" alt="">
        <div class="hgroup">
          <h4>Senior front-end developer</h4>
          <h5>Google <span class="label label-success">Full-time</span></h5>
      </div>
      <time datetime="2016-03-10 20:00">32 phút trước</time>
  </header>

  <div class="item-body">
    <p>Tham gia phát triển các dự án trên nền tảng C# của khách hàng, tham gia vào tất cả các giai đoạn của 1 dự án như: lập kế hoạch, phân tích, thiết kế, thực thi, kiểm thử, và triển khai cũng như bảo trì.</p>
</div>

<footer>
    <ul class="details cols-3">
      <li>
        <i class="fa fa-map-marker"></i>
        <span>Hồ Chí Minh</span>
    </li>

    <li>
        <i class="fa fa-money"></i>
        <span class="salary">$90,000 - $110,000 / năm</span>
    </li>

    <li>
        <i class="fa fa-tag"></i>
        <span>HTML, CSS, JavaScript</span>
    </li>
</ul>
</footer>
</a>
</div>
<!-- END Job item -->
<!-- Job item -->
<div class="col-xs-12">
    <a class="item-block" href="job-detail.html">
      <header>
        <img src="assets/img/logo-google.jpg" alt="">
        <div class="hgroup">
          <h4>Senior front-end developer</h4>
          <h5>Google <span class="label label-success">Full-time</span></h5>
      </div>
      <time datetime="2016-03-10 20:00">34 phút trước</time>
  </header>

  <div class="item-body">
    <p>Tham gia phát triển các dự án trên nền tảng C# của khách hàng, tham gia vào tất cả các giai đoạn của 1 dự án như: lập kế hoạch, phân tích, thiết kế, thực thi, kiểm thử, và triển khai cũng như bảo trì.</p>
</div>

<footer>
    <ul class="details cols-3">
      <li>
        <i class="fa fa-map-marker"></i>
        <span>Hồ Chí Minh</span>
    </li>

    <li>
        <i class="fa fa-money"></i>
        <span class="salary">$90,000 - $110,000 / năm</span>
    </li>

    <li>
        <i class="fa fa-tag"></i>
        <span>HTML, CSS, JavaScript</span>
    </li>
</ul>
</footer>
</a>
</div>
<!-- END Job item -->
<!-- Job item -->
<div class="col-xs-12">
    <a class="item-block" href="job-detail.html">
      <header>
        <img src="assets/img/logo-google.jpg" alt="">
        <div class="hgroup">
          <h4>Senior front-end developer</h4>
          <h5>Google <span class="label label-success">Full-time</span></h5>
      </div>
      <time datetime="2016-03-10 20:00">34 phút trước</time>
  </header>

  <div class="item-body">
    <p>Tham gia phát triển các dự án trên nền tảng C# của khách hàng, tham gia vào tất cả các giai đoạn của 1 dự án như: lập kế hoạch, phân tích, thiết kế, thực thi, kiểm thử, và triển khai cũng như bảo trì.</p>
</div>

<footer>
    <ul class="details cols-3">
      <li>
        <i class="fa fa-map-marker"></i>
        <span>Hồ Chí Minh</span>
    </li>

    <li>
        <i class="fa fa-money"></i>
        <span class="salary">$90,000 - $110,000 / năm</span>
    </li>

    <li>
        <i class="fa fa-tag"></i>
        <span>HTML, CSS, JavaScript</span>
    </li>
</ul>
</footer>
</a>
</div>
<!-- END Job item -->


</div>

</div>
</section>
<!-- END Open positions -->
<header class="section-header-map">
  <center><h2>Vị trí</h2></center>
  <center><strong><span>{{$company->address->address}}, {{$company->address->district->name}}, {{ $company->address->district->city->name}}</span></strong></center>
  <br>
</header>

<div id="contact-map" style="height: 400px"></div>
@endsection

@section('scripts')

<script>
    $('.temp-header').hide();

</script>


<script>

var lat = {{$company->address->latitude}};
var lng= {{$company->address->longtitude}};


  function initMap() {
    var uluru = {lat: lat, lng: lng};
    var map = new google.maps.Map(document.getElementById('contact-map'), {
        zoom: 15,
        center: uluru
    });
    var marker = new google.maps.Marker({
      position: uluru,
      map: map
  });
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?callback=initMap&key=AIzaSyBTKdxpxRWTD9UnpMVrGfdnNCmFZLde8Rw" async defer></script>


@endsection