@extends('layouts.recruitment-detail')

@section('page-header')


<header class="page-header bg-img size-lg" style="background-image: url({{ asset('assets/img/bg-banner2.jpg') }} )">
    <div class="container">
      <div class="header-detail">
        <img class="logo" height="60" src={!! asset($recruitment->company->logo) !!} alt="">
        <div class="hgroup">
          <h1>{!! $recruitment->title !!}</h1>
        </div>
        <time datetime="">{!! $recruitment->created_at->diffForhumans() !!}</time>
        <ul class="details cols-3"  style="text-align: center">
          <li>
            <h3><a href="#">{!! $recruitment->company->name !!}</a></h3>
          </li>
          <li>
            <i class="fa fa-money"></i>
					<span class="salary">{!! $recruitment->salary !!}</span>
          </li>
          <li>
					@foreach ($recruitment->categories as $category)
					@if($category->name == 'FULL-TIME' )
					<span class="label label-success">{!! $category->name !!}</span>
					@else
					<span class="label label-danger">{!! $category->name !!}</span>
					@endif
					@endforeach
          </li>
        </ul>
        
        <div class="button-group">
          <ul class="social-icons">
            <li class="title">Chia sẻ</li>
            <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a class="google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
            <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
            <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
          </ul>

          <div class="action-buttons">
            <a class="btn btn-success-detail" href="job-apply.html">Ứng tuyển ngay</a>
          </div>
        </div>


      </div>
    </div>
  </header>

@endsection


@section('main-container')


<main class="container blog-page">

	<div class="row">
		<div class="col-md-8 col-lg-9">

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


		<div class="widget widget_tag_cloud">
			<div class="widget-body">
				@foreach ($recruitment->tags as $tag)
					{{-- expr --}}
					<a href="#">{!! $tag->name !!}</a>
				@endforeach
			</div>
		</div>

	</div>



	<div class="col-md-4 col-lg-3">

		<div class="widget widget_tag_cloud">
			<h6 class="widget-title">Tags</h6>
			<div class="widget-body">
				<a href="#">blog</a>
				<a href="#">new</a>
				<a href="#">google</a>
				<a href="#">position</a>
				<a href="#">facebook</a>
				<a href="#">hire</a>
				<a href="#">chance</a>
				<a href="#">resume</a>
				<a href="#">tip</a>
			</div>
		</div>

	</div>
</div>



</main>

@endsection