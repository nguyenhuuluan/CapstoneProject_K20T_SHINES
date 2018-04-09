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
              <time>{!! Carbon\Carbon::parse($recruitment->created_at)->diffForHumans(); !!}</time>
             
              
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