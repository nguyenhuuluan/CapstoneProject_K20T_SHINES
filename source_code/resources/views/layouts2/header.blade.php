
<nav class="navbar">
  <div class="container">
    <!-- Logo -->
    <div class="pull-left">
      <a class="navbar-toggle" href="#" data-toggle="offcanvas"><i class="ti-menu"></i></a>
      <div class="logo-wrapper">
        <a class="logo" href="index.html"><img src="{{ asset('assets/img/logo.png') }}" alt="logo"></a>
        <a class="logo-alt" href="index.html"><img src="{{ asset('assets/img/logo-alt.png') }}" alt="logo-alt"></a>
      </div>
    </div>
    <!-- END Logo -->

    <!-- SignUp/SignIn Candidate-->
    <div id="id02" class="modal fade">
      <form class="modal-content animate" method="POST" action="{{ route('login') }}">
       {{ csrf_field() }}
       <div class="login-block">
        <img src="{{ asset('assets/img/logo.png') }}" alt="">
        <br><br>
        <ul class="nav nav-tabs">
          <li class="active">
            <a data-toggle="tab" onclick="modalSignInOut('dangnhap')" href="#">Đăng nhập</a>
          </li>
          <li>
            <a data-toggle="tab" onclick="modalSignInOut('dangky')" href="#">Đăng ký</a>
          </li>
        </ul>

        <div id="dangnhap" class="modalinout">
          <div class="form-group" form-group{{ $errors->has('email') ? ' has-error' : '' }}> 
           <div class="input-group">
             <span class="input-group-addon"><i class="ti-email"></i></span>
             <input id="email" type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
           </div>
         </div>
         <hr class="hr-xs">
         <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
           <div class="input-group">
             <span class="input-group-addon"><i class="ti-unlock"></i></span>
             <input id="password" type="password" class="form-control" placeholder="Mật khẩu" name="password" required>
           </div>
         </div>

         @if ($errors->has('email'))
         <span class="help-block">
          <strong style="color: red">{{ $errors->first('email') }}</strong>
          <script type="text/javascript">
            document.getElementById('id01').style.display='block'
          </script>
        </span>
        @endif
        @if ($errors->has('password'))
        <span class="help-block">
          <strong style="color: red">{{ $errors->first('password') }}</strong>
          <script type="text/javascript">
            document.getElementById('id01').style.display='block'
          </script>
        </span>
        @endif

        <button name="registerCandidate" class="btn btn-primary btn-block" type="submit">Đăng Nhập</button>
        <div class="login-links">
          <center><a href="forget-password.html">Quên mật khẩu?</a></center>
        </div>
      </div>
    </form>
    <form method="POST" action="{{ route('student.register') }}">
     {{ csrf_field() }}

     <div id="dangky" class="modalinout" style="display:none">

      @if(Session::has('resigter-success'))
      <br>
      <div class="alert alert-success">         
        <span>{!! session('resigter-success') !!}</span>
      </div>
      @elseif(Session::has('email-invalid'))
      <br>
      <div class="alert alert-danger">         
        <span>{!! session('email-invalid') !!}</span>
      </div>
      @elseif(Session::has('email-exist'))
      <br>
      <div class="alert alert-warning">         
        <span>{!! session('email-exist') !!}</span>
      </div>
      @endif

      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon"><i class="ti-email"></i></span>
          <input name="email" type="email" class="form-control" value="{{ old('email') }}" placeholder="jobee@vanlanguni.vn">
        </div>
      </div>

      <button class="btn btn-primary btn-block" type="submit">Đăng Ký</button>
    </form>
  </div>
</div>
</div>


<!-- End SignUp/SignIn Candidate -->

<!-- User account -->
<div class="pull-right user-login">
  @guest


  <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#id02" href="#">Đăng nhập</a> | <a href="{{route('company.partnership')}}">Nhà tuyển dụng</a>
  @else
  {{-- <a class="btn btn-sm btn-primary" href="{{ route('home') }}">Home</a> --}}

  <div class="pull-right">
   <div class="dropdown user-account">
    <a class="user-account-text">
      @if (Auth::user()->isStudent())
      {!! Auth::user()->student->name !!}
      @elseif(Auth::user()->isRepresentative())
      {!! Auth::user()->representative->name !!}
      @endif
    </a>
    <a class="dropdown-toggle" href="#" data-toggle="dropdown">
               <img src="{{ asset('assets/img/logo-envato.png') }} " alt="avatar">
            </a>
    <ul class="dropdown-menu dropdown-menu-right">

      @if(Session::get('representative', true))
      <li>
        <a href="mn-account-company.html"><i class="fa fa-user" aria-hidden="true"></i> Tài khoản</a>
      </li>
      <li>
        <a href="mn-dashboard-company.html"><i class="fa fa-tachometer" aria-hidden="true"></i> Bảng điều khiển</a>
      </li>
      <li>
        <a href="{{ route('company.update',['id' => Auth::user()->representative->company->id]) }}"><i class="fa fa-building-o" aria-hidden="true"></i> Công ty của bạn</a>
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
     @else
     <li><a href="user-login.html">Tài khoản</a>
     </li>
     <li><a href="user-register.html">Hồ sơ</a>
     </li>
     <li><a href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();">Đăng xuất</a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
      </form>
    </li>
     @endif

     
     
  </ul>
</div>
</div>
@endguest        
</div>
<!-- END User account -->

<!-- Navigation menu -->
<ul class="nav-menu">
  <li>
    <a class="active" href="index.html">Trang chủ</a>
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

<script>
  function modalSignInOut(nameinout) {
    var i;
    var x = document.getElementsByClassName("modalinout");
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";  
    }
    document.getElementById(nameinout).style.display = "block";  
  }
</script>

