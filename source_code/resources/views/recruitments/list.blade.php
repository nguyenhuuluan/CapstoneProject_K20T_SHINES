@extends('layouts.master-layout',['title' => 'Danh sách tin tuyển dụng', 'isDisplaySearchHeader' => false])
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
<meta name="csrf-token" content="{{ csrf_token() }}">
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
  <section class="no-padding-top bg-alt" id="itemrecruitment">
    <div class="container">
      <div class="row">

        <div class="searchcontent col-xs-12">
          <br>
          <h5>Chúng tôi đã tìm thấy <strong>{!! $total !!}</strong> việc làm cho <strong>Bạn</strong> </h5>
        </div>
        
        <div class="recruitments endless-pagination" data-next-page="{{ $recruitments->nextPageUrl() }}" >

          @foreach ($recruitments as $recruitment)
          <!-- Job item -->
          <div class="col-xs-12">
            <a class="item-block" href="{!! route('detailrecruitment', $recruitment->slug) !!}" title="{{ $recruitment->title }}">
              <header>
                <img src={!! asset($recruitment->company->logo)  !!} alt="">
                <div class="hgroup">
                  <h4>{!! $recruitment->header !!}</h4>

                @foreach ($recruitment->categories as $category)
               
                @if ($category->id == 1)
                <span class="label label-success">{!! $category->name !!}</span>
                @endif
                @if ($category->id == 2)
                <span class="label label-danger">{!! $category->name !!}</span>
                @endif
                @if ($category->id == 3)
                <span class="label label-warning">{!! $category->name !!}</span>
                @endif
                @endforeach
              </div>
              <time>{!!$recruitment->getCreatedAtAtrribute()!!}</time>
            </header>
            {{-- {!!$recruitment->sections[0]->pivot->content !!} --}}
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
      
{{--       <div class="loading" style="text-align: center;" id="loading">
        <img src="{{ asset('assets/img/bx_loader.gif') }}" style="width: 85px; height: 85px">

      </div> --}}
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
            var url = page;
            var token = $('meta[name="csrf-token"]').attr('content');
            console.log(url);
            // var url = window.location.href+'?page='+page.split('page=')[1];
            $loadding.removeClass('hidden');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax(
            {
              data: { '_token': token},
              type: 'get',
              dataType: 'text',
              url: url,
              beforeSend: function (xhr) {
                  var token = $('meta[name="csrf_token"]').attr('content');
                  if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                  }
              },
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

    </script>
    @endsection