<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Post a job position or create your online resume by TheJobs!">
    <meta name="keywords" content="">

    <title>Jobee</title>

    <!-- Styles -->
    <link href="{{ asset('assets/css/app.min.css') }} " rel="stylesheet">
    <link href="{{ asset('assets/css/thejobs.css') }} " rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }} " rel="stylesheet">

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Oswald:100,300,400,500,600,800%7COpen+Sans:300,400,500,600,700,800%7CMontserrat:400,700' rel='stylesheet' type='text/css'>

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link rel="icon" href="{{ asset('assets/img/favicon.ico') }} ">
  </head>

  <body class="login-page">


    <main>

      <div class="login-block">
        <img src="{{ asset('assets/img/logo.png') }} " alt="">
        <h1>Đăng Nhập</h1>

        <form action="#">

          <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="ti-id-badge"></i></span>
                <input type="text" class="form-control" placeholder="Tài khoản">
              </div>
            </div>
            <hr class="hr-xs">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="ti-key"></i></span>
                <input type="password" class="form-control" placeholder="Mật khẩu">
              </div>
            </div>
            <button class="btn btn-primary btn-block" type="submit">Đăng Nhập</button>
            <div class="login-links">
              <a class="pull-left" href="user-forget-pass.html">Quên mật khẩu?</a>
            </div>

        </form>
      </div>


    </main>


    <!-- Scripts -->
    <script src="{{ asset('assets/js/app.min.js') }} "></script>
    <script src="{{ asset('assets/js/thejobs.js') }} "></script>
    <script src="{{ asset('assets/js/custom.js') }} "></script>

  </body>
</html>
