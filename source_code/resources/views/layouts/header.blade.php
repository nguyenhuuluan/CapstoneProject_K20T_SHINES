<nav class="navbar">
  <div class="container">

    <!-- Logo -->
    <div class="pull-left">
      <a class="navbar-toggle" href="#" data-toggle="offcanvas"><i class="ti-menu"></i></a>

      <div class="logo-wrapper">
        <a class="logo" href="index.html"><img src="/assets/img/logo.png" alt="logo"></a>
        <a class="logo-alt" href="index.html"><img src="/assets/img/logo-alt.png" alt="logo-alt"></a>
      </div>

    </div>
    <!-- END Logo -->

    <!-- User account -->
    <div class="pull-right user-login">
      @guest
      <a class="btn btn-sm btn-primary" href="{{ route('register') }}">Đăng kí</a> | <a href="{{ route('login') }}">Đăng nhập</a>
      @else
      {{-- <a class="btn btn-sm btn-primary" href="{{ route('home') }}">Home</a> --}}

      <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {!! Auth::user()->username !!}<span class="caret"></span>
                                </a>
    
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
      @endguest

    </div>
    <!-- END User account -->

    <!-- Navigation menu -->
    <ul class="nav-menu">
      <li>
        <a class="active" href="{{ route('home') }}">Trang chủ</a>
      </li>
      <li>
        <a href="company-list.html">Công ty</a>
      </li>
      <li>
        <a href="job-list-1.html">Việc làm</a>
      </li>
      <li>
        <a href="#">Blog</a>
      </li>
      <li>
        <a href="#">Giới thiệu</a>
      </li>
    </ul>
    <!-- END Navigation menu -->

  </div>
</nav>

