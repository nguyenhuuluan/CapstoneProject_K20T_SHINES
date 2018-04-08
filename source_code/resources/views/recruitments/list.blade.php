@extends('layouts.master-layout',['title' => 'Danh sách tin tuyển dụng', 'isDisplaySearchHeader' => false])
@section('stylesheet')
<link href="{{ asset('assets/css/bootstrap-tagsinput.css') }}" rel="stylesheet">
@endsection
@section('page-header')
<header class="page-header bg-img" style="background-image: url({{ asset('assets/img/bg-banner1.jpg') }} );">
  <div class="container page-name" style="padding-bottom: 100px">

    @include('layouts.search-box')
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
          <h5>Chúng tôi đã tìm thấy <strong>{!! $total !!}</strong> việc làm cho <strong>Bạn</strong> </h5>
        </div>
        
        <div class="recruitments endless-pagination" data-next-page="{{ $recruitments->nextPageUrl() }}" id="itemrecruitment">

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
              <?php \Carbon\Carbon::setLocale('vi')?>
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
                  <span class="btn btn-info btn-xs">{!! $tag->name !!}</span>
                  @endforeach
                </li>
              </ul>
            </footer>
          </a>
        </div>
        <!-- END Job item -->
        @endforeach
      </div>
      
{{--       <div class="loading" style="text-align: center;" id="loading">
        <img src="{{ asset('assets/img/bx_loader.gif') }}" style="width: 85px; height: 85px">

      </div> --}}
    </div>

  </div>
</section>
</main>
<!-- END Main container -->
@endsection

@section('scripts')
<script type="text/javascript">
  var showlist;

  // var element = document.getElementById("itemrecruitment");
  // var numberOfChildren = element.children.length;
  $(document).ready(function(){
    //$('.loading').hide();
    $(window).scroll(function(){
      clearTimeout(showlist);
      showlist = setTimeout(fetchPost,50)
    });


    function fetchPost()
    {

     var page = $('.endless-pagination').data('next-page');
    // alert(page=='' ? true:false);
     // alert(page);
     if (page!==null && page!=='')
     {

      //$('.loading').show();
      var scroll_position_for_recruitments_load = $(window).height() + $(window).scrollTop()+372;
      var documentHeight = $(document).height();
      //var scrolTop = $(window).scrollTop();
     // alert(document.getElementById("loading").clientHeight);
     //372
     //alert(document.getElementById("testtt").clientHeight);
     //211 
      //console.log(scroll_position_for_recruitments_load+'||'+documentHeight);

      if(scroll_position_for_recruitments_load > documentHeight-400 )
      {
        $.get(page, function(data){
          $('.recruitments').append(data.recruitments);
          $('.endless-pagination').data('next-page', data.next_page);
        })
        //window.scrollTo(0,scroll_position_for_recruitments_load+372);
        // window.scrollTo(0,0);
        //$('.loading').hide();
      }
    }else{
      //$('.loading').hide();
    }
  }

})
</script>
@endsection