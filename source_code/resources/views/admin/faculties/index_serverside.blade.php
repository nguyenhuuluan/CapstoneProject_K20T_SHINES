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
@endsection

@section('body')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Danh sách tin tuyển dụng</h1>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="">
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table width="100%" class="table table-striped table-hover" id="faculty_table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên</th>
                                        <th>Mô tả</th>
                                        <th>Tags</th>                                       
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

<script type="text/javascript">
    $.fn.dataTable.ext.errMode = 'throw';
    $(document).ready(function() {
            var datatable =$('#faculty_table').DataTable({
                "processing": false,
                "serverSide": false,
                "ajax": {
                    "url": "{{ route('faculties.getdata') }}",
                    "type": "GET",
                    "datatype": "json",
                    error: function(){
                        datatable.ajax.reload();
                    }            
                },
                "columns":[
                { "data": "id" },
                { "data": "name" },
                { "data": "description" },
                { "data": "tags", 
                "render": function ( data, type, row ) {
                    var tmp = '';
                    for (var i = 0, len = data.length; i < len; i++) {
                      tmp = tmp + '<span class="label label-default">'+data[i]['name']+'</span>'
                  }
                  return tmp;
              },
          },
  { "data": "created_at" },
  { "data": "action" },
  ]
});

    });
</script>
@endsection