 <nav class="navbar">
   <div class="container">
      <!-- Logo -->
      <div class="pull-left">
         <a class="navbar-toggle" href="#" data-toggle="offcanvas"><i class="ti-menu"></i></a>
         <div class="logo-wrapper">
            <a class="logo" href="{{ route('home') }}"><img src="{{ asset('assets/img/logo.png') }} " alt="logo">
            </a>
            <a class="logo-alt" href="{{ route('home') }}"><img src="{{ asset('assets/img/logo-alt.png') }} " alt="logo-alt">
            </a>
         </div>
      </div>
      <!-- END Logo -->
      <!-- User account -->
      <div class="pull-right">
         <div class="dropdown user-account">
            <a class="user-account-text">{!! Auth::user()->representative->name !!}</a>
            <a class="dropdown-toggle" href="#" data-toggle="dropdown">
               <img src="{{ asset('assets/img/logo-envato.png') }} " alt="avatar">
            </a>
            <ul class="dropdown-menu dropdown-menu-right">
               <li>
                  <a href="mn-account-company.html"><i class="fa fa-user" aria-hidden="true"></i> Tài khoản</a>
               </li>
               <li>
                  <a href="mn-dashboard-company.html"><i class="fa fa-tachometer" aria-hidden="true"></i> Bảng điều khiển</a>
               </li>
               <li>
                  <a href="mn-information-company.html"><i class="fa fa-building-o" aria-hidden="true"></i> Công ty của bạn</a>
               </li>
               <li>
                  <a href="{{ route('recruitments.index') }}"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Việc làm đã đăng</a>
               </li>
               <li>
                  <a href="mn-application-list-company.html"><i class="fa fa-users" aria-hidden="true"></i> Danh sách ứng tuyển</a>
               </li>
               <li><a href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out" aria-hidden="true"></i>Đăng xuất</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                   {{ csrf_field() }}
                </form>
             </li>

          </ul>
       </div>
    </div>
    <!-- END User account -->
    <!-- Navigation menu -->
    <ul class="nav-menu">
      <li>
         <a class="active" href="#">Trang chủ</a>
      </li>
      <li>
         <a href="#">Công ty</a>
      </li>
      <li>
         <a href="#">Việc làm</a>
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