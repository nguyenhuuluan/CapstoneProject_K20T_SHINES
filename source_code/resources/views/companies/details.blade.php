@extends('layouts2.master-layout',['title' => 'Thông tin công ty', 'isDisplaySearchHeader' => false])

@section('stylesheet')

<link href="{{asset('assets/css/jquery.bxslider.css')}}" rel="stylesheet">

@endsection

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
          <li><a class="facebook" href="{{$socials[0]->url}}"  target="_blank"><i class="fa fa-facebook"></i></a></li>
          @endif  

          @if ($socials[1]->name === 'Facebook')
          <li><a class="facebook" href="{{$socials[0]->url}}"  target="_blank"><i class="fa fa-facebook"></i></a></li>
          @endif  

          @if($socials[0]->name === 'LinkedIn')
          <li><a class="linkedin" href="{{$socials[0]->url}}" target="_blank"><i class="fa fa-linkedin"></i></a></li>
          @endif

          @if($socials[1]->name === 'LinkedIn')
          <li><a class="linkedin" href="{{$socials[0]->url}}"  target="_blank"><i class="fa fa-linkedin"></i></a></li>
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

<div class="widget_tag_cloud" style="margin-left: 10%;">
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
  <center>
    <div class="bxslider">

      @foreach ($company->photos()->pluck('name')->toArray() as $photoname)
      <div><img src="{{ asset('images/companies/'.$photoname) }}"></div>
      @endforeach

    </div>
  </center>
</section>
<!-- END Company detail -->


<!-- Open positions -->
<section id="open-positions" class="bg-alt">
  <div class="container">
    <header class="section-header">
      <h2>Vị trí đang tuyển</h2>
    </header>

    <div class="row">

      @if (count($recruitments) == 0)
      <div class="col-xs-12">
        <center>Chưa có tin tuyển dụng nào</center>
      </div>
      @endif

      @foreach ($recruitments as $recruitment)
      <!-- Job item -->

      <a class="item-block" href="{{ route('detailrecruitment', $recruitment->slug ) }}">
        <header>
          <img src="{{ asset($recruitment->company->logo) }}" alt="">
          <div class="hgroup">
            <h4>{{ $recruitment->title }}</h4>
            <h5>{{$company->name}} 
              @foreach ($recruitment->categories as $category)
              @if($category->name =='FULL-TIME')
              <span class="label label-success">{{ $category->name }}</span>
              @else
              <span class="label label-danger">{{ $category->name }}</span>
              @endif
              @endforeach
            </h5>
          </div>
          <time datetime="">{!! $recruitment->created_at->diffForhumans() !!}</time>
        </header>

        <div class="item-body truncate">

          @foreach ($recruitment->sections as $section)
          @if($section->title =='Job Description')
          <p class="lead">{!! $section->pivot->content!!}</p>
          @else
          <span>{!! $section->pivot->content !!}</span>
          @break

          @endif
          @endforeach

        </div>

        <footer>
          <ul class="details cols-3">
            <li>
              <i class="fa fa-map-marker"></i>
              <span class="location">{{ $recruitment->company->address->district->city->name }}</span>
            </li>

            <li>
              <i class="fa fa-money"></i>
              <span class="salary">{{ $recruitment->salary}}</span>
            </li>

            <li>
              <i class="fa fa-tag"></i>
              <span>{{implode(", ",$recruitment->tags()->pluck('name')->toArray())}} </span>


            </li>
          </ul>
        </footer>
      </a>

    </div>

    @endforeach

    <!-- END Job item -->


  </div>

</div>
</section>
<!-- END Open positions -->
<header class="section-header-map">
  <center><h2>Vị trí</h2></center>

  <center"><strong><span>{{$company->address->address}}, {{$company->address->district->name}}, {{ $company->address->district->city->name}}</span></strong></center>
  <br>
</header>

<center><div id="contact-map" style="height: 400px; width: 90%;"></div></center> 
<br>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('assets/js/jquery.bxslider.js') }}"></script>


<script>
  $('.temp-header').hide();

  $('.bxslider').bxSlider({
    mode: 'fade',
    captions: true,
    slideWidth: 380
  });


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