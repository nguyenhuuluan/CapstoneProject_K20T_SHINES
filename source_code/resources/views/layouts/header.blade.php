<nav class="navbar">
  <div class="container">

    <!-- Logo -->
    <div class="pull-left">
      <a class="navbar-toggle" href="#" data-toggle="offcanvas"><i class="ti-menu"></i></a>

      <div class="logo-wrapper">
        <a class="logo" href="{{ route('home') }}"><img src="{{ asset('assets/img/logo.png') }}" alt="logo"></a>
        <a class="logo-alt" href="{{ route('home') }}"><img src="{{ asset('assets/img/logo-alt.png') }}" alt="logo-alt"></a>
      </div>

    </div>
    <!-- END Logo -->
    

    <!-- The Modal -->
    <div id="id01" class="modal">
     <span onclick="document.getElementById('id01').style.display='none'" 
     class="close" title="Close Modal">&times;</span>
     <!-- Modal Content -->
     <form class="modal-content animate" method="POST" action="{{ route('login') }}">
      <div class="login-block">
       <img src="{{ asset('assets/img/logo.png') }}" alt="">
       <br>
       {{ csrf_field() }}
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

      <button class="btn btn-primary btn-block" type="submit">Đăng Nhập</button>
      <div class="login-links">
       <a class="pull-left" href="{{ route('password.request') }}">Quên mật khẩu?</a>
       <a class="pull-right" href="user-register.html">Đăng kí tài khoản</a>
     </div>
   </div>
 </form>
</div>
<!-- End Sign In -->

<!-- User account -->
<div class="pull-right user-login">
  @guest
  <a class="btn btn-sm btn-primary" href="{{ route('register') }}">Đăng kí</a> | <a onclick="document.getElementById('id01').style.display='block'" href="#">Đăng nhập</a>
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
      <img src="assets/img/logo-envato.png" alt="avatar">
    </a>
    <ul class="dropdown-menu dropdown-menu-right">
     <li><a href="user-login.html">Tài khoản</a>
     </li>
     <li><a href="user-register.html">Hồ sơ</a>
     </li>
     <li><a href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();">Đăng xuất</a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
      </form>
    </li>
  </ul>
</div>
</div>
{{-- 
<li class="dropdown">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
    <span class="caret"></span>
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


</li> --}}
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
<script type="text/javascript">
         // Get the modal
         var modal = document.getElementById('id01');
         
         // When the user clicks anywhere outside of the modal, close it
         window.onclick = function(event) {
          if (event.target == modal) {
            modal.style.display = "none";
          }
        }
      </script>

