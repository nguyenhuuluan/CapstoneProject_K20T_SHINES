@extends('layouts.master-layout',['title' => 'Jobee - Dashboard', 'isDisplaySearchHeader' => false])

@section('stylesheet')
<!-- DataTables CSS -->
<link href="{{ asset('assets/vendors/datatables-plugins/dataTables.bootstrap.css') }} " rel="stylesheet">
<!-- DataTables Responsive CSS -->
<link href="{{ asset('assets/vendors/datatables-responsive/dataTables.responsive.css') }} " rel="stylesheet">
@endsection

@section('page-header')
<header class="page-header">
   <div class="container page-name">
      <h1 class="text-center">Thống kê sơ bộ</h1>
   </div>
</header>
@endsection

@section('content')
<!-- Main container -->
<main>
   <section>
      <div class="container">
         <div class="row"> 
            @if(Session::has('create_success'))
            <div class="container">
               <ul class="alert alert-success">
                  {{ session('create_success') }}
               </ul>
            </div>   
            @endif
            <div class="col-lg-12">
               <div class="panel-body">
       <!--           <div align="left">
        <a class="btn btn-success btn-md" href="{{ route('recruitments.create') }}" target="_blank">Đăng tin tuyển dụng</a>
        {{-- <a class="btn btn-success-detail" href="{{ route('recruitments.create') }}" target="_blank">Đăng tin tuyển dụng</a> --}}
                      </div> -->
               <div class="table-responsive">
                  <table width="100%" id="dataTables-example" class="table table-striped table-hover table-bordered-company">
                     <thead>
                        <tr>
                           <th>STT</th>
                           <th>Tiêu đề việc làm</th>
                           <th>Lương</th>
                           <th>Tags</th>
                           <th>Ngày đăng</th>
                           <th>Ngày hết hạn</th>
                           <th>Lượt xem</th>
                           <th>Ứng viên</th>
                           <th>Trạng thái</th>
                           <th>Thao tác</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($recruitments as $recruitment)
                        <tr>
                           <td>{{ $loop->index + 1 }}</td>
                           <td><a href="{{ $recruitment->path() }}" target="_blank">{{ $recruitment->title }}</a></td>
                           <td>{{ $recruitment->salary }}</td>
                           <td>
                              <div style="display:grid; grid-template-columns: repeat(2,1fr);grid-gap: 5px">
                                 @foreach ($recruitment->tags as $tag)
                                 {!! '<span class="label label-default">'.$tag->name.'</span>' !!}
                                 @endforeach
                              </div>
                           </td>
                           <td>{{ $recruitment->created_at }}</td>
                           <td>{{ $recruitment->expire_date }}</td>
                           <td><center>{{ $recruitment->number_of_view }}</center></td>
                           <td>
                             <a href="#" class="btn btn-xs btn-primary cv-list" id="{{ $recruitment->id }}">Hồ sơ<span class="badge">{{ $recruitment->applies_count }}</span></a><br>
                          </td>
                          <td>
                           @if ($recruitment->status->id == '1')
                           <span class="label label-success">Đã duyệt</span>
                           @elseif ($recruitment->status->id == '8')
                           <span class="label label-warning">Đang chờ</span>
                           @elseif ($recruitment->status->id == '2')
                           <span class="label label-danger">Tạm dừng</span>
                           @endif
                        </td>
                        <td>
                           <center>
                              <a href="#" target="_blank"><abbr title="Sửa"><i class="fa fa-pencil" aria-hidden="true"></i></abbr></a>
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
   <a class="btn btn-success-detail" href="{{ route('recruitments.create') }}" target="_blank">Đăng tin tuyển dụng</a>
</div>
</section>
</main>
<div class="modal fade" id="lst_cv" role="dialog" style="">
 <form role="form" method="post" id="updateFaculty">
   {{csrf_field()}}
   <div class="modal-dialog">
     <!-- Modal content-->
     <div class="modal-content" style="width: auto;height: auto; border-radius:3%;">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h2 class="modal-title alert alert-info update" style="text-align: center; font-weight: bold;">Danh sách hồ sơ sinh viên ứng tuyển</h2>
      </div>
      <div class="modal-body">
         <div class="table-responsive">
            <table id="example" class="table table-striped table-hover">
             <thead>
              <tr>
               <th>Họ tên</th>
               <th>Email</th>
               <th>Ngày ứng tuyển</th>
               <th>CV</th>
               <th>Khoa</th>
            </tr>
         </thead>
      </table>
   </div>
</div>
<div id="form_output"></div>
<div class="modal-footer">
   {{-- <input type="submit" name="submit" id="action" value="Thêm mới" class="btn btn-info" /> --}}
   <button type="button" class="btn btn btn-info" data-dismiss="modal">Đóng</button>
</div>
</div>
</div>
</form>
</div>
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
     var dataTable =  $('#example').DataTable({
        "autoWidth" : false,
     });
       //Nhấn nút edit->show modal
       $(document).on('click', '.cv-list', function(){
         id = $(this).attr("id");
         // alert(id);
         url = "{{ route('recruitments.getcv'), ":id" }}";
         url = url.replace(':id', id);
         dataTable.destroy();
         //load datatable;
         dataTable = $('#example').DataTable({
          "autoWidth" : false,
          "processing": false,
          "serverSide": false,
          "ajax": {
             "url": url,
             "type": "GET",
             "datatype": "json",
             "data": {id:id},
             error: function(){
               alert('Lỗi không xác định, vui lòng thử lại sau!')
                      // $('#example').DataTable().ajax.reload();
                   }            
                },
                "columns":[
                { "data": "student",
                "render":function(data,type,row){return data['name'];},},
                { "data": "student",
                "render":function(data,type,row){return data['email'];},},
                { "data": "created_at",},
                { "data": "cv",
                "render":function(data,type,row)
                {
                  var tmp = '<a href="{{ route('student.cv.download', ':file') }}" data-id=":id" id="delete" target="_blank"><abbr title="Tải xuống"><i class="fa fa-download" aria-hidden="true"></i></i></abbr></a>&nbsp;';
                  tmp = tmp.replace(':file', data['file']);
                  tmp = tmp.replace(':id', data['id']);
                  tmp +='<a href="{{ route('student.cv.preview', ':file') }}" data-id=":id" target="_blank"><abbr title="Xem"><i class="fa fa-eye" aria-hidden="true"></i></abbr></a>';
                  tmp = tmp.replace(':file', data['file']);
                  tmp = tmp.replace(':id', data['id']);
                  return tmp;
               },},
               { "data": "student",
               "render":function(data,type,row){return data['faculty']['name'];},},  
               ]
            });
         $('#lst_cv').modal('show');
      });
    });
 </script>
 @endsection