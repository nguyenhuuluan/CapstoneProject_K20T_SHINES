
<header class="site-header size-lg text-center" style="background-image: url({{ asset('assets/img/bg-banner1.jpg') }} )">
  <div class="container">
    <div class="col-xs-12">
      <br><br>
      <h2>Chúng tôi hiện có <mark class="total-recruitments">...</mark> công việc dành cho bạn!</h2>
      <h5 class="font-alt">Tìm công việc mơ ước của bạn ngay bây giờ</h5>
      <br><br><br>
      {{-- {!! Form::open(['method'=>'POST', route('recruitments.search') , 'class'=>'header-job-search' ]) !!} --}}
      
      
      @include('layouts.search-box')

      {{-- </form> --}}
    </div>

  </div>
</header>
