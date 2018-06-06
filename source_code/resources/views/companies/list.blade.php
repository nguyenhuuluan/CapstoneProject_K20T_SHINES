@extends('layouts.master-layout',['title' => 'Tuyển dụng Văn Lang - Danh sách Công ty', 'isDisplaySearchHeader' => false])

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
<!-- Page header -->
<header class="page-header bg-img size-lg" style="background-image: url({{ asset('assets/img/bg-banner1.jpg') }} )">
	<div class="container page-name" style="padding-bottom: 100px">
		@include('layouts.search-box')
	</div>
</header>
<!-- END Page header -->
@endsection

@section('content')
<main>
	<section class="bg-alt-company">
		<div class="container">

			<div class="searchcontentcompany col-xs-12" >
				<br>
				<h5>Chúng tôi đã tìm thấy <strong>{!! $total !!}</strong> công ty cho <strong>@Tìm kiếm</strong> </h5>
			</div>

			<div class="category-grid-company endless-pagination" data-next-page="{{ $companies->nextPageUrl() }}">
				@foreach ($companies as $company)
				<a href="{!! route('company.details', $company->slug) !!}" title="{!! $company->address->address.', '.$company->address->district->name.', '.$company->address->district->city->name !!}">
					<img src="{!! asset($company->logo) !!}" style="height: 150px" alt="">
					<h6>{!! $company->name !!}</h6>
					<span>{!! $company->address->district->name.' - '.$company->address->district->city->name !!}</span>
				</a>
				@endforeach
			</div>
			<div class="loading-dots hidden" id="loading-dots">
				<h1 class="dot one">.</h1><h1 class="dot two">.</h1><h1 class="dot three">.</h1>
			</div>
		</div>
	</section>

</main>
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
	var showlist;
	var is_busy = false;

	$(window).scroll(function(){
		$element = $('#bg-alt-company');
      // ELement hiển thị chữ loadding
      $loadding = $('#loading-dots');
      // Nếu màn hình đang ở dưới cuối thẻ thì thực hiện ajax
      if (($(window).scrollTop()+$(window).height()) >= ($element.height()+$(window).height())) {
        // Nếu đang gửi ajax thì ngưng
        if (is_busy == true) {
        	return false;
        }
          // Thiết lập đang gửi ajax
          is_busy = true;
          var page = $('.endless-pagination').data('next-page');
          if (page!==null && page!==''){
          	$loadding.removeClass('hidden');

          	$.ajax(
          	{
          		type: 'get',
          		dataType: 'text',
          		url: page,
          		success: function (data) {
          			$('.category-grid-company').append(JSON.parse(data)["companies"]);
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
