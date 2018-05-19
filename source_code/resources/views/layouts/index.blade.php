@extends('layouts.master-layout',['title' => 'Jobee - Trang chủ', 'isDisplaySearchHeader' => true])
@section('stylesheet')
<link href="{{ asset('assets/css/bootstrap-tagsinput.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/alpha.css') }}" rel="stylesheet">
  <style type="text/css">
  .badge1 {
    position:relative;
  }
  .badge1[data-badge]:after {
    content:attr(data-badge);
    position:absolute;
    top:-10px;
    right:-10px;
    font-size:.7em;
    background:red;
    color:white;
    width:18px;height:18px;
    text-align:center;
    line-height:18px;
    border-radius:50%;
    box-shadow:0 0 1px #333;
  }
    </style>

@endsection

@section('content')
<main>

  <!-- Recent jobs -->
  @yield('recentjobs')
  <!-- <section></section> -->
  <!-- END Recent jobs -->

  <section class="bg-img bg-repeat no-overlay section-sm" style="background-image: url({!! asset('assets/img/bg-pattern.png') !!} ")">
    <div class="container">

      <div class="row">
        <div class="counter col-md-3 col-sm-6">
          <p><span data-from="0" data-to="{{$totalRecruitments}}"></span>+</p>
          <h6>Việc làm</h6>
        </div>

        <div class="counter col-md-3 col-sm-6">
          <p><span data-from="0" data-to="{{$totalStudents}}"></span>+</p>
          <h6>Ứng viên</h6>
        </div>

        <div class="counter col-md-3 col-sm-6">
          <p><span data-from="0" data-to="{{$totalCVs}}"></span>+</p>
          <h6>Hồ sơ</h6>
        </div>

        <div class="counter col-md-3 col-sm-6">
          <p><span data-from="0" data-to="{{$totalCompanies}}"></span>+</p>
          <h6>Công ty</h6>
        </div>
      </div>

    </div>
  </section>
  <!-- END Facts -->

  @yield('topcompany')
  

  @yield('blogs')


<!-- START TESTIMONIAL -->
<!-- END TESTIMONIAL -->

</main>

@endsection


