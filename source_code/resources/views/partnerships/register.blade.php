<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="keywords" content="">

  <title>Đăng ký công ty</title>

  <!-- Styles -->
  <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/thejobs.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/alpha.css') }}" rel="stylesheet">

  <!-- Fonts -->
  <link href='http://fonts.googleapis.com/css?family=Oswald:100,300,400,500,600,800%7COpen+Sans:300,400,500,600,700,800%7CMontserrat:400,700' rel='stylesheet' type='text/css'>

  <!-- Favicons -->
  <link rel="apple-touch-icon" href="{{ asset('/apple-touch-icon.png') }}">
  <link rel="icon" href="{{ asset('assets/img/favicon.ico') }} ">
</head>

<body class="login-page">


  <main>

    <div class="login-block">
      <img src="{{ asset('assets/img/logo.png') }} " alt="">
      <h1>Chúng tôi rất vui khi được đón tiếp quý công ty :)</h1>
      @if(Session::has('resigter-success'))
      <br>
      <div class="alert alert-success">         
        <span>{!! session('resigter-success') !!}</span>
      </div>
      @endif
      {!! Form::open(['method' => 'POST', 'route' => 'company.register.partnership.store', 'class' => 'form-horizontal']) !!}

      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon"><i class="ti-home"></i></span>
          <input name="company_name" type="text" class="form-control" placeholder="Tên Công Ty">
          
        </div>
        <small class="text-danger">{{ $errors->first('company_name') }}</small>
      </div>

      <hr class="hr-xs">

      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon"><i class="ti-world"></i></span>
          <input name="company_website" type="text" class="form-control" placeholder="Website Công Ty">
          
        </div>
        <small class="text-danger">{{ $errors->first('company_website') }}</small>
      </div>

      <hr class="hr-xs">

      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon"><i class="ti-user"></i></span>
          <input name="representative_name" type="text" class="form-control" placeholder="Tên của bạn">
          
        </div>
        <small class="text-danger">{{ $errors->first('representative_name') }}</small>
      </div>

      <hr class="hr-xs">

      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon"><i class="ti-bag"></i></span>
          <input name="representative_position" type="text" class="form-control" placeholder="Chức vụ">
          
        </div>
        <small class="text-danger">{{ $errors->first('representative_position') }}</small>
      </div>

      <hr class="hr-xs">

      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon"><i class="ti-email"></i></span>
          <input name="representative_email" type="email" class="form-control" placeholder="Email của bạn">
          
        </div>
        <small class="text-danger">{{ $errors->first('representative_email') }}</small>
      </div>

      <hr class="hr-xs">

      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-phone"></i></span>
          <input name="representative_phone" type="text" class="form-control" placeholder="Điện thoại của bạn">
          
        </div>
        <small class="text-danger">{{ $errors->first('representative_phone') }}</small>
      </div>
      <button name="registerCompany" class="btn btn-primary btn-block" type="submit">Gửi</button>
    </div>


    {!! Form::close() !!}

  </main>


  <!-- Scripts -->
  <script src="{{ asset('assets/js/app.min.js') }} "></script>
  <script src="{{ asset('assets/js/thejobs.js') }} "></script>
  <script src="{{ asset('assets/js/custom.js') }} "></script>

</body>
</html>
