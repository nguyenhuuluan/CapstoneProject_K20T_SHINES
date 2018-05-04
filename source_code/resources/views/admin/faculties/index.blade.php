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
<link href="{{ asset('assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css') }} " rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('body')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Quản lý nghành đào tạo</h1>
                <p class="alert alert-success" id="message" style="display: none;"></p>
                @include('includes.message')
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
                                            <th>Tên ngành</th>
                                            <th>Mô tả</th>
                                            <th>Tags</th>
                                            <th>Ngày tạo</th>
                                            <td>Thao tác</td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->

                        <div id="editFaculty" class="modal fade">
                            <form class="modal-content animate" id="updateFaculty" method="post">
                                {{csrf_field()}}
                                <div class="login-block">
                                    <h2 style="color:green; font-weight: bold;" class="modal-title">Thêm mới</h2>
                                    <span id="form_output"></span>
                                    <div class="form-group">
                                        <label style="float: left; padding-left: 10px;">Tên Ngành:</label>
                                        <input type="text" name="name" id="faculty_name" class="form-control" />
                                    </div>
                                    <hr>

                                    <div class="form-group">
                                        <label style="float: left; padding-left: 10px;">Mô tả:</label>
                                        <input type="text" name="description" id="faculty_des" class="form-control" />
                                    </div>
                                    <hr>
                                    
                                    <div class="form-group">
                                        <input type="text" name="tags" class="name tagsinput-typeahead form-control" placeholder="Nhập tags" data-role="tagsinput" id="tags">
                                    </div>
                                    <br><br>
                                    <input type="hidden" name="faculty_id" id="faculty_id" value="" />
                                    <input type="hidden" name="button_action" id="button_action" value="insert" />
                                    <input type="submit" name="submit" id="action" value="Thêm mới" class="btn btn-success" />
                                    <button class="btn btn-warning" data-dismiss="modal">Hủy</button>
                                </div>
                                <div id="#test"></div>

                            </form>
                        </div>

                    </div>
                    <!-- /.panel -->
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
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
<script src="{{ asset('assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap-tagsinput/bootstrap3-typeahead.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/alert.js') }}"></script>


<!-- Page-Level Demo Scripts - Tables - Use for reference -->

<script> 
    $('.tagsinput-typeahead').tagsinput({
        typeahead: {
            source: $.get('{{ route('tags') }}'),
            afterSelect: function() {
                this.$element[0].value = '';    
            },
        },
        trimValue: true,
        freeInput: true,
        tagClass: 'label label-default',
    })
</script>
<script>
    $(document).ready(function() {
        var ele;
        //load datatable
        var datatable =$('#faculty_table').DataTable({
            "processing": false,
            "serverSide": false,
            "ajax": {
                "url": "{{ route('faculties.getdata') }}",
                "type": "GET",
                "datatype": "json",
                error: function(){
                    $('#faculty_table').DataTable().ajax.reload();
                }            
            },
            "columns":[
            { "data": "id" },
            { "data": "name", "class":"name" },
            { "data": "description","class":"description" },
            { "data": "tags", "class":"tags", 
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
        //end of loading datatable

        //Datatable responsive
        $('#dataTables-example').DataTable({
            responsive: true
        });

        //Chan event enter input tags
        $(window).keypress(function(event){
            if(event.keyCode == 13) {
              event.preventDefault();
              return false;
          }
      });

        //Nhấn nút edit->show modal
        $(document).on('click', '.edit', function(){
            $('#tags').tagsinput('removeAll');
            ele = $(this).parent().parent();
            var id = $(this).attr("id");
            $('#form_output').html('');
            var url = '{{ route("faculties.show", ":id") }}';
            url = url.replace(':id', id);
            // console.log(url);
            $.ajax({
                url:url,
                method:'get',
                // data:{id:id},
                dataType:'json',
                success:function(data)
                {   
                    var tags = data.tags.map(function(item){return item.name});
                    var tmp = '';
                    for (var i = 0; i < tags.length; i++) {
                        tmp += tags[i] + ",";
                    }
                    newtag = tmp;
                    $('#editFaculty').modal('show');
                    $('#faculty_name').val(data.name);
                    $('#faculty_id').val(data.id);
                    $('#faculty_des').val(data.description);
                    $('#tags').val(tmp);
                    $('#tags').tagsinput('add', tmp);
                    $('#action').val('Lưu');
                    $('.modal-title').text('Cập nhật thông tin');
                    $('#button_action').val('update');
                }
            })
        });

        //Form submit
        $('#updateFaculty').on('submit', function(event){
            event.preventDefault();
            var form_data = $(this).serialize();

            $.ajax({
                type: "POST",
                url: "{{ route('faculties.update') }}",
                data: form_data,
                dataType: "json",
                success: function(data) {
                    if(data.error.length > 0)
                    {
                        var error_html = '';
                        for(var count = 0; count < data.error.length; count++)
                        {
                            error_html += '<div class="alert alert-danger">'+data.error[count]+'</div>';
                        }
                        $('#form_output').html(error_html);
                    }
                    else
                    {
                        $('#editFaculty').modal('hide');
                        $("#message").text('Cập nhật thành công!');
                        $("#message").fadeIn(300).delay(3500).fadeOut(00);
                        ele.find("td.name").text(data.faculty['name']);
                        ele.find("td.description").text(data.faculty['description']);
                        var newtag='';
                        for (var i = 0, len = Object.values(data.tag).length; i < len; i++) {
                          newtag = newtag + '<span class="label label-default">'+Object.values(data.tag)[i]+'</span>'
                      }
                      ele.find("td.tags").html(newtag);
                      console.log(ele.find("td.name"));
                      console.log(Object.values(data.tag));
                        // $('#updateFaculty')[0].reset();
                        // $('#faculty_table').DataTable().ajax.reload();
                    }
                },
                error: function(data) {
                    alertError('Cập nhật thất bại ...');
                }
            });
            //end of ajax
        });
            //end of submit

            //edit click
            $(document).on('click', '.delete',function() {
                var id = $(this).attr("id");
                var url = '{{ route("faculties.removedata") }}';
                var currentelement = $(this);
                $.confirm({
                    icon: 'fa fa-warning',
                    title: 'Cảnh báo!!',
                    content: 'Bạn có chắc muốn xóa nghành học này!',
                    type:'red',
                    buttons: {
                        XacNhan: {
                            text: 'Xác nhận',
                            btnClass: 'btn-success',
                            keys: ['enter', 'shift'],
                            action: function() {
                                $.ajax({
                                 headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url: url,
                                type: 'delete',
                                data: {"id": id},
                                success: function(){
                                   $("#message").text('Xóa ngành đào tạo thành công!');
                                   $("#message").fadeIn(300).delay(3500).fadeOut(00);
                                   currentelement.parent().parent().remove();
                                   alertSuccess('Xóa thành công ...');
                               },
                               error: function(){
                                   alertError('Xóa không thành công ...');
                               }            
                           });
                            },
                        },
                        Huy: {
                            text: 'Hủy',
                            btnClass: 'btn-danger',
                            keys: ['esc'],
                        },
                    },
                });
            });
        });
    </script>

    <!-- Confirm Button -->

    @endsection