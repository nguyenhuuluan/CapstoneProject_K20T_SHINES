@extends('layouts.master-layout', ['title' => $blog->title,'isDisplaySearchHeader' => false])

@section('page-header')
<header class="page-header bg-img size-lg overlay-light" style="background-image: url({{ asset('assets/img/O7MF5N0.jpg') }})">
  <div class="container no-shadow">
    <h1 class="text-center">{{ $blog->title }}</h1>
  </div>
</header>
@endsection

@section('content')

<main class="container blog-page">
  <div class="row">
    <div class="col-md-8 col-lg-9">
      <article class="post">
        <p style=" font-style: italic; font-weight: bold;">{{ $blog->description }}</p>
        <br>
        <div class="blog-content" style="text-align: justify;">
          {!! $blog->content !!}
        </div>

        <ul class="post-meta">
          <li>
            <strong>Đăng bởi: </strong>
            <a href="#">{{  $blog->owner->staff->name }}</a>

          </li>
          <li>
            <strong>Ngày đăng: </strong>
            <a><time datetime="2018-01-24 20:00">{{ date('d-m-Y') }}</time></a>
          </li>

          <li>
            <strong>Tags: </strong>
            @foreach ($blog->tags as $tag)
            <a href="{{ route('recruitments.search', 'searchtext='.$tag->name) }}">{!! $tag->name !!}</a>  
            @endforeach
          </li>
        </ul>

        {{-- <div id="comments">
          <header>
            <h3>Comments</h3>
          </header>
          <span><i>Chèn code comment facebook vào đây</i></span>
        </div> --}}

      </article>

    </div>

    <div class="col-md-4 col-lg-3">
      <br><br>
      <div class="widget">
        <h6 class="widget-title">Bài liên quan</h6>
        <ul class="widget-body media-list">
          @foreach ($blogs as $blg)
          <li>
            <div class="thumb"><a href="{{ route('detailblog', $blg->slug) }}" title="{{ $blg->title }}"><img src="{{ asset($blg->photo) }}" alt="..."></a></div>
            <div class="content">
              <h5><a href="{{ route('detailblog', $blg->slug) }}" title="{{ $blg->title }}">{{ $blg->header }}</a></h5>
              <time datetime="2018-04-14 20:00">{{ $blg->getCreatedAtAtrribute() }}</time>
            </div>
          </li>
          @endforeach
        </ul>
      </div>
      <div class="widget widget_tag_cloud">
        <h6 class="widget-title">Tags</h6>
        <div class="widget-body">
          @foreach ($blog->tags as $tag)
          <a href="{{ route('recruitments.search', 'searchtext='.$tag->name) }}">{!! $tag->name !!}</a> 
          @endforeach
        </div>
      </div>

    </div>
  </div>

</main>


@endsection