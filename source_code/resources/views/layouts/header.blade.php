{{-- <script src="{{ asset('assets/js/app.min.js') }} "></script>
<script type="text/javascript" src="{{ asset('assets/js/alpha.js') }} "></script> --}}
<nav class="navbar">
  <div class="container">
    <!-- Logo -->
    <div class="pull-left">
      <a class="navbar-toggle" href="#" data-toggle="offcanvas"><i class="ti-menu"></i></a>
      <div class="logo-wrapper">

        <a class="logo" href="{{ route('home') }}"><img src="{{ asset('assets/img/logo.png') }}" alt="logo"  style="padding: 5px;"></a>
        <a class="logo-alt" href="{{ route('home') }}"><img src="{{ asset('assets/img/logo-alt.png') }}" alt="logo-alt"></a>

      </div>
    </div>
    <!-- END Logo -->

    <!-- SignUp/SignIn Candidate-->
    <div id="id02" class="modal fade" role="dialog">
      <form class="modal-content animate" method="POST" action="{{ route('login') }}">
       {{ csrf_field() }}
       <div class="login-block">
        <img style="max-width: 80%;" src="{{ asset('assets/img/logo.png') }}" alt="">
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
        </span>
        @endif

        @if(Session::has('comment_message'))  
        <strong style="color: red">{{ session('comment_message') }}</strong>
        @endif

        @if ($errors->has('password'))
        <span class="help-block">
          <strong style="color: red">{{ $errors->first('password') }}</strong>
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
          <input name="email" type="email" class="form-control" value="{{ old('email') }}" placeholder="Email: jobee@vanlanguni.vn">
        </div>
      </div>

      <button name="registerCandidate" class="btn btn-primary btn-block" type="submit">Đăng Ký</button>
    </form>
  </div>
</div>
</div>


<!-- End SignUp/SignIn Candidate -->

<!-- User account -->
<div class="pull-right user-login">
  @guest
  <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#id02" href="#">Đăng nhập</a> | <a href="{!!route('company.partnership')!!}">Nhà tuyển dụng</a>
  @else
  @if (Auth::user()->isStudent())
  <div class="pull-right">
   <div class="dropdown user-account">
    <a class="user-account-text"> {!! Auth::user()->student->name!!}</a>
    <a class="dropdown-toggle" href="#" data-toggle="dropdown">
      <img src={{ asset(Auth::user()->student->photo) }} alt="avatar" id="avatarAccount">
    </a>
    <ul class="dropdown-menu dropdown-menu-right">
      <li><a href=""><i class="fa fa-user" aria-hidden="true"></i>Tài khoản</a></li>
      <li><a href=" {!! route('profile.index') !!}"><i class="fa fa-eye" aria-hidden="true"></i> Xem Hồ sơ</a></li>
      <li><a href="{!! route('profile.edit') !!}"><i class="fa fa-file" aria-hidden="true"></i>Cập nhật Hồ sơ</a></li>
      <li><a href="{!! route('student.recruitment.show') !!}"><i class="fa fa-save" aria-hidden="true"></i> Việc làm đã lưu</a></li>
      <li><a href="{!! route('student.apply.show') !!}"><i class="fa fa-check-circle" aria-hidden="true"></i> Việc làm đã ứng tuyển</a></li> 
      <li>
        <a href="{!! route('logout') !!}"onclick="event.preventDefault();document.getElementById('logout-form').submit();">Đăng xuất</a>
        <form id="logout-form" action="{!! route('logout') !!}" method="POST" style="display: none;">
          {{ csrf_field() }}
        </form>
      </li>
    </ul>
  </div>
</div>

@elseif(Auth::user()->isAdmin())
<a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#id02" href="#">Đăng nhập</a> | <a href="{{route('company.partnership')}}">Nhà tuyển dụng</a>

@elseif(Auth::user()->isRepresentative())
<div class="pull-right">
 <div class="dropdown user-account">
  <a class="user-account-text"> {!! Auth::user()->representative->name!!}</a>
  <a class="dropdown-toggle" href="#" data-toggle="dropdown">
    <img src="{{ asset('assets/img/logo-envato.png') }} " alt="avatar" id="avatarAccount">
  </a>
  <ul class="dropdown-menu dropdown-menu-right">
   <li><a href="#"><i class="fa fa-user" aria-hidden="true"></i> Tài khoản</a></li>
   <li><a href="{{ route('company.statistic') }}"><i class="fa fa-tachometer" aria-hidden="true"></i> Bảng điều khiển</a></li>
   <li><a href="{{ route('company.update') }}"><i class="fa fa-building-o" aria-hidden="true"></i> Công ty của bạn</a></li>
   <li><a href="{{ route('recruitments.index') }}"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Việc làm đã đăng</a></li>
   <li><a href="#"><i class="fa fa-users" aria-hidden="true"></i> Danh sách ứng tuyển</a></li>
   <li><a href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out" aria-hidden="true"></i>Đăng xuất</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
     {{ csrf_field() }}
   </form>
 </li>
</ul>
</div>
</div>
@endif

@endguest        
</div>
<!-- END User account -->

<!-- Navigation menu -->
<ul class="nav-menu">
  <li>
    <a class="active" href="{{ route('home') }}">Trang chủ</a>
  </li>
  <li>
    <a href="{{ route('companies.list') }}">Công ty</a>
  </li>
  <li>
    <a href="{{ route('lst.recruitment') }}">Việc làm</a>
  </li>
  <li>
    <a href="#">Blog</a>
  </li>
  <li>
    <a href="{{ route('contact') }}">Giới thiệu</a>
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
@if($errors->has('email') || $errors->has('password')  || Session::has('comment_message'))

<script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }} "></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }} "></script>

<script type="text/javascript">
  $('#id02').modal('show');
</script>
@endif

@if(Session::has('resigter-success') || Session::has('email-invalid') ||Session::has('email-exist'))
<script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }} "></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }} "></script>
<script type="text/javascript">
  $('#id02').modal('show');
  $('.nav-tabs li:first-child').removeClass('active');
  $('.nav-tabs li:last-child').addClass('active');
  modalSignInOut('dangky');
</script>
@endif



