@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="{{asset('assets/vendors/modal-confirm/jquery-confirm.min.css')}}">

<!-- DataTables CSS -->
{{-- <link href="{{asset('assets/vendors/datatables-plugins/dataTables.bootstrap.css')}}" rel="stylesheet"> --}}

<!-- DataTables Responsive CSS -->
<link href="{{asset('assets/vendors/datatables-responsive/dataTables.responsive.css')}}" rel="stylesheet">

<!-- Toggle CSS Button -->
<link href="{{asset('assets/dist/css/bootstrap-toggle.min.css')}}" rel="stylesheet">
{{-- bootstrap switch --}}
<link href="{{asset('assets/vendors/bootstrap-switch/bootstrap-switch.css')}}" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection

@section('body')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Danh sách tin Blog</h1>
                @include('includes.message')
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="">
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        @can('blogs.create')
                        <div align="right"><a href="{{ route('blogs.create') }}" class="btn btn-sm btn-success add" id=""><i class="fa fa-plus-square" aria-hidden="true"></i> Thêm mới</a></div>
                        @endcan
                        <div class="table-responsive">
                            <table width="100%" class="table table-striped table-hover" id="blog_table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tiêu đế</th>
                                        <th>Nội dung</th>
                                        <th>Tag</th>
                                        <th>Ngày tạo</th>                                       
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
        </div>
        <!-- /.col-lg-12 -->
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>

@endsection


@section('scripts')

<!-- DataTables JavaScript -->
<script src="{{asset('assets/vendors/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/vendors/datatables-plugins/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('assets/vendors/datatables-responsive/dataTables.responsive.js')}}"></script>
{{-- boostrap switch --}}
<script src="{{asset('assets/vendors/bootstrap-switch/bootstrap-switch.js')}}"></script>
<!-- Toggle JavaScript Button -->
<script src="{{asset('assets/js/bootstrap-toggle.min.js')}}"></script>
<!-- Page-Level Demo Scripts - Tables - Use for reference -->
{{-- using jquery modal confirm JS --}}
<script src="{{asset('assets/vendors/modal-confirm/jquery-confirm.min.js')}}"></script>
<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script type="text/javascript" src="{{ asset('assets/js/alert.js') }}"></script>


<script type="text/javascript">
    $(document).ready(function() {
      var table =  $('#blog_table').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "{{ route('blogs.getdata') }}",
        "columns":[
        { "data": "id" },
        { "data": "title" },
        { "data": "content",
        "render": function ( data, type, row ) {
            return data.substring(0,50)+'...'
        },

    },
    { "data": "tag" },
    { "data": "created_at" },
    { "data": "action" },
    ],
});
       //Nhấn nút delete->confirm
       $(document).on('click', '.delete', function(){
        ele = $(this).parent().parent();
        var id = $(this).attr("id");
        var url = '{{ route("blogs.destroy") }}';
        url = url.replace(':id', id);
        var currentelement = $(this);
        $.confirm({
          icon: 'fa fa-warning',
          title: 'Cảnh báo!!',
          content: 'Bạn có chắc muốn xóa bài Blog này!',
          type:'red',
          buttons: {
            XacNhan: {
              text: 'Xác nhận',
              btnClass: 'btn-danger',
              keys: ['enter', 'shift'],
              action: function() {
                $.ajax({
                 headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              url: url,
              type: 'delete',
              data: {"slug": id},
              success: function(data){
                  alertSuccess('Xóa thành công ...')
                  table.row(currentelement.parent().parent()).remove().draw();
              },
              error: function(data){
                 alertError('Xóa không thành công ...');
             }            
         });
            },
        },
        Huy: {
          text: 'Hủy',
          btnClass: 'btn-default',
          keys: ['esc'],
      },
  },
});
    //end of confirm
});

   });
</script>
@endsection