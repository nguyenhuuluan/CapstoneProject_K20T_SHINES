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
  <script src="https://www.google.com/recaptcha/api.js?render=6LdY8lwUAAAAAGprXsePTCCasbYtCqLuiueeOhsO"></script>
  
  <style type="text/css">
  .form-group.has-error{
    border: 2px solid #d22c33;
    border-radius: 4px;
  }
</style>

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
      @elseif(Session::has('resigter-error'))
      <br>
      <div class="alert alert-danger">         
        <span>{!! session('resigter-error') !!}</span>
      </div>
      @endif
      {!! Form::open(['method' => 'POST', 'route' => 'company.register.partnership.store', 'class' => 'form-horizontal', 'id' => 'download-form']) !!}

      <div class="form-group {{ $errors->has('company_name') ? 'has-error' : ''  }}">
        <div class="input-group">
          <span class="input-group-addon"><i class="ti-home"></i></span>
          <input value = "{{ old('company_name') }}" required name="company_name" type="text" class="form-control has-error2" placeholder="Tên Công Ty">
        </div>
      </div>

      <span class="help-block" style="text-align: left;"><strong style="color: red">{{ $errors->first('company_name') ?? '' }}</strong></span>
      <hr class="hr-xs">

      <div class="form-group {{ $errors->has('company_website') ? 'has-error' : ''  }}">
        <div class="input-group">
          <span class="input-group-addon"><i class="ti-world"></i></span>
          <input name="company_website" required type="text" value = "{{ old('company_website') }}" class="form-control" placeholder="Website Công Ty">
        </div>
      </div>

      <span class="help-block" style="text-align: left;"><strong style="color: red">{{ $errors->first('company_website') ?? '' }}</strong></span>
      <hr class="hr-xs">

      <div class="form-group {{ $errors->has('representative_name') ? 'has-error' : ''  }}">
        <div class="input-group">
          <span class="input-group-addon"><i class="ti-user"></i></span>
          <input name="representative_name" required value = "{{ old('representative_name') }}" type="text" class="form-control" placeholder="Tên của bạn">
        </div>
      </div>

      <span class="help-block" style="text-align: left;"><strong style="color: red">{{ $errors->first('representative_name') ?? '' }}</strong></span>
      <hr class="hr-xs">

      <div class="form-group {{ $errors->has('representative_position') ? 'has-error' : ''  }}">
        <div class="input-group">
          <span class="input-group-addon"><i class="ti-bag"></i></span>
          <input name="representative_position" required type="text" value = "{{ old('representative_position') }}" class="form-control" placeholder="Chức vụ">
        </div>
      </div>
      
      <span class="help-block" style="text-align: left;"><strong style="color: red">{{ $errors->first('representative_position') ?? '' }}</strong></span>
      <hr class="hr-xs">

      <div class="form-group {{ $errors->has('representative_email') ? 'has-error' : ''  }}">
        <div class="input-group">
          <span class="input-group-addon"><i class="ti-email"></i></span>
          <input name="representative_email" required value = "{{ old('representative_email') }}" type="text" class="form-control" placeholder="Email của bạn">
        </div>
      </div>


      <span class="help-block" style="text-align: left;"><strong style="color: red">{{ $errors->first('representative_email') ?? '' }}</strong></span>
      <hr class="hr-xs">

      <div class="form-group {{ $errors->has('representative_phone') ? 'has-error' : ''  }}">
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-phone"></i></span>
          <input name="representative_phone" required value = "{{ old('representative_phone') }}" type="text" class="form-control" placeholder="Điện thoại của bạn">
        </div>
      </div>

      <span class="help-block" style="text-align: left;"><strong style="color: red">{{ $errors->first('representative_phone') ?? '' }}</strong></span>
      <span class="help-block" style="text-align: left;"><strong style="color: red">{{ $errors->first('g-recaptcha-response') ?? '' }}</strong></span>

      <input id="g-recaptcha-response" type="hidden" name="g-recaptcha-response">
      <button name="registerCompany" class="btn btn-primary btn-block" type="submit">Gửi</button>
    </div>

    {!! Form::close() !!}

  </main>


  <!-- Scripts -->
  <script src="{{ asset('assets/js/app.min.js') }} "></script>
  <script src="{{ asset('assets/js/thejobs.js') }} "></script>
  <script src="{{ asset('assets/js/custom.js') }} "></script>



  <script>
    grecaptcha.ready(function() {
      grecaptcha.execute('6LdY8lwUAAAAAGprXsePTCCasbYtCqLuiueeOhsO', {action: 'post'}).then(function(token) {
       $('#g-recaptcha-response').val(token);
     });
    });
  </script>

</body>
</html>
