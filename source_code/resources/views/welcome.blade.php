@extends('layouts.index')

@section('recentjobs')
<section>
  <div class="container">
  <header class="section-header">
    <h2>Việc làm mới nhất</h2>
  </header>

  <div class="row item-blocks-connected">
    @foreach ($recruitments as $recruitment)
    <!-- Job item -->
    <div class="col-xs-12">
      <a class="item-block" href="{{ route('detailrecruitment', $recruitment->slug ) }}">
        <header>
          <img src="{{ asset($recruitment->company->logo) }}" alt="">
          <div class="hgroup">
            <h4>{{ $recruitment->title }}</h4>
            <h5>{{ $recruitment->company->name }}</h5>
          </div>
          <div class="header-meta">
            <span class="location">{{ $recruitment->company->address->district->city->name }}</span>
            @foreach ($recruitment->categories as $category)
            @if($category->name =='FULL-TIME')
            <span class="label label-success">{{ $category->name }}</span>
            @else
            <span class="label label-danger">{{ $category->name }}</span>
            @endif
            @endforeach
            {{-- <span class="label label-success">Full-time</span> --}}
          </div>
        </header>
      </a>
    </div>
    <!-- END Job item -->
    @endforeach
    
  </div>

  <br><br>
  <p class="text-center"><a class="btn btn-info" href="">Xem thêm</a></p>
</div>
</section>

@endsection
