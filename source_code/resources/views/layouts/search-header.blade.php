
<header class="site-header size-lg text-center" style="background-image: url({{ asset('images/background/background.jpg') }} )">
  <div class="container">
    <div class="col-xs-12">
      <br><br>
      <h2 style="text-shadow: -1px 0 #7f7676, 0 0.5px #7f7676, 0.5px 0 #7f7676, 0 -1px #7f7676;">Chúng tôi hiện có <mark class="total-recruitments">{!!$totalRecruitments!!}</mark> công việc dành cho bạn!</h2>
      <h5 class="font-alt" style="text-shadow: -1px 0 #7f7676, 0 0.5px #7f7676, 0.5px 0 #7f7676, 0 -1px #7f7676;">Tìm công việc mơ ước của bạn ngay bây giờ</h5>
      <br><br><br>
      {{-- {!! Form::open(['method'=>'POST', route('recruitments.search') , 'class'=>'header-job-search' ]) !!} --}}
      
      
      @include('layouts.search-box')

      {{-- </form> --}}
    </div>

  </div>
</header>
