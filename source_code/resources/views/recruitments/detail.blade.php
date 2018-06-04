@extends('layouts.master-layout', ['title' => 'Jobee - '.$recruitment->title,'isDisplaySearchHeader' => false])


@section('stylesheet')
<style type="text/css">
.social-iconss {
	background-color: #ef4d42; 
	color: #ffffff;
	font-size:16px;
	display:inline-block;
	line-height:44px;
	width:44px;
	height:44px;
	text-align:center;
	margin-right:8px;
	border-radius:100%;
	transition:all .2s linear;
}
/* Tooltip container */
.tooltipsave {
	position: relative;
	display: inline-block;
	border-bottom: 1px dotted black; /* If you want dots under the hoverable text */
}

/* Tooltip text */
.tooltipsave .tooltiptext {
	visibility: hidden;
	width: 90px;
	background: transparent;
	color: black;
	text-align: center;
	border-radius: 6px;
	right: 105%; 

	/* Position the tooltip text - see examples below! */
	position: absolute;
	z-index: 1;
}

/* Show the tooltip text when you mouse over the tooltip container */
.tooltipsave:hover .tooltiptext {
	visibility: visible;
}

#save-recruitment {
	position: fixed;
	display: inline-block;
	bottom: 72px;
	right: 30px;
	z-index: 99;
	width: 40px;
	height: 40px;
	line-height: 40px;
	font-size: 22px;
	text-align: center;
	border: none;
	outline: none;
	background-color: #ef4d42; 
	color: #ffffff;
	margin-right: 0px;

	border-radius: 4px;
	opacity: 0.5;
}
#save-recruitment:hover {
	background-color: red;
	opacity: 1;
}
@media (max-width:991px) {
	#save-recruitment {
		right:15px;
		bottom:39px;
		width:34px;
		height:34px;
		line-height:34px;
		font-size:18px;
	}
}
</style>
<script>	(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.12&appId=415131908928137&autoLogAppEvents=1';
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
@endsection
@section('meta-data')

<meta property="og:title" content="{!!$recruitment->title!!}" />
<meta property="og:type" content="article" />
<meta property="og:url" content="{!!$currentURL!!}" />
<meta property="og:image" content="{!! asset($recruitment->company->logo) !!}" />
<meta property="og:description" content="{!! substr(strip_tags($recruitment->sections[0]->pivot->content), 0, 150) !!}" />
<meta property="og:site_name" content="tyendungvanlang.tech" />

@endsection

@section('page-header')

<header class="page-header bg-img size-lg" style="background-image: url({{ asset('assets/img/bg-banner2.jpg') }} )">
	<div class="container">
		<div class="header-detail">
			<a href="{!! route('company.details', $recruitment->company->slug) !!}"><img class="logo" height="60" src={!! asset($recruitment->company->logo) !!} alt=""></a>
			<div class="hgroup">
				<h1>{!! $recruitment->title !!}</h1>
			</div>
			<time>{!! $recruitment->getCreatedAtAtrribute() !!}</time>
			<ul class="details cols-3"  style="text-align: center">
				<li>
					<h3><a href="{!! route('company.details', $recruitment->company->slug) !!}">{!! $recruitment->company->name !!}</a></h3>
				</li>
				<li>
					<i class="fa fa-money"></i>
					<span class="salary">{!! $recruitment->salary !!}</span>
				</li>
				<li>
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
				</li>
			</ul>

			<div class="button-group">
				<ul class="social-icons">
					<li class="title">Chia sẻ</li>					

					{{-- <li class="fb-share-button facebook" data-href="{{$currentURL}}" data-layout="button" data-size="large" data-mobile-iframe="true"><a target="_blank" href={{$currentURL.'&src=sdkpreparse'}} class="fb-xfbml-parse-ignore"><i class="fa fa-facebook"></i></a></li> --}}



				</ul>

				<div class="fb-share-button" data-href="{{$currentURL}}" data-layout="button_count" data-size="large" data-mobile-iframe="true"><a target="_blank" href={{$currentURL.'&src=sdkpreparse'}} class="fb-xfbml-parse-ignore">Share</a>
				</div>

				{{-- <iframe src={{'https://www.facebook.com/plugins/share_button.php?href='.$currentURL.'&layout=button_count&size=small&mobile_iframe=true&appId=415131908928137&width=69&height=20'}} width="69" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
				--}}



				<div class="action-buttons">
					<a class="btn btn-success-detail" href="{{ route('student.apply.recruitment', $recruitment->slug) }}">Ứng tuyển ngay</a>
				</div>

			</div>

		</div>
	</div>
</header>
@endsection


@section('content')


<main class="container blog-page">
	
	<div class="row">
		<div class="col-md-8 col-lg-9">
			<div class="widget widget_tag_cloud" style="margin-bottom: 0px;">
				<div class="widget-body">
					@foreach ($recruitment->tags as $tag)
					<a href="{{ route('recruitments.search', 'searchtext='.$tag->name) }}">{!! $tag->name !!}</a>
					@endforeach
				</div>
			</div>
			<article class="post">
				<div class="blog-content">
					<!--START ARTICLES Job Description -->
					@foreach ($recruitment->sections as $section)
					@if($section->title =='Job Description')
					<p class="lead">{!! $section->pivot->content!!}</p>
					@else

					<div class="job_reason_to_join_us" style="background-color: white; box-sizing: border-box; color: #333333; font-family: Roboto, sans-serif; font-size: 16px;">
						<h2 class="title" style="box-sizing: border-box; color: #353535; font-family: &quot;Roboto Condensed&quot;, sans-serif; font-size: 27px; font-weight: 400; line-height: 35.2px; margin: 20px 0px;">
							{!! $section->title !!}
						</h2>
						{!! $section->pivot->content !!}
					</div>
					@endif
					@endforeach
					<!--END ARTICLES -->

				</div>

			</article>

		</div>



		<div class="col-md-4 col-lg-3">
			<br><br>
			<div class="widget">
				<h6 class="widget-title">Tin liên quan</h6>
				<ul class="widget-body media-list">
					@foreach ($recruitment2 as $recruitment)
					<li>
						<div class="thumb"><a href="{!! route('detailrecruitment', $recruitment->slug ) !!}"><img src="{!! asset($recruitment->company->logo)  !!}" alt="..."></a></div>
						<div class="content">
							<h5><a href="{!! route('detailrecruitment', $recruitment->slug ) !!}" title="{{ $recruitment->title }}">{{ $recruitment->header }}</a></h5>
							<time datetime="2018-04-14 20:00">{{ $recruitment->getCreatedAtAtrribute() }}</time>
						</div>
					</li>
					@endforeach
				</ul>
			</div>

{{-- 			<div class="widget widget_tag_cloud">
				<h6 class="widget-title">Tags</h6>
				<div class="widget-body">
					@foreach ($recruitment->tags as $tag)
					<a href="{{ route('recruitments.search', 'searchtext='.$tag->name) }}">{!! $tag->name !!}</a>
					@endforeach
					<a href="#">Blog</a>
					<a href="#">New</a>
					<a href="#">Google</a>
					<a href="#">Position</a>
					<a href="#">Facebook</a>
					<a href="#">Hire</a>
					<a href="#">Chance</a>
					<a href="#">TopNew</a>
					<a href="#">Tips</a>
				</div>
			</div> --}}

		</div>
	</div>


	<a class="social-iconss tooltipsave" id="save-recruitment" href="#"><i class="fa fa-heart"><span style="font-weight: bold; font-size: 14px;" class="tooltiptext">Lưu việc làm</span></i></a>
</main>

@endsection

@section('scripts')


<script type="text/javascript">
	
	$('#save-recruitment').on('click', (function(e){
		e.preventDefault();
		var url = "{{ route('student.save.recruitment', $recruitment->slug) }}";

		$.ajax({
			type:'GET',
			url: url,
			cache:false,
			contentType: false,
			processData: false,
			success:function(response){
				if(response=='success')
				{
					alert('Lưu tin tuyển dụng thành công!');
				}
				else
				{
					alert('Bạn đã lưu tin tuyển dụng này!');
				}
			},
			error: function(response){
				console.log(response)
				
			}
		});

	}));

</script>
@endsection