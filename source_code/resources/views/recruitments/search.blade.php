@extends('layouts.master-layout',['title' => 'Tìm kiếm tin tuyển dụng', 'isDisplaySearchHeader' => false])
@section('stylesheet')
<link href="{{ asset('assets/css/bootstrap-tagsinput.css') }}" rel="stylesheet">
<style type="text/css">
.loading-dots {
  text-align: center;
  margin-top: 3em;
  z-index: 5;
}
.loading-dots .dot {
  display: inline;
  margin-left: 0.2em;
  margin-right: 0.2em;
  position: relative;
  top: -1em;
  font-size: 3.5em;
  opacity: 0;
  -webkit-animation: showHideDot 2.5s ease-in-out infinite;
  animation: showHideDot 2.5s ease-in-out infinite;
}
.loading-dots .dot.one {
  -webkit-animation-delay: 0.2s;
  animation-delay: 0.2s;
}
.loading-dots .dot.two {
  -webkit-animation-delay: 0.4s;
  animation-delay: 0.4s;
}
.loading-dots .dot.three {
  -webkit-animation-delay: 0.6s;
  animation-delay: 0.6s;
}

@-webkit-keyframes showHideDot {
  0% {
    opacity: 0;
  }
  50% {
    opacity: 1;
  }
  60% {
    opacity: 1;
  }
  100% {
    opacity: 0;
  }
}

@keyframes showHideDot {
  0% {
    opacity: 0;
  }
  50% {
    opacity: 1;
  }
  60% {
    opacity: 1;
  }
  100% {
    opacity: 0;
  }
}
</style>
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
      <div class="row" id="itemrecruitment">

        <div class="searchcontent col-xs-12">
          <br>
          <h5>Chúng tôi đã tìm thấy <strong>{!! $total !!}</strong> việc làm cho <strong style="color: red">{!! strtoupper($_GET['searchtext'])!!}</strong> </h5>
        </div>
        
        <div class="recruitments endless-pagination" data-next-page="{{ $recruitments->nextPageUrl() }}" id="itemSearch">

          @foreach ($recruitments as $recruitment)
          <!-- Job item -->
          <div class="col-xs-12">
            <a class="item-block" href="{!! route('detailrecruitment', $recruitment->slug) !!}">
              <header>
                <img src={!! asset($recruitment->company->logo)  !!} alt="">
                <div class="hgroup">
                  <h4>{!! $recruitment->title !!}</h4>
                {{-- <h5>{!! $recruitment->company !!} <span class="label label-success">Full-time</span>
                </h5> --}}
                @foreach ($recruitment->categories as $category)
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
                  <span>{!! $recruitment->location !!}</span>
                </li>
                <li>
                  <i class="fa fa-money"></i>
                  <span class="salary">{!! $recruitment->salary !!}</span>
                </li>
                <li>
                  <i class="fa fa-tag"></i>
                  @foreach ($recruitment->tags as $tag)
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
    </div>

    <div class="loading-dots hidden" id="loading-dots">
      <h1 class="dot one">.</h1><h1 class="dot two">.</h1><h1 class="dot three">.</h1>
    </div>

  </div>
</section>
</main>
<!-- END Main container -->
@endsection

@section('scripts')
<script src="{{ asset('assets/vendor/bootstrap-tagsinput/bootstrap3-typeahead.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
<script> 
    $('.tagsinput-typeahead').tagsinput({
        typeahead: {
            source: $.get('{{ route('tags') }}'),
            afterSelect: function() {
                this.$element[0].value = '';    
            },
        },
        trimValue: true,
        freeInput: true,
        tagClass: 'label label-default',
    })
</script>
<script type="text/javascript">


  var is_busy = false;
    $(window).scroll(function(){
      $element = $('#itemrecruitment');
      // ELement hiển thị chữ loadding
      $loadding = $('#loading-dots');
      // Nếu màn hình đang ở dưới cuối thẻ thì thực hiện ajax
      if ($(window).scrollTop() + $(window).height() >= $element.height()) {
        // Nếu đang gửi ajax thì ngưng
        if (is_busy == true) {
          return false;
        }
          // Thiết lập đang gửi ajax
          is_busy = true;


          var page = $('.endless-pagination').data('next-page');

          if (page!==null && page!==''){
          var url = window.location.href+'&page='+page.split('page=')[1];
            $loadding.removeClass('hidden');
            $.ajax(
            {
              type: 'get',
              dataType: 'text',
              url: url,
              success: function (data) {
                $('.recruitments').append(JSON.parse(data)["recruitments"]);
                $('.endless-pagination').data('next-page', JSON.parse(data)["next_page"]);
              }
            })
            .always(function () {
                    // Sau khi thực hiện xong ajax thì ẩn hidden và cho trạng thái gửi ajax = false
                    $loadding.addClass('hidden');
                    is_busy = false;
                  });
            return false;
          }
          return false;

        }
      });



    //$(window).scroll(fetchPost);


    // function fetchPost()
    // {
    //   var page = $('.endless-pagination').data('next-page');
    //   // console.log(page.split('page=')[1]);
    //   // var tmp = window.location.href;
    //   if (page!==null && page.split('page=')[1]!=null)
    //   {
    //     $('.loading').show();
    //     clearTimeout($.data(this, 'scrollCheck'));
    //     $.data(this,'scrollCheck', setTimeout(function(){

    //       var scroll_position_for_recruitments_load = $(window).height() + $(window).scrollTop() +50;

    //       if(scroll_position_for_recruitments_load>=$(document).height())
    //       {
    //       	var url = window.location.href+'&page='+page.split('page=')[1];

    //        $.get(url, function(data){
    //         $('.recruitments').append(data.recruitments);
    //         $('.endless-pagination').data('next-page', data.next_page);
    //       })
    //        $('.loading').hide();
    //      }

    //    },450))
    //   }else
    //   {
    //     $('.loading').hide();
    //   }
    // }
</script>
@endsection