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
         <h1 class="text-center">Cập nhật thông tin</h1>
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

               {!! Form::open(['method' => 'POST', 'route' => 'student.confirm-information', 'class' => 'form-horizontal']) !!}

               <div class="form-group ol-md-3 col-xs-12 col-sm-3">
                  <h7>Họ tên</h7>
               </div>
               <div class="form-group col-md-9 col-xs-12 col-sm-9{{ $errors->has('name') ? ' has-error' : '' }}">
                  <input type="text" class="form-control" name="name" value="{{old('name')}}"  maxlength="40" placeholder="Tên đầy đủ">                  
                  <small class="text-danger">{{ $errors->first('name') }}</small>
               </div>

               <div class="form-group ol-md-3 col-xs-12 col-sm-3">
                  <h7>Ngày sinh</h7>
               </div>
               <div class="form-group col-md-9 col-xs-12 col-sm-9{{ $errors->has('dateofbirth') ? ' has-error' : '' }}">

                  <div class="form-group{{ $errors->has('dateofbirth') ? ' has-error' : '' }}">
                   {!! Form::date('dateofbirth', null, ['class' => 'form-control']) !!}
                   <small class="text-danger">{{ $errors->first('dateofbirth') }}</small>
                </div>

             </div>

             <div class="form-group ol-md-3 col-xs-12 col-sm-3">
               <h7>Giới tính</h7>
            </div>
            <div class="form-group col-md-9 col-xs-12 col-sm-9{{ $errors->has('gender') ? ' has-error' : '' }}">

              <label>{{ Form::radio('gender', '1', true) }} Nam </label>
              <label style="margin-left: 50px;">{{ Form::radio('gender', '0') }} Nữ </label>

              <small class="text-danger">{{ $errors->first('gender') }}</small>
           </div>

           <div class="form-group col-md-3 col-xs-12 col-sm-3">
            <h7>Số điện thoại</h7>
         </div>
         <div class="form-group col-md-9 col-xs-12 col-sm-9{{ $errors->has('phone') ? ' has-error' : '' }}">
            <input type="text" class="form-control" name="phone"  value="{{old('phone')}}"  placeholder="Số điện thoại">
            <small class="text-danger">{{ $errors->first('phone') }}</small>
         </div>

         <div class="form-group col-md-3 col-xs-12 col-sm-3">
            <h7>Chuyên nghành</h7>
         </div>
         <div class="form-group col-md-9 col-xs-12 col-sm-9{{ $errors->has('faculty_id') ? ' has-error' : '' }}">
            <div class="form-group{{ $errors->has('faculty_id') ? ' has-error' : '' }}">
              {!! Form::select('faculty_id', $faculs, null, ['id' => 'faculty_id', 'class' => 'form-control']) !!}
              <small class="text-danger">{{ $errors->first('faculty_id') }}</small>
           </div>
           <small class="text-danger">{{ $errors->first('faculty_id') }}</small>
        </div>

        <hr class="col-md-12 col-xs-12 col-sm-12">

        {{-- <h3 class="text-center">Cập nhật mật khẩu để đăng nhập tại đây!</h3> --}}
        <br>

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
      <div id="thongbao" class="modal">
         <form class="modal-content animate">
            <div class="login-block">
               <img src="assets/img/success.png" style="width: 70px; height: 70px;">
               <h1>Cập nhật thành công</h1>
               <span><a href="index.html">Trang chủ</a></span>
            </div>
         </form>
      </div>
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