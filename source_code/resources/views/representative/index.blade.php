@extends('layouts.representative')

@section('styles')

@endsection

@section('body')
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

@section('scripts')

@endsection