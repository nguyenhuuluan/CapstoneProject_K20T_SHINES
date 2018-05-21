@extends('layouts.master-layout', ['title' => 'Jobee - Liên hệ','isDisplaySearchHeader' => false])


@section('styles')
<link href='http://fonts.googleapis.com/css?family=Raleway:100,300,400,500,600,800%7COpen+Sans:300,400,500,600,700,800%7CMontserrat:400,700' rel='stylesheet' type='text/css'>

@endsection
@section('page-header')
<header class="page-header bg-img size-lg overlay-light" style="background-image: url({{ asset('assets/img/O7MF5N0.jpg') }})">
  <div class="container no-shadow">
    <h1 class="text-center">Liên hệ với chúng tôi</h1>
    <p class="lead text-center">Bạn có bất cứ thắc mắc gì hãy liên hệ với chúng tôi để có ngay câu trả lời.</p>
  </div>
</header>
@endsection

@section('content')

<main>

  <section>
    <div class="container">        
      <br><br>
      <div class="row">
        <div class="col-sm-12 col-md-8">
         <div id="contact-map" style="height: 400px"></div>
       </div>

       <div class="col-sm-12 col-md-4">
        <h4>Địa chỉ</h4>
        <div class="highlighted-block">
          <dl class="icon-holder">
            <dt><i class="fa fa-map-marker"></i></dt>
            <dd>45 Nguyễn Khắc Nhu, P. Cô Giang, Quận 1, Hồ Chí Minh</dd>

            <dt><i class="fa fa-phone"></i></dt>
            <dd>(+84) 123456789</dd>

            <dt><i class="fa fa-fax"></i></dt>
            <dd>(+84) 1234567890</dd>

            <dt><i class="fa fa-envelope"></i></dt>
            <dd>vieclam@vanlanguni.edu.vn</dd>
          </dl>
        </div>

        <br>

        <ul class="social-icons size-sm text-center">
          <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
          <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
          <li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
          <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
          <li><a class="instagram" href="#"><i class="fa fa-instagram"></i></a></li>
        </ul>

      </div>
    </div>

  </div>
</section>


</main>

@endsection

@section('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTKdxpxRWTD9UnpMVrGfdnNCmFZLde8Rw&callback=initMap" async defer></script>

@endsection