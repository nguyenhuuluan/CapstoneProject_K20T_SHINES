@extends('layouts.representative')

@section('styles')
<!-- DataTables CSS -->
<link href="{{ asset('assets/vendors/datatables-plugins/dataTables.bootstrap.css') }} " rel="stylesheet">
<!-- DataTables Responsive CSS -->
<link href="{{ asset('assets/vendors/datatables-responsive/dataTables.responsive.css') }} " rel="stylesheet">
@endsection

@section('body')
<!-- Main container -->
<main>
   <section>
      <div class="container">
         <div class="row"> 
            @if(Session::has('comment_message'))
            <div class="container">
               <ul class="alert alert-success">
                  {{ session('comment_message') }}
               </ul>
            </div>   
            @endif
            <div class="col-lg-12">
               <div class="panel-body">
                  <div class="table-responsive">
                     <table width="100%" id="dataTables-example" class="table table-striped table-hover table-bordered-company">
                        <thead>
                           <tr>
                              <th>ID</th>
                              <th>Tiêu đề việc làm</th>
                              <th>Lĩnh Vực</th>
                              <th>Lương</th>
                              <th>Ngày đăng</th>
                              <th>Ngày hết hạn</th>
                              <th>Lượt xem</th>
                              <th>Trạng thái</th>
                              <th>Thao tác</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach ($recruitments as $recruitment)
                           <tr>
                              <td>{{ $recruitment->id }}</td>
                              <td><a href="{{ $recruitment->path() }}" target="_blank">{{ $recruitment->title }}</a></td>
                              <td>{{ $recruitment->salary }}</td>
                              <td>
                                 <?php foreach ($recruitment->tags as $tag){
                                    echo '<span class="label label-default">'.$tag->name.'</span>';
                                 }                                   
                                 ?>
                                 
                              </td>
                              <td>{{ $recruitment->created_at }}</td>
                              <td>{{ $recruitment->expire_date }}</td>
                              <td><center>{{ $recruitment->number_of_view }}</center></td>
                              <td>
                                 @if ($recruitment->status->name == 'active_recruitment')
                                 <span class="label label-success">Đã duyệt</span>
                                 @elseif ($recruitment->status->name == 'approve_recruitment')
                                 <span class="label label-warning">Đang chờ</span>
                                 @else
                                 <span class="label label-danger">Tạm dừng</span>
                                 @endif
                              </td>
                              <td>
                                 <center>
                                    <a href="mn-job-add-company.html" target="_blank"><abbr title="Sửa"><i class="fa fa-pencil" aria-hidden="true"></i></abbr></a>
                                    <a href="#"><abbr title="Xóa"><i class="fa fa-trash" aria-hidden="true"></i></abbr></a>
                                 </center>
                              </td>
                           </tr>
                           @endforeach

                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
         <a class="btn btn-success-detail" href="{{ route('recruitments.create') }}" target="_blank">Thêm tin tuyển dụng</a>
      </div>
   </section>
</main>
<!-- END Main container -->
@endsection

@section('scripts')

<!-- DataTables JavaScript -->
<script src="{{ asset('assets/vendors/datatables/js/jquery.dataTables.min.js') }} "></script>
<script src="{{ asset('assets/vendors/datatables-plugins/dataTables.bootstrap.min.js') }} "></script>
<script src="{{ asset('assets/vendors/datatables-responsive/dataTables.responsive.js') }} "></script>
<script>
   $(document).ready(function() {
    $('#dataTables-example').DataTable({
     responsive: true
  });
 });
</script>
@endsection