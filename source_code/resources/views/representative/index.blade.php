@extends('layouts.master-layout',['title' => 'Jobee - Dashboard', 'isDisplaySearchHeader' => false])
{{-- @extends('layouts.representative') --}}

@section('page-header')
<header class="page-header">
  <div class="container page-name">
   <h1 class="text-center">Thống kê sơ bộ</h1>
 </div>
</header>
@endsection

@section('content')
<main>
  <center><h5>"The most important job is recruiting." - Steve Jobs</h5></center>
  <section>
   <div class="container">
    <div class="row">

      <h6>Bạn hiện có:</h6>
      <ul>
        {{-- <li><a href="">{{$recruitcount}} tin tuyển dụng </a>với <a href="">... hồ sơ </a>đã ứng tuyển</li> --}}
        <li>{{$recruitcount}} tin tuyển dụng </li>
        <li>{{$totalrepresentative}} tài khoản thành viên</li>
      </ul>
      <br>
       <button type="button" style="width: 280px;" class="btn btn-success-detail display-home-btn">Đăng ký hiển thị trang chủ</button>

      <br>
<br>
    </div>
    <div class="row">
     <h6>Trang báo cáo công ty</h6>
     <div class="table-responsive">
      <table class="table table-striped table-bordered-company">
       <thead>
        <tr>
         <th>Tổng số lượt xem</th>
         <th>Lượt xem của sinh viên</th>
         <th>Lượt xem không là sinh viên</th>
       </tr>
     </thead>
     <tbody>
      <tr>
       <td>{{ $studentview + $anonymousview }}</td>
       <td>{{ $studentview }}</td>
       <td>{{ $anonymousview }}</td>
     </tr>
   </tbody>
 </table>
</div>
</div>

</div>
</section>
</main>
@endsection