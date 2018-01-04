<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Jobee Login</title>

    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700|Lato:400,100,300,700,900' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="{{ asset('assets/dist/css/animate.css') }}">
    
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/style.css') }}">

    <script src="{{ asset('assets/vendors/jquery/jquery.min.js') }} "></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <div class="container">
        <div class="top">
            <h1 id="title" class="hidden"><span id="logo"><span>Jobee</span></span></h1>
        </div>
        <div class="login-box animated fadeInUp">
            <div class="box-header">
                <h2>Đăng nhập</h2>
            </div>
            <form class="form-horizontal" method="POST" action="{{ route('admin.login') }}">
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-4 control-label">Password</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="password" required>

                        @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                @if ($errors->has('email'))
                <span class="help-block">
                  <strong style="color: red">{{ $errors->first('email') }}</strong>
              </span>
              @endif
              @if(Session::has('comment_message'))  
              <span class="help-block">
                  <strong style="color: red">{{ session('comment_message') }}</strong>
              </span>
              @endif

              <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Đăng nhập
                    </button>

                </div>
            </div>

            <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Ghi nhớ
                        </label>
                    </div>
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        Quên mật khẩu?
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
</body>

<script>
    $(document).ready(function () {
        $('#logo').addClass('animated fadeInDown');
        $("input:text:visible:first").focus();
    });
    $('#username').focus(function() {
        $('label[for="username"]').addClass('selected');
    });
    $('#username').blur(function() {
        $('label[for="username"]').removeClass('selected');
    });
    $('#password').focus(function() {
        $('label[for="password"]').addClass('selected');
    });
    $('#password').blur(function() {
        $('label[for="password"]').removeClass('selected');
    });
</script>

</html>