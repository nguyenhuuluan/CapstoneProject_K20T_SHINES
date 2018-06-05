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
        <a class="item-block" href="{!! route('detailrecruitment', $recruitment->slug ) !!}" title="{{ $recruitment->title }}">
          <header>
            <img src="{!! asset($recruitment->company->logo) !!}" alt="">
            <div class="hgroup">
              <h4>{!! $recruitment->header !!}</h4>
              <h5>{!! $recruitment->company->name !!}</h5>
            </div>
            <div class="header-meta">
              <span class="location">{!! $recruitment->location !!}</span>
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
          </header>
        </a>
      </div>
      <!-- END Job item -->
      @endforeach
    </div>
    <br><br>
    <p class="text-center"><a class="btn btn-info" href="{{ route('lst.recruitment') }}">Xem thêm</a></p>
  </div>
</section>
@endsection
@section('topcompany')
<!-- How it works -->
<section>
 <div class="container">
  <header class="section-header">
    <h2>Nhà tuyển dụng</h2>
  </header>

  <div class="category-grid"> 
    @foreach ($companies as $company)
    <a href="{{ route('company.details', $company->slug ) }}">
     <img src="{{ asset($company->logo) }}" alt="" style="height: 200px">
     <h6>{!! $company->name !!}</h6>
     <span>{!! $company->address->district->city->name !!}</span>
   </a>
   @endforeach
 </div>
</div>
</section>
<!-- END How it works -->
@endsection

@section('blogs')
<!-- Categories -->
<section class="bg-alt">
 <div class="container">
   <header class="section-header">
    <h2>Tin tức</h2>
  </header>

  <!-- blog -->
  
  @foreach ($blogs as $blog)
  <div class="col-md-4">
    <div class="blog">
      <a href="{{ route('detailblog', $blog->slug) }}">
        <div class="blog-img">
          <img class="img-responsive" src="{{ asset($blog->photo) }}" style="height:200px; width: 350px;">
        </div>
      </a>
      <div class="blog-content">
        <ul class="blog-meta">
          <li><i class="fa fa-user"></i>{{ $blog->owner->staff->name }}</li>
          <li><i class="fa fa-clock-o"></i>{{ date_format($blog->created_at,"d-m-Y") }}</li>
          {{-- <li><i class="fa fa-comments"></i>57</li> --}}
        </ul>
        <a href="{{ route('detailblog', $blog->slug) }}" style="text-decoration : none; color : #000;" title="{{ $blog->title }}"><h4>{{ $blog->header }}</h4></a>
        <a href="{{ route('detailblog', $blog->slug) }}">Xem thêm</a>
      </div>
    </div>
  </div>
</a>
@endforeach
</div>
</section>
<!-- END Categories -->

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
  });

</script>

<script type="text/javascript">
  $(document).ready(function(){    
    $(window).keypress(function(event){
      if(event.keyCode == 13) {
        event.preventDefault();
        return false;
      }
    });
  });
</script>

@endsection