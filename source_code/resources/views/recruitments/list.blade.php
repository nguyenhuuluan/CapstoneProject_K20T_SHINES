@extends('layouts.master-layout',['title' => 'Cập nhật thông tin công ty', 'isDisplaySearchHeader' => false])

@section('page-header')
<header class="page-header bg-img" style="background-image: url({{ asset('assets/img/bg-banner1.jpg') }} );">
  <div class="container page-name" style="padding-bottom: 100px">
    <form class="header-job-search" >
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
</header>
@endsection

@section('content')
<main>
  <section class="no-padding-top bg-alt">
    <div class="container">
      <div class="row">

        <div class="searchcontent col-xs-12">
          <br>
          <h5>Chúng tôi đã tìm thấy <strong>357</strong> việc làm cho <strong>@Tìm kiếm</strong> </h5>
        </div>
        
        <div class="recruitments endless-pagination" data-next-page="{{ $recruitments->nextPageUrl() }}">

          @foreach ($recruitments as $recruitment)
          <!-- Job item -->
          <div class="col-xs-12">
            <a class="item-block" href="{!! route('detailrecruitment', $recruitment->slug) !!}">
              <header>
                <img src={!! asset(App\Recruitment::findOrFail($recruitment->id)->company->logo)  !!} alt="">
                <div class="hgroup">
                  <h4>{!! $recruitment->title !!}</h4>
                {{-- <h5>{!! $recruitment->company !!} <span class="label label-success">Full-time</span>
                </h5> --}}
                @foreach (App\Recruitment::findOrFail($recruitment->id)->categories as $category)
                @if($category->name =='FULL-TIME')
                <span class="label label-success">{!! $category->name !!}</span>
                @else
                <span class="label label-danger">{!! $category->name !!}</span>
                @endif
                @endforeach
              </div>
              <time>{!! Carbon\Carbon::parse($recruitment->created_at)->diffForHumans() !!}</time>
            </header>

            <div class="item-body">
              <p>{!! substr($recruitment->content, 0, 150) .'...' !!}</p>
            </div>

            <footer>
              <ul class="details cols-3">
                <li>
                  <i class="fa fa-map-marker"></i>
                  <span>{!! $recruitment->district .', '. $recruitment->city !!}</span>
                </li>
                <li>
                  <i class="fa fa-money"></i>
                  <span class="salary">{!! $recruitment->salary !!}</span>
                </li>
                <li>
                  <i class="fa fa-tag"></i>
                  @foreach (App\Recruitment::findOrFail($recruitment->id)->tags as $tag)
                  <span>{!! $tag->name !!}</span>
                  @endforeach
                </li>
              </ul>
            </footer>
          </a>
        </div>
        <!-- END Job item -->
        @endforeach
      </div>
      
      <div class="loading" style="text-align: center;">
<<<<<<< HEAD
        <img src="{{ asset('assets/img/loading.gif') }}" style="width: 85px; height: 85px">
=======
        <img src="{{ asset('assets/img/bx_loader.gif') }}" style="width: 85px; height: 85px">
>>>>>>> Luan-UpdateStudentProfile
      </div>
    </div>

  </div>
</section>
</main>
<!-- END Main container -->
@endsection

@section('scripts')
<script type="text/javascript">
  $(document).ready(function(){

    $('.loading').hide();
    $(window).scroll(fetchPost);


    function fetchPost()
    {
      var page = $('.endless-pagination').data('next-page');
      if (page!==null)
      {
        $('.loading').show();
        clearTimeout($.data(this, 'scrollCheck'));
        $.data(this,'scrollCheck', setTimeout(function(){

          var scroll_position_for_recruitments_load = $(window).height() + $(window).scrollTop() +50;

          if(scroll_position_for_recruitments_load>=$(document).height())
          {
            $.get(page, function(data){
              $('.recruitments').append(data.recruitments);
              $('.endless-pagination').data('next-page', data.next_page);
            })
            $('.loading').hide();
          }

        },450))
      }else
      {
            $('.loading').hide();
      }
    }

  })
</script>
@endsection