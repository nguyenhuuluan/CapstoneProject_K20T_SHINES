 @foreach ($recruitments as $recruitment)
 <div class="col-xs-12">
  <a class="item-block" href="{!! route('detailrecruitment', $recruitment->slug) !!}" title="{{ $recruitment->title }}">
    <header>
      <img src="{!! asset($recruitment->company->logo)  !!}" alt="">
      <div class="hgroup">
        <h4>{!! $recruitment->header !!}</h4>
                {{-- <h5>{!! $recruitment->company !!} <span class="label label-success">Full-time</span>
                </h5> --}}
                @foreach ($recruitment->categories as $category)
                {{-- @if($category->name =='FULL-TIME')
                <span class="label label-success">{!! $category->name !!}</span>
                @else
                <span class="label label-danger">{!! $category->name !!}</span>
                @endif --}}
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

            <div class="item-body">
              <p>{!!  $recruitment->section !!}</p>
              {{-- <p>{{  strip_tags(substr($recruitment->sections->where('id',1)->first()->pivot->content, 0, 150) .'...') }}</p> --}}
            </div>

            <footer>
              <ul class="details cols-3">
                <li>
                  <i class="fa fa-map-marker"></i>
                  <span>{!! $recruitment->location!!}</span>
                </li>
                <li>
                  <i class="fa fa-money"></i>
                  <span class="salary">{!! $recruitment->salary !!}</span>
                </li>
                <li>
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