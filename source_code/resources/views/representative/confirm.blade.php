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
<body class="nav-on-header smart-nav">
 <!-- Navigation bar -->

 <!-- END Navigation bar -->
 <!-- Page header -->
 <header class="page-header">
  <div class="container page-name">
   <h1 class="text-center">Cập nhật mật khẩu</h1>
 </div>
</header>
<!-- END Page header -->

<!-- Main container -->
<main>
  <section>
   <div class="container">
    <div class="row">
     <div class="form-group col-md-12 col-xs-12 col-sm-12">
      <h3 class="text-center">Xin chào <i>{{$acc->username}}</i>, vui lòng cập nhật thông tin của bạn tại đây!</h3>
      <br>
    </div>

    {!! Form::open(['method' => 'POST', 'route' => 'representative.reset-password', 'class' => 'form-horizontal']) !!}
    <input type="hidden" name="account_id" value="{{$acc->id}}">
    <div class="form-group ol-md-3 col-xs-12 col-sm-3">
     <h7>Email</h7>
   </div>
   <div class="form-group col-md-9 col-xs-12 col-sm-9">
     <input type="text" class="form-control" value="{{$acc->username}}" disabled>
   </div>

   <div class="form-group col-md-3 col-xs-12 col-sm-3">
     <h7>Mật khẩu</h7>
   </div>
   <div class="form-group col-md-9 col-xs-12 col-sm-9{{ $errors->has('confirmpassword') ? ' has-error' : '' }}">
    <input type="password" class="form-control" value="{{old('password')}}" name="password" placeholder="ít nhất 10 kí tự">
    <small class="text-danger">{{ $errors->first('confirmpassword') }}</small>
  </div>


  <div class="form-group col-md-3 col-xs-12 col-sm-3">
   <h7>Nhập lại mật khẩu</h7>
 </div>
 <div class="form-group col-md-9 col-xs-12 col-sm-9{{ $errors->has('password') ? ' has-error' : '' }}">
   <input type="password" class="form-control" name="password_confirmation" placeholder="ít nhất 10 kí tự">
   <small class="text-danger">{{ $errors->first('password') }}</small>
 </div>


 <button class="btn btn-primary btn-block" type="submit">Cập nhật</button>

 {!! Form::close() !!}
               {{-- <div class="form-group col-md-3 col-xs-12 col-sm-3">
                  <h7>Mật khẩu</h7>
               </div>
               <div class="form-group col-md-9 col-xs-12 col-sm-9">
                  <input type="text" class="form-control" placeholder="ít nhất 10 kí tự">
               </div>

               <div class="form-group col-md-3 col-xs-12 col-sm-3">
                  <h7>Nhập lại mật khẩu</h7>
               </div>
               <div class="form-group col-md-9 col-xs-12 col-sm-9">
                  <input type="text" class="form-control" placeholder="ít nhất 10 kí tự">
                </div> --}}
              </div>
            </div>
          </section>
          <!-- Submit -->
      {{-- <div class="container">
         <p class="text-center">
            <a class="btn btn-danger btn-xl btn-round" data-toggle="modal" data-target="#thongbao" href="index.html">Cập nhật</a>
         </p>
         <br>
       </div> --}}
       <!-- END Submit -->

       <!-- Modal ThongBao -->
       <!-- END Modal ThongBao -->

     </main>
     <!-- END Main container -->
     <!-- Site footer -->
     <footer class="site-footer">
      <!-- Bottom section -->
      <div class="container">
       <div class="row">
        <div class="col-md-8 col-sm-6 col-xs-12">
         <p class="copyright-text">Copyrights &copy; 2017 All Rights Reserved by <a href="#">Shines Team</a>.</p>
       </div>
     </div>
   </div>
   <!-- END Bottom section -->
 </footer>
 <!-- END Site footer -->
 <!-- Back to top button -->
 <a id="scroll-up" href="#"><i class="ti-angle-up"></i></a>
 <!-- END Back to top button -->
 <!-- Scripts -->

 <script src="{{ asset('assets/js/app.min.js') }} "></script>
 <script src="{{ asset('assets/js/thejobs.js') }} "></script>
 <script src="{{ asset('assets/js/custom.js') }} "></script>

</body>
</html>